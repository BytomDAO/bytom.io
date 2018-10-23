<?php

    /*############################### LIBRARY CODE ###############################################*/

class wpdevart_countdown_setting{
	public static $list_of_animations=array('bounce','flash','pulse','rubberBand','shake','swing','tada','wobble','bounceIn','bounceInDown','bounceInLeft','bounceInRight','bounceInUp','fadeIn','fadeInDown','fadeInDownBig','fadeInLeft','fadeInLeftBig','fadeInRight','fadeInRightBig','fadeInUp','fadeInUpBig','flip','flipInX','flipInY','lightSpeedIn','rotateIn','rotateInDownLeft','rotateInDownRight','rotateInUpLeft','rotateInUpRight','rollIn','zoomIn','zoomInDown','zoomInLeft','zoomInRight','zoomInUp');
	public static function get_animations_type_array($animation=''){
		if($animation=='' || $animation=='none')
			return '';
		if($animation=='random'){	
		
			return self::$list_of_animations[array_rand(self::$list_of_animations,1)];
		}
		return $animation;
	}
	
    /*############################### ANIMATION FUNCTIONS #######################################*/	

	public static function generete_animation_select($select_id='',$curent_effect='none'){
	?>
    <select onClick="alert(countdown_pro_text)"  id="<?php echo $select_id; ?>" name="<?php echo $select_id; ?>">
   		  <option <?php selected('none',$curent_effect); ?> value="none">none</option>
          <option <?php selected('random',$curent_effect); ?> value="random">random</option>
        <optgroup label="Attention Seekers">
          <option <?php selected('bounce',$curent_effect); ?> value="bounce">bounce</option>
          <option <?php selected('flash',$curent_effect); ?> value="flash">flash</option>
          <option <?php selected('pulse',$curent_effect); ?> value="pulse">pulse</option>
          <option <?php selected('rubberBand',$curent_effect); ?> value="rubberBand">rubberBand</option>
          <option <?php selected('shake',$curent_effect); ?> value="shake">shake</option>
          <option <?php selected('swing',$curent_effect); ?> value="swing">swing</option>
          <option <?php selected('tada',$curent_effect); ?> value="tada">tada</option>
          <option <?php selected('wobble',$curent_effect); ?> value="wobble">wobble</option>
        </optgroup>

        <optgroup label="Bouncing Entrances">
          <option <?php selected('bounceIn',$curent_effect); ?> value="bounceIn">bounceIn</option>
          <option <?php selected('bounceInDown',$curent_effect); ?> value="bounceInDown">bounceInDown</option>
          <option <?php selected('bounceInLeft',$curent_effect); ?> value="bounceInLeft">bounceInLeft</option>
          <option <?php selected('bounceInRight',$curent_effect); ?> value="bounceInRight">bounceInRight</option>
          <option <?php selected('bounceInUp',$curent_effect); ?> value="bounceInUp">bounceInUp</option>
        </optgroup>

        <optgroup label="Fading Entrances">
          <option <?php selected('fadeIn',$curent_effect); ?> value="fadeIn">fadeIn</option>
          <option <?php selected('fadeInDown',$curent_effect); ?> value="fadeInDown">fadeInDown</option>
          <option <?php selected('fadeInDownBig',$curent_effect); ?> value="fadeInDownBig">fadeInDownBig</option>
          <option <?php selected('fadeInLeft',$curent_effect); ?> value="fadeInLeft">fadeInLeft</option>
          <option <?php selected('fadeInLeftBig',$curent_effect); ?> value="fadeInLeftBig">fadeInLeftBig</option>
          <option <?php selected('fadeInRight',$curent_effect); ?> value="fadeInRight">fadeInRight</option>
          <option <?php selected('fadeInRightBig',$curent_effect); ?> value="fadeInRightBig">fadeInRightBig</option>
          <option <?php selected('fadeInUp',$curent_effect); ?> value="fadeInUp">fadeInUp</option>
          <option <?php selected('fadeInUpBig',$curent_effect); ?> value="fadeInUpBig">fadeInUpBig</option>
        </optgroup>

        <optgroup label="Flippers">
          <option <?php selected('flip',$curent_effect); ?> value="flip">flip</option>
          <option <?php selected('flipInX',$curent_effect); ?> value="flipInX">flipInX</option>
          <option <?php selected('flipInY',$curent_effect); ?> value="flipInY">flipInY</option>
        </optgroup>

        <optgroup label="Lightspeed">
          <option <?php selected('lightSpeedIn',$curent_effect); ?> value="lightSpeedIn">lightSpeedIn</option>
        </optgroup>

        <optgroup label="Rotating Entrances">
          <option <?php selected('rotateIn',$curent_effect); ?> value="rotateIn">rotateIn</option>
          <option <?php selected('rotateInDownLeft',$curent_effect); ?> value="rotateInDownLeft">rotateInDownLeft</option>
          <option <?php selected('rotateInDownRight',$curent_effect); ?> value="rotateInDownRight">rotateInDownRight</option>
          <option <?php selected('rotateInUpLeft',$curent_effect); ?> value="rotateInUpLeft">rotateInUpLeft</option>
          <option <?php selected('rotateInUpRight',$curent_effect); ?> value="rotateInUpRight">rotateInUpRight</option>
        </optgroup>

        <optgroup label="Specials">
          
          <option <?php selected('rollIn',$curent_effect); ?> value="rollIn">rollIn</option>        
        </optgroup>

        <optgroup label="Zoom Entrances">
          <option <?php selected('zoomIn',$curent_effect); ?> value="zoomIn">zoomIn</option>
          <option <?php selected('zoomInDown',$curent_effect); ?> value="zoomInDown">zoomInDown</option>
          <option <?php selected('zoomInLeft',$curent_effect); ?> value="zoomInLeft">zoomInLeft</option>
          <option <?php selected('zoomInRight',$curent_effect); ?> value="zoomInRight">zoomInRight</option>
          <option <?php selected('zoomInUp',$curent_effect); ?> value="zoomInUp">zoomInUp</option>
        </optgroup>
      </select>
    <?php 
	}
	
    /*###################### Fonts generating Function ##################*/
	
	public static function generete_fonts($select_id='',$curent_font='none'){
	?>
   <select onClick="alert(countdown_pro_text)" id="<?php echo $select_id; ?>" name="<?php echo $select_id; ?>">
   
        <option <?php selected('Arial,Helvetica Neue,Helvetica,sans-serif',$curent_font); ?> value="Arial,Helvetica Neue,Helvetica,sans-serif">Arial *</option>
        <option <?php selected('Arial Black,Arial Bold,Arial,sans-serif',$curent_font); ?> value="Arial Black,Arial Bold,Arial,sans-serif">Arial Black *</option>
        <option <?php selected('Arial Narrow,Arial,Helvetica Neue,Helvetica,sans-serif',$curent_font); ?> value="Arial Narrow,Arial,Helvetica Neue,Helvetica,sans-serif">Arial Narrow *</option>
        <option <?php selected('Courier,Verdana,sans-serif',$curent_font); ?> value="Courier,Verdana,sans-serif">Courier *</option>
        <option <?php selected('Georgia,Times New Roman,Times,serif',$curent_font); ?> value="Georgia,Times New Roman,Times,serif">Georgia *</option>
        <option <?php selected('Times New Roman,Times,Georgia,serif',$curent_font); ?> value="Times New Roman,Times,Georgia,serif">Times New Roman *</option>
        <option <?php selected('Trebuchet MS,Lucida Grande,Lucida Sans Unicode,Lucida Sans,Arial,sans-serif',$curent_font); ?> value="Trebuchet MS,Lucida Grande,Lucida Sans Unicode,Lucida Sans,Arial,sans-serif">Trebuchet MS *</option>
        <option <?php selected('Verdana,sans-serif',$curent_font); ?> value="Verdana,sans-serif">Verdana *</option>
        <option <?php selected('American Typewriter,Georgia,serif',$curent_font); ?> value="American Typewriter,Georgia,serif">American Typewriter</option>
        <option <?php selected('Andale Mono,Consolas,Monaco,Courier,Courier New,Verdana,sans-serif',$curent_font); ?> value="Andale Mono,Consolas,Monaco,Courier,Courier New,Verdana,sans-serif">Andale Mono</option>
        <option <?php selected('Baskerville,Times New Roman,Times,serif',$curent_font); ?> value="Baskerville,Times New Roman,Times,serif">Baskerville</option>
        <option <?php selected('Bookman Old Style,Georgia,Times New Roman,Times,serif',$curent_font); ?> value="Bookman Old Style,Georgia,Times New Roman,Times,serif">Bookman Old Style</option>
        <option <?php selected('Calibri,Helvetica Neue,Helvetica,Arial,Verdana,sans-serif',$curent_font); ?> value="Calibri,Helvetica Neue,Helvetica,Arial,Verdana,sans-serif">Calibri</option>
        <option <?php selected('Cambria,Georgia,Times New Roman,Times,serif',$curent_font); ?> value="Cambria,Georgia,Times New Roman,Times,serif">Cambria</option>
        <option <?php selected('Candara,Verdana,sans-serif',$curent_font); ?> value="Candara,Verdana,sans-serif">Candara</option>
        <option <?php selected('Century Gothic,Apple Gothic,Verdana,sans-serif',$curent_font); ?> value="Century Gothic,Apple Gothic,Verdana,sans-serif">Century Gothic</option>
        <option <?php selected('Century Schoolbook,Georgia,Times New Roman,Times,serif',$curent_font); ?> value="Century Schoolbook,Georgia,Times New Roman,Times,serif">Century Schoolbook</option>
        <option <?php selected('Consolas,Andale Mono,Monaco,Courier,Courier New,Verdana,sans-serif',$curent_font); ?> value="Consolas,Andale Mono,Monaco,Courier,Courier New,Verdana,sans-serif">Consolas</option>
        <option <?php selected('Constantia,Georgia,Times New Roman,Times,serif',$curent_font); ?> value="Constantia,Georgia,Times New Roman,Times,serif">Constantia</option>
        <option <?php selected('Corbel,Lucida Grande,Lucida Sans Unicode,Arial,sans-serif',$curent_font); ?> value="Corbel,Lucida Grande,Lucida Sans Unicode,Arial,sans-serif">Corbel</option>
        <option <?php selected('Franklin Gothic Medium,Arial,sans-serif',$curent_font); ?> value="Franklin Gothic Medium,Arial,sans-serif">Franklin Gothic Medium</option>
        <option <?php selected('Garamond,Hoefler Text,Times New Roman,Times,serif',$curent_font); ?> value="Garamond,Hoefler Text,Times New Roman,Times,serif">Garamond</option>
        <option <?php selected('Gill Sans MT,Gill Sans,Calibri,Trebuchet MS,sans-serif',$curent_font); ?> value="Gill Sans MT,Gill Sans,Calibri,Trebuchet MS,sans-serif">Gill Sans MT</option>
        <option <?php selected('Helvetica Neue,Helvetica,Arial,sans-serif',$curent_font); ?> value="Helvetica Neue,Helvetica,Arial,sans-serif">Helvetica Neue</option>
        <option <?php selected('Hoefler Text,Garamond,Times New Roman,Times,sans-serif',$curent_font); ?> value="Hoefler Text,Garamond,Times New Roman,Times,sans-serif">Hoefler Text</option>
        <option <?php selected('Lucida Bright,Cambria,Georgia,Times New Roman,Times,serif',$curent_font); ?> value="Lucida Bright,Cambria,Georgia,Times New Roman,Times,serif">Lucida Bright</option>
        <option <?php selected('Lucida Grande,Lucida Sans,Lucida Sans Unicode,sans-serif',$curent_font); ?> value="Lucida Grande,Lucida Sans,Lucida Sans Unicode,sans-serif">Lucida Grande</option>
        <option <?php selected('monospace',$curent_font); ?> value="monospace">monospace</option>
        <option <?php selected('Palatino Linotype,Palatino,Georgia,Times New Roman,Times,serif',$curent_font); ?> value="Palatino Linotype,Palatino,Georgia,Times New Roman,Times,serif">Palatino Linotype</option>
        <option <?php selected('Tahoma,Geneva,Verdana,sans-serif',$curent_font); ?> value="Tahoma,Geneva,Verdana,sans-serif">Tahoma</option>
        <option <?php selected('Rockwell, Arial Black, Arial Bold, Arial, sans-serif',$curent_font); ?> value="Rockwell, Arial Black, Arial Bold, Arial, sans-serif">Rockwell</option>
    </select>
    <?php

	}
	
    /*############################### COUNTDOWN THEME FUNCTION #######################################*/

	public static function darkest_brigths($color,$pracent){
		$new_color=$color;
		if(!(strlen($new_color==6) || strlen($new_color)==7))
		{
			return $color;
		}
		$color_vandakanishov=strpos($new_color,'#');
		if($color_vandakanishov == false) {
			$new_color= str_replace('#','',$new_color);
		}
		$color_part_1=substr($new_color, 0, 2);
		$color_part_2=substr($new_color, 2, 2);
		$color_part_3=substr($new_color, 4, 2);
		$color_part_1=dechex( (int) (hexdec( $color_part_1 ) - (hexdec( $color_part_1 )* $pracent / 100 )));
		$color_part_2=dechex( (int) (hexdec( $color_part_2)  - (( ( hexdec( $color_part_2 ) ) ) * $pracent / 100 )));
		$color_part_3=dechex( (int) (hexdec( $color_part_3 ) - (( ( hexdec( $color_part_3 ) ) ) * $pracent / 100 )));
		if(strlen($color_part_1)<2) $color_part_1="0".$color_part_1;
		if(strlen($color_part_2)<2) $color_part_2="0".$color_part_2;
		if(strlen($color_part_3)<2) $color_part_3="0".$color_part_3;
	
		$new_color=$color_part_1.$color_part_2.$color_part_3;
		if($color_vandakanishov == false){
			return $new_color;
		}
		else{
			return '#'.$new_color;
		}
	}
	
}


 ?>