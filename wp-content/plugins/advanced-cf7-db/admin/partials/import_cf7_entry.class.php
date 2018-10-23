<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ){
	die('Un-authorized access!');
}

// Necessary condition to prevent direct access
if(!is_user_logged_in() || empty($_POST)){
	die('Try to do un-authorized access!');
}


//Define site global variables
global $wpdb,$vsz_cf7_csv_upload_error;

// Set Error object for get error during import process
$vsz_cf7_csv_upload_error = new WP_Error;


//Verify nonce values
$nonceEntryCheck = sanitize_text_field($_POST['wp_entry_nonce']);
if(!wp_verify_nonce( $nonceEntryCheck, 'import-cf7-save-entry-nonce')){
	// This nonce is not valid.
	$msg = 'Something may be wrong. Please try again.';
	$vsz_cf7_csv_upload_error->add('fill_form_fields','Something may be wrong. Please try again..');	
}

if(!isset($_POST['form_match_key']) || empty($_POST['form_match_key']) || !isset($_POST['vsz_cf7_field_type']) || empty($_POST['vsz_cf7_field_type'])){
	$vsz_cf7_csv_upload_error->add('fill_form_fields','Something may be wrong. Please try again.');	
}

$error_data = array();
$new_csv = array();
$error_csv  = array();
$header = '';

$fid = '';
//Get selected form Id value
if(isset($_POST['import_cf7_id']) && !empty($_POST['import_cf7_id'])){
	$fid = intval($_POST['import_cf7_id']);
}
else{
	$vsz_cf7_csv_upload_error->add('fill_form_id','First select any form then import sheet.');	
}

$sheet_date_format = '';
//Get selected form Id value
if(isset($_POST['sheet_date_format']) && !empty($_POST['sheet_date_format'])){
	$sheet_date_format = sanitize_text_field($_POST['sheet_date_format']);
}

// Start Importing sheet over here
	
if(isset($_POST['submit']) && isset($_FILES['importFormList']) && !empty($_FILES['importFormList']['name']) && empty( $vsz_cf7_csv_upload_error->errors )){
	
	//////////////////////////////////// SAVE FILE ////////////////////////////////////////
	
	$filename = sanitize_text_field($_FILES["importFormList"]["name"]);
	$file_basename = substr($filename, 0, strripos($filename, '.')); // get file name 
	$file_ext = substr($filename, strripos($filename, '.')); // get file extention
	
	//Define accepted file format here
	$allowed_file_types = array('.csv');
	//check file is valid type or not
	if(in_array($file_ext,$allowed_file_types)){
		//upload new file in '/csv/' directory 
		$newfilename = "import-cf7-form-list-". date('Ymdhis') . $file_ext;
		//move new import csv file in upload folder
		if(move_uploaded_file($_FILES["importFormList"]["tmp_name"], dirname(dirname(__FILE__))."/csv/".$newfilename)){
			//Get moved file path 
			$csv_file =  dirname(dirname(__FILE__))."/csv/".$newfilename; 
			//Check file is exist or not and open in read mode
			if (($handle = fopen($csv_file, "r")) !== FALSE){
				
				//Get Header details from CSV sheet
				$arrHeader = fgetcsv($handle);
				$header = $arrHeader;
				
				array_push($header,"Status");
				//Define option field type array
				$arr_option_type = array('checkbox','radio','select');
				//Get form id related field key information from option table
				$arr_form_match_key = array_map( 'sanitize_text_field', $_POST['form_match_key']);
				
				//If form exist radio and check boxes value then get option values
				$obj_form = vsz_cf7_get_the_form_list(intval($fid));
				$arr_form_tag = $obj_form[0]->scan_form_tags();
				$option_value = array();
				//Get option value field names 
				if(!empty($arr_form_tag)){
					foreach($arr_form_tag as $key => $arr_type){
						
						if(isset($arr_type['basetype']) && in_array($arr_type['basetype'],array('radio','checkbox'))){
							$option_value[$arr_type['name']] = $arr_type['values'];
						}
					}
				}
				//Get field type related information
				$vsz_cf7_field_type = array_map( 'sanitize_text_field', $_POST['vsz_cf7_field_type']);
				//check CSV sheet column count and match key count are same or not 
				if(!empty($arrHeader) && !empty($arr_form_match_key)){
				
					$key_define_column = array_map('strtolower', array_map('trim',$arr_form_match_key));
					$arr_sheet_column = array_map('strtolower',array_map('trim',$arrHeader));
					
					$arr_field_name = array();
					//Get Sheet field name related contact form fields name and set in array
					foreach($key_define_column as $fKey => $mKey){
						if(!empty($arr_sheet_column) && in_array($mKey,$arr_sheet_column)){
							
							$field_key = (int)array_search($mKey,$arr_sheet_column);
							$arr_field_name[$fKey] = $field_key;
						}
						else{
							
						}
					}
					
					//Check any field key match or not
					if(!empty($arr_field_name)){
						$updateIndex = 0;
						
						//Get sheet related entries 
						while($data = fgetcsv($handle)){
							//Counting the number of list in csv.
							$num = count($data);
							//Setup form key with related values
							$arr_insert_info = array();
							//Set all fields name related  value in array
							foreach($key_define_column as $fKey => $mKey){
								//Check form key exist in field name array or not
								if(array_key_exists($fKey,$arr_field_name)){
									//Check field type is checkbox or radio 
									if(!empty($vsz_cf7_field_type) && array_key_exists($fKey,$vsz_cf7_field_type) && in_array($vsz_cf7_field_type[$fKey],$arr_option_type)){
										//explode option field related value from sheet
										$arr_option = explode(',',$data[$arr_field_name[$fKey]]);
										$arr_insert_info[$fKey] = $arr_option;
									}
									else{
										$arr_insert_info[$fKey] = $data[$arr_field_name[$fKey]];
									}
								}
								else{
									$arr_insert_info[$fKey] = '';
								}
							}
							//Set submit time values if submit time value is empty
							if(array_key_exists('submit_time',$arr_insert_info)){
								//Check time value empty or not
								$arr_insert_info['submit_time'] = trim($arr_insert_info['submit_time']);
								$date_insert_flag = true;
								if(!empty($arr_insert_info['submit_time']) && !empty($sheet_date_format)){
									//Check date in valid format or not
									$sub_date = date_create_from_format($sheet_date_format,$arr_insert_info['submit_time']);
									if($sub_date !== false){
										$date_insert_flag = false;
										$arr_insert_info['submit_time'] = date_format($sub_date,"Y-m-d H:i:s");
									}
								}
								//set default date and time in submit_time parameter
								if($date_insert_flag){
									$arr_insert_info['submit_time'] = date_i18n('Y-m-d H:i:s', time());
								}
							}
							
							//Set submit if values if submit ip value is empty
							if(array_key_exists('submit_ip',$arr_insert_info) && empty($arr_insert_info['submit_ip'])){
								$arr_insert_info['submit_ip'] = '';
							}
							
							//Insert sheet related values in contact form Tables
							if(!empty($arr_insert_info)){
								//Insert current form submission time in database
								$time = date('Y-m-d H:i:s');
								$wpdb->query($wpdb->prepare('INSERT INTO '.VSZ_CF7_DATA_TABLE_NAME.'(`created`) VALUES (%s)', $time));
								//Get last inserted id 
								$data_id = (int)$wpdb->insert_id;
								
								//Insert form values in custom data entry table
								if(!empty($fid) && !empty($data_id)){
									//Get not inserted fields value list
									$cf7d_no_save_fields = vsz_cf7_no_save_fields();
									foreach ($arr_insert_info as $k => $v) {
										//Check not inserted fields name in array or not
										if(in_array($k, $cf7d_no_save_fields)) {
											continue;
										}
										else{
											//If value is check box and radio button value then creaye single string
											if(is_array($v)){
												$v = array_map('trim',$v);
												$v = implode("\n", $v);
											}
											$k = htmlspecialchars($k);
											$v = htmlspecialchars($v);
											$wpdb->query($wpdb->prepare('INSERT INTO '.VSZ_CF7_DATA_ENTRY_TABLE_NAME.'(`cf7_id`, `data_id`, `name`, `value`) VALUES (%d,%d,%s,%s)', $fid, $data_id, $k, $v));
										}
									}//Close foreach
									$new_csv[] = 'success';
								}//Close if for check not empty data and form id
								else{
									$errorMsg = 'This entry is not insert in Database.';
									$data[$num] = $errorMsg;
									$error_csv[$updateIndex] = array_combine($header, $data);
									$updateIndex ++;
									continue;
								}
							}//Close if for check insert array empty or not
							$updateIndex ++;
						}//Close while
						
						//Display total number of record added
						echo "<div class='updated notice notice-success is-dismissible'><p>New ".count($new_csv)." data submitted</p></div>";
					}//Close if for check field key exist or not in array
					else{
						$vsz_cf7_csv_upload_error->add('field_not_matched','Uploaded file column names and field setting CSV key names are not matched.');	
					}//close else	
				}//Close if for check CSV sheet column count and match key count are same or not 
				else{
					$vsz_cf7_csv_upload_error->add('field_not_set','Please check uploaded file columns or field setting CSV match keys.');	
				}
			}//Close if for CSV file handle
			else{
				$vsz_cf7_csv_upload_error->add('file_not_opend','Something may be wrong, Please try again later.');		
			}
		}//Close if for move uploaded file
		else{
			$vsz_cf7_csv_upload_error->add('file_not_moved','Something may be wrong, Please try again later.');		
		}
	}//Close if for check file extension
	else{
		$vsz_cf7_csv_upload_error->add('file_format','Please upload only CSV file format.');		
	}
}//Close if for submit 

//Display total number of errors
if(count($error_csv) > 0){
	$vsz_cf7_csv_upload_error->add('total_error','Total ' . count($error_csv) . ' errors are reported.');		
}
	
//Check for error status	
if(is_wp_error($vsz_cf7_csv_upload_error)){
	foreach($vsz_cf7_csv_upload_error->get_error_messages() as $error){
		echo "<div class='notice error is-dismissible'><p>".esc_html($error)."</p></div>";
	}
}

//generate error file if entry not insert in site
if(count($error_csv) >= 1){
	
	$error_file_name = "upload_error".date("Y-m-d H:i:s:u").".csv";	
	$myfile = fopen(dirname(dirname(__FILE__))."/csv/".$error_file_name, 'w') or 
		die("<div class='notice error is-dismissible'><p>Unable to open file!</p></div>");
	
	array_unshift($error_csv,$header);
	
	foreach ($error_csv as $fields){
		fputcsv($myfile, $fields,',');
	}
	fclose($myfile);
	
	echo '<div class="notice error is-dismissible"><p>You can download the error file from <a href="'.plugin_dir_url(dirname( __FILE__)).'csv/'.$error_file_name.'" target="_blank">here</a> </p></div>';
}
