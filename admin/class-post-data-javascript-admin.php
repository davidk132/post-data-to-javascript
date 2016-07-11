<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://www.davidkissinger.com
 * @since      1.0.0
 *
 * @package    Post_Data_Javascript
 * @subpackage Post_Data_Javascript/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Post_Data_Javascript
 * @subpackage Post_Data_Javascript/admin
 * @author     David Kissinger <david@davidkissinger.com>
 */
class Post_Data_Javascript_Admin {

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
	 * The options name to be used in this plugin
	 *
	 * @since  	1.0.0
	 * @access 	private
	 * @var  	string 		$option_name 	Option name of this plugin
	 * @link https://www.sitepoint.com/wordpress-plugin-boilerplate-part-2-developing-a-plugin/
	 */
	private $option_name = 'post_data_javascript';

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/post-data-javascript-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/post-data-javascript-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Add options page under the Settings menu which will allow admin user to
	 * select which post types will expose post data in JavaScript
	 *
	 * @since    1.0.0
	 */
	 public function add_options_page() {
		 $this->plugin_screen_hook_suffix = add_options_page(
		   __( 'Post Data to JavaScript Settings', 'post-data-javascript' ), // page title
			 __( 'Post Data to JavaScript', 'post-data-javascript' ), // menu title
			 'manage_options', // user permission level required
			 $this->plugin_name, // page slug
			 array( $this, 'display_options_page' ) // callback
		 );
	 }
	 /**
 	 * Display the form and headers on the designated admin menu page
 	 *
 	 * @since    1.0.0
 	 */

	 public function display_options_page() {
		 include_once 'partials/post-data-javascript-admin-display.php';
	 }

	 /**
 	 *
 	 * Set up the admin form, according to the Settings API
 	 *
	 * Creates a section on the page, named `$this->plugin_name`
	 * Loops through publicly available post types (post, page and custom)
	 * and for each one adds a settings field and registers with Settings API.
	 *
 	 * @since    1.0.0
 	 */
	 public function post_data_javascript_build_settings() {
		 // Add a general section
		 add_settings_section(
		   $this->option_name . '_general', // section slug
			 __( 'General', 'post-data-javascript' ), // Section title
			 array( $this, $this->option_name . '_general_cb' ), // callback for basic info
			 $this->plugin_name // admin page slugs
		 );

		 // Create the setting fields
		 foreach ( get_post_types( array( 'public' => true ) ) as $post_type ) {
			 add_settings_field(
			   $this->option_name . '_posttype_' . $post_type, // field slug
				 __( 'post type:', 'post-data-javascript' ), // field description
				 array( $this, $this->option_name . '_posttype_cb' ), // callback rendering HTML input
				 $this->plugin_name, // admin page slug
				 $this->option_name . '_general', // section slug
				 array( 'post_type' => $post_type ) // args sent to callback rendering HTML input
		   );

			 register_setting(
			 	$this->plugin_name, // admin page slug
				$this->option_name . '_posttype_' . $post_type, // field slug
				array( $this, $this->option_name . '_sanitize' ) // sanitization callback
			 );
		 }
	 }

	 /**
	  *
		* Function to santize input from checkbox
		*
		* Note that when a checkbox is checked, the value returned is `name` from the HTML!!
		*
	  * @since    1.0.0
		* @param    string    $input    data captured in checkbox form
		* @link    https://gist.github.com/saas786/836631c2f6ced848931c#file-sanitize_checkbox-php-L14
		*/
	 public function post_data_javascript_sanitize( $input ) {
		 if ( in_array( $input, get_post_types( array( 'public' => true ) ), true ) ) {
			 return $input;
		 }
	 }

   /**
    *
		* Callback to render section description
		*
		* This funtion must echo its results
		*
		* @since    1.0.0
	  */
	 public function post_data_javascript_general_cb() {
		 echo ('<p>' . __( 'Select which post types you would like to expose on the DOM as a JavaScript object', 'post-data-javascript' ) . '</p>');
	 }

	 /**
	 * Render the checkbox input field
   *
	 * This function must echo its results
	 * Note that when a checkbox is checked, the value returned is `name` from the HTML!!
	 *
	 * @since    1.0.0
	 * @param    array    $args    array of args sent by callback in `add_settings_field`
	 * @var      string   $post_type    name of the post type rendered on checkbox line
	 * @var      string   $checked    whether item is stored in options tabled. If the name
	 *           of the post type is stored, then it is considered `checked`.
	 * @see      get_option
	 */
	public function post_data_javascript_posttype_cb( array $args) {
		$post_type = $args['post_type'];
		$checked = ( $post_type === get_option( $this->option_name . '_posttype_' . $post_type ) ) ? "checked" : "";
		echo '<input type="checkbox" name="' . $this->option_name . '_posttype_' . $post_type . '" value="' . $post_type . '" ' . $checked . '>' . $post_type . '<br />';
	}

}
