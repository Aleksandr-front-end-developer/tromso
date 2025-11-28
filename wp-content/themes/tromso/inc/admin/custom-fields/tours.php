<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'tours_options' );

function tours_options() {

    Container::make( 'post_meta', 'Tour settings' )
		  ->where( 'post_type', '=', 'tours' )
      ->add_tab( 'General', array(
        Field::make( 'text', 'tour_rating', 'Rating' )
        ->set_width( 20 )
        ->set_attribute( 'min', '1' )
        ->set_attribute( 'max', '5' )
        ->set_attribute( 'step', '0.1' )
        ->set_attribute( 'type', 'number' ),
        Field::make( 'text', 'tour_hours', 'Tour duration (hours)' )
        ->set_width( 20 )
        ->set_attribute( 'type', 'number' ),
        Field::make( 'text', 'tour_bookings', 'Number of bookings' )
        ->set_width( 20 )
        ->set_attribute( 'type', 'number' ),
        Field::make( 'text', 'tour_price', 'Price per persone' )
        ->set_width( 20 )
        ->set_attribute( 'type', 'number' ),
        Field::make( 'text', 'tour_currency', 'Currency symbol' )
        ->set_default_value( '$' )
        ->set_width( 20 ),
        Field::make( 'text', 'tour_url', 'URL' ),
      ))
      ->add_tab( 'Overview', array(
        Field::make('checkbox', 'tours_do_not_show1', 'Do not show?')
        ->set_option_value( 'yes' ),
        Field::make('text', 'tour_section_1_title', 'Title')
        ->set_default_value( 'Overview' ),
        Field::make('rich_text', 'tour_section_1_description', 'Description'),
        Field::make( 'complex', 'tour_section_1_list', 'List' )
        ->set_layout( 'tabbed-vertical' )
        ->add_fields( array(
          Field::make( 'rich_text', 'list_item', 'List item' ),
        )),
      ))
      ->add_tab( 'What\'s Included', array(
        Field::make('checkbox', 'tours_do_not_show2', 'Do not show?')
        ->set_option_value( 'yes' ),
        Field::make('text', 'tour_section_2_title', 'Title')
        ->set_default_value( 'What\'s Included' ),
        Field::make( 'complex', 'tour_section_2_included', 'Included' )
        ->set_layout( 'tabbed-vertical' )
        ->add_fields( array(
          Field::make( 'text', 'list_item', 'List item' ),
        )),
        Field::make( 'complex', 'tour_section_2_excluded', 'Excluded' )
        ->set_layout( 'tabbed-vertical' )
        ->add_fields( array(
          Field::make( 'text', 'list_item', 'List item' ),
        )),
      ))
      ->add_tab( 'Itinerary', array(
        Field::make('checkbox', 'tours_do_not_show3', 'Do not show?')
        ->set_option_value( 'yes' ),
        Field::make('text', 'tour_section_3_title', 'Title')
        ->set_default_value( 'Itinerary' ),
        Field::make('rich_text', 'tour_section_3_description', 'Description'),
        Field::make( 'complex', 'tour_section_3_list', 'List' )
        ->set_layout( 'tabbed-vertical' )
        ->add_fields( array(
          Field::make( 'rich_text', 'list_item', 'List item' ),
        )),
      ))
      ->add_tab( 'Text block', array(
        Field::make('checkbox', 'tours_do_not_show4', 'Do not show?')
        ->set_option_value( 'yes' ),
        Field::make('rich_text', 'tour_section_4_description', 'Text'),
      ))
      ->add_tab( 'Reviews', array(
        Field::make('checkbox', 'tours_do_not_show5', 'Do not show?')
        ->set_option_value( 'yes' ),
        Field::make('text', 'tour_section_5_link', '"Read more" link'),
      ));
}
