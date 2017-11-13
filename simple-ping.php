<?php
/*
Plugin Name: Rest Test
Plugin URI: http://github.com/lloc/rest-test/
Description: Demonstrates the technical aspects of my [downscaled] speech about the transition from Wordpress AJAX endpoints to Rest API
Author: Dennis Ploetner
Version: 0.0.1
Author URI: http://lloc.de/
*/

add_action( 'wp_ajax_simple_ping', 'simple_ping' );
add_action( 'wp_ajax_nopriv_simple_ping', 'simple_ping' );

function simple_ping() {
	if ( 'ping' == $_REQUEST['msg'] ) {
		wp_send_json_success( 'pong' );
	}

	wp_send_json_error( 'Sorry, but I expected a "ping".' );
}

add_action( 'wp_enqueue_scripts', function () {
	$handle = 'simple-ping';
	$src    = plugins_url( 'simple-ping.js', __FILE__ );

	wp_enqueue_script( $handle, $src, [ 'jquery' ] );
	wp_localize_script( $handle, 'LLOC', [
		'ajaxurl' => admin_url( 'admin-ajax.php' )
	] );
} );
