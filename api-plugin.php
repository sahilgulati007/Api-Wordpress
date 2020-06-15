<?php
/**
 * Plugin Name:       Api Plugin
 * Plugin URI:        https://example.com/plugins/the-basics/
 * Description:       Handle the basics with this plugin.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Sahil Gulati
 * Author URI:        https://author.example.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       api-plugin
 * Domain Path:       /languages
 */

global $myvar;

function myplugin_activate() {

  global $myvar;
  $myvar = wp_remote_get("http://www.json-generator.com/api/json/get/cggpujUDpK");
  // echo "<pre>";
  // var_dump($myvar); 
  // echo "</pre>";
  // wp_die();
}

register_activation_hook( __FILE__, 'myplugin_activate' );

add_action('myvarfunction', 'myvarfunction');

function myvarfunction(){

	global $myvar;
	$myvar = wp_remote_get("http://www.json-generator.com/api/json/get/cggpujUDpK");
	ob_start();
	echo "<pre>";
	// var_dump($myvar['body']); 
	print_r(json_decode($myvar['body']));
	echo "</pre>";
	return ob_get_clean();
}
add_shortcode( 'myvar', 'myvarfunction' );

//wp_remote_post example
function remotepost(){
$endpoint = 'api.example.com';
 
$body = [
    'name'  => 'Pixelbart',
    'email' => 'pixelbart@example.com',
];
 
$body = wp_json_encode( $body );
 
$options = [
    'body'        => $body,
    'headers'     => [
        'Content-Type' => 'application/json',
    ],
    'timeout'     => 60,
    'redirection' => 5,
    'blocking'    => true,
    'httpversion' => '1.0',
    'sslverify'   => false,
    'data_format' => 'body',
];
 
wp_remote_post( $endpoint, $options );
}