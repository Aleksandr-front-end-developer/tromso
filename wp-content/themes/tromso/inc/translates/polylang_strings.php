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

//после создания/изменения формы CF7
add_action('wpcf7_after_save', 'save_cf7_admin_form_data');

function save_cf7_admin_form_data($contact_form) {

  $translate_lists = get_translate_list();
  $languages = get_languages_list();
  $default_lng = get_default_language();
  add_static_for_translate($translate_lists, $languages, $default_lng, $need_domains = array('wp-contact-form-7', 'Contact Form 7'));
}


function add_static_for_translate($translate_lists, $languages, $default_lng, $need_domains = array()) {

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
      if ((count($need_domains)>0 && in_array($theme_static_option['text_domain'], $need_domains)) || count($need_domains)==0)
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
    }
    //error_log(print_r($contexts, true));
  }
}