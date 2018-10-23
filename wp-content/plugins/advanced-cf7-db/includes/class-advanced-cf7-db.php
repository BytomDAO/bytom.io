<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://www.vsourz.com
 * @since      1.0.0
 *
 * @package    Advanced_Cf7_Db
 * @subpackage Advanced_Cf7_Db/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Advanced_Cf7_Db
 * @subpackage Advanced_Cf7_Db/includes
 * @author     vsourz Digital <mehul@vsourz.com>
 */
class Advanced_Cf7_Db {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Advanced_Cf7_Db_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->plugin_name = 'advanced-cf7-db';
		$this->version = '1.1.2';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Advanced_Cf7_Db_Loader. Orchestrates the hooks of the plugin.
	 * - Advanced_Cf7_Db_i18n. Defines internationalization functionality.
	 * - Advanced_Cf7_Db_Admin. Defines all hooks for the admin area.
	 * - Advanced_Cf7_Db_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-advanced-cf7-db-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-advanced-cf7-db-i18n.php';
		
		/**
		 * The file responsible for defining all functions that used in both admin and frontend
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/vsz-cf7-db-function.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-advanced-cf7-db-admin.php';
		
		/*
		*** For dom pdf
		*/
		// require_once(dirname(dirname(__FILE__)).'/admin/pdfgenerate/dompdf/src/Dompdf.php');
		
		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		

		$this->loader = new Advanced_Cf7_Db_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Advanced_Cf7_Db_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Advanced_Cf7_Db_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Advanced_Cf7_Db_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		
		// Adding custom screen
		$this->loader->add_action('admin_menu', $plugin_admin, 'vsz_cf7_plugin_menu',9);
		
		//Get form related fields information 
		$this->loader->add_filter('vsz_cf7_admin_fields', $plugin_admin,'vsz_cf7_admin_fields_callback', 10, 2);
		
		//Display export option box throw this action
		$this->loader->add_action('vsz_cf7_after_bulkaction_btn', $plugin_admin,'vsz_cf7_after_bulkaction_btn_callback', 20, 2);
		
		//Display search text box here
		$this->loader->add_action('vsz_cf7_after_datesection_btn', $plugin_admin,'vsz_cf7_after_datesection_btn_callback', 20, 2);
		
		//Display "Display setting" banner here 
		$this->loader->add_action('vsz_cf7_display_settings_btn', $plugin_admin,'vsz_cf7_display_settings_btn_callback', 20);
		
		
		//Add additional table header here
		$this->loader->add_action('vsz_cf7_admin_after_heading_field',$plugin_admin, 'vsz_cf7_admin_after_heading_field_callback', 11, 2);
		
		//Display edit information link here
		$this->loader->add_action('vsz_cf7_admin_after_body_field',$plugin_admin, 'vsz_cf7_admin_after_body_edit_field_func', 21, 2);
		
		//Display field setting form here 
		$this->loader->add_action('vsz_cf7_after_admin_form', $plugin_admin,'vsz_cf7_after_admin_setting_form_callback');
		//Display edit entry form here
		$this->loader->add_action('vsz_cf7_after_admin_form', $plugin_admin,'vsz_cf7_after_admin_edit_values_form_callback');
		
		//Save all other additionals values here
		$this->loader->add_action('admin_init', $plugin_admin,'vsz_cf7_save_setting_callback');
		
		//Call Ajax for display entry related form information in edit form
		$this->loader->add_action('wp_ajax_vsz_cf7_edit_form_value',$plugin_admin, 'vsz_cf7_edit_form_ajax');
		
		//Define filter for which field information  not editable in edit form 
		$this->loader->add_filter('vsz_cf7_not_editable_fields',$plugin_admin, 'vsz_cf7_not_editable_fields_callback');

		// Multi site support
		$this->loader->add_action( 'wpmu_new_blog',$plugin_admin,'vsz_cf7_add_new_table_for_sites', 10, 6);
		
		// Provide multi site support for active plugin
		$this->loader->add_action( 'plugins_loaded',$plugin_admin,'vsz_cf7_create_new_table_for_sites');
		
		// Provide custom capability
		$this->loader->add_action('save_post',$plugin_admin,'vsz_cf7_create_role_for_contact_form');
		
		// Edit Popup file upload
		$this->loader->add_action('wp_ajax_acf7_db_edit_scr_file_upload',$plugin_admin,'vsz_acf7_db_edit_scr_file_upload');
		
		// Edit Popup file delete
		$this->loader->add_action('wp_ajax_acf7_db_edit_scr_file_delete',$plugin_admin,'vsz_acf7_db_edit_scr_file_delete');
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Advanced_Cf7_Db_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
