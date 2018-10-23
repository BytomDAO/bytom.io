<?php

/**
 * This file registers the Employees custom post type
 *
 * @package    	Sydney_Toolbox
 * @link        http://athemes.com
 * Author:      aThemes
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */


// Register the Employees custom post type
function sydney_toolbox_register_employees() {

	$slug = apply_filters( 'sydney_employees_rewrite_slug', 'employees' );	

	$labels = array(
		'name'                  => _x( 'Employees', 'Post Type General Name', 'sydney_toolbox' ),
		'singular_name'         => _x( 'Employee', 'Post Type Singular Name', 'sydney_toolbox' ),
		'menu_name'             => __( 'Employees', 'sydney_toolbox' ),
		'name_admin_bar'        => __( 'Employees', 'sydney_toolbox' ),
		'archives'              => __( 'Item Archives', 'sydney_toolbox' ),
		'parent_item_colon'     => __( 'Parent Item:', 'sydney_toolbox' ),
		'all_items'             => __( 'All Employees', 'sydney_toolbox' ),
		'add_new_item'          => __( 'Add New Employee', 'sydney_toolbox' ),
		'add_new'               => __( 'Add New Employee', 'sydney_toolbox' ),
		'new_item'              => __( 'New Employee', 'sydney_toolbox' ),
		'edit_item'             => __( 'Edit Employee', 'sydney_toolbox' ),
		'update_item'           => __( 'Update Employee', 'sydney_toolbox' ),
		'view_item'             => __( 'View Employee', 'sydney_toolbox' ),
		'search_items'          => __( 'Search Employee', 'sydney_toolbox' ),
		'not_found'             => __( 'Not found', 'sydney_toolbox' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'sydney_toolbox' ),
		'featured_image'        => __( 'Featured Image', 'sydney_toolbox' ),
		'set_featured_image'    => __( 'Set featured image', 'sydney_toolbox' ),
		'remove_featured_image' => __( 'Remove featured image', 'sydney_toolbox' ),
		'use_featured_image'    => __( 'Use as featured image', 'sydney_toolbox' ),
		'insert_into_item'      => __( 'Insert into item', 'sydney_toolbox' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'sydney_toolbox' ),
		'items_list'            => __( 'Items list', 'sydney_toolbox' ),
		'items_list_navigation' => __( 'Items list navigation', 'sydney_toolbox' ),
		'filter_items_list'     => __( 'Filter items list', 'sydney_toolbox' ),
	);
	$args = array(
		'label'                 => __( 'Employee', 'sydney_toolbox' ),
		'description'           => __( 'A post type for your employees', 'sydney_toolbox' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
		'taxonomies'            => array( 'category' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 26,
		'menu_icon'             => 'dashicons-businessman',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
		'rewrite' 				=> array( 'slug' => $slug ),		
	);
	register_post_type( 'employees', $args );

}
add_action( 'init', 'sydney_toolbox_register_employees', 0 );