<?php
/*
Plugin Name: Rest Test
Plugin URI: http://github.com/lloc/rest-test/
Description: Demonstrates the technical aspects of my [downscaled] speech about the transition from Wordpress AJAX endpoints to Rest API
Author: Dennis Ploetner
Version: 0.0.1
Author URI: http://lloc.de/
*/

define( 'SIMPLE_PING_NS', 'lloc/v1' );

add_action( 'rest_api_init', function () {
	register_rest_route( SIMPLE_PING_NS, 'ping', [
			'methods'  => \WP_REST_Server::EDITABLE,
			'callback' => 'simple_ping',
			'args'     => [ 'msg' => [ 'required' => true ] ],
		]
	);

} );

function simple_ping( WP_REST_Request $request ) {
	$data = 'Sorry, but I expected a "ping".';

	if ( 'ping' == $request->get_param( 'msg' ) ) {
		$data = 'pong';
	}

	return rest_ensure_response( $data );
}

add_action( 'wp_enqueue_scripts', function () {
	$handle   = 'simple-ping';
	$src      = plugins_url( 'simple-ping.js', __FILE__ );
	$endpoint = sprintf( '/wp-json/%s/', SIMPLE_PING_NS );

	wp_enqueue_script( $handle, $src, [ 'jquery' ] );
	wp_localize_script( $handle, 'LLOC', [
		'apiurl' => site_url( $endpoint )
	] );
} );
