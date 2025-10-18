<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'pages_options' );

function pages_options() {

    //Для главной страницы
    Container::make( 'post_meta', 'Main page settings' )
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
            Field::make('rich_text', 'description', 'Description'),
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
      ))
      ->add_tab( 'Accordion', array(
        Field::make( 'complex', 'section_6_items', 'Accordion strings' )
        ->set_layout( 'tabbed-horizontal' )
        ->add_fields( array(
          Field::make( 'text', 'title', 'Title' ),
          Field::make( 'rich_text', 'description', 'Description' ),
        )),
      ));


    //Для About Us
    Container::make( 'post_meta', 'About Us page settings' )
		  ->where( 'post_template', '=', 'templates/about-us.php' )
      ->add_tab( 'Header', array(
        Field::make('text', 'au_section_1_title', 'Title'),
        Field::make('rich_text', 'au_section_1_description', 'Description'),
      ))
      ->add_tab( 'Texts with images blocks', array(
        Field::make( 'complex', 'au_section_2_blocks', 'Texts with images blocks' )
        ->set_layout( 'tabbed-horizontal' )
        ->add_fields( array(
          Field::make( 'radio', 'image_side', 'Image side' )
          ->set_width( 33 )
          ->set_options( array(
            'r' => 'Right',
            '' => 'Left'
          ))
          ->set_default_value( '' ),
          Field::make('image', 'image', 'Image')
          ->set_width( 20 ),
          Field::make('text', 'title', 'Title')
          ->set_width( 46 ),
          Field::make( 'rich_text', 'description', 'Description' ),
        )),
      ))
      ->add_tab( 'Cards', array(
        Field::make( 'complex', 'au_section_3_cards', 'Cards' )
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
      ->add_tab( 'Resume block', array(
        Field::make('text', 'au_section_4_title', 'Title'),
        Field::make( 'complex', 'au_section_4_blocks', 'Cards' )
        ->set_layout( 'tabbed-horizontal' )
        ->add_fields( array(
          Field::make( 'text', 'title', 'Title' ),
          Field::make( 'rich_text', 'description', 'Description' ),
        )),
      ));


    //Для About (new) / Facts
    Container::make( 'post_meta', 'About Us (new) / Facts page settings' )
		  ->where( 'post_template', 'IN', array('templates/about-new.php', 'templates/facts.php') )
      ->add_tab( 'Header', array(
        Field::make('text', 'aun_section_1_title', 'Title'),
        Field::make('rich_text', 'aun_section_1_description', 'Description'),
      ))
      ->add_tab( 'Tour blocks', array(
        Field::make('text', 'currency_symbol', 'Сurrency symbol'),
        Field::make( 'complex', 'aun_tours', 'Tours blocks' )
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
            Field::make('rich_text', 'description', 'Description'),
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
      ));


    //Для Contact
    Container::make( 'post_meta', 'Contact page settings' )
		  ->where( 'post_template', '=', 'templates/contact.php' )
      ->add_tab( 'Header', array(
        Field::make('text', 'cnt_section_1_title', 'Title'),
        Field::make('rich_text', 'cnt_section_1_description', 'Description'),
      ))
      ->add_tab( 'Left block', array(
        Field::make('text', 'cnt_section_2_title', 'Title'),
        Field::make('rich_text', 'cnt_section_2_description', 'Description'),
        Field::make('text', 'cnt_section_2_email_title', 'Email title')
        ->set_width( 50 ),
        Field::make('text', 'cnt_section_2_email', 'Email')
        ->set_width( 50 ),
        Field::make('text', 'cnt_section_2_phone_title', 'Phone title')
        ->set_width( 50 ),
        Field::make('text', 'cnt_section_2_phone', 'Phone')
        ->set_width( 50 ),
        Field::make('rich_text', 'cnt_section_2_phone_description', 'Phone description'),
        Field::make('text', 'cnt_section_2_address_title', 'Address title')
        ->set_width( 50 ),
        Field::make('text', 'cnt_section_2_address', 'Address')
        ->set_width( 50 ),
        Field::make('text', 'cnt_section_2_work_time', 'Work time title'),
        Field::make('rich_text', 'cnt_section_2_work_time_description', 'Work time description'),
      ))
      ->add_tab( 'Right block', array(
        Field::make('text', 'cnt_section_3_title', 'Title'),
        Field::make('text', 'cnt_section_2_contact_form', 'Contact form shortcode'),
      ));
      

    //Для Sitemap
    Container::make( 'post_meta', 'Sitemap page settings' )
		  ->where( 'post_template', '=', 'templates/sitemap.php' )
      ->add_tab( 'Header', array(
        Field::make('text', 'stm_section_1_title', 'Title'),
        Field::make('rich_text', 'stm_section_1_description', 'Description'),
      ))
      ->add_tab( 'Pages list block', array(
        Field::make( 'complex', 'stm_section_2_list', 'Blocks' )
        ->set_layout( 'tabbed-horizontal' )
        ->add_fields( array(
          Field::make('text', 'title', 'Title')
          ->set_width( 50 ),
          Field::make( 'radio_image', 'icon', 'Block icon' )
          ->set_width( 50 )
          ->set_options( array(
            'home' => THEME_URI . '/assets/img/icons/sitemap_icon2.png',
            'page1' => THEME_URI . '/assets/img/icons/sitemap_icon1.png',
            'page2' => THEME_URI . '/assets/img/icons/sitemap_icon3.png',
          ) ),
          Field::make( 'radio', 'select_pages_from', 'List elements from' )
          ->set_options( array(
            'list' => 'pages list',
            'custom' => 'custom URLs',
          ) ),
          Field::make( 'association', 'pages_list', 'Select pages' )
          ->set_types( array(
              array(
                  'type'      => 'post',
                  'post_type' => 'page',
              )
          ) )
          ->set_conditional_logic( array(
              array(
                  'field' => 'select_pages_from',
                  'value' => 'list',
                  'compare' => '=',
              )
          ) ),
          Field::make( 'complex', 'custom_urls', 'Custom URLs' )
          ->set_layout( 'tabbed-horizontal' )
          ->add_fields( array(
            Field::make( 'text', 'title', 'Title' ),
            Field::make( 'text', 'url', 'URL' ),
          ))
          ->set_conditional_logic( array(
              array(
                  'field' => 'select_pages_from',
                  'value' => 'custom',
                  'compare' => '=',
              )
          ) ),
        )),
      ))
      ->add_tab( 'Bottom block', array(
        Field::make('text', 'stm_section_3_title', 'Title'),
        Field::make('rich_text', 'stm_section_3_description', 'Description' ),
        Field::make('text', 'stm_section_3_button_title', 'Button title')
        ->set_width( 50 ),
        Field::make('text', 'stm_section_3_button_url', 'Button URL' )
        ->set_width( 50 ),
     ));

}
