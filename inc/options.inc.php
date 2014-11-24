<?php

/**
 * Main Options File
 */

$jw_twit_options = array(
	'plugin_title' => 'JW Twit',
	'prefix' => 'jwtwit_',
	'menu_title' => 'JW Twit',
	'icon_url' => 'dashicons-twitter',
	'slug' => 'jw_twit',
	'opData' => array(
		'access_token' => array(
			'name' => __( 'Access Token', 'jwtwit' ),
			'type' => 'text',
		),
		'access_secret' => array(
			'name' => __( 'Access Secret', 'jwtwit' ),
			'type' => 'password',
		),
	),
);

new JW_Simple_Options( $jw_twit_options );