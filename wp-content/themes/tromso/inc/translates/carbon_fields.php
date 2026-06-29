<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;


//событие после сохранения контейнера с опциями темы 
add_action('carbon_fields_theme_options_container_saved', function($hz, $container) {
      
  if (carbon_lang_prefix()=='' && $container->id!='carbon_fields_container_'.TEMPORARY_CONTAINER_NAME)
  {
    $fields = $container->get_fields();

    /*$languages = get_languages_list();


    $fields_to_delete = array();
    foreach ($fields as $field)
    {
      foreach ($languages as $lng_to)
      {
        $fields_to_delete[] = $field->get_base_name().'_'.$lng_to;
      }
    }

    // Запускаем удаление
    crb_delete_options_by_field_names( $fields_to_delete );*/

    $all_fields = get_all_carbon_fields_from_container_array($fields);

    set_theme_carbon_fields_translate($all_fields, $container);
  } 

}, 10, 2);


//проверка, можно ли переводить это поле?
function check_field_for_translate($field, $field_settings) {

  return ($field_settings['translate_action']=='translate' && ((is_string($field) && ((bool) preg_match('/[\p{L}]/u', $field))===true) || is_array($field)));
}


//сохраняет заявку на перевод строк для комплексного поля
//возвращает список ID строк из БД, и список значений ассоциативных полей
/*function save_carbon_wpapper_for_translate($carbon_field, $post_lng, $lng_to, $options_named = array(), $hierarchy_str = '') {

  $results = array('strings'=>array(), 'association'=>array());
  $hierarchy_temp = '';

  if (is_array($carbon_field) && isset($options_named[$hierarchy_str]) && $options_named[$hierarchy_str]['translate_action']=='translate')
  {
    foreach ($carbon_field as $block)
    {
      foreach ($block as $key=>$item)
      {
        if (is_string($key)) $hierarchy_temp = $hierarchy_str . ' >> ' . $key;

        if (isset($options_named[$hierarchy_temp]))
        {
          if (is_array($item) && $options_named[$hierarchy_temp]['field_type']=='complex')
          {
            $temp = save_carbon_wpapper_for_translate($item, $post_lng, $lng_to, $options_named, $hierarchy_temp); 
            array_push($results['strings'], ...$temp['strings']);
            array_push($results['association'], ...$temp['association']);
          
          } elseif (is_array($item) && $options_named[$hierarchy_temp]['field_type']=='association')
          {
            array_push($results['association'], ...array_column($item, 'value'));
          
          } elseif (is_string($item) && ((bool) preg_match('/[\p{L}]/u', $item))===true && $lng_to!=$post_lng && $options_named[$hierarchy_temp]['translate_action']=='translate')
          {
            $results['strings'] = save_translate_field($item, $post_lng, $lng_to);
          }
        }
      }
    }
  }
  
  return $results;
}*/

//сохраняет заявку на перевод строк для комплексного поля
//возвращает список ID строк из БД, и список значений ассоциативных полей
function save_any_carbon_field_for_translate($carbon_field, $post_lng, $lng_to, $options_named = array(), $hierarchy_str = '') {

  $results = array('strings'=>array(), 'association'=>array());
  $hierarchy_temp = '';
  if (isset($options_named[$hierarchy_str]) && $options_named[$hierarchy_str]['translate_action']=='translate')
  {
    if (is_array($carbon_field) && $options_named[$hierarchy_str]['field_type']=='complex')
    {
      foreach ($carbon_field as $block)
      {
        foreach ($block as $key=>$item)
        {
          if (is_string($key)) $hierarchy_temp = $hierarchy_str . ' >> ' . $key;
          
          if (isset($options_named[$hierarchy_temp]))
          {
            $temp = save_any_carbon_field_for_translate($item, $post_lng, $lng_to, $options_named, $hierarchy_temp); 
            array_push($results['strings'], ...$temp['strings']);
            array_push($results['association'], ...$temp['association']);
          }
        }
      }
      
    } elseif (is_array($carbon_field) && $options_named[$hierarchy_str]['field_type']=='association')
    {
      array_push($results['association'], ...array_column($carbon_field, 'value'));
    
    } elseif (is_string($carbon_field) && ((bool) preg_match('/[\p{L}]/u', $carbon_field))===true && $lng_to!=$post_lng && $options_named[$hierarchy_str]['translate_action']=='translate')
    {
      $results['strings'][] = save_translate_field($carbon_field, $post_lng, $lng_to);
    }
  }
  
  return $results;
}


function get_all_carbon_fields_from_container($fields) {

  $all_fields = array();
  
  if (!empty($fields))
  {
    foreach ($fields as $field)
    {
      $hierarchy = (method_exists($field, 'get_hierarchy')) ? $field->get_hierarchy() : array();
      $hierarchy_str = '';
      foreach ($hierarchy as $item) $hierarchy_str .= $item.' >> ';
      
      $all_fields[] = array('name'=>$hierarchy_str . $field->get_base_name(), 'type'=>$field->get_type());
      
      if (method_exists($field, 'get_fields'))
      {
        array_push($all_fields, ...get_all_carbon_fields_from_container($field->get_fields()));
      }
    }
  }
  
  return $all_fields;
}


//создает массив всех полей get_fields контейнера, включая вложенные, с иерархией
function get_all_carbon_fields_from_container_array($fields) {

  $result = array();
  
  if (!empty($fields))
  {
    foreach ($fields as $field)
    {
      $field_name = $field->get_base_name();
      
      $hierarchy = (method_exists($field, 'get_hierarchy')) ? $field->get_hierarchy() : array();
      $hierarchy_str = '';
      foreach ($hierarchy as $item) $hierarchy_str .= $item.' >> ';
      
      // Создаем запись для поля
      $result[$field_name] = array(
        'name' => $field_name,
        'type' => $field->get_type(),
        'with_hierarchy' => $hierarchy_str . $field->get_base_name(),
      );
      
      // Рекурсивно обрабатываем вложенные поля
      if (method_exists($field, 'get_fields'))
      {
        $child_fields = $field->get_fields();
        if (!empty($child_fields))
        {
          $result[$field_name]['children'] = get_all_carbon_fields_from_container_array($child_fields);
        }
      }
    }
  }
  
  return $result;
}


//функция получения слага текущего языка, в основном для админки
if ( ! function_exists( 'carbon_lang_prefix' ) ) {
	function carbon_lang_prefix( $as_label = false ) {
		$prefix = '';

		if ( defined( 'ICL_LANGUAGE_CODE' ) && 'all' !== ICL_LANGUAGE_CODE ) {
			$prefix = '_' . ICL_LANGUAGE_CODE;
		}

		if ( $as_label ) {
			$prefix = strtoupper( str_replace( '_', ' ', $prefix ) );
		}

		return $prefix;
	}
}


//Передает сюда обработанный список полей для перевода после сохранения контейнера с опциями темы
function set_theme_carbon_fields_translate($carbon_fields, $container) {

  if (is_array($carbon_fields))
  {
    $default_lng = get_default_language();
    $languages = get_languages_list();
    $options_named = get_named_auto_translate_options(carbon_get_theme_option_lng('auto_translate_carbon_theme_options'));

    foreach ($carbon_fields as $key=>$item)
    {
      $carbon_fields[$key]['value'] = carbon_get_theme_option_lng($key);
    }

    foreach ($languages as $lng_to)
    {
      foreach ($carbon_fields as $key=>$item)
      {
        $strings = array();  
        $associations = array();
          
        if ($options_named[$item['with_hierarchy']]['translate_action']!='do not transfer field values') 
        {
          if ($lng_to==$default_lng)
          {
            carbon_set_theme_option($key.'_'.$default_lng, $item['value']);

          } else
          {
            if ($options_named[$item['with_hierarchy']]['translate_action']=='translate')
            {
              $temp = save_any_carbon_field_for_translate($item['value'], $default_lng, $lng_to, $options_named, $item['name']);
            
              /*if (is_string($item['value']))
              {
                $strings[] = save_translate_field($item['value'], $default_lng, $lng_to);
              
              } elseif (is_array($item['value']))
              {
                if ($item['type']=='complex')
                {
                  $temp = save_carbon_wpapper_for_translate($item['value'], $default_lng, $lng_to, $options_named, $item['name']);
                  array_push($strings, ...$temp['strings']);
                  array_push($associations, ...$temp['association']);
                
                } elseif ($options_named[$item['with_hierarchy']]['field_type']=='association')
                {
                  array_push($associations, ...array_column($item['value'], 'value'));
                }
              }*/
                
              $strings = array_values(array_unique($temp['strings']));
              $associations = array_values(array_unique($temp['association']));
              save_translate_entity($default_lng, $lng_to, $item['name'], 'theme_carbon', $strings, $associations);
              
            } elseif ($options_named[$item['with_hierarchy']]['translate_action']=='duplicate')
            {
              carbon_set_theme_option($key.'_'.$lng_to, $item['value']);
            }
          }
        }  
      }
    }
  }
}

/**
 * Клонирует контейнер Theme Options со всеми полями, добавляя суффикс к именам
 *
 * @param object $original_container Оригинальный контейнер
 * @param string $new_container_id Новый ID контейнера
 * @return object Новый контейнер с переименованными полями
 */
/*function clone_container_with_renamed_fields($original_container, $new_container_id) {

    // Получаем все поля оригинального контейнера
    if (get_class($original_container)=='Carbon_Fields\Container\Theme_Options_Container') $original_fields = $original_container->get_fields();
    else $original_fields = array($original_container);
    
    $container_exist = false;
    $containers = \Carbon_Fields\Carbon_Fields::resolve('container_repository')->get_containers();
    foreach ($containers as $container)
    {
      if ($container->type === 'theme_options' && $container->id === $new_container_id)
      { 
        $container_exist = true;
        $new_container = $container;
        break;
      }
    }
    // Создаем новый контейнер
    if (!$container_exist) $new_container = Container::make('theme_options', $new_container_id);

    $languages = get_languages_list();
    
    $cloned_fields = array();

    foreach ($original_fields as $field)
    {
      $base_name = $field->get_base_name();
      foreach ($languages as $lng_to)
      {
        $suffix = '_' . $lng_to;
        if (is_null($new_container->get_field_by_name( $base_name.$suffix )))
        {
          $temp = clone $field;
          $temp->set_base_name($base_name.$suffix);  
          $temp->set_name('_'.$base_name.$suffix);  
          $cloned_fields[] = $temp;
        }
      }
    }
    
    $new_container->add_fields($cloned_fields);
    
    return $new_container;
}*/


//создает во временном контейнере все недостающие языковые версии указанного поля опций темы
function clone_all_carbon_field_lng_versions($field_name, $new_container_id) {

    $repository = \Carbon_Fields\Carbon_Fields::resolve( 'container_repository' );
    
    $container_exist = false;
    $containers = $repository->get_containers();
    foreach ($containers as $container)
    {
      if ($container->type === 'theme_options' && $container->id === 'carbon_fields_container_'.$new_container_id)
      { 
        $container_exist = true;
        $new_container = $container;
        break;
      }
    }
    // Создаем новый контейнер
    if (!$container_exist) $new_container = Container::make('theme_options', $repository->get_unique_container_id($new_container_id));

    $languages = get_languages_list();

    $cfield = $repository->get_field_in_containers( $field_name, 'theme_options' );
    if (is_null($cfield))
    {
      foreach ($languages as $lng)
      {
        $separator = ($lng=='') ? '' : '_';
        
        $cfield = $repository->get_field_in_containers( $field_name.$separator.$lng, 'theme_options' );
        if (!is_null($cfield)) break;
      }
    }
    
    if (!is_null($cfield))
    {
      $cloned_fields = array();

      if (is_null($repository->get_field_in_containers( $field_name, 'theme_options' )))
      {
        $temp = clone $cfield;
        $temp->set_base_name($field_name);  
        $temp->set_name('_'.$field_name);
        $cloned_fields[] = $temp;
      }
      
      foreach ($languages as $lng_to)
      {
        $suffix = '_' . $lng_to;
        if (is_null($repository->get_field_in_containers( $field_name.$suffix, 'theme_options' )))
        {
          $temp = clone $cfield;
          $temp->set_base_name($field_name.$suffix);  
          $temp->set_name('_'.$field_name.$suffix);
          $cloned_fields[] = $temp;
        }
      }

      $new_container->add_fields($cloned_fields);
    }
    
    return $new_container;
}


//получает перевод переданного поля, с рекурсивным переводом всех вложенных элементов
function get_carbon_translate($field_name, $field_value, $post_lng, $lng_to, $options_named = array(), $hierarchy_str = '') {
    
    $results = array(
        'need_delete' => true,
        'value' => $field_value
    );
    
    // Получаем конфигурацию текущего поля
    $current_config = isset($options_named[$hierarchy_str]) ? $options_named[$hierarchy_str] : null;
    $field_type = $current_config ? $current_config['field_type'] : '';
    $translate_action = $current_config ? $current_config['translate_action'] : 'duplicate';
    
    // Если не нужно переводить - дублируем
    if ($translate_action !== 'translate') {
        return $results;
    }
    
    // Обработка в зависимости от типа поля
    if ($field_type === 'complex') {
        // Обработка complex поля
        $new_value = array();
        
        if (is_array($field_value)) {
              foreach ($field_value as $key => $block)
              {
                $new_value[$key] = array();
                foreach ($block as $key2 => $subfield)
                {
                  $block_hierarchy = $hierarchy_str . ' >> ' . $key2;
                  $block_result = get_carbon_translate($key2, $subfield, $post_lng, $lng_to, $options_named, $block_hierarchy);
                  
                  $new_value[$key][$key2] = $block_result['value'];
                  if (!$block_result['need_delete']) $results['need_delete'] = false;
                }
              }
        }
        
        $results['value'] = $new_value;
        return $results;
        
    } elseif ($field_type === 'association')
    {
        // Обработка association поля
        $result = get_carbon_association_translate($field_value, $post_lng, $lng_to);
        return $result;
        
    } elseif (is_string($field_value))
    {
        // Перевод строки
        if ($lng_to != $post_lng && preg_match('/[\p{L}]/u', $field_value))
        {
            $results['value'] = get_translate_string($field_value, $post_lng, $lng_to);
        }
        
        return $results;
        
    } else {
        // Для всех остальных типов (числа, булевы, null и т.д.) - просто дублируем
        return $results;
    }
}


//получает перевод ассоциативного поля
function get_carbon_association_translate($field_value, $post_lng, $lng_to) {
    
    $result = array(
        'value' => $field_value,
        'need_delete' => true
    );
    
    $temp = array();
    
    if (!is_array($field_value))
    {
        return $result;
    }
    
    foreach ($field_value as $key=>$element)
    {
        if (!is_array($element))
        {
            return $result;
        }
        
        $translated_element = $element;
        
        if ($element['type'] === 'post')
        {
            $new_post_id = get_language_post($element['id'], $lng_to);
            
            if ($new_post_id && $new_post_id != 0)
            {
                $translated_element['id'] = $new_post_id;
                $translated_element['value'] = $element['type'] . ':' . $element['subtype'] . ':' . $new_post_id;
                $temp[$key] = $translated_element;
                // Элемент успешно переведен
                
            } else
            {
                // Перевод не найден - оставляем оригинал и помечаем, что удалять нельзя
                $temp[$key] = $element;
                $result['need_delete'] = false;
            }
            
        } elseif ($element['type'] === 'term')
        {
            $new_term_id = get_language_term($element['id'], $lng_to);
            
            if ($new_term_id && $new_term_id != 0) {
                $translated_element['id'] = $new_term_id;
                $translated_element['value'] = $element['type'] . ':' . $element['subtype'] . ':' . $new_term_id;
                $temp[$key] = $translated_element;
            } else {
                $temp[$key] = $element;
                $result['need_delete'] = false;
            }
        } 
        else {
            // Другие типы - оставляем как есть
            $temp[$key] = $element;
        }
    }
    
    $result['value'] = $temp;
    
    return $result;
}


//получает значение опции темы с произвольным языком (напрямую нельзя запрашивать, нужен временный контейнер
//со структурой этого поля)
function carbon_get_theme_option_lng($field_name, $lng = '') {

  $separator = ($lng=='') ? '' : '_';
    
  clone_all_carbon_field_lng_versions($field_name, TEMPORARY_CONTAINER_NAME);
  
  return carbon_get_theme_option($field_name.$separator.$lng);
}


//финальная обработка entity типа theme_carbon из БД для крона
function final_translate_theme_carbon_field($translate_lists, $row, $languages) {

  $need_delete = false;
  
  if (check_translate_entity($row) && class_exists('Carbon_Fields\Carbon_Fields'))
  {
    $need_delete = true;
    
    $default_lng = get_default_language();
    $languages = get_languages_list();
    
    $field_name = $row['entity_id'];

    $options_named = get_named_auto_translate_options(carbon_get_theme_option_lng('auto_translate_carbon_theme_options'));

    $field_value = carbon_get_theme_option_lng($field_name);
    $translate = get_carbon_translate($field_name, $field_value, $row['lng_from'], $row['lng_to'], $options_named, $field_name );
    
    if ($options_named[$field_name]['translate_action']!='do not transfer field values')
    {
      $current_lng = carbon_lang_prefix();

      if ($options_named[$field_name]['translate_action']=='translate')
      {
        carbon_set_theme_option( $field_name.'_'.$row['lng_to'], $translate['value'] );
        $need_delete = $translate['need_delete'];
      
      } elseif ($options_named[$field_name]['translate_action']=='duplicate')
      {
        carbon_set_theme_option( $field_name.'_'.$row['lng_to'], $field_value );
        $need_delete = true;
      }
      
    } else $need_delete = true;
  }
    
  return $need_delete;
}


/**
 * Удаляет все записи из wp_options для указанных полей Carbon Fields.
 * Работает с обычными и сложными (Complex) полями.
 *
 * @param array $field_names Массив имен полей для удаления.
 */
function crb_delete_options_by_field_names( $field_names ) {
    global $wpdb;

    if ( empty( $field_names ) || ! is_array( $field_names ) ) {
        return;
    }

    foreach ( $field_names as $field_name )
    {
      // Удаляем все опции, ключи которых начинаются с '_{$field_name}'
      // Это покрывает:
      // - простые поля: _field_name
      // - complex поля: _field_name|...|... (все варианты)
      $like_pattern = $wpdb->esc_like( '_' . $field_name ) . '%';
      
      $deleted = $wpdb->query(
        $wpdb->prepare(
            "DELETE FROM {$wpdb->options} WHERE option_name LIKE %s",
            $like_pattern
        )
      );
    }
}
