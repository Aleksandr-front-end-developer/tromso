<?php


function add_polylang_string_translation($context, $name, $original_string, $language_code, $translated_string) {
    if (!function_exists('PLL')) {
        return false;
    }
    
    $polylang = PLL();
    $languages = $polylang->model->get_languages_list();
    
    // Находим нужный язык
    $target_language = null;
    foreach ($languages as $language) {
        if ($language->slug === $language_code) {
            $target_language = $language;
            break;
        }
    }
    
    if (!$target_language) {
        return false;
    }
    
    // Получаем MO объект для целевого языка
    $mo = new PLL_MO();
    $mo->import_from_db($target_language);
    
    // Добавляем или обновляем перевод
    $mo->add_entry($mo->make_entry($original_string, $translated_string));
    
    // Сохраняем обратно в БД
    $mo->export_to_db($target_language);
    
    return true;
}

function final_translate_polylang_string($translate_lists, $row, $languages, $strings) {

  $need_delete = false;
  
  if (class_exists('Polylang_Theme_Translation') && class_exists('PLL_Admin_Strings') && in_array($row['lng_from'], $languages)==true && in_array($row['lng_to'], $languages)==true)
  {
    $theme_static_options = $translate_lists['theme_static'];
    if (!is_array($theme_static_options)) $theme_static_options = array();
    
    if (isset($strings[$row['entity_id']]))
    {
      $string = $strings[$row['entity_id']];
      
      $check = check_translate_entity($row);
      
      if ($check===true) 
      {
        $strings_array = json_decode($row['translate_strings'], true);
        if (is_array($strings_array) && count($strings_array)==1)
        {
          $new_value = get_translate_string($strings_array[0], $row['lng_from'], $row['lng_to']);
          
          if (is_string($new_value))
          {  
            add_polylang_string_translation(
                $string['context'],  // context
                $string['name'],         // name
                $string['string'],         // original string
                $row['lng_to'],            // language code
                $new_value           // translation
            );
            $need_delete = true;
          }
        }
      }
    }
  }  
  
  return $need_delete;
}