<?php 

/*############################### WIDGET CODE ######################################*/

class wpdevart_countdown extends WP_Widget {
	private static $id_for_content=0;
	// Constructor //	
	function __construct() {		
		$widget_ops = array( 'classname' => 'wpdevart_countdown', 'description' => 'Countdown timer for widget ' ); // Widget code
		$control_ops = array( 'id_base' => 'wpdevart_countdown' ); // Widget Controls
		parent::__construct( 'wpdevart_countdown', 'Countdown', $widget_ops, $control_ops ); // Create the widget

	}

	/* Displaying countdown in the front end*/
	
	function widget($args, $instance) {
		self::$id_for_content++;
		extract( $args );
		$title = $instance['title'];    
		// Before widget code //
		echo $before_widget;
		
		// Widget title//
		if ( $title ) { echo $before_title . $title . $after_title; }
		// Widget output //
		echo $this->wpdevart_generete_front_end($instance);
		// After widget part//
		
		echo $after_widget;
	}
	
/*############################### Update settings Function #######################################*/	
	
    	function update($new_instance, $old_instance) {	
		extract( $args );
		$instance['title'] = strip_tags($new_instance['title']);    
		$instance['text_for_day'] 			= $new_instance['text_for_day'];
		$instance['text_for_hour'] 			= $new_instance['text_for_hour'];
		$instance['text_for_minut'] 		= $new_instance['text_for_minut'];
		$instance['text_for_second'] 		= $new_instance['text_for_second'];
		$instance['end_time_type'] 			= $new_instance['end_time_type'];
		$instance['end_time_date'] 			= $new_instance['end_time_date'];
		$instance['end_time'] 				= $new_instance['end_time'];
		$instance['start_time'] 			= $new_instance['start_time'];
		$instance['content'] 				= $new_instance['content'];		
		$instance['action_end_time'] 		= $new_instance['action_end_time'];
		$instance['content_position'] 		= $new_instance['content_position'];
		$instance['top_ditance'] 			= $new_instance['top_ditance'];
		$instance['bottom_distance'] 		= $new_instance['bottom_distance'];
		return $instance;  /// Function that returns parameters new value
		
	}

	/* Function of the Admin page standard options */
	function form($instance) {
		
		$defaults = array( 
			'title' 				=> '',
			'text_for_day' 			=> 'Days',
			'text_for_hour' 		=> 'Hours',
			'text_for_minut' 		=> 'Minutes',
			'text_for_second' 		=> 'Seconds',
			'start_time' 			=> mktime (date("H"), date("i"), date("s"),date("n"), date("j"),date("Y")),
			'end_time_type' 		=> 'time',
			'end_time' 				=> '0,8,8',
			'end_time_date' 		=> date('d-m-Y 23:59'),
			'action_end_time' 		=> 'hide',
			'content' 		=> '',
			'content_position' 		=> 'center',
			'top_ditance' 			=> '9',
			'bottom_distance' 		=> '9',
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		?>
        

        <p class="flb_field">
          <label for="title">Title:</label>
          <br>
          <input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" class="widefat">
        </p>
        
        <p class="flb_field">
          <label for="<?php echo $this->get_field_id('text_for_day'); ?>">Day field text:</label>
          <br>
          <input id="<?php echo $this->get_field_id('text_for_day'); ?>" name="<?php echo $this->get_field_name('text_for_day'); ?>" type="text" value="<?php echo $instance['text_for_day']; ?>" class="widefat">
        </p>
          
        <p class="flb_field">
          <label for="<?php echo $this->get_field_id('text_for_hour'); ?>">Hour field text:</label>
          <br>
          <input id="<?php echo $this->get_field_id('text_for_hour'); ?>" name="<?php echo $this->get_field_name('text_for_hour'); ?>" type="text" value="<?php echo $instance['text_for_hour']; ?>" class="widefat">
        </p>
          
        <p class="flb_field">
          <label for="<?php echo $this->get_field_id('text_for_minut'); ?>">Minute field text:</label>
          <br>
          <input id="<?php echo $this->get_field_id('text_for_minut'); ?>" name="<?php echo $this->get_field_name('text_for_minut'); ?>" type="text" value="<?php echo $instance['text_for_minut']; ?>" class="widefat">
        </p>
          
        <p class="flb_field">
          <label for="<?php echo $this->get_field_id('text_for_second'); ?>">Second field text:</label>
          <br>
          <input id="<?php echo $this->get_field_id('text_for_second'); ?>" name="<?php echo $this->get_field_name('text_for_second'); ?>" type="text" value="<?php echo $instance['text_for_second']; ?>" class="widefat">
        </p>
        
       
        <?php $time_end=explode(',',$instance['end_time']);
		
		if(isset($time_end[0]) && isset($time_end[1]) && isset($time_end[2]) ){
			$time_diferent_seconds=$time_end[0]*24*3600+$time_end[1]*3600+$time_end[2]*60;
			$ancac_jamanaky=mktime (date("H"), date("i"), date("s"),date("n"), date("j"),date("Y"))-$instance['start_time'];
			$time_diferent_seconds=$time_diferent_seconds-$ancac_jamanaky;
			if($time_diferent_seconds<0)
				$time_diferent_seconds=0;
		}
		else{		
			$time_diferent_seconds=0;
		}
		
		$day_of_end		=(int)($time_diferent_seconds/(24*3600));
		$day_of_end		=($day_of_end>=0)?$day_of_end:0;
		$hour_of_end	=(int)(($time_diferent_seconds-$day_of_end*24*3600)/3600);
		$hour_of_end	=($hour_of_end>=0)?$hour_of_end:0;
		$minute_of_end	=(int)(($time_diferent_seconds-$day_of_end*24*3600-$hour_of_end*3600)/60);
		$minute_of_end	=($minute_of_end>=0)?$minute_of_end:0;
		
		
		?>  
        <script> var countdown_pro_text="If you want to use this feature upgrade to Countdown Pro"</script>
        <style>.pro_feature {
			  font-size: 13px;
			  font-weight: bold;
			  color: rgba(10, 154, 62, 1);
			}</style>
        <p class="experet_type">
          <label for="<?php echo $this->get_field_id('end_time_type'); ?>">Countdown date picker type :</label>
          <br>
          <select class="show_hide_experet_type" id="<?php echo $this->get_field_id('end_time_type'); ?>" name="<?php echo $this->get_field_name('end_time_type'); ?>">
                <option <?php selected('time',$instance['end_time_type']) ?> value="time">Time</option>
                <option <?php selected('date',$instance['end_time_type']) ?> value="date">Date</option>
          </select>
        </p>
        <p class="experet_type_date">
        <label>Countdown expiry date :</label>
        <br>
        <input type="text" id="<?php echo $this->get_field_id('end_time_date'); ?>" name="<?php echo $this->get_field_name('end_time_date'); ?>" value="<?php echo $instance['end_time_date'] ?>" class="wpdevart-date-time-picker" /><small>dd-mm-yyyy hh:ii</small>
        </p>
        <p class="flb_field experet_type_time"> 
        <label>Countdown expire time :</label>
          <br>     
            <span style="display:inline-block; margin-right:3px; width:55px;">
                <input onChange="insert_in_input();" type="text" placeholder="Day"   class="countdownday" size="3" value="<?php echo $day_of_end ?>"/><small style="display:block">Day</small>                
            </span>
            
            <span style="display:inline-block; width:55px;">
                <input onChange="insert_in_input();" type="text"  placeholder="Hour" class="countdownhour" size="3" value="<?php echo $hour_of_end ?>"/><small>Hour</small>                
            </span>
            
            <span style="display:inline-block; width:55px;"> 
                <input onChange="insert_in_input();" type="text"  placeholder="Minute"  class="countdownminute" size="3" value="<?php echo $minute_of_end ?>"/><small>Minute</small>                
            </span>
            <script>function insert_in_input(){
				document.getElementById('<?php echo $this->get_field_id('end_time'); ?>').value=document.getElementById('<?php echo $this->get_field_id('end_time'); ?>').parentNode.getElementsByClassName('countdownday')[0].value+','+document.getElementById('<?php echo $this->get_field_id('end_time'); ?>').parentNode.getElementsByClassName('countdownhour')[0].value+','+document.getElementById('<?php echo $this->get_field_id('end_time'); ?>').parentNode.getElementsByClassName('countdownminute')[0].value
			}</script>
            <input type="hidden" value='<?php echo $day_of_end.','.$hour_of_end.','.$minute_of_end; ?>' id="<?php echo $this->get_field_id('end_time'); ?>" name="<?php echo $this->get_field_name('end_time'); ?>"/>
            <input type="hidden" value='<?php echo mktime (date("H"), date("i"), date("s"),date("n"), date("j"),date("Y")); ?>' id="<?php echo $this->get_field_id('start_time'); ?>" name="<?php echo $this->get_field_name('start_time'); ?>" />
        </p>
        
        <p class="flb_field">
            <label>After Countdown expire: </label>
            <br>
            <select id="<?php echo $this->get_field_id('action_end_time'); ?>" name="<?php echo $this->get_field_name('action_end_time'); ?>">
                <option <?php selected('show_text',$instance['action_end_time']) ?> value="show_text">Show text</option>
                <option <?php selected('hide',$instance['action_end_time']) ?> value="hide">Hide Timer</option>
            </select>
        </p>
        
        <p class="flb_field">
          <label for="<?php echo $this->get_field_id('content'); ?>">Text after countdown expire:</label>
          <br>
          <textarea type="text" id="<?php echo $this->get_field_id('content'); ?>" name="<?php echo $this->get_field_name('content'); ?>"><?php echo $instance['content']; ?></textarea>   
        </p>
        
         <p class="flb_field">
            <label>Countdown position: </label>
            <br>
            <select id="<?php echo $this->get_field_id('content_position'); ?>" name="<?php echo $this->get_field_name('content_position'); ?>">
                <option <?php selected('left',$instance['content_position']) ?> value="left">Left</option>
                <option <?php selected('center',$instance['content_position']) ?> value="center">Center</option>
                <option <?php selected('right',$instance['content_position']) ?> value="right">Right</option>                
            </select>
        </p>
        
         <p class="flb_field">
            <label for="<?php echo $this->get_field_id('top_ditance'); ?>">Countdown distance from top:</label>
            <br>
            <input id="<?php echo $this->get_field_id('top_ditance'); ?>" name="<?php echo $this->get_field_name('top_ditance'); ?>" type="text" value="<?php echo $instance['top_ditance']; ?>" class="widefat">
        </p>
        
        <p class="flb_field">
            <label for="<?php echo $this->get_field_id('bottom_distance'); ?>">Countdown distance from bottom:</label>
            <br>
            <input id="<?php echo $this->get_field_id('bottom_distance'); ?>" name="<?php echo $this->get_field_name('bottom_distance'); ?>" type="text" value="<?php echo $instance['bottom_distance']; ?>" class="widefat">
        </p>
        
        <p class="flb_field">
            <label>Countdown Buttons type:<span class="pro_feature"> (pro)</span> </label>
            <br>
            <select onChange="alert(countdown_pro_text)">
                <option selected="selected" value="button">Button</option>
                <option value="circle">Circle</option>
                <option value="vertical_slide">Vertical Slider</option>                
            </select>
        </p>
        
        <p class="flb_field tr_button tr_circle tr_vertical_slide">
            <label>Countdown text color:<span class="pro_feature"> (pro)</span></label>
            <br>
            <div onClick="alert(countdown_pro_text)">
              <div class="wp-picker-container disabled_picker">
				<button type="button" class="button wp-color-result" aria-expanded="false" style="background-color: rgb(0, 0, 0);"><span class="wp-color-result-text">Select Color</span></button>
			  </div>
            </div>
        </p>
        
        <p class="flb_field tr_button tr_circle tr_vertical_slide">
            <label> Countdown background color:<span class="pro_feature"> (pro)</span></label>
            <br>
            <div onClick="alert(countdown_pro_text)">
               <div class="wp-picker-container disabled_picker">
				<button type="button" class="button wp-color-result" aria-expanded="false" style="background-color: rgb(62, 89, 165);"><span class="wp-color-result-text">Select Color</span></button>
			   </div>
            </div>
        </p>
        
         <p class="flb_field tr_circle">
          <label >Countdown timer size:<span class="pro_feature"> (pro)</span></label>
          <br>
          <input onClick="alert(countdown_pro_text)" type="text" value="50" class="widefat">(Px)
        </p>
        
         <p class="flb_field tr_circle">
          <label>Countdown border width:<span class="pro_feature"> (pro)</span></label>
          <br>
          <input onClick="alert(countdown_pro_text)"  type="text" value="5" class="widefat">%(0-100)
        </p>
        
         <p class="flb_field tr_button">
          <label>Countdown border radius:<span class="pro_feature"> (pro)</span></label>
          <br>
          <input onClick="alert(countdown_pro_text)"  type="text" value="8" class="widefat">
        </p>
        
         <p class="flb_field tr_button tr_vertical_slide">
          <label>Countdown font-size:<span class="pro_feature"> (pro)</span></label>
          <br>
          <input onClick="alert(countdown_pro_text)"  type="text" value="20" class="widefat">(Px)
        </p>
       
        <p class="flb_field tr_button tr_circle tr_vertical_slide">
          <label>Countdown Font family:<span class="pro_feature"> (pro)</span></label>
          <br>
          <?php wpdevart_countdown_setting::generete_fonts('font_famely','monospace') ?>
        </p>
         <p class="flb_field">
          <label for="animation">Countdown animation type:<span class="pro_feature"> (pro)</span></label>
          <br>
          <?php wpdevart_countdown_setting::generete_animation_select('animation','monospace') ?>
        </p>
        <br>
        <input type="hidden" id="flb-submit" name="flb-submit" value="1">
        <script>
        jQuery('.wpdevart-date-time-picker').ready(function(){
				var nowTemp = new Date();
				var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
				jQuery('.wpdevart-date-time-picker').fdatepicker({
				  format: 'dd-mm-yyyy hh:ii',
				  pickTime: true,
				  onRender: function (date) {
					return date.valueOf() < now.valueOf() ? 'disabled' : '';
				}
				});
			});
			jQuery('.show_hide_experet_type').ready(function(){
				jQuery('.show_hide_experet_type').each(function(index, element) {
					if(jQuery(this).val()=='time'){
						jQuery(this).parent().parent().find(jQuery('.experet_type_date')).hide();
						jQuery(this).parent().parent().find(jQuery('.experet_type_time')).show();
					}
					if(jQuery(this).val()=='date'){
						jQuery(this).parent().parent().find(jQuery('.experet_type_date')).show();
						jQuery(this).parent().parent().find(jQuery('.experet_type_time')).hide();
					}
				});
				jQuery('.show_hide_experet_type').change(function(){
					if(jQuery(this).val()=='time'){
						jQuery(this).parent().parent().find(jQuery('.experet_type_date')).hide();
						jQuery(this).parent().parent().find(jQuery('.experet_type_time')).show();
					}
					if(jQuery(this).val()=='date'){
						jQuery(this).parent().parent().find(jQuery('.experet_type_date')).show();
						jQuery(this).parent().parent().find(jQuery('.experet_type_time')).hide();
					}
				})				
			})
			</script>
        <a href="http://wpdevart.com/wordpress-countdown-plugin/" target="_blank" style="color: rgba(10, 154, 62, 1);; font-weight: bold; font-size: 18px; text-decoration: none;">Upgrade to Pro Version</a>
		<?php 
	}
	
	/*############################### Function for generating front-end ########################################*/
	
	private function wpdevart_generete_front_end($parametrs){
		self::$id_for_content++;
		$output_html='';			
			 
		if(isset($parametrs['end_time_type']) && $parametrs['end_time_type']=='date'){
			$end_date=explode(' ',$parametrs['end_time_date']);
			$end_date_only_date=explode('-',$end_date[0]);
			$end_date_hour=explode(':',$end_date[1]);
			$curent_time=mktime ($end_date_hour['0'], $end_date_hour[1],0,$end_date_only_date[1], $end_date_only_date[0],$end_date_only_date[2]);
			$time_diferent=$curent_time-mktime (date("H"), date("i"), date("s"),date("n"), date("j"),date("Y"));
		}else{
			$time_experit=explode(',',$parametrs['end_time']);
			$time_diferent=(int)$time_experit[0]*24*3600+(int)+$time_experit[1]*3600+(int)$time_experit[2]*60+$parametrs['start_time']-mktime (date("H"), date("i"), date("s"),date("n"), date("j"),date("Y"));
		}		
		$day_left=(int)($time_diferent/(3600*24));
		$hourse_left=(int)(($time_diferent-$day_left*24*3600)/(3600));
		$minuts_left=(int)(($time_diferent-$day_left*24*3600-$hourse_left*3600)/(60));
		$seconds_left=(int)(($time_diferent-$day_left*24*3600-$hourse_left*3600 - $minuts_left*60));	
		if(strlen("".$day_left)>0 && strlen("".$day_left)<2)
			$day_left='0'.$day_left;
		if(strlen("".$hourse_left)>0 && strlen("".$hourse_left)<2)
			$hourse_left='0'.$hourse_left;
		if(strlen("".$minuts_left)>0 && strlen("".$minuts_left)<2)
			$minuts_left='0'.$minuts_left;
		if(strlen("".$seconds_left)>0 && strlen("".$seconds_left)<2)
			$seconds_left='0'.$seconds_left;		 
		
		$output_html.='<div class="content_countdown" id="main_countedown_widget_'.self::$id_for_content.'">';
		$output_html.='<div class="countdown">
			<span class="element_conteiner"><span  class="days time_left">'.$day_left.'</span><span class="time_description">'.$parametrs['text_for_day'].'</span></span>
			<span class="element_conteiner"><span  class="hourse time_left">'.$hourse_left.'</span><span class="time_description">'.$parametrs['text_for_hour'].'</span></span>
			<span class="element_conteiner"><span  class="minutes time_left">'.$minuts_left.'</span><span class="time_description">'.$parametrs['text_for_minut'].'</span></span>
			<span class="element_conteiner"><span  class="secondes time_left">'.$seconds_left.'</span><span class="time_description">'.$parametrs['text_for_second'].'</span></span>
		</div>';
		$output_html.='</div>';
		
		/************************** JS Output Code ************************************/
		$output_js='';

		if($parametrs['action_end_time']=='hide'){
		$parametrs['content']='';
		}
		$output_js.="
        jQuery(document).ready(function(){
			".((($day_left<=0 && $hourse_left<=0 && $minuts_left<=0 && $seconds_left<=0))?"jQuery('#main_countedown_widget_".self::$id_for_content." .countdown').html('".htmlspecialchars($parametrs['content'])."')":"setInterval(function(){countdown_wpdevart_timer('main_countedown_widget_".self::$id_for_content."');},1000)")."
		});
		";
	
		/************************** CSS Output Code ***********************************/
		
		$output_css='';
		$output_css.='#main_countedown_widget_'.self::$id_for_content.' .countdown{text-align:'.$parametrs['content_position'].';}';
		$output_css.= '#main_countedown_widget_'.self::$id_for_content.' .countdown{margin-top:'.$parametrs['top_ditance'].'px;margin-bottom:'.$parametrs['bottom_distance'].'px}';
		$output_css.= "#main_countedown_widget_".self::$id_for_content." .time_left{\r\n";
		$output_css.= "border-radius:8px;\r\n";
		$output_css.= "background-color:#3DA8CC;\r\n";
		$output_css.= "font-size:20px;\r\n";
		$output_css.= "font-family:monospace;\r\n";
		$output_css.= "color:#000000;\r\n";
		$output_css.= "}\r\n";
		$output_css.= "#main_countedown_widget_".self::$id_for_content." .time_description{\r\n";
		$output_css.= "font-size:20px;\r\n";
		$output_css.= "font-family:monospace;\r\n";
		$output_css.= "color:#000000;\r\n";
		$output_css.= "}\r\n";
		$output_css.= "#main_countedown_widget_".self::$id_for_content." .element_conteiner{min-width:73px}";
		$output_html.='<script>'.$output_js.'</script><style>'.$output_css.'</style>';
		return $output_html;
	}
}
add_action('widgets_init', create_function('', 'return register_widget("wpdevart_countdown");'));

global $pagenow;
 if( $pagenow == 'widgets.php') {
	echo '
	<style>
	.pro_feature{
	font-style:italic;
	}
	</style>';
 }