<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'pages_options' );

function pages_options() {

    //Для главной страницы
    Container::make( 'post_meta', 1, 'Main page settings' )
		  ->where( 'post_template', '=', 'templates/main-page.php' )
      ->add_tab( 'Header', array(
        Field::make('text', 'section_1_title', 'Title')
        ->set_width( 40 ),
        Field::make('text', 'section_1_subtitle', 'Subtitle')
        ->set_width( 40 ),
        Field::make( 'image', 'section_1_image', 'Image' )
        ->set_width( 20 ),
        Field::make('rich_text', 'section_1_description', 'Description'),
        Field::make( 'text', 'section_1_rating', 'Rating' )
        ->set_width( 25 )
        ->set_attribute( 'min', '1' )
        ->set_attribute( 'max', '5' )
        ->set_attribute( 'step', '0.1' )
        ->set_attribute( 'type', 'number' ),
        Field::make('text', 'section_1_link_text', 'Link text')
        ->set_width( 25 ),
        Field::make('text', 'section_1_link_url', 'Link URL')
        ->set_width( 25 ),
        Field::make('text', 'section_1_button_text', 'Button text')
        ->set_width( 25 ),
      ))
      ->add_tab( 'Tour blocks', array(
        Field::make('text', 'currency_symbol', 'Сurrency symbol'),
        Field::make( 'complex', 'main_page_tours', 'Tours blocks' )
        ->set_layout( 'tabbed-vertical' )
        ->add_fields( array(
          Field::make('color', 'background', 'Background color')
          ->set_width( 20 ),
          Field::make('text', 'anchor', 'Anchor for internal links')
          ->set_width( 20 ),
          Field::make('text', 'title', 'Title')
          ->set_width( 33 ),
          Field::make( 'radio', 'underline', 'Do you want to underline the title?' )
          ->set_options( array(
            'y' => 'Yes',
            '' => 'No',
          ) )
          ->set_width( 26 )
          ->set_default_value( '' ),
          Field::make( 'rich_text', 'description', 'Description' ),
          Field::make( 'complex', 'tours', 'Tour cards' )
          ->set_layout( 'tabbed-horizontal' )
          ->add_fields( array(
            Field::make( 'checkbox', 'best_seller', 'Best seller' )
            ->set_width( 15 )
            ->set_option_value( 'yes' ),
            Field::make( 'checkbox', 'top_rated', 'Top_rated' )
            ->set_width( 15 )
            ->set_option_value( 'yes' ),
            Field::make('text', 'title', 'Title')
            ->set_width( 50 ),
            Field::make( 'image', 'image', 'Image' )
            ->set_width( 20 ),
            Field::make( 'text', 'rating', 'Rating' )
            ->set_width( 25 )
            ->set_attribute( 'min', '1' )
            ->set_attribute( 'max', '5' )
            ->set_attribute( 'step', '0.1' )
            ->set_attribute( 'type', 'number' ),
            Field::make( 'text', 'hours', 'Tour duration (hours)' )
            ->set_width( 25 )
            ->set_attribute( 'type', 'number' ),
            Field::make( 'text', 'bookings', 'Number of bookings' )
            ->set_width( 25 )
            ->set_attribute( 'type', 'number' ),
            Field::make( 'text', 'price', 'Price per persone' )
            ->set_width( 25 )
            ->set_attribute( 'type', 'number' ),
            Field::make( 'text', 'url', 'URL' ),
          )),
        )),
      ))
      ->add_tab( 'Text block with cards', array(
        Field::make('text', 'section_3_title', 'Title'),
        Field::make('rich_text', 'section_3_description', 'Description'),
        Field::make( 'complex', 'section_3_cards', 'Cards' )
        ->set_layout( 'tabbed-horizontal' )
        ->add_fields( array(
          Field::make('color', 'image_background', 'Image background color')
          ->set_width( 33 ),
          Field::make( 'image', 'image', 'Image' )
          ->set_width( 33 ),
          Field::make( 'text', 'title', 'Title' )
          ->set_width( 33 ),
          Field::make( 'rich_text', 'description', 'Description' ),
        )),
      ))
      ->add_tab( 'Text block with image', array(
        Field::make('text', 'section_4_title', 'Title')
        ->set_width( 50 ),
        Field::make( 'image', 'section_4_image', 'Image' )
        ->set_width( 50 ),
        Field::make('rich_text', 'section_4_description1', 'Description, large font'),
        Field::make('rich_text', 'section_4_description2', 'Description, small font'),
      ))
      ->add_tab( 'Text block with cards 2', array(
        Field::make('text', 'section_5_title', 'Title'),
        Field::make('rich_text', 'section_5_description', 'Description'),
        Field::make( 'complex', 'section_5_cards', 'Cards' )
        ->set_layout( 'tabbed-horizontal' )
        ->add_fields( array(
          Field::make('color', 'image_background', 'Image background color')
          ->set_width( 33 ),
          Field::make( 'image', 'image', 'Image' )
          ->set_width( 33 ),
          Field::make( 'text', 'title', 'Title' )
          ->set_width( 33 ),
          Field::make( 'rich_text', 'description', 'Description' ),
        )),
      ));

}
