<?php 
	
	/*############################### Admin Menu ########################################*/
	
class wpdevart_countdown_admin_menu{
	
	private $menu_name;
	private $databese_parametrs;
	private $plugin_url;
	private $text_parametrs;

	/*###################### Constract parameters function ##################*/		
	
	function __construct($param){
				
		$this->menu_name=$param['menu_name'];
		$this->databese_parametrs=$param['databese_parametrs'];
		if(isset($params['plugin_url']))
			$this->plugin_url=$params['plugin_url'];
		else
			$this->plugin_url=trailingslashit(dirname(plugins_url('',__FILE__)));


		// Insert button code
		add_action('media_buttons_context', array($this,'wpdevart_countdown_button'));
		add_action( 'wp_ajax_wpdevart_countdown_window_manager', array($this,'wpdevart_countdown_window_insert_content') );
		
		add_action( 'wp_ajax_wpdevart_countdown_page_save', array($this,'save_in_databese') );
		add_action( 'wp_ajax_wpdevart_countdown_send_mail', array($this,'sending_mail') );
	}
	
	/*############################### Insert button function ########################################*/
	
	public function wpdevart_countdown_button($context) {
	  
	  $img = $this->plugin_url. 'images/post_button.jpg';
	
	  $title = 'Add Countdown';	
	  $context .= '<a class="button thickbox" title="Create countdown and insert in posts/pages"    href="'.admin_url("admin-ajax.php").'?action=wpdevart_countdown_window_manager&height=750&width=640">
			<span class="wp-media-buttons-icon" style="background: url('.$img.'); background-repeat: no-repeat; background-position: left bottom;"></span>
		Add Countdown
		</a>';  
	  return $context;
	}

    /*############  Insert countdown - content function  ################*/	
	
	public function wpdevart_countdown_window_insert_content(){
		//wp_enqueue_script('jquery-ui-slider');
		?>
        <style>
        #miain_wpdevart_countdown_window_manager > tbody > tr:nth-child(odd) {
		  background-color: rgba(176, 176, 176, 0.07);
		}
		#miain_wpdevart_countdown_window_manager>tfoot>tr>td{
			border-top:1px solid #ccc;
		}
		#TB_window{  
			overflow-y: auto;
		}
		#TB_ajaxContent{
			width:95% !important;
		}
		.wp-picker-holder{
			position: absolute;
 			z-index: 100000;
		}
		.desription_class{
			float: right;
			cursor: default;
			color: #0074a2;
			font-size: 18px;
			font-weight: bold;
			border: 1px solid #000000;
			border-radius: 200px;
			height: 20px;
			padding-left: 6px;
			padding-right: 6px;
			margin-left: 15px;
		}
		.pro_feature {
		  font-size: 13px;
		  font-weight: bold;
		  color: rgba(10, 154, 62, 1);
		}
        </style>
			<table id="miain_wpdevart_countdown_window_manager" class="wp-list-table widefat fixed posts section_parametrs_table">  
                <tbody> 
                    <tr>
						<td>
							Day field text <span title="Type here text for Day field." class="desription_class">?</span>
						</td>
						<td>
							<input type="text" name="countdown_days_text"  id="countdown_days_text" value="Days">
						</td>                
					</tr>
                     <tr>
						<td>
							Hour field text <span title="Type here text for Hour field." class="desription_class">?</span>
						</td>
						<td>
							<input type="text" name="countdown_hourse_text"   id="countdown_hourse_text" value="Hours">
						</td>                
					</tr>
                     <tr>
						<td>
							Minute field text <span title="Type here text for Minute field." class="desription_class">?</span>
						</td>
						<td>
							<input type="text" name="countdown_minuts_text"  id="countdown_minuts_text" value="Minutes">
						</td>                
					</tr>
                     <tr>
						<td>
							Second field text <span title="Type here text for Second field." class="desription_class">?</span>
						</td>
						<td>
							<input type="text" name="countdown_seconds_text"   id="countdown_seconds_text" value="Seconds">
						</td>                
					</tr>
                    <tr>
						<td>
							Countdown date picker type <span title="Select the Countdown date picker type." class="desription_class">?</span>
                           
						</td>
						<td>
							 <select class="show_hide_experet_type" id="countdown_experet_type">
                                    <option selected="selected" value="time">Time</option>
                                    <option value="date">Date</option>
                             </select>
						</td>                
					</tr>
                     <tr class="expert_type_date" style="display:none">
						<td>
							Countdown expire date : <span title="Select Countdown expire date." class="desription_class">?</span>
						</td>
						<td>
       						 <input type="text"  value="<?php echo  date('d-m-Y 23:59') ?>" id="countdown_experet_date" /><small>dd-mm-yyyy hh:ii</small>
						</td>                
					</tr>
                	<tr  class="expert_type_time">
						<td>
							Countdown expire time <span title="Type the Countdown expire time." class="desription_class">?</span>
						</td>
						<td style="vertical-align: top !important;">
                            <span style="display:inline-block; margin-right:3px; width:55px;">
                            	<input type="text" placeholder="Day"   id="countdownday" size="3" value="0"/>
                            	<small style="display:block">Day</small>
                            </span>
                           	<span style="display:inline-block; width:55px;">
                                 <input type="text"  placeholder="Hour" id="countdownhour" size="3" value="1"/>
                                 <small>Hour</small>
                            </span>
                          	<span style="display:inline-block; width:55px;"> 
                            	<input type="text"  placeholder="Minut"  id="countdownminute" size="3" value="1"/>
                            	<small>Minute</small>
                            </span>
                            <input type="hidden" value='<?php echo mktime (date("H"), date("i"), date("s"),date("n"), date("j"),date("Y")); ?>' id="countdown_start_date" name="countdown_start_date" />
                         </td>                
					</tr>                            
					<tr>
						<td>
							<span style="color:red">After Countdown expire</span> <span title="Select the action you prefere after Countdown time expire." class="desription_class">?</span>
						</td>
						<td>
                           <select id="countdownstart_on" >
                                <option selected="selected" value="hide">Hide countdown</option>
                                <option value="show_text">Show text</option>
                        	</select>
                         </td>                
					</tr>
                    </tr>
                     <tr>
						<td>
							Message after countdown expire <span title="Type the message that will appear after countdown time expire. " class="desription_class">?</span>
						</td>
						<td>
							<textarea type="text" name="expeiret_text"   id="expeiret_text"></textarea>   
                         </td>                
					</tr>
                    <tr>
						<td>
							Countdown timer position <span title="Select the Countdown Timer position." class="desription_class">?</span>
						</td>
						<td>
                           <select  id="countdown_in_content_position">
                                <option  value="left">Left</option>
                                <option selected="selected"  value="center">Center</option>
                                <option  value="right">Right</option>
                        	</select>
                         </td>                
					</tr>
                    <tr>
						<td>
							Countdown distance from top <span title="Type the Countdown distance from top(px)." class="desription_class">?</span>
						</td>
						<td>
							<input type="text" name="countdown_top_distance"  id="countdown_top_distance" value="10">(Px)
						</td>                
					</tr>
					<tr>
						<td>
							Countdown distance from bottom <span title="Type the Countdown distance from bottom(px)." class="desription_class">?</span>
						</td>
						<td>
							<input type="text" name="countdown_bottom_distance"  id="countdown_bottom_distance" value="10">(Px)
						</td>                
					</tr>
                    <tr>
						<td>
							Countdown timer buttons type <span class="pro_feature"> (pro)</span> <span title="Choose the Countdown buttons type." class="desription_class">?</span>
						</td>
						<td>
                           <select onChange="alert(countdown_pro_text)" id="countdown_type" class="coming_set_hiddens">
                                <option selected="selected" value="button">Button</option>
                                <option value="circle">Circle</option>
                                <option value="vertical_slide">Vertical Slider</option>
                        	</select>
                         </td>                
					</tr>
                   
                    <tr class="tr_button tr_circle tr_vertical_slide">
                        <td>
                        	Countdown timer text color <span class="pro_feature"> (pro)</span> <span title="Choose the Countdown text color." class="desription_class">?</span>
                        </td>
                        <td>
							<div onClick="alert(countdown_pro_text)">
								<div class="wp-picker-container disabled_picker">
									<button type="button" class="button wp-color-result" aria-expanded="false" style="background-color: rgb(0, 0, 0);"><span class="wp-color-result-text">Select Color</span></button>
								</div>                            
							</div>
                         </td>                
                    </tr>
                    <tr class="tr_button tr_circle tr_vertical_slide">
                        <td>
                           Countdown timer background color <span class="pro_feature"> (pro)</span> <span title="Select the Countdown background color." class="desription_class">?</span>
                        </td>
                        <td>
                            <div onClick="alert(countdown_pro_text)">
								<div class="wp-picker-container disabled_picker">
									<button type="button" class="button wp-color-result" aria-expanded="false" style="background-color: rgb(62, 89, 165);"><span class="wp-color-result-text">Select Color</span></button>
								</div>                            
                            </div>
                         </td>                
                    </tr>
                       <tr  class="tr_circle">
						<td>
							Countdown timer size <span class="pro_feature"> (pro)</span> <span title="Type the Countdown size." class="desription_class">?</span>
						</td>
						<td>
							<input onClick="alert(countdown_pro_text)" type="text" name="countdown_circle_size"  id="countdown_circle_size" value="130">(Px)
						</td>                
					</tr>
                 
                     <tr  class="tr_circle">
						<td>
							Countdown timer border width <span class="pro_feature"> (pro)</span> <span title="Type the Countdown border width(px)." class="desription_class">?</span>
						</td>
						<td>
                        	<input onClick="alert(countdown_pro_text)" type="text" size="3" name="countdown_circle_border" value="5" id="countdown_circle_border" style="font-weight:bold; width:35px" >(0-100)%
                           
						</td>                
					</tr>
                     <tr class="tr_button">
						<td>
							Countdown timer border radius <span class="pro_feature"> (pro)</span> <span title="Type the Countdown border radius(px)." class="desription_class">?</span>
						</td>
						<td>
							<input onClick="alert(countdown_pro_text)" type="text" name="countdown_border_radius"  id="countdown_border_radius" value="8">(Px)
						</td>                
					</tr>
                     <tr  class="tr_button tr_vertical_slide">
						<td>
							Countdown timer font size <span class="pro_feature"> (pro)</span> <span title="Type the Countdown font-size(px)." class="desription_class">?</span>
						</td>
						<td>
							<input onClick="alert(countdown_pro_text)" type="text" name="countdown_font_size" id="countdown_font_size" value="30">(Px)
						</td>                
					</tr>
                  
                     <tr  class="tr_button tr_circle tr_vertical_slide">
						<td>
							Countdown timer Font Family <span class="pro_feature"> (pro)</span> <span title="Select the Countdown Font family." class="desription_class">?</span>
						</td>
						<td>
							<?php wpdevart_countdown_setting::generete_fonts('countdown_font_famaly',"monospace") ?>
						</td>                
					</tr> 
                    <tr>
						<td>
							Countdown animation type <span class="pro_feature"> (pro)</span> <span title="Select the Countdown animation type." class="desription_class">?</span>
						</td>
						<td>
							<?php wpdevart_countdown_setting::generete_animation_select('countdown_animation_type','none'); ?>
						</td>                
					</tr>
                </tbody>
                <tfoot>
                	<tr>                      
                        <td colspan="2">
                        	 <div style="display:inline-block; float:left;" class="mceActionPanel"><input type="button" id="cancel" name="cancel" value="Insert Countdown" class="button button-primary" onClick="insert_countdown();"/></div>
                        	<span style="float:right"><a href="http://wpdevart.com/wordpress-countdown-plugin" target="_blank" style="color: rgba(10, 154, 62, 1);; font-weight: bold; font-size: 18px; text-decoration: none;">Upgrade to Pro Version</a><br></span>
                        </td>                
                    </tr>
                </tfoot>
            </table>         
    
                   
    
    <script type="text/javascript">
	
	 	var countdown_pro_text="If you want to use this feature upgrade to Countdown Pro"
       jQuery('#TB_window').css('max-height',(jQuery('#miain_wpdevart_countdown_window_manager').height()+66)+'px');
	   jQuery('#TB_ajaxContent').css('max-height',(jQuery('#miain_wpdevart_countdown_window_manager').height()+16)+'px');
	   jQuery('#miain_wpdevart_countdown_window_manager').ready(function(e) {
                jQuery(".color_option").wpColorPicker();
        });
		jQuery('.coming_set_hiddens').change(function(){
			jQuery(this).find('option').each(function(index, element) {
				jQuery('.tr_'+jQuery(this).val()).hide();
			});
			 jQuery('.tr_'+jQuery(this).val()).show();
		})
		jQuery('.coming_set_hiddens option').each(function(index, element) {
			jQuery('.tr_'+jQuery(this).val()).hide();
		});
		jQuery('.coming_set_hiddens').each(function(index, element) {
			jQuery('.tr_'+jQuery(this).val()).show();
		});
		//Show hidden countdown timer in the end of date type
		jQuery('.show_hide_experet_type').change(function(){
			if(jQuery(this).val()=='date'){
				jQuery('.expert_type_date').show();
				jQuery('.expert_type_time').hide();
			}else{
				jQuery('.expert_type_date').hide();
				jQuery('.expert_type_time').show();
			}
		})	
		var nowTemp = new Date();
		var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
		jQuery('#countdown_experet_date').fdatepicker({
		  format: 'dd-mm-yyyy hh:ii',
		  pickTime: true,
		  onRender: function (date) {
			return date.valueOf() < now.valueOf() ? 'disabled' : '';
		   }
		});
		
		jQuery( '.slider_div' ).slider({
			orientation: "horizontal",
			range: "min",
			value: 5,
			min: 0,
			max: 100,
			slide: function( event, ui ) {
				jQuery( loc_this ).val( ui.value );
			}
		});
        function insert_countdown() {          
			
                var tagtext;
				var variables='';
				
				if(jQuery('#countdown_days_text').length)
					variables=variables+'text_for_day="'+jQuery('#countdown_days_text').val()+'" ';
					
				if(jQuery('#countdown_hourse_text').length)
					variables=variables+'text_for_hour="'+jQuery('#countdown_hourse_text').val()+'" ';
					
				if(jQuery('#countdown_minuts_text').length)
					variables=variables+'text_for_minut="'+jQuery('#countdown_minuts_text').val()+'" ';
					
				if(jQuery('#countdown_seconds_text').length)
					variables=variables+'text_for_second="'+jQuery('#countdown_seconds_text').val()+'" ';
				
				if(jQuery('#countdown_experet_type').length)
					variables=variables+'countdown_end_type="'+jQuery('#countdown_experet_type').val()+'" ';
				
				if(jQuery('#countdown_experet_date').length)
					variables=variables+'end_date="'+jQuery('#countdown_experet_date').val()+'" ';
				
				if(jQuery('#countdown_start_date').length)
					variables=variables+'start_time="'+jQuery('#countdown_start_date').val()+'" ';
				
					variables=variables+'end_time="'+jQuery('#countdownday').val()+','+jQuery('#countdownhour').val()+','+jQuery('#countdownminute').val()+'" ';
					
				if(jQuery('#countdownstart_on').length)
					variables=variables+'action_end_time="'+jQuery('#countdownstart_on').val()+'" ';
				
				if(jQuery('#countdown_in_content_position').length)
					variables=variables+'content_position="'+jQuery('#countdown_in_content_position').val()+'" ';
					
				if(jQuery('#countdown_top_distance').length)
					variables=variables+'top_ditance="'+jQuery('#countdown_top_distance').val()+'" ';
					
				if(jQuery('#countdown_bottom_distance').length)
					variables=variables+'bottom_distance="'+jQuery('#countdown_bottom_distance').val()+'" ';					
                tagtext = '[wpdevart_countdown '+variables+']'+jQuery('#expeiret_text').val()+'[/wpdevart_countdown]';
                window.send_to_editor(tagtext);
              	tb_remove()
        }

    </script>
    </body>
    </html>
<?php
die;	
}

	/*###################### Create menu function ##################*/	
	
	public function create_menu(){
		$main_page 	 	  = add_menu_page( $this->menu_name, $this->menu_name, 'manage_options', str_replace( ' ', '-', $this->menu_name), array($this, 'main_menu_function'),$this->plugin_url.'images/timer.png');
		$page_countdown	  =	add_submenu_page($this->menu_name,  $this->menu_name,  $this->menu_name, 'manage_options', str_replace( ' ', '-', $this->menu_name), array($this, 'main_menu_function'));
		$page_countdown	  = add_submenu_page( str_replace( ' ', '-', $this->menu_name), 'Featured Plugins', 'Featured Plugins', 'manage_options', 'countdown-featured-plugins', array($this, 'featured_plugins'));
		add_action('admin_print_styles-' .$main_page, array($this,'menu_requeried_scripts'));
		add_action('admin_print_styles-' .$page_countdown, array($this,'menu_requeried_scripts'));		
	}
	
	/*###################### Menu scripts required function ##################*/	
	
	public function menu_requeried_scripts(){
		wp_enqueue_style('wpdevart-countdown-admin-style');
	}	
	
	/*###################### Main menu function ##################*/	
	
	public function main_menu_function(){		
	?>
   <h2 class="headin_countdown">WordPress Countdown General Page <a target="blank" href="<?php echo wpdevart_countdown_support_url; ?>" class="wp_support">Support</a></h2>
   <style>
   .headin_countdown{
		font-size: 23px;
		font-weight: 400;
		padding: 9px 15px 4px 0;
		line-height: 29px;
	}
	.image_width_description{
		display:inline-block;
		margin-right:40px;
		margin-top:30px;
		max-width:510px;
	}
	.image{
		border:3px solid #0073AA;
		border-radius:20px;
	}
	.description{
		display:block;
		margin-bottom:15px;		
		font-style: normal !important;
		font-weight: bold;
		font-size: 14px;
	}
	
	/*For Support link*/

	.wp_support {
		display: inline-block;
		float: right;
		background: #fff url(<?php echo  $this->plugin_url; ?>images/support.png) no-repeat 7px center;
		padding: 8px 20px 9px 45px;
		font-size: 16px;
		text-decoration: none;
		border-radius: 2px;
		border: 1px solid #d4d4d4;
		margin-right: 20px;
	}   
   </style>
  	 <div class="image_width_description">
     <span class="description">For adding countdown timer into your website pages/posts go to your pages/posts editor and use Countdown Insert Button. Click on shortcode button and set Countdown timer options, then click on "Insert Countdown" button. Check the screenshot below</span>
    	<img class="image" src="<?php echo $this->plugin_url.'images/post_example.jpg' ?>">
    </div>
     <div class="image_width_description">
     <span class="description">For adding countdown timer into your website Sidebars go to your website Widgets page, pick and drop Countdown widget into your sidebar. Then set the Countdown timer options, then save changes. Look the screenshot below</span>
    	<img class="image" src="<?php echo $this->plugin_url.'images/widget_example.jpg' ?>">
    </div>

	<?php 
	}

	/*############################### Featured plugins function ########################################*/
	
	public function featured_plugins(){
		$plugins_array=array(
			'countdown_extended'=>array(
						'image_url'		=>	$this->plugin_url.'images/featured_plugins/icon-128x128.png',
						'site_url'		=>	'http://wpdevart.com/wordpress-countdown-extended-version',
						'title'			=>	'Countdown - Extended version ',
						'description'	=>	'Countdown extended is an fresh and extended version of countdown timer. You can easily create and add countdown timers to your website.'
						),
		    'gallery_album'=>array(
						'image_url'		=>	$this->plugin_url.'images/featured_plugins/gallery-album-icon.png',
						'site_url'		=>	'http://wpdevart.com/wordpress-gallery-plugin',
						'title'			=>	'WordPress Gallery plugin',
						'description'	=>	'Gallery plugin is an useful tool that will help you to create Galleries and Albums. Try our nice Gallery views and awesome animations.'
						),
			'coming_soon'=>array(
						'image_url'		=>	$this->plugin_url.'images/featured_plugins/coming_soon.jpg',
						'site_url'		=>	'http://wpdevart.com/wordpress-coming-soon-plugin/',
						'title'			=>	'Coming soon and Maintenance mode',
						'description'	=>	'Coming soon and Maintenance mode plugin is an awesome tool to show your visitors that you are working on your website to make it better.'
						),
			'Contact forms'=>array(
						'image_url'		=>	$this->plugin_url.'images/featured_plugins/contact_forms.png',
						'site_url'		=>	'http://wpdevart.com/wordpress-contact-form-plugin/',
						'title'			=>	'Contact Form Builder',
						'description'	=>	'Contact Form Builder plugin is an handy tool for creating different types of contact forms on your WordPress websites.'
						),	
			'Booking Calendar'=>array(
						'image_url'		=>	$this->plugin_url.'images/featured_plugins/Booking_calendar_featured.png',
						'site_url'		=>	'http://wpdevart.com/wordpress-booking-calendar-plugin/',
						'title'			=>	'WordPress Booking Calendar',
						'description'	=>	'WordPress Booking Calendar plugin is an awesome tool to create a booking system for your website. Create booking calendars in a few minutes.'
						),	
			'youtube'=>array(
						'image_url'		=>	$this->plugin_url.'images/featured_plugins/youtube.png',
						'site_url'		=>	'http://wpdevart.com/wordpress-youtube-embed-plugin',
						'title'			=>	'WordPress YouTube Embed',
						'description'	=>	'YouTube Embed plugin is an convenient tool for adding videos to your website. Use YouTube Embed plugin for adding YouTube videos in posts/pages, widgets.'
						),
            'facebook-comments'=>array(
						'image_url'		=>	$this->plugin_url.'images/featured_plugins/facebook-comments-icon.png',
						'site_url'		=>	'http://wpdevart.com/wordpress-facebook-comments-plugin/',
						'title'			=>	'WordPress Facebook comments',
						'description'	=>	'WordPress Facebook comments plugin will help you to display Facebook Comments on your website. You can use Facebook Comments on your pages/posts.'
						),						
			'lightbox'=>array(
						'image_url'		=>	$this->plugin_url.'images/featured_plugins/lightbox.png',
						'site_url'		=>	'http://wpdevart.com/wordpress-lightbox-plugin',
						'title'			=>	'WordPress Lightbox plugin',
						'description'	=>	'WordPress Lightbox Popup is an high customizable and responsive plugin for displaying images and videos in popup.'
						),
			'facebook'=>array(
						'image_url'		=>	$this->plugin_url.'images/featured_plugins/facebook.jpg',
						'site_url'		=>	'http://wpdevart.com/wordpress-facebook-like-box-plugin',
						'title'			=>	'Facebook Like Box',
						'description'	=>	'Facebook like box plugin will help you to display Facebook like box on your wesite, just add Facebook Like box widget to sidebar or insert it into posts/pages and use it.'
						),
			'poll'=>array(
						'image_url'		=>	$this->plugin_url.'images/featured_plugins/poll.png',
						'site_url'		=>	'http://wpdevart.com/wordpress-polls-plugin',
						'title'			=>	'WordPress Polls system',
						'description'	=>	'WordPress Polls system is an handy tool for creating polls and survey forms for your visitors. You can use our polls on widgets, posts and pages.'
						),
			'scroll'=>array(
						'image_url'		=>	$this->plugin_url.'images/featured_plugins/Scroll.png',
						'site_url'		=>	'https://wordpress.org/plugins/wp-scroll-2',
						'title'			=>	'Scroll To Top',
						'description'	=>	'Scroll to top plugin is an simple and nice plugin with the standard scroll settings. You can use it on your website different sides.'
						),						
			
		);
		?>
        <style>
         .featured_plugin_main{
			 background-color: #ffffff;
			 border: 1px solid #dedede;
			 box-sizing: border-box;
			 float:left;
			 margin-right:20px;
			 margin-bottom:20px;
			 
			 width:450px;
		 }
		.featured_plugin_image{
			padding: 15px;
			display: inline-block;
			float:left;
		}
		.featured_plugin_image a{
		  display: inline-block;
		}
		.featured_plugin_information{			
			float: left;
			width: auto;
			max-width: 282px;

		}
		.featured_plugin_title{
			color: #0073aa;
			font-size: 18px;
			display: inline-block;
		}
		.featured_plugin_title a{
			text-decoration:none;
					
		}
		.featured_plugin_title h4{
			margin:0px;
			margin-top: 20px;
			margin-bottom:8px;			  
		}
		.featured_plugin_description{
			display: inline-block;
		}
        
        </style>
        <script>
		
        jQuery(window).resize(wpdevart_countdown_feature_resize);
		jQuery(document).ready(function(e) {
            wpdevart_countdown_feature_resize();
        });
		
		function wpdevart_countdown_feature_resize(){
			var wpdevart_countdown_width=jQuery('.featured_plugin_main').eq(0).parent().width();
			var count_of_elements=Math.max(parseInt(wpdevart_countdown_width/450),1);
			var width_of_plugin=((wpdevart_countdown_width-count_of_elements*24-2)/count_of_elements);
			jQuery('.featured_plugin_main').width(width_of_plugin);
			jQuery('.featured_plugin_information').css('max-width',(width_of_plugin-160)+'px');
		}
       	</script>
        	<h2>Featured Plugins</h2>
            <br>
            <br>
            <?php foreach($plugins_array as $key=>$plugin) { ?>
            <div class="featured_plugin_main">
            	<span class="featured_plugin_image"><a target="_blank" href="<?php echo $plugin['site_url'] ?>"><img src="<?php echo $plugin['image_url'] ?>"></a></span>
                <span class="featured_plugin_information">
                	<span class="featured_plugin_title"><h4><a target="_blank" href="<?php echo $plugin['site_url'] ?>"><?php echo $plugin['title'] ?></a></h4></span>
                    <span class="featured_plugin_description"><?php echo $plugin['description'] ?></span>
                </span>
                <div style="clear:both"></div>                
            </div>
            <?php } 
	}
	
}