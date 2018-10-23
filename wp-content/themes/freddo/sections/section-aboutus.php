<?php $showAboutus = freddo_options('_onepage_section_aboutus', ''); ?>
<?php if ($showAboutus == 1) : ?>
	<?php
		$aboutusSectionID = freddo_options('_onepage_id_aboutus', 'aboutus');
		$aboutusTitle = freddo_options('_onepage_title_aboutus', __('About Us', 'freddo'));
		$aboutusSubTitle = freddo_options('_onepage_subtitle_aboutus', __('Who We Are', 'freddo'));
		$aboutusPageBox = freddo_options('_onepage_choosepage_aboutus');
		$aboutusButtonText = freddo_options('_onepage_textbutton_aboutus', __('More Information', 'freddo'));
		$aboutusButtonLink = freddo_options('_onepage_linkbutton_aboutus', '#');
	?>
<section class="freddo_onepage_section freddo_aboutus <?php echo has_post_thumbnail($aboutusPageBox) ? 'withImage' : 'noImage' ?>" id="<?php echo esc_attr($aboutusSectionID); ?>">
	<div class="freddo_aboutus_color"></div>
	<div class="freddo_action_aboutus clearfix">
		<?php if($aboutusTitle || is_customize_preview()): ?>
			<h2 class="freddo_main_text"><?php echo esc_html($aboutusTitle); ?></h2>
		<?php endif; ?>
		<?php if($aboutusSubTitle || is_customize_preview()): ?>
			<p class="freddo_subtitle"><?php echo esc_html($aboutusSubTitle); ?></p>
		<?php endif; ?>
		<!-- features -->
		<div class="features_div clearfix">
            <div id="" class="features_box fl">	
	            <div class="clearfix p">
			        <div class="">
			        	 <img width="600" height="240" src="<?php bloginfo('template_url'); ?>/images/page/feature_1_intelligent.svg" class="attachment-freddo-the-post-small size-freddo-the-post-small wp-post-image" alt="">     
			         </div>				
			        <div class="features_dec">
					     <header class="entry-header">
							<h2 class="entry-title title_color">
								<a href="javascript:;" rel="bookmark">Intelligent</a>
							</h2>		
							
					     </header><!-- .entry-header -->
					      <div class="font_c t_c">
						     <p>Consensus algorithm<br> promotes AI techniques <br>Calculation power actually using</p>
					     </div><!-- .entry-content -->
				     </div>
			    </div>
			</div>
			<div id="" class="features_box fl">	
	            <div class="clearfix p">
			        <div class="">
			        	 <img width="600" height="240" src="<?php bloginfo('template_url'); ?>/images/page/feature_2_flexible.svg" class="attachment-freddo-the-post-small size-freddo-the-post-small wp-post-image" alt="">     
			         </div>				
			        <div class="features_dec">
					     <header class="entry-header">
							<h2 class="entry-title title_color">
								<a href="javascript:;" rel="bookmark">Flexible</a>
							</h2>		
							
					     </header><!-- .entry-header -->
					      <div class="font_c t_c">
						     <p>Customize Your Smart contract<br> Completely control assets</p>
					     </div><!-- .entry-content -->
				     </div>
			    </div>
			</div>
			<div id="" class="features_box fl">	
	            <div class="clearfix p">
			        <div class="">
			        	 <img width="600" height="240" src="<?php bloginfo('template_url'); ?>/images/page/feature_3_efficient.svg" class="attachment-freddo-the-post-small size-freddo-the-post-small wp-post-image" alt="">     
			         </div>				
			        <div class="features_dec">
					     <header class="entry-header">
							<h2 class="entry-title title_color">
								<a href="javascript:;" rel="bookmark">Efficient</a>
							</h2>		
							
					     </header><!-- .entry-header -->
					      <div class="font_c t_c">
						     <p>Digital Asset Atomic Transfer<br> High concurrent exchange<br> Adaptable to different business environments</p>
					     </div><!-- .entry-content -->
				     </div>
			    </div>
			</div>
			<div class="feature_more" style="color: #fff">
                  <a href="/features">Learn more >></a>
			</div>
		</div>
	</div>
</section>
<?php endif; ?>