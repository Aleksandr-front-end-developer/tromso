<?php

/**
 * Wise theme functions and definitions
 */

/**
 * Define theme version
 */
if (!defined('_S_VERSION')) {
	define('_S_VERSION', '1.0.0');
}

/**
 * Remove unused and unneccessary wordpress core features
 */
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'rest_output_link_wp_head');
remove_action('wp_head', 'wp_resource_hints', 2);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_head', 'wp_shortlink_wp_head', 10);
remove_action('wp_head', 'wp_oembed_add_discovery_links');
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_styles', 'print_emoji_styles');

/**
 * Disable Gutenberg block editor
 */
add_filter('use_block_editor_for_post', '__return_false', 10);

/**
 * Remove unused and sizeless images sizes
 */
add_filter('intermediate_image_sizes_advanced', 'mm_image_sizes_filter', 10, 3);
function mm_image_sizes_filter($new_sizes, $image_meta, $attachment_id)
{
	$sizes_to_unset = [
		'medium',
		'medium_large',
		'large',
		'1536x1536',
		'2048x2048',
	];
	foreach ($sizes_to_unset as $size) {
		if (isset($new_sizes[$size])) {
			unset($new_sizes[$size]);
		}
	}
	return $new_sizes;
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function theme_menus_setup()
{
	load_theme_textdomain('wise', get_template_directory() . '/languages');
	add_theme_support('title-tag');
	add_theme_support('post-thumbnails');
	add_theme_support('menus');
	add_theme_support('custom-logo');
	register_nav_menus(array(
		'menu_header'       => 'Header',
		'menu_mobile'       => 'Mobile',
		'menu_footer'       => 'Footer',

	));

	//! Disable the admin panel for everyone except administrators
	if (!current_user_can('administrator') && !current_user_can('editor')) {
		show_admin_bar(false);
	}
	//! disable the admin panel for all users
	// show_admin_bar(false);
}
add_action('after_setup_theme', 'theme_menus_setup');

/**
 * Include theme core
 */
require get_template_directory() . '/inc/init-core.php';


//! remove extra svg code from WordPress after the body tag
remove_action('wp_body_open', 'wp_global_styles_render_svg_filters');

//!  // DISABLE GUTENBERG STYLE IN HEADER
function wps_deregister_styles()
{
	wp_dequeue_style('global-styles');
}
add_action('wp_enqueue_scripts', 'wps_deregister_styles', 100);

//! =========== SEO ================
/** so that a non-loading page always gives a 404 server response "hooks.php"
 * Prevent url guessing if url not exists
 * we always need to show 404
 */
add_filter('do_redirect_guess_404_permalink', '__return_false');

/**
 * Add canonical meta
 */
add_action('wp_head', 'theme_add_canonical', 10);
function theme_add_canonical()
{
	if (empty($_GET) && !get_query_var('page') && !get_query_var('paged')) {
		$url = home_url($_SERVER['REQUEST_URI']);
	} else {
		if (!get_query_var('page') && !get_query_var('paged')) {
			$url = preg_replace('/\?.*/', '', home_url($_SERVER['REQUEST_URI']));
		} else {
			$url = preg_replace('/paged?\/.*/', '', home_url($_SERVER['REQUEST_URI']));
		}
	}

	echo '<link rel="canonical" href="' . $url . '">';
}

// ======== Добавления классов к ссылкам для меню в футере  ===================

class Tailwind_Walker_Nav_Menu extends Walker_Nav_Menu
{
	function start_el(&$output, $item, $depth = 0, $args = [], $id = 0)
	{
		$classes = 'hover:text-aurora-green transition-colors';
		$li_classes = implode(' ', $item->classes);

		$attributes = !empty($item->url) ? ' href="' . esc_url($item->url) . '"' : '';

		$item_output = '<li class="' . esc_attr($li_classes) . '">';
		$item_output .= '<a' . $attributes . ' class="' . esc_attr($classes) . '">';
		$item_output .= esc_html($item->title);
		$item_output .= '</a></li>';

		$output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
	}
}
// ========

// Включение excerpt для страниц
add_post_type_support('page', 'excerpt');

// Добавляем поддержку excerpt для страниц
function mytheme_add_excerpt_to_pages()
{
	add_meta_box(
		'postexcerpt',
		__('Description'),
		'post_excerpt_meta_box',
		'page',
		'normal',
		'high'
	);
}
add_action('add_meta_boxes', 'mytheme_add_excerpt_to_pages');

// Регистрация кастомных полей для меню
function custom_nav_menu_fields($item_id, $item, $depth, $args)
{
?>
	<div class="field-data-section description-wide" style="margin: 5px 0;">
		<span class="description"><?php _e('Data Section'); ?></span><br />
		<input type="hidden" class="nav-menu-id" value="<?php echo $item_id; ?>" />
		<div class="logged-input-holder">
			<input type="text" name="menu-item-data-section[<?php echo $item_id; ?>]" id="custom-menu-item-data-section-<?php echo $item_id; ?>" value="<?php echo esc_attr($item->data_section); ?>" />
			<p class="description">For tour buttons (for example: best-sellers, winter-tours)</p>
		</div>
	</div>

	<div class="field-is-button description-wide" style="margin: 5px 0;">
		<label>
			<input type="checkbox" name="menu-item-is-button[<?php echo $item_id; ?>]" value="1" <?php checked($item->is_button, 1); ?> />
			<?php _e('This is a button (not a link)'); ?>
		</label>
		<p class="description">Check for items that should be buttons (e.g. "Tours")</p>
	</div>
<?php
}
add_action('wp_nav_menu_item_custom_fields', 'custom_nav_menu_fields', 10, 4);

// Сохранение кастомных полей
function custom_nav_menu_update($menu_id, $menu_item_db_id, $args)
{
	if (isset($_POST['menu-item-data-section'][$menu_item_db_id])) {
		update_post_meta($menu_item_db_id, '_menu_item_data_section', sanitize_text_field($_POST['menu-item-data-section'][$menu_item_db_id]));
	}

	$is_button = isset($_POST['menu-item-is-button'][$menu_item_db_id]) ? 1 : 0;
	update_post_meta($menu_item_db_id, '_menu_item_is_button', $is_button);
}
add_action('wp_update_nav_menu_item', 'custom_nav_menu_update', 10, 3);

// Загрузка кастомных полей
function custom_nav_menu_item($menu_item)
{
	$menu_item->data_section = get_post_meta($menu_item->ID, '_menu_item_data_section', true);
	$menu_item->is_button = get_post_meta($menu_item->ID, '_menu_item_is_button', true);
	return $menu_item;
}
add_filter('wp_setup_nav_menu_item', 'custom_nav_menu_item');


class Custom_Nav_Walker extends Walker_Nav_Menu
{

	// Для десктопной версии
	public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
	{
		$indent = ($depth) ? str_repeat("\t", $depth) : '';

		$classes = empty($item->classes) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

		// Определяем классы в зависимости от глубины
		if ($depth === 0) {
			$class_names = 'text-white hover:text-aurora-green transition-colors font-medium';
		} else {
			$class_names = 'block w-full text-left px-4 py-2 text-gray-700 hover:bg-ice-blue hover:text-white transition-colors tour-item';
		}

		// Добавляем data-атрибуты
		$data_attributes = '';
		if (!empty($item->data_section)) {
			$data_attributes = 'data-section="' . esc_attr($item->data_section) . '"';
		}
		if ($item->is_button) {
			$data_attributes .= ' data-discover="true"';
		}

		// Для элементов с подменю (первый уровень)
		if ($args->walker->has_children && $depth === 0) {
			$output .= $indent . '<div class="relative">';
			$output .= '<button class="tours-trigger ' . $class_names . '" ' . $data_attributes . '>';
			$output .= esc_html($item->title);
			$output .= '</button>';
		}
		// Для элементов подменю
		elseif ($depth > 0) {
			$output .= $indent . '<button class="' . $class_names . '" ' . $data_attributes . '>';
			$output .= esc_html($item->title);
			$output .= '</button>';
		}
		// Обычные ссылки
		else {
			$output .= $indent . '<a class="' . $class_names . '" href="' . esc_url($item->url) . '" ' . $data_attributes . '>';
			$output .= esc_html($item->title);
			$output .= '</a>';
		}
	}

	public function end_el(&$output, $item, $depth = 0, $args = null)
	{
		if ($depth === 0) {
			$output .= "\n";
		}
	}

	public function start_lvl(&$output, $depth = 0, $args = null)
	{
		if ($depth === 0) {
			$output .= '<div class="tours-dropdown absolute top-full left-0 mt-2 bg-white rounded-lg shadow-xl py-2 min-w-[180px]">';
		}
	}

	public function end_lvl(&$output, $depth = 0, $args = null)
	{
		if ($depth === 0) {
			$output .= '</div></div>';
		}
	}
}

// Walker для мобильной версии
class Mobile_Nav_Walker extends Walker_Nav_Menu
{

	public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
	{
		$indent = ($depth) ? str_repeat("\t", $depth) : '';

		// Классы для мобильной версии
		if ($depth === 0) {
			$class_names = 'block w-full text-left text-white hover:text-aurora-green transition-colors font-medium py-2';
		} else {
			$class_names = 'mobile-tour-item nav-link block w-full text-left text-white/80 hover:text-aurora-green transition-colors py-2 pl-4';
		}

		// Data-атрибуты
		$data_attributes = '';
		if (!empty($item->data_section)) {
			$data_attributes = 'data-section="' . esc_attr($item->data_section) . '"';
		}

		// Для родительских элементов
		if ($args->walker->has_children && $depth === 0) {
			$output .= $indent . '<div class="space-y-2">';
			$output .= '<div class="text-white font-medium py-2">' . esc_html($item->title) . '</div>';
		}
		// Для дочерних элементов
		elseif ($depth > 0) {
			$output .= $indent . '<button class="' . $class_names . '" ' . $data_attributes . '>';
			$output .= esc_html($item->title);
			$output .= '</button>';
		}
		// Обычные ссылки
		else {
			$output .= $indent . '<a class="' . $class_names . '" href="' . esc_url($item->url) . '" ' . $data_attributes . '>';
			$output .= esc_html($item->title);
			$output .= '</a>';
		}
	}

	public function end_el(&$output, $item, $depth = 0, $args = null)
	{
		if ($args->walker->has_children && $depth === 0) {
			$output .= '</div>';
		}
		$output .= "\n";
	}

	public function start_lvl(&$output, $depth = 0, $args = null)
	{
		// Уровни уже обрабатываются в start_el
	}

	public function end_lvl(&$output, $depth = 0, $args = null)
	{
		// Уровни уже обрабатываются в end_el
	}
}
