<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://www.davidkissinger.com
 * @since             1.0.0
 * @package           Post_Data_Javascript
 *
 * @wordpress-plugin
 * Plugin Name:       Post Data to JavaScript
 * Plugin URI:        http://www.davidkissinger.com
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            David Kissinger
 * Author URI:        http://www.davidkissinger.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       post-data-javascript
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-post-data-javascript-activator.php
 */
function activate_post_data_javascript() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-post-data-javascript-activator.php';
	Post_Data_Javascript_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-post-data-javascript-deactivator.php
 */
function deactivate_post_data_javascript() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-post-data-javascript-deactivator.php';
	Post_Data_Javascript_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_post_data_javascript' );
register_deactivation_hook( __FILE__, 'deactivate_post_data_javascript' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-post-data-javascript.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_post_data_javascript() {

	$plugin = new Post_Data_Javascript();
	$plugin->run();

}
run_post_data_javascript();
