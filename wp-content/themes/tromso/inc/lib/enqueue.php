<?php

/**
 * Enqueue scripts and styles.
 */

function theme_scripts()
{
	wp_enqueue_style('main', THEME_URI . '/assets/css/style.min.css', array(), filemtime(THEME_DIR . '/assets/css/style.min.css'));

	wp_enqueue_script('jquery');

	wp_enqueue_script('main', THEME_URI . '/assets/js/app.min.js', array(), filemtime(THEME_DIR . '/assets/js/app.min.js'), 'in-footer');

	wp_enqueue_style('customTheme', get_stylesheet_uri(), array(), filemtime(THEME_DIR . '/style.css'));
}
add_action('wp_enqueue_scripts', 'theme_scripts');
