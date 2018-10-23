<?php $showContact = freddo_options('_onepage_section_contact', ''); ?>
<?php if ($showContact == 1) : ?>
	<?php
		$contactSectionID = freddo_options('_onepage_id_contact', 'contact');
		$contactTitle = freddo_options('_onepage_title_contact', __('Contact Us', 'freddo'));
		$contactSubTitle = freddo_options('_onepage_subtitle_contact', __('Get in touch', 'freddo'));
		$contactAddText = freddo_options('_onepage_additionaltext_contact', '');
		$contactCompanyName = freddo_options('_onepage_companyname_contact', '');
		$contactCompanyAddress1 = freddo_options('_onepage_companyaddress1_contact', '');
		$contactCompanyAddress2 = freddo_options('_onepage_companyaddress2_contact', '');
		$contactCompanyAddress3 = freddo_options('_onepage_companyaddress3_contact', '');
		$contactCompanyPhone = freddo_options('_onepage_companyphone_contact', '');
		$contactCompanyFax = freddo_options('_onepage_companyfax_contact', '');
		$contactCompanyEmail = freddo_options('_onepage_companyemail_contact', '');
		$contactShortcode = freddo_options('_onepage_shortcode_contact', '');
		$contactIcon = freddo_options('_onepage_icon_contact', 'fa fa-envelope');
		$contactCompanyPhoneLink = freddo_options('_onepage_companyphone_contact_link', '');
	?>
<section class="freddo_onepage_section freddo_contact <?php echo $contactShortcode ? 'withForm' : 'noForm' ?>" id="<?php echo esc_attr($contactSectionID); ?>">
	<div class="freddo_contact_color"></div>
	<div class="freddo_action_contact">
		<?php if($contactTitle || is_customize_preview()): ?>
			<h2 class="freddo_main_text"><?php echo esc_html($contactTitle); ?></h2>
		<?php endif; ?>
		<?php if($contactSubTitle || is_customize_preview()): ?>
			<p class="freddo_subtitle"><?php echo esc_html($contactSubTitle); ?></p>
		<?php endif; ?>
		<div class="contact_columns">
			<h3 class="title h_f" style="text-align: center;margin-bottom: 3em">Celebrated Institutions and companies，build an enormous and multivariate ecology.</h3>
			<div class="partenrs_box">
                <ul class="partners clearfix">
                 	<li>
                 		<img class="img_one" src="<?php echo get_template_directory_uri(); ?>/images/demo/partners/gray/Gray_01_Logo_Bitmain.svg">
                 		<img class="img_two" src="<?php echo get_template_directory_uri(); ?>/images/demo/partners/color/Color_01_Logo_Bitmain.svg">
                 	</li>
                 	<li>
                 		<img class="img_one" src="<?php echo get_template_directory_uri(); ?>/images/demo/partners/gray/Gray_02_Logo_8BTC.svg">
                 		<img class="img_two" src="<?php echo get_template_directory_uri(); ?>/images/demo/partners/color/Color_02_Logo_8BTC.svg">
                 	</li>	
                 	<li>
                 		<img class="img_one" src="<?php echo get_template_directory_uri(); ?>/images/demo/partners/gray/Gray_03_Logo_Detrust.svg">
                 		<img class="img_two" src="<?php echo get_template_directory_uri(); ?>/images/demo/partners/color/Color_03_Logo_Detrust.svg">
                 	</li>	
                 	<li>
                 		<img class="img_one" src="<?php echo get_template_directory_uri(); ?>/images/demo/partners/gray/Gray_04_Logo_DatrixTech.svg">
                 		<img class="img_two" src="<?php echo get_template_directory_uri(); ?>/images/demo/partners/color/Color_04_Logo_DatrixTech.svg">
                 	</li>	
                 	<li>
                 	    <img class="img_one" src="<?php echo get_template_directory_uri(); ?>/images/demo/partners/gray/Gray_05_Logo_Wanchain.svg">
                 		<img class="img_two" src="<?php echo get_template_directory_uri(); ?>/images/demo/partners/color/Color_05_Logo_Wanchain.svg">
                 	</li>	
                 	<li>
                 		<img class="img_one" src="<?php echo get_template_directory_uri(); ?>/images/demo/partners/gray/Gray_06_Logo_Superbloom.svg">
                 		<img class="img_two" src="<?php echo get_template_directory_uri(); ?>/images/demo/partners/color/Color_06_Logo_Superbloom.svg">
                 	</li>	
                 	<li>
                        <img class="img_one" src="<?php echo get_template_directory_uri(); ?>/images/demo/partners/gray/Gray_07_Logo_Huobi.svg">
                 		<img class="img_two" src="<?php echo get_template_directory_uri(); ?>/images/demo/partners/color/Color_07_Logo_Huobi.svg">
                 	</li>	
                 	<li>
                 		<img class="img_one" src="<?php echo get_template_directory_uri(); ?>/images/demo/partners/gray/Gray_08_Logo_OKEX.svg">
                 		<img class="img_two" src="<?php echo get_template_directory_uri(); ?>/images/demo/partners/color/Color_08_Logo_OKEX.svg">
                 	</li>
                 	<li>
                 		<img class="img_one" src="<?php echo get_template_directory_uri(); ?>/images/demo/partners/gray/Gray_09_Logo_gate.svg">
                 		<img class="img_two" src="<?php echo get_template_directory_uri(); ?>/images/demo/partners/color/Color_09_Logo_gate.svg">
                 	</li>
                 	<li>
                 		<img class="img_one" src="<?php echo get_template_directory_uri(); ?>/images/demo/partners/gray/Gray_10_Logo_Zeniex.svg">
                 		<img class="img_two" src="<?php echo get_template_directory_uri(); ?>/images/demo/partners/color/Color_10_Logo_Zeniex.svg">
                 	</li>
                 		<li>
                 		<img class="img_one" src="<?php echo get_template_directory_uri(); ?>/images/demo/partners/gray/Gray_11_Logo_Bibox.svg">
                 		<img class="img_two" src="<?php echo get_template_directory_uri(); ?>/images/demo/partners/color/Color_11_Logo_Bibox.svg">
                 	</li>
                 		<li>
                 		<img class="img_one" src="<?php echo get_template_directory_uri(); ?>/images/demo/partners/gray/Gray_12_Logo_EXX.svg">
                 		<img class="img_two" src="<?php echo get_template_directory_uri(); ?>/images/demo/partners/color/Color_12_Logo_EXX.svg">
                 	</li>
                 		<li>
                 		<img class="img_one" src="<?php echo get_template_directory_uri(); ?>/images/demo/partners/gray/Gray_13_Logo_Hitbtc.svg">
                 		<img class="img_two" src="<?php echo get_template_directory_uri(); ?>/images/demo/partners/color/Color_13_Logo_Hitbtc.svg">
                 	</li>
                 		<li>
                 		<img class="img_one" src="<?php echo get_template_directory_uri(); ?>/images/demo/partners/gray/Gray_14_Logo_KuCoin.svg">
                 		<img class="img_two" src="<?php echo get_template_directory_uri(); ?>/images/demo/partners/color/Color_14_Logo_KuCoin.svg">
                 	</li>
                 		<li>
                 		<img class="img_one" src="<?php echo get_template_directory_uri(); ?>/images/demo/partners/gray/Gray_15_Logo_Coinegg.svg">
                 		<img class="img_two" src="<?php echo get_template_directory_uri(); ?>/images/demo/partners/color/Color_15_Logo_Coinegg.svg">
                 	</li>
                 		<li>
                 		<img class="img_one" src="<?php echo get_template_directory_uri(); ?>/images/demo/partners/gray/Gray_16_Logo_Purdue.svg">
                 		<img class="img_two" src="<?php echo get_template_directory_uri(); ?>/images/demo/partners/color/Color_16_Logo_Purdue.svg">
                 	</li>
                 		<li>
                 		<img class="img_one" src="<?php echo get_template_directory_uri(); ?>/images/demo/partners/gray/Gray_17_Logo_GBIC.svg">
                 		<img class="img_two" src="<?php echo get_template_directory_uri(); ?>/images/demo/partners/color/Color_17_Logo_GBIC.svg">
                 	</li>
                 		<li>
                 		<img class="img_one" src="<?php echo get_template_directory_uri(); ?>/images/demo/partners/gray/Gray_18_Logo_Prdae.svg">
                 		<img class="img_two" src="<?php echo get_template_directory_uri(); ?>/images/demo/partners/color/Color_18_Logo_Prdae.svg">
                 	</li>
                </ul>
			</div>
		</div>
	</div>
</section>
<?php endif; ?>