<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://www.davidkissinger.com
 * @since      1.0.0
 *
 * @package    Post_Data_Javascript
 * @subpackage Post_Data_Javascript/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Post_Data_Javascript
 * @subpackage Post_Data_Javascript/includes
 * @author     David Kissinger <david@davidkissinger.com>
 */
class Post_Data_Javascript_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'post-data-javascript',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
