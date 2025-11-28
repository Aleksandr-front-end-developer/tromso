<?php

/**
 * Template Name: Code
 *
 * Front page php tempate
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/wp-load.php';

//Получаем ID админа
$user_id = 0;
$admins = get_users([
    'role'   => 'Administrator',
    'number' => 1,
    'fields' => 'ID',
]);

if ( !empty($admins) ) {
    $user_id = $admins[0];
}



$terms = get_terms([
  'taxonomy' => 'tours-category'
]);

$need_terms = array('Best seller', 'Top rated');

foreach ($need_terms as $new_term)
{
  $exist = false;
  foreach ($terms as $term)
  {
    if ($term->name==$new_term)
    {
      $exist = true;
      break; 
    }
  }
  if (!$exist) wp_insert_term( $new_term, 'tours-category' );
}

$best_seller = get_term_by( 'name', 'Best seller', 'tours-category' );
$top_rated = get_term_by( 'name', 'Top rated', 'tours-category' );


$pages = get_posts([
    'post_type'  => 'page',
    'meta_key'   => '_wp_page_template',
    'meta_value' => 'templates/main-page.php',
    'numberposts' => -1,
]);

foreach ($pages as $page)
{
  $tour_blocks = carbon_get_post_meta($page->ID, 'main_page_tours');
  $currency = carbon_get_post_meta($page->ID, 'currency_symbol');
  
  foreach ($tour_blocks as $key=>$tour_block)
  {
    if (is_array($tour_block['tours']))
    {
      $new_tour_block = array();
    
      foreach ($tour_block['tours'] as $tour)
      {
        $tour_posts = get_posts([
            'post_type'  => 'tours',
            'numberposts' => -1,
        ]);
        
        $exist = false;
        foreach ($tour_posts as $tour_post)
        {
          if ($tour_post->post_title==$tour['title'])
          {
            $exist = $tour_post->ID;
            break; 
          }
        }
        
        if ($exist===false)
        {
          $tax_input = array();
          if ($tour['best_seller']) $tax_input[] = $best_seller->term_id;
          if ($tour['top_rated']) $tax_input[] = $top_rated->term_id;
          
          $args = array(
            'post_author' => $user_id,
            'post_content' => $tour['description'],
            'post_title' => $tour['title'],
            'post_status' => 'publish',
            'post_type' => 'tours',
            'tax_input' => array('tours-category' => $tax_input),
            'meta_input'   => array(
              '_thumbnail_id' => $tour['image'],
              '_tour_rating' => $tour['rating'],
              '_tour_hours' => $tour['hours'],
              '_tour_bookings' => $tour['bookings'],
              '_tour_price' => $tour['price'],
              '_tour_url' => $tour['url'],
              '_tour_currency' => $currency,
              '_tours_do_not_show1' => 'yes',
              '_tours_do_not_show2' => 'yes',
              '_tours_do_not_show3' => 'yes',
              '_tours_do_not_show4' => 'yes',
            ),
          );
          print_r($args);
          $post_id = wp_insert_post($args);
          
        } else $post_id = $exist;
        
        $new_tour_block[] = array(
          'value' => 'post:tours:'.strval($post_id),
          'type' => 'post',
          'subtype' => 'tours',
          'id' => $post_id,
        );
        
      }
      
      $tour_blocks[$key]['tours_new'] = $new_tour_block;
    }
  }
      
  carbon_set_post_meta( $page->ID, 'main_page_tours', $tour_blocks );
}


$templates = array('templates/facts.php', 'templates/about-new.php');

foreach ($templates as $template)
{
  $pages = get_posts([
      'post_type'  => 'page',
      'meta_key'   => '_wp_page_template',
      'meta_value' => $template,
      'numberposts' => -1,
  ]);

  foreach ($pages as $page)
  {
    $tour_blocks = carbon_get_post_meta($page->ID, 'aun_tours');
    
    foreach ($tour_blocks as $key=>$tour_block)
    {
      if (is_array($tour_block['tours']))
      {
        $new_tour_block = array();
      
        foreach ($tour_block['tours'] as $tour)
        {
          $tour_posts = get_posts([
              'post_type'  => 'tours',
              'numberposts' => -1,
          ]);
          
          $post_id = 0;
          foreach ($tour_posts as $tour_post)
          {
            $image = get_post_thumbnail_id($tour_post->ID);
            print_r($tour_post->post_title);
            echo PHP_EOL;
            print_r($tour['title']);
            echo PHP_EOL;
            print_r($image);
            echo PHP_EOL;
            print_r($tour['image']);
            echo PHP_EOL;
            print_r('---------');
            echo PHP_EOL;
            if ($tour_post->post_title==$tour['title'] || $image==$tour['image'])
            {
              $post_id = $tour_post->ID;
              break; 
            }
          }
          
          if ($post_id>0)
          {
            $new_tour_block[] = array(
              'value' => 'post:tours:'.strval($post_id),
              'type' => 'post',
              'subtype' => 'tours',
              'id' => $post_id,
            );
          }
        }
        
        $tour_blocks[$key]['tours_new'] = $new_tour_block;
      }
    }
    carbon_set_post_meta( $page->ID, 'aun_tours', $tour_blocks );
    carbon_set_post_meta( $page->ID, 'aun_do_not_show_tours', 'yes' );      
  }
}

flush_rewrite_rules();
?>