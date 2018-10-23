<?php

/**
 *
 * @link              http://athemes.com
 * @since             1.0
 * @package           Sydney_Toolbox
 *
 * @wordpress-plugin
 * Plugin Name:       Sydney Toolbox
 * Plugin URI:        http://athemes.com/plugins/sydney-toolbox
 * Description:       Registers custom post types and custom fields for the Sydney theme
 * Version:           1.01
 * Author:            aThemes
 * Author URI:        http://athemes.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       sydney-toolbox
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Set up and initialize
 */
class Sydney_Toolbox {

	private static $instance;

	/**
	 * Actions setup
	 */
	public function __construct() {

		add_action( 'plugins_loaded', array( $this, 'constants' ), 2 );
		add_action( 'plugins_loaded', array( $this, 'i18n' ), 3 );
		add_action( 'plugins_loaded', array( $this, 'includes' ), 4 );
		add_action( 'admin_notices', array( $this, 'admin_notice' ), 4 );
	}

	/**
	 * Constants
	 */
	function constants() {

		define( 'ST_DIR', trailingslashit( plugin_dir_path( __FILE__ ) ) );
		define( 'ST_URI', trailingslashit( plugin_dir_url( __FILE__ ) ) );
	}

	/**
	 * Includes
	 */
	function includes() {

		//Post types
		require_once( ST_DIR . 'inc/post-type-services.php' );
		require_once( ST_DIR . 'inc/post-type-employees.php' );
		require_once( ST_DIR . 'inc/post-type-testimonials.php' );	
		require_once( ST_DIR . 'inc/post-type-clients.php' );
		require_once( ST_DIR . 'inc/post-type-projects.php' );
		require_once( ST_DIR . 'inc/post-type-timeline.php' );		
		//Metaboxes
		require_once( ST_DIR . 'inc/metaboxes/services-metabox.php' );	
		require_once( ST_DIR . 'inc/metaboxes/employees-metabox.php' );	
		require_once( ST_DIR . 'inc/metaboxes/testimonials-metabox.php' );
		require_once( ST_DIR . 'inc/metaboxes/clients-metabox.php' );
		require_once( ST_DIR . 'inc/metaboxes/projects-metabox.php' );
		require_once( ST_DIR . 'inc/metaboxes/timeline-metabox.php' );
		require_once( ST_DIR . 'inc/metaboxes/singles-metabox.php' );
	}

	/**
	 * Translations
	 */
	function i18n() {
		load_plugin_textdomain( 'sydney-toolbox', false, 'sydney-toolbox/languages' );
	}

	/**
	 * Admin notice
	 */
	function admin_notice() {
		$theme  = wp_get_theme();
		$parent = wp_get_theme()->parent();
		if ( ($theme != 'Sydney' ) && ($theme != 'Sydney Pro' ) && ($parent != 'Sydney') && ($parent != 'Sydney Pro') ) {
		    echo '<div class="error">';
		    echo 	'<p>' . __('Please note that the <strong>Sydney Toolbox</strong> plugin is meant to be used only with the <a href="http://wordpress.org/themes/sydney/" target="_blank">Sydney theme</a></p>', 'sydney-toolbox');
		    echo '</div>';			
		}
	}

	/**
	 * Returns the instance.
	 */
	public static function get_instance() {

		if ( !self::$instance )
			self::$instance = new self;

		return self::$instance;
	}
}

function sydney_toolbox_plugin() {
	if ( !function_exists('wpcf_init') ) //Make sure the Types plugin isn't active
		return Sydney_Toolbox::get_instance();
}
add_action('plugins_loaded', 'sydney_toolbox_plugin', 1);