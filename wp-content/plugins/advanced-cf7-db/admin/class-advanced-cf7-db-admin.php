<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.vsourz.com
 * @since      1.0.0
 *
 * @package    Advanced_Cf7_Db
 * @subpackage Advanced_Cf7_Db/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Advanced_Cf7_Db
 * @subpackage Advanced_Cf7_Db/admin
 * @author     vsourz Digital <mehul@vsourz.com>
 */
class Advanced_Cf7_Db_Admin {

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
		 * defined in Advanced_Cf7_Db_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Advanced_Cf7_Db_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_register_style( 'vsz-cf7-db-admin-css', plugin_dir_url( __FILE__ ) . 'css/advanced-cf7-db-admin.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'font_awesome_css', plugin_dir_url( __FILE__ ) . 'css/font-awesome.css', array(), $this->version, 'all' );
		wp_register_style( 'jquery-datetimepicker-css', plugin_dir_url( __FILE__ ) . 'css/jquery.datetimepicker.css', array(), $this->version, 'all');

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
		 * defined in Advanced_Cf7_Db_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Advanced_Cf7_Db_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/advanced-cf7-db-admin.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( 'datepicker-min-js', plugin_dir_url( __FILE__ ) . 'js/jquery.datetimepicker.js', array( 'jquery' ), $this->version, false );

	}

	////////////// to add admin screens for Contact form Db and Import CSV
	function vsz_cf7_plugin_menu(){
		///// Menu pages for contact form DB


		$cap = 'no_access';
		// Check if user have access than display

		$user_id = get_current_user_id();
		$subject = new WP_User($user_id);
		$allcaps= $subject->allcaps;
		$caps = $subject->caps;

		$caps    = array_merge(wp_get_current_user()->caps, $caps);
		$allcaps = array_merge(wp_get_current_user()->allcaps, $allcaps);
		if (wp_get_current_user()->ID == $subject->ID) {
			wp_get_current_user()->allcaps = $allcaps;
			wp_get_current_user()->caps    = $caps;
		}
		$user = wp_get_current_user();

		//$role = get_role('subscriber');
		//var_dump($user);exit;
		if(isset($user) && !empty($user)){
			foreach($user->allcaps as $key=>$capability){
				if($capability == true){
					if(strpos($key, 'cf7_db_form_edit_') !== false){
						$cap = 'exist';

						break;
					}
				}
			}
		}

		if($cap == 'no_access'){
			if(isset($user) && !empty($user)){
				foreach($user->allcaps as $key=>$capability){
					if($capability == true){
						if(strpos($key, 'cf7_db_form_view') !== false){

							$cap = 'exist';
							break;
						}
					}
				}
			}
		}

		add_menu_page( "Advanced CF7 DB", "Advanced CF7 DB", $cap, "contact-form-listing", array($this,"vsz_contact_form_callback"), 'dashicons-visibility' , 45);
		///// Menu pages for Import CSV
		add_submenu_page( 'contact-form-listing', __('Import CSV', 'advanced-cf7-db'), __('Import CSV', ' advanced-cf7-db'), $cap, 'import_cf7_csv',array($this,'vsz_import_cf7_csv') );
	}

	// Callback function for listing screen
	function vsz_contact_form_callback(){
		//Check current user permission

/* 		if (!current_user_can('manage_options'))  {
			wp_die( __('You do not have sufficient permissions to access this page.') );
		} */
		wp_enqueue_style('vsz-cf7-db-admin-css');
		//Define all entry related design in this file
		require_once plugin_dir_path( __FILE__ ) . 'partials/contact_form_listing.php';
	}

	// Callback function for Import CSV screen
	function vsz_import_cf7_csv(){
		//Check current user permission
		/* if (!current_user_can('manage_options'))  {
			wp_die( __('You do not have sufficient permissions to access this page.') );
		} */
		//Define import CSV screen design in this file
		require_once plugin_dir_path( __FILE__ ) . 'partials/import_cf7_csv.php';
	}

	//Get form related all fields information here
	function vsz_cf7_admin_fields_callback($fields, $fid){
		$return = array();
		$fid = (int)$fid;
		//Get current form related field setting value from option table
		$field_settings = get_option('vsz_cf7_settings_field_' . $fid, array());
		//Check field settings value empty or not
		if ($field_settings == "") {
			$field_settings = array();
		}
		//Check if field setting found then any field entry exist or not
		if(count($field_settings) == 0){ //no settings found

			//Get form id related contact form object
			$obj_form = vsz_cf7_get_the_form_list($fid);

			//get pre define form fields information
			if(isset($obj_form[0])){
				$arr_form_tag = $obj_form[0]->scan_form_tags();
			}
			else{
				$arr_form_tag = array();
			}

			/**** This functionality Added because when field settings not define then
				Fields display as per form design format*/

			//Check field exist with form or not
			if(!empty($arr_form_tag)){
				//Get all fields related information
				foreach($arr_form_tag as $key => $arr_type){
					//Check if tag type is submit then ignore tag info
					if($arr_type['basetype'] == 'submit') continue;
					//Check if field name match with form field name or not
					if(isset($arr_type['name']) && array_key_exists($arr_type['name'],$fields)){
						//If field type match with form field name then set field name in array
						$return[$arr_type['name']] = $fields[$arr_type['name']];
						//Remove current keys from field array
						unset($fields[$arr_type['name']]);
					}
				}//Close for for each
			}//Close if for field check

			//Check any fields remaining in field array or not which is not define in Current Form
			if(count($fields) > 0){
				//Remaining fields add in array
				$return =  array_merge($return,$fields);
			}
		}//Close field setting IF
		//If fields setting found in option table
		else{
			//Fetch fields information from array
			foreach ($field_settings as $k => $v) {
				//Check Current DB fields with setting field name exist or not
				if(isset($fields[$k])){
					//If field exist with field array then get current field display information
					$show = (int)$field_settings[$k]['show'];
					//If condition is true then field display on Listing screen and export Sheet.
					if ($show == 1){
						//Get field label name and set in array
						$label = $field_settings[$k]['label'];
						$return[$k] = esc_html($label);
					}
					//Unset current field from fields array
					unset($fields[$k]);
				}//Close if
			}//Close foreach

			//Check any field is remaining in array or not
			if (count($fields) > 0) {
				//Set all remaining fields name in array
				foreach ($fields as $k => $v) {
					$return[$k] = esc_html($v);
				}
			}
		}//Close else
		//return all existing fields information in array format here
		return $return;
	}//Close function for fields related information

	//Define Export option box on form listing screen
	function vsz_cf7_after_bulkaction_btn_callback($fid){
		$fid = (int)$fid;
		?><!-- Display Export functionality button here-->
		<select id="vsz-cf7-export" name="vsz-cf7-export" data-fid="<?php echo $fid; ?>">
			<option value="-1"><?php _e('Export to...'); ?></option>
			<option value="csv"><?php _e('CSV'); ?></option>
			<option value="excel"><?php _e('Excel'); ?></option>
			<option value="pdf"><?php _e('PDF'); ?></option>
		</select>
		<button class="button action" title="<?php _e('Export'); ?>" type="submit" name="btn_export"><?php _e('Export'); ?></button><?php
	}//Close export option function

	//Display Search text box design structure here
	function vsz_cf7_after_datesection_btn_callback($fid){
		//Get menu page URL
		$url = menu_page_url('contact-form-listing',false);
		//Check form id is define in current page or not if defirn then current form ID add with existing URL
		if(isset($_REQUEST['cf7_id']) && !empty($_REQUEST['cf7_id'])){
			$fid = intval($_REQUEST['cf7_id']);
			$url .= '&cf7_id='.$fid;
		}
		?><input value="<?php echo ((isset($_POST['search_cf7_value'])) && !empty($_POST['search_cf7_value']) ? htmlspecialchars(stripslashes(sanitize_text_field($_POST['search_cf7_value']))) : ''); ?>" type="text" class="" id="cf7d-search-q" name="search_cf7_value" placeholder="<?php echo _e('Type something...'); ?>" id="" />
		<button data-url="<?php echo esc_url($url); ?>" class="button" type="button" id="cf7d-search-btn" title="<?php _e('Search'); ?>" ><?php _e('Search'); ?></button>
		<?php
	}//Close search box design function

	//Display table header in edit column here
	function vsz_cf7_admin_after_heading_field_callback(){
		?><th style="width: 32px;" class="manage-column"><?php _e(''); ?></th><?php
	}

	//Display Settings popup here
	function vsz_cf7_display_settings_btn_callback(){

		//Define thickbox popup function
        add_thickbox();
		?><div class="span12">
			<div class="display-setup">
				<span>To change the Field title, Hide field and change the position of fields using Drag and Drop from here.</span>
				<a title="<?php _e('Display Settings'); ?>" href="#TB_inline?width=600&height=550&inlineId=cf7d-modal-setting" id="cf7d_setting_form" class="thickbox page-title-action" name="Display Settings"><?php _e('Display Settings'); ?></a>
			</div>
		</div><?php
	}

	//Display edit link with each entry in table
	function vsz_cf7_admin_after_body_edit_field_func($form_id, $row_id){
		//Define thickbox popup function
		add_thickbox();
		$row_id = (int)$row_id;
		?><td>
			<a data-rid="<?php echo $row_id; ?>" href="#TB_inline?width=600&height=550&inlineId=cf7d-modal-edit-value" id="cf7d-edit-form" class="thickbox cf7d-edit-value" name="Edit Information">
				<i class="fa fa-pencil-square-o" title="Edit" aria-hidden="true" style="font-size:20px;"></i>
			</a>
		</td><?php
	}

	//Define Display Setting Popup functionality here
	function vsz_cf7_after_admin_setting_form_callback($fid){

		$fid = intval($fid);
		//Get Current form related existing fields information
		$fields = vsz_cf7_get_db_fields($fid,false);
		$obj_form = vsz_cf7_get_the_form_list(intval($fid));
		//Get form related fields information
		$arr_form_tag = $obj_form[0]->scan_form_tags();

		//Create nonce values which is validate on SAVE time
		$nonce = wp_create_nonce( 'vsz-cf7-setting-nonce-'.$fid );
		//Define Design related structure here
		?><div id="cf7d-modal-setting" style="display:none;">
			<form action="" id="cf7d-modal-form" method="POST" class="setting-form">
            	<div class="popup-note"><span>You can rename the Field title, Hide field and change the position of fields using Drag and Drop from here.</span></div>
				<input type="hidden" name="fid" value="<?php echo $fid; ?>" />
				<input type="hidden" name="vsz_cf7_setting_nonce"  value="<?php echo $nonce; ?>" />
				<ul id="cf7d-list-field">

					<?php
					//Get form id related fields settings value from option table
					$field_settings = get_option('vsz_cf7_settings_field_' . $fid, array());
					$show_record = '';
					$show_record = get_option('vsz_cf7_settings_show_record_' . $fid, array());
					if(empty($show_record)){
						$show_record = 10;
					}?>
					<li class="ui-state-disabled"><span class="label">Show record</span> <input class="" type="text" name="cf7_show_record" value="<?php echo $show_record;?>"></li>
					<?php
					//Check fields setting define or not
					if($field_settings == ""){
						$field_settings = array();
					}
					//If fields setting not define then
					if(count($field_settings) == 0){ //no settings found
						//Fetch all existing fields information
						foreach ($arr_form_tag as $k => $v) {
							if($v->type == 'submit' || $v->type == 'recaptcha') continue;
							$show = 1;
							$k = esc_html($v->name);
							$label = esc_html($v->name);
							$show_hide_field = '<input type="hidden" class="txt_show" name="field['.$k.'][show]" value="'.$show.'" />';
							//Setup fields in Setting popup
							echo "<li class=\"".(($show == 1) ? "show" : "hide")."\">
									<span class=\"label\">".$k."</span>
									<input class=\"\" type=\"text\" name=\"field[".$k."][label]\" value=\"".$label."\" />
									<span class=\"dashicons dashicons-".(($show == 1) ? "visibility" : "hidden")."\"></span>
									".$show_hide_field."
								</li>";
							if(isset($fields[$v->name]))
								unset($fields[$v->name]);
						}
						if(!empty($fields) && count($fields) > 0){
							foreach ($fields as $k => $v) {
								$show = 1;
								$k = esc_html($v);
								$label = esc_html($v);
								$show_hide_field = '<input type="hidden" class="txt_show" name="field['.$k.'][show]" value="'.$show.'" />';
								//Setup fields in Setting popup
								echo "<li class=\"".(($show == 1) ? "show" : "hide")."\"><span class=\"label\">".$k."</span> <input class=\"\" type=\"text\" name=\"field[".$k."][label]\" value=\"".$label."\" /><span class=\"dashicons dashicons-".(($show == 1) ? "visibility" : "hidden")."\"></span>".$show_hide_field."</li>";
							}
						}
					}//close fields setting if
					//If fields settng found in option table
					else{
						//Display all existing fields information
						foreach ($field_settings as $k => $v) {
							if(isset($fields[$k])){
								//Get field related visiable and label information
								$k = esc_html($k);
								$show = (int)$field_settings[$k]['show'];
								$label = esc_html($field_settings[$k]['label']);
								//Set field display at front side or not information here
								$show_hide_field = '<input type="hidden" class="txt_show" name="field['.$k.'][show]" value="'.$show.'" />';
								//Display field in Setting POPUP
								echo "<li class=\"".(($show == 1) ? "show" : "hide")."\"><span class=\"label\">".$k."</span> <input class=\"\" type=\"text\" name=\"field[".$k."][label]\" value=\"".$label."\" /><span class=\"dashicons dashicons-".(($show == 1) ? "visibility" : "hidden")."\"></span>".$show_hide_field."</li>";
								//Unset current field from DB fields array
								unset($fields[$k]);
							}//Close if
						}//Close for each

						//Call when new field is added in existing form
						//Check any fields remaining in field array or not
						if (count($fields) > 0){
							//Fetch All remaining fields information
							foreach ($fields as $k => $v){
								$k = esc_html($k);
								$show = 1;
								$label = esc_html($v);
								//Set field display at front side or not information here
								$show_hide_field = '<input type="hidden" class="txt_show" name="field['.$k.'][show]" value="'.$show.'" />';
								//Display field in Setting POPUP
								echo "<li class=\"".(($show == 1) ? "show" : "hide")."\"><span class=\"label\">".$k."</span> <input class=\"\" type=\"text\" name=\"field[".$k."][label]\" value=\"".$label."\" /><span class=\"dashicons dashicons-".(($show == 1) ? "visibility" : "hidden")."\"></span>".$show_hide_field."</li>";
							}
						}//Close if for check remaining fields
					}//Close else
					?>

				</ul>

				<div id="cf7d-modal-footer">
					<input type="submit" name="vsz_save_field_settings" value="Save Changes" class="button button-primary button-large" />
				</div>
			</form>
			<script>
				jQuery(document).ready(function($) {
					//For using drag and drop js
					jQuery('#cf7d-list-field').sortable({
						placeholder: "sortable-placeholder",
						items: "li:not(.ui-state-disabled)"
					});
				});
			</script>
		</div><?php
	}//Close setting POPUP function here

	//Display edit popup related content for this function
	function vsz_cf7_after_admin_edit_values_form_callback($form_id){

		$form_id = intval($form_id);
		//Get form id related contact form object
		$obj_form = vsz_cf7_get_the_form_list($form_id);
		//get pre define fields information
		$arr_form_tag = $obj_form[0]->scan_form_tags();

		$arr_field_type = array();
		//Define option field type array
		$arr_option_type = array('checkbox','radio','select');
		//Check field exist with form or not
		if(!empty($arr_form_tag)){

			//Get all fields related information
			foreach($arr_form_tag as $key => $arr_type){
				//Check if tag type is submit then ignore tag info
				if($arr_type['basetype'] == 'submit') continue;
				//Check if field type match with option values or not
				if(isset($arr_type['basetype']) && in_array($arr_type['basetype'],$arr_option_type)){
					//If field type is option then get option names and values
					$arr_field_type[$arr_type['name']]['basetype'] = $arr_type['basetype'];
					$arr_field_type[$arr_type['name']]['labels'] = $arr_type['labels'];
					$arr_field_type[$arr_type['name']]['values'] = $arr_type['values'];
				}
				else{
					//get field type information
					$arr_field_type[$arr_type['name']]['basetype'] = $arr_type['basetype'];
				}
			}//Close for for each
		}//Close if for field check

		//Get form id related database fields information
		$fields = vsz_cf7_get_db_fields($form_id);
		//Define nonce value which is validate on save time
		$nonce = wp_create_nonce( 'vsz-cf7-edit-nonce-'.$form_id );
		//Get not editable fields list
		$not_editable_field = apply_filters('vsz_cf7_not_editable_fields',array());
		//Setup edit form design here
		?><div class="cf7d-modal" id="cf7d-modal-edit-value" style="display:none;">
			<form action="" class="cf7d-modal-form loading" id="cf7d-modal-form-edit-value" method="POST">
            	<div class="popup-note"><span>*(Field Type)</span></div>
				<input type="hidden" name="fid" value="<?php echo $form_id; ?>" />
				<input type="hidden" name="rid" value="" />
				<input type="hidden" name="vsz_cf7_edit_nonce"  value="<?php echo $nonce; ?>" />
				<ul id="cf7d-list-field-for-edit" class="edit-popup"><?php

					//Get form id related header settings value
					$field_settings = get_option('vsz_cf7_settings_field_' . $form_id, array());


					if(count($field_settings) == 0) { //no settings found

						foreach ($fields as $k => $v) {

							//Display field type related fields here
							if(isset($arr_field_type[$k]) && $arr_field_type[$k]['basetype'] != 'text' && $arr_field_type[$k]['basetype'] != 'email'){
								//Call function for display design structure
								vsz_display_field_type_value($arr_field_type[$k]['basetype'],$arr_field_type,$k,$v);

							}
							else{
								//Define all text field here
								$disable = '';
								//Check if any field is not edit by admin then add disable setting with field
								if(!empty($not_editable_field) && in_array($k,$not_editable_field)){
									$disable = 'disabled';
								}
								$label = esc_html($v);
								$k = esc_html($k);
								$loading = __('Loading...');
								//Display Text box design here
								echo "<li class=\"clearfix\"><span class=\"label\">".$label."</span> <input class=\"field-".$k."\" type=\"text\" name=\"field[".$k."]\" value=\"".$loading."\" ".$disable." /><div class=\"clear\"></div></li>";
							}//Close else
						}//Close foreach
					}//Close if for  check fields settings
					//If field setting not defined
					else{

						//Display form fields with value
						foreach($field_settings as $k => $v) {
							//Check field set in array or not
							if (isset($fields[$k])) {


								//Set all input field type design here
								if(isset($arr_field_type[$k]) && $arr_field_type[$k]['basetype'] != 'text' && $arr_field_type[$k]['basetype'] != 'email'){
									//Call function for display design structure
									vsz_display_field_type_value($arr_field_type[$k]['basetype'],$arr_field_type,$k,$v);
								}
								else{
									$disable = '';
									//Check if any field is not edit by admin then add disable setting with field
									if(!empty($not_editable_field) && in_array($k,$not_editable_field)){
										$disable = 'disabled';
									}
									//Get label name values which is define on Setting screen
									$show = (int)$field_settings[$k]['show'];
									$label = esc_html($field_settings[$k]['label']);
									$loading = __('Loading...');
									//Display Text box design here
									echo "<li><span class=\"label\">".$label."</span> <input class=\"field-".$k."\" type=\"text\" name=\"field[".$k."]\" value=\"".$loading."\" ".$disable." /></li>";
								}
								unset($fields[$k]);
							}//Close If for check field name set in field array or not
						}//close for each


						//Call when new field is added in existing form
						//Check any field remaining in field array or not
						if (count($fields) > 0) {
							//Get all remaining fields information
							foreach ($fields as $k => $v) {
								//Set all input field type design here
								if(isset($arr_field_type[$k]) && $arr_field_type[$k]['basetype'] != 'text' && $arr_field_type[$k]['basetype'] != 'email'){
									//Call function for display design structure
									vsz_display_field_type_value($arr_field_type[$k]['basetype'],$arr_field_type,$k,$v);
								}
								else{
									$disable = '';
									//Check if any field is not edit by admin then add disable setting with field
									if(!empty($not_editable_field) && in_array($k,$not_editable_field)){
										$disable = 'disabled';
									}
									$label = esc_html($v);
									$k = esc_html($k);
									$loading = __('Loading...');
									//Display Text box design here
									echo "<li><span class=\"label\">".$label."</span> <input class=\"field-".$k."\" type=\"text\" name=\"field[".$k."]\" value=\"".$loading."\" ".$disable." /></li>";
								}
							}//close foreach
						}//Close if
					}//close else
				?></ul>
				<div class="cf7d-modal-footer">
					<input type="hidden" name="arr_field_type" value="<?php print esc_html(json_encode($arr_field_type));?>">
					<input type="submit" id="update_cf7_value" name="vsz_cf7_save_field_value" value="Save Changes" class="button button-primary button-large" />
				</div>
			</form>
			<!------------------------------------ Ajax loader ----------------------------------------->
			<table style="display:none;" class="custom-overlay" id="overlayLoader">
				<tbody>
					<tr>
						<td><img alt="Loading..." src="<?php echo plugin_dir_url(dirname( __FILE__)).'images/716.gif'; ?>"height="50" width="100"></td>
					</tr>
				</tbody>
			</table>
		</div><?php
	}//Close Edit POPUP function here


	//Save all custom define settings fields value here
	public function vsz_cf7_save_setting_callback(){
		global $wpdb;

		//Save settings fields related values
		if(isset($_POST['vsz_save_field_settings'])){
			// check nonce
			if(!isset($_POST['vsz_cf7_setting_nonce']) || empty($_POST['vsz_cf7_setting_nonce'])){
				return;
			}
			//Check form ID exist with current request or not
			if(!isset($_POST['fid']) || empty($_POST['fid'])){
				return;
			}
			//get form Id
			$fid = intval($_POST['fid']);
			//Get nonce value
			$nonce = sanitize_text_field($_POST['vsz_cf7_setting_nonce']);
			//Verify nonce value
			if(!wp_verify_nonce( $nonce, 'vsz-cf7-setting-nonce-'.$fid)){
				// This nonce is not valid.
				return;
			}

			$arr_fields = array();
			//Get all define fields information
			if(isset($_POST['field']) && !empty($_POST['field'])){
				//Fetch all fields name here
				foreach($_POST['field'] as $key => $arrVal){

					//sanitize new label name of field
					$arr_fields[$key]['label'] = sanitize_text_field($arrVal['label']);

					//Get field show or not information
					$arr_fields[$key]['show'] = intval($arrVal['show']);
				}
			}
			$show_record = (int)($_POST['cf7_show_record']);
			//Save Settings POPUP information in option table
			add_option('vsz_cf7_settings_field_' . $fid, $arr_fields, '', 'no');
			update_option('vsz_cf7_settings_field_' . $fid, $arr_fields);
			update_option('vsz_cf7_settings_show_record_' . $fid, $show_record);
		}//close if for save setting information

		//Save form information here
		if(isset($_POST['vsz_cf7_save_field_value'])){

			// check nonce
			if(!isset($_POST['vsz_cf7_edit_nonce']) || empty($_POST['vsz_cf7_edit_nonce'])){
				return;
			}
			//Check form id
			if(!isset($_POST['fid']) || empty($_POST['fid'])){
				return;
			}
			//Check entry id
			if(!isset($_POST['rid']) || empty($_POST['rid'])){
				return;
			}

			//Get form and entry id
			$fid = intval($_POST['fid']);
			$rid = intval($_POST['rid']);
			//Verify nonce value
			$nonce = sanitize_text_field($_POST['vsz_cf7_edit_nonce']);
			if(!wp_verify_nonce( $nonce, 'vsz-cf7-edit-nonce-'.$fid)){
				// This nonce is not valid.
				return;
			}
			$arr_field_type = '';

			//Get field type information here
			if(isset($_POST['arr_field_type']) && !empty($_POST['arr_field_type'])){
				//Decode Json format string here
				$arr_field_type = json_decode(wp_unslash($_POST['arr_field_type']),true);
			}

			//Define option field type array
			$arr_option_type = array('checkbox','radio','select');
			//Get non editable fields information
			$not_editable_field = apply_filters('vsz_cf7_not_editable_fields',array());
			//Get entry related fields information
			$arr_exist_keys = get_entry_related_fields_info($fid,$rid);

			if(isset($_POST['field']) && !empty($_POST['field'])){
				//Fetch all fields information here
				foreach ($_POST['field'] as $key => $value){
					$value = sanitize_textarea_field(htmlspecialchars($value));

					$key = sanitize_text_field($key);
					//Escape loop if key have not editable field
					if(!empty($not_editable_field) && in_array($key,$not_editable_field)) continue;

					//Escape loop if key have file type value
					if(!empty($arr_field_type) && is_array($arr_field_type) && array_key_exists($key,$arr_field_type) && $arr_field_type[$key]['basetype'] == 'file') continue ;

					//Check key field have checkbox type or not
					if(!empty($arr_field_type) && is_array($arr_field_type) && array_key_exists($key,$arr_field_type) && in_array($arr_field_type[$key]['basetype'],$arr_option_type)){
						//Check if field name already exist with entry or not
						if(!empty($arr_exist_keys) && in_array($key,$arr_exist_keys)){
							//If field name match with current entry then field information update
							$wpdb->query($wpdb->prepare("UPDATE ".VSZ_CF7_DATA_ENTRY_TABLE_NAME." SET `value` = %s WHERE `name` = %s AND `data_id` = %d", sanitize_textarea_field($value), $key, $rid));
						}
						else{
							//If field name not match with current entry then new entry insert in DB
							$wpdb->query($wpdb->prepare('INSERT INTO '.VSZ_CF7_DATA_ENTRY_TABLE_NAME.'(`cf7_id`, `data_id`, `name`, `value`) VALUES (%d,%d,%s,%s)', $fid, $rid, sanitize_text_field($key), sanitize_textarea_field($value)));
						}
					}
					//Check if field type is text area
					else if(!empty($arr_field_type) && is_array($arr_field_type) && array_key_exists($key,$arr_field_type) && $arr_field_type[$key]['basetype'] == 'textarea'){
						//Check if field name already exist with entry or not
						if(!empty($arr_exist_keys) && in_array($key,$arr_exist_keys)){
							//If field name match with current entry then field information update
							$wpdb->query($wpdb->prepare("UPDATE ".VSZ_CF7_DATA_ENTRY_TABLE_NAME." SET `value` = %s WHERE `name` = %s AND `data_id` = %d", sanitize_textarea_field($value), $key, $rid));
						}
						else{
							//If field name not match with current entry then new entry insert in DB
							$wpdb->query($wpdb->prepare('INSERT INTO '.VSZ_CF7_DATA_ENTRY_TABLE_NAME.'(`cf7_id`, `data_id`, `name`, `value`) VALUES (%d,%d,%s,%s)', $fid, $rid, sanitize_text_field($key), sanitize_textarea_field($value)));
						}

					}//Close text area else if
					else{
						//Check if field name already exist with entry or not
						if(!empty($arr_exist_keys) && in_array($key,$arr_exist_keys)){
							//If field name match with current entry then field information update
							$wpdb->query($wpdb->prepare("UPDATE ".VSZ_CF7_DATA_ENTRY_TABLE_NAME." SET `value` = %s WHERE `name` = %s AND `data_id` = %d", sanitize_text_field($value), $key, $rid));
						}
						else{
							//If field name not match with current entry then new entry insert in DB
							$wpdb->query($wpdb->prepare('INSERT INTO '.VSZ_CF7_DATA_ENTRY_TABLE_NAME.'(`cf7_id`, `data_id`, `name`, `value`) VALUES (%d,%d,%s,%s)', $fid, $rid, sanitize_text_field($key), sanitize_text_field($value)));
						}
					}//Close else
				}//Close foreach
			}//Close if for check field arrray is set or not
		}//Close if for save information

		//Delete form entry here
		if ($current_action = vsz_cf7_current_action()) {
			$current_action = sanitize_text_field($current_action);
			//Check current action is delete then execute this functionality
			if($current_action == 'delete'){
				if(isset($_POST['del_id'])){
					//Get nonce value
					$nonce = sanitize_text_field($_POST['_wpnonce']);
					//Verify nonce value
					if(!wp_verify_nonce($nonce, 'vsz-cf7-action-nonce')) {
						die('Security check');
					}
					//Get Delete row ID information
					$del_id = implode(',', array_map('intval',$_POST['del_id']));
					//Get Form ID
					$fid = intval($_POST['fid']);

					// Checking for file type
					$arr_field_type_info = vsz_field_type_info($fid);

					//Get form Id related fields information
					$fields = vsz_cf7_get_db_fields($fid);

					$del_attach_key = array();
					foreach ($fields as $k1 => $v1) {
						if($arr_field_type_info[$k1] == 'file'){
							$del_attach_key[] = $k1;
						}
					}

					if(!empty($del_attach_key)){
						$del_attach_key = implode(",",$del_attach_key);
						$res = $wpdb->get_results("SELECT * FROM ".VSZ_CF7_DATA_ENTRY_TABLE_NAME." WHERE data_id IN($del_id) AND name IN ('".$del_attach_key."')");

						if(!empty($res)){
							foreach($res as $obj){
								$file_url = $obj->value;
								if(!empty($file_url)){
									//Get upload dir URL
									$upload_dir = wp_upload_dir();
									//Create custom upload folder
									$cf7d_upload_folder = VSZ_CF7_UPLOAD_FOLDER;
									$dir_upload = $upload_dir['basedir'] . '/' . $cf7d_upload_folder;

									$file_path = $dir_upload."/".basename($file_url);
									if(file_exists($file_path)){
										$ret = unlink($file_path);
									}
								}
							}
						}
					}

					//Delete form ID related row entries from DB
					$wpdb->query("DELETE FROM ".VSZ_CF7_DATA_ENTRY_TABLE_NAME." WHERE data_id IN($del_id)");
					$wpdb->query("DELETE FROM ".VSZ_CF7_DATA_TABLE_NAME." WHERE id IN($del_id)");
				}
			}
		}//Close if for delete action

		//Setup export functionality here
		if(isset($_POST['btn_export'])){
			//Get form ID
			$fid = (int)$_POST['fid'];

			//Get export id related information
			$ids_export = ((isset($_POST['del_id']) && !empty($_POST['del_id'])) ? implode(',', array_map('intval',$_POST['del_id'])) : '');
			///Get export type related information
			$type = sanitize_text_field($_POST['vsz-cf7-export']);
			//Check type name and execute type related CASE
			switch ($type) {
				case 'csv':
					vsz_cf7_export_to_csv($fid, $ids_export);
					break;
				case 'excel':
					vsz_cf7_export_to_excel($fid, $ids_export);
					break;
				case 'pdf':
					vsz_cf7_export_to_pdf($fid, $ids_export);
					break;
				case '-1':
					return;
					break;
				default:
					return;
					break;
			}//Close switch
		}//Close if for export
	}//Close admin_init hook function

	//Edit form AJAX call hadle By this function
	public function vsz_cf7_edit_form_ajax(){
		//global $cap;
		//if(!current_user_can( $cap )) return;
		global $wpdb;
		//Check entry id set or not in current request
		$rid = ((isset($_POST['rid']) && !empty($_POST['rid'])) ? intval($_POST['rid']) : '');
		//If entry not empty
		if(!empty($rid)){
			//Get entry related all fields information
			$sql = $wpdb->prepare("SELECT * FROM ".VSZ_CF7_DATA_ENTRY_TABLE_NAME." WHERE `data_id` = %d", $rid);
			$rows = $wpdb->get_results($sql);
			$return = array();
			//Set all fields name in array
			foreach ($rows as $k => $v) {
				$return[$v->name] = html_entity_decode(stripslashes($v->value));
			}
			//All fields encode in JSON format and return in AJAX request
			exit(json_encode($return));
		}
	}//Close Edit Ajax request function

	////Define not editable fields name here
	public function vsz_cf7_not_editable_fields_callback(){
		$cf7_not_editable_fields = array('submit_time','submit_ip','submit_user_id');
		return $cf7_not_editable_fields;
	}

	// Create table when new site added
	public function vsz_cf7_add_new_table_for_sites($blog_id){

		global $wpdb;
		if (is_plugin_active_for_network('advanced-cf7-db/advanced-cf7-db.php')) {
			$old_blog = $wpdb->blogid;
			switch_to_blog($blog_id);
				create_table_cf7_vdata_add_blog();
				create_table_cf7_vdata_entry_add_blog();
			switch_to_blog($old_blog);
		}
	}

	// create table when plugin update
	public function vsz_cf7_create_new_table_for_sites(){

		global $vsz_cf7db_current_version;
		global $wpdb;
		$cf7_db_version = '';
		$cf7_db_version = get_option('vsz_cf7_db_version');


		if(isset($cf7_db_version) && empty($cf7_db_version)){
			if (function_exists('is_multisite') && is_multisite()) {
			// check if it is a network activation - if so, run the activation function for each blog id
				 $old_blog = $wpdb->blogid;
				// Get all blog ids
				$blogids = $wpdb->get_col("SELECT blog_id FROM $wpdb->blogs");
				foreach ($blogids as $blog_id) {
					switch_to_blog($blog_id);

					create_table_cf7_vdata_add_blog();
					create_table_cf7_vdata_entry_add_blog();
				}
				switch_to_blog($old_blog);
			}else{
					create_table_cf7_vdata_add_blog();
					create_table_cf7_vdata_entry_add_blog();
			}

			 update_option('vsz_cf7_db_version',$vsz_cf7db_current_version);
			// Add Capability when update plugin
			$role = get_role( 'administrator');
			$args = array('post_type' => 'wpcf7_contact_form', 'posts_per_page' => -1);
			$cf7Forms = get_posts( $args );
			foreach($cf7Forms as $data){
				$role->add_cap('cf7_db_form_view'.$data->ID);
				$role->add_cap('cf7_db_form_edit_'.$data->ID);
			}

		}else if($cf7_db_version != $vsz_cf7db_current_version){
			if (function_exists('is_multisite') && is_multisite()) {
			// check if it is a network activation - if so, run the activation function for each blog id
				 $old_blog = $wpdb->blogid;
				// Get all blog ids
				$blogids = $wpdb->get_col("SELECT blog_id FROM $wpdb->blogs");
				foreach ($blogids as $blog_id) {
					switch_to_blog($blog_id);
					create_table_cf7_vdata_add_blog();
					create_table_cf7_vdata_entry_add_blog();
				}
				switch_to_blog($old_blog);
			}else{
					create_table_cf7_vdata_add_blog();
					create_table_cf7_vdata_entry_add_blog();
			}
			// Add Capability when update plugin
			$role = get_role( 'administrator');
			$args = array('post_type' => 'wpcf7_contact_form', 'posts_per_page' => -1);
			$cf7Forms = get_posts( $args );
			foreach($cf7Forms as $data){
				$role->add_cap('cf7_db_form_view'.$data->ID);
				$role->add_cap('cf7_db_form_edit_'.$data->ID);
			}
		   update_option('vsz_cf7_db_version',$vsz_cf7db_current_version);

		}
		if(is_admin()){
			// remove all capability assign to role or user
			do_action('test_test',wp_get_current_user());
			$vsz_cf7_capability = get_option('vsz_cf7_capability',array());
			if(isset($vsz_cf7_capability) && !empty($vsz_cf7_capability)){
				foreach($vsz_cf7_capability as $retrive_data){
					cf7_db_capability($retrive_data['type'],$retrive_data['type_value'],$retrive_data['contact_form'],$retrive_data['access'],'remove');
				}
				update_option("vsz_cf7_capability",'');
			}
		}
		add_shortcode( 'cf7-db-display-ip',array($this,'cf7_db_vsz_cf7_display_ip'));
	}

	// Short code execution related to hide the submit ip
	function cf7_db_vsz_cf7_display_ip($atts, $content, $name){
		if(is_multisite()){
			$arrInfo = shortcode_atts( array( 'site_id' => ''),$atts );
			$check_id = $arrInfo['site_id'];
			$current_id = get_current_blog_id();

			if(!empty($check_id)){
				if($current_id == $check_id){
					define('vsz_cf7_display_ip',true);
				}
			}
			else{
				define('vsz_cf7_display_ip',true);
			}
		}
		else{
			define('vsz_cf7_display_ip',true);
		}

		// define('vsz_cf7_display_ip',true);
	}



	// Create role and assign capability for user
	public function vsz_cf7_create_role_for_contact_form($post_id){
		$post_type = get_post_type($post_id);
		if($post_type != 'wpcf7_contact_form'){
			return;
		}
		$role = get_role( 'administrator');
		$role->add_cap('cf7_db_form_view'.$post_id);
		$role->add_cap('cf7_db_form_edit_'.$post_id);
	}

	// Function to upload file from edit file popup
	function vsz_acf7_db_edit_scr_file_upload(){

		if(!isset($_POST["fid"]) || empty($_POST["fid"])){
			print 'error';
			exit;
		}
		if(!isset($_POST["rid"]) || empty($_POST["rid"])){
			print 'error';
			exit;
		}
		if(!isset($_POST["field"]) || empty($_POST["field"])){
			print 'error';
			exit;
		}

		global $wpdb;
		$fid = $_POST["fid"];
		$rid = $_POST["rid"];
		$field = $_POST["field"];

		$upload_dir = wp_upload_dir();
		$acf7db_upload_folder = VSZ_CF7_UPLOAD_FOLDER;
		$temp_dir_upload = $upload_dir['basedir'].'/'.$acf7db_upload_folder;
		wp_mkdir_p($temp_dir_upload);

		if(is_array($_FILES) && !empty($_FILES)){
			$maxsize = 8000000;
			if(($_FILES['image']['size'] >= $maxsize)) {
				echo  'invalid_size';
				exit;
			}
			$filename = sanitize_text_field($_FILES["image"]["name"]);
			$file_basename = substr($filename, 0, strripos($filename, '.')); // get file name
			$file_ext = substr($filename, strripos($filename, '.')); // get file extention
			//unique file name
			$newfilename = wp_unique_filename($temp_dir_upload, $file_basename.$file_ext);

			if(move_uploaded_file($_FILES["image"]["tmp_name"], $temp_dir_upload. '/' .$newfilename)){
				$file_url = $upload_dir['baseurl'] . '/' . $acf7db_upload_folder.'/'.$newfilename;

				$res = $wpdb->update(VSZ_CF7_DATA_ENTRY_TABLE_NAME, array("value" => $file_url), array("data_id" => $rid, "cf7_id" => $fid, "name" => $field));
				if($res !== false){
					echo "$newfilename~~@@~~&&~~$file_url";
					wp_die();
				}
				else{
					echo "n";
					wp_die();
				}
			}
		}
		wp_die();
	}

	// Function to delete file from edit file popup
	function vsz_acf7_db_edit_scr_file_delete(){

		if(!isset($_POST["fid"]) || empty($_POST["fid"])){
			print 'error';
			exit;
		}
		if(!isset($_POST["rid"]) || empty($_POST["rid"])){
			print 'error';
			exit;
		}
		if(!isset($_POST["field"]) || empty($_POST["field"])){
			print 'error';
			exit;
		}
		if(!isset($_POST["val"]) || empty($_POST["val"])){
			print 'error';
			exit;
		}

		$fid = $_POST["fid"];
		$rid = $_POST["rid"];
		$field = $_POST["field"];
		$val = $_POST["val"];
		global $wpdb;

		$res = $wpdb->update(VSZ_CF7_DATA_ENTRY_TABLE_NAME, array("value" => ""), array("data_id" => $rid, "cf7_id" => $fid, "name" => $field));
		if($res !== false){
			$upload_dir = wp_upload_dir();
			$dir_upload = $upload_dir['basedir'] .'/' .VSZ_CF7_UPLOAD_FOLDER;

			unlink($dir_upload.'/'.$val);
			echo "y";
			wp_die();
		}
		else{
			echo "n";
			wp_die();
		}
	}

}//close class

//Generate CSV file here
function vsz_cf7_export_to_csv($fid, $ids_export = ''){
    global $wpdb;

	$fid = intval($fid);
    $fields = vsz_cf7_get_db_fields($fid);

	//Get form id related contact form object
	$obj_form = vsz_cf7_get_the_form_list($fid);
	//get current form title
	$form_title = esc_html($obj_form[0]->title());
	//Get export data
	$data = create_export_query($fid, $ids_export, 'data_id desc');

	if(!empty($data)){
		//Setup export data
		$data_sorted = wp_unslash(vsz_cf7_sortdata($data));

		//Generate CSV file
		header('Content-Type: text/csv; charset=UTF-8');
		header('Content-Disposition: attachment;filename="'.$form_title.'.csv";');
		$fp = fopen('php://output', 'w');
		fputs($fp, "\xEF\xBB\xBF");
		fputcsv($fp, array_values(array_map('sanitize_text_field',$fields)));
		foreach ($data_sorted as $k => $v){
			$temp_value = array();
			foreach ($fields as $k2 => $v2){
				$temp_value[] = ((isset($v[$k2])) ? html_entity_decode($v[$k2]) : '');
			}
			fputcsv($fp, $temp_value);
		}

		fclose($fp);
		exit();
	}
}
//Generate excel file here
function vsz_cf7_export_to_excel($fid, $ids_export){

	global $wpdb;

	$fid = intval($fid);
    $fields = vsz_cf7_get_db_fields($fid);
    $fields1 = vsz_field_type_info($fid);

	//Get form id related contact form object
	$obj_form = vsz_cf7_get_the_form_list($fid);
	//get current form title
	$form_title = esc_html($obj_form[0]->title());
	//Get export data
	$data = create_export_query($fid, $ids_export, 'data_id desc');

	if(!empty($data)){
		//Setup export data
		$data_sorted = wp_unslash(vsz_cf7_sortdata($data));

		$arrHeader = array_values(array_map('sanitize_text_field',$fields));


		//Include excel class file
		require_once(dirname(__FILE__).'/class/PHPExcel.php');
		//create excel class object
		$xls = new PHPExcel();

		//First we will set header in excel file
		$col = 0;
		$row = 1;
		foreach($arrHeader as $colName){
			$cell = $xls->getCellNo($row, $col);
			$xls->setActiveSheetIndex(0)->setCellValue($cell,$colName);
			$col++;
		}

		$row = 2;
		foreach ($data_sorted as $k => $v){
			//Define column index here
			$col=0;

			//Get column order wise value here
			foreach ($fields as $k2 => $v2){
				$colVal = (isset($v[$k2]) ? html_entity_decode($v[$k2]) : '');
				$cell = $xls->getCellNo($row, $col);
				$xls->setActiveSheetIndex(0)->setCellValue($cell,$colVal);
				$col++;
			}
			//Consider new row for each entry here
			$row++;
		}


		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$xls->setActiveSheetIndex(0);

		// Safely output the header first and set the fileName also
		$xls->headers($form_title);

		//Download excel file here
		$objWriter = PHPExcel_IOFactory::createWriter($xls, 'Excel5');
		$objWriter->save('php://output');
		exit;
	}
}
//Generate pdf file here
function vsz_cf7_export_to_pdf($fid, $ids_export){
	global $wpdb;
	$fid = intval($fid);
	$fields = vsz_cf7_get_db_fields($fid);

	//Get form id related contact form object
	$obj_form = vsz_cf7_get_the_form_list($fid);
	//get current form title
	$form_title = esc_html($obj_form[0]->title());
	//Get export data
	$data = create_export_query($fid, $ids_export, 'data_id desc');

	if(!empty($data)){
		//Setup export data
		$data_sorted = wp_unslash(vsz_cf7_sortdata($data));

		$arrHeader = array_values(array_map('sanitize_text_field',$fields));

		//Check that the class exists before trying to use it
		if(!class_exists('MYPDF')){
			//Include pdf class file
			// require_once(dirname(__FILE__).'/pdfgenerate/mypdf.class.php');

			require_once(dirname(__FILE__).'/pdfgenerate/dompdf/autoload.inc.php');
			//require_once(dirname(__FILE__).'/pdfgenerate/dompdf/load_font.php');

			// $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, false, 'UTF-8', false);

			$pdf = new Dompdf\Dompdf();
			$pdf->set_option('defaultFont', 'helvetica');
			$pdf->setPaper('A4', 'landscape');
			// add a page

			$docName ="";
			$timeStamp = date('Ymdhis');
			$form_title = preg_replace('/\s+/', '_', $form_title);
			$docName = $form_title."-".$timeStamp;

			// pdf html content
			$content = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
						"http://www.w3.org/TR/html4/loose.dtd">
						<html>
						<head>
						<link rel="important stylesheet" href="chrome://messagebody/skin/messageBody.css">
						<meta http-equiv="Content-Type" content="text/html; " />
						</head>
						<body><style>table, th, td {
							border: 1px solid #ddd;
							border-collapse: collapse;
							table-layout:fixed;
							width:100%;
							white-space: normal;
							word-wrap: break-word;
							font-family: DroidSansFallback;
						}
						td{
							padding:5px;
						}
						</style>';
			$content.= '<div style="text-align:center;font-size:18px;margin:20px;line-height:30px;">'.$form_title.'</div>';
			$content.= '<table border="0" cellpadding="0" cellspacing="0" style="border:1px solid #ccc;margin-top:0;margin-left:auto;margin-right:auto;font-family:arial;margin-bottom:10px;width:100%;" >';

			$i=0;
			$content .= '<tr bgcolor="#000" style="color:#fff;">';
				foreach($arrHeader as $colName){
				$content .= '<td style="font-family:arial;font-weight:bold;font-size:14px;color:#fff;padding:5px;line-height:20px;" CELLSPACING=10>'.$colName.'</td>';
			}
			$content .= '</tr>';

			foreach ($data_sorted as $k => $v){
				$content .= '<tr>';
				//Define column index here
				$i=0;
				//Consider new row for each entry here

				//Get column order wise value here
				foreach ($fields as $k2 => $v2){
					$colVal = ((isset($v[$k2])) ? html_entity_decode($v[$k2]) : '');
					$content .= '<td style="padding:5px;line-height:20px;" CELLSPACING=10>'.htmlentities(stripslashes($colVal)).'</td>';
				}
				$content .= '</tr>';

			}


			$content.='</table></body></html>';

			// *******************************************************************
			//Close and output PDF document

			$upload_dir = wp_upload_dir();

			$folderPath = $upload_dir['path']."/";


			$fileFullName = $docName.'.pdf';
			$readFilePath = $folderPath.$fileFullName;

			//$filePath = $folderPath;
			$pdf->loadHtml($content);
			$pdf->render();
			$pdf->stream($readFilePath);
			// $pdf->Output($folderPath . $docName . '.pdf', 'F');
			 if(file_exists($readFilePath)){
				header('Content-Type: application/pdf');
				header('Content-Disposition: attachment; filename="'.$docName.'.pdf"' );
				readfile($readFilePath);
				// delete pdf file
				unlink($readFilePath);
				exit;
			}
		}
	}

}

//Setup export related query here
function create_export_query($fid,$ids_export,$cf7d_entry_order_by){

	global $wpdb;
	$fid = intval($fid);

	if(isset($_POST['start_date']) && isset($_POST['end_date']) && !empty($_POST['start_date']) && !empty($_POST['end_date'])){
		$s_date = date_create_from_format("d/m/Y",sanitize_text_field($_POST['start_date']));
		$e_date = date_create_from_format("d/m/Y",sanitize_text_field($_POST['end_date']));
	}
	else{
		$s_date = false;
		$e_date = false;
	}

	//Create Export Query on the basis of Listing screen filter

	//Check any search related filter active or not
	if(isset($_POST['search_cf7_value']) && !empty($_POST['search_cf7_value']) && isset($_POST['start_date']) && isset($_POST['end_date']) && empty($_POST['start_date']) && empty($_POST['end_date'])){

		$search = sanitize_text_field($_POST['search_cf7_value']);
		$query = "SELECT * FROM `".VSZ_CF7_DATA_ENTRY_TABLE_NAME.
						"` WHERE `cf7_id` = ".$fid." AND data_id IN(SELECT * FROM (SELECT data_id FROM `".VSZ_CF7_DATA_ENTRY_TABLE_NAME."`
						WHERE 1 = 1 AND `cf7_id` = ".$fid." ".((!empty($search)) ? "AND `value` LIKE '%%".$search."%%'" : "").' '.
						((!empty($ids_export)) ? " AND data_id IN(".$ids_export.")" : '').
						"  GROUP BY `data_id` ORDER BY ".$cf7d_entry_order_by." ) temp_table) ORDER BY " . $cf7d_entry_order_by;
	}
	//Check date wise filter active or not
	else if(isset($_POST['search_cf7_value']) && empty($_POST['search_cf7_value']) && isset($_POST['start_date']) && isset($_POST['end_date']) && !empty($_POST['start_date']) && !empty($_POST['end_date']) && $s_date !== false && $e_date !== false){

		//Get start date information
		$start_date =  date_format($s_date,"Y-m-d");

		//Get end date information
		$end_date =  date_format($e_date,"Y-m-d");

		$search_date_query = "AND `name` = 'submit_time' AND value between '".$start_date."' and '".$end_date." 23:59:59'";

		$query = "SELECT * FROM `".VSZ_CF7_DATA_ENTRY_TABLE_NAME."` WHERE `cf7_id` = ".$fid." AND data_id IN(
					SELECT * FROM (
						SELECT data_id FROM `".VSZ_CF7_DATA_ENTRY_TABLE_NAME."` WHERE 1 = 1 AND `cf7_id` = ".$fid." ".$search_date_query.' '. ((!empty($ids_export)) ? " AND data_id IN(".$ids_export.")" : '')."
							GROUP BY `data_id` ORDER BY ".$cf7d_entry_order_by."
						)
					temp_table)
					ORDER BY " . $cf7d_entry_order_by;
	}
	//Check search and date wise filter active or not
	else if(isset($_POST['search_cf7_value']) && !empty($_POST['search_cf7_value']) && isset($_POST['start_date']) && isset($_POST['end_date']) && !empty($_POST['start_date']) && !empty($_POST['end_date']) && $s_date !== false && $e_date !== false){

		$search = sanitize_text_field($_POST['search_cf7_value']);

		//Get start date information
		$start_date =  date_format($s_date,"Y-m-d");

		//Get end date information
		$end_date =  date_format($e_date,"Y-m-d").' 23:59:59';

		$date_query = "SELECT data_id FROM `".VSZ_CF7_DATA_ENTRY_TABLE_NAME."` WHERE 1 = 1 AND `cf7_id` = ".$fid." AND `name` = 'submit_time' AND
						value between '".$start_date."' and '".$end_date."' GROUP BY `data_id` ORDER BY `data_id` DESC";

		//print $date_query;
		$rs_date = $wpdb->get_results($date_query);
		$data_ids = '';
		if(!empty($rs_date)){
			foreach($rs_date as $objdata_id){
				if(!empty($ids_export)){
					$arr_ids = array_map('intval',explode(',',$ids_export));
					if(!empty($arr_ids) && in_array($objdata_id->data_id,$arr_ids)){
						$data_ids .= $objdata_id->data_id .',';
					}
				}
				else{
					$data_ids .= $objdata_id->data_id .',';
				}
			}
			$data_ids = rtrim($data_ids,',');
		}
		$search_date_query = "";
		$query = "SELECT * FROM `".VSZ_CF7_DATA_ENTRY_TABLE_NAME."` WHERE `cf7_id` = ".$fid." AND data_id IN(
					SELECT * FROM (
						SELECT data_id FROM `".VSZ_CF7_DATA_ENTRY_TABLE_NAME."` WHERE 1 = 1 AND `cf7_id` = ".$fid." ".$search_date_query." ".((!empty($search)) ? "
							AND `value` LIKE '%%".$search."%%'" : ""). " AND data_id IN (".$data_ids.")
							GROUP BY `data_id` ORDER BY ".$cf7d_entry_order_by."
						)
					temp_table)
					ORDER BY " . $cf7d_entry_order_by;

	}
	//Not active any filter on listing screen
	else{

		$query = "SELECT * FROM `".VSZ_CF7_DATA_ENTRY_TABLE_NAME."` WHERE `cf7_id` = ".$fid." AND data_id IN(
					SELECT * FROM (
						SELECT data_id FROM `".VSZ_CF7_DATA_ENTRY_TABLE_NAME."` WHERE 1 = 1 AND `cf7_id` = ".$fid.' '. ((!empty($ids_export)) ? " AND data_id IN(".$ids_export.")" : '')."
							GROUP BY `data_id` ORDER BY ".$cf7d_entry_order_by."
						)
					temp_table)
					ORDER BY " . $cf7d_entry_order_by;
	}

	//Execuste query
	$data = $wpdb->get_results($query);

	//Return result set
	return  $data;
}//Close export query function


// Create table when new site added.
function create_table_cf7_vdata_add_blog(){

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

function create_table_cf7_vdata_entry_add_blog(){
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

// Check user capability
function cf7_check_capability($user_capability){

	if(is_super_admin()){
		return true;
	}
	$user_id = get_current_user_id();
	$subject = new WP_User($user_id);
	$allcaps= $subject->allcaps;
	$caps = $subject->caps;

	$caps    = array_merge(wp_get_current_user()->caps, $caps);
	$allcaps = array_merge(wp_get_current_user()->allcaps, $allcaps);

	if (wp_get_current_user()->ID == $subject->ID) {
		wp_get_current_user()->allcaps = $allcaps;
		wp_get_current_user()->caps    = $caps;
	}
	$user = wp_get_current_user();

	foreach($user->allcaps as $key=>$capability){
		if($capability == true){
			if($key == $user_capability){
				return true;
			}
		}
	}
	return false;
}
