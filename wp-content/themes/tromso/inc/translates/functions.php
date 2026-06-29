<?php

function santinize_to_text_array($text) {

  $text_array = explode("\n", sanitize_textarea_field($text));
  foreach ($text_array as $key=>$fragment)
  {
    $text_array[$key] = sanitize_text_field($fragment);
  }
  
  return $text_array;
}

function fragment_array_strlen($text_fragment_array) {

  $fragment_strlen = 0;
  foreach ($text_fragment_array as $text_fragment) $fragment_strlen += mb_strlen($text_fragment);
  
  return $fragment_strlen;
}

function save_translate_field($text, $post_lng, $lng_to) {

  $translate_as = carbon_get_theme_option_lng('translate_as');
  $fragment_ids = array();

  if ($translate_as=='text')
  {
    $text_array = santinize_to_text_array($text);
    $text_fragment_array = array();
    $i = 0;
    while (isset($text_array[$i]))
    {
      $fragment_strlen = fragment_array_strlen($text_fragment_array);
      $text_fragment_temp = array_merge($text_fragment_array, array($text_array[$i]));

      if ($fragment_strlen!=0 && $fragment_strlen<MAX_FRAGMENT_LENGTH && fragment_array_strlen($text_fragment_temp)<=MAX_FRAGMENT_LENGTH)
      {
        $text_fragment_array[] = $text_array[$i];
      } elseif ($fragment_strlen==0)
      {
        $text_fragment_array[] = $text_array[$i];
      } elseif ($fragment_strlen>=MAX_FRAGMENT_LENGTH || fragment_array_strlen($text_fragment_temp)>MAX_FRAGMENT_LENGTH)
      {
        $fragment_ids[] = save_translate_fragment($text_fragment_array, $post_lng, $lng_to);
        $text_fragment_array = array($text_array[$i]);
      }  
      $i++;
    }
    if (count($text_fragment_array)>0) $fragment_ids[] = save_translate_fragment($text_fragment_array, $post_lng, $lng_to);
  } elseif ($translate_as=='html')
  {
    $text_array = array($text);
    $fragment_ids[] = save_translate_fragment($text_array, $post_lng, $lng_to);
  }
  
  return save_translate_string($text_array, $post_lng, $lng_to, $fragment_ids);
}

function save_translate_fragment($text_fragment_array, $lng_from, $lng_to) {
  global $wpdb;
  
  $text = implode("\n", $text_fragment_array);

  $sql = $wpdb->prepare( "SELECT id FROM ".TRANSLATE_FRAGMENTS_TABLE." WHERE lng_from = '%s' AND lng_to = '%s' AND source_text = '%s'", $lng_from, $lng_to, $text );
  $id = $wpdb->get_var($sql);
  
  if (is_null($id))
  {
    $wpdb->insert( TRANSLATE_FRAGMENTS_TABLE, array( 'lng_from' => $lng_from, 'lng_to' => $lng_to, 'source_text' => $text ) );
    $id = $wpdb->insert_id;
  }

  return $id;
}

function save_translate_string($text_array, $lng_from, $lng_to, $fragment_ids) {
  global $wpdb;
  
  $text = implode("\n", $text_array);
  $fragment_ids = json_encode($fragment_ids, JSON_NUMERIC_CHECK);
  
  $sql = $wpdb->prepare( "SELECT id FROM ".TRANSLATE_STRINGS_TABLE." WHERE lng_from = '%s' AND lng_to = '%s' AND source_text = '%s' AND fragments = '%s'", $lng_from, $lng_to, $text, $fragment_ids );
  $id = $wpdb->get_var($sql);
  
  if (is_null($id))
  {
    $wpdb->insert( TRANSLATE_STRINGS_TABLE, array( 'lng_from' => $lng_from, 'lng_to' => $lng_to, 'source_text' => $text, 'fragments' => $fragment_ids ) );
    $id = $wpdb->insert_id;
  }

  return $id;
}

function save_translate_entity($lng_from, $lng_to, $post_id, $type, $strings = array(), $associations = array()) {
  global $wpdb;
  
  $strings = json_encode($strings, JSON_NUMERIC_CHECK);
  $associations = json_encode($associations, JSON_NUMERIC_CHECK);

  $sql = $wpdb->prepare( "SELECT id FROM ".TRANSLATE_ENTITIES_TABLE." WHERE lng_from = '%s' AND lng_to = '%s' AND entity_id = '%s' AND entity_type = '%s'", $lng_from, $lng_to, $post_id, $type );
  $id = $wpdb->get_var($sql);
  
  if (is_null($id))
  {
    $wpdb->insert( TRANSLATE_ENTITIES_TABLE, array( 'lng_from' => $lng_from, 'lng_to' => $lng_to, 'entity_id' => $post_id, 'entity_type' => $type, 'translate_strings' => $strings, 'associations_strings' => $associations ) );
    $id = $wpdb->insert_id;
  } else
  {
    $wpdb->update( TRANSLATE_ENTITIES_TABLE, array( 'translate_strings' => $strings, 'associations_strings' => $associations ), array( 'id' => $id ) );
  }

  return $id;
}

function check_translate_entity($row) {
  global $wpdb;
  
  $return = true;
  
  $strings = json_decode($row['translate_strings'], true);

  if (is_array($strings))
  {
    foreach ($strings as $string_id)
    {
      $sql = $wpdb->prepare( "SELECT * FROM ".TRANSLATE_STRINGS_TABLE." WHERE id = '%d'", $string_id );
      $string = $wpdb->get_row($sql, ARRAY_A);
    
      $fragments = json_decode($string['fragments'], true);
      if (is_array($fragments))
      {
        $results = $wpdb->get_results("SELECT translated FROM ".TRANSLATE_FRAGMENTS_TABLE." WHERE id IN ('".implode("', '", $fragments)."')", ARRAY_A);

        foreach ($results as $result)
        {
          if ($result['translated']!=1) $return = false;
        }
      } else $return = false;
    }
  } else $return = false;
  
  
  return $return;
}

function get_translate_string($text, $lng_from, $lng_to) {
  global $wpdb;
  
  $return = $text;
  
  if (is_string($text))
  {
    $translate_as = carbon_get_theme_option_lng('translate_as');
    if ($translate_as=='text')
    {
      $text = implode("\n", santinize_to_text_array($text));
    }
    
    $sql = $wpdb->prepare( "SELECT fragments FROM ".TRANSLATE_STRINGS_TABLE." WHERE lng_from = '%s' AND lng_to = '%s' AND source_text = '%s'", $lng_from, $lng_to, $text );
    $fragments = json_decode($wpdb->get_var($sql), true);

     
    if (is_array($fragments))
    {
      $results = $wpdb->get_results("SELECT translate FROM ".TRANSLATE_FRAGMENTS_TABLE." WHERE id IN ('".implode("', '", $fragments)."') ORDER BY FIELD(id, ".implode(", ", $fragments).")", ARRAY_A);
      $return = implode("\n", array_column($results, 'translate'));
    }
    
  } elseif (is_int($text))
  {
    $sql = $wpdb->prepare( "SELECT fragments FROM ".TRANSLATE_STRINGS_TABLE." WHERE id = '%d'", $text );
    $fragments = json_decode($wpdb->get_var($sql), true);

     
    if (is_array($fragments))
    {
      $results = $wpdb->get_results("SELECT translate FROM ".TRANSLATE_FRAGMENTS_TABLE." WHERE id IN ('".implode("', '", $fragments)."') ORDER BY FIELD(id, ".implode(", ", $fragments).")", ARRAY_A);
      $return = implode("\n", array_column($results, 'translate'));
    }
  }
  
  return $return;
}

function get_untranslated_entities_count() {
  global $wpdb;

  $entities_count = $wpdb->get_var("
      SELECT COUNT(id) 
      FROM ".TRANSLATE_ENTITIES_TABLE);

  $fragments_count = $wpdb->get_var($wpdb->prepare( "SELECT COUNT(id) FROM ".TRANSLATE_FRAGMENTS_TABLE." WHERE translated='%d'", 0 ));
      
  return array('entities'=>$entities_count, 'fragments'=>$fragments_count);
}

function get_identical_translates_count() {
  global $wpdb;

  $fragments_count = $wpdb->get_var("SELECT COUNT(id) FROM ".TRANSLATE_FRAGMENTS_TABLE." WHERE translate=source_text");
      
  return $fragments_count;
}

function get_all_translates_count() {
  global $wpdb;

  $fragments_count = $wpdb->get_var("SELECT COUNT(id) FROM ".TRANSLATE_FRAGMENTS_TABLE);
      
  return $fragments_count;
}

function get_translate_list() {
  
  $return = array(
    'theme_static' => array(),
    'menus' => array(),
    'terms' => array(),
    'posts' => array(),
  );
  
  $theme_static_options = carbon_get_theme_option_lng( 'auto_translate_theme_static_strings' );
  foreach ($theme_static_options as $theme_static_option)
  {
    $return['theme_static'][$theme_static_option['text_domain']] = $theme_static_option;  
  }

  $auto_translate_menus_translate_action = carbon_get_theme_option_lng( 'auto_translate_menus_translate_action' );
  $return['menus']['auto_translate_menus_translate_action'] = $auto_translate_menus_translate_action;  
  
  $taxonomies_options = carbon_get_theme_option_lng( 'auto_translate_taxonomies' );
  foreach ($taxonomies_options as $taxonomies_option)
  {
    $return['terms'][$taxonomies_option['tax']] = $taxonomies_option;  
  }

  $posts_options = carbon_get_theme_option_lng( 'auto_translate_post_types' );
  foreach ($posts_options as $posts_option)
  {
    $return['posts'][$posts_option['post_type']] = $posts_option;  
  }
  
  return $return;
}

function get_named_auto_translate_options($options) {

  $options_named = array();
  foreach ($options as $item)
  {
    $options_named[$item['name']] = $item; 
  }
  
  return $options_named;
}




/**
 * Редирект переходов на правильную фзыковую версию
 * Полная версия для Polylang с поддержкой:
 * - Постов и страниц
 * - Таксономий (категории, метки)
 * - Главной страницы
 * - Страницы блога
 */
function advanced_polylang_redirect() {
    if (is_admin() || wp_doing_ajax() || wp_doing_cron()) {
        return;
    }
    
    $check_for_language = isset($_GET['check_for_language']) ? (int)$_GET['check_for_language'] : 0;
    $current_language = isset($_GET['current_language']) ? sanitize_text_field($_GET['current_language']) : '';
    
    if ($check_for_language !== 1 || empty($current_language)) {
        return;
    }
    
    // Проверяем существование языка
    if (!PLL()->model->get_language($current_language)) {
        return;
    }
    
    $translated_url = false;
    $current_object = get_queried_object();
    
    // 1. Обработка постов и страниц
    if (is_singular()) {
        if ($current_object && isset($current_object->ID)) {
            $post_id = $current_object->ID;
            $translated_id = pll_get_post($post_id, $current_language);
            
            if ($translated_id && $translated_id !== $post_id) {
                $translated_url = get_permalink($translated_id);
            }
        }
    }
    
    // 2. Обработка таксономий (категории, метки, рубрики)
    elseif (is_category() || is_tag() || is_tax()) {
        if ($current_object && isset($current_object->term_id)) {
            $term_id = $current_object->term_id;
            $translated_term_id = pll_get_term($term_id, $current_language);
            
            if ($translated_term_id && $translated_term_id !== $term_id) {
                $translated_url = get_term_link($translated_term_id);
                if (is_wp_error($translated_url)) {
                    $translated_url = false;
                }
            }
        }
    }
    
    // 3. Обработка главной страницы
    elseif (is_front_page()) {
        $page_on_front = get_option('page_on_front');
        if ($page_on_front) {
            $translated_id = pll_get_post($page_on_front, $current_language);
            if ($translated_id && $translated_id !== $page_on_front) {
                $translated_url = get_permalink($translated_id);
            }
        }
    }
    
    // 4. Обработка страницы блога (если отдельная страница)
    elseif (is_home()) {
        $page_for_posts = get_option('page_for_posts');
        if ($page_for_posts) {
            $translated_id = pll_get_post($page_for_posts, $current_language);
            if ($translated_id && $translated_id !== $page_for_posts) {
                $translated_url = get_permalink($translated_id);
            }
        }
    }
    
    // Если перевод найден - делаем редирект
    if ($translated_url) {
        // Убираем параметры проверки
        $translated_url = remove_query_arg(
            array('check_for_language', 'current_language'),
            $translated_url
        );
        
        wp_redirect($translated_url, 301);
        exit;
    }
}
add_action('template_redirect', 'advanced_polylang_redirect', 1);