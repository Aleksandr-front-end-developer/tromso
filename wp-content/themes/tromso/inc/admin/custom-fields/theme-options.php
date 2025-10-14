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
        Field::make( 'text', 'abbreviation', 'Abbreviation' )
        ->set_width( 50 )
        ->set_autoload(true),
        Field::make('text', 'link', 'Link')
        ->set_width( 50 )
        ->set_autoload(true),
        Field::make('text', 'color_classes', 'Color classes')
        ->set_width( 50 )
        ->set_autoload(true),
      ))
		))

		->add_tab('Header/footer', array(

			Field::make('textarea', 'logo_svg', 'Custom logo SVG picture')
      ->set_autoload(true),
			Field::make('text', 'logo_text', 'Logo text')
      ->set_autoload(true),
			Field::make('rich_text', 'description_after_logo', 'Description after logo')
      ->set_autoload(true),
			Field::make('text', 'copyright_text', 'Copyright text (%current_year% will be replaced')
      ->set_autoload(true),
			Field::make('text', 'last_column_title', 'Last column title')
      ->set_autoload(true),
			Field::make('text', 'footer_phone', 'Contact phone')
      ->set_width( 50 )
      ->set_autoload(true),
      Field::make( 'text', 'footer_email', 'Contact email' )
      ->set_width( 50 )
      ->set_autoload(true),
		));
}
