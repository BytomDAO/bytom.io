(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

})( jQuery );


//Select form name then call
function submit_cf7(){
	var url = jQuery('#cf7_name').attr('action');
	var cf7_id = parseInt(jQuery('#cf7_id').val());
	if(!isNaN(cf7_id)){
		url = url+"&cf7_id="+cf7_id;
	}
	window.location = url;
}

//Select form name then call
function import_submit_cf7(){
	
	var url = jQuery('#base_url').val();
	var cf7_id = parseInt(jQuery('#import_cf7_id').val());
	if(!isNaN(cf7_id)){
		url += "&import_cf7_id="+cf7_id;
	}
	window.location = url;
}

//Check import file is CSV file or not
function checkfile(sender) {

	var validExts = new Array(".csv");
	var fileExt = sender.value;
	fileExt = fileExt.substring(fileExt.lastIndexOf('.'));
	if (validExts.indexOf(fileExt) < 0) {
		sender.value = '';
		alert("Invalid file uploaded, Please upload '" + validExts.toString() + "' types file only.");
	  return false;
	}
	else return true;
}

jQuery(document).ready(function($) {
    
	//Set date picker on listing screen
	jQuery("#start_date").datetimepicker({
		
		timepicker:false,
		format:'d/m/Y',	
		maxDate: "0",
		changeMonth: true,
		changeYear: true,
		closeOnDateSelect: true,
		scrollInput: false,
	});
	jQuery("#end_date").datetimepicker({
		
		timepicker:false,
		format:'d/m/Y',	
		maxDate: "0",
		changeMonth: true,
		changeYear: true,
		closeOnDateSelect: true,
		scrollInput: false,
	});
	
	//Setup date filter text box is readonly
	jQuery(".input-cf-date").attr("readonly","true");
	jQuery(".input-cf-date").css("background-color","#fff");
	
	
	//Setup icon functionality in setting page
	jQuery('#cf7d-list-field li span.dashicons').click(function(event) {
        var $this = jQuery(this);
        var $parent = $this.parent();
        var $custom_label = $parent.find('.txt_show');
        //currently visible
        if ($this.hasClass('dashicons-visibility')) {
            $this.removeClass('dashicons-visibility').addClass('dashicons-hidden');
            $parent.removeClass('show').addClass('hide');
            $custom_label.val('0');
        } else if ($this.hasClass('dashicons-hidden')) {
            $this.removeClass('dashicons-hidden').addClass('dashicons-visibility');
            $parent.removeClass('hide').addClass('show');
            $custom_label.val('1');
        }
    });
    
	/////////// For Date filter condition here/////////////
	jQuery('#search_date').click(function(event) {
		var startDate = document.getElementById('start_date');
		var endDate = document.getElementById('end_date');
		formCheck = true;
		
		if(startDate.value == ''){
			startDate.style.border = 'solid 1px red';
			startDate.value = '';
			//startDate.focus();
			formCheck = false;
		}
		else{
			startDate.style.border = '';
		}
		
		if(endDate.value == ''){
			endDate.style.border = 'solid 1px red';
			endDate.value = '';
			endDate.focus();
			formCheck = false;
		}
		else{
			endDate.style.border = '';
		}
		
		 //Detailed check for valid date ranges
		var dayfield=startDate.value.split("/")[0];
		var monthfield=startDate.value.split("/")[1];
		var yearfield=startDate.value.split("/")[2];
	
		var edayfield=endDate.value.split("/")[0];
		var emonthfield=endDate.value.split("/")[1];
		var eyearfield=endDate.value.split("/")[2];
		
		if(formCheck && (new Date(yearfield, monthfield-1, dayfield).getTime() > new Date(eyearfield, emonthfield-1, edayfield).getTime())){
			endDate.style.border = 'solid 1px red';
			endDate.value = '';
			endDate.focus();
			formCheck = false;
		}
		
		if(formCheck){
			endDate.style.border = '';
			jQuery('#cf7d-admin-action-frm').submit();
		}
		else{
			return false;
		}
		
	});
	
	
    /*
     * Edit value    
     */
    jQuery('a.cf7d-edit-value').click(function(event) {
       
		
	   jQuery('#cf7d-modal-form-edit-value').removeClass('loading');
		jQuery('body').addClass('our-body-class');
		
		document.getElementById('overlayLoader').style.display = "block";
		var rid = parseInt(jQuery(this).data('rid'));
			
		var arr_field_type = jQuery.parseJSON(jQuery('form#cf7d-modal-form-edit-value input[name="arr_field_type"]').val());
		var arr_option = ['radio','checkbox','select'];
		//console.log(arr_field_type);
        jQuery('form#cf7d-modal-form-edit-value input[name="rid"]').attr('value', rid);
		rs = jQuery('form#cf7d-modal-form-edit-value input[class^="field-"]');
		var arr_text = jQuery('form#cf7d-modal-form-edit-value textarea[class^="field-"]');
		
		//Set all fields value is loading
		for(var fieldname in arr_field_type){
			if(Object.keys(arr_field_type[fieldname]).length == 1){
			//if(!arr_option.includes(arr_field_type[fieldname])){
				//check field type is not text and file 
				if(arr_field_type[fieldname]['basetype'] != 'text' && arr_field_type[fieldname]['basetype'] != 'file'){
					jQuery('form#cf7d-modal-form-edit-value textarea[class^="field-'+fieldname+'"]').html('Loading...');
				}
				else{
					//console.log(arr_field_type[fieldname]['basetype']);
					//Remove previous define anchor tag in edit form
					if(jQuery('form#cf7d-modal-form-edit-value input[class^="field-'+fieldname+'"]').parent().find('a')){
						jQuery('form#cf7d-modal-form-edit-value input[class^="field-'+fieldname+'"]').parent().find('a').remove();
						jQuery('form#cf7d-modal-form-edit-value input[class^="field-'+fieldname+'"]').parent().find('.vsz_cf7_db_file_edit').remove();
						jQuery('form#cf7d-modal-form-edit-value input[class^="field-'+fieldname+'"]').parent().find('.edit-field-file-val').remove();
						jQuery('form#cf7d-modal-form-edit-value input[class^="field-'+fieldname+'"]').parent().find('span.margin_left').remove();
					}
					jQuery('form#cf7d-modal-form-edit-value input[class^="field-'+fieldname+'"]').attr('value', 'Loading...');
				}
			}
			//this else call when fileld type is option values
			else{
				jQuery('form#cf7d-modal-form-edit-value textarea[class^="field-'+fieldname+'"]').html('Loading...');
			}
		}
		
		//Call Ajax request here for get entry related information
		jQuery.ajax({
            url: ajaxurl + '?action=vsz_cf7_edit_form_value',
            type: 'POST',
            data: {'rid': rid},
        })
        .done(function(data) {
            //Decode json data here
			var json = jQuery.parseJSON(data);
			//Set fields value
			jQuery.each(json, function(index, el){
                //Get existing fields information
				if(index in arr_field_type){
					
					//Check existing field length for field type is check box or radio button
					//if(Object.keys(arr_field_type[index]).length > 1){
					if(false && arr_option.includes(arr_field_type[index]['basetype'])){
						//Get all existing checkboxes values
						var arr_checkbox = jQuery('form#cf7d-modal-form-edit-value input[class^="field-'+index+'"]');
						//Set option box values 
						//if(arr_checkbox.length == 0){
						if(arr_field_type[index]['basetype'] == 'select'){
							jQuery('form#cf7d-modal-form-edit-value select option[value="'+el+'"]').prop('selected', true);
						}
						else{
							//Split existing check box values
							arr_values = el.split('\n');
							//Add or remove checked attributes on check boxes
							jQuery.each(arr_checkbox, function(indexc, elc){
								//Set checked value check boxes  
								if(arr_values != '' && arr_values.includes(jQuery(this).val())){
									jQuery(this).attr('checked','checked');
								}
								else{
									jQuery(this).removeAttr('checked');
								}
							});
						}
					}
					//Set file field related functionality here 
					else if(arr_field_type[index]['basetype'] == 'file'){
						if(el){
							var filename = el.split('/').pop();
							// var filename = el;
							jQuery('form#cf7d-modal-form-edit-value .field-' + index).attr('value', filename);
							jQuery('form#cf7d-modal-form-edit-value .field-' + index).css("border","");
							jQuery('form#cf7d-modal-form-edit-value .field-' + index).parent().append('<a class="margin_left" href="'+el+'" target="_blank" download >Download</a>');
							jQuery('form#cf7d-modal-form-edit-value .field-' + index).parent().append('<a value="Change" class="vsz_cf7_db_file_edit" style="margin-left: 10px;" href="javascript:void(0);" >Remove</a>');
							add_remove_file(index, filename);
						}
						else{
							add_remove_file(index, "");
						}
					}
					//Check field type is text then execute this code
					else if(arr_field_type[index]['basetype'] == 'dynamictext' || arr_field_type[index]['basetype'] == 'dynamichidden' || arr_field_type[index]['basetype'] == 'text' || arr_field_type[index]['basetype'] == 'email'  || arr_field_type[index]['basetype'] == 'url'|| arr_field_type[index]['basetype'] == 'tel' || arr_field_type[index]['basetype'] == 'URL' || arr_field_type[index]['basetype'] == 'number' || arr_field_type[index]['basetype'] == 'date' || arr_field_type[index]['basetype'] == 'acceptance' || arr_field_type[index]['basetype'] == 'quiz' ){
						jQuery('form#cf7d-modal-form-edit-value .field-' + index).attr('value', el);
					}
					//Set other fields values likes text area and option values
					else{
						jQuery('form#cf7d-modal-form-edit-value .field-' + index).html(el);
					}
				}
				else{ 
					jQuery('form#cf7d-modal-form-edit-value .field-' + index).attr('value', el);	
				}
				
			});
			
			//Remove Loading word on all fields values
			jQuery.each(rs, function(index, el){
				if(jQuery(this).val() == 'Loading...'){
					jQuery(this).val('');
					if(jQuery(this).parent().find('a')){
						jQuery(this).parent().find('a').html("");
					}
				}
			});
			
			//Remove text area to loading value 
			jQuery.each(arr_text, function(index, el){
				if(jQuery(this).val() == 'Loading...'){
					jQuery(this).val('');
				}
			});
			
			//setTimeout(function(){ document.getElementById('overlayLoader').style.display = "none"; }, 1000);
        })
        .fail(function() {
            console.log("error");
		})
        .always(function() {
            console.log("complete");
			document.getElementById('overlayLoader').style.display = "none";
        });
		
	});
	
	//Add email field validation on Edit form 
	jQuery('#update_cf7_value').click(function(){
		var arr_field_type = jQuery.parseJSON(jQuery('form#cf7d-modal-form-edit-value input[name="arr_field_type"]').val());
		var flagReturn =true;
		for(var fieldname in arr_field_type){
			if(Object.keys(arr_field_type[fieldname]).length == 1){
				var selecter = jQuery('form#cf7d-modal-form-edit-value input[class^="field-'+fieldname+'"]');
				if(arr_field_type[fieldname]['basetype'] == 'email' && selecter.length && selecter.val().trim().length > 0 && !validateEmail(selecter.val().trim())){
					selecter.css('border','1px solid red');
					flagReturn =false;
				}
				else{
					selecter.css('border','');
				}
			}
		}
		if(flagReturn){
			return true;
		}
		return false;
	});
	
    /*
     * Search
     */
    jQuery('#cf7d-search-btn').click(function(event) {
        var $this = jQuery(this);
        var form = jQuery('#cf7d-admin-action-frm');
        var q = jQuery('#cf7d-search-q').val();
        if (q != "") {
            var url = $this.data('url');
			form.submit();
        }
		else{
            return false;
        }
    });
   
});

//Define valid email address function here
function validateEmail(email) {
	
	var expr = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,10}|[0-9]{1,3})(\]?)$/;
	return expr.test(email);
};

// Define add remove file for edit section
function add_remove_file(index,filename){
	
	if(filename != ""){
		jQuery('form#cf7d-modal-form-edit-value .field-' + index).show();
		jQuery('form#cf7d-modal-form-edit-value .field-' + index).parent().find(".vsz_cf7_db_file_edit").each(function(){
			jQuery(this).click(function(){
				if(confirm("Are you sure to remove the file? File will be deleted permanently and could not be retrieved.")){
					
					var fid = jQuery("input[name='fid']").val();
					var rid = jQuery("input[name='rid']").val();
					var field = index;
					
					var fd = new FormData();
					fd.append( "fid", fid);
					fd.append( "rid", rid);
					fd.append( "field", field);
					fd.append( "val", filename);
					fd.append( "action", "acf7_db_edit_scr_file_delete");
					
					jQuery.ajax({
						url: ajaxurl,
						type: 'POST',
						data : fd,
						processData: false,
						contentType: false,
						beforeSend: function() {
							document.getElementById('overlayLoader').style.display = "block";
						},
						success: function(data) {
							jQuery('form#cf7d-modal-form-edit-value .field-' + index).parent().prepend('<input type="file" name="field['+index+']" class="field-'+index+'-val edit-field-file-val" />');
							jQuery('form#cf7d-modal-form-edit-value .field-' + index).parent().find('a').remove();
							jQuery('form#cf7d-modal-form-edit-value .field-' + index).parent().append('<span class="margin_left">Maximum file size allowed : 7.60 MB.</span><span class="margin_left" style="display: block;">It is possible that server has limit less than 7.60 MB, in that case it can terminate the request. It is advisable to keep upload file size as minimum as possible.</span>');
							jQuery('form#cf7d-modal-form-edit-value .field-' + index).hide();
							
							document.getElementById('overlayLoader').style.display = "none";
							
							jQuery(".field-"+index+"-val").change(function(){
								var thisdata = jQuery(this);
								var fileName = jQuery(thisdata).val();
								var checkvalidate = 1;
								
								if(fileName != "" && fileName != undefined){
									var fd = new FormData();
									var fid = jQuery("input[name='fid']").val();
									var rid = jQuery("input[name='rid']").val();
									var field = index;
									
									fd.append( "image", jQuery(thisdata)[0].files[0]);
									fd.append( "action", "acf7_db_edit_scr_file_upload");
									fd.append( "fid", fid);
									fd.append( "rid", rid);
									fd.append( "field", field);
									
									jQuery.ajax({
										url: ajaxurl,
										type: 'POST',
										data : fd,
										processData: false,
										contentType: false,
										beforeSend: function() {
											document.getElementById('overlayLoader').style.display = "block";
										},

										success: function(data) {
											if(data != "invalid_size"){
												dataArr = data.split("~~@@~~&&~~");
												
												var filename = dataArr[0];
												var el = dataArr[1];
												
												jQuery('form#cf7d-modal-form-edit-value .field-' + index).attr('value', filename);
												jQuery('form#cf7d-modal-form-edit-value .field-' + index).css("border","");
												jQuery('form#cf7d-modal-form-edit-value .field-' + index).parent().append('<a class="margin_left" href="'+el+'" target="_blank" download >Download</a>');
												jQuery('form#cf7d-modal-form-edit-value .field-' + index).parent().append('<a value="Change" class="vsz_cf7_db_file_edit" style="margin-left: 10px;" href="javascript:void(0);" >Remove</a>');
												jQuery('form#cf7d-modal-form-edit-value .field-' + index).show();
												jQuery('form#cf7d-modal-form-edit-value .field-' + index).parent().find('.field-'+index+'-val').remove();
												jQuery('form#cf7d-modal-form-edit-value .field-' + index).parent().find('span.margin_left').remove();
												
												// Calling function which will handle the removal and new upload of the files
												add_remove_file(index,filename);
											}
											else{
												alert("Maximum file size allowed is 7.60 MB.");
											}
											
											document.getElementById('overlayLoader').style.display = "none";
										},

										error: function(data) {
											console.log(data);
											document.getElementById('overlayLoader').style.display = "none";
											alert("Sorry file was not uploaded.");
											return false;
										},
									});
								}
							});
						},
						error: function(data) {
							console.log(data);
							document.getElementById('overlayLoader').style.display = "none";
							alert("Sorry file was not removed.");
							return false;
						},
					});
					
				}
			});
		});
	}
	else{
		jQuery('form#cf7d-modal-form-edit-value .field-' + index).parent().prepend('<input type="file" name="field['+index+']" class="field-'+index+'-val edit-field-file-val" />');
		jQuery('form#cf7d-modal-form-edit-value .field-' + index).parent().find('a').remove();
		jQuery('form#cf7d-modal-form-edit-value .field-' + index).parent().append('<span class="margin_left">Maximum file size allowed : 7.60 MB.</span><span class="margin_left" style="display: block;">It is possible that server has limit less than 7.60 MB, in that case it can terminate the request. It is advisable to keep upload file size as minimum as possible.</span>');
		jQuery('form#cf7d-modal-form-edit-value .field-' + index).hide();
		
		document.getElementById('overlayLoader').style.display = "none";
		
		jQuery(".field-"+index+"-val").change(function(){
			var thisdata = jQuery(this);
			var fileName = jQuery(thisdata).val();
			var checkvalidate = 1;
			
			if(fileName != "" && fileName != undefined){
				var fd = new FormData();
				var fid = jQuery("input[name='fid']").val();
				var rid = jQuery("input[name='rid']").val();
				var field = index;
				
				fd.append( "image", jQuery(thisdata)[0].files[0]);
				fd.append( "action", "acf7_db_edit_scr_file_upload");
				fd.append( "fid", fid);
				fd.append( "rid", rid);
				fd.append( "field", field);
				
				jQuery.ajax({
					url: ajaxurl,
					type: 'POST',
					data : fd,
					processData: false,
					contentType: false,
					beforeSend: function() {
						document.getElementById('overlayLoader').style.display = "block";
					},

					success: function(data) {
						if(data != "invalid_size"){
							dataArr = data.split("~~@@~~&&~~");
							
							var filename = dataArr[0];
							var el = dataArr[1];
							
							jQuery('form#cf7d-modal-form-edit-value .field-' + index).attr('value', filename);
							jQuery('form#cf7d-modal-form-edit-value .field-' + index).css("border","");
							jQuery('form#cf7d-modal-form-edit-value .field-' + index).parent().append('<a class="margin_left" href="'+el+'" target="_blank" download >Download</a>');
							jQuery('form#cf7d-modal-form-edit-value .field-' + index).parent().append('<a value="Change" class="vsz_cf7_db_file_edit" style="margin-left: 10px;" href="javascript:void(0);" >Remove</a>');
							jQuery('form#cf7d-modal-form-edit-value .field-' + index).show();
							jQuery('form#cf7d-modal-form-edit-value .field-' + index).parent().find('.field-'+index+'-val').remove();
							jQuery('form#cf7d-modal-form-edit-value .field-' + index).parent().find('span.margin_left').remove();
							
							// Calling function which will handle the removal and new upload of the files
							add_remove_file(index,filename);
						}
						else{
							alert("Maximum file size allowed is 7.60 MB.");
						}
						
						document.getElementById('overlayLoader').style.display = "none";
					},

					error: function(data) {
						console.log(data);
						document.getElementById('overlayLoader').style.display = "none";
						alert("Sorry file was not uploaded.");
						return false;
					},
				});
			}
		});
	}
}

/**************** Check fields key related match key value empty or not *************************/
jQuery(document).ready(function() {

	//Get current page information 
	var active_sub_menu = jQuery('.pagination-links').find('span');
	if(active_sub_menu.hasClass('current') ){ // .hasClass() returns BOOLEAN true/false
		page_id = parseInt(jQuery('.pagination-links .current').html());
		jQuery('.pagination-links .current').html('<input type="number" step="1" min="1" class="tiny-text" name="current_page" id="current_page" value="'+page_id+'" size="1" aria-describedby="table-paging">');
	}
	
	//When enter key press on page number text field then form submit with new information
	jQuery('#current_page').keydown(function(e){
		if(e.which === 13){
		  if(jQuery('#current_page').val().trim().length > 0){
			var new_val = parseInt(jQuery('#current_page').val().trim());
			var totalPage = parseInt(jQuery('#totalPage').val().trim());
			if(new_val <= totalPage){
				jQuery('#cpage').val(new_val);
				document.getElementById('cf7d-admin-action-frm').submit();	
			}
		  }
		  return false;
		}
  });
	
	jQuery('#import_sheet').on('click',function(){
		var count = 0;
		jQuery(".match-key").each(function() {
			if(jQuery(this).val()){
				count ++;	
			}
		});
		if(count){
			if(document.getElementById('importFormList').value != ''){
				return true;
			}
			return false;
		}
		else{
			alert('Please enter match CSV column name.');
			return false;
		}
	});
});