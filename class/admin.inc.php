<?php

/**
 * Admin Includes File
 */

class JwTwit {

	var $admin_hook = null;

	var $prefix = 'jwtwit_';

	var $settings = array( 'key', 'secret', 'accounts' );

	public function hooks(){
		add_action( 'admin_enqueue_scripts', array( $this, 'queue_scripts' ) );
		add_action( 'admin_init', array( $this, 'register_settings' ) );
		add_action( 'admin_menu', array( $this, 'register_menu' ) );

		add_action( 'admin_init', array( $this, 'get_handler' ) );
	}

	public function get_handler(){
		if ( isset( $_GET['jwtwit'] ) ){
			switch ( $_GET['jwtwit'] ){
				case 'authorize':
					$this->twitter_authorize();
					break;
			}
		}
	}

	public function queue_scripts(){
		wp_register_style( 'jwtwit_css', plugins_url( 'css/jw_twit.css', dirname( __FILE__ ) ), false, '1.0' );
		wp_register_script( 'jwtwit_js', plugins_url( 'js/jquery_jw_twit.js', dirname( __FILE__ ) ), array( 'jquery' ), '1.0', true );

		wp_enqueue_style( 'jwtwit_css' );
		wp_enqueue_script( 'jwtwit_js' );
	}

	public function register_settings(){
		foreach ( $this->settings as $setting ){
			register_setting( 'jw_twit', $this->prefix.$setting );
		}
	}

	public function register_menu(){
		$this->admin_hook = add_menu_page( 'JW Twit', 'JW Twit', 'manage_options', 'jw-twit-options', array( $this, 'render_options_page' ), 'dashicons-twitter' );
	}

	public function render_options_page(){
		include plugin_dir_path( dirname( __FILE__ ) ) . 'inc/admin.panel.php';
	}

	public function generate_add_account_link(){
		return add_query_arg( array( 'jwtwit' => 'authorize', 'page' => 'jw-twit-options' ), admin_url( 'admin.php' ) );
	}

	function twitter_authorize(){
		$key = get_option( 'jwtwit_key' );
		$secret = get_option( 'jwtwit_secret' );

		$con = new TwitterOAuth( $key, $secret );
		$admin_url = admin_url( 'admin.php' );
		$callback_url = add_query_arg( array( 'page' => 'jw-twit-options' ), $admin_url );

		// Callback URL
		$temp_creds = $con->getRequestToken( $callback_url );

		// Now we redirect the user to the 'authorize' page for twitter
		wp_redirect( $con->getAuthorizeURL( $temp_creds, 1, 1 ) );
		exit();
	}
}

$jw_twit_admin = new JwTwit();
$jw_twit_admin->hooks();