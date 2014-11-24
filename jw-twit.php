<?php

/*
Plugin Name:		JW Twit
Plugin URI:			http://plugish.com/contact
Description:		A plugin designed to replace WordTwit and its bugs.
Version:			1.0
Author:				Jerry Wood
Author URI:			http://plugish.com/
*/

if ( ! class_exists( 'JW_SIMPLE_OPTIONS' ) ){
	require_once 'lib/jw_simple_options/simple_options.php';
}
require_once 'inc/options.inc.php';
require_once 'inc/admin.inc.php';