<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('wp_ajax_translate_all_site', 'ajax_translate_all_site');

function ajax_translate_all_site() {
    
    // Проверяем права пользователя
    if (!current_user_can('manage_options')) {
        wp_send_json_error(['message' => 'You do not have sufficient permissions to perform this action.']);
        return;
    }
    
    
    //Меню
    $translate_lists = get_translate_list();
    $languages = get_languages_list();
    $default_lng = get_default_language();

    $all_menus = wp_get_nav_menus();
    $filtered_menus = [];

    foreach ($all_menus as $menu) {
        $menu_lang = get_term_language($menu->term_id);
        if ($menu_lang === $default_lng || empty($menu_lang)) {
            $filtered_menus[] = $menu;
        }
    }
    
    foreach ($filtered_menus as $menu)
    {
      do_action('wp_update_nav_menu', $menu->term_id);
    }

    
    //Настройки темы
    $containers = \Carbon_Fields\Carbon_Fields::resolve('container_repository')->get_containers();
    foreach ($containers as $container)
    {
      if ($container->type === 'theme_options')
      { 
        do_action('carbon_fields_theme_options_container_saved', null, $container);
      }
    }

    
    //Статика
    $theme_static_options = $translate_lists['theme_static'];
    if (!is_array($theme_static_options)) $theme_static_options = array();
    
    if (class_exists('Polylang_Theme_Translation') && class_exists('PLL_Admin_Strings'))
    {
      //принудительное сканирование сайта в поиске строк
      $ptt = new Polylang_Theme_Translation();
      $ptt->run();
      $strings = PLL_Admin_Strings::get_strings();
      //$contexts = array();
      
      foreach ($theme_static_options as $theme_static_option)
      {
        foreach ($strings as $strings_key=>$string)
        {
          //if ($strings_key=='614cffa523202658a898e34a5d94d05e') error_log(print_r($string, true));
          //if (!in_array($string['context'], $contexts)) $contexts[] = $string['context'];
          if ($string['context']=='TTfP: '.$theme_static_option['text_domain'] || $string['context']==$theme_static_option['text_domain'])
          {
            foreach ($languages as $lng_to)
            {                        
              if ($theme_static_option['translate_action']=='translate' && $default_lng!=$lng_to)
              {
                $array_of_strings = array(save_translate_field($string['string'], $default_lng, $lng_to));
                save_translate_entity($default_lng, $lng_to, $strings_key, 'theme_static', $array_of_strings);
              
              } elseif ($theme_static_option['translate_action']=='duplicate' || $default_lng==$lng_to)
              {
                add_polylang_string_translation(
                    $string['context'],  // context
                    $string['name'],         // name
                    $string['string'],         // original string
                    $lng_to,            // language code
                    $string['string']           // translation
                );
              }
            }
          }  
        }
      }
      //error_log(print_r($contexts, true));
    }

    
    //Таксономии
    $taxonomies_options = $translate_lists['terms'];
    if (!is_array($taxonomies_options)) $taxonomies_options = array();
    
    foreach ($taxonomies_options as $taxonomies_option)
    {
      $terms = get_terms([
        'taxonomy'   => $taxonomies_option['tax'],
        'hide_empty' => false,
        'lang'       => $default_lng,
      ]);
      
      foreach ($terms as $term)
      {
        $args = get_term($term, $taxonomies_option['tax'], ARRAY_A);
        do_action( 'saved_term', $args['term_id'], $args['term_taxonomy_id'], $args['taxonomy'], true, $args );
      }
    }

    
    //Посты
    $post_options = $translate_lists['posts'];
    if (!is_array($post_options)) $post_options = array();
    
    foreach ($post_options as $post_option)
    {
      $posts = get_posts([
        'numberposts' => -1,
        'post_status' => ['publish'],
        'post_type'   => $post_option['post_type'],
        'lang'       => $default_lng,
      ]);
      
      foreach ($posts as $post)
      {
        do_action( 'wp_after_insert_post', $post->ID, $post, true );
      }
    }
        
    wp_send_json_success([
        'message' => 'The task has been successfully created! It takes some time to complete.',
    ]);
}

add_action('wp_ajax_translate_find_all', 'ajax_translate_find_all');

function ajax_translate_find_all() {
global $wpdb;
    
  // Проверяем права пользователя
  if (!current_user_can('manage_options')) {
      wp_send_json_error(['message' => 'You do not have sufficient permissions to perform this action.']);
      return;
  }
  
  if (carbon_lang_prefix()=='')
  {    
    create_tables_for_auto_translates();  
  
    //POST OPTIONS
    $default_main_fields = array('post_title', 'post_content', 'post_excerpt');
    
    $post_options = carbon_get_theme_option_lng( 'auto_translate_post_types' );
    if (!is_array($post_options)) $post_options = array();
    
    //Удаление дублей пост-тайпов
    $unique = [];
    foreach ($post_options as $item)
    {
      $post_type = $item['post_type'];
      // Каждая новая запись с тем же post_type просто перезаписывает предыдущую
      $unique[$post_type] = $item;
    }

    // Преобразуем обратно в индексированный массив (сбрасываем ключи)
    $post_options = array_values($unique);
    
    $post_types = get_post_types(array( 'public' => true ));
    unset( $post_types['attachment'] );
    
    //Добавление недостающих пост-тайпов
    foreach ($post_types as $post_type)
    {
      if (in_array($post_type, array_column($post_options, 'post_type'))!==true)
        $post_options[] = array('_type'=>'_', 'post_type'=>$post_type, 'translate_action'=>'duplicate', 'main_fields'=>array(), 'meta_fields'=>array(), 'carbon_fields'=>array(), );
    }
    
    //Добавление недостающих основных полей в каждый пост-тайп
    foreach ($post_options as $key=>$post_option)
    {
      foreach ($default_main_fields as $main_field)
      {
        if (in_array($main_field, array_column($post_option['main_fields'], 'name'))!==true) $post_options[$key]['main_fields'][] = array('_type'=>'_', 'name'=>$main_field, 'translate_action'=>'translate', );
      }
    }
    
    //Добавление недостающих postmeta полей в каждый пост-тайп
    $all_meta_keys = $wpdb->get_col("
        SELECT DISTINCT meta_key 
        FROM {$wpdb->postmeta}
        WHERE meta_key NOT LIKE '\_%'
        ORDER BY meta_key
    ");

    foreach ($post_options as $key=>$post_option)
    {
      foreach ($all_meta_keys as $field)
      {
        if (in_array($field, array_column($post_option['meta_fields'], 'name'))!==true) $post_options[$key]['meta_fields'][] = array('_type'=>'_', 'name'=>$field, 'translate_action'=>'duplicate', );
      }
    }
    
    //Добавление недостающих Carbon Fields полей в каждый пост-тайп
    $cfields = array();
    if (class_exists('Carbon_Fields\Carbon_Fields'))
    {
      $containers = \Carbon_Fields\Carbon_Fields::resolve('container_repository')->get_containers();
      foreach ($containers as $container)
      {
        if ($container->type === 'post_meta' && $container->id!='carbon_fields_container_'.TEMPORARY_CONTAINER_NAME)
        {
          array_push($cfields, ...get_all_carbon_fields_from_container($container->get_fields()));
        }
      }
    }

    foreach ($post_options as $key=>$post_option)
    {
      $named_cf_array = array();
      foreach ($post_option['carbon_fields'] as $cf_field) $named_cf_array[$cf_field['name']] = true;
      
      foreach ($cfields as $field)
      {
        if (!isset($named_cf_array[$field['name']]))
        {
          $post_options[$key]['carbon_fields'][] = array(
            '_type' => '_', 
            'name' => $field['name'], 
            'field_type' => $field['type'], 
            'translate_action' => 'do not transfer field values',
          );
          $named_cf_array[$field['name']] = true;
        }
      }
    }
    
    //Сохранение
    if ($post_options!=carbon_get_theme_option_lng( 'auto_translate_post_types' )) carbon_set_theme_option( 'auto_translate_post_types', $post_options );



    //TAXONOMIES OPTIONS
    $default_main_fields = array('name', 'description');
    
    $taxonomies_options = carbon_get_theme_option_lng( 'auto_translate_taxonomies' );
    if (!is_array($taxonomies_options)) $taxonomies_options = array();
    
    //Удаление дублей
    $unique = [];
    foreach ($taxonomies_options as $item)
    {
      $tax = $item['tax'];
      // Каждая новая запись с тем же tax просто перезаписывает предыдущую
      $unique[$tax] = $item;
    }

    // Преобразуем обратно в индексированный массив (сбрасываем ключи)
    $taxonomies_options = array_values($unique);

    $public_taxonomies = get_taxonomies( array( 'public' => true ) );
    unset( $public_taxonomies['post_format'] );
    
    //Добавление недостающих таксономий
    foreach ($public_taxonomies as $public_taxonomy)
    {
      if (in_array($public_taxonomy, array_column($taxonomies_options, 'tax'))!==true)
        $taxonomies_options[] = array('_type'=>'_', 'tax'=>$public_taxonomy, 'translate_action'=>'duplicate', 'main_fields'=>array(), 'meta_fields'=>array(), 'carbon_fields'=>array(), );
    }
    
    //Добавление недостающих основных полей
    foreach ($taxonomies_options as $key=>$taxonomies_option)
    {
      foreach ($default_main_fields as $main_field)
      {
        if (in_array($main_field, array_column($taxonomies_option['main_fields'], 'name'))!==true) $taxonomies_options[$key]['main_fields'][] = array('_type'=>'_', 'name'=>$main_field, 'translate_action'=>'translate', );
      }
    }

    //Добавление недостающих termmeta полей
    $all_meta_keys = $wpdb->get_col("
        SELECT DISTINCT meta_key 
        FROM {$wpdb->termmeta}
        WHERE meta_key NOT LIKE '\_%'
        ORDER BY meta_key
    ");

    foreach ($taxonomies_options as $key=>$taxonomies_option)
    {
      foreach ($all_meta_keys as $field)
      {
        if (in_array($field, array_column($taxonomies_option['meta_fields'], 'name'))!==true) $taxonomies_options[$key]['meta_fields'][] = array('_type'=>'_', 'name'=>$field, 'translate_action'=>'duplicate', );
      }
    }

    //Добавление недостающих Carbon Fields полей
    $cfields = array();
    if (class_exists('Carbon_Fields\Carbon_Fields'))
    {
      $containers = \Carbon_Fields\Carbon_Fields::resolve('container_repository')->get_containers();
      foreach ($containers as $container)
      {
        if ($container->type === 'term_meta')
        {
          $fields = $container->get_fields();
          if (!empty($fields))
          {
            foreach ($fields as $field)
            {
              if (in_array($field->get_type(), ['text', 'rich_text', 'complex'])) $cfields[] = $field->get_base_name();
            }
          }
        }
      }
    }

    foreach ($taxonomies_options as $key=>$taxonomies_option)
    {
      foreach ($cfields as $field)
      {
        if (in_array($field, array_column($taxonomies_option['carbon_fields'], 'name'))!==true) $taxonomies_options[$key]['carbon_fields'][] = array('_type'=>'_', 'name'=>$field, 'translate_action'=>'duplicate', );
      }
    }

    
    //Сохранение
    if ($taxonomies_options!=carbon_get_theme_option_lng( 'auto_translate_taxonomies' )) carbon_set_theme_option( 'auto_translate_taxonomies', $taxonomies_options );



    //THEME CARBON FIELDS OPTIONS
    $options = carbon_get_theme_option_lng( 'auto_translate_carbon_theme_options' );
    if (!is_array($options)) $options = array();
    
    //Удаление дублей
    $unique = [];
    foreach ($options as $item)
    {
      $name = $item['name'];
      // Каждая новая запись с тем же tax просто перезаписывает предыдущую
      $unique[$name] = $item;
    }

    // Преобразуем обратно в индексированный массив (сбрасываем ключи)
    $options = array_values($unique);

    //Добавление недостающих полей
    $cfields = array();
    if (class_exists('Carbon_Fields\Carbon_Fields'))
    {
      $containers = \Carbon_Fields\Carbon_Fields::resolve('container_repository')->get_containers();
      foreach ($containers as $container)
      {
        if ($container->type === 'theme_options' && $container->id!='carbon_fields_container_'.TEMPORARY_CONTAINER_NAME)
        {
          array_push($cfields, ...get_all_carbon_fields_from_container($container->get_fields()));
        }
      }
    }
    
    foreach ($cfields as $field)
    {
      if (in_array($field['name'], array_column($options, 'name'))!==true)
        $options[] = array(
          '_type' => '_', 
          'name' => $field['name'], 
          'field_type' => $field['type'], 
          'translate_action' => 'do not transfer field values',
        );
    }

    
    //Сохранение
    if ($options!=carbon_get_theme_option_lng( 'auto_translate_carbon_theme_options' )) carbon_set_theme_option( 'auto_translate_carbon_theme_options', $options );
  }
    
    // Отправляем успешный ответ
    wp_send_json_success([
        'message' => 'Success!',
    ]);
}


add_action('wp_ajax_translate_settings_export', 'ajax_translate_settings_export');

function ajax_translate_settings_export() {
    
  // Проверяем права пользователя
  if (!current_user_can('manage_options')) {
      wp_send_json_error(['message' => 'You do not have sufficient permissions to perform this action.']);
      return;
  }

  if (carbon_lang_prefix()!='') {
      wp_send_json_error(['message' => 'You can\'t export settings for the current language. Try exporting general settings.']);
      return;
  }

  $lng = carbon_lang_prefix();
  
  $repository = \Carbon_Fields\Carbon_Fields::resolve( 'container_repository' );
  
  $containers = $repository->get_containers();
  foreach ($containers as $container)
  {
    if ($container->type === 'theme_options' && $container->id=='carbon_fields_container_site_settings_auto_translate')
    {
      $file = array();
      foreach ($container->get_fields() as $field)
      {
        $key = $field->get_base_name();
        
        if ($lng!='') $key = substr($key, 0, -strlen($lng));
        
        $value = carbon_get_theme_option_lng($key);
        
        $file[$key] = $value;
          
      } 

      // Отправляем успешный ответ
      wp_send_json_success([
          'message' => 'Success!',
          'file' => $file,
      ]);
      return;
    }
  }

  wp_send_json_error(['message' => 'Settings container not found']);
}

add_action('wp_ajax_translate_settings_import', 'ajax_translate_settings_import');

function ajax_translate_settings_import() {
    
  // Проверяем права пользователя
  if (!current_user_can('manage_options')) {
      wp_send_json_error(['message' => 'You do not have sufficient permissions to perform this action.']);
      return;
  }

  if (!isset($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
      wp_send_json_error(['message' => 'Error loading file.']);
      return;
  }
  
  $lng = carbon_lang_prefix();
  
  $settings = json_decode(file_get_contents($_FILES['file']['tmp_name']), true);
  
  $repository = \Carbon_Fields\Carbon_Fields::resolve( 'container_repository' );
  
  $containers = $repository->get_containers();
  foreach ($containers as $container)
  {
    if ($container->type === 'theme_options' && $container->id=='carbon_fields_container_site_settings_auto_translate')
    {
      foreach ($container->get_fields() as $field)
      {
        $field_name = $field->get_base_name();
        
        if ($lng!='')
        {
          $field_name = substr($field_name, 0, -strlen($lng));
          clone_all_carbon_field_lng_versions($field_name, TEMPORARY_CONTAINER_NAME);
        }
        
        if (isset($settings[$field_name])) carbon_set_theme_option( $field_name, $settings[$field_name] );
      }
      
      wp_send_json_success([
          'message' => 'Success!',
      ]);
      return;
    }
  }
  

  wp_send_json_error(['message' => 'Settings container not found']);
}


add_action('wp_ajax_translate_cache_clear_identical', 'ajax_translate_cache_clear_identical');

function ajax_translate_cache_clear_identical() {
global $wpdb;
    
  // Проверяем права пользователя
  if (!current_user_can('manage_options')) {
      wp_send_json_error(['message' => 'You do not have sufficient permissions to perform this action.']);
      return;
  }

  $wpdb->query("TRUNCATE ".TRANSLATE_ENTITIES_TABLE);
  $wpdb->query("TRUNCATE ".TRANSLATE_STRINGS_TABLE);
  $wpdb->query("DELETE FROM ".TRANSLATE_FRAGMENTS_TABLE." WHERE source_text=translate");

      
  wp_send_json_success([
      'message' => 'Success!',
  ]);
}


add_action('wp_ajax_translate_cache_clear_all', 'ajax_translate_cache_clear_all');

function ajax_translate_cache_clear_all() {
global $wpdb;
    
  // Проверяем права пользователя
  if (!current_user_can('manage_options')) {
      wp_send_json_error(['message' => 'You do not have sufficient permissions to perform this action.']);
      return;
  }

  $wpdb->query("TRUNCATE ".TRANSLATE_ENTITIES_TABLE);
  $wpdb->query("TRUNCATE ".TRANSLATE_STRINGS_TABLE);
  $wpdb->query("TRUNCATE ".TRANSLATE_FRAGMENTS_TABLE);

      
  wp_send_json_success([
      'message' => 'Success!',
  ]);
}

