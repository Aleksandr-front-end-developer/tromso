<?php



/**
 * Часть 1: Сбор данных меню для перевода
 * Срабатывает при сохранении меню на языке по умолчанию
 */

add_action('wp_update_nav_menu', 'auto_translate_collect_menu_translation_data', 999, 2);

function auto_translate_collect_menu_translation_data($menu_id, $menu_data = null) {

  if (!is_null($menu_data))
  {
    return;
  }

  $translate_lists = get_translate_list();
  $translate = ($translate_lists['menus']['auto_translate_menus_translate_action'] == 'translate');

  
  $menu_lng = pll_get_term_language($menu_id);
  $default_lng = get_default_language();
  $languages = get_languages_list();
  
  if (empty($menu_lng))
  {
    pll_set_term_language($menu_id, $default_lng);
    
    $translations = pll_get_term_translations($menu_id);
    $translations[$default_lng] = $menu_id;
    pll_save_term_translations($translations);
    
    $menu_lng = pll_get_term_language($menu_id);
  }
  
  // Собираем данные только для меню на языке по умолчанию
  if ($menu_lng !== $default_lng) {
    return;
  }
  
  // Собираем данные для перевода
  $translation_data = build_menu_translation_data($menu_id);
  
  foreach ($languages as $lng_to)
  {
    if ($lng_to!=$default_lng)
    {
      $strings = array();
      if ($translate)
      {
        foreach ($translation_data as $item)
        {
          $strings[] = save_translate_field($item, $default_lng, $lng_to);
        }
      }
      save_translate_entity($default_lng, $lng_to, $menu_id, 'menu', $strings, array());
    }
  }
}

/**
 * Формирует массив данных для перевода
 */
function build_menu_translation_data($menu_id) {

    $menu = wp_get_nav_menu_object($menu_id);
    $items = wp_get_nav_menu_items($menu_id);
    
    $data = array();
    
    if (((bool) preg_match('/[\p{L}]/u', $menu->description))===true) $data[] = $menu->description;
    
    if (!$items)
    {
      return $data;
    }
    
    foreach ($items as $item)
    {
      foreach (MENU_FIELDS_FOR_TRANSLATE as $name)
      {
        if (isset($item->$name) && is_string($item->$name) && ((bool) preg_match('/[\p{L}]/u', $item->$name))===true && !in_array($item->$name, $data)) $data[] = $item->$name;
      }
    }
    
    return $data;
}

/**
 * Строит дерево меню из плоского массива
 */
function build_menu_tree($items) {
    $tree = [];
    $children = [];
    
    // Группируем элементы по родительскому ID
    foreach ($items as $item) {
        $parent_id = (int)$item->menu_item_parent;
        if (!isset($children[$parent_id])) {
            $children[$parent_id] = [];
        }
        $children[$parent_id][] = $item;
    }
    
    return build_branch(0, $children);
}

// Рекурсивно строим дерево
function build_branch($parent_id, $children) {
    $branch = [];
    if (!isset($children[$parent_id])) {
        return $branch;
    }
    
    // Сортируем дочерние элементы по menu_order
    usort($children[$parent_id], function($a, $b) {
        return $a->menu_order - $b->menu_order;
    });
    
    foreach ($children[$parent_id] as $item) {
        $branch[] = [
            'item' => $item,
            'children' => build_branch($item->ID, $children)
        ];
    }
    
    return $branch;
}


function final_translate_menu($translate_lists, $row, $languages) { //возвращает значение need_delete
global $polylang;

  // Проверяем исходное меню
  $source_items = wp_get_nav_menu_items($row['entity_id']);
  if (!$source_items || is_wp_error($source_items))
  {
    return true;
  }

  $check = check_translate_entity($row);
  
  if ($check===false)
  {
    return false;
  }
  
  $translate = ($translate_lists['menus']['auto_translate_menus_translate_action'] == 'translate');

  $source_menu = wp_get_nav_menu_object($row['entity_id']);
  $source_name = $source_menu->name;
  
  $menu_tree = build_menu_tree($source_items);
  
  $new_menu_id = get_language_term($row['entity_id'], $row['lng_to']);

  if ($new_menu_id!=$row['entity_id'] && $new_menu_id!=0) // Обновляем существующее меню
  {
    // Очищаем старые пункты
    $existing_items = wp_get_nav_menu_items($new_menu_id);
    if ($existing_items) {
        foreach ($existing_items as $item) {
            wp_delete_post($item->ID, true);
        }
    }
          
  } else
  {
    $menu_name = $source_name.' '.strtoupper($row['lng_to']); 
  
    // Создаем новое меню
    $new_menu_id = wp_create_nav_menu($menu_name);
    
    if (is_wp_error($new_menu_id))
    {
      return false;
    }
    
    // Назначаем язык
    pll_set_term_language($new_menu_id, $row['lng_to']);
    
    $translations = pll_get_term_translations($row['entity_id']);
    $translations[$row['lng_to']] = $new_menu_id;
    pll_save_term_translations($translations);
  }
  
  $items_result = create_translated_menu_items(
      $menu_tree, 
      $new_menu_id, 
      $row['lng_from'],
      $row['lng_to'],
      $translate,
  );
  
  if ($items_result)
  {
    copy_menu_locations($row['entity_id'], $new_menu_id, $row['lng_to']);
    return true;
  }

  return false;
}

function create_translated_menu_items($tree, $new_menu_id, $source_lang, $target_lang, $translate = false, $parent_id = 0) {

    $all_translated_exists = true;
    
    foreach ($tree as $node)
    {
      $item = $node['item'];
      $children = $node['children'];
      $item_key = $node['item']->ID; // Используем ID как ключ
        
      // Получаем переведенный объект
      $translated_object_id = $item->object_id;
      $translated_object = $item->object;
      
      // Для типов, требующих перевода объекта
      if ($item->type == 'post_type') {
          $translated_object_id = pll_get_post($item->object_id, $target_lang);
          if (!$translated_object_id) {
              $translated_object_id = $item->object_id;
              $all_translated_exists = false;
          }
      } elseif ($item->type == 'taxonomy') {
          $translated_object_id = pll_get_term($item->object_id, $target_lang);
          if (!$translated_object_id) {
              $translated_object_id = $item->object_id;
              $all_translated_exists = false;
          }
      }
      
      $temp = (array) $item;
      if ($translate)
      {
        foreach (MENU_FIELDS_FOR_TRANSLATE as $field_name)
        {
          if (isset($temp[$field_name]) && is_string($temp[$field_name]) && ((bool) preg_match('/[\p{L}]/u', $temp[$field_name]))===true)
           $temp[$field_name] = get_translate_string($temp[$field_name], $source_lang, $target_lang);
        }
        
        if (isset($temp['url']) && $temp['type']=='custom') $temp['url'] = process_menu_url($temp['url'], $target_lang);
      }
      
      
      
      // Подготавливаем данные для нового пункта
      $item_data = [
          'menu-item-title' => $temp['title'] ?? $item->title,
          'menu-item-url' => $temp['url'] ?? $item->url,
          'menu-item-object' => $translated_object,
          'menu-item-object-id' => $translated_object_id,
          'menu-item-type' => $temp['type'] ?? $item->type,
          'menu-item-parent-id' => $parent_id,
          'menu-item-position' => $temp['menu_order'] ?? $item->menu_order,
          'menu-item-status' => 'publish',
          'menu-item-classes' => implode(' ', $item->classes),
          'menu-item-target' => $temp['target'] ?? $item->target,
          'menu-item-attr-title' => $temp['attr_title'] ?? $item->attr_title,
          'menu-item-description' => $temp['description'] ?? $item->description,
          'menu-item-xfn' => $temp['xfn'] ?? $item->xfn,
      ];
      
      // Создаем пункт меню
      $new_item_id = wp_update_nav_menu_item($new_menu_id, 0, $item_data);
      
      // Рекурсивно обрабатываем дочерние элементы
      if (!empty($children))
      {
        $children_result = create_translated_menu_items(
            $children,
            $new_menu_id,
            $source_lang,
            $target_lang,
            $translate,
            $new_item_id // Передаем новый ID как родителя
        );
      }
    }
    
    return $all_translated_exists;
}


/**
 * Копирует местоположения меню через опцию Polylang
 */
function copy_menu_locations($source_menu_id, $new_menu_id, $target_lang) {

  // Получаем текущую опцию Polylang
  $polylang_options = get_option('polylang');
  
  if (!$polylang_options || !isset($polylang_options['nav_menus'])) {
      // Если опции нет, создаем базовую структуру
      $polylang_options = ['nav_menus' => []];
  }
  
  $theme_name = get_option('stylesheet');
  
  // Инициализируем структуру для темы
  if (!isset($polylang_options['nav_menus'][$theme_name])) {
      $polylang_options['nav_menus'][$theme_name] = [];
  }
  
  // Находим все локации, где используется исходное меню
  $theme_locations = $polylang_options['nav_menus'][$theme_name];
  $locations_to_copy = [];
  
  foreach ($theme_locations as $location => $langs) {
      if (in_array($source_menu_id, $langs)) {
          $locations_to_copy[] = $location;
      }
  }
  
  // Если исходное меню не привязано ни к одной локации, выходим
  if (empty($locations_to_copy)) {
      return;
  }
  
  // Копируем привязки для каждой найденной локации
  foreach ($locations_to_copy as $location) {
      // Добавляем или обновляем привязку для целевого языка
      $polylang_options['nav_menus'][$theme_name][$location][$target_lang] = $new_menu_id;
  }
  
  // Сохраняем обновленную опцию
  update_option('polylang', $polylang_options);
}


/**
 * Обрабатывает URL для многоязычного меню
 * 
 * @param string $url Исходный URL
 * @param string $target_lang Целевой язык
 * @return string Обработанный URL
 */
function process_menu_url($url, $target_lang) {

    // Если URL пустой, возвращаем как есть
    if (empty($url)) {
        return $url;
    }
    
    // Получаем домен сайта
    $site_url = home_url();
    $site_host = parse_url($site_url, PHP_URL_HOST);
    
    // --- 1. Проверка на якорь для главной страницы ---
    // Проверяем, начинается ли URL с "/#"
    if (strpos($url, '/#') === 0) {
        // Получаем якорь (всё после #)
        $anchor = strstr($url, '#');
        if ($anchor !== false) {
            // Строим новый URL с языковым префиксом
            return '/' . $target_lang . '/' . $anchor;
        }
        return $url;
    }
    
    // --- 2. Проверка на полный URL с доменом ---
    // Проверяем, начинается ли URL с домена сайта
    // Проверяем, является ли URL ссылкой на наш сайт
    if (strpos($url, home_url()) === 0 || strpos($url, '/') === 0) {
        // Попытка получить ID поста из URL (может не работать с языковым префиксом)
        $post_id = url_to_postid($url);

        // Если ID не найден, удаляем языковой префикс и пробуем снова
        if (!$post_id) {
            // Удаляем префикс языка из URL, если он есть
            $clean_url = preg_replace('#^/[a-z]{2}/#', '/', $url);
            // Преобразуем относительный URL в абсолютный для url_to_postid()
            if (strpos($clean_url, '/') === 0) {
                $clean_url = home_url($clean_url);
            }
            $post_id = url_to_postid($clean_url);
        }

        // Если ID найден, ищем его перевод для целевого языка
        if ($post_id) {
            // Получаем ID переведенного поста
            $translated_post_id = pll_get_post($post_id, $target_lang);
            if ($translated_post_id) {
                // Возвращаем полную ссылку на переведенный пост
                return get_permalink($translated_post_id);
            }
        }
    }
        
    // --- 4. Внешние ссылки или уже с языковым префиксом ---
    // Возвращаем как есть
    return $url;
}
