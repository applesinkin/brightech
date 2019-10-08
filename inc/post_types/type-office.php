<?php
/**
 * Add "Office" post type
 *
 * @package brightech
 */

/**
 * Register Post Type
 */
function _action_bt_office_type_init() {

	register_post_type('office', array(
		'labels'             => array(
			'name'               => __('Offices', 'brightech'), 
			'singular_name'      => __('Office', 'brightech'),
			'parent_item_colon'  => '',
			'menu_name'          => 'Offices'

		  ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => true,
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array('title','editor','author','thumbnail','custom-fields')
	) );
}
add_action('init', '_action_bt_office_type_init');