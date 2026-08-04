<?php

add_action('wp_after_insert_post', 'auto_translate_for_insert_post', 10, 3 );

function auto_translate_for_insert_post($post_id, $post, $update) {
  global $wpdb;

  if (is_translated_post_type($post->post_type) && $post->post_status=='publish')
  {  
    $post_lng = get_post_language($post_id);
    $default_lng = get_default_language();
    $languages = get_languages_list();
    
    $translate_lists = get_translate_list();
    $translate_lists = $translate_lists['posts'];
    
    $post_auto_translate = carbon_get_post_meta($post_id, 'post_auto_translate');
    
    if (isset($translate_lists[$post->post_type]) && is_array($translate_lists[$post->post_type]) && $post_lng==$default_lng && $post_auto_translate=='1')
    {
      if ($translate_lists[$post->post_type]['translate_action']=='translate')
      {
        $translate_list = $translate_lists[$post->post_type];
        
        if (isset($translate_list['main_fields']) && is_array($translate_list['main_fields']))
        {
          foreach ($languages as $lng_to)
          {
            if ($lng_to!=$post_lng)
            {
              $strings = array();
              $associations = array();
            
              foreach ($translate_list['main_fields'] as $field)
              {
                $name = $field['name'];
                if (isset($post->$name) && check_field_for_translate($post->$name, $field)===true)
                {
                  $strings[] = save_translate_field($post->$name, $post_lng, $lng_to);
                }  
              }

              foreach ($translate_list['meta_fields'] as $field)
              {
                $name = $field['name'];
                $meta_field = get_post_meta( $post_id, $name, true );
                if (isset($meta_field) && check_field_for_translate($post->$name, $field)===true)
                {
                  if (is_string($meta_field)) $strings[] = save_translate_field($meta_field, $post_lng, $lng_to);
                }  
              }
              
              $options_named = get_named_auto_translate_options($translate_list['carbon_fields']);
              foreach ($translate_list['carbon_fields'] as $field)
              {
                if (strpos($field['name'], ' >> ')===false)
                {
                  $carbon_field = carbon_get_post_meta( $post_id, $field['name'] );

                  if (check_field_for_translate($carbon_field, $field))
                  {
                    $temp = save_any_carbon_field_for_translate($carbon_field, $post_lng, $lng_to, $options_named, $field['name']);
                    array_push($strings, ...$temp['strings']);
                    array_push($associations, ...$temp['association']);
                  }
                }
              }
              $strings = array_values(array_unique($strings));
              $associations = array_values(array_unique($associations));
              save_translate_entity($post_lng, $lng_to, $post_id, 'post', $strings, $associations);
            }
          }
                
        }
      } elseif ($translate_lists[$post->post_type]['translate_action']=='duplicate')
      {
        foreach ($languages as $lng_to)
        {
          if ($lng_to!=$post_lng)
          {
            save_translate_entity($post_lng, $lng_to, $post_id, 'post', array());
          }
        }
      }
    }
  }
}

function clone_post_for_translate($post, $lng_to, $title) {
global $wpdb;

  $new_post_id = get_language_post($post->ID, $lng_to);
  $new_post = (array) $post;
  
  if ($new_post_id==0 && function_exists('pll_get_post_translations'))
  {
		$taxonomies = get_object_taxonomies( $post->post_type ); // возвращает массив названий таксономий, используемых для указанного типа поста, например array("category", "post_tag");
    $new_post_terms = array();
    $translated_taxonomies = true;
		foreach ( $taxonomies as $taxonomy )
    {
			$post_terms = wp_get_object_terms( $post->ID, $taxonomy, array( 'fields' => 'ids' ) );
      
      if ($taxonomy!='language' && $taxonomy!='post_translations') //Эти таксономии уже прописаны выше
      {
        if (pll_is_translated_taxonomy($taxonomy))
        {
          $new_post_terms[$taxonomy] = array();
          foreach ($post_terms as $post_term)
          {
            $temp = intval(get_language_term($post_term, $lng_to));
            $new_post_terms[$taxonomy][] = $temp;
            if ($temp==0 || $temp==$post_term)
            {
              $translated_taxonomies = false;
              $args = get_term($post_term, $taxonomy, ARRAY_A);
              do_action( 'saved_term', $args['term_id'], $args['term_taxonomy_id'], $args['taxonomy'], true, $args );
            }
          }
        } else $new_post_terms[$taxonomy] = $post_terms;
      }
		}
   
    unset($new_post['ID']);
    unset($new_post['guid']);
    $new_post['post_title'] = $title;
    $new_post['post_status'] = 'draft';
    $new_post_id = wp_insert_post( $new_post, false, false );
    
    pll_set_post_language($new_post_id, $lng_to);
    
    $translations = pll_get_post_translations($post->ID);
    $translations[$lng_to] = $new_post_id;
    pll_save_post_translations($translations);

    if ($translated_taxonomies)
    {
      // присваиваем новому посту все элементы таксономий (рубрики, метки и т.д.) старого
      foreach ( $new_post_terms as $taxonomy=>$post_terms )
      {
        wp_set_object_terms( $new_post_id, $post_terms, $taxonomy, false );
      }
    }
   
  } elseif ($new_post_id!=0)
  {
    $translate_change_slugs = carbon_get_theme_option_lng('translate_change_slugs');
    if ($translate_change_slugs=='1')
    {
      $old_permalink = get_permalink($new_post_id);
      $new_post_data = get_post($new_post_id, ARRAY_A);

      $new_post_data['post_title'] = sanitize_text_field($title);
      $new_post_data['post_name'] = sanitize_title($title, $post->post_title);
      $new_post_id = wp_insert_post( $new_post_data, false, false );
      $new_permalink = get_permalink($new_post_id);
      
      if ( class_exists( 'Red_Item' ) && $new_permalink!=$old_permalink)
      {
        $redirect_data = [
          'url'         => $old_permalink,
          'action_data' => [ 'url' => get_permalink($new_post_id) ],
          'action_type' => 'url',
          'match_type'  => 'url',
          'group_id'    => 1,
          'enabled'     => true,
        ];
        $redirect_id = Red_Item::create( $redirect_data );
      }
    }
    
    /*$new_post_data = get_post($new_post_id);
    $old_permalink = get_permalink($new_post_id);
    if (strpos($new_post_data->post_name, preg_replace('/-\d+$/', '', $post->post_name))!==false)
    {
      $new_post = array(
        'ID' => $new_post_id,
        'post_title' => $title,
        'post_name' => sanitize_title($title, $post->post_title),
      );
      $new_post_id = wp_insert_post( $new_post, false, false );
      
      if ( class_exists( 'Red_Options' ) && class_exists( 'Red_Monitor' ) )
      {
        $redirection_monitor = new Red_Monitor( Red_Options::get() );
        $redirection_monitor->check_for_modified_slug( $new_post_id, $old_permalink );
      }
    }*/
    
    $wpdb->delete( $wpdb->postmeta, [ 'post_id'=>$new_post_id ] );
    clean_post_cache( $new_post_id );
  }
  
  if ($new_post_id!=0)
  {
    // дублируем все произвольные поля
    $post_meta = get_post_meta( $post->ID );
    if( $post_meta )
    {
      foreach ( $post_meta as $meta_key => $meta_values ) {
        if( '_wp_old_slug' == $meta_key )
        { // это лучше не трогать
          continue;
        }
        foreach ( $meta_values as $meta_value )
        {
          add_post_meta( $new_post_id, $meta_key, maybe_unserialize($meta_value) );
        }
      }
    }
  }
  
  return $new_post_id;
}

function final_translate_post($translate_lists, $row, $languages) {

  $need_delete = true;
  
  $post = get_post(intval($row['entity_id']));
  if (!is_null($post) && is_translated_post_type($post->post_type))
  {
    if (isset($translate_lists['posts'][$post->post_type]) && is_array($translate_lists['posts'][$post->post_type])
     && in_array($row['lng_from'], $languages)==true && in_array($row['lng_to'], $languages)==true)
    {
      $translate_list = $translate_lists['posts'][$post->post_type];

      if (isset($translate_list['main_fields']) && is_array($translate_list['main_fields']))
      {
        $check = check_translate_entity($row);
        
        if ($check===false) $need_delete = false;
        else
        {
          $new_post_terms = array();
          foreach ($translate_lists['terms'] as $taxonomy=>$values)
          {
            $post_terms = wp_get_object_terms( $post->ID, $taxonomy );
            
            foreach ($post_terms as $post_term)
            {
              $temp = intval(get_language_term($post_term->term_id, $row['lng_to']));
              if ($temp!=0)
              {
                $new_post_terms[] = $temp;
              } else
              {
                $need_delete = false;
                break 2;
              }
            }
          }
          
          $title = get_translate_string($post->post_title, $row['lng_from'], $row['lng_to']);
          $new_post_id = clone_post_for_translate($post, $row['lng_to'], $title);
          if ($new_post_id!=0)
          {
            $new_post = get_post($new_post_id, ARRAY_A);

            foreach ($translate_list['meta_fields'] as $field)
            {
              $meta_value = get_post_meta( $post->ID, $field['name'], true );
              if (isset($meta_value) && check_field_for_translate($meta_value, $field))
              {
                update_post_meta( $new_post_id, $field['name'], get_translate_string($meta_value, $row['lng_from'], $row['lng_to']) );
              }  
            }

            $options_named = get_named_auto_translate_options($translate_list['carbon_fields']);
            foreach ($translate_list['carbon_fields'] as $field)
            {
              $carbon_field = carbon_get_post_meta( $post->ID, $field['name'] );
              if (check_field_for_translate($carbon_field, $field))
              {
                $result = get_carbon_translate($field['name'], $carbon_field, $row['lng_from'], $row['lng_to'], $options_named, $field['name']);
                
                $need_delete = (!$result['need_delete']) ? false : $need_delete;
                
                //if (is_string($carbon_field)) $carbon_field = get_translate_string($carbon_field, $row['lng_from'], $row['lng_to']);
                //elseif (is_array($carbon_field)) $carbon_field = get_carbon_wpapper_translate($carbon_field, $row['lng_from'], $row['lng_to'] );
                
                carbon_set_post_meta( $new_post_id, $field['name'], $result['value'] );
              }
            }

            $args = $new_post;
            foreach ($translate_list['main_fields'] as $field)
            {
              $name = $field['name'];
              if (isset($post->$name) && check_field_for_translate($post->$name, $field))
              {
                $args[$name] = get_translate_string($post->$name, $row['lng_from'], $row['lng_to']);
              }  
            }
            $post_status = $translate_lists['posts'][$post->post_type]['translated_post_status'];
            $args['post_status'] = ($post_status=='as original') ? $post->post_status : $post_status;
            //$args['post_status'] = 'publish';
            
            $new_post_id = wp_insert_post( wp_slash($args), false, false );

            if ($new_post_id!=0)
            {
              foreach ($translate_lists['terms'] as $taxonomy=>$values)
              {
                wp_set_object_terms( $new_post_id, $new_post_terms, $taxonomy, false );
              }
            }

          } else $need_delete = false;
        }       
      }  
    }
  }
  
  return $need_delete;
}