<?php

namespace App\Setup\PostTypes;

class Event {

	public function run() {
		add_action( 'init', array( $this, 'register' ), 10, 0 );
		add_action( 'init', [ $this, 'taxonomy' ], 10 );
	}

	public static function register() {
		$labels = [
			'name'               => __( 'Events', 'your-textdomain' ),
			'singular_name'      => __( 'Event', 'your-textdomain' ),
			'menu_name'          => __( 'Events', 'your-textdomain' ),
			'name_admin_bar'     => __( 'Event', 'your-textdomain' ),
			'add_new'            => __( 'Add New', 'your-textdomain' ),
			'add_new_item'       => __( 'Add New Event', 'your-textdomain' ),
			'new_item'           => __( 'New Event', 'your-textdomain' ),
			'edit_item'          => __( 'Edit Event', 'your-textdomain' ),
			'view_item'          => __( 'View Event', 'your-textdomain' ),
			'all_items'          => __( 'All Events', 'your-textdomain' ),
			'search_items'       => __( 'Search Events', 'your-textdomain' ),
			'not_found'          => __( 'No Events found.', 'your-textdomain' ),
			'not_found_in_trash' => __( 'No Events found in Trash.', 'your-textdomain' ),
		];

		$args = [
			'labels'             => $labels,
			'public'             => true,
			'has_archive'        => true,
			'show_in_rest'       => true,
			'supports'           => [ 'title', 'editor', 'excerpt', 'thumbnail' ],
			'menu_position'      => 21,
			'menu_icon'          => 'dashicons-calendar-alt',
			'rewrite'            => [ 'slug' => 'events' ],
			'show_in_nav_menus'  => true,
			'show_ui'            => true,
			'hierarchical'       => false,
			'capability_type'    => 'post',
		];

		register_post_type( 'event', $args );
	}

	public function taxonomy() {
		$labels = [
			'name'              => __( 'Event Categories', 'your-textdomain' ),
			'singular_name'     => __( 'Event Category', 'your-textdomain' ),
			'search_items'      => __( 'Search Event Categories', 'your-textdomain' ),
			'all_items'         => __( 'All Event Categories', 'your-textdomain' ),
			'parent_item'       => __( 'Parent Category', 'your-textdomain' ),
			'parent_item_colon' => __( 'Parent Category:', 'your-textdomain' ),
			'edit_item'         => __( 'Edit Event Category', 'your-textdomain' ),
			'update_item'       => __( 'Update Event Category', 'your-textdomain' ),
			'add_new_item'      => __( 'Add New Event Category', 'your-textdomain' ),
			'new_item_name'     => __( 'New Event Category Name', 'your-textdomain' ),
			'menu_name'         => __( 'Event Categories', 'your-textdomain' ),
		];

		$args = [
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'show_in_rest'      => true,
			'rewrite'           => [ 'slug' => 'event-category' ],
		];

		register_taxonomy( 'event_category', [ 'event' ], $args );
	}
}
