<?php 

    /*############################### Frontend Code #######################################*/

class wpdevart_countdown_front_end{
	private $menu_name;
	
	private $plugin_url;
	
	private $databese_parametrs;
	
	private $params;
	
	public static $id_for_content=0;

	/*###################### Constract parameters function ##################*/		
	
	function __construct($params){
		
		$this->databese_parametrs=$params['databese_parametrs'];
		//If plugin url doesn't come in parent class
		if(isset($params['plugin_url']))
			$this->plugin_url=$params['plugin_url'];
		else
			$this->plugin_url=trailingslashit(dirname(plugins_url('',__FILE__)));

		//Hooks for popup iframe
		add_action('wp_head',array($this,'generete_front_javascript'));
		//Add shortcode part
		add_shortcode( 'wpdevart_countdown', array($this,'wpdevart_wpdevart_countdown_shortcode') );
		//For updated parameters
		
	}
	
	/*###################### Generete Front Javascript Function ##################*/
	
	public function generete_front_javascript(){
		
		wp_enqueue_script('countdown-front-end');
		wp_enqueue_script('thickbox');
		wp_enqueue_style('countdown_css');		
		wp_enqueue_style('thickbox');
		
	}
	
	/*###################### Shortcode Function ##################*/	
	
	public function wpdevart_wpdevart_countdown_shortcode( $atts,$content){
		self::$id_for_content++;
		$output_html='';
		$curent_value= shortcode_atts( array(
			"text_for_day" 			=> "Days",
			"text_for_hour"			=> "Hours",
			"text_for_minut"		=> "Minutes",
			"text_for_second"		=> "Seconds",
			"start_time"			=> mktime (date("H"), date("i"), date("s"),date("n"), date("j"),date("Y")),
			"countdown_end_type"	=> "time",
			"end_date"				=> date('d-m-Y 23:59'),
			"end_time"				=> "0,8,8",
			"action_end_time"		=> "hide",
			"content_position"		=> "center",
			"top_ditance"			=> "9",
			"bottom_distance"		=> "9",
			"content"				=>$content
		), $atts);
			
			
			 
		if(isset($curent_value['countdown_end_type']) && $curent_value['countdown_end_type']=='date'){
			$end_date=explode(' ',$curent_value['end_date']);
			$end_date_only_date=explode('-',$end_date[0]);
			$end_date_hour=explode(':',$end_date[1]);
			$curent_time=mktime ($end_date_hour['0'], $end_date_hour[1],0,$end_date_only_date[1], $end_date_only_date[0],$end_date_only_date[2]);
			$time_diferent=$curent_time-mktime (date("H"), date("i"), date("s"),date("n"), date("j"),date("Y"));
		}else{
			$time_experit=explode(',',$curent_value['end_time']);
			$time_diferent=(int)$time_experit[0]*24*3600+(int)+$time_experit[1]*3600+(int)$time_experit[2]*60+$curent_value['start_time']-mktime (date("H"), date("i"), date("s"),date("n"), date("j"),date("Y"));
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
		
				$output_html.='<div class="content_countdown" id="main_countedown_'.self::$id_for_content.'">';

			
			$output_html.='<div class="countdown">
				<span class="element_conteiner"><span  class="days time_left">'.$day_left.'</span><span class="time_description">'.$curent_value['text_for_day'].'</span></span>
				<span class="element_conteiner"><span  class="hourse time_left">'.$hourse_left.'</span><span class="time_description">'.$curent_value['text_for_hour'].'</span></span>
				<span class="element_conteiner"><span  class="minutes time_left">'.$minuts_left.'</span><span class="time_description">'.$curent_value['text_for_minut'].'</span></span>
				<span class="element_conteiner"><span  class="secondes time_left">'.$seconds_left.'</span><span class="time_description">'.$curent_value['text_for_second'].'</span></span>
			</div>';
		$output_html.='</div>';
		$output_html.='<script>'.$this->wpdevart_countdown_javascript($curent_value).'</script><style>'.$this->wpdevart_countdown_css($curent_value).'</style>';
		return	$output_html;		
	}
	
    /*############  Countdown JS function  ################*/
	
	public function wpdevart_countdown_javascript($parametrs_for_countedown){
		$output_js='';
		
		if(isset($parametrs_for_countedown['countdown_end_type']) && $parametrs_for_countedown['countdown_end_type']=='date'){
			$end_date=explode(' ',$parametrs_for_countedown['end_date']);
			$end_date_only_date=explode('-',$end_date[0]);
			$end_date_hour=explode(':',$end_date[1]);
			$curent_time=mktime ($end_date_hour['0'], $end_date_hour[1],0,$end_date_only_date[1], $end_date_only_date[0],$end_date_only_date[2]);
			$time_diferent=$curent_time-mktime (date("H"), date("i"), date("s"),date("n"), date("j"),date("Y"));
		}else{
			$time_experit=explode(',',$parametrs_for_countedown['end_time']);
			$time_diferent=(int)$time_experit[0]*24*3600+(int)+$time_experit[1]*3600+(int)$time_experit[2]*60+$parametrs_for_countedown['start_time']-mktime (date("H"), date("i"), date("s"),date("n"), date("j"),date("Y"));
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
		
		if($parametrs_for_countedown['action_end_time']=='hide'){
			$parametrs_for_countedown['content']='';
		}
		$output_js.="
        jQuery(document).ready(function(){
			".((($day_left<=0 && $hourse_left<=0 && $minuts_left<=0 && $seconds_left<=0))?"jQuery('#main_countedown_".self::$id_for_content." .countdown').html('".htmlspecialchars($parametrs_for_countedown['content'])."')":"setInterval(function(){countdown_wpdevart_timer('main_countedown_".self::$id_for_content."');},1000)")."
		});
		";
		return $output_js;
	}
	
    /*############  Countdown CSS function  ################*/
	
	public function wpdevart_countdown_css($parametrs_for_countedown){
		$output_css='';
		$output_css.='#main_countedown_'.self::$id_for_content.' .countdown{text-align:'.$parametrs_for_countedown['content_position'].';}';
		$output_css.= '#main_countedown_'.self::$id_for_content.' .countdown{margin-top:'.$parametrs_for_countedown['top_ditance'].'px;margin-bottom:'.$parametrs_for_countedown['bottom_distance'].'px}';
		$output_css.= "#main_countedown_".self::$id_for_content." .time_left{\r\n";
		$output_css.= "border-radius:8px;\r\n";
		$output_css.= "background-color:#3DA8CC;\r\n";
		$output_css.= "font-size:23px;\r\n";
		$output_css.= "font-family:monospace;\r\n";
		$output_css.= "color:#000000;\r\n";
		$output_css.= "}\r\n";
		$output_css.= "#main_countedown_".self::$id_for_content." .time_description{\r\n";
		$output_css.= "font-size:23px;\r\n";
		$output_css.= "font-family:monospace;\r\n";
		$output_css.= "color:#000000;\r\n";
		$output_css.= "}\r\n";
		$output_css.= "#main_countedown_".self::$id_for_content." .element_conteiner{min-width:90px}";
			
		return $output_css;
	}
}
?>