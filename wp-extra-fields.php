<?php
/*
Plugin Name: WP Extra Fields
Plugin URI:  http://wordpress.org/extend/plugins/wp-extra-fields
Description: Allows extension of page, post and custom post type by allowing you to create customised form fields to include when adding or editing post types. You can use existing or create new post fields.
Author: Sprint experts
Version: 1.0.1
Author URI: https://www.sprintexperts.com
License: GPLv2 or later
*/

if ( preg_match( '#' . basename( __FILE__ ) . '#', $_SERVER['PHP_SELF'] ) ) {
	die( 'You are not allowed to call this page directly.' );
}
    
require_once ('src/wp-extra-fields.php');