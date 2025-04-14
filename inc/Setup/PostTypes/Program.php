<?php

namespace App\Setup\PostTypes;


class Program {


	public function run() {
		add_action( 'init', array( $this, 'register' ), 10, 0 );

	}


	public function register() {
		$labels = [
			'name'               => __( 'Programs', 'your-textdomain' ),
			'singular_name'      => __( 'Program', 'your-textdomain' ),
			'menu_name'          => __( 'Programs', 'your-textdomain' ),
			'name_admin_bar'     => __( 'Program', 'your-textdomain' ),
			'add_new'            => __( 'Add New', 'your-textdomain' ),
			'add_new_item'       => __( 'Add New Program', 'your-textdomain' ),
			'new_item'           => __( 'New Program', 'your-textdomain' ),
			'edit_item'          => __( 'Edit Program', 'your-textdomain' ),
			'view_item'          => __( 'View Program', 'your-textdomain' ),
			'all_items'          => __( 'All Programs', 'your-textdomain' ),
			'search_items'       => __( 'Search Programs', 'your-textdomain' ),
			'not_found'          => __( 'No Programs found.', 'your-textdomain' ),
			'not_found_in_trash' => __( 'No Programs found in Trash.', 'your-textdomain' ),
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
}
