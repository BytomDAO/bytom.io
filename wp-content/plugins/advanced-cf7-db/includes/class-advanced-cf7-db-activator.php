<?php

/**
 * Fired during plugin activation
 *
 * @link       https://www.vsourz.com
 * @since      1.0.0
 *
 * @package    Advanced_Cf7_Db
 * @subpackage Advanced_Cf7_Db/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Advanced_Cf7_Db
 * @subpackage Advanced_Cf7_Db/includes
 * @author     vsourz Digital <mehul@vsourz.com>
 */
class Advanced_Cf7_Db_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		
		global $wpdb;
		if (function_exists('is_multisite') && is_multisite()) {
        // check if it is a network activation - if so, run the activation function for each blog id
             $old_blog = $wpdb->blogid;
            // Get all blog ids
            $blogids = $wpdb->get_col("SELECT blog_id FROM $wpdb->blogs");
            foreach ($blogids as $blog_id) {
                switch_to_blog($blog_id);
                create_table_cf7_vdata();
				create_table_cf7_vdata_entry();
				create_f7_capability();
            }
            switch_to_blog($old_blog);
		}else{
				create_table_cf7_vdata();
				create_table_cf7_vdata_entry();
				create_f7_capability();
		}

	} 

}	

/**
 * Contact Form submitted table created from here
 */

function create_table_cf7_vdata(){
	
	global $wpdb;
	$table_name = $wpdb->prefix .'cf7_vdata';
	
	$charset_collate = $wpdb->get_charset_collate();
	if( $wpdb->get_var( "show tables like '{$table_name}'" ) != $table_name ) {
        $sql = "CREATE TABLE " . $table_name . " (
             `id` int(11) NOT NULL AUTO_INCREMENT,
			 `created` timestamp NOT NULL,
			  UNIQUE KEY id (id)
		)$charset_collate;";
		
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );
    }
}
/**
 * Contact Form entry table created from here
 */

function create_table_cf7_vdata_entry(){
	global $wpdb;
	$table_name = $wpdb->prefix .'cf7_vdata_entry';
	$charset_collate = $wpdb->get_charset_collate();
	if( $wpdb->get_var( "show tables like '{$table_name}'" ) != $table_name ) {
        $sql = "CREATE TABLE " . $table_name . " (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`cf7_id` int(11) NOT NULL,
				`data_id` int(11) NOT NULL,
				`name` varchar(250),
				`value` text,
				UNIQUE KEY id (id)
		)$charset_collate;";
		
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );
    }
}

function create_f7_capability(){
// Add Capability when update plugin 
			$role = get_role( 'administrator');
			$args = array('post_type' => 'wpcf7_contact_form', 'posts_per_page' => -1); 
			$cf7Forms = get_posts( $args );
			foreach($cf7Forms as $data){
				$role->add_cap('cf7_db_form_view'.$data->ID);
				$role->add_cap('cf7_db_form_edit_'.$data->ID);
			}
}			