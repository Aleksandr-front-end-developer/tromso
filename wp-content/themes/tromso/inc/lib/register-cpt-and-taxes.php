<?php

add_action( 'init', 'tromso_register_cpt_taxes', 0 );
function tromso_register_cpt_taxes() {
	// listing category
	register_taxonomy( 'tours-category', 'tours', [
		'label'              => __( 'Categories', 'tromso' ),
		'description'        => __( 'Users category', 'tromso' ),
		'labels'             => [
			'name'                       => _x( 'Categories', 'Tours taxonomy plural name', 'tromso' ),
			'singular_name'              => _x( 'Category', 'Tours taxonomy singular_name', 'tromso' ),
			'search_items'               => __( 'Search categories', 'tromso' ),
			'popular_items'              => __( 'Popular categories', 'tromso' ),
			'all_items'                  => __( 'All categories', 'tromso' ),
			'edit_item'                  => __( 'Edit category', 'tromso' ),
			'update_iten'                => __( 'Update category', 'tromso' ),
			'add_new_item'               => __( 'Add new category', 'tromso' ),
			'view_item'                  => __( 'View category', 'tromso' ),
			'new_item_name'              => __( 'New category name', 'tromso' ),
			'back_to_items'              => __( 'Back to all listing categories', 'tromso' ),
			'not_found'                  => __( 'No categories found', 'tromso' ),
			'separate_items_with_commas' => __( 'Separate categories with commas', 'tromso' ),
			'choose_from_most_used'      => __( 'Choose from the most used categories', 'tromso' ),
		],
		'public'             => true,
		'show_in_nav_menus'  => true,
		'show_tagcloud'      => false,
		'show_in_rest'       => true,
		'hierarchical'       => true,
		'publicly_queryable' => true,
		'show_admin_column'  => true,
	] );

	register_post_type( 'tours', [
		'label'              => __( 'Tours', 'tromso' ),
		'labels'             => [
			'name'          => __( 'Tours', 'tromso' ),
			'singular_name' => __( 'Tour', 'tromso' ),
			'add_new'       => __( 'Add new tour', 'tromso' ),
			'add_new_item'  => __( 'Add new tour', 'tromso' ),
			'edit_item'     => __( 'Edit tour', 'tromso' ),
			'new_item'      => __( 'New tour', 'tromso' ),
			'view_item'     => __( 'View tour', 'tromso' ),
			'search_items'  => __( 'Search tours', 'tromso' ),
		],
		'public'             => true,
		'show_in_menu'       => true,
		'show_in_rest'       => true,
		'publicly_queryable' => true,
		'menu_position'      => 2,
		'menu_icon'          => 'dashicons-palmtree',
		'hierarchical'       => false,
		'supports'           => [ 'title', 'editor', 'excerpt', 'thumbnail' ],
		'taxonomies'         => [ 'tours-category' ],
		'has_archive'        => false,
		'can_export'         => true,
		'rewrite'            => true,
		'query_var'          => true,
	] );
}
