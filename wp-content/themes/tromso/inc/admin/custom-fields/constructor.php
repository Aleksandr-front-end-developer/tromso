<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'constructor_options' );

function constructor_options() {

    Container::make( 'post_meta', 1, 'Constructor settings' )
		  ->where( 'post_template', '=', 'templates/constructor.php' )
      ->add_fields( array(
        Field::make( 'complex', 'content_items', 'Content constructor' )
         ->setup_labels( [
           'plural_name'   => 'Content elements',
           'singular_name' => 'Content element',
         ] )
         //Animation block
         ->add_fields( 'animation_block', 'Animation block', array(
          Field::make( 'text', 'title_for_animation_block', 'Title' ),
          Field::make( 'file', 'large_video_for_animation_block', 'Video for large screens' )
          ->set_type( array( 'video' ) )
          ->set_width( 50 ),
          Field::make( 'file', 'small_video_for_animation_block', 'Video for small screens' )
          ->set_type( array( 'video' ) )
          ->set_width( 50 ),
          Field::make( 'complex', 'text_blocks_for_animation_block', 'Text blocks' )
          ->set_layout( 'tabbed-horizontal' )
          ->set_autoload(true)
          ->add_fields( array(
            Field::make('text', 'title', 'Title')
            ->set_autoload(true),
            Field::make( 'rich_text', 'content', 'Content' )
            ->set_autoload(true),
          ))
         ) )
         //Articles block
         ->add_fields( 'articles_block', 'Articles block', array(
          Field::make( 'text', 'title_for_articles_block', 'Title' ),
          Field::make( 'association', 'articles_for_articles_block', 'Articles' )
          ->set_types( array(
            array(
              'type'      => 'post',
              'post_type' => 'post',
            )
          ) ),
         ) )
         //Header block
         ->add_fields( 'header_block', 'Header block', array(
          Field::make( 'media_gallery', 'images_for_header_block', 'Images' ),
          Field::make( 'text', 'title_for_header_block', 'Title' ),
          Field::make( 'textarea', 'description_for_header_block', 'Description' ),
          Field::make( 'text', 'button_name_for_header_block', 'Button name' )
          ->set_width( 50 ),
          Field::make( 'text', 'button_link_for_header_block', 'Button link' )
          ->set_width( 50 ),
         ) )
         //Information cards
         ->add_fields( 'information_cards', 'Information cards', array(
          Field::make( 'text', 'title_for_information_cards', 'Title' ),
          Field::make( 'complex', 'cards_for_information_cards', 'Cards' )
          ->set_layout( 'tabbed-horizontal' )
          ->set_autoload(true)
          ->add_fields( array(
            Field::make('image', 'image', 'Image')
            ->set_width( 50 )
            ->set_autoload(true),
            Field::make('text', 'title', 'Title')
            ->set_width( 50 )
            ->set_autoload(true),
            Field::make( 'textarea', 'description', 'Description' )
            ->set_autoload(true),
          ))
         ) )
         //Shop categories
         ->add_fields( 'shop_categories_block', 'Shop categories block', array(
          Field::make( 'text', 'title_for_shop_categories_block', 'Title' ),
          Field::make( 'association', 'categories_for_shop_categories_block', 'Selected categories' )
          ->set_types( array(
            array(
              'type'      => 'term',
              'taxonomy' => 'product_cat',
            )
          ) ),
         ) )
         //Shop popular products
         ->add_fields( 'shop_popular_products_block', 'Shop popular products', array(
          Field::make( 'text', 'title_for_shop_popular_products_block', 'Title' ),
          Field::make( 'association', 'products_for_shop_popular_products_block', 'Selected products' )
          ->set_types( array(
            array(
              'type'      => 'post',
              'post_type' => 'product',
            )
          ) ),
         ) )
         //Simple header block
         ->add_fields( 'simple_header_block', 'Simple header block', array(
          Field::make( 'text', 'title_for_simple_header_block', 'Title' ),
          Field::make( 'image', 'image_for_simple_header_block', 'Image' ),
         ) )
         //Simple text block
         ->add_fields( 'simple_text_block', 'Simple text block', array(
          Field::make( 'text', 'title_for_simple_text_block', 'Title' ),
          Field::make( 'rich_text', 'text_for_simple_text_block', 'Text' ),
         ) )
         //Slider with left text and link block
         ->add_fields( 'slider_with_left_text_and_link_block', 'Slider with left text and link block', array(
          Field::make( 'image', 'background_for_slider_with_left_text_and_link_block', 'Background image' ),
          Field::make( 'media_gallery', 'images_for_slider_with_left_text_and_link_block', 'Images' ),
          Field::make( 'text', 'title_for_slider_with_left_text_and_link_block', 'Title' ),
          Field::make( 'textarea', 'description_for_slider_with_left_text_and_link_block', 'Description' ),
          Field::make( 'text', 'button_name_for_slider_with_left_text_and_link_block', 'Button name' )
          ->set_width( 50 ),
          Field::make( 'text', 'button_link_for_slider_with_left_text_and_link_block', 'Button link' )
          ->set_width( 50 ),
         ) )
         //Youtube video block
		     ->add_fields( 'youtube_video_block', 'Youtube video block', array(
			    Field::make( 'text', 'title_for_youtube_video_block', 'Youtube video title' )
			    ->set_width( 70 ),
			    Field::make( 'text', 'video_for_youtube_video_block', 'Youtube video link' )
          ->set_width( 30 ),
		     ) )
     ));

}
