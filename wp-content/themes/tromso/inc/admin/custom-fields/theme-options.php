<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', 'mainmenu_theme_options');
function mainmenu_theme_options()
{
	Container::make('theme_options', 'Site settings')

		->set_page_menu_title('Site settings')

		->add_tab('Social links', array(
      Field::make( 'complex', 'social_links' )
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

			Field::make('text', 'column_1_title', 'Column 1 title')
      ->set_autoload(true),
			Field::make('rich_text', 'footer_description', 'Footer description')
      ->set_autoload(true),
			Field::make('text', 'column_2_title', 'Column 2 title')
      ->set_autoload(true),
			Field::make('text', 'column_2_address', 'Column 2 address')
      ->set_width( 50 )
      ->set_autoload(true),
			Field::make('text', 'column_2_phone', 'Column 2 phone')
      ->set_width( 50 )
      ->set_autoload(true),
			Field::make('text', 'column_2_email', 'Column 2 email')
      ->set_autoload(true),
			Field::make('text', 'column_3_title', 'Column 3 title')
      ->set_autoload(true),
			Field::make('text', 'column_4_title', 'Column 4 title')
      ->set_autoload(true),
			Field::make('text', 'column_4_contact_form', 'Column 4 contact form shortcode')
      ->set_autoload(true),
			Field::make('text', 'copyright_text', 'Copyright text (%current_year% will be replaced')
      ->set_autoload(true),
		));
}
