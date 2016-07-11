<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://www.davidkissinger.com
 * @since      1.0.0
 *
 * @package    Post_Data_Javascript
 * @subpackage Post_Data_Javascript/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Post_Data_Javascript
 * @subpackage Post_Data_Javascript/public
 * @author     David Kissinger <david@davidkissinger.com>
 */
class Post_Data_Javascript_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since      1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */

	 /**
	 * The options name to be used in this plugin
	 *
	 * @since     1.0.0
	 * @access 	  private
	 * @var     	string 		$option_name 	Option name of this plugin
	 * @link     https://www.sitepoint.com/wordpress-plugin-boilerplate-part-2-developing-a-plugin/
	 */
	private $option_name = 'post_data_javascript';

	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Post_Data_Javascript_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Post_Data_Javascript_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/post-data-javascript-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * An instance of this class should be passed to the run() function
		 * defined in Post_Data_Javascript_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Post_Data_Javascript_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		 /**
 		 * @global    post    Bring in the current post to see what it is
 		 * @since     1.0.0
 		 *
 		 */
		 global $post;

    /**
		 * Enqueue public script and put data on the DOM in JavaScript if
		 * permitted.
		 *
		 */
		 $post_type = get_post_type();
		 if ( $post_type === get_option( $this->option_name . '_posttype_' . $post_type ) ) :

			/**
			 * This is the default enqueue action for this boilerplate.
			 * @link    http://wppb.io/
			 * @see     wp_enqueue_script
			 * wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/post-data-javascript-public.js', array( 'jquery' ), $this->version, false );
	     */

			 /**
	 		 * Enqueues JS file with localize script to send post data.
			 *
			 * Hooked into `wp_enqueue_scripts` to load the script and localize it with post data
			 * if the current post type is permitted from the admin settings menu
			 *
	 		 * @link     http://wppb.io/
	 		 * @see      wp_enqueue_script
			 * @see      wp_localize_script
	 		 * @since    1.0.0
	 		 * wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/post-data-javascript-public.js', array( 'jquery' ), $this->version, false );
	      */
			 wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/post-data-javascript.js', array( 'jquery' ), $this->version, false );

			 $params = $this->get_params( $post );

			 wp_localize_script( $this->plugin_name, 'postData', $params );

	   endif;
	}

  /**
	 * Creates a list of params for wp_localize_script
	 *
	 * Pulls a list of all fields in the current post type, and then
	 * strips out those beginning with '_' which indicates that they are private fields.
	 *
	 * @since     1.0.0
	 * @see       wp_localize_script
	 * @param     object    $post    The current post, invoked as `global $post`
	 * @return    array of field names (string)
	 */
	public function get_params( $post ) {
		$params = array();
		$custom_fields = get_post_custom( $post->ID );
		foreach( $custom_fields as $key => $value ) {
			if ( substr( $key, 0, 1 ) !== '_' ) {
				$params[$key] = $value;
			}
		}
		return $params;
	}

}
