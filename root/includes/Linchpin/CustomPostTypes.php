<?php
class CustomPostTypes {

	function __construct() {
		add_action( 'init', array( $this, 'init' ) );
	}

	/**
	 * Register a book post type.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/register_post_type
	 */
	function init() {
		$labels = array(
			'name'               => _x( 'Projects', 'post type general name', 'jff' ),
			'singular_name'      => _x( 'Project', 'post type singular name', 'jff' ),
			'menu_name'          => _x( 'Projects', 'admin menu', 'jff' ),
			'name_admin_bar'     => _x( 'Project', 'add new on admin bar', 'jff' ),
			'add_new'            => _x( 'Add New', 'project', 'jff' ),
			'add_new_item'       => __( 'Add New Project', 'jff' ),
			'new_item'           => __( 'New Project', 'jff' ),
			'edit_item'          => __( 'Edit Project', 'jff' ),
			'view_item'          => __( 'View Project', 'jff' ),
			'all_items'          => __( 'All Projects', 'jff' ),
			'search_items'       => __( 'Search Projects', 'jff' ),
			'parent_item_colon'  => __( 'Parent Projects:', 'jff' ),
			'not_found'          => __( 'No projects found.', 'jff' ),
			'not_found_in_trash' => __( 'No projects found in Trash.', 'jff' ),
		);

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'project' ),
			'capability_type'    => 'page',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' )
		);

		register_post_type( 'project', $args );

		register_taxonomy(
			'project_type',
			'project',
			array(
				'label' => __( 'Type' ),
				'rewrite' => array( 'slug' => 'type' ),
				'hierarchical' => true,
			)
		);

	}
}