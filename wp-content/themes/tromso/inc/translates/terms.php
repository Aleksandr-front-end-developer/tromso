<?php


add_action('saved_term', 'auto_translate_for_saved_term', 10, 5 );

function auto_translate_for_saved_term($term_id, $tt_id, $taxonomy, $update, $args) {
  global $wpdb;
  
  if (is_translated_taxonomy($taxonomy))
  {
    $blocked = false;
    $blocked_number = false;
    if (isset($GLOBALS['do_not_translate_terms']) && is_array($GLOBALS['do_not_translate_terms']))
    {
      foreach ($GLOBALS['do_not_translate_terms'] as $key=>$item)
      {
        if (isset($item['term_id']) && $item['term_id']==$term_id) { $blocked = true; $blocked_number = $key; }
        if (isset($item['term']) && $item['term']==$args['name'] && isset($item['taxonomy']) && $item['taxonomy']==$taxonomy) { $blocked = true; $blocked_number = $key; }
      }
    }
    
    if (!$blocked)
    {
      $term_lng = get_term_language($term_id);
      $default_lng = get_default_language();
      $languages = get_languages_list();
      
      $translate_lists = get_translate_list();
      $translate_lists = $translate_lists['terms'];
      
      if (isset($translate_lists[$taxonomy]) && is_array($translate_lists[$taxonomy]) && $term_lng==$default_lng)
      {
        if ($translate_lists[$taxonomy]['translate_action']=='translate')
        {
          $translate_list = $translate_lists[$taxonomy];
          
          if (isset($translate_list['main_fields']) && is_array($translate_list['main_fields']))
          {
            foreach ($languages as $lng_to)
            {
              if ($lng_to!=$term_lng)
              {
                $strings = array();
                $associations = array();
              
                foreach ($translate_list['main_fields'] as $field)
                {
                  if (isset($args[$field['name']]) && check_field_for_translate($args[$field['name']], $field))
                  {
                    $strings[] = save_translate_field($args[$field['name']], $term_lng, $lng_to);
                  }  
                }

                foreach ($translate_list['meta_fields'] as $field)
                {
                  $meta_field = get_term_meta( $term_id, $field['name'], true );
                  if (check_field_for_translate($meta_field, $field))
                  {
                    $strings[] = save_translate_field($meta_field, $term_lng, $lng_to);
                  }  
                }

                $options_named = get_named_auto_translate_options($translate_list['carbon_fields']);
                foreach ($translate_list['carbon_fields'] as $field)
                {
                  if (strpos($field['name'], ' >> ')===false)
                  {
                    $carbon_field = carbon_get_term_meta( $term_id, $field['name'] );

                    if (check_field_for_translate($carbon_field, $field))
                    {
                      $temp = save_any_carbon_field_for_translate($carbon_field, $term_lng, $lng_to, $options_named, $field['name']);
                      array_push($strings, ...$temp['strings']);
                      array_push($associations, ...$temp['association']);
                    }
                  }
                }
                $strings = array_values(array_unique($strings));
                $associations = array_values(array_unique($associations));
                save_translate_entity($term_lng, $lng_to, $term_id, 'term', $strings, $associations);
              }
            }
          }
        } elseif ($translate_lists[$taxonomy]['translate_action']=='duplicate')
        {
          foreach ($languages as $lng_to)
          {
            if ($lng_to!=$term_lng)
            {
              save_translate_entity($term_lng, $lng_to, $term_id, 'term', array());
            }
          }
        }
      }
    }
    
    if ($blocked_number!==false) unset($GLOBALS['do_not_translate_terms'][$blocked_number]);
  }
}



function clone_term_for_translate($term, $lng_to) {
global $wpdb;

  $new_term_id = intval(get_language_term($term['term_id'], $lng_to));
  
  if ($new_term_id==0 && function_exists('pll_get_term_translations') && function_exists('pll_save_term_translations')
   && function_exists('pll_get_term_language')  && function_exists('pll_is_translated_taxonomy'))
  {
    $args = (array) $term;
    unset($args['term_id']);
    unset($args['term_taxonomy_id']);
    unset($args['count']);
    unset($args['name']);
    unset($args['taxonomy']);
    $args['slug'] .= '-'.$lng_to; 
    
    $parent_lng_term = 0;
    if ($term['parent']!=0)
    {
      $parent_lng_term = get_language_term( $term['parent'], $lng_to );
      if ($parent_lng_term==$term['term_id'] || $parent_lng_term==0)
      {
        $parent_args = get_term($term['parent'], $term['taxonomy'], ARRAY_A);
        do_action( 'saved_term', $parent_args['term_id'], $parent_args['term_taxonomy_id'], $parent_args['taxonomy'], true, $parent_args );
        return 0;
      }
    }
    $args['parent'] = $parent_lng_term;
    
    if (!isset($GLOBALS['do_not_translate_terms']) || !is_array($GLOBALS['do_not_translate_terms'])) $GLOBALS['do_not_translate_terms'] = array();
    $GLOBALS['do_not_translate_terms'][] = array('term'=>$term['name'], 'taxonomy'=>$term['taxonomy']);
    $new_term_id = wp_insert_term( $term['name'], $term['taxonomy'], $args );
    
    $new_term_id = $new_term_id['term_id'];
    
    pll_set_term_language($new_term_id, $lng_to);
    
    $translations = pll_get_term_translations($term['term_id']);
    $translations[$lng_to] = $new_term_id;
    pll_save_term_translations($translations);

  } elseif ($new_term_id!=0)
  {
    $wpdb->delete( $wpdb->termmeta, [ 'term_id'=>$new_term_id ] );
    clean_term_cache( $new_term_id );
  }
  
  if ($new_term_id!=0)
  {
		// дублируем все произвольные поля
		$term_meta = get_term_meta( $term['term_id'] );
		if( $term_meta )
    {
			foreach ( $term_meta as $meta_key => $meta_values ) {
				foreach ( $meta_values as $meta_value )
        {
					add_term_meta( $new_term_id, $meta_key, maybe_unserialize($meta_value) );
				}
			}
		}
  }
  
  return $new_term_id;
}

function final_translate_term($translate_lists, $row, $languages) {

  $need_delete = true;
  
  $term = get_term(intval($row['entity_id']), '', ARRAY_A);
        
  if (!is_null($term) && is_translated_taxonomy($term['taxonomy']))
  {
    
    if (isset($translate_lists['terms'][$term['taxonomy']]) && is_array($translate_lists['terms'][$term['taxonomy']])
     && in_array($row['lng_from'], $languages)==true && in_array($row['lng_to'], $languages)==true)
    {
      $translate_list = $translate_lists['terms'][$term['taxonomy']];
      if (isset($translate_list['main_fields']) && is_array($translate_list['main_fields']))
      {
        $check = check_translate_entity($row);
        
        if ($check===false) $need_delete = false;
        else
        {
          $new_term_id = clone_term_for_translate($term, $row['lng_to']);  
          
          if ($new_term_id!=0)
          {
            $new_term = get_term($new_term_id, '', ARRAY_A);
            $args = array();
            foreach ($translate_list['main_fields'] as $field)
            {
              if (isset($term[$field['name']]) && check_field_for_translate($term[$field['name']], $field))
              {
                $args[$field['name']] = get_translate_string($term[$field['name']], $row['lng_from'], $row['lng_to']);
              } elseif (isset($term[$field['name']]))
              {
                $args[$field['name']] = $term[$field['name']];
              }  
            }
            if (isset($args['name'])) $args['slug'] = wp_unique_term_slug(sanitize_title($args['name']), (object) $new_term);
            
            if (!isset($GLOBALS['do_not_translate_terms']) || !is_array($GLOBALS['do_not_translate_terms'])) $GLOBALS['do_not_translate_terms'] = array();
            $GLOBALS['do_not_translate_terms'][] = array('term_id'=>$new_term_id);
            
            wp_update_term( $new_term_id, $new_term['taxonomy'], $args );


            foreach ($translate_list['meta_fields'] as $field)
            {
              $meta_value = get_term_meta( $term['term_id'], $field['name'], true );
              if (isset($meta_value) && check_field_for_translate($meta_value, $field))
              {
                update_term_meta( $new_term_id, $field['name'], get_translate_string($meta_value, $row['lng_from'], $row['lng_to']) );
              }  
            }

            $options_named = get_named_auto_translate_options($translate_list['carbon_fields']);
            foreach ($translate_list['carbon_fields'] as $field)
            {
              $carbon_field = carbon_get_term_meta( $term['term_id'], $field['name'] );
              if (check_field_for_translate($carbon_field, $field))
              {
                $result = get_carbon_translate($field['name'], $carbon_field, $row['lng_from'], $row['lng_to'], $options_named, $field['name']);
                
                $need_delete = (!$result['need_delete']) ? false : $need_delete;
                
                carbon_set_term_meta( $new_term_id, $field['name'], $result['value'] );
              }
            }
            
          } else $need_delete = false;
        }
      }
    }
  }
  
  return $need_delete;
}