<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

/**
 * Include carbonfields
 */
add_action( 'after_setup_theme', 'crb_load' );
function crb_load() {
    require_once( 'vendor/autoload.php' );
    \Carbon_Fields\Carbon_Fields::boot();
}

/**
 * Define constants
 */
include( 'lib/constants.php' );

/**
 * Register custom post types and taxonomies
 */
include( 'lib/register-cpt-and-taxes.php' );

/**
 * Register and enqueue scripts and styles
 */
include ( 'lib/enqueue.php' );

/**
 * Include wordpress hooks (actions and filters)
 */
include( 'lib/hooks.php' );

/**
 * Include custom fields
 */
foreach ( glob( __DIR__ . '/admin/custom-fields/*.php' ) as $file ) {
    include( $file );
}

/**
 * Include admin list tables functionality
 */
include( 'admin/list-tables.php' );

/**
 * Include utils/* functions
 */
foreach ( glob( __DIR__ . '/utils/*.php' ) as $file ) {
  include( $file );
}
