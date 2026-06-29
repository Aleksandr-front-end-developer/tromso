<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', 'mainmenu_theme_options');
function mainmenu_theme_options()
{
  $tarnslate_error = get_option( 'last_translate_error', '' );
  
  $untranslated_count = ( function_exists( 'get_untranslated_entities_count' ) ) ? get_untranslated_entities_count() : null;
  
  $entities_count = ( !is_null($untranslated_count) ) ? $untranslated_count['entities'] : 0;
  $fragments_count = ( !is_null($untranslated_count) ) ? $untranslated_count['fragments'] : 0;

  $identical_count = get_identical_translates_count();
  $all_count = get_all_translates_count();
  
  $lang = carbon_lang_prefix();
  $lang_str = carbon_lang_prefix(true);


	$basic_options_container = Container::make('theme_options', 'site_settings', 'Site settings')

		->set_page_menu_title('Site settings')

		->add_tab('Social links', array(
      Field::make( 'complex', 'social_links' . $lang, 'Social links' . $lang_str )
      ->set_layout( 'tabbed-horizontal' )
      ->set_autoload(true)
      ->add_fields( array(
        Field::make('text', 'name', 'Name')
        ->set_width( 50 )
        ->set_autoload(true),
        Field::make( 'text', 'icon_index', 'Icon index' )
        ->set_width( 50 )
        ->set_autoload(true),
        Field::make('text', 'link', 'Link')
        ->set_autoload(true),
      ))
		))

		->add_tab('Header/footer', array(
      Field::make( 'textarea', 'header_add' . $lang, 'Additional code for display in the website header, for example, counters' . $lang_str )
      ->set_autoload(true),
      Field::make( 'textarea', 'footer_add' . $lang, 'Additional code for display in the website footer, for example, JS-code' . $lang_str )
      ->set_autoload(true),
			Field::make('text', 'column_1_title' . $lang, 'Column 1 title' . $lang_str)
      ->set_autoload(true),
			Field::make('rich_text', 'footer_description' . $lang, 'Footer description' . $lang_str)
      ->set_autoload(true),
			Field::make('text', 'column_2_title' . $lang, 'Column 2 title' . $lang_str)
      ->set_autoload(true),
			Field::make('text', 'column_2_address' . $lang, 'Column 2 address' . $lang_str)
      ->set_width( 50 )
      ->set_autoload(true),
			Field::make('text', 'column_2_phone' . $lang, 'Column 2 phone' . $lang_str)
      ->set_width( 50 )
      ->set_autoload(true),
			Field::make('text', 'column_2_email' . $lang, 'Column 2 email' . $lang_str)
      ->set_autoload(true),
			Field::make('text', 'column_3_title' . $lang, 'Column 3 title' . $lang_str)
      ->set_autoload(true),
			Field::make('text', 'column_4_title' . $lang, 'Column 4 title' . $lang_str)
      ->set_autoload(true),
			Field::make('text', 'column_4_contact_form' . $lang, 'Column 4 contact form shortcode' . $lang_str)
      ->set_autoload(true),
			Field::make('text', 'copyright_text' . $lang, 'Copyright text (%current_year% will be replaced' . $lang_str)
      ->set_autoload(true),
		));
  
  $buttons = array();
  if ($lang=='')
  {  
    $buttons = array(
      // HTML-поле для кнопки и прелоадера "Найти все поля, типы постов и карегорий"
      Field::make('html', 'crb_translate_find_all_ajax_button')
      ->set_width( 50 )
      ->set_html('    <div class="crb-ajax-wrapper">
        <button type="button" id="translate_find_all_ajax_button" class="button button-secondary">
            <span class="button-text">Fill all fields, post types, and categories (for developers only)</span>
            <span class="spinner" style="display: none; float: none; margin-top: 0;"></span>
        </button>
        <p>Automatically searches for fields and populates them in the settings. This operation is only necessary once during initial setup.</p>
    </div>'),
      Field::make('html', 'crb_translate_find_all_dynamic_content')
      ->set_width( 50 )
      ->set_html('<span id="translate_find_all_dynamic_content"></span>'),

      // HTML-поле для кнопки и прелоадера "экспорт настроек"
      Field::make('html', 'crb_translate_settings_import_export_ajax_buttons')
      ->set_width( 50 )
      ->set_html('    <div class="crb-ajax-wrapper">
        <button type="button" id="translate_settings_export_ajax_button" class="button button-primary">
            <span class="button-text">Auto translate settings EXPORT</span>
            <span class="spinner" style="display: none; float: none; margin-top: 0;"></span>
        </button>
        <input type="file" id="translate_settings_import_ajax_file" style="display:none" accept="application/json">
        <button type="button" id="translate_settings_import_ajax_button" class="button button-secondary">
            <span class="button-text">Auto translate settings IMPORT (for developers only)</span>
            <span class="spinner" style="display: none; float: none; margin-top: 0;"></span>
        </button>
        <p>Import/export translation settings for transfer to other websites.</p>
    </div>'),
      Field::make('html', 'crb_translate_settings_import_export_dynamic_content')
      ->set_width( 50 )
      ->set_html('<span id="translate_settings_import_export_dynamic_content"></span>'),

      // HTML-поле для кнопки и прелоадера "импорт настроек"
      /*Field::make('html', 'crb_translate_settings_import_ajax_button')
      ->set_width( 50 )
      ->set_html('    <div class="crb-ajax-wrapper">
    </div>'),
      Field::make('html', 'crb_translate_settings_import_dynamic_content')
      ->set_width( 50 )
      ->set_html('<span id="translate_settings_import_dynamic_content"></span>'),*/

      // HTML-поле для кнопок очистки кэша переводов
      Field::make('html', 'crb_translate_cache_ajax_buttons')
      ->set_width( 50 )
      ->set_html('    <div class="crb-ajax-wrapper">
        <button type="button" id="translate_cache_ajax_button" class="button button-primary">
            <span class="button-text">Clear cached identical translations ('.$identical_count.')</span>
            <span class="spinner" style="display: none; float: none; margin-top: 0;"></span>
        </button>
        <button type="button" id="translate_cache_clear_all_ajax_button" class="button button-secondary">
            <span class="button-text">Clear all translate cache ('.$all_count.')</span>
            <span class="spinner" style="display: none; float: none; margin-top: 0;"></span>
        </button>
        <p>
          First button deletes cached texts that AI returned unchanged. Second button clear all translate cache.
          <strong style="color:red">
            This operation will significantly increase your costs for text translation, use it only when absolutely necessary.
          </strong>
          After clearing the cache, you need to resubmit the required posts or the entire site for translation.
        </p>
        <p>
          <strong style="color:red">
            Both cache clearing operations reset ALL current translation tasks.
          </strong>
        </p>
    </div>'),
      Field::make('html', 'crb_translate_cache_dynamic_content')
      ->set_width( 50 )
      ->set_html('<span id="translate_cache_dynamic_content"></span>'),

      // HTML-поле для кнопки и прелоадера "Перевести всё"
      Field::make('html', 'crb_translate_all_ajax_button')
      ->set_width( 50 )
      ->set_html('    <div class="crb-ajax-wrapper">
        <button type="button" id="translate_all_ajax_button" class="button button-primary">
            <span class="button-text">Translate the entire website</span>
            <span class="spinner" style="display: none; float: none; margin-top: 0;"></span>
        </button>
    </div>'),
      Field::make('html', 'crb_translate_all_dynamic_content')
      ->set_width( 50 )
      ->set_html('<span id="translate_all_dynamic_content"></span>'),
      
      Field::make('html', 'crb_untranslated_entities_count')
      ->set_html('<span id="untranslated_entities_count" style="color:blue">Untranslated entities (posts, options, etc.) count: <strong>'.$entities_count.'</strong><br>Untranslated text fragments count: <strong>'.$fragments_count.'</strong></span>'),
    );
  }  
    
	Container::make('theme_options', 'site_settings_auto_translate', 'Auto translate')
    ->set_page_parent( $basic_options_container )

		->add_tab('Common options', array_merge($buttons, array(
      Field::make( 'text', 'translate_chat_gpt_key' . $lang, 'Chat GPT API key' . $lang_str )
      ->set_autoload(true),
      Field::make( 'text', 'translate_chat_gpt_model' . $lang, 'Chat GPT model ("gpt-4" for example)' . $lang_str )
      ->set_autoload(true),
      Field::make( 'radio', 'translate_as' . $lang, 'Transate as' . $lang_str )
      ->set_options( array(
        'html' => 'html',
        'text' => 'text',
      ) )
      ->set_width( 50 )
      ->set_default_value( 'text' )
      ->set_autoload(true),
      Field::make( 'text', 'translate_chat_gpt_text_symbols_qty' . $lang, 'Maximum number of characters in the request text (excluding instructions)' . $lang_str )
      ->set_attribute( 'type', 'number' )
      ->set_width( 50 )
      ->set_conditional_logic( array(
          'relation' => 'AND',
          array(
              'field' => 'translate_as',
              'value' => 'text',
              'compare' => '=',
          )
      ) )
      ->set_default_value( 500 )
      ->set_autoload(true),
      Field::make( 'textarea', 'translate_chat_gpt_message' . $lang, 'Chat GPT prompt (%src_lng% - source language, %dest_lng% - translate language)' . $lang_str )
      ->set_conditional_logic( array(
          'relation' => 'AND',
          array(
              'field' => 'translate_as',
              'value' => 'text',
              'compare' => '=',
          )
      ) )
      ->set_autoload(true),
      Field::make( 'textarea', 'translate_chat_gpt_message_html' . $lang, 'Chat GPT prompt for HTML (%src_lng% - source language, %dest_lng% - translate language)' . $lang_str )
      ->set_conditional_logic( array(
          'relation' => 'AND',
          array(
              'field' => 'translate_as',
              'value' => 'html',
              'compare' => '=',
          )
      ) )
      ->set_autoload(true),
      Field::make( 'html', 'translate_chat_gpt_error_information_text' . $lang )
      ->set_html( '<h2><strong>Last error requesting CHAT GPT:</strong></h2><p style="color:red">'.$tarnslate_error.'</p>' ),
    )))
    
    ->add_tab('Theme static', array(
      Field::make( 'complex', 'auto_translate_theme_static_strings' . $lang, 'Auto translate theme static strings' . $lang_str )
      ->set_layout( 'tabbed-horizontal' )
      ->set_autoload(true)
      ->add_fields( array(
        Field::make('text', 'text_domain', 'Text domain')
        ->set_autoload(true)
        ->set_width( 50 ),
        Field::make( 'radio', 'translate_action', 'Action during translation' )
        ->set_width( 50 )
        ->set_autoload(true)
        ->set_options( array(
          'translate' => 'translate',
          'duplicate' => 'duplicate',
        ) )
        ->set_default_value( 'duplicate' ),
      ))
    ))
    
    ->add_tab('Carbon theme options', array(
      Field::make( 'complex', 'auto_translate_carbon_theme_options' . $lang, 'Auto translate carbon theme options' . $lang_str )
      ->set_layout( 'grid' )
      ->set_autoload(true)
      ->add_fields( array(
        Field::make('text', 'name', 'Field name')
        ->set_autoload(true)
        ->set_width( 50 ),
        Field::make('text', 'field_type', 'Field type')
        ->set_autoload(true)
        ->set_width( 20 ),
        Field::make( 'radio', 'translate_action', 'Action during translation' )
        ->set_autoload(true)
        ->set_width( 30 )
        ->set_options( array(
          'translate' => 'translate',
          'duplicate' => 'duplicate',
          'do not transfer field values' => 'do not transfer field values',
        ) )
        ->set_default_value( 'do not transfer field values' ),
      )),
		))

    ->add_tab('Menus', array(
      Field::make( 'radio', 'auto_translate_menus_translate_action' . $lang, 'Action during translation' . $lang_str )
      ->set_options( array(
        'translate' => 'translate',
        'duplicate' => 'duplicate',
      ) )
      ->set_autoload(true)
      ->set_default_value( 'duplicate' ),
    ))
    
    ->add_tab('Post types', array(
      Field::make( 'complex', 'auto_translate_post_types' . $lang, 'Auto translate post types' . $lang_str )
      ->set_layout( 'tabbed-horizontal' )
      ->set_autoload(true)
      ->add_fields( array(
        Field::make('text', 'post_type', 'Post type')
        ->set_autoload(true)
        ->set_width( 50 ),
        Field::make( 'radio', 'translate_action', 'Action during translation' )
        ->set_autoload(true)
        ->set_width( 25 )
        ->set_options( array(
          'translate' => 'translate',
          'duplicate' => 'duplicate',
        ) )
        ->set_default_value( 'duplicate' ),
        Field::make( 'radio', 'translated_post_status', 'Translated post status' )
        ->set_autoload(true)
        ->set_width( 25 )
        ->set_options( array(
          'as original' => 'as original',
          'draft' => 'draft',
          'publish' => 'publish',
        ) )
        ->set_default_value( 'as original' ),
        Field::make( 'complex', 'main_fields', 'Main fields' )
        ->set_layout( 'grid' )
        ->set_autoload(true)
        ->add_fields( array(
          Field::make('text', 'name', 'Field name')
          ->set_autoload(true)
          ->set_width( 50 ),
          Field::make( 'radio', 'translate_action', 'Action during translation' )
          ->set_width( 50 )
          ->set_autoload(true)
          ->set_options( array(
            'translate' => 'translate',
            'duplicate' => 'duplicate',
          ) )
          ->set_default_value( 'duplicate' )
        )),
        Field::make( 'complex', 'meta_fields', 'Meta fields' )
        ->set_layout( 'grid' )
        ->set_autoload(true)
        ->add_fields( array(
          Field::make('text', 'name', 'Field name')
          ->set_autoload(true)
          ->set_width( 50 ),
          Field::make( 'radio', 'translate_action', 'Action during translation' )
          ->set_autoload(true)
          ->set_width( 50 )
          ->set_options( array(
            'translate' => 'translate',
            'duplicate' => 'duplicate',
          ) )
          ->set_default_value( 'duplicate' )
        )),
        Field::make( 'complex', 'carbon_fields', 'Carbon fields' )
        ->set_layout( 'grid' )
        ->set_autoload(true)
        ->add_fields( array(
          Field::make('text', 'name', 'Field name')
          ->set_autoload(true)
          ->set_width( 50 ),
          Field::make('text', 'field_type', 'Field type')
          ->set_autoload(true)
          ->set_width( 20 ),
          Field::make( 'radio', 'translate_action', 'Action during translation' )
          ->set_autoload(true)
          ->set_width( 30 )
          ->set_options( array(
            'translate' => 'translate',
            'duplicate' => 'duplicate',
            'do not transfer field values' => 'do not transfer field values',
          ) )
          ->set_default_value( 'do not transfer field values' )
        )),
      )),
    ))
    
    ->add_tab('Taxonomies', array(
      Field::make( 'complex', 'auto_translate_taxonomies' . $lang, 'Auto translate taxonomies' . $lang_str )
      ->set_layout( 'tabbed-horizontal' )
      ->set_autoload(true)
      ->add_fields( array(
        Field::make('text', 'tax', 'Taxonomy slug')
        ->set_autoload(true)
        ->set_width( 50 ),
        Field::make( 'radio', 'translate_action', 'Action during translation' )
        ->set_autoload(true)
        ->set_width( 50 )
        ->set_options( array(
          'translate' => 'translate',
          'duplicate' => 'duplicate',
        ) )
        ->set_default_value( 'duplicate' ),
        Field::make( 'complex', 'main_fields', 'Main fields' )
        ->set_autoload(true)
        ->set_layout( 'grid' )
        ->add_fields( array(
          Field::make('text', 'name', 'Field name')
          ->set_autoload(true)
          ->set_width( 50 ),
          Field::make( 'radio', 'translate_action', 'Action during translation' )
          ->set_autoload(true)
          ->set_width( 50 )
          ->set_options( array(
            'translate' => 'translate',
            'duplicate' => 'duplicate',
          ) )
          ->set_default_value( 'duplicate' )
        )),
        Field::make( 'complex', 'meta_fields', 'Meta fields' )
        ->set_autoload(true)
        ->set_layout( 'grid' )
        ->add_fields( array(
          Field::make('text', 'name', 'Field name')
          ->set_autoload(true)
          ->set_width( 50 ),
          Field::make( 'radio', 'translate_action', 'Action during translation' )
          ->set_autoload(true)
          ->set_width( 50 )
          ->set_options( array(
            'translate' => 'translate',
            'duplicate' => 'duplicate',
          ) )
          ->set_default_value( 'duplicate' )
        )),
        Field::make( 'complex', 'carbon_fields', 'Carbon fields' )
        ->set_autoload(true)
        ->set_layout( 'grid' )
        ->add_fields( array(
          Field::make('text', 'name', 'Field name')
          ->set_autoload(true)
          ->set_width( 50 ),
          Field::make( 'radio', 'translate_action', 'Action during translation' )
          ->set_autoload(true)
          ->set_width( 50 )
          ->set_options( array(
            'translate' => 'translate',
            'duplicate' => 'duplicate',
          ) )
          ->set_default_value( 'duplicate' )
        )),
      )),
    ));
}
