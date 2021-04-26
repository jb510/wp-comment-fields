<?php
/*
Plugin Name: WP Comments Fields Manager (Temporary Fork by 9seeds)
Plugin URI: http://www.najeebmedia.com
Description: This plugin allow users to add custom fields in post comments area.
Version: 1.8
Author: Najeeb Ahmad
Author URI: http://www.najeebmedia.com/
Text Domain: nm-wpcomments
Domain Path:
*/

/*
 * This is an unmaintained fork for WP Comments Fields Manager by Jon Brown / 9seeds
 *
 * https://profiles.wordpress.org/jb510/
 * https://9seeds.com/
 *
 * All that has been really been done is fixing some path references and removing die() functions.
 *
 * Both of these were causing breakage, including to WP CLI.
 *
 * The original used a hardcoded slug and which in turn was being put into an object $plugin_meta,
 * however, then that object was get called in methods that didn't actually have access to it.
 * Rather than fix that I just replaced those usages with get functions which is how I prefer
 * to do things.
 *
 * While this fork may work for you, I'd encourage you to switch back to the offical
 * version from the .org repo as soon as it is updated.
 *
 * Please see https://wordpress.org/support/topic/plugin-still-kills-cli-execution-2/
 *
 */


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Get the plugin url.
 *
 * @access public
 * @return string
 */
function wpcf_get_url() {
		return untrailingslashit( plugins_url( '/', __FILE__ ) );
}

/**
 * Get the plugin path.
 *
 * @access public
 * @return string
 */
function wpcf_get_path() {
		return untrailingslashit( plugin_dir_path( __FILE__ ) );
}

/**
 * Get the plugin classes path.
 *
 * @access public
 * @return string
 */
function wpcf_get_class_path() {
		return untrailingslashit( plugin_dir_path( __FILE__ ) . '/classes/' );
}


/*
 * loading plugin config file
 */
require_once wpcf_get_path() . '/config.php';

/* ======= the plugin main class =========== */
require_once wpcf_get_class_path() . '/plugin.class.php';

/*
 * [1]
 * TODO: just replace class name with your plugin
 */
$nmwpcomment = NM_PLUGIN_WPComments::get_instance();
NM_PLUGIN_WPComments::init();


if ( is_admin() ) {
	require_once wpcf_get_class_path() . '/admin.class.php';
}

/*
 * activation/install the plugin data
*/
register_activation_hook( __FILE__, array( 'NM_PLUGIN_WPComments', 'activate_plugin' ) );
register_deactivation_hook( __FILE__, array( 'NM_PLUGIN_WPComments', 'deactivate_plugin' ) );
