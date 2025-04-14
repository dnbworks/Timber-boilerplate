<?php

namespace App\Setup\PostTypes;

class Event {

	public function run() {
		add_action( 'init', array( $this, 'register' ), 10, 0 );

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
}
