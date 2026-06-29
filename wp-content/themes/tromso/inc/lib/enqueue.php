<?php

/**
 * Enqueue scripts and styles.
 */

function theme_scripts()
{
	wp_enqueue_style('main', THEME_URI . '/assets/css/style.min.css', array(), filemtime(THEME_DIR . '/assets/css/style.min.css'));

	wp_enqueue_script('jquery');

	wp_enqueue_script('main', THEME_URI . '/assets/js/app.min.js', array('jquery'), filemtime(THEME_DIR . '/assets/js/app.min.js'), 'in-footer');

  $data = array(
      'current_language' => get_current_language(),
      'default_language' => get_default_language(),
  );
  
  wp_localize_script('main', 'languageData', $data);
    
	wp_enqueue_style('customTheme', get_stylesheet_uri(), array(), filemtime(THEME_DIR . '/style.css'));
}
add_action('wp_enqueue_scripts', 'theme_scripts');

function admin_scripts()
{
	wp_enqueue_style('main', THEME_URI . '/inc/js/style.css', array(), filemtime(THEME_DIR . '/inc/js/style.css'));

	wp_enqueue_script('jquery');

	wp_enqueue_script('main', THEME_URI . '/inc/js/admin_scripts.js', array('jquery'), filemtime(THEME_DIR . '/inc/js/admin_scripts.js'), 'in-footer');
}
add_action( 'admin_enqueue_scripts', 'admin_scripts' );