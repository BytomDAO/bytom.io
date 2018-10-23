<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	die('Un-authorized access!');
}

/**
 * Detect plugin. For use in Admin area only.
 */
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

//Check contact form class exist or not 
if(!is_plugin_active('contact-form-7/wp-contact-form-7.php')){
	?><div class="notice error is-dismissible">
		<p>Please activate Contact Form plugin first.</p>
	</div><?php
}
else if(defined('WPCF7_VERSION') && WPCF7_VERSION < '4.6'){
	?><div class="notice error is-dismissible">
		<p>Please update latest version for Contact Form plugin first.</p>
	</div><?php
}
else{

	//enqueue date time picker CSS in file
	wp_enqueue_style('jquery-datetimepicker-css');
	//enqueue Sortable JS in file
	wp_enqueue_script('jquery-ui-sortable');

	//Get all existing contact form list
	$form_list = vsz_cf7_get_the_form_list();
	$url = '';
	$fid = '';
	
	//Get selected form Id value
	if(isset($_GET['cf7_id']) && !empty($_GET['cf7_id'])){
		$edit = false;
		$entry_actions = array();
		if (!cf7_check_capability('cf7_db_form_view'.$_GET['cf7_id']) && !cf7_check_capability('cf7_db_form_edit_'.$_GET['cf7_id'])){
			wp_die( __('You do not have sufficient permissions to access this page.') );
		}
		if(cf7_check_capability('cf7_db_form_edit_'.$_GET['cf7_id'])){
			$edit = true;
			$entry_actions = array(
				'delete' => 'Delete'
			);
		}
		$fid = intval($_GET['cf7_id']);
		$menu_url = menu_page_url('contact-form-listing',false);
		$url = $menu_url.'&cf7_id='.$fid;
	} 

	//Get search related value
	$search =  '';
	if(isset($_POST['search_cf7_value']) && !empty($_POST['search_cf7_value'])){
		$search = addslashes(addslashes(htmlspecialchars(sanitize_text_field($_POST['search_cf7_value']))));
	} 
	
	//Get all form names which entry store in DB
	global $wpdb;
	$sql = "SELECT `cf7_id` FROM `".VSZ_CF7_DATA_ENTRY_TABLE_NAME."` GROUP BY `cf7_id`";
	$data = $wpdb->get_results($sql,ARRAY_N);
	$arr_form_id = array();
	if(!empty($data)){
		foreach($data as $arrVal){
			$arr_form_id[] = (int)$arrVal[0];
		}
	}
	
	?><div class="wrap">
		<h2>
			View Form Information
		</h2>
	</div>
	<div class="wrap select-specific">
		<table class="form-table inner-row">	
			<tr class="form-field form-required select-form">
				<th>Select Form name</th>
				<td>
					<form name="cf7_name" id="cf7_name" action="<?php menu_page_url('contact-form-listing');?>" method="">
						<select name="cf7_id" id="cf7_id" onchange="submit_cf7()">
							<option value="">Select form name</option><?php
							//Display all existing form list here
							$exist_entry_flag = false;
							if(!empty($form_list)){
								
								foreach($form_list as $objForm){
									if(!empty($arr_form_id) && in_array($objForm->id(),$arr_form_id)){
										$exist_entry_flag = true;
										if (cf7_check_capability('cf7_db_form_view'.$objForm->id()) || cf7_check_capability('cf7_db_form_edit_'.$objForm->id()) ){
											if(!empty($fid) && $fid === $objForm->id())
												print '<option value="'.$objForm->id().'" selected>'.esc_html($objForm->title()).'</option>';
											else	
												print '<option value="'.$objForm->id().'" >'.esc_html($objForm->title()).'</option>';
										}		
									}//Close if
								}//close for each
							}//close if
						?></select>
					</form>
				</td>	
			</tr>
		</table>
	</div><?php

	//Get form Id related fields information
	$fields = vsz_cf7_get_db_fields($fid);

	//Check contact form id set or not
	if (!empty($fid) && !empty($fields)){
		
		//Add filter for ordering in entry
		$cf7d_entry_order_by = apply_filters('vsz_cf7_entry_order_by', '`data_id` DESC');
		$cf7d_entry_order_by = sanitize_text_field($cf7d_entry_order_by);
		
		$start_date = '';
		$end_date = '';
		$search_date_query = '';
		
		//Get post per page value from general setting screen
		$show_record = '';
		$show_record = get_option('vsz_cf7_settings_show_record_' . $fid, array());
		if(empty($show_record)){
			$show_record = 10;
		}
		$posts_per_page = $show_record;
		//Add post per page filter here , Any user call this filter and customize post per page count
		$items_per_page = (int)apply_filters('vsz_cf7_entry_per_page', (!empty($posts_per_page) ? $posts_per_page : 10));
		//Get current page information from  query
		$page = isset($_POST['cpage']) && !empty($_POST['cpage']) ? abs((int)$_POST['cpage']) : 1;
		//Setup offset related value here
		$offset = (int)( $page * $items_per_page ) - $items_per_page;
		//Customize parameter wise listing screen query
		
		//Check start and end date is valid or not
		if(isset($_POST['start_date']) && isset($_POST['end_date']) && !empty($_POST['start_date']) && !empty($_POST['end_date'])){
			$s_date = date_create_from_format("d/m/Y",sanitize_text_field($_POST['start_date']));
			$e_date = date_create_from_format("d/m/Y",sanitize_text_field($_POST['end_date']));
		}
		else{
			$s_date = false;
			$e_date = false;
		}
		
		
		
		//Check search field value empty or not
		if(isset($_POST['search_cf7_value']) && !empty($_POST['search_cf7_value']) && isset($_POST['start_date']) && isset($_POST['end_date']) && empty($_POST['start_date']) && empty($_POST['end_date'])){
			
			$query = "SELECT * FROM `".VSZ_CF7_DATA_ENTRY_TABLE_NAME."` WHERE `cf7_id` = ".$fid." AND data_id IN(
						SELECT * FROM (
							SELECT data_id FROM `".VSZ_CF7_DATA_ENTRY_TABLE_NAME."` WHERE 1 = 1 AND 
								`cf7_id` = ".$fid." ".((!empty($search)) ? "AND `value` LIKE '%%".$search."%%'" : ""). " 
								GROUP BY `data_id` ORDER BY ".$cf7d_entry_order_by." LIMIT ".$offset.",".$items_per_page."
							) 
						temp_table) ORDER BY " . $cf7d_entry_order_by;
			$arr_total = $wpdb->get_results("SELECT data_id FROM `".VSZ_CF7_DATA_ENTRY_TABLE_NAME."` WHERE `cf7_id` = " . (int)$fid . " ".((!empty($search)) ? "AND `value` LIKE '%%".$search."%%'" : "")." GROUP BY `data_id`");
			
		}
		//Check search field value empty and date filter active or not
		else if(isset($_POST['search_cf7_value']) && empty($_POST['search_cf7_value']) && isset($_POST['start_date']) && isset($_POST['end_date']) && !empty($_POST['start_date']) && !empty($_POST['end_date']) && $s_date !== false && $e_date !== false){
		
			//Get start date information
			$start_date =  date_format($s_date,"Y-m-d");
			
			//Get end date information
			$end_date =  date_format($e_date,"Y-m-d");
			
			//Setup date parameter value in query
			$search_date_query = "AND `name` = 'submit_time' AND value between '".$start_date."' and '".$end_date." 23:59:59'";
			
			$query = "SELECT * FROM `".VSZ_CF7_DATA_ENTRY_TABLE_NAME."` WHERE `cf7_id` = ".$fid." AND data_id IN(
						SELECT * FROM (
							SELECT data_id FROM `".VSZ_CF7_DATA_ENTRY_TABLE_NAME."` WHERE 1 = 1 AND `cf7_id` = ".$fid." ".$search_date_query."  
								GROUP BY `data_id` ORDER BY ".$cf7d_entry_order_by." LIMIT ".$offset.",".$items_per_page."
							) 
						temp_table) 
						ORDER BY " . $cf7d_entry_order_by;
			
			//Get total entries information
			$total_query = "SELECT * FROM `".VSZ_CF7_DATA_ENTRY_TABLE_NAME."` WHERE `cf7_id` = ".$fid." AND data_id IN(
							SELECT * FROM (
								SELECT data_id FROM `".VSZ_CF7_DATA_ENTRY_TABLE_NAME."` WHERE 1 = 1 AND `cf7_id` = ".$fid." ".$search_date_query."  
									GROUP BY `data_id` ORDER BY ".$cf7d_entry_order_by."
								) 
							temp_table)  
							GROUP BY `data_id` ORDER BY " . $cf7d_entry_order_by;
			
			$arr_total = $wpdb->get_results($total_query);
		}
		//Check search field value not empty and date filter active or not
		else if(isset($_POST['search_cf7_value']) && !empty($_POST['search_cf7_value']) && isset($_POST['start_date']) && isset($_POST['end_date']) && !empty($_POST['start_date']) && !empty($_POST['end_date']) && $s_date !== false && $e_date !== false){
			
			
			//Get start date information
			$start_date =  date_format($s_date,"Y-m-d");
			
			//Get end date information
			$end_date =  date_format($e_date,"Y-m-d").' 23:59:59';
			
			//Get date filter related entries information 
			$date_query = "SELECT data_id FROM `".VSZ_CF7_DATA_ENTRY_TABLE_NAME."` 
							WHERE 1 = 1 AND `cf7_id` = ".$fid." AND `name` = 'submit_time' AND value between '".$start_date."' and '".$end_date."' 
							GROUP BY `data_id` ORDER BY `data_id` DESC";
			
			$rs_date = $wpdb->get_results($date_query);
			//Get all entries and setup a string
			$data_ids = '';
			if(!empty($rs_date)){
				foreach($rs_date as $objdata_id){
					$data_ids .= $objdata_id->data_id .',';
				}
				$data_ids = rtrim($data_ids,',');
			}
			
			//get all entrise information
			$query = "SELECT * FROM `".VSZ_CF7_DATA_ENTRY_TABLE_NAME."` WHERE `cf7_id` = ".$fid." AND data_id IN(
						SELECT * FROM (
							SELECT data_id FROM `".VSZ_CF7_DATA_ENTRY_TABLE_NAME."` 
								WHERE 1 = 1 AND `cf7_id` = ".$fid." ".$search_date_query." ".((!empty($search)) ? "AND 
								`value` LIKE '%%".$search."%%'" : ""). " AND data_id IN (".$data_ids.") 
								GROUP BY `data_id` ORDER BY ".$cf7d_entry_order_by." LIMIT ".$offset.",".$items_per_page."
							) 
						temp_table) 
						ORDER BY " . $cf7d_entry_order_by; 
			
			//Get total entries information
			$total_query = "SELECT * FROM `".VSZ_CF7_DATA_ENTRY_TABLE_NAME."` WHERE `cf7_id` = ".$fid." AND data_id IN(
							SELECT * FROM (
								SELECT data_id FROM `".VSZ_CF7_DATA_ENTRY_TABLE_NAME."` WHERE 1 = 1 AND `cf7_id` = ".$fid." ".$search_date_query." ".((!empty($search)) ? "AND 
									`value` LIKE '%%".$search."%%'" : ""). " AND data_id IN (".$data_ids.") 
								GROUP BY `data_id` ORDER BY ".$cf7d_entry_order_by." 
								) 
							temp_table)  
							GROUP BY `data_id` ORDER BY " . $cf7d_entry_order_by;
			
			$arr_total = $wpdb->get_results($total_query);
			
		}
		//Call when any filter not active on Listing screen
		else{
			
			$query = "SELECT * FROM `".VSZ_CF7_DATA_ENTRY_TABLE_NAME."` WHERE `cf7_id` = ".$fid." AND data_id IN(
						SELECT * FROM (
							SELECT data_id FROM `".VSZ_CF7_DATA_ENTRY_TABLE_NAME."` WHERE 1 = 1 AND `cf7_id` = ".$fid." 
								GROUP BY `data_id` ORDER BY ".$cf7d_entry_order_by." LIMIT ".$offset.",".$items_per_page."
							) 
						temp_table) 
						ORDER BY " . $cf7d_entry_order_by;
			//Get total entries information
			$arr_total = $wpdb->get_results("SELECT data_id FROM `".VSZ_CF7_DATA_ENTRY_TABLE_NAME."` WHERE `cf7_id` = " .$fid . " ".((!empty($search)) ? "AND `value` LIKE '%%".$search."%%'" : "")." GROUP BY `data_id`");
		}
		
		
		//Execute query here
		$data = $wpdb->get_results($query);
		
		//Get entry wise all fields information
		$data_sorted = vsz_cf7_sortdata($data);
		
		//get total count 
		$total = count($arr_total);
		
		//Define bulk action array
		
		//Add filter for customize bulk action values	
		$entry_actions = apply_filters('vsz_cf7_entry_actions', $entry_actions);
		
		//Form listing design structure start here
		?><div class="wrap our-class">
			<form class="vsz-cf7-listing row" action="<?php print esc_url($url);?>" method="post" id="cf7d-admin-action-frm" >
				<input type="hidden" name="page" value="cf7-data">
				<input type="hidden" name="fid" value="<?php echo $fid; ?>">
				<input type="hidden" name="_wpnonce" value="<?php echo wp_create_nonce('vsz-cf7-action-nonce'); ?>"><?php
					//Display setting screen button
					do_action('vsz_cf7_display_settings_btn', $fid);
				?><div class="span12">
					<div class="date-filter from-to" style="display:block;">
						<div class="from-to-date-search">
							<input type="text" name="start_date" id="start_date" placeholder="From" value="<?php print isset($_POST['start_date']) ? esc_attr($_POST['start_date']) : '';?>" class="input-cf-date">
							<input type="text" name="end_date" id="end_date" placeholder="To" value="<?php print isset($_POST['end_date']) ? esc_attr($_POST['end_date']) : '';?>" class="input-cf-date" >
							<input type="button" name="search_date" id="search_date" value="Search By Date" title="Search By Date" class="button action" >
						</div>
						<div class="type-something"><?php 
							//Display Search section here
							do_action('vsz_cf7_after_datesection_btn', $fid); 
						?></div>
						<div class="reset-class"><a href="<?php print esc_url($url);?>" title="Reset All" class="button">Reset All</a></div>
					</div>
					<div class="clear"></div>
				</div>
				<div class="span12 bulk-actions">
					<div class="tablenav top">
						<div class="actions bulkactions">
							<label for="bulk-action-selector-top" class="screen-reader-text"><?php _e('Select bulk action');?></label>
							<select name="action" id="bulk-action-selector-top">
								<option value="-1"><?php _e('Bulk Actions'); ?></option><?php 
								//Get all bulk action values
								echo vsz_cf7_arr_to_option($entry_actions); 
							?></select>
							<input id="doaction" name="btn_apply" class="button action" value="<?php _e('Apply'); ?>" title="<?php _e('Apply'); ?>" type="submit" /><?php 
							//Display Export button option values
							do_action('vsz_cf7_after_bulkaction_btn', $fid); 
							?><div class="tablenav-pages">
								<span class="displaying-num"><?php echo (($total == 1) ?
								'1 ' . __('item') :
								$total . ' ' . __('items')) ?></span>
								<span class="pagination-links"><?php
									//Setup pagination structure
									print ( paginate_links(array(
										'base' => add_query_arg('cpage', '%#%'),
										'format' => '',
										'prev_text' => __('&laquo;'),
										'next_text' => __('&raquo;'),
										'total' => ceil($total / $items_per_page),
										'current' => $page,
									)));
									

								?></span>
							</div>                
						</div>
						<br class="clear">
					</div>
				</div>
				<div class="span12 table-structure">
					<div class="table-inner-structure">
						<table class="wp-list-table widefat fixed striped posts cf7d-admin-table">
							<thead>
								<tr><?php
									echo '<td id="cb" class="manage-column column-cb check-column"><input type="checkbox" id="cb-select-all-1" /></td>';
									//Display Edit headion field
									if($edit == true){
										do_action('vsz_cf7_admin_after_heading_field');
									}	
									//Define table header section here
									foreach ($fields as $k => $v){
										echo '<th class="manage-column" data-key="'.esc_html($v).'">'.vsz_cf7_admin_get_field_name($v).'</th>';
									}
								?></tr>
							</thead>
							<tbody><?php
								//Add character count functionalirty here
								$display_character = (int) apply_filters('vsz_display_character_count',30);
								$arr_field_type_info = vsz_field_type_info($fid);
								
								//Get all fields related information
								if(!empty($data_sorted)){
									foreach ($data_sorted as $k => $v) {
										$k = (int)$k;
										echo '<tr>';
										echo '<th class="check-column" scope="row"><input id="cb-select-'.$k.'" type="checkbox" title="Check" name="del_id[]" value="'.$k.'" /></th>';
										$row_id = $k;
										//Display edit entry icon
										if($edit == true){
											do_action('vsz_cf7_admin_after_body_field', $fid, $row_id);
										}
										foreach ($fields as $k2 => $v2) {
											//Get fields related values
											$_value = ((isset($v[$k2])) ? $v[$k2] : '&nbsp;');
											$_value1 = filter_var($_value, FILTER_SANITIZE_URL);
											
											//Check value is URL or not
											if (!filter_var($_value1, FILTER_VALIDATE_URL) === false) {
												$_value = esc_url($_value);
												//If value is url then setup anchor tag with value
												if(!empty($arr_field_type_info) && array_key_exists($k2,$arr_field_type_info) && $arr_field_type_info[$k2] == 'file'){
													//Add download attributes in tag if field type is attachement
													$_value = '<a href="'.$_value.'" target="_blank" title="'.$_value.'" download >'.basename($_value).'</a>';
													echo '<td data-head="'.vsz_cf7_admin_get_field_name($v2).'">'.$_value.'</td>';
												}
												else{
													$_value = '<a href="'.$_value.'" target="_blank" title="'.$_value.'" >'.basename($_value).'</a>';
													echo '<td data-head="'.vsz_cf7_admin_get_field_name($v2).'">'.$_value.'</td>';
												}
											}
											else{
												$_value = esc_html(html_entity_decode($_value));
												//var_dump(($_value)); var_dump(strlen($_value)); exit;
												if(strlen($_value) > $display_character){
													
													echo '<td data-head="'.vsz_cf7_admin_get_field_name($v2).'">'.substr($_value, 0, $display_character).'...</td>';
												}else{
													echo '<td data-head="'.vsz_cf7_admin_get_field_name($v2).'">'.$_value.'</td>';
												}	
											}
										}//Close foreach
										echo '</tr>';
									}//Close foreach
								}
								else{
									?><tr><?php
										$span = count($fields) + 2;
										?><td colspan="<?php echo $span; ?>">
											No records found.
										</td><?php
									?></tr><?php
								}
							?></tbody>
							<tfoot>
								<tr><?php
									//Setup header section in table footer area
									echo '<td class="manage-column column-cb check-column"><input type="checkbox" id="cb-select-all-2" /></td>';
									if($edit == true){
										do_action('vsz_cf7_admin_after_heading_field');
									}	
									foreach ($fields as $k => $v){
										echo '<th class="manage-column" data-key="'.esc_html($v).'">'.vsz_cf7_admin_get_field_name($v).'</th>';
									}
								?></tr>
							</tfoot>
						</table>
					</div>
				</div>
				
				<input type="hidden" name="cpage" value="<?php echo $page;?>" id="cpage">		
				<input type="hidden" name="totalPage" value="<?php print ceil($total / $items_per_page);?>" id="totalPage">		
			</form>
			<script>
				//Setup pagination related functionality when click on page link then form submitted	
				jQuery(".pagination-links a").on('click',function(){
					var final_id;
					var url = jQuery(this).attr('href');
					var id_check = /[?&]cpage=([^&]+)/i;
					var match = id_check.exec(url);
					if(match != null){
						final_id = parseInt(match[1]);
					}
					if(final_id != ''){
						jQuery(this).attr("href","javascript:void(0)");
						jQuery('#cpage').val(final_id);
						document.getElementById('cf7d-admin-action-frm').submit();
					}	
				});
				
				//Add custom class in body tag when click on Setting button
				jQuery('#cf7d_setting_form').click(function(){
					jQuery('body').addClass('our-body-class');
				});
				//Updating record 
				jQuery(document).on('click','#update_cf7_value',function(){
					var filterdata = jQuery('.vsz-cf7-listing').html();
					jQuery('.cf7d-modal-form').append('<div style="display:none">'+filterdata+'</div>');

				});
				
			</script>
		</div><?php 
		//Define setting and Edit popup call back function
		do_action('vsz_cf7_after_admin_form',$fid); 
	}//Close if for check form id empty or not
	else if(!$exist_entry_flag){
		print '<div class="popup-note"><span>Currently not submission any form data.</span></div>';
	}
}