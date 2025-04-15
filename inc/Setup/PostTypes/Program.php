<?php

namespace App\Setup\PostTypes;


class Program {


	public function run() {
		add_action( 'init', array( $this, 'register' ), 10, 0 );
		add_action( 'init', array( $this, 'taxonomy' ), 10, 0 );

	}


	public function register() {
		$labels = [
			'name'               => __( 'Programs', 'Iplcollege' ),
			'singular_name'      => __( 'Program', 'Iplcollege' ),
			'menu_name'          => __( 'Programs', 'Iplcollege' ),
			'name_admin_bar'     => __( 'Program', 'Iplcollege' ),
			'add_new'            => __( 'Add New', 'Iplcollege' ),
			'add_new_item'       => __( 'Add New Program', 'Iplcollege' ),
			'new_item'           => __( 'New Program', 'Iplcollege' ),
			'edit_item'          => __( 'Edit Program', 'Iplcollege' ),
			'view_item'          => __( 'View Program', 'Iplcollege' ),
			'all_items'          => __( 'All Programs', 'Iplcollege' ),
			'search_items'       => __( 'Search Programs', 'Iplcollege' ),
			'not_found'          => __( 'No Programs found.', 'Iplcollege' ),
			'not_found_in_trash' => __( 'No Programs found in Trash.', 'Iplcollege' ),
		];

		$args = [
			'labels'             => $labels,
			'public'             => true,
			'has_archive'        => true,
			'show_in_rest'       => true, // for Gutenberg + API
			'supports'           => [ 'title', 'editor', 'thumbnail', 'excerpt' ],
			'menu_position'      => 20,
			'menu_icon'          => 'dashicons-welcome-learn-more',
			'rewrite'            => [ 'slug' => 'programs' ],
			'show_in_nav_menus'  => true,
			'show_ui'            => true,
			'hierarchical'       => false,
			'capability_type'    => 'post',
		];

		register_post_type( 'program', $args );
	}

	public function taxonomy() {
		$labels = [
			'name'              => __( 'Program Categories', 'Iplcollege' ),
			'singular_name'     => __( 'Program Category', 'Iplcollege' ),
			'search_items'      => __( 'Search Program Categories', 'Iplcollege' ),
			'all_items'         => __( 'All Program Categories', 'Iplcollege' ),
			'parent_item'       => __( 'Parent Category', 'Iplcollege' ),
			'parent_item_colon' => __( 'Parent Category:', 'Iplcollege' ),
			'edit_item'         => __( 'Edit Program Category', 'Iplcollege' ),
			'update_item'       => __( 'Update Program Category', 'Iplcollege' ),
			'add_new_item'      => __( 'Add New Program Category', 'Iplcollege' ),
			'new_item_name'     => __( 'New Program Category Name', 'Iplcollege' ),
			'menu_name'         => __( 'Program Categories', 'Iplcollege' ),
		];

		$args = [
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'show_in_rest'      => true,
			'rewrite'           => [ 'slug' => 'program-category' ],
		];

		register_taxonomy( 'program_category', [ 'program' ], $args );
	}
}
