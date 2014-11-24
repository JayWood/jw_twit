<?php

/**
 * Admin Includes File
 */

class JwTwit {

	public function hooks(){
		add_action( 'admin_enqueue_scripts', array( $this, 'queue_scripts' ) );
	}

	public function queue_scripts(){
		$script_url = plugins_url( 'css/jw_twit.css', dirname( __FILE__ ) );
		error_log( $script_url );

		wp_register_style( 'jwtwit_css', plugins_url( 'css/jw_twit.css', dirname( __FILE__ ) ), false, '1.0' );
		wp_register_script( 'jwtwit_js', plugins_url( 'js/jquery_jw_twit.js', dirname( __FILE__ ) ), array( 'jquery' ), '1.0', true );

		wp_enqueue_style( 'jwtwit_css' );
		wp_enqueue_script( 'jwtwit_js' );
	}
}

$jw_twit = new JwTwit();
$jw_twit->hooks();