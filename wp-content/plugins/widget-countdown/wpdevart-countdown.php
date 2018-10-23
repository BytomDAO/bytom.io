<?php
/*
Plugin Name: Countdown Wpdevart 
Plugin URI: http://wpdevart.com/wordpress-countdown-plugin/
Description: Countdown plugin is an nice tool to create and insert countdown timers into your posts/pages and widgets .
Version: 1.9.9
Author: wpdevart
Author URI: http://wpdevart.com 
License: GPL3 http://www.gnu.org/licenses/gpl-3.0.html
*/
 

class wpdevart_countdown_main{
	// required variables
	
	private $wpdevart_countdown_plugin_url;
	
	private $wpdevart_countdown_plugin_path;
	
	private $wpdevart_countdown_version;
	
	public $wpdevart_countdown_options;

	/*###################### Construct function ##################*/	
	
	function __construct(){
		
		$this->wpdevart_countdown_plugin_url  = trailingslashit( plugins_url('', __FILE__ ) );
		$this->wpdevart_countdown_plugin_path = trailingslashit( plugin_dir_path( __FILE__ ) );
		//
		define("wpdevart_countdown_support_url","https://wordpress.org/support/plugin/widget-countdown");
		
		if(!class_exists('wpdevart_countdown_setting'))
			require_once($this->wpdevart_countdown_plugin_path.'includes/library.php');
		
		$this->call_base_filters();
		$this->create_admin_menu();	
		$this->wpdevart_countdown_front_end();
		
	}

	/*###################### Create admin menu function ##################*/
	
	public function create_admin_menu(){
		
		require_once($this->wpdevart_countdown_plugin_path.'includes/admin_menu.php');
		
		$wpdevart_countdown_admin_menu = new wpdevart_countdown_admin_menu(array('menu_name' => 'Countdown','databese_parametrs'=>$this->wpdevart_countdown_options));
		
		add_action('admin_menu', array($wpdevart_countdown_admin_menu,'create_menu'));
		
	}

	/*###################### Countdown front end function ##################*/
	
	public function wpdevart_countdown_front_end(){
		
		require_once($this->wpdevart_countdown_plugin_path.'includes/front_end.php');
		require_once($this->wpdevart_countdown_plugin_path.'includes/widget.php');

		$wpdevart_countdown_front_end = new wpdevart_countdown_front_end(array('menu_name' => 'countdown','databese_parametrs'=>$this->wpdevart_countdown_options));
		
	}

    /*############ Register required scripts function ##################*/
	
	public function registr_requeried_scripts(){
		wp_register_script('countdown-front-end',$this->wpdevart_countdown_plugin_url.'includes/javascript/front_end_js.js');
		wp_register_style('countdown_css',$this->wpdevart_countdown_plugin_url.'includes/style/style.css');
		wp_register_style('animated',$this->wpdevart_countdown_plugin_url.'includes/style/effects.css');
		
		// datepicker
		wp_register_script('foundation-datepicker',$this->wpdevart_countdown_plugin_url.'includes/javascript/foundation-datepicker.min.js');
		wp_register_style('foundation-datepicker',$this->wpdevart_countdown_plugin_url.'includes/style/foundation-datepicker.min.css');	
	}

	/*###################### Call base filters function ##################*/	
	
	public function call_base_filters(){
		add_action( 'init',  array($this,'registr_requeried_scripts') );
		add_action( 'admin_head',  array($this,'include_requeried_scripts') );
		//for_upgrade
		add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), array($this,'plugin_activate_sublink') );
	}
	
	/*###################### Activate sublink function ##################*/	
	
	public function plugin_activate_sublink($links){
		$plugin_submenu_added_link=array();		
		 $added_link = array(
		 '<a target="_blank" style="color: rgba(10, 154, 62, 1); font-weight: bold; font-size: 13px;" href="http://wpdevart.com/wordpress-countdown-plugin">Upgrade to Pro</a>',
		 );
		$plugin_submenu_added_link=array_merge( $plugin_submenu_added_link, $added_link );
		$plugin_submenu_added_link=array_merge( $plugin_submenu_added_link, $links );
		return $plugin_submenu_added_link;
	}
	
    /*###################### Requeried scripts function ##################*/
	
  	public function include_requeried_scripts(){
		wp_enqueue_script('wp-color-picker');
		wp_enqueue_style( 'wp-color-picker' );
		// datepicker
		wp_enqueue_script('foundation-datepicker');
		wp_enqueue_style('foundation-datepicker');
	}

}
$wpdevart_countdown_main = new wpdevart_countdown_main();

?>