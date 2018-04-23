<?php
/*
Plugin Name: Rest Test
Plugin URI: http://github.com/lloc/rest-test/
Description: Demonstrates the technical aspects of my [downscaled] speech about the transition from Wordpress AJAX endpoints to Rest API
Author: Dennis Ploetner
Version: 0.0.1
Author URI: http://lloc.de/
*/

namespace lloc\sp;

add_action( 'rest_api_init', function () {
	register_rest_route( 'lloc/v1', 'ping', [
			'methods'  => \WP_REST_Server::EDITABLE,
			'callback' => 'simple_ping',
			'args'     => [ 'msg' => [ 'required' => true ] ],
		]
	);
} );

function simple_ping( \WP_REST_Request $request ): \WP_REST_Response {
	$data = 'ping' == $request->get_param( 'msg' ) ? 'pong' : 'Huhh?';

	return rest_ensure_response( $data );
}

add_action( 'wp_enqueue_scripts', function () {
	$handle   = 'simple-ping';
	$src      = plugins_url( 'simple-ping.js', __FILE__ );
	$endpoint = '/wp-json/lloc/v1/';

	wp_enqueue_script( $handle, $src, [ 'jquery' ] );
	wp_localize_script( $handle, 'LLOC', [
		'apiurl' => site_url( $endpoint )
	] );
} );
