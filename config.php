<?php
/*
 * this file contains pluing meta information and then shared
 * between pluging and admin classes
 *
 * [1]
 * TODO: change this meta as plugin needs
 */


 // Updated as this still get used elsewhere in the plugin
$plugin_meta = array(
	'name'         => 'Comments Fields',
	'shortname'    => 'wpcomments',
	'path'         => wpcf_get_path(),
	'url'          => wpcf_get_url(),
	'db_version'   => 3.0,
	'logo'         => plugins_url( plugin_basename( __DIR__ ) . '/images/logo.png', dirname( __FILE__ ) ),
	'men_position' => 78,
);

/*
 * TODO: change the function name
*/
function get_plugin_meta_wpcomment() {

	global $plugin_meta;

	// print_r($plugin_meta);
	return $plugin_meta;
}

function wpcomment_pa1( $arr ) {

	echo '<pre>';
	print_r( $arr );
	echo '</pre>';
}
