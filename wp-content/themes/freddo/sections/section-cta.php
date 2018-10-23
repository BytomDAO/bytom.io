<?php 
$showCta = freddo_options('_onepage_section_cta', '');
?>
<?php if ($showCta == 1) : ?>
	<?php
		$ctaSectionID = freddo_options('_onepage_id_cta','cta');
		$ctaIcon = freddo_options('_onepage_fontawesome_cta','fa fa-flash');
		$ctaPhrase = freddo_options('_onepage_phrase_cta','');
		$ctaDesc = freddo_options('_onepage_desc_cta','');
		$ctaTextButton = freddo_options('_onepage_textbutton_cta',__('More Information', 'freddo'));
		$ctaLinkButton = freddo_options('_onepage_urlbutton_cta','#');
		$ctaOpenLink = freddo_options('_onepage_openurl_cta','_blank');
	?>
<section class="freddo_onepage_section freddo_cta <?php echo $ctaDesc ? 'withDesc' : 'noDesc' ?>" id="<?php echo esc_attr($ctaSectionID); ?>">
	<div class="freddo_cta_color"></div>
	<div class="freddo_action_cta">
		<div class="cta_columns">
			<div class="ctaText">
				<div class="ctaIcon"><i class="<?php echo esc_attr($ctaIcon); ?>" aria-hidden="true"></i></div>
				<div class="ctaPhrase">
					<?php if ($ctaPhrase || is_customize_preview()) : ?>
						<h3><?php echo esc_html($ctaPhrase); ?></h3>
					<?php endif; ?>
					<?php if ($ctaDesc || is_customize_preview()) : ?>
						<p><?php echo esc_html($ctaDesc); ?></p>
					<?php endif; ?>
				</div>
			</div>
			<?php if ($ctaTextButton) : ?>
				<div class="ctaButton freddoButton"><a href="<?php echo esc_url($ctaLinkButton); ?>" target="<?php echo esc_attr($ctaOpenLink); ?>"><?php echo esc_html($ctaTextButton); ?></a></div>
			<?php endif; ?>
	</div>
	</div>
</section>
<?php endif; ?>