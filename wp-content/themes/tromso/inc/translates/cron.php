<?php

use mlcf7pll\Helpers;

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_filter( 'cron_schedules', 'cron_add_one_min' );

function cron_add_one_min( $schedules ) {
	$schedules['one_min'] = array(
		'interval' => 60,
		'display'  => 'Every minute'
	);
	return $schedules;
}

add_filter( 'cron_schedules', 'cron_add_five_min' );

function cron_add_five_min( $schedules ) {
	$schedules['five_min'] = array(
		'interval' => 300,
		'display'  => 'Every 5 minute'
	);
	return $schedules;
}

add_action( 'chat_gpt_translate', 'do_chat_gpt_translate' );

if( ! wp_next_scheduled( 'chat_gpt_translate' ) )
{
  wp_schedule_event( time(), 'one_min', 'chat_gpt_translate');
}

function do_chat_gpt_translate() {
  global $wpdb;

  $key = carbon_get_theme_option_lng('translate_chat_gpt_key');
  $model = carbon_get_theme_option_lng('translate_chat_gpt_model');
  $translate_as = carbon_get_theme_option_lng('translate_as');


  $message = ($translate_as=='text') ? carbon_get_theme_option_lng('translate_chat_gpt_message') : carbon_get_theme_option_lng('translate_chat_gpt_message_html');

  $languages = get_languages_list_full();

  if (count($languages)>0 && $key!='' && $model!='' && $message!='')
  {
    //Обработка новых фрагментов
    $sql = $wpdb->prepare( "SELECT * FROM ".TRANSLATE_FRAGMENTS_TABLE." WHERE translated='%d' LIMIT 5", 0 );
    $rows = $wpdb->get_results($sql, ARRAY_A);
    if (count($rows)>0)
    {
      foreach ($rows as $row)
      {
        $wpdb->update( TRANSLATE_FRAGMENTS_TABLE, array( 'translated' => 2, 'updated_ts' => time() ), array( 'id' => $row['id'] ) );
        if (is_string($row['source_text']) && ((bool) preg_match('/[\p{L}]/u', $row['source_text']))===true)
        {
          $final_message = $message;
          foreach ($languages as $language)
          {
            if ($row['lng_from']==$language->slug) $final_message = mb_ereg_replace('%src_lng%', $language->name, $final_message); 
            if ($row['lng_to']==$language->slug) $final_message = mb_ereg_replace('%dest_lng%', $language->name, $final_message); 
          }
          if (mb_strpos($final_message, '%src_lng%')===false && mb_strpos($final_message, '%dest_lng%')===false)
          {
            $data = [
              "model" => $model,
              "input" => $final_message."\n\n".$row['source_text'],
              "background" => true,
              "text" => [
                "format" => [
                  "type" => "json_schema",
                  "name" => "text_translate",
                  "strict" => true,
                  "schema" => [
                    "type" => "object",
                    "properties" => [
                      "translated_text" => [
                        "type" => "string",
                        "description" => "Переведённый текст, согласно заданию"
                      ]
                    ],
                    "required" => ["translated_text"],
                    "additionalProperties" => false
                  ]
                ]
              ],
            ];

            $response = wp_remote_post(CHAT_GPT_API_URL, array(
              'body' => json_encode($data),
              'headers' => array(
                "Content-Type" => "application/json",
                "Authorization" => "Bearer ".$key,
              ),
              'timeout' => 30,
            ));

            if ( !is_wp_error( $response ) )
            {
              $body = json_decode(wp_remote_retrieve_body( $response ), true);
              if (isset($body['object']) && $body['object']=='response' && isset($body['status']) && $body['status']=='queued' && isset($body['id']))
              {
                $wpdb->update( TRANSLATE_FRAGMENTS_TABLE, array( 'translated' => 3, 'updated_ts' => time(), 'resp_id' => $body['id'] ), array( 'id' => $row['id'] ) );
              }

              if (is_array($body) && isset($body['error']) && isset($body['error']['message']))
              {
                $updated = update_option( 'last_translate_error', wp_date('d.m.Y H:i') . ' - ' . $body['error']['message'], true );
              }
            }
          }
        } else
        {
          $wpdb->update( TRANSLATE_FRAGMENTS_TABLE, array( 'translate' => $row['source_text'], 'translated' => 1 ), array( 'id' => $row['id'] ) );
        }
      }
    }

    //Обработка ответов GPT
    $sql = $wpdb->prepare( "SELECT * FROM ".TRANSLATE_FRAGMENTS_TABLE." WHERE translated='%d' AND resp_id IS NOT NULL", 3 );
    $rows = $wpdb->get_results($sql, ARRAY_A);
    if (count($rows)>0)
    {
      foreach ($rows as $row)
      {
        $response = wp_remote_get(CHAT_GPT_API_URL.'/'.$row['resp_id'], array(
          'headers' => array(
            "Content-Type" => "application/json",
            "Authorization" => "Bearer ".$key,
          ),
          'timeout' => 30,
        ));

        if ( !is_wp_error( $response ) )
        {
          $body = json_decode(wp_remote_retrieve_body( $response ), true);
          if (isset($body['object']) && $body['object']=='response' && isset($body['status']) && $body['status']=='completed' && isset($body['id']))
          {
            if (isset($body['output'][0]['content'][0]['text']))
            {
              $output = json_decode($body['output'][0]['content'][0]['text'], true);
              
              if (is_array($output) && isset($output['translated_text']))
              {
                $wpdb->update( TRANSLATE_FRAGMENTS_TABLE, array( 'translate' => $output['translated_text'], 'translated' => 1 ), array( 'id' => $row['id'] ) );
              }
            }
          }
                
          if (is_array($body) && isset($body['error']) && isset($body['error']['message']))
          {
            $updated = update_option( 'last_translate_error', wp_date('d.m.Y H:i') . ' - ' . $body['error']['message'], true );
          }
        }
      }
    }
    
    //Обработка зависших фрагментов
    $sql = $wpdb->prepare( "UPDATE ".TRANSLATE_FRAGMENTS_TABLE." SET translated='0'  WHERE (translated='2' OR translated='3') AND updated_ts<'%d'", time()-1200 );
    $wpdb->query($sql);
  }
}


add_action( 'final_doing_after_translate', 'do_final_doing_after_translate' );

if( ! wp_next_scheduled( 'final_doing_after_translate' ) )
{
  wp_schedule_event( time(), 'five_min', 'final_doing_after_translate');
}

function do_final_doing_after_translate() {
  global $wpdb;
  
  kses_remove_filters();
  
  $rows = $wpdb->get_results("SELECT * FROM ".TRANSLATE_ENTITIES_TABLE ." ORDER BY FIELD(entity_type, 'theme_carbon', 'theme_static', 'term', 'post', 'menu'), id", ARRAY_A);
  
  //Инициализация String Translations полилэнга, TTFP и переводов CF7
  $ptt = new Polylang_Theme_Translation();
  $ptt->run();

  if (class_exists('mlcf7pll\admin\String_Registration'))
  {
    $sr = new mlcf7pll\admin\String_Registration();
    $sr->register_strings();
  }

  $strings = PLL_Admin_Strings::get_strings();

  
  if (is_array($rows))
  {
    $languages = get_languages_list();
    $translate_lists = get_translate_list();
    
    foreach ($rows as $row)
    {
      if ($row['entity_type']=='theme_static')
      {
        $need_delete = final_translate_polylang_string($translate_lists, $row, $languages, $strings);
      }
      
      
      elseif ($row['entity_type']=='theme_carbon')
      {
        $need_delete = final_translate_theme_carbon_field($translate_lists, $row, $languages);
      }
      
      
      elseif ($row['entity_type']=='post')
      {
        $need_delete = final_translate_post($translate_lists, $row, $languages);
      }
      
      
      elseif ($row['entity_type']=='term')
      {
        $need_delete = final_translate_term($translate_lists, $row, $languages);
      }

      elseif ($row['entity_type']=='menu')
      {
        $need_delete = final_translate_menu($translate_lists, $row, $languages);
      }
      
      if ($need_delete===true)
      {
        $wpdb->delete( TRANSLATE_ENTITIES_TABLE, array( 'id' => $row['id'] ), array( '%d' ) );
      }
    }
  }
  
  kses_init_filters();
}
