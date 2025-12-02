<?php

add_action( 'add_bookings_action', 'add_bookings' );

if( ! wp_next_scheduled( 'add_bookings_action' ) )
{
  wp_schedule_event( time(), 'daily', 'add_bookings_action');
}

function add_bookings() {

  $tours = get_posts( array(
    'numberposts' => -1,
    'post_type'   => 'tours',
  ) );
  
  foreach ($tours as $tour)
  {
    $bookings = floatval(carbon_get_post_meta($tour->ID, 'tour_bookings'));
    if ($bookings>0)
    {
      $bookings += rand(1, 2);
      carbon_set_post_meta($tour->ID, 'tour_bookings', $bookings);
    }
  }
}