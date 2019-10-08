<?php
/**
 * Filters and actions
 *
 * @package brightech
 */

/**
 * Body classes
 */
function _filter_bt_theme_body_classes( $classes ) {
	$classes[] = 'site';

	return $classes;
}
add_filter( 'body_class', '_filter_bt_theme_body_classes' );