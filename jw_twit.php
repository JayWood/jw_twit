<?php
/**
 * Plugin Name: JW Twit
 * Plugin URI:  http://plugish.com/contact
 * Description: A Multi-Account twitter plugin for blog owners who want to automate their tweets and have full control over everything.
 * Version:     0.1.0
 * Author:      Jay Wood
 * Author URI:  http://plugish.com
 * Donate link: http://plugish.com/contact
 * License:     GPLv2+
 * Text Domain: jw_twit
 * Domain Path: /languages
 */

/**
 * Copyright (c) 2015 Jay Wood (email : jjwood2004@gmail.com)
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2 or, at
 * your discretion, any later version, as published by the Free
 * Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

/**
 * Built using grunt-wp-plugin
 * Copyright (c) 2013 10up, LLC
 * https://github.com/10up/grunt-wp-plugin
 */

/**
 * Get the bootstrap!
 */
require_once __DIR__ . '/includes/CMB2/init.php';

/**
 * Autoloads files with classes when needed
 * @since  0.1.0
 * @param  string $class_name Name of the class being requested
 */
function jw_twit_autoload_classes( $class_name ) {
	if ( class_exists( $class_name, false ) || false === stripos( $class_name, 'Jw_Twit_' ) ) {
		return;
	}

	$filename = strtolower( str_ireplace( 'Jw_Twit_', '', $class_name ) );

	Jw_Twit::include_file( $filename );
}
spl_autoload_register( 'jw_twit_autoload_classes' );

/**
 * Main initiation class
 */
class Jw_Twit {

	const VERSION = '0.1.0';

	protected $admin = null;
	private $key = 'jwtwit';
	
	/**
	 * Sets up our plugin
	 * @since  0.1.0
	 */
	public function __construct() {
		
	}

	public function hooks() {

		register_activation_hook( __FILE__, array( $this, '_activate' ) );
		register_deactivation_hook( __FILE__, array( $this, '_deactivate' ) );
		add_action( 'init', array( $this, 'init' ) );
		add_action( 'admin_init', array( $this, 'admin_hooks' ) );

		$this->admin = new Jw_Twit_Admin( $this->key );
	}

	/**
	 * Activate the plugin
	 */
	function _activate() {
		// Make sure any rewrite functionality has been loaded
		flush_rewrite_rules();
	}

	/**
	 * Deactivate the plugin
	 * Uninstall routines should be in uninstall.php
	 */
	function _deactivate() {

	}

	/**
	 * Init hooks
	 * @since  0.1.0
	 * @return null
	 */
	public function init() {
		$locale = apply_filters( 'plugin_locale', get_locale(), 'jw_twit' );
		load_textdomain( 'jw_twit', WP_LANG_DIR . '/jw_twit/jw_twit-' . $locale . '.mo' );
		load_plugin_textdomain( 'jw_twit', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}

	/**
	 * Hooks for the Admin
	 * @since  0.1.0
	 * @return null
	 */
	public function admin_hooks() {
		$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
		wp_register_style( 'jwtwit-css', $this->url( "assets/css/jw_twit{$min}.css" ), null, self::VERSION );

		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
	}

	public function admin_enqueue_scripts(){
		wp_enqueue_style( 'jwtwit-css' );
	}

	/**
	 * Include a file from the includes directory
	 * @since  0.1.0
	 * @param  string $filename Name of the file to be included
	 */
	public static function include_file( $filename ) {
		$file = self::dir( 'includes/'. $filename .'.php' );
		if ( file_exists( $file ) ) {
			return include_once( $file );
		}
	}

	/**
	 * This plugin's directory
	 * @since  0.1.0
	 * @param  string $path (optional) appended path
	 * @return string       Directory and path
	 */
	public static function dir( $path = '' ) {
		static $dir;
		$dir = $dir ? $dir : trailingslashit( dirname( __FILE__ ) );
		return $dir . $path;
	}

	/**
	 * This plugin's url
	 * @since  0.1.0
	 * @param  string $path (optional) appended path
	 * @return string       URL and path
	 */
	public static function url( $path = '' ) {
		static $url;
		$url = $url ? $url : trailingslashit( plugin_dir_url( __FILE__ ) );
		return $url . $path;
	}

	/**
	 * Magic getter for our object.
	 *
	 * @param string $field
	 *
	 * @throws Exception Throws an exception if the field is invalid.
	 *
	 * @return mixed
	 */
	public function __get( $field ) {
		switch ( $field ) {
			case 'url':
			case 'path':
			case 'admin':
			case 'key':
				return self::$field;
			default:
				throw new Exception( 'Invalid '. __CLASS__ .' property: ' . $field );
		}
	}

}

// init our class
$GLOBALS['Jw_Twit'] = new Jw_Twit();
$GLOBALS['Jw_Twit']->hooks();

function jwtwit_get_option( $key = '' ){
	global $Jw_Twit;
	return cmb2_get_option( $Jw_Twit->key, $key );
}

