<?php
$showSlider = freddo_options('_onepage_section_slider', '');
?>
<?php if ($showSlider == 1) : ?>
<?php
	$showScrollDown = freddo_options('_onepage_scrolldown_slider', '1');
	$sliderEffectScroll = freddo_options('_onepage_effect_slider', 'withZoom');
	$sliderSectionID = freddo_options('_onepage_id_slider', 'slider');
	$slideImage = array();
	$slideText = array();
	$slideSubText = array();
	for( $number = 1; $number < FREDDO_VALUE_FOR_SLIDER; $number++ ){
		$slideImage["$number"] = freddo_options('_onepage_image_'.$number.'_slider', '');
		$slideText["$number"] = freddo_options('_onepage_text_'.$number.'_slider', '');
		$slideSubText["$number"] = freddo_options('_onepage_subtext_'.$number.'_slider', '');
	}
?>
<section class="freddo_onepage_section freddo_slider <?php echo esc_attr($sliderEffectScroll); ?>" id="<?php echo esc_attr($sliderSectionID); ?>">
	<div class="flexslider" style=" max-width: 1190px;padding: 0 !important;    margin: 0 auto; position: relative;">

	    <div class="aboutus_columns" style="padding:.5em;margin-top:0 ;position: absolute;top:50%;margin-top: -100px">
			
			
		  	<div class="aboutus_columns_three" style="width:60%">
				<div class="aboutInner">
					<h2 style="text-align:left;margin-top:0;font-size:2em">A digital asset layer protocol <br>is the infrastructure of asset Internet.</h2>
					<p style="font-size:1.3em">Any peer-to-peer financial applications and asset applications<br> from institutions and individuals could be built on Bytom chain.</p>
					<span class="line"></span>
				    <div class="freddoButton aboutus">
                        <img src="<?php echo get_template_directory_uri();?>/images/demo/icon_PDF_1.svg" style="">
                        <span style="font-size:1.5em;vertical-align: middle;">Technical White Paper</span>
				    	<a class="fiex_w" href="<?php echo get_template_directory_uri();?>/book/BytomWhitePaperV1.1.pdf" target="_blank" style="margin:0 1em">中文</a>
				    	<a class="fiex_w" href="<?php echo get_template_directory_uri();?>/book/BytomWhitePaperV1.1_En.pdf" target="_blank" style="margin:0 1em">English</a>
				    </div>
				</div>
			</div>
		    <div class="aboutus_columns_three" style="width:40%">
				<div class="aboutInnerImage">
			    <!-- 视频 -->  
			        <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery-1.8.3.min.js"></script>   
                    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/images/video/video.js"></script>
                    <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/images/video/video.css" type="text/css" media="screen" />             
                    <video width="100%" height="280" src="<?php echo get_template_directory_uri(); ?>/images/video/bytom_b_3.mp4" type="video/mp4" 

	                     id="player1" poster="<?php echo get_template_directory_uri(); ?>/images/video/video.jpg"

	                     controls="controls" preload="true"
	                     webkit-playsinline="true" /*这个属性是ios 10中设置可以
                     让视频在小窗内播放，也就是不是全屏播放*/  
                      playsinline="true"  /*IOS微信浏览器支持小窗内播放*/ 
                      x-webkit-airplay="allow" 
                      x5-video-player-type="h5"  /*启用H5播放器,是wechat安卓版特性*/
                      x5-video-player-fullscreen="true" /*全屏设置，
                     设置为 true 是防止横屏*/
                     x5-video-orientation="portraint" //播放器支付的方向， landscape横屏，portraint竖屏，默认值为竖屏
                      style="object-fit:fill">
	                 </video>
	                 <script>

						$('audio,video').mediaelementplayer({
							success: function(player, node) {

								$('#' + node.id + '-mode').html('mode: ' + player.pluginType);
							}
						});

				    </script>
                <!--  结束 -->	
				</div>
			</div>
		</div>

	  <?php if ($showScrollDown) : ?>
		<?php $scrollText = freddo_options('_onepage_scrolldown_text', __('Scroll Down', 'freddo')); ?>
		<div class="scrollDown"><span><?php echo esc_html($scrollText); ?></span></div>
	<?php endif; ?>
	</div>
</section>
<?php endif; ?>
