<?php
/**
 * Freddo Theme Customizer
 *
 * @package freddo
 */

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function freddo_customize_preview_js() {
	wp_enqueue_script( 'freddo-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'freddo_customize_preview_js' );

function freddo_customizer_script() {
	wp_enqueue_script( 'freddo-customizer-script', get_template_directory_uri() .'/js/customizer-script.js', array('jquery'),'', true  );
	wp_enqueue_style( 'freddo-customizer-style', get_template_directory_uri() .'/inc/css/customizer-style.css');	
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() .'/css/font-awesome.min.css');
}
add_action( 'customize_controls_enqueue_scripts', 'freddo_customizer_script' );

/**
 * Delete font size style from tag cloud widget
 */
if( ! function_exists('freddo_fix_tag_cloud')){
	function freddo_fix_tag_cloud($tag_string){
	   return preg_replace('/ style=("|\')(.*?)("|\')/','',$tag_string);
	}
}
add_filter('wp_generate_tag_cloud', 'freddo_fix_tag_cloud',10,1);

/**
 * Replace Excerpt More
 */
if( ! function_exists('freddo_new_excerpt_more')){
	function freddo_new_excerpt_more( $more ) {
		if ( is_admin() ) {
			return $more;
		}
		$customMore = freddo_options('_excerpt_more', '&hellip;');
		return esc_html($customMore);
	}
}
add_filter('excerpt_more', 'freddo_new_excerpt_more');

/**
 * Custom Excerpt Length
 */
if( ! function_exists('freddo_custom_excerpt_length')){
	function freddo_custom_excerpt_length( $length ) {
		if ( ! is_admin() ) {
			$textBlog = freddo_options('_lenght_blog', '30');
			return intval($textBlog);
		} else {
			return $length;
		}
	}
}
add_filter( 'excerpt_length', 'freddo_custom_excerpt_length', 999 );

/**
 * Register Custom Settings
 */
function freddo_custom_settings_register( $wp_customize ) {
	/* Add Panels */
	$wp_customize->add_panel( 'cresta_freddo_themeoptions', array(
	 'priority'       => 50,
	  'capability'     => 'edit_theme_options',
	  'theme_supports' => '',
	  'title'          => esc_html__('Freddo Theme Options', 'freddo')
	) );
	$wp_customize->add_panel( 'cresta_freddo_onepage', array(
	 'priority'       => 50,
	  'capability'     => 'edit_theme_options',
	  'theme_supports' => '',
	  'active_callback' => 'freddo_is_one_page',
	  'title'    => esc_html__( 'Freddo Onepage', 'freddo' ),
	) );
	/* Add Sections Theme Options */
	$wp_customize->add_section( 'cresta_freddo_theme_options_general', array(
	     'title'    => esc_html__( 'General Settings', 'freddo' ),
	     'priority' => 10,
		 'panel'  => 'cresta_freddo_themeoptions',
	) );
	$wp_customize->add_section( 'cresta_freddo_theme_options_postpage', array(
	     'title'    => esc_html__( 'Posts and pages settings', 'freddo' ),
	     'priority' => 10,
		 'panel'  => 'cresta_freddo_themeoptions',
	) );
	$wp_customize->add_section( 'cresta_freddo_theme_options_colors', array(
	     'title'    => esc_html__( 'Theme Colors', 'freddo' ),
	     'priority' => 10,
		 'panel'  => 'cresta_freddo_themeoptions',
	) );
	$wp_customize->add_section( 'cresta_freddo_theme_options_social', array(
	     'title'    => esc_html__( 'Footer Social Buttons', 'freddo' ),
	     'priority' => 10,
		 'panel'  => 'cresta_freddo_themeoptions',
	) );
	/* Add Sections OnePage */
	$wp_customize->add_section( 'cresta_freddo_onepage_section_settings', array(
	     'title'    => esc_html__( 'Onepage general settings', 'freddo' ),
	     'priority' => 10,
		 'panel'  => 'cresta_freddo_onepage',
	) );
	$wp_customize->add_section( 'cresta_freddo_onepage_section_slider', array(
	     'title'    => esc_html__( 'Section slider', 'freddo' ),
	     'priority' => 10,
		 'panel'  => 'cresta_freddo_onepage',
	) );
	$wp_customize->add_section( 'cresta_freddo_onepage_section_aboutus', array(
	     'title'    => esc_html__( 'Section about us', 'freddo' ),
	     'priority' => 10,
		 'panel'  => 'cresta_freddo_onepage',
	) );
	$wp_customize->add_section( 'cresta_freddo_onepage_section_features', array(
	     'title'    => esc_html__( 'Section features', 'freddo' ),
	     'priority' => 10,
		 'panel'  => 'cresta_freddo_onepage',
	) );
	$wp_customize->add_section( 'cresta_freddo_onepage_section_skills', array(
	     'title'    => esc_html__( 'Section skills', 'freddo' ),
	     'priority' => 10,
		 'panel'  => 'cresta_freddo_onepage',
	) );
	$wp_customize->add_section( 'cresta_freddo_onepage_section_cta', array(
	     'title'    => esc_html__( 'Section call to action', 'freddo' ),
	     'priority' => 10,
		 'panel'  => 'cresta_freddo_onepage',
	) );
	$wp_customize->add_section( 'cresta_freddo_onepage_section_services', array(
	     'title'    => esc_html__( 'Section services', 'freddo' ),
	     'priority' => 10,
		 'panel'  => 'cresta_freddo_onepage',
	) );
	$wp_customize->add_section( 'cresta_freddo_onepage_section_blog', array(
	     'title'    => esc_html__( 'Section blog', 'freddo' ),
	     'priority' => 10,
		 'panel'  => 'cresta_freddo_onepage',
	) );
	$wp_customize->add_section( 'cresta_freddo_onepage_section_team', array(
	     'title'    => esc_html__( 'Section team', 'freddo' ),
	     'priority' => 10,
		 'panel'  => 'cresta_freddo_onepage',
	) );
	$wp_customize->add_section( 'cresta_freddo_onepage_section_contact', array(
	     'title'    => esc_html__( 'Section contact', 'freddo' ),
	     'priority' => 10,
		 'panel'  => 'cresta_freddo_onepage',
	) );
	$wp_customize->add_section( 'cresta_freddo_links', array(
	 'priority'       => 999,
	  'capability'     => 'edit_theme_options',
	  'title'          => esc_html__('Freddo useful links', 'freddo')
	) );
	/**
	* ################ SECTION GENERAL SETTINGS
	*/
	/* Show Page Loader */
	$wp_customize->add_setting('freddo_theme_options[_show_loader]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'freddo_sanitize_checkbox'
    ) );
	$wp_customize->add_control('freddo_theme_options[_show_loader]', array(
        'label'      => __( 'Display page loader', 'freddo' ),
        'section'    => 'cresta_freddo_theme_options_general',
        'settings'   => 'freddo_theme_options[_show_loader]',
        'type'       => 'checkbox',
		'priority' => 1,
    ) );
	/* Show Search Button */
	$wp_customize->add_setting('freddo_theme_options[_search_button]', array(
        'default'    => '1',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'freddo_sanitize_checkbox'
    ) );
	$wp_customize->add_control('freddo_theme_options[_search_button]', array(
        'label'      => __( 'Display search button in the header', 'freddo' ),
        'section'    => 'cresta_freddo_theme_options_general',
        'settings'   => 'freddo_theme_options[_search_button]',
        'type'       => 'checkbox',
		'priority' => 2,
    ) );
	/* Enable Smooth Scroll */
	$wp_customize->add_setting('freddo_theme_options[_smooth_scroll]', array(
        'default'    => '1',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'freddo_sanitize_checkbox'
    ) );
	$wp_customize->add_control('freddo_theme_options[_smooth_scroll]', array(
        'label'      => __( 'Enable Smooth Scroll', 'freddo' ),
        'section'    => 'cresta_freddo_theme_options_general',
        'settings'   => 'freddo_theme_options[_smooth_scroll]',
        'type'       => 'checkbox',
		'priority' => 3,
    ) );
	/* Scroll to top also in mobile */
	$wp_customize->add_setting('freddo_theme_options[_scroll_top]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'freddo_sanitize_checkbox'
    ) );
	$wp_customize->add_control('freddo_theme_options[_scroll_top]', array(
        'label'      => __( 'Show scroll to top button also on mobile view', 'freddo' ),
        'section'    => 'cresta_freddo_theme_options_general',
        'settings'   => 'freddo_theme_options[_scroll_top]',
        'type'       => 'checkbox',
		'priority' => 3,
    ) );
	/* Fixed main menu also on mobile view */
	$wp_customize->add_setting('freddo_theme_options[_menu_fixed_mobile]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'freddo_sanitize_checkbox'
    ) );
	$wp_customize->add_control('freddo_theme_options[_menu_fixed_mobile]', array(
        'label'      => __( 'Fixed main menu also on mobile view', 'freddo' ),
        'section'    => 'cresta_freddo_theme_options_general',
        'settings'   => 'freddo_theme_options[_menu_fixed_mobile]',
        'type'       => 'checkbox',
		'priority' => 3,
    ) );
	/* Custom Excerpt More */
	$wp_customize->add_setting('freddo_theme_options[_excerpt_more]', array(
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'default'    => '&hellip;'
    ) );
	$wp_customize->add_control('freddo_theme_options[_excerpt_more]', array(
        'label'      => __( 'Custom Excerpt Final', 'freddo' ),
        'section'    => 'cresta_freddo_theme_options_general',
        'settings'   => 'freddo_theme_options[_excerpt_more]',
        'type'       => 'text',
		'priority' => 4,
    ) );
	/* Text lenght for blog */
	$wp_customize->add_setting('freddo_theme_options[_lenght_blog]', array(
        'default'    => '30',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'absint',
    ) );
	$wp_customize->add_control('freddo_theme_options[_lenght_blog]', array(
        'label'      => __( 'Text lenght for blog excerpt (number of words)', 'freddo' ),
        'section'    => 'cresta_freddo_theme_options_general',
        'settings'   => 'freddo_theme_options[_lenght_blog]',
        'type'       => 'number',
		'priority' => 5,
    ) );
	/**
	* ################ POSTS AND PAGES SETTINGS
	*/
	/* Show Scrool Down Button */
	$wp_customize->add_setting('freddo_theme_options[_scrolldown_button]', array(
        'default'    => '1',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'freddo_sanitize_checkbox'
    ) );
	$wp_customize->add_control('freddo_theme_options[_scrolldown_button]', array(
        'label'      => __( 'Show the scroll down button', 'freddo' ),
        'section'    => 'cresta_freddo_theme_options_postpage',
        'settings'   => 'freddo_theme_options[_scrolldown_button]',
        'type'       => 'checkbox',
		'priority' => 1,
    ) );
	/* Scroll down text */
	$wp_customize->add_setting('freddo_theme_options[_post_scrolldown_text]', array(
		'default'    => __( 'Scroll Down', 'freddo' ),
		'type'       => 'option',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'transport' => 'postMessage'
	) );
	$wp_customize->add_control('freddo_theme_options[_post_scrolldown_text]', array(
		'label'      => __( 'Scroll Down Text ', 'freddo' ),
		'section'    => 'cresta_freddo_theme_options_postpage',
		'settings'   => 'freddo_theme_options[_post_scrolldown_text]',
		'type'       => 'text',
		'active_callback' => 'freddo_is_scroll_in_post',
		'priority' => 2,
	) );
	/* Show excerpt or full post */
	$wp_customize->add_setting('freddo_theme_options[_showpost_type]', array(
        'default'    => 'excerpt',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'freddo_sanitize_select',
    ) );
	$wp_customize->add_control('freddo_theme_options[_showpost_type]', array(
        'label'      => __( 'Show excerpt or full post in the blog page', 'freddo' ),
        'section'    => 'cresta_freddo_theme_options_postpage',
        'settings'   => 'freddo_theme_options[_showpost_type]',
        'type'       => 'select',
		'priority' => 3,
		'choices' => array(
			'excerpt' => __( 'Show excerpt', 'freddo'),
			'fullpost' => __( 'Show full post', 'freddo'),
		),
    ) );
	/* Effect on featured image */
	$wp_customize->add_setting('freddo_theme_options[_effect_featimage]', array(
        'default'    => 'withZoom',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'freddo_sanitize_select'
    ) );
	$wp_customize->add_control('freddo_theme_options[_effect_featimage]', array(
        'label'      => __( 'Scroll down effect on featured images', 'freddo' ),
        'section'    => 'cresta_freddo_theme_options_postpage',
        'settings'   => 'freddo_theme_options[_effect_featimage]',
        'type'       => 'select',
		'priority' => 4,
		'choices' => array(
			'none' => __( 'No effect', 'freddo'),
			'withZoom' => __( 'Zoom Effect', 'freddo'),
		),
    ) );
	/**
	* ################ SECTION THEME COLORS
	*/
	/* Main Border Section Color */
	$wp_customize->add_setting('freddo_theme_options[_heading_header]', array(
		'sanitize_callback' => 'sanitize_text_field',
		'type'       => 'option',
	));
	$wp_customize->add_control(
		new Freddo_Customize_Heading(
		$wp_customize,
		'freddo_theme_options[_heading_header]',
		array(
			'settings'		=> 'freddo_theme_options[_heading_header]',
			'section'		=> 'cresta_freddo_theme_options_colors',
			'label'			=> __( 'Header Section', 'freddo' ),
			'priority' => 1,
		))
	);
	/* Content Section Color */
	$wp_customize->add_setting('freddo_theme_options[_heading_content]', array(
		'sanitize_callback' => 'sanitize_text_field',
		'type'       => 'option',
	));
	$wp_customize->add_control(
		new Freddo_Customize_Heading(
		$wp_customize,
		'freddo_theme_options[_heading_content]',
		array(
			'settings'		=> 'freddo_theme_options[_heading_content]',
			'section'		=> 'cresta_freddo_theme_options_colors',
			'label'			=> __( 'Content Section', 'freddo' ),
			'priority' => 5,
		))
	);
	/* Sidebar Section Color */
	$wp_customize->add_setting('freddo_theme_options[_heading_sidebar]', array(
		'sanitize_callback' => 'sanitize_text_field',
		'type'       => 'option',
	));
	$wp_customize->add_control(
		new Freddo_Customize_Heading(
		$wp_customize,
		'freddo_theme_options[_heading_sidebar]',
		array(
			'settings'		=> 'freddo_theme_options[_heading_sidebar]',
			'section'		=> 'cresta_freddo_theme_options_colors',
			'label'			=> __( 'Push Sidebar Section', 'freddo' ),
			'priority' => 11,
		))
	);
	/* Footer Section Color */
	$wp_customize->add_setting('freddo_theme_options[_heading_footer]', array(
		'sanitize_callback' => 'sanitize_text_field',
		'type'       => 'option',
	));
	$wp_customize->add_control(
		new Freddo_Customize_Heading(
		$wp_customize,
		'freddo_theme_options[_heading_footer]',
		array(
			'settings'		=> 'freddo_theme_options[_heading_footer]',
			'section'		=> 'cresta_freddo_theme_options_colors',
			'label'			=> __( 'Footer Section', 'freddo' ),
			'priority' => 15,
		))
	);
	
	$colors = array();
	
	$colors[] = array(
	'slug'=>'_header_background_color', 
	'default' => '#121212',
	'label' => __('Header Background Color', 'freddo'),
	'priority' => 2,
	);
	$colors[] = array(
	'slug'=>'_header_text_color', 
	'default' => '#f5f5f5',
	'label' => __('Header Text Color', 'freddo'),
	'priority' => 3,
	);
	$colors[] = array(
	'slug'=>'_header_accent_color', 
	'default' => '#FF1654',
	'label' => __('Header Accent Color', 'freddo'),
	'priority' => 4,
	);
	$colors[] = array(
	'slug'=>'_content_background_color', 
	'default' => '#f5f5f5',
	'label' => __('Content Background Color', 'freddo'),
	'priority' => 6,
	);
	$colors[] = array(
	'slug'=>'_content_text_color', 
	'default' => '#121212',
	'label' => __('Content Text Color', 'freddo'),
	'priority' => 8,
	);
	$colors[] = array(
	'slug'=>'_content_accent_color', 
	'default' => '#FF1654',
	'label' => __('Content Accent Color', 'freddo'),
	'priority' => 9,
	);
	$colors[] = array(
	'slug'=>'_content_border_color', 
	'default' => '#e0e0e0',
	'label' => __('General Border Color', 'freddo'),
	'priority' => 10,
	);
	$colors[] = array(
	'slug'=>'_sidebar_background_color', 
	'default' => '#f5f5f5',
	'label' => __('Push sidebar background color', 'freddo'),
	'priority' => 12,
	);
	$colors[] = array(
	'slug'=>'_sidebar_text_color', 
	'default' => '#121212',
	'label' => __('Push sidebar text color', 'freddo'),
	'priority' => 13,
	);
	$colors[] = array(
	'slug'=>'_sidebar_accent_color', 
	'default' => '#FF1654',
	'label' => __('Push sidebar accent color', 'freddo'),
	'priority' => 14,
	);
	$colors[] = array(
	'slug'=>'_footer_background_color', 
	'default' => '#222222',
	'label' => __('Footer background color', 'freddo'),
	'priority' => 16,
	);
	$colors[] = array(
	'slug'=>'_footer_text_color', 
	'default' => '#afafaf',
	'label' => __('Footer text color', 'freddo'),
	'priority' => 17,
	);
	$colors[] = array(
	'slug'=>'_footer_accent_color', 
	'default' => '#e4e2e2',
	'label' => __('Footer accent color', 'freddo'),
	'priority' => 18,
	);
	foreach( $colors as $freddo_theme_options_colors ) {
		$wp_customize->add_setting(
			'freddo_theme_options[' . $freddo_theme_options_colors['slug'] . ']', array(
				'default' => $freddo_theme_options_colors['default'],
				'type' => 'option', 
				'sanitize_callback' => 'sanitize_hex_color',
				'capability' => 'edit_theme_options'
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'freddo_theme_options[' . $freddo_theme_options_colors['slug'] . ']', array(
					'label' => $freddo_theme_options_colors['label'], 
					'section' => 'cresta_freddo_theme_options_colors',
					'settings' =>'freddo_theme_options[' . $freddo_theme_options_colors['slug'] . ']',
					'priority' => $freddo_theme_options_colors['priority'],
				)
			)
		);
	}
	/**
	* ################ SECTION SOCIAL NETWORK
	*/	
	$socialmedia = array();
	
	$socialmedia[] = array(
	'slug'=>'_facebookurl', 
	'default' => '',
	'label' => __('Facebook URL', 'freddo')
	);
	$socialmedia[] = array(
	'slug'=>'_twitterurl', 
	'default' => '',
	'label' => __('Twitter URL', 'freddo')
	);
	$socialmedia[] = array(
	'slug'=>'_googleplusurl', 
	'default' => '',
	'label' => __('Google Plus URL', 'freddo')
	);
	$socialmedia[] = array(
	'slug'=>'_linkedinurl', 
	'default' => '',
	'label' => __('Linkedin URL', 'freddo')
	);
	$socialmedia[] = array(
	'slug'=>'_instagramurl', 
	'default' => '',
	'label' => __('Instagram URL', 'freddo')
	);
	$socialmedia[] = array(
	'slug'=>'_youtubeurl', 
	'default' => '',
	'label' => __('YouTube URL', 'freddo')
	);
	$socialmedia[] = array(
	'slug'=>'_pinteresturl', 
	'default' => '',
	'label' => __('Pinterest URL', 'freddo')
	);
	$socialmedia[] = array(
	'slug'=>'_tumblrurl', 
	'default' => '',
	'label' => __('Tumblr URL', 'freddo')
	);
	$socialmedia[] = array(
	'slug'=>'_flickrurl', 
	'default' => '',
	'label' => __('Flickr URL', 'freddo')
	);
	$socialmedia[] = array(
	'slug'=>'_vkurl', 
	'default' => '',
	'label' => __('VK URL', 'freddo')
	);
	$socialmedia[] = array(
	'slug'=>'_xingurl', 
	'default' => '',
	'label' => __('Xing URL', 'freddo')
	);
	$socialmedia[] = array(
	'slug'=>'_redditurl', 
	'default' => '',
	'label' => __('Reddit URL', 'freddo')
	);
	$socialmedia[] = array(
	'slug'=>'_vimeourl', 
	'default' => '',
	'label' => __('Vimeo URL', 'freddo')
	);
	foreach( $socialmedia as $freddo_theme_options ) {
		// SETTINGS
		$wp_customize->add_setting(
			'freddo_theme_options[' . $freddo_theme_options['slug']. ']', array(
				'default' => $freddo_theme_options['default'],
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'esc_url_raw',
				'type'     => 'option',
			)
		);
		// CONTROLS
		$wp_customize->add_control(
			'freddo_theme_options[' . $freddo_theme_options['slug']. ']', 
			array('label' => $freddo_theme_options['label'], 
			'section'    => 'cresta_freddo_theme_options_social',
			'settings' =>'freddo_theme_options[' . $freddo_theme_options['slug']. ']',
			)
		);
	}
	/* Open social links */
	$wp_customize->add_setting('freddo_theme_options[_social_open_links]', array(
        'default'    => '_self',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'freddo_sanitize_select',
    ) );
	$wp_customize->add_control('freddo_theme_options[_social_open_links]', array(
        'label'      => __( 'Open social links', 'freddo' ),
        'section'    => 'cresta_freddo_theme_options_social',
        'settings'   => 'freddo_theme_options[_social_open_links]',
        'type'       => 'select',
		'priority' => 4,
		'choices' => array(
			'_self' => __( 'Same window', 'freddo'),
			'_blank' => __( 'New Window', 'freddo'),
		),
    ) );
	/**
	* ################ ONEPAGE GENERAL SETTINGS
	*/
	/* One Page Map */
	$wp_customize->add_setting('freddo_theme_options[_onepage_settings_sectionmaphead]', array(
		'sanitize_callback' => 'sanitize_text_field',
		'type'       => 'option',
	));
	$wp_customize->add_control(
		new Freddo_Customize_Heading(
		$wp_customize,
		'freddo_theme_options[_onepage_settings_sectionmaphead]',
		array(
			'settings'		=> 'freddo_theme_options[_onepage_settings_sectionmaphead]',
			'section'		=> 'cresta_freddo_onepage_section_settings',
			'label'			=> __( 'One Page Map', 'freddo' ),
			'priority' => 1,
		))
	);
	/* One page section map */
	$wp_customize->add_setting('freddo_theme_options[_onepage_settings_sectionmap]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'freddo_sanitize_checkbox'
    ) );
	$wp_customize->add_control('freddo_theme_options[_onepage_settings_sectionmap]', array(
        'label'      => __( 'Show the one page section map', 'freddo' ),
        'section'    => 'cresta_freddo_onepage_section_settings',
        'settings'   => 'freddo_theme_options[_onepage_settings_sectionmap]',
        'type'       => 'checkbox',
		'priority' => 1,
    ) );
	/* Slider Text */
	$wp_customize->add_setting('freddo_theme_options[_onepage_settings_map_slider]', array(
		'default'    => '',
		'type'       => 'option',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control('freddo_theme_options[_onepage_settings_map_slider]', array(
		'label'      => __( 'Slider Text', 'freddo' ),
		'section'    => 'cresta_freddo_onepage_section_settings',
		'settings'   => 'freddo_theme_options[_onepage_settings_map_slider]',
		'type'       => 'text',
		'active_callback' => 'freddo_is_sectionmap_active',
	) );
	/* About us Text */
	$wp_customize->add_setting('freddo_theme_options[_onepage_settings_map_aboutus]', array(
		'default'    => '',
		'type'       => 'option',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control('freddo_theme_options[_onepage_settings_map_aboutus]', array(
		'label'      => __( 'About Us Text', 'freddo' ),
		'section'    => 'cresta_freddo_onepage_section_settings',
		'settings'   => 'freddo_theme_options[_onepage_settings_map_aboutus]',
		'type'       => 'text',
		'active_callback' => 'freddo_is_sectionmap_active',
	) );
	/* Features Text */
	$wp_customize->add_setting('freddo_theme_options[_onepage_settings_map_features]', array(
		'default'    => '',
		'type'       => 'option',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control('freddo_theme_options[_onepage_settings_map_features]', array(
		'label'      => __( 'Features Text', 'freddo' ),
		'section'    => 'cresta_freddo_onepage_section_settings',
		'settings'   => 'freddo_theme_options[_onepage_settings_map_features]',
		'type'       => 'text',
		'active_callback' => 'freddo_is_sectionmap_active',
	) );
	/* Skills Text */
	$wp_customize->add_setting('freddo_theme_options[_onepage_settings_map_skills]', array(
		'default'    => '',
		'type'       => 'option',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control('freddo_theme_options[_onepage_settings_map_skills]', array(
		'label'      => __( 'Skills Text', 'freddo' ),
		'section'    => 'cresta_freddo_onepage_section_settings',
		'settings'   => 'freddo_theme_options[_onepage_settings_map_skills]',
		'type'       => 'text',
		'active_callback' => 'freddo_is_sectionmap_active',
	) );
	/* CTA Text */
	$wp_customize->add_setting('freddo_theme_options[_onepage_settings_map_cta]', array(
		'default'    => '',
		'type'       => 'option',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control('freddo_theme_options[_onepage_settings_map_cta]', array(
		'label'      => __( 'CTA Text', 'freddo' ),
		'section'    => 'cresta_freddo_onepage_section_settings',
		'settings'   => 'freddo_theme_options[_onepage_settings_map_cta]',
		'type'       => 'text',
		'active_callback' => 'freddo_is_sectionmap_active',
	) );
	/* Services Text */
	$wp_customize->add_setting('freddo_theme_options[_onepage_settings_map_services]', array(
		'default'    => '',
		'type'       => 'option',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control('freddo_theme_options[_onepage_settings_map_services]', array(
		'label'      => __( 'Services Text', 'freddo' ),
		'section'    => 'cresta_freddo_onepage_section_settings',
		'settings'   => 'freddo_theme_options[_onepage_settings_map_services]',
		'type'       => 'text',
		'active_callback' => 'freddo_is_sectionmap_active',
	) );
	/* Blog Text */
	$wp_customize->add_setting('freddo_theme_options[_onepage_settings_map_blog]', array(
		'default'    => '',
		'type'       => 'option',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control('freddo_theme_options[_onepage_settings_map_blog]', array(
		'label'      => __( 'Blog Text', 'freddo' ),
		'section'    => 'cresta_freddo_onepage_section_settings',
		'settings'   => 'freddo_theme_options[_onepage_settings_map_blog]',
		'type'       => 'text',
		'active_callback' => 'freddo_is_sectionmap_active',
	) );
	/* Team Text */
	$wp_customize->add_setting('freddo_theme_options[_onepage_settings_map_team]', array(
		'default'    => '',
		'type'       => 'option',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control('freddo_theme_options[_onepage_settings_map_team]', array(
		'label'      => __( 'Team Text', 'freddo' ),
		'section'    => 'cresta_freddo_onepage_section_settings',
		'settings'   => 'freddo_theme_options[_onepage_settings_map_team]',
		'type'       => 'text',
		'active_callback' => 'freddo_is_sectionmap_active',
	) );
	/* Contact Text */
	$wp_customize->add_setting('freddo_theme_options[_onepage_settings_map_contact]', array(
		'default'    => '',
		'type'       => 'option',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control('freddo_theme_options[_onepage_settings_map_contact]', array(
		'label'      => __( 'Contact Text', 'freddo' ),
		'section'    => 'cresta_freddo_onepage_section_settings',
		'settings'   => 'freddo_theme_options[_onepage_settings_map_contact]',
		'type'       => 'text',
		'active_callback' => 'freddo_is_sectionmap_active',
	) );
	/**
	* ################ SECTION SLIDER
	*/
	/* Show Slider Section */
	$wp_customize->add_setting('freddo_theme_options[_onepage_section_slider]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'freddo_sanitize_checkbox'
    ) );
	$wp_customize->add_control('freddo_theme_options[_onepage_section_slider]', array(
        'label'      => __( 'Display section slider', 'freddo' ),
        'section'    => 'cresta_freddo_onepage_section_slider',
        'settings'   => 'freddo_theme_options[_onepage_section_slider]',
        'type'       => 'checkbox',
		'priority' => 1,
    ) );
	/* Section ID */
	$wp_customize->add_setting('freddo_theme_options[_onepage_id_slider]', array(
        'default'    => 'slider',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field'
    ) );
	$wp_customize->add_control('freddo_theme_options[_onepage_id_slider]', array(
        'label'      => __( 'Section ID name', 'freddo' ),
		'description'	=> __( 'ID for this section - if you want the user to be able to scroll down to this section.', 'freddo' ),
        'section'    => 'cresta_freddo_onepage_section_slider',
        'settings'   => 'freddo_theme_options[_onepage_id_slider]',
		'active_callback' => 'freddo_is_slider_active',
        'type'       => 'text',
		'priority' => 2,
    ) );
	/* Effect on slider */
	$wp_customize->add_setting('freddo_theme_options[_onepage_effect_slider]', array(
        'default'    => 'withZoom',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'freddo_sanitize_select',
    ) );
	$wp_customize->add_control('freddo_theme_options[_onepage_effect_slider]', array(
        'label'      => __( 'Scroll down effect on slider', 'freddo' ),
        'section'    => 'cresta_freddo_onepage_section_slider',
        'settings'   => 'freddo_theme_options[_onepage_effect_slider]',
        'type'       => 'select',
		'active_callback' => 'freddo_is_slider_active',
		'priority' => 3,
		'choices' => array(
			'none' => __( 'No Effect', 'freddo'),
			'withZoom' => __( 'Zoom Effect', 'freddo'),
		),
    ) );
	/* Scroll down button */
	$wp_customize->add_setting('freddo_theme_options[_onepage_scrolldown_slider]', array(
        'default'    => '1',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'freddo_sanitize_checkbox'
    ) );
	$wp_customize->add_control('freddo_theme_options[_onepage_scrolldown_slider]', array(
        'label'      => __( 'Show scroll down button', 'freddo' ),
        'section'    => 'cresta_freddo_onepage_section_slider',
        'settings'   => 'freddo_theme_options[_onepage_scrolldown_slider]',
        'type'       => 'checkbox',
		'active_callback' => 'freddo_is_slider_active',
		'priority' => 4,
    ) );
	/* Scroll down text */
	$wp_customize->add_setting('freddo_theme_options[_onepage_scrolldown_text]', array(
		'default'    => __( 'Scroll Down', 'freddo' ),
		'type'       => 'option',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'transport' => 'postMessage'
	) );
	$wp_customize->add_control('freddo_theme_options[_onepage_scrolldown_text]', array(
		'label'      => __( 'Scroll Down Text ', 'freddo' ),
		'section'    => 'cresta_freddo_onepage_section_slider',
		'settings'   => 'freddo_theme_options[_onepage_scrolldown_text]',
		'type'       => 'text',
		'active_callback' => 'freddo_onepage_is_scroll_in_post',
		'priority' => 5,
	) );
	for( $number = 1; $number < FREDDO_VALUE_FOR_SLIDER; $number++ ){
		/* Slider Text */
		$wp_customize->add_setting('freddo_theme_options[_onepage_head_'.$number.'_slider]', array(
			'sanitize_callback' => 'sanitize_text_field',
			'type'       => 'option',
		));
		$wp_customize->add_control(
			new Freddo_Customize_Heading(
			$wp_customize,
			'freddo_theme_options[_onepage_head_'.$number.'_slider]',
			array(
				'settings'		=> 'freddo_theme_options[_onepage_head_'.$number.'_slider]',
				'section'		=> 'cresta_freddo_onepage_section_slider',
				'label'			=> __( 'Slider ', 'freddo' ).$number,
				'active_callback' => 'freddo_is_slider_active',
			))
		);
		/* Slide Image */
		$wp_customize->add_setting('freddo_theme_options[_onepage_image_'.$number.'_slider]', array(
			'default'    => '',
			'type'       => 'option',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'esc_url_raw'
		) );
		$wp_customize->add_control( 
			new WP_Customize_Image_Control(
			$wp_customize, 
			'freddo_theme_options[_onepage_image_'.$number.'_slider]', 
			array(
				'label'      => __( 'Slide image ', 'freddo' ).$number,
				'section'    => 'cresta_freddo_onepage_section_slider',
				'settings'   => 'freddo_theme_options[_onepage_image_'.$number.'_slider]',
				'active_callback' => 'freddo_is_slider_active',
			) ) 
		);
		/* Slide Text */
		$wp_customize->add_setting('freddo_theme_options[_onepage_text_'.$number.'_slider]', array(
			'default'    => '',
			'type'       => 'option',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'postMessage'
		) );
		$wp_customize->add_control('freddo_theme_options[_onepage_text_'.$number.'_slider]', array(
			'label'      => __( 'Slider Text ', 'freddo' ).$number,
			'section'    => 'cresta_freddo_onepage_section_slider',
			'settings'   => 'freddo_theme_options[_onepage_text_'.$number.'_slider]',
			'type'       => 'text',
			'active_callback' => 'freddo_is_slider_active',
		) );
		/* Slide Subtext */
		$wp_customize->add_setting('freddo_theme_options[_onepage_subtext_'.$number.'_slider]', array(
			'default'    => '',
			'type'       => 'option',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'postMessage'
		) );
		$wp_customize->add_control('freddo_theme_options[_onepage_subtext_'.$number.'_slider]', array(
			'label'      => __( 'Slider Subtext ', 'freddo' ).$number,
			'section'    => 'cresta_freddo_onepage_section_slider',
			'settings'   => 'freddo_theme_options[_onepage_subtext_'.$number.'_slider]',
			'type'       => 'text',
			'active_callback' => 'freddo_is_slider_active',
		) );
	}
	/* Info slider */
	$wp_customize->add_setting('freddo_theme_options[_onepage_info_slider]',array(
		'sanitize_callback' => 'sanitize_text_field',
		'type'       => 'option',
	));
	$wp_customize->add_control(
		new Freddo_Info_Text( 
		$wp_customize,
		'freddo_theme_options[_onepage_info_slider]',
		array(
			'settings'		=> 'freddo_theme_options[_onepage_info_slider]',
			'section'		=> 'cresta_freddo_onepage_section_slider',
			'label'			=> __( 'Note:', 'freddo' ),	
			'description'	=> __( 'Upload up to three sliders. Recommended image size: 1920X1080', 'freddo' ),
			'active_callback' => 'freddo_is_slider_active',
			'priority' => 18,
		))
	);
	/**
	* ################ SECTION ABOUT US
	*/
	/* Show About Us Section */
	$wp_customize->add_setting('freddo_theme_options[_onepage_section_aboutus]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'freddo_sanitize_checkbox'
    ) );
	$wp_customize->add_control('freddo_theme_options[_onepage_section_aboutus]', array(
        'label'      => __( 'Display section about us', 'freddo' ),
        'section'    => 'cresta_freddo_onepage_section_aboutus',
        'settings'   => 'freddo_theme_options[_onepage_section_aboutus]',
        'type'       => 'checkbox',
		'priority' => 1,
    ) );
	/* Section ID */
	$wp_customize->add_setting('freddo_theme_options[_onepage_id_aboutus]', array(
        'default'    => 'aboutus',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field'
    ) );
	$wp_customize->add_control('freddo_theme_options[_onepage_id_aboutus]', array(
        'label'      => __( 'Section ID name', 'freddo' ),
		'description'	=> __( 'ID for this section - if you want the user to be able to scroll down to this section.', 'freddo' ),
        'section'    => 'cresta_freddo_onepage_section_aboutus',
        'settings'   => 'freddo_theme_options[_onepage_id_aboutus]',
		'active_callback' => 'freddo_is_aboutus_active',
        'type'       => 'text',
		'priority' => 2,
    ) );
	/* Background Image About us */
	$wp_customize->add_setting('freddo_theme_options[_onepage_imgback_aboutus]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw'
    ) );
	$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
		$wp_customize, 
		'freddo_theme_options[_onepage_imgback_aboutus]', 
		array(
			'label'      => __( 'Background Image Section (optional)', 'freddo' ),
			'section'    => 'cresta_freddo_onepage_section_aboutus',
			'settings'   => 'freddo_theme_options[_onepage_imgback_aboutus]',
			'active_callback' => 'freddo_is_aboutus_active',
			'priority' => 3,
		) ) 
	);
	/* Background Color About us */
	$wp_customize->add_setting( 'freddo_theme_options[_onepage_imgcolor_aboutus]', array(
		'default' => '#f5f5f5',
		'type' => 'option', 
		'sanitize_callback' => 'sanitize_hex_color',
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
		$wp_customize,
		'freddo_theme_options[_onepage_imgcolor_aboutus]', 
		array(
			'label' => __( 'Background Color Section', 'freddo' ),
			'section' => 'cresta_freddo_onepage_section_aboutus',
			'settings' =>'freddo_theme_options[_onepage_imgcolor_aboutus]',
			'active_callback' => 'freddo_is_aboutus_active',
			'priority' => 4,
		) )
	);
	/* Text Color About us */
	$wp_customize->add_setting( 'freddo_theme_options[_onepage_textcolor_aboutus]', array(
		'default' => '#121212',
		'type' => 'option', 
		'sanitize_callback' => 'sanitize_hex_color',
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
		$wp_customize,
		'freddo_theme_options[_onepage_textcolor_aboutus]', 
		array(
			'label' => __( 'Text Color Section', 'freddo' ),
			'section' => 'cresta_freddo_onepage_section_aboutus',
			'settings' =>'freddo_theme_options[_onepage_textcolor_aboutus]',
			'active_callback' => 'freddo_is_aboutus_active',
			'priority' => 5,
		) )
	);
	/* About us title section */
	$wp_customize->add_setting('freddo_theme_options[_onepage_title_aboutus]', array(
		'default'    => __( 'About Us', 'freddo' ),
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'transport' => 'postMessage'
    ) );
	$wp_customize->add_control('freddo_theme_options[_onepage_title_aboutus]', array(
        'label'      => __( 'Title', 'freddo' ),
        'section'    => 'cresta_freddo_onepage_section_aboutus',
        'settings'   => 'freddo_theme_options[_onepage_title_aboutus]',
        'type'       => 'text',
		'active_callback' => 'freddo_is_aboutus_active',
		'priority' => 6,
    ) );
	/* About us subtitle section */
	$wp_customize->add_setting('freddo_theme_options[_onepage_subtitle_aboutus]', array(
		'default'    => __( 'Who We Are', 'freddo' ),
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'transport' => 'postMessage'
    ) );
	$wp_customize->add_control('freddo_theme_options[_onepage_subtitle_aboutus]', array(
        'label'      => __( 'Subtitle', 'freddo' ),
        'section'    => 'cresta_freddo_onepage_section_aboutus',
        'settings'   => 'freddo_theme_options[_onepage_subtitle_aboutus]',
        'type'       => 'text',
		'active_callback' => 'freddo_is_aboutus_active',
		'priority' => 7,
    ) );
	/* About us text */
	$wp_customize->add_setting('freddo_theme_options[_onepage_head_aboutus]', array(
		'sanitize_callback' => 'sanitize_text_field',
		'type'       => 'option',
	));
	$wp_customize->add_control(
		new Freddo_Customize_Heading(
		$wp_customize,
		'freddo_theme_options[_onepage_head_aboutus]',
		array(
			'settings'		=> 'freddo_theme_options[_onepage_head_aboutus]',
			'section'		=> 'cresta_freddo_onepage_section_aboutus',
			'label'			=> __( 'About us text', 'freddo' ),
			'active_callback' => 'freddo_is_aboutus_active',
			'priority' => 8,
		)
		)
	);
	/* Aboutus Dropdown pages */
	$wp_customize->add_setting('freddo_theme_options[_onepage_choosepage_aboutus]', array(
		'default'    => false,
		'type'       => 'option',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control('freddo_theme_options[_onepage_choosepage_aboutus]', array(
		'label'      => __( 'Choose the page to display', 'freddo' ),
		'description'	=> __( 'Title, content and featured image will be used in the box', 'freddo' ),
		'section'    => 'cresta_freddo_onepage_section_aboutus',
		'settings'   => 'freddo_theme_options[_onepage_choosepage_aboutus]',
		'type'       => 'dropdown-pages',
		'active_callback' => 'freddo_is_aboutus_active',
	) );
	/* About us button */
	$wp_customize->add_setting('freddo_theme_options[_onepage_headbutton_aboutus]', array(
		'sanitize_callback' => 'sanitize_text_field',
		'type'       => 'option',
	));
	$wp_customize->add_control(
		new Freddo_Customize_Heading(
		$wp_customize,
		'freddo_theme_options[_onepage_headbutton_aboutus]',
		array(
			'settings'		=> 'freddo_theme_options[_onepage_headbutton_aboutus]',
			'section'		=> 'cresta_freddo_onepage_section_aboutus',
			'label'			=> __( 'About us button', 'freddo' ),
			'active_callback' => 'freddo_is_aboutus_active',
			'priority' => 11,
		)
		)
	);
	/* About us text button */
	$wp_customize->add_setting('freddo_theme_options[_onepage_textbutton_aboutus]', array(
		'default'    => __( 'More Information', 'freddo' ),
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'transport' => 'postMessage'
    ) );
	$wp_customize->add_control('freddo_theme_options[_onepage_textbutton_aboutus]', array(
        'label'      => __( 'Text Button', 'freddo' ),
        'section'    => 'cresta_freddo_onepage_section_aboutus',
        'settings'   => 'freddo_theme_options[_onepage_textbutton_aboutus]',
        'type'       => 'text',
		'active_callback' => 'freddo_is_aboutus_active',
		'priority' => 12,
    ) );
	/* About us link button */
	$wp_customize->add_setting('freddo_theme_options[_onepage_linkbutton_aboutus]', array(
        'default'    => '#',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw'
    ) );
	$wp_customize->add_control('freddo_theme_options[_onepage_linkbutton_aboutus]', array(
        'label'      => __( 'Link Button', 'freddo' ),
        'section'    => 'cresta_freddo_onepage_section_aboutus',
        'settings'   => 'freddo_theme_options[_onepage_linkbutton_aboutus]',
        'type'       => 'url',
		'active_callback' => 'freddo_is_aboutus_active',
		'priority' => 13,
    ) );
	/**
	* ################ SECTION FEATURES
	*/
	/* Show Features Section */
	$wp_customize->add_setting('freddo_theme_options[_onepage_section_features]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'freddo_sanitize_checkbox'
    ) );
	$wp_customize->add_control('freddo_theme_options[_onepage_section_features]', array(
        'label'      => __( 'Display section features', 'freddo' ),
        'section'    => 'cresta_freddo_onepage_section_features',
        'settings'   => 'freddo_theme_options[_onepage_section_features]',
        'type'       => 'checkbox',
		'priority' => 1,
    ) );
	/* Section ID */
	$wp_customize->add_setting('freddo_theme_options[_onepage_id_features]', array(
        'default'    => 'features',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field'
    ) );
	$wp_customize->add_control('freddo_theme_options[_onepage_id_features]', array(
        'label'      => __( 'Section ID name', 'freddo' ),
		'description'	=> __( 'ID for this section - if you want the user to be able to scroll down to this section.', 'freddo' ),
        'section'    => 'cresta_freddo_onepage_section_features',
        'settings'   => 'freddo_theme_options[_onepage_id_features]',
		'active_callback' => 'freddo_is_features_active',
        'type'       => 'text',
		'priority' => 2,
    ) );
	/* Background Image Features */
	$wp_customize->add_setting('freddo_theme_options[_onepage_imgback_features]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw'
    ) );
	$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
		$wp_customize, 
		'freddo_theme_options[_onepage_imgback_features]', 
		array(
			'label'      => __( 'Background Image Section (optional)', 'freddo' ),
			'section'    => 'cresta_freddo_onepage_section_features',
			'settings'   => 'freddo_theme_options[_onepage_imgback_features]',
			'active_callback' => 'freddo_is_features_active',
			'priority' => 3,
		) ) 
	);
	/* Background Color Features */
	$wp_customize->add_setting( 'freddo_theme_options[_onepage_imgcolor_features]', array(
		'default' => '#121212',
		'type' => 'option', 
		'sanitize_callback' => 'sanitize_hex_color',
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
		$wp_customize,
		'freddo_theme_options[_onepage_imgcolor_features]', 
		array(
			'label' => __( 'Background Color Section', 'freddo' ),
			'section' => 'cresta_freddo_onepage_section_features',
			'settings' =>'freddo_theme_options[_onepage_imgcolor_features]',
			'active_callback' => 'freddo_is_features_active',
			'priority' => 4,
		) )
	);
	/* Text Color Features */
	$wp_customize->add_setting( 'freddo_theme_options[_onepage_textcolor_features]', array(
		'default' => '#f5f5f5',
		'type' => 'option', 
		'sanitize_callback' => 'sanitize_hex_color',
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
		$wp_customize,
		'freddo_theme_options[_onepage_textcolor_features]', 
		array(
			'label' => __( 'Text Color Section', 'freddo' ),
			'section' => 'cresta_freddo_onepage_section_features',
			'settings' =>'freddo_theme_options[_onepage_textcolor_features]',
			'active_callback' => 'freddo_is_features_active',
			'priority' => 5,
		) )
	);
	/* Features title section */
	$wp_customize->add_setting('freddo_theme_options[_onepage_title_features]', array(
		'default'    => __( 'Elements', 'freddo' ),
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'transport' => 'postMessage'
    ) );
	$wp_customize->add_control('freddo_theme_options[_onepage_title_features]', array(
        'label'      => __( 'Title', 'freddo' ),
        'section'    => 'cresta_freddo_onepage_section_features',
        'settings'   => 'freddo_theme_options[_onepage_title_features]',
        'type'       => 'text',
		'active_callback' => 'freddo_is_features_active',
		'priority' => 6,
    ) );
	/* Features subtitle section */
	$wp_customize->add_setting('freddo_theme_options[_onepage_subtitle_features]', array(
		'default'    => __( 'Amazing Features', 'freddo' ),
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'transport' => 'postMessage'
    ) );
	$wp_customize->add_control('freddo_theme_options[_onepage_subtitle_features]', array(
        'label'      => __( 'Subtitle', 'freddo' ),
        'section'    => 'cresta_freddo_onepage_section_features',
        'settings'   => 'freddo_theme_options[_onepage_subtitle_features]',
        'type'       => 'text',
		'active_callback' => 'freddo_is_features_active',
		'priority' => 7,
    ) );
	/* How many boxes to display */
	$wp_customize->add_setting('freddo_theme_options[_onepage_manybox_features]', array(
        'default'    => '3',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'freddo_sanitize_select',
    ) );
	$wp_customize->add_control('freddo_theme_options[_onepage_manybox_features]', array(
        'label'      => __( 'How many boxes to display', 'freddo' ),
        'section'    => 'cresta_freddo_onepage_section_features',
        'settings'   => 'freddo_theme_options[_onepage_manybox_features]',
        'type'       => 'select',
		'active_callback' => 'freddo_is_features_active',
		'priority' => 8,
		'choices' => array(
			'1' => __( '1', 'freddo'),
			'2' => __( '2', 'freddo'),
			'3' => __( '3', 'freddo'),
			'4' => __( '4', 'freddo'),
		),
    ) );
	/* Text lenght for boxes */
	$wp_customize->add_setting('freddo_theme_options[_onepage_lenght_features]', array(
        'default'    => '20',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'absint',
    ) );
	$wp_customize->add_control('freddo_theme_options[_onepage_lenght_features]', array(
        'label'      => __( 'Text lenght for boxes content (number of words)', 'freddo' ),
        'section'    => 'cresta_freddo_onepage_section_features',
        'settings'   => 'freddo_theme_options[_onepage_lenght_features]',
        'type'       => 'number',
		'active_callback' => 'freddo_is_features_active',
		'priority' => 9,
    ) );
	for( $number = 1; $number < FREDDO_VALUE_FOR_FEATURES; $number++ ){
		/* Box Title Description */
		$wp_customize->add_setting('freddo_theme_options[_onepage_head_'.$number.'_features]', array(
			'sanitize_callback' => 'sanitize_text_field',
			'type'       => 'option',
		));
		$wp_customize->add_control(
			new Freddo_Customize_Heading(
			$wp_customize,
			'freddo_theme_options[_onepage_head_'.$number.'_features]',
			array(
				'settings'		=> 'freddo_theme_options[_onepage_head_'.$number.'_features]',
				'section'		=> 'cresta_freddo_onepage_section_features',
				'label'			=> __( 'Box number ', 'freddo' ).$number,
				'active_callback' => 'freddo_is_features_active',
			))
		);
		/* FontAwesome Icon */
		$wp_customize->add_setting('freddo_theme_options[_onepage_fontawesome_'.$number.'_features]', array(
			'default'			=> 'fa fa-bell',
			'sanitize_callback' => 'sanitize_text_field',
			'type'       => 'option',
		));
		$wp_customize->add_control(
			new Freddo_Fontawesome_Icon(
			$wp_customize,
			'freddo_theme_options[_onepage_fontawesome_'.$number.'_features]',
			array(
				'settings'		=> 'freddo_theme_options[_onepage_fontawesome_'.$number.'_features]',
				'section'		=> 'cresta_freddo_onepage_section_features',
				'label'			=> __( 'FontAwesome Icon', 'freddo' ),
				'type'       => 'icon',
				'active_callback' => 'freddo_is_features_active',
			))
		);
		/* Features Dropdown pages */
		$wp_customize->add_setting('freddo_theme_options[_onepage_choosepage_'.$number.'_features]', array(
			'default'    => false,
			'type'       => 'option',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'absint',
		) );
		$wp_customize->add_control('freddo_theme_options[_onepage_choosepage_'.$number.'_features]', array(
			'label'      => __( 'Choose the page to display', 'freddo' ),
			'description'	=> __( 'Title and content (unformatted) will be used in the box', 'freddo' ),
			'section'    => 'cresta_freddo_onepage_section_features',
			'settings'   => 'freddo_theme_options[_onepage_choosepage_'.$number.'_features]',
			'type'       => 'dropdown-pages',
			'active_callback' => 'freddo_is_features_active',
		) );
		/* Features text button */
		$wp_customize->add_setting('freddo_theme_options[_onepage_boxtextbutton_'.$number.'_features]', array(
			'default'    => __( 'More Information', 'freddo' ),
			'type'       => 'option',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'postMessage'
		) );
		$wp_customize->add_control('freddo_theme_options[_onepage_boxtextbutton_'.$number.'_features]', array(
			'label'      => __( 'Text Button ', 'freddo' ).$number,
			'section'    => 'cresta_freddo_onepage_section_features',
			'settings'   => 'freddo_theme_options[_onepage_boxtextbutton_'.$number.'_features]',
			'type'       => 'text',
			'active_callback' => 'freddo_is_features_active',
		) );
		/* Features link button */
		$wp_customize->add_setting('freddo_theme_options[_onepage_boxlinkbutton_'.$number.'_features]', array(
			'default'    => '#',
			'type'       => 'option',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'esc_url_raw'
		) );
		$wp_customize->add_control('freddo_theme_options[_onepage_boxlinkbutton_'.$number.'_features]', array(
			'label'      => __( 'Link Button ', 'freddo' ).$number,
			'section'    => 'cresta_freddo_onepage_section_features',
			'settings'   => 'freddo_theme_options[_onepage_boxlinkbutton_'.$number.'_features]',
			'type'       => 'url',
			'active_callback' => 'freddo_is_features_active',
		) );
	}
	/**
	* ################ SECTION SKILLS
	*/
	/* Show Skills Section */
	$wp_customize->add_setting('freddo_theme_options[_onepage_section_skills]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'freddo_sanitize_checkbox'
    ) );
	$wp_customize->add_control('freddo_theme_options[_onepage_section_skills]', array(
        'label'      => __( 'Display section skills', 'freddo' ),
        'section'    => 'cresta_freddo_onepage_section_skills',
        'settings'   => 'freddo_theme_options[_onepage_section_skills]',
        'type'       => 'checkbox',
		'priority' => 1,
    ) );
	/* Section ID */
	$wp_customize->add_setting('freddo_theme_options[_onepage_id_skills]', array(
        'default'    => 'skills',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field'
    ) );
	$wp_customize->add_control('freddo_theme_options[_onepage_id_skills]', array(
        'label'      => __( 'Section ID name', 'freddo' ),
		'description'	=> __( 'ID for this section - if you want the user to be able to scroll down to this section.', 'freddo' ),
        'section'    => 'cresta_freddo_onepage_section_skills',
        'settings'   => 'freddo_theme_options[_onepage_id_skills]',
		'active_callback' => 'freddo_is_skills_active',
        'type'       => 'text',
		'priority' => 2,
    ) );
	/* Background Image Skills */
	$wp_customize->add_setting('freddo_theme_options[_onepage_imgback_skills]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw'
    ) );
	$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
		$wp_customize, 
		'freddo_theme_options[_onepage_imgback_skills]', 
		array(
			'label'      => __( 'Background Image Section (optional)', 'freddo' ),
			'section'    => 'cresta_freddo_onepage_section_skills',
			'settings'   => 'freddo_theme_options[_onepage_imgback_skills]',
			'active_callback' => 'freddo_is_skills_active',
			'priority' => 3,
		) ) 
	);
	/* Background Color Features */
	$wp_customize->add_setting( 'freddo_theme_options[_onepage_imgcolor_skills]', array(
		'default' => '#f5f5f5',
		'type' => 'option', 
		'sanitize_callback' => 'sanitize_hex_color',
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
		$wp_customize,
		'freddo_theme_options[_onepage_imgcolor_skills]', 
		array(
			'label' => __( 'Background Color Section', 'freddo' ),
			'section' => 'cresta_freddo_onepage_section_skills',
			'settings' =>'freddo_theme_options[_onepage_imgcolor_skills]',
			'active_callback' => 'freddo_is_skills_active',
			'priority' => 4,
		) )
	);
	/* Text Color Features */
	$wp_customize->add_setting( 'freddo_theme_options[_onepage_textcolor_skills]', array(
		'default' => '#121212',
		'type' => 'option', 
		'sanitize_callback' => 'sanitize_hex_color',
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
		$wp_customize,
		'freddo_theme_options[_onepage_textcolor_skills]', 
		array(
			'label' => __( 'Text Color Section', 'freddo' ),
			'section' => 'cresta_freddo_onepage_section_skills',
			'settings' =>'freddo_theme_options[_onepage_textcolor_skills]',
			'active_callback' => 'freddo_is_skills_active',
			'priority' => 5,
		) )
	);
	/* Features title section */
	$wp_customize->add_setting('freddo_theme_options[_onepage_title_skills]', array(
		'default'    => __( 'Our Skills', 'freddo' ),
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'transport' => 'postMessage'
    ) );
	$wp_customize->add_control('freddo_theme_options[_onepage_title_skills]', array(
        'label'      => __( 'Title', 'freddo' ),
        'section'    => 'cresta_freddo_onepage_section_skills',
        'settings'   => 'freddo_theme_options[_onepage_title_skills]',
        'type'       => 'text',
		'active_callback' => 'freddo_is_skills_active',
		'priority' => 6,
    ) );
	/* Features subtitle section */
	$wp_customize->add_setting('freddo_theme_options[_onepage_subtitle_skills]', array(
		'default'    => __( 'What We Do', 'freddo' ),
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'transport' => 'postMessage'
    ) );
	$wp_customize->add_control('freddo_theme_options[_onepage_subtitle_skills]', array(
        'label'      => __( 'Subtitle', 'freddo' ),
        'section'    => 'cresta_freddo_onepage_section_skills',
        'settings'   => 'freddo_theme_options[_onepage_subtitle_skills]',
        'type'       => 'text',
		'active_callback' => 'freddo_is_skills_active',
		'priority' => 7,
    ) );
	for( $number = 1; $number < FREDDO_VALUE_FOR_SKILLS; $number++ ){
		/* Box Title Description */
		$wp_customize->add_setting('freddo_theme_options[_onepage_head_'.$number.'_skills]', array(
			'sanitize_callback' => 'sanitize_text_field',
			'type'       => 'option',
		));
		$wp_customize->add_control(
			new Freddo_Customize_Heading(
			$wp_customize,
			'freddo_theme_options[_onepage_head_'.$number.'_skills]',
			array(
				'settings'		=> 'freddo_theme_options[_onepage_head_'.$number.'_skills]',
				'section'		=> 'cresta_freddo_onepage_section_skills',
				'label'			=> __( 'Skill number ', 'freddo' ).$number,
				'active_callback' => 'freddo_is_skills_active',
			))
		);
		/* Skill Name */
		$wp_customize->add_setting('freddo_theme_options[_onepage_skillname_'.$number.'_skills]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field'
		) );
		$wp_customize->add_control('freddo_theme_options[_onepage_skillname_'.$number.'_skills]', array(
			'label'      => __( 'Skill name', 'freddo' ),
			'section'    => 'cresta_freddo_onepage_section_skills',
			'settings'   => 'freddo_theme_options[_onepage_skillname_'.$number.'_skills]',
			'active_callback' => 'freddo_is_skills_active',
			'type'       => 'text',
		) );
		/* Skill Value */
		$wp_customize->add_setting('freddo_theme_options[_onepage_skillvalue_'.$number.'_skills]', array(
			'default'    => '0',
			'type'       => 'option',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'absint'
		) );
		$wp_customize->add_control('freddo_theme_options[_onepage_skillvalue_'.$number.'_skills]', array(
			'label'      => __( 'Skill value', 'freddo' ),
			'description'	=> __( 'Enter a value between 0 and 100', 'freddo' ),
			'section'    => 'cresta_freddo_onepage_section_skills',
			'settings'   => 'freddo_theme_options[_onepage_skillvalue_'.$number.'_skills]',
			'active_callback' => 'freddo_is_skills_active',
			'type'       => 'number',
		) );
	}
	/**
	* ################ SECTION CALL TO ACTION
	*/
	/* Show Cta Section */
	$wp_customize->add_setting('freddo_theme_options[_onepage_section_cta]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'freddo_sanitize_checkbox'
    ) );
	$wp_customize->add_control('freddo_theme_options[_onepage_section_cta]', array(
        'label'      => __( 'Display section call to action', 'freddo' ),
        'section'    => 'cresta_freddo_onepage_section_cta',
        'settings'   => 'freddo_theme_options[_onepage_section_cta]',
        'type'       => 'checkbox',
		'priority' => 1,
    ) );
	/* Section ID */
	$wp_customize->add_setting('freddo_theme_options[_onepage_id_cta]', array(
        'default'    => 'cta',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field'
    ) );
	$wp_customize->add_control('freddo_theme_options[_onepage_id_cta]', array(
        'label'      => __( 'Section ID name', 'freddo' ),
		'description'	=> __( 'ID for this section - if you want the user to be able to scroll down to this section.', 'freddo' ),
        'section'    => 'cresta_freddo_onepage_section_cta',
        'settings'   => 'freddo_theme_options[_onepage_id_cta]',
		'active_callback' => 'freddo_is_cta_active',
        'type'       => 'text',
		'priority' => 2,
    ) );
	/* Background Image Cta */
	$wp_customize->add_setting('freddo_theme_options[_onepage_imgback_cta]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw'
    ) );
	$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
		$wp_customize, 
		'freddo_theme_options[_onepage_imgback_cta]', 
		array(
			'label'      => __( 'Background Image Section (optional)', 'freddo' ),
			'section'    => 'cresta_freddo_onepage_section_cta',
			'settings'   => 'freddo_theme_options[_onepage_imgback_cta]',
			'active_callback' => 'freddo_is_cta_active',
			'priority' => 3,
		) ) 
	);
	/* Background Color Cta */
	$wp_customize->add_setting( 'freddo_theme_options[_onepage_imgcolor_cta]', array(
		'default' => '#121212',
		'type' => 'option', 
		'sanitize_callback' => 'sanitize_hex_color',
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
		$wp_customize,
		'freddo_theme_options[_onepage_imgcolor_cta]', 
		array(
			'label' => __( 'Background Color Section', 'freddo' ),
			'section' => 'cresta_freddo_onepage_section_cta',
			'settings' =>'freddo_theme_options[_onepage_imgcolor_cta]',
			'active_callback' => 'freddo_is_cta_active',
			'priority' => 4,
		) )
	);
	/* Text Color Cta */
	$wp_customize->add_setting( 'freddo_theme_options[_onepage_textcolor_cta]', array(
		'default' => '#f5f5f5',
		'type' => 'option', 
		'sanitize_callback' => 'sanitize_hex_color',
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
		$wp_customize,
		'freddo_theme_options[_onepage_textcolor_cta]', 
		array(
			'label' => __( 'Text Color Section', 'freddo' ),
			'section' => 'cresta_freddo_onepage_section_cta',
			'settings' =>'freddo_theme_options[_onepage_textcolor_cta]',
			'active_callback' => 'freddo_is_cta_active',
			'priority' => 5,
		) )
	);
	/* FontAwesome Icon */
	$wp_customize->add_setting('freddo_theme_options[_onepage_fontawesome_cta]', array(
		'default'			=> 'fa fa-flash',
		'sanitize_callback' => 'sanitize_text_field',
		'type' => 'option', 
	));
	$wp_customize->add_control(
		new Freddo_Fontawesome_Icon(
		$wp_customize,
		'freddo_theme_options[_onepage_fontawesome_cta]',
		array(
			'settings'		=> 'freddo_theme_options[_onepage_fontawesome_cta]',
			'section'		=> 'cresta_freddo_onepage_section_cta',
			'label'			=> __( 'FontAwesome Icon', 'freddo' ),
			'type'       => 'icon',
			'active_callback' => 'freddo_is_cta_active',
			'priority' => 6,
		))
	);
	/* Call to action phrase */
	$wp_customize->add_setting('freddo_theme_options[_onepage_phrase_cta]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'transport' => 'postMessage'
    ) );
	$wp_customize->add_control('freddo_theme_options[_onepage_phrase_cta]', array(
        'label'      => __( 'Call to action phrase', 'freddo' ),
        'section'    => 'cresta_freddo_onepage_section_cta',
        'settings'   => 'freddo_theme_options[_onepage_phrase_cta]',
		'active_callback' => 'freddo_is_cta_active',
        'type'       => 'text',
		'priority' => 7,
    ) );
	/* Call to action description */
	$wp_customize->add_setting('freddo_theme_options[_onepage_desc_cta]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'transport' => 'postMessage'
    ) );
	$wp_customize->add_control('freddo_theme_options[_onepage_desc_cta]', array(
        'label'      => __( 'Call to action description', 'freddo' ),
        'section'    => 'cresta_freddo_onepage_section_cta',
        'settings'   => 'freddo_theme_options[_onepage_desc_cta]',
		'active_callback' => 'freddo_is_cta_active',
        'type'       => 'text',
		'priority' => 8,
    ) );
	/* Call to action text button */
	$wp_customize->add_setting('freddo_theme_options[_onepage_textbutton_cta]', array(
		'default'    => __( 'More Information', 'freddo' ),
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field'
    ) );
	$wp_customize->add_control('freddo_theme_options[_onepage_textbutton_cta]', array(
        'label'      => __( 'Text Button', 'freddo' ),
        'section'    => 'cresta_freddo_onepage_section_cta',
        'settings'   => 'freddo_theme_options[_onepage_textbutton_cta]',
        'type'       => 'text',
		'active_callback' => 'freddo_is_cta_active',
		'priority' => 9,
    ) );
	/* Call to action link button */
	$wp_customize->add_setting('freddo_theme_options[_onepage_urlbutton_cta]', array(
        'default'    => '#',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw'
    ) );
	$wp_customize->add_control('freddo_theme_options[_onepage_urlbutton_cta]', array(
        'label'      => __( 'Link Button', 'freddo' ),
        'section'    => 'cresta_freddo_onepage_section_cta',
        'settings'   => 'freddo_theme_options[_onepage_urlbutton_cta]',
        'type'       => 'url',
		'active_callback' => 'freddo_is_cta_active',
		'priority' => 10,
    ) );
	/* Open the link in */
	$wp_customize->add_setting('freddo_theme_options[_onepage_openurl_cta]', array(
        'default'    => '_blank',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'freddo_sanitize_select',
    ) );
	$wp_customize->add_control('freddo_theme_options[_onepage_openurl_cta]', array(
        'label'      => __( 'Open the link in', 'freddo' ),
        'section'    => 'cresta_freddo_onepage_section_cta',
        'settings'   => 'freddo_theme_options[_onepage_openurl_cta]',
        'type'       => 'select',
		'active_callback' => 'freddo_is_cta_active',
		'priority' => 11,
		'choices' => array(
			'_self' => __( 'Same window', 'freddo'),
			'_blank' => __( 'New window', 'freddo'),
		),
    ) );
	/**
	* ################ SECTION SERVICES
	*/
	/* Show Services Section */
	$wp_customize->add_setting('freddo_theme_options[_onepage_section_services]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'freddo_sanitize_checkbox'
    ) );
	$wp_customize->add_control('freddo_theme_options[_onepage_section_services]', array(
        'label'      => __( 'Display section services', 'freddo' ),
        'section'    => 'cresta_freddo_onepage_section_services',
        'settings'   => 'freddo_theme_options[_onepage_section_services]',
        'type'       => 'checkbox',
		'priority' => 1,
    ) );
	/* Section ID */
	$wp_customize->add_setting('freddo_theme_options[_onepage_id_services]', array(
        'default'    => 'services',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field'
    ) );
	$wp_customize->add_control('freddo_theme_options[_onepage_id_services]', array(
        'label'      => __( 'Section ID name', 'freddo' ),
		'description'	=> __( 'ID for this section - if you want the user to be able to scroll down to this section.', 'freddo' ),
        'section'    => 'cresta_freddo_onepage_section_services',
        'settings'   => 'freddo_theme_options[_onepage_id_services]',
		'active_callback' => 'freddo_is_services_active',
        'type'       => 'text',
		'priority' => 2,
    ) );
	/* Background Image Services */
	$wp_customize->add_setting('freddo_theme_options[_onepage_imgback_services]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw'
    ) );
	$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
		$wp_customize, 
		'freddo_theme_options[_onepage_imgback_services]', 
		array(
			'label'      => __( 'Background Image Section (optional)', 'freddo' ),
			'section'    => 'cresta_freddo_onepage_section_services',
			'settings'   => 'freddo_theme_options[_onepage_imgback_services]',
			'active_callback' => 'freddo_is_services_active',
			'priority' => 3,
		) ) 
	);
	/* Background Color Services */
	$wp_customize->add_setting( 'freddo_theme_options[_onepage_imgcolor_services]', array(
		'default' => '#f5f5f5',
		'type' => 'option', 
		'sanitize_callback' => 'sanitize_hex_color',
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
		$wp_customize,
		'freddo_theme_options[_onepage_imgcolor_services]', 
		array(
			'label' => __( 'Background Color Section', 'freddo' ),
			'section' => 'cresta_freddo_onepage_section_services',
			'settings' =>'freddo_theme_options[_onepage_imgcolor_services]',
			'active_callback' => 'freddo_is_services_active',
			'priority' => 4,
		) )
	);
	/* Text Color Services */
	$wp_customize->add_setting( 'freddo_theme_options[_onepage_textcolor_services]', array(
		'default' => '#121212',
		'type' => 'option', 
		'sanitize_callback' => 'sanitize_hex_color',
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
		$wp_customize,
		'freddo_theme_options[_onepage_textcolor_services]', 
		array(
			'label' => __( 'Text Color Section', 'freddo' ),
			'section' => 'cresta_freddo_onepage_section_services',
			'settings' =>'freddo_theme_options[_onepage_textcolor_services]',
			'active_callback' => 'freddo_is_services_active',
			'priority' => 5,
		) )
	);
	/* Services title section */
	$wp_customize->add_setting('freddo_theme_options[_onepage_title_services]', array(
		'default'    => __( 'Services', 'freddo' ),
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'transport' => 'postMessage'
    ) );
	$wp_customize->add_control('freddo_theme_options[_onepage_title_services]', array(
        'label'      => __( 'Title', 'freddo' ),
        'section'    => 'cresta_freddo_onepage_section_services',
        'settings'   => 'freddo_theme_options[_onepage_title_services]',
        'type'       => 'text',
		'active_callback' => 'freddo_is_services_active',
		'priority' => 6,
    ) );
	/* Services subtitle section */
	$wp_customize->add_setting('freddo_theme_options[_onepage_subtitle_services]', array(
		'default'    => __( 'What We Offer', 'freddo' ),
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'transport' => 'postMessage'
    ) );
	$wp_customize->add_control('freddo_theme_options[_onepage_subtitle_services]', array(
        'label'      => __( 'Subtitle', 'freddo' ),
        'section'    => 'cresta_freddo_onepage_section_services',
        'settings'   => 'freddo_theme_options[_onepage_subtitle_services]',
        'type'       => 'text',
		'active_callback' => 'freddo_is_services_active',
		'priority' => 7,
    ) );
	/* Text lenght for services */
	$wp_customize->add_setting('freddo_theme_options[_onepage_lenght_services]', array(
        'default'    => '30',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'absint',
    ) );
	$wp_customize->add_control('freddo_theme_options[_onepage_lenght_services]', array(
        'label'      => __( 'Text lenght for boxes content (number of words)', 'freddo' ),
        'section'    => 'cresta_freddo_onepage_section_services',
        'settings'   => 'freddo_theme_options[_onepage_lenght_services]',
        'type'       => 'number',
		'active_callback' => 'freddo_is_services_active',
		'priority' => 9,
    ) );
	for( $number = 1; $number < FREDDO_VALUE_FOR_SERVICES; $number++ ){
		/* Box Title Description */
		$wp_customize->add_setting('freddo_theme_options[_onepage_head_'.$number.'_services]', array(
			'sanitize_callback' => 'sanitize_text_field',
			'type'       => 'option',
		));
		$wp_customize->add_control(
			new Freddo_Customize_Heading(
			$wp_customize,
			'freddo_theme_options[_onepage_head_'.$number.'_services]',
			array(
				'settings'		=> 'freddo_theme_options[_onepage_head_'.$number.'_services]',
				'section'		=> 'cresta_freddo_onepage_section_services',
				'label'			=> __( 'Service number ', 'freddo' ).$number,
				'active_callback' => 'freddo_is_services_active',
			))
		);
		/* FontAwesome Icon */
		$wp_customize->add_setting('freddo_theme_options[_onepage_fontawesome_'.$number.'_services]', array(
			'default'			=> 'fa fa-bell',
			'sanitize_callback' => 'sanitize_text_field',
			'type'       => 'option',
		));
		$wp_customize->add_control(
			new Freddo_Fontawesome_Icon(
			$wp_customize,
			'freddo_theme_options[_onepage_fontawesome_'.$number.'_services]',
			array(
				'settings'		=> 'freddo_theme_options[_onepage_fontawesome_'.$number.'_services]',
				'section'		=> 'cresta_freddo_onepage_section_services',
				'label'			=> __( 'FontAwesome Icon', 'freddo' ),
				'type'       => 'icon',
				'active_callback' => 'freddo_is_services_active',
			))
		);
		/* Services Dropdown pages */
		$wp_customize->add_setting('freddo_theme_options[_onepage_choosepage_'.$number.'_services]', array(
			'default'    => false,
			'type'       => 'option',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'absint',
		) );
		$wp_customize->add_control('freddo_theme_options[_onepage_choosepage_'.$number.'_services]', array(
			'label'      => __( 'Choose the page to display', 'freddo' ),
			'description'	=> __( 'Title and content (unformatted) will be used in the box', 'freddo' ),
			'section'    => 'cresta_freddo_onepage_section_services',
			'settings'   => 'freddo_theme_options[_onepage_choosepage_'.$number.'_services]',
			'type'       => 'dropdown-pages',
			'active_callback' => 'freddo_is_services_active',
		) );
	}
	/* Services text */
	$wp_customize->add_setting('freddo_theme_options[_onepage_headtext_services]', array(
		'sanitize_callback' => 'sanitize_text_field',
		'type'       => 'option',
	));
	$wp_customize->add_control(
		new Freddo_Customize_Heading(
		$wp_customize,
		'freddo_theme_options[_onepage_headtext_services]',
		array(
			'settings'		=> 'freddo_theme_options[_onepage_headtext_services]',
			'section'		=> 'cresta_freddo_onepage_section_services',
			'label'			=> __( 'Services text', 'freddo' ),
			'active_callback' => 'freddo_is_services_active',
			'priority' => 15,
		))
	);
	/* Services phrase section */
	$wp_customize->add_setting('freddo_theme_options[_onepage_phrase_services]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'transport' => 'postMessage'
    ) );
	$wp_customize->add_control('freddo_theme_options[_onepage_phrase_services]', array(
        'label'      => __( 'Phrase', 'freddo' ),
        'section'    => 'cresta_freddo_onepage_section_services',
        'settings'   => 'freddo_theme_options[_onepage_phrase_services]',
        'type'       => 'text',
		'active_callback' => 'freddo_is_services_active',
		'priority' => 16,
    ) );
	/* Services textarea section */
	$wp_customize->add_setting('freddo_theme_options[_onepage_textarea_services]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'freddo_sanitize_text',
		'transport' => 'postMessage'
    ) );
	$wp_customize->add_control('freddo_theme_options[_onepage_textarea_services]', array(
        'label'      => __( 'Textarea', 'freddo' ),
        'section'    => 'cresta_freddo_onepage_section_services',
        'settings'   => 'freddo_theme_options[_onepage_textarea_services]',
        'type'       => 'textarea',
		'active_callback' => 'freddo_is_services_active',
		'priority' => 17,
    ) );
	/* Services image */
	$wp_customize->add_setting('freddo_theme_options[_onepage_headimage_services]', array(
		'sanitize_callback' => 'sanitize_text_field',
		'type'       => 'option',
	));
	$wp_customize->add_control(
		new Freddo_Customize_Heading(
		$wp_customize,
		'freddo_theme_options[_onepage_headimage_services]',
		array(
			'settings'		=> 'freddo_theme_options[_onepage_headimage_services]',
			'section'		=> 'cresta_freddo_onepage_section_services',
			'label'			=> __( 'Services image', 'freddo' ),
			'active_callback' => 'freddo_is_services_active',
			'priority' => 18,
		)
		)
	);
	/* Upload Image Services */
	$wp_customize->add_setting('freddo_theme_options[_onepage_servimage_services]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw'
    ) );
	$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
		$wp_customize, 
		'freddo_theme_options[_onepage_servimage_services]', 
		array(
			'label'      => __( 'Upload Image', 'freddo' ),
			'description'	=> __( 'Recommended image size: 1000X600px.', 'freddo' ),
			'section'    => 'cresta_freddo_onepage_section_services',
			'settings'   => 'freddo_theme_options[_onepage_servimage_services]',
			'active_callback' => 'freddo_is_services_active',
			'priority' => 19,
		) ) 
	);
	/**
	* ################ SECTION BLOG
	*/
	/* Show Blog Section */
	$wp_customize->add_setting('freddo_theme_options[_onepage_section_blog]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'freddo_sanitize_checkbox'
    ) );
	$wp_customize->add_control('freddo_theme_options[_onepage_section_blog]', array(
        'label'      => __( 'Display section blog', 'freddo' ),
        'section'    => 'cresta_freddo_onepage_section_blog',
        'settings'   => 'freddo_theme_options[_onepage_section_blog]',
        'type'       => 'checkbox',
		'priority' => 1,
    ) );
	/* Section ID */
	$wp_customize->add_setting('freddo_theme_options[_onepage_id_blog]', array(
        'default'    => 'blog',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field'
    ) );
	$wp_customize->add_control('freddo_theme_options[_onepage_id_blog]', array(
        'label'      => __( 'Section ID name', 'freddo' ),
		'description'	=> __( 'ID for this section - if you want the user to be able to scroll down to this section.', 'freddo' ),
        'section'    => 'cresta_freddo_onepage_section_blog',
        'settings'   => 'freddo_theme_options[_onepage_id_blog]',
		'active_callback' => 'freddo_is_blog_active',
        'type'       => 'text',
		'priority' => 2,
    ) );
	/* Background Image Blog */
	$wp_customize->add_setting('freddo_theme_options[_onepage_imgback_blog]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw'
    ) );
	$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
		$wp_customize, 
		'freddo_theme_options[_onepage_imgback_blog]', 
		array(
			'label'      => __( 'Background Image Section (optional)', 'freddo' ),
			'section'    => 'cresta_freddo_onepage_section_blog',
			'settings'   => 'freddo_theme_options[_onepage_imgback_blog]',
			'active_callback' => 'freddo_is_blog_active',
			'priority' => 3,
		) ) 
	);
	/* Background Color Blog */
	$wp_customize->add_setting( 'freddo_theme_options[_onepage_imgcolor_blog]', array(
		'default' => '#f5f5f5',
		'type' => 'option', 
		'sanitize_callback' => 'sanitize_hex_color',
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
		$wp_customize,
		'freddo_theme_options[_onepage_imgcolor_blog]', 
		array(
			'label' => __( 'Background Color Section', 'freddo' ),
			'section' => 'cresta_freddo_onepage_section_blog',
			'settings' =>'freddo_theme_options[_onepage_imgcolor_blog]',
			'active_callback' => 'freddo_is_blog_active',
			'priority' => 4,
		) )
	);
	/* Text Color Blog */
	$wp_customize->add_setting( 'freddo_theme_options[_onepage_textcolor_blog]', array(
		'default' => '#121212',
		'type' => 'option', 
		'sanitize_callback' => 'sanitize_hex_color',
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
		$wp_customize,
		'freddo_theme_options[_onepage_textcolor_blog]', 
		array(
			'label' => __( 'Text Color Section', 'freddo' ),
			'section' => 'cresta_freddo_onepage_section_blog',
			'settings' =>'freddo_theme_options[_onepage_textcolor_blog]',
			'active_callback' => 'freddo_is_blog_active',
			'priority' => 5,
		) )
	);
	/* Blog title section */
	$wp_customize->add_setting('freddo_theme_options[_onepage_title_blog]', array(
		'default'    => __( 'News', 'freddo' ),
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'transport' => 'postMessage'
    ) );
	$wp_customize->add_control('freddo_theme_options[_onepage_title_blog]', array(
        'label'      => __( 'Title', 'freddo' ),
        'section'    => 'cresta_freddo_onepage_section_blog',
        'settings'   => 'freddo_theme_options[_onepage_title_blog]',
        'type'       => 'text',
		'active_callback' => 'freddo_is_blog_active',
		'priority' => 6,
    ) );
	/* Blog subtitle section */
	$wp_customize->add_setting('freddo_theme_options[_onepage_subtitle_blog]', array(
		'default'    => __( 'Latest Posts', 'freddo' ),
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'transport' => 'postMessage'
    ) );
	$wp_customize->add_control('freddo_theme_options[_onepage_subtitle_blog]', array(
        'label'      => __( 'Subtitle', 'freddo' ),
        'section'    => 'cresta_freddo_onepage_section_blog',
        'settings'   => 'freddo_theme_options[_onepage_subtitle_blog]',
        'type'       => 'text',
		'active_callback' => 'freddo_is_blog_active',
		'priority' => 7,
    ) );
	/* Number of posts to show */
	$wp_customize->add_setting('freddo_theme_options[_onepage_noposts_blog]', array(
		'default'    => '3',
		'type'       => 'option',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'absint'
	) );
	$wp_customize->add_control('freddo_theme_options[_onepage_noposts_blog]', array(
		'label'      => __( 'Number of posts to show', 'freddo' ),
		'section'    => 'cresta_freddo_onepage_section_blog',
		'settings'   => 'freddo_theme_options[_onepage_noposts_blog]',
		'active_callback' => 'freddo_is_blog_active',
		'type'       => 'number',
		'priority' => 8,
	) );
	/* Text Blog Button */
	$wp_customize->add_setting('freddo_theme_options[_onepage_textbutton_blog]', array(
		'default'    => __( 'Go to the blog!', 'freddo' ),
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field'
    ) );
	$wp_customize->add_control('freddo_theme_options[_onepage_textbutton_blog]', array(
        'label'      => __( 'Text blog button', 'freddo' ),
        'section'    => 'cresta_freddo_onepage_section_blog',
        'settings'   => 'freddo_theme_options[_onepage_textbutton_blog]',
        'type'       => 'text',
		'active_callback' => 'freddo_is_blog_active',
		'priority' => 9,
    ) );
	/* Link blog button */
	$wp_customize->add_setting('freddo_theme_options[_onepage_linkbutton_blog]', array(
        'default'    => '#',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw'
    ) );
	$wp_customize->add_control('freddo_theme_options[_onepage_linkbutton_blog]', array(
        'label'      => __( 'Link Blog Button', 'freddo' ),
        'section'    => 'cresta_freddo_onepage_section_blog',
        'settings'   => 'freddo_theme_options[_onepage_linkbutton_blog]',
        'type'       => 'url',
		'active_callback' => 'freddo_is_blog_active',
		'priority' => 10,
    ) );
	/**
	* ################ SECTION TEAM
	*/
	/* Show Team Section */
	$wp_customize->add_setting('freddo_theme_options[_onepage_section_team]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'freddo_sanitize_checkbox'
    ) );
	$wp_customize->add_control('freddo_theme_options[_onepage_section_team]', array(
        'label'      => __( 'Display section team', 'freddo' ),
        'section'    => 'cresta_freddo_onepage_section_team',
        'settings'   => 'freddo_theme_options[_onepage_section_team]',
        'type'       => 'checkbox',
		'priority' => 1,
    ) );
	/* Section ID */
	$wp_customize->add_setting('freddo_theme_options[_onepage_id_team]', array(
        'default'    => 'team',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field'
    ) );
	$wp_customize->add_control('freddo_theme_options[_onepage_id_team]', array(
        'label'      => __( 'Section ID name', 'freddo' ),
		'description'	=> __( 'ID for this section - if you want the user to be able to scroll down to this section.', 'freddo' ),
        'section'    => 'cresta_freddo_onepage_section_team',
        'settings'   => 'freddo_theme_options[_onepage_id_team]',
		'active_callback' => 'freddo_is_team_active',
        'type'       => 'text',
		'priority' => 2,
    ) );
	/* Background Image Team */
	$wp_customize->add_setting('freddo_theme_options[_onepage_imgback_team]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw'
    ) );
	$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
		$wp_customize, 
		'freddo_theme_options[_onepage_imgback_team]', 
		array(
			'label'      => __( 'Background Image Section (optional)', 'freddo' ),
			'section'    => 'cresta_freddo_onepage_section_team',
			'settings'   => 'freddo_theme_options[_onepage_imgback_team]',
			'active_callback' => 'freddo_is_team_active',
			'priority' => 3,
		) ) 
	);
	/* Background Color Blog */
	$wp_customize->add_setting( 'freddo_theme_options[_onepage_imgcolor_team]', array(
		'default' => '#f5f5f5',
		'type' => 'option', 
		'sanitize_callback' => 'sanitize_hex_color',
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
		$wp_customize,
		'freddo_theme_options[_onepage_imgcolor_team]', 
		array(
			'label' => __( 'Background Color Section', 'freddo' ),
			'section' => 'cresta_freddo_onepage_section_team',
			'settings' =>'freddo_theme_options[_onepage_imgcolor_team]',
			'active_callback' => 'freddo_is_team_active',
			'priority' => 4,
		) )
	);
	/* Text Color Blog */
	$wp_customize->add_setting( 'freddo_theme_options[_onepage_textcolor_team]', array(
		'default' => '#121212',
		'type' => 'option', 
		'sanitize_callback' => 'sanitize_hex_color',
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
		$wp_customize,
		'freddo_theme_options[_onepage_textcolor_team]', 
		array(
			'label' => __( 'Text Color Section', 'freddo' ),
			'section' => 'cresta_freddo_onepage_section_team',
			'settings' =>'freddo_theme_options[_onepage_textcolor_team]',
			'active_callback' => 'freddo_is_team_active',
			'priority' => 5,
		) )
	);
	/* Team title section */
	$wp_customize->add_setting('freddo_theme_options[_onepage_title_team]', array(
		'default'    => __( 'Our Team', 'freddo' ),
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'transport' => 'postMessage'
    ) );
	$wp_customize->add_control('freddo_theme_options[_onepage_title_team]', array(
        'label'      => __( 'Title', 'freddo' ),
        'section'    => 'cresta_freddo_onepage_section_team',
        'settings'   => 'freddo_theme_options[_onepage_title_team]',
        'type'       => 'text',
		'active_callback' => 'freddo_is_team_active',
		'priority' => 6,
    ) );
	/* Team subtitle section */
	$wp_customize->add_setting('freddo_theme_options[_onepage_subtitle_team]', array(
		'default'    => __( 'Nice to meet you', 'freddo' ),
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'transport' => 'postMessage'
    ) );
	$wp_customize->add_control('freddo_theme_options[_onepage_subtitle_team]', array(
        'label'      => __( 'Subtitle', 'freddo' ),
        'section'    => 'cresta_freddo_onepage_section_team',
        'settings'   => 'freddo_theme_options[_onepage_subtitle_team]',
        'type'       => 'text',
		'active_callback' => 'freddo_is_team_active',
		'priority' => 7,
    ) );
	/* Text lenght for team */
	$wp_customize->add_setting('freddo_theme_options[_onepage_lenght_team]', array(
        'default'    => '50',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'absint',
    ) );
	$wp_customize->add_control('freddo_theme_options[_onepage_lenght_team]', array(
        'label'      => __( 'Text lenght for team content (number of words)', 'freddo' ),
        'section'    => 'cresta_freddo_onepage_section_team',
        'settings'   => 'freddo_theme_options[_onepage_lenght_team]',
        'type'       => 'number',
		'active_callback' => 'freddo_is_team_active',
		'priority' => 7,
    ) );
	for( $number = 1; $number < FREDDO_VALUE_FOR_TEAM; $number++ ){
		/* Box Title Description */
		$wp_customize->add_setting('freddo_theme_options[_onepage_head_'.$number.'_team]', array(
			'sanitize_callback' => 'sanitize_text_field',
			'type'       => 'option',
		));
		$wp_customize->add_control(
			new Freddo_Customize_Heading(
			$wp_customize,
			'freddo_theme_options[_onepage_head_'.$number.'_team]',
			array(
				'settings'		=> 'freddo_theme_options[_onepage_head_'.$number.'_team]',
				'section'		=> 'cresta_freddo_onepage_section_team',
				'label'			=> __( 'Person number ', 'freddo' ).$number,
				'active_callback' => 'freddo_is_team_active',
			))
		);
		/* Team Dropdown pages */
		$wp_customize->add_setting('freddo_theme_options[_onepage_choosepage_'.$number.'_team]', array(
			'default'    => false,
			'type'       => 'option',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'absint',
		) );
		$wp_customize->add_control('freddo_theme_options[_onepage_choosepage_'.$number.'_team]', array(
			'label'      => __( 'Choose the page to display', 'freddo' ),
			'description'	=> __( 'Featured Image, title and content will be used in the box', 'freddo' ),
			'section'    => 'cresta_freddo_onepage_section_team',
			'settings'   => 'freddo_theme_options[_onepage_choosepage_'.$number.'_team]',
			'type'       => 'dropdown-pages',
			'active_callback' => 'freddo_is_team_active',
		) );
	}
	/**
	* ################ SECTION CONTACT
	*/
	/* Show Contact Section */
	$wp_customize->add_setting('freddo_theme_options[_onepage_section_contact]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'freddo_sanitize_checkbox'
    ) );
	$wp_customize->add_control('freddo_theme_options[_onepage_section_contact]', array(
        'label'      => __( 'Display section contact', 'freddo' ),
        'section'    => 'cresta_freddo_onepage_section_contact',
        'settings'   => 'freddo_theme_options[_onepage_section_contact]',
        'type'       => 'checkbox',
		'priority' => 1,
    ) );
	/* Section ID */
	$wp_customize->add_setting('freddo_theme_options[_onepage_id_contact]', array(
        'default'    => 'contact',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field'
    ) );
	$wp_customize->add_control('freddo_theme_options[_onepage_id_contact]', array(
        'label'      => __( 'Section ID name', 'freddo' ),
		'description'	=> __( 'ID for this section - if you want the user to be able to scroll down to this section.', 'freddo' ),
        'section'    => 'cresta_freddo_onepage_section_contact',
        'settings'   => 'freddo_theme_options[_onepage_id_contact]',
		'active_callback' => 'freddo_is_contact_active',
        'type'       => 'text',
		'priority' => 2,
    ) );
	/* Background Image Contact */
	$wp_customize->add_setting('freddo_theme_options[_onepage_imgback_contact]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw'
    ) );
	$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
		$wp_customize, 
		'freddo_theme_options[_onepage_imgback_contact]', 
		array(
			'label'      => __( 'Background Image Section (optional)', 'freddo' ),
			'section'    => 'cresta_freddo_onepage_section_contact',
			'settings'   => 'freddo_theme_options[_onepage_imgback_contact]',
			'active_callback' => 'freddo_is_contact_active',
			'priority' => 3,
		) ) 
	);
	/* Background Color Contact */
	$wp_customize->add_setting( 'freddo_theme_options[_onepage_imgcolor_contact]', array(
		'default' => '#121212',
		'type' => 'option', 
		'sanitize_callback' => 'sanitize_hex_color',
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
		$wp_customize,
		'freddo_theme_options[_onepage_imgcolor_contact]', 
		array(
			'label' => __( 'Background Color Section', 'freddo' ),
			'section' => 'cresta_freddo_onepage_section_contact',
			'settings' =>'freddo_theme_options[_onepage_imgcolor_contact]',
			'active_callback' => 'freddo_is_contact_active',
			'priority' => 4,
		) )
	);
	/* Text Color Contact */
	$wp_customize->add_setting( 'freddo_theme_options[_onepage_textcolor_contact]', array(
		'default' => '#f5f5f5',
		'type' => 'option', 
		'sanitize_callback' => 'sanitize_hex_color',
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
		$wp_customize,
		'freddo_theme_options[_onepage_textcolor_contact]', 
		array(
			'label' => __( 'Text Color Section', 'freddo' ),
			'section' => 'cresta_freddo_onepage_section_contact',
			'settings' =>'freddo_theme_options[_onepage_textcolor_contact]',
			'active_callback' => 'freddo_is_contact_active',
			'priority' => 5,
		) )
	);
	/* Contact title section */
	$wp_customize->add_setting('freddo_theme_options[_onepage_title_contact]', array(
		'default'    => __( 'Contact Us', 'freddo' ),
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'transport' => 'postMessage'
    ) );
	$wp_customize->add_control('freddo_theme_options[_onepage_title_contact]', array(
        'label'      => __( 'Title', 'freddo' ),
        'section'    => 'cresta_freddo_onepage_section_contact',
        'settings'   => 'freddo_theme_options[_onepage_title_contact]',
        'type'       => 'text',
		'active_callback' => 'freddo_is_contact_active',
		'priority' => 6,
    ) );
	/* Contact subtitle section */
	$wp_customize->add_setting('freddo_theme_options[_onepage_subtitle_contact]', array(
		'default'    => __( 'Get in touch', 'freddo' ),
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'transport' => 'postMessage'
    ) );
	$wp_customize->add_control('freddo_theme_options[_onepage_subtitle_contact]', array(
        'label'      => __( 'Subtitle', 'freddo' ),
        'section'    => 'cresta_freddo_onepage_section_contact',
        'settings'   => 'freddo_theme_options[_onepage_subtitle_contact]',
        'type'       => 'text',
		'active_callback' => 'freddo_is_contact_active',
		'priority' => 7,
    ) );
	/* Contact text */
	$wp_customize->add_setting('freddo_theme_options[_onepage_head_contact]', array(
		'sanitize_callback' => 'sanitize_text_field',
		'type'       => 'option',
	));
	$wp_customize->add_control(
		new Freddo_Customize_Heading(
		$wp_customize,
		'freddo_theme_options[_onepage_head_contact]',
		array(
			'settings'		=> 'freddo_theme_options[_onepage_head_contact]',
			'section'		=> 'cresta_freddo_onepage_section_contact',
			'label'			=> __( 'Contact fields', 'freddo' ),
			'active_callback' => 'freddo_is_contact_active',
			'priority' => 8,
		))
	);
	/* Contact company additional text section */
	$wp_customize->add_setting('freddo_theme_options[_onepage_additionaltext_contact]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'freddo_sanitize_text',
		'transport' => 'postMessage'
    ) );
	$wp_customize->add_control('freddo_theme_options[_onepage_additionaltext_contact]', array(
        'label'      => __( 'Additional Text', 'freddo' ),
        'section'    => 'cresta_freddo_onepage_section_contact',
        'settings'   => 'freddo_theme_options[_onepage_additionaltext_contact]',
        'type'       => 'textarea',
		'active_callback' => 'freddo_is_contact_active',
		'priority' => 9,
    ) );
	/* Contact company name section */
	$wp_customize->add_setting('freddo_theme_options[_onepage_companyname_contact]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'transport' => 'postMessage'
    ) );
	$wp_customize->add_control('freddo_theme_options[_onepage_companyname_contact]', array(
        'label'      => __( 'Company Name', 'freddo' ),
        'section'    => 'cresta_freddo_onepage_section_contact',
        'settings'   => 'freddo_theme_options[_onepage_companyname_contact]',
        'type'       => 'text',
		'active_callback' => 'freddo_is_contact_active',
		'priority' => 10,
    ) );
	/* Contact company address line 1 section */
	$wp_customize->add_setting('freddo_theme_options[_onepage_companyaddress1_contact]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'transport' => 'postMessage'
    ) );
	$wp_customize->add_control('freddo_theme_options[_onepage_companyaddress1_contact]', array(
        'label'      => __( 'Address line 1', 'freddo' ),
        'section'    => 'cresta_freddo_onepage_section_contact',
        'settings'   => 'freddo_theme_options[_onepage_companyaddress1_contact]',
        'type'       => 'text',
		'active_callback' => 'freddo_is_contact_active',
		'priority' => 11,
    ) );
	/* Contact company address line 2 section */
	$wp_customize->add_setting('freddo_theme_options[_onepage_companyaddress2_contact]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'transport' => 'postMessage'
    ) );
	$wp_customize->add_control('freddo_theme_options[_onepage_companyaddress2_contact]', array(
        'label'      => __( 'Address line 2', 'freddo' ),
        'section'    => 'cresta_freddo_onepage_section_contact',
        'settings'   => 'freddo_theme_options[_onepage_companyaddress2_contact]',
        'type'       => 'text',
		'active_callback' => 'freddo_is_contact_active',
		'priority' => 12,
    ) );
	/* Contact company address line 3 section */
	$wp_customize->add_setting('freddo_theme_options[_onepage_companyaddress3_contact]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'transport' => 'postMessage'
    ) );
	$wp_customize->add_control('freddo_theme_options[_onepage_companyaddress3_contact]', array(
        'label'      => __( 'Address line 3', 'freddo' ),
        'section'    => 'cresta_freddo_onepage_section_contact',
        'settings'   => 'freddo_theme_options[_onepage_companyaddress3_contact]',
        'type'       => 'text',
		'active_callback' => 'freddo_is_contact_active',
		'priority' => 13,
    ) );
	/* Contact company phone number section */
	$wp_customize->add_setting('freddo_theme_options[_onepage_companyphone_contact]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'transport' => 'postMessage'
    ) );
	$wp_customize->add_control('freddo_theme_options[_onepage_companyphone_contact]', array(
        'label'      => __( 'Phone Number', 'freddo' ),
        'section'    => 'cresta_freddo_onepage_section_contact',
        'settings'   => 'freddo_theme_options[_onepage_companyphone_contact]',
        'type'       => 'text',
		'active_callback' => 'freddo_is_contact_active',
		'priority' => 14,
    ) );
	/* Make phone number clickable */
	$wp_customize->add_setting('freddo_theme_options[_onepage_companyphone_contact_link]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'freddo_sanitize_checkbox'
    ) );
	$wp_customize->add_control('freddo_theme_options[_onepage_companyphone_contact_link]', array(
        'label'      => __( 'Make phone number clickable', 'freddo' ),
        'section'    => 'cresta_freddo_onepage_section_contact',
        'settings'   => 'freddo_theme_options[_onepage_companyphone_contact_link]',
        'type'       => 'checkbox',
		'priority' => 14,
    ) );
	/* Contact company fax number section */
	$wp_customize->add_setting('freddo_theme_options[_onepage_companyfax_contact]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'transport' => 'postMessage'
    ) );
	$wp_customize->add_control('freddo_theme_options[_onepage_companyfax_contact]', array(
        'label'      => __( 'Fax Number', 'freddo' ),
        'section'    => 'cresta_freddo_onepage_section_contact',
        'settings'   => 'freddo_theme_options[_onepage_companyfax_contact]',
        'type'       => 'text',
		'active_callback' => 'freddo_is_contact_active',
		'priority' => 15,
    ) );
	/* Contact company email address section */
	$wp_customize->add_setting('freddo_theme_options[_onepage_companyemail_contact]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_email',
		'transport' => 'postMessage'
    ) );
	$wp_customize->add_control('freddo_theme_options[_onepage_companyemail_contact]', array(
        'label'      => __( 'Email Address', 'freddo' ),
        'section'    => 'cresta_freddo_onepage_section_contact',
        'settings'   => 'freddo_theme_options[_onepage_companyemail_contact]',
        'type'       => 'text',
		'active_callback' => 'freddo_is_contact_active',
		'priority' => 16,
    ) );
	/* Contact Form Shortcode */
	$wp_customize->add_setting('freddo_theme_options[_onepage_shortcode_contact]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field'
    ) );
	$wp_customize->add_control('freddo_theme_options[_onepage_shortcode_contact]', array(
        'label'      => __( 'Contact Form Shortcode', 'freddo' ),
		'description'	=> wp_kses_post( 'Paste the contact form shortcode. For example the Contact Form 7 plugin shortcode: <code>[contact-form-7 id="xxx" title="Contact form 1"]</code>', 'freddo' ),
        'section'    => 'cresta_freddo_onepage_section_contact',
        'settings'   => 'freddo_theme_options[_onepage_shortcode_contact]',
        'type'       => 'text',
		'active_callback' => 'freddo_is_contact_active',
		'priority' => 17,
    ) );
	/* Big Icon Contact */
	$wp_customize->add_setting('freddo_theme_options[_onepage_icon_contact]', array(
		'default'			=> 'fa fa-envelope',
		'sanitize_callback' => 'sanitize_text_field',
		'type'       => 'option',
	));
	$wp_customize->add_control(
		new Freddo_Fontawesome_Icon(
		$wp_customize,
		'freddo_theme_options[_onepage_icon_contact]',
		array(
			'settings'		=> 'freddo_theme_options[_onepage_icon_contact]',
			'section'		=> 'cresta_freddo_onepage_section_contact',
			'label'			=> __( 'FontAwesome Icon', 'freddo' ),
			'type'       => 'icon',
			'active_callback' => 'freddo_is_contact_active',
			'priority' => 18,
		))
	);
	/**
	* ################ SECTION IMPORTANT LINK AND DOCUMENTATION
	*/
	$wp_customize->add_setting('freddo_theme_options[_documentation_link]', array(
		'default' => '',
		'type' => 'option',
		'sanitize_callback' => 'esc_attr'
	));
	
	$wp_customize->add_control(
		new Freddo_Customize_Upgrade_Control(
		$wp_customize,
		'freddo_theme_options[_documentation_link]',
		array(
			'section' => 'cresta_freddo_links',
			'settings' => 'freddo_theme_options[_documentation_link]',
		))
	);
}
add_action( 'customize_register', 'freddo_custom_settings_register' );

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function freddo_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	/* Theme options scroll down text */
	$wp_customize->get_setting( 'freddo_theme_options[_post_scrolldown_text]' )->transport  = 'postMessage';
	/* Onepage title and subtitle */
	$wp_customize->get_setting( 'freddo_theme_options[_onepage_title_aboutus]' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'freddo_theme_options[_onepage_subtitle_aboutus]' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'freddo_theme_options[_onepage_title_features]' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'freddo_theme_options[_onepage_subtitle_features]' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'freddo_theme_options[_onepage_title_skills]' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'freddo_theme_options[_onepage_subtitle_skills]' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'freddo_theme_options[_onepage_title_services]' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'freddo_theme_options[_onepage_subtitle_services]' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'freddo_theme_options[_onepage_title_blog]' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'freddo_theme_options[_onepage_subtitle_blog]' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'freddo_theme_options[_onepage_title_team]' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'freddo_theme_options[_onepage_subtitle_team]' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'freddo_theme_options[_onepage_title_contact]' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'freddo_theme_options[_onepage_subtitle_contact]' )->transport  = 'postMessage';
	/* Onepage slider section */
	$wp_customize->get_setting( 'freddo_theme_options[_onepage_scrolldown_text]' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'freddo_theme_options[_onepage_text_1_slider]' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'freddo_theme_options[_onepage_text_2_slider]' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'freddo_theme_options[_onepage_text_3_slider]' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'freddo_theme_options[_onepage_subtext_1_slider]' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'freddo_theme_options[_onepage_subtext_2_slider]' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'freddo_theme_options[_onepage_subtext_3_slider]' )->transport  = 'postMessage';
	/* Onepage about us section */
	$wp_customize->get_setting( 'freddo_theme_options[_onepage_textbutton_aboutus]' )->transport  = 'postMessage';
	/* Onepage features section */
	$wp_customize->get_setting( 'freddo_theme_options[_onepage_boxtextbutton_1_features]' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'freddo_theme_options[_onepage_boxtextbutton_2_features]' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'freddo_theme_options[_onepage_boxtextbutton_3_features]' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'freddo_theme_options[_onepage_boxtextbutton_4_features]' )->transport  = 'postMessage';
	/* Onepage CTA section */
	$wp_customize->get_setting( 'freddo_theme_options[_onepage_phrase_cta]' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'freddo_theme_options[_onepage_desc_cta]' )->transport  = 'postMessage';
	/* Onepage services section */
	$wp_customize->get_setting( 'freddo_theme_options[_onepage_phrase_services]' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'freddo_theme_options[_onepage_textarea_services]' )->transport  = 'postMessage';
	/* Onepage contact section */
	$wp_customize->get_setting( 'freddo_theme_options[_onepage_additionaltext_contact]' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'freddo_theme_options[_onepage_companyname_contact]' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'freddo_theme_options[_onepage_companyaddress1_contact]' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'freddo_theme_options[_onepage_companyaddress2_contact]' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'freddo_theme_options[_onepage_companyaddress3_contact]' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'freddo_theme_options[_onepage_companyphone_contact]' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'freddo_theme_options[_onepage_companyfax_contact]' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'freddo_theme_options[_onepage_companyemail_contact]' )->transport  = 'postMessage';
	/* Onepage about us color and background */
	$wp_customize->get_setting( 'freddo_theme_options[_onepage_imgcolor_aboutus]' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'freddo_theme_options[_onepage_textcolor_aboutus]' )->transport  = 'postMessage';
	/* Onepage features color and background */
	$wp_customize->get_setting( 'freddo_theme_options[_onepage_imgcolor_features]' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'freddo_theme_options[_onepage_textcolor_features]' )->transport  = 'postMessage';
	/* Onepage cta color and background */
	$wp_customize->get_setting( 'freddo_theme_options[_onepage_imgcolor_cta]' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'freddo_theme_options[_onepage_textcolor_cta]' )->transport  = 'postMessage';
	/* Onepage blog color and background */
	$wp_customize->get_setting( 'freddo_theme_options[_onepage_imgcolor_blog]' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'freddo_theme_options[_onepage_textcolor_blog]' )->transport  = 'postMessage';
	/* Onepage team color and background */
	$wp_customize->get_setting( 'freddo_theme_options[_onepage_imgcolor_team]' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'freddo_theme_options[_onepage_textcolor_team]' )->transport  = 'postMessage';
	/* Onepage contact color and background */
	$wp_customize->get_setting( 'freddo_theme_options[_onepage_imgcolor_contact]' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'freddo_theme_options[_onepage_textcolor_contact]' )->transport  = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'freddo_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'freddoo_customize_partial_blogdescription',
		) );
		$wp_customize->selective_refresh->add_partial('freddo_theme_options[_onepage_title_aboutus]', array(
		  'selector' => '.freddo_action_aboutus .freddo_main_text',
		  'settings' => 'freddo_theme_options[_onepage_title_aboutus]',
		  'render_callback' => 'freddo_selective_refresh_title_aboutus',
		) );
		$wp_customize->selective_refresh->add_partial('freddo_theme_options[_onepage_title_features]', array(
		  'selector' => '.freddo_action_features .freddo_main_text',
		  'settings' => 'freddo_theme_options[_onepage_title_features]',
		  'render_callback' => 'freddo_selective_refresh_title_features',
		) );
		$wp_customize->selective_refresh->add_partial('freddo_theme_options[_onepage_title_skills]', array(
		  'selector' => '.freddo_action_skills .freddo_main_text',
		  'settings' => 'freddo_theme_options[_onepage_title_skills]',
		  'render_callback' => 'freddo_selective_refresh_title_skills',
		) );
		$wp_customize->selective_refresh->add_partial('freddo_theme_options[_onepage_phrase_cta]', array(
		  'selector' => '.cta_columns .ctaPhrase h3',
		  'settings' => 'freddo_theme_options[_onepage_phrase_cta]',
		  'render_callback' => 'freddo_selective_refresh_phrase_cta',
		) );
		$wp_customize->selective_refresh->add_partial('freddo_theme_options[_onepage_title_services]', array(
		  'selector' => '.freddo_action_services .freddo_main_text',
		  'settings' => 'freddo_theme_options[_onepage_title_services]',
		  'render_callback' => 'freddo_selective_refresh_title_services',
		) );
		$wp_customize->selective_refresh->add_partial('freddo_theme_options[_onepage_textarea_services]', array(
		  'selector' => '.services_columns_single .serviceContent p',
		  'settings' => 'freddo_theme_options[_onepage_textarea_services]',
		  'render_callback' => 'freddo_selective_refresh_textarea_services',
		) );
		$wp_customize->selective_refresh->add_partial('freddo_theme_options[_onepage_title_blog]', array(
		  'selector' => '.freddo_action_blog .freddo_main_text',
		  'settings' => 'freddo_theme_options[_onepage_title_blog]',
		  'render_callback' => 'freddo_selective_refresh_title_blog',
		) );
		$wp_customize->selective_refresh->add_partial('freddo_theme_options[_onepage_title_team]', array(
		  'selector' => '.freddo_action_team .freddo_main_text',
		  'settings' => 'freddo_theme_options[_onepage_title_team]',
		  'render_callback' => 'freddo_selective_refresh_title_team',
		) );
		$wp_customize->selective_refresh->add_partial('freddo_theme_options[_onepage_title_contact]', array(
		  'selector' => '.freddo_action_contact .freddo_main_text',
		  'settings' => 'freddo_theme_options[_onepage_title_contact]',
		  'render_callback' => 'freddo_selective_refresh_title_contact',
		) );
		$wp_customize->selective_refresh->add_partial('freddo_theme_options[_onepage_additionaltext_contact]', array(
		  'selector' => '.freddoAdditionalText p',
		  'settings' => 'freddo_theme_options[_onepage_additionaltext_contact]',
		  'render_callback' => 'freddo_selective_refresh_additionaltext_contact',
		) );
	}
}
add_action( 'customize_register', 'freddo_customize_register' );

/* Render Callback for selective refresh */
function freddo_customize_partial_blogname() {
	bloginfo( 'name' );
}
function freddo_customize_partial_blogdescription() {
	bloginfo( 'description' );
}
function freddo_selective_refresh_title_aboutus() {
	return esc_html(freddo_options('_onepage_title_aboutus'));
}
function freddo_selective_refresh_title_features() {
	return esc_html(freddo_options('_onepage_title_features'));
}
function freddo_selective_refresh_title_skills() {
	return esc_html(freddo_options('_onepage_title_skills'));
}
function freddo_selective_refresh_phrase_cta() {
	return esc_html(freddo_options('_onepage_phrase_cta'));
}
function freddo_selective_refresh_title_services() {
	return esc_html(freddo_options('_onepage_title_services'));
}
function freddo_selective_refresh_textarea_services() {
	return wp_kses(freddo_options('_onepage_textarea_services'), freddo_allowed_html());
}
function freddo_selective_refresh_title_blog() {
	return esc_html(freddo_options('_onepage_title_blog'));
}
function freddo_selective_refresh_title_team() {
	return esc_html(freddo_options('_onepage_title_team'));
}
function freddo_selective_refresh_title_contact() {
	return esc_html(freddo_options('_onepage_title_contact'));
}
function freddo_selective_refresh_additionaltext_contact() {
	return wp_kses(freddo_options('_onepage_additionaltext_contact'), freddo_allowed_html());
}

/* Custom Class */
if( class_exists( 'WP_Customize_Control' ) ):
	class Freddo_Customize_Upgrade_Control extends WP_Customize_Control {
        public function render_content() {  ?>
        	<p class="freddo-custom-title">
        		<span class="customize-control-title">
					<h3 style="text-align:center;"><div class="dashicons dashicons-megaphone"></div> <?php esc_html_e('Thank you for using Freddo WordPress Theme', 'freddo'); ?></h3>
        		</span>
        	</p>
			<p style="text-align:center;" class="freddo-custom-button">
				<a style="margin: 10px;display: block;" target="_blank" href="<?php echo esc_url(admin_url('themes.php?page=freddo-welcome&tab=documentation')); ?>" class="button button-secondary">
					<?php esc_html_e('Theme Documentation', 'freddo'); ?>
				</a>
				<a style="margin: 10px;display: block;" target="_blank" href="https://crestaproject.com/demo/freddo/" class="button button-secondary">
					<?php esc_html_e('Watch the demo', 'freddo'); ?>
				</a>
				<a style="margin: 10px;display: block;" target="_blank" href="https://crestaproject.com/demo/freddo-pro/" class="button button-secondary">
					<?php esc_html_e('Watch the PRO Version demo', 'freddo'); ?>
				</a>
				<a style="margin: 10px;display: block;" target="_blank" href="https://crestaproject.com/downloads/freddo/" class="button button-secondary">
					<?php esc_html_e('More info about Freddo theme', 'freddo'); ?>
				</a>
			</p>
			<?php
        }
    }
	class Freddo_Customize_Heading extends WP_Customize_Control {
		public $type = 'heading';

		public function render_content() {
			if ( !empty( $this->label ) ) : ?>
				<h3 class="freddo_options-accordion-section-title"><?php echo esc_html( $this->label ); ?></h3>
			<?php endif;
			if($this->description){ ?>
				<span class="description customize-control-description">
				<?php echo wp_kses_post($this->description); ?>
				</span>
			<?php }
		}
	}
	class Freddo_Info_Text extends WP_Customize_Control{
		public function render_content(){
		?>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php if($this->description){ ?>
				<span class="description customize-control-description">
				<?php echo wp_kses_post($this->description); ?>
				</span>
			<?php }
		}
	}
	class Freddo_Fontawesome_Icon extends WP_Customize_Control{
		public $type = 'icon';
		public function render_content(){
			?>
				<label>
					<span class="customize-control-title">
					<?php echo esc_html( $this->label ); ?>
					</span>
					<?php if($this->description){ ?>
					<span class="description customize-control-description">
						<?php echo wp_kses_post($this->description); ?>
					</span>
					<?php } ?>
					<div class="freddo-selected-icon">
						<i class="fa <?php echo esc_attr($this->value()); ?>"></i>
						<span><i class="fa fa-angle-down"></i></span>
					</div>
					<ul class="freddo-icon-list clearfix">
						<?php
						$freddo_font_awesome_icon_array = freddo_font_awesome_icon_array();
						foreach ($freddo_font_awesome_icon_array as $freddo_font_awesome_icon) {
							$icon_class = $this->value() == $freddo_font_awesome_icon ? 'icon-active' : '';
							echo '<li class='.esc_attr($icon_class).'><i class="'.esc_attr($freddo_font_awesome_icon).'"></i></li>';
						}
						?>
					</ul>
					<input type="hidden" value="<?php $this->value(); ?>" <?php $this->link(); ?> />
				</label>
			<?php
		}
	}
endif;

function freddo_is_scroll_in_post() {
	$scrollButton = freddo_options('_scrolldown_button', '1');
	if ($scrollButton == 1) {
		return true;
	}
	return false;
}

function freddo_is_one_page() {
	if (!is_page_template('template-onepage.php')) {
		return false;
	}
	return true;
}

function freddo_is_sectionmap_active() {
	$showSectionmap = freddo_options('_onepage_settings_sectionmap', '');
	if ($showSectionmap == 1) {
		return true;
	}
	return false;
}

function freddo_is_slider_active() {
	$showSlider = freddo_options('_onepage_section_slider', '1');
	if ($showSlider == 1) {
		return true;
	}
	return false;
}

function freddo_onepage_is_scroll_in_post() {
	$showSlider = freddo_options('_onepage_section_slider', '1');
	$scrollButton = freddo_options('_onepage_scrolldown_slider', '1');
	if ($scrollButton == 1 && $showSlider) {
		return true;
	}
	return false;
}

function freddo_is_aboutus_active() {
	$showAbout = freddo_options('_onepage_section_aboutus', '');
	if ($showAbout == 1) {
		return true;
	}
	return false;
}

function freddo_is_features_active() {
	$showFeatures = freddo_options('_onepage_section_features', '');
	if ($showFeatures == 1) {
		return true;
	}
	return false;
}

function freddo_is_skills_active() {
	$showSkills = freddo_options('_onepage_section_skills', '');
	if ($showSkills == 1) {
		return true;
	}
	return false;
}

function freddo_is_cta_active() {
	$showCta = freddo_options('_onepage_section_cta', '');
	if ($showCta == 1) {
		return true;
	}
	return false;
}

function freddo_is_services_active() {
	$showServices = freddo_options('_onepage_section_services', '');
	if ($showServices == 1) {
		return true;
	}
	return false;
}

function freddo_is_blog_active() {
	$showBlog = freddo_options('_onepage_section_blog', '');
	if ($showBlog == 1) {
		return true;
	}
	return false;
}

function freddo_is_team_active() {
	$showTeam = freddo_options('_onepage_section_team', '');
	if ($showTeam == 1) {
		return true;
	}
	return false;
}

function freddo_is_contact_active() {
	$showContact = freddo_options('_onepage_section_contact', '');
	if ($showContact == 1) {
		return true;
	}
	return false;
}

function freddo_sanitize_checkbox( $input ) {
	if ( $input == 1 ) {
		return 1;
	} else {
		return '';
	}
}

function freddo_sanitize_text( $input ) {
	return wp_kses($input, freddo_allowed_html());
}

function freddo_sanitize_select( $input, $setting ) {
	$input = sanitize_key( $input );
	$choices = $setting->manager->get_control( $setting->id )->choices;
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

if( ! function_exists('freddo_font_awesome_icon_array')){
	function freddo_font_awesome_icon_array(){
		return array("fa fa-500px","fa fa-address-book","fa fa-address-book-o","fa fa-address-card","fa fa-address-card-o","fa fa-adjust","fa fa-adn","fa fa-align-center","fa fa-align-justify","fa fa-align-left","fa fa-align-right","fa fa-amazon","fa fa-ambulance","fa fa-american-sign-language-interpreting","fa fa-anchor","fa fa-android","fa fa-angellist","fa fa-angle-double-down","fa fa-angle-double-left","fa fa-angle-double-right","fa fa-angle-double-up","fa fa-angle-down","fa fa-angle-left","fa fa-angle-right","fa fa-angle-up","fa fa-apple","fa fa-archive","fa fa-area-chart","fa fa-arrow-circle-down","fa fa-arrow-circle-left","fa fa-arrow-circle-o-down","fa fa-arrow-circle-o-left","fa fa-arrow-circle-o-right","fa fa-arrow-circle-o-up","fa fa-arrow-circle-right","fa fa-arrow-circle-up","fa fa-arrow-down","fa fa-arrow-left","fa fa-arrow-right","fa fa-arrow-up","fa fa-arrows","fa fa-arrows-alt","fa fa-arrows-h","fa fa-arrows-v","fa fa-assistive-listening-systems","fa fa-asterisk","fa fa-at","fa fa-audio-description","fa fa-backward","fa fa-balance-scale","fa fa-ban","fa fa-bandcamp","fa fa-bar-chart","fa fa-barcode","fa fa-bars","fa fa-bath","fa fa-battery-empty","fa fa-battery-full","fa fa-battery-half","fa fa-battery-quarter","fa fa-battery-three-quarters","fa fa-bed","fa fa-beer","fa fa-behance","fa fa-behance-square","fa fa-bell","fa fa-bell-o","fa fa-bell-slash","fa fa-bell-slash-o","fa fa-bicycle","fa fa-binoculars","fa fa-birthday-cake","fa fa-bitbucket","fa fa-bitbucket-square","fa fa-black-tie","fa fa-blind","fa fa-bluetooth","fa fa-bluetooth-b","fa fa-bold","fa fa-bolt","fa fa-bomb","fa fa-book","fa fa-bookmark","fa fa-bookmark-o","fa fa-braille","fa fa-briefcase","fa fa-btc","fa fa-bug","fa fa-building","fa fa-building-o","fa fa-bullhorn","fa fa-bullseye","fa fa-bus","fa fa-buysellads","fa fa-calculator","fa fa-calendar","fa fa-calendar-check-o","fa fa-calendar-minus-o","fa fa-calendar-o","fa fa-calendar-plus-o","fa fa-calendar-times-o","fa fa-camera","fa fa-camera-retro","fa fa-car","fa fa-caret-down","fa fa-caret-left","fa fa-caret-right","fa fa-caret-square-o-down","fa fa-caret-square-o-left","fa fa-caret-square-o-right","fa fa-caret-square-o-up","fa fa-caret-up","fa fa-cart-arrow-down","fa fa-cart-plus","fa fa-cc","fa fa-cc-amex","fa fa-cc-diners-club","fa fa-cc-discover","fa fa-cc-jcb","fa fa-cc-mastercard","fa fa-cc-paypal","fa fa-cc-stripe","fa fa-cc-visa","fa fa-certificate","fa fa-chain-broken","fa fa-check","fa fa-check-circle","fa fa-check-circle-o","fa fa-check-square","fa fa-check-square-o","fa fa-chevron-circle-down","fa fa-chevron-circle-left","fa fa-chevron-circle-right","fa fa-chevron-circle-up","fa fa-chevron-down","fa fa-chevron-left","fa fa-chevron-right","fa fa-chevron-up","fa fa-child","fa fa-chrome","fa fa-circle","fa fa-circle-o","fa fa-circle-o-notch","fa fa-circle-thin","fa fa-clipboard","fa fa-clock-o","fa fa-clone","fa fa-cloud","fa fa-cloud-download","fa fa-cloud-upload","fa fa-code","fa fa-code-fork","fa fa-codepen","fa fa-codiepie","fa fa-coffee","fa fa-cog","fa fa-cogs","fa fa-columns","fa fa-comment","fa fa-comment-o","fa fa-commenting","fa fa-commenting-o","fa fa-comments","fa fa-comments-o","fa fa-compass","fa fa-compress","fa fa-connectdevelop","fa fa-contao","fa fa-copyright","fa fa-creative-commons","fa fa-credit-card","fa fa-credit-card-alt","fa fa-crop","fa fa-crosshairs","fa fa-css3","fa fa-cube","fa fa-cubes","fa fa-cutlery","fa fa-dashcube","fa fa-database","fa fa-deaf","fa fa-delicious","fa fa-desktop","fa fa-deviantart","fa fa-diamond","fa fa-digg","fa fa-dot-circle-o","fa fa-download","fa fa-dribbble","fa fa-dropbox","fa fa-drupal","fa fa-edge","fa fa-eercast","fa fa-eject","fa fa-ellipsis-h","fa fa-ellipsis-v","fa fa-empire","fa fa-envelope","fa fa-envelope-o","fa fa-envelope-open","fa fa-envelope-open-o","fa fa-envelope-square","fa fa-envira","fa fa-eraser","fa fa-etsy","fa fa-eur","fa fa-exchange","fa fa-exclamation","fa fa-exclamation-circle","fa fa-exclamation-triangle","fa fa-expand","fa fa-expeditedssl","fa fa-external-link","fa fa-external-link-square","fa fa-eye","fa fa-eye-slash","fa fa-eyedropper","fa fa-facebook","fa fa-facebook-official","fa fa-facebook-square","fa fa-fast-backward","fa fa-fast-forward","fa fa-fax","fa fa-female","fa fa-fighter-jet","fa fa-file","fa fa-file-archive-o","fa fa-file-audio-o","fa fa-file-code-o","fa fa-file-excel-o","fa fa-file-image-o","fa fa-file-o","fa fa-file-pdf-o","fa fa-file-powerpoint-o","fa fa-file-text","fa fa-file-text-o","fa fa-file-video-o","fa fa-file-word-o","fa fa-files-o","fa fa-film","fa fa-filter","fa fa-fire","fa fa-fire-extinguisher","fa fa-firefox","fa fa-first-order","fa fa-flag","fa fa-flag-checkered","fa fa-flag-o","fa fa-flask","fa fa-flickr","fa fa-floppy-o","fa fa-folder","fa fa-folder-o","fa fa-folder-open","fa fa-folder-open-o","fa fa-font","fa fa-font-awesome","fa fa-fonticons","fa fa-fort-awesome","fa fa-forumbee","fa fa-forward","fa fa-foursquare","fa fa-free-code-camp","fa fa-frown-o","fa fa-futbol-o","fa fa-gamepad","fa fa-gavel","fa fa-gbp","fa fa-genderless","fa fa-get-pocket","fa fa-gg","fa fa-gg-circle","fa fa-gift","fa fa-git","fa fa-git-square","fa fa-github","fa fa-github-alt","fa fa-github-square","fa fa-gitlab","fa fa-glass","fa fa-glide","fa fa-glide-g","fa fa-globe","fa fa-google","fa fa-google-plus","fa fa-google-plus-official","fa fa-google-plus-square","fa fa-google-wallet","fa fa-graduation-cap","fa fa-gratipay","fa fa-grav","fa fa-h-square","fa fa-hacker-news","fa fa-hand-lizard-o","fa fa-hand-o-down","fa fa-hand-o-left","fa fa-hand-o-right","fa fa-hand-o-up","fa fa-hand-paper-o","fa fa-hand-peace-o","fa fa-hand-pointer-o","fa fa-hand-rock-o","fa fa-hand-scissors-o","fa fa-hand-spock-o","fa fa-handshake-o","fa fa-hashtag","fa fa-hdd-o","fa fa-header","fa fa-headphones","fa fa-heart","fa fa-heart-o","fa fa-heartbeat","fa fa-history","fa fa-home","fa fa-hospital-o","fa fa-hourglass","fa fa-hourglass-end","fa fa-hourglass-half","fa fa-hourglass-o","fa fa-hourglass-start","fa fa-houzz","fa fa-html5","fa fa-i-cursor","fa fa-id-badge","fa fa-id-card","fa fa-id-card-o","fa fa-ils","fa fa-imdb","fa fa-inbox","fa fa-indent","fa fa-industry","fa fa-info","fa fa-info-circle","fa fa-inr","fa fa-instagram","fa fa-internet-explorer","fa fa-ioxhost","fa fa-italic","fa fa-joomla","fa fa-jpy","fa fa-jsfiddle","fa fa-key","fa fa-keyboard-o","fa fa-krw","fa fa-language","fa fa-laptop","fa fa-lastfm","fa fa-lastfm-square","fa fa-leaf","fa fa-leanpub","fa fa-lemon-o","fa fa-level-down","fa fa-level-up","fa fa-life-ring","fa fa-lightbulb-o","fa fa-line-chart","fa fa-link","fa fa-linkedin","fa fa-linkedin-square","fa fa-linode","fa fa-linux","fa fa-list","fa fa-list-alt","fa fa-list-ol","fa fa-list-ul","fa fa-location-arrow","fa fa-lock","fa fa-long-arrow-down","fa fa-long-arrow-left","fa fa-long-arrow-right","fa fa-long-arrow-up","fa fa-low-vision","fa fa-magic","fa fa-magnet","fa fa-male","fa fa-map","fa fa-map-marker","fa fa-map-o","fa fa-map-pin","fa fa-map-signs","fa fa-mars","fa fa-mars-double","fa fa-mars-stroke","fa fa-mars-stroke-h","fa fa-mars-stroke-v","fa fa-maxcdn","fa fa-meanpath","fa fa-medium","fa fa-medkit","fa fa-meetup","fa fa-meh-o","fa fa-mercury","fa fa-microchip","fa fa-microphone","fa fa-microphone-slash","fa fa-minus","fa fa-minus-circle","fa fa-minus-square","fa fa-minus-square-o","fa fa-mixcloud","fa fa-mobile","fa fa-modx","fa fa-money","fa fa-moon-o","fa fa-motorcycle","fa fa-mouse-pointer","fa fa-music","fa fa-neuter","fa fa-newspaper-o","fa fa-object-group","fa fa-object-ungroup","fa fa-odnoklassniki","fa fa-odnoklassniki-square","fa fa-opencart","fa fa-openid","fa fa-opera","fa fa-optin-monster","fa fa-outdent","fa fa-pagelines","fa fa-paint-brush","fa fa-paper-plane","fa fa-paper-plane-o","fa fa-paperclip","fa fa-paragraph","fa fa-pause","fa fa-pause-circle","fa fa-pause-circle-o","fa fa-paw","fa fa-paypal","fa fa-pencil","fa fa-pencil-square","fa fa-pencil-square-o","fa fa-percent","fa fa-phone","fa fa-phone-square","fa fa-picture-o","fa fa-pie-chart","fa fa-pied-piper","fa fa-pied-piper-alt","fa fa-pied-piper-pp","fa fa-pinterest","fa fa-pinterest-p","fa fa-pinterest-square","fa fa-plane","fa fa-play","fa fa-play-circle","fa fa-play-circle-o","fa fa-plug","fa fa-plus","fa fa-plus-circle","fa fa-plus-square","fa fa-plus-square-o","fa fa-podcast","fa fa-power-off","fa fa-print","fa fa-product-hunt","fa fa-puzzle-piece","fa fa-qq","fa fa-qrcode","fa fa-question","fa fa-question-circle","fa fa-question-circle-o","fa fa-quora","fa fa-quote-left","fa fa-quote-right","fa fa-random","fa fa-ravelry","fa fa-rebel","fa fa-recycle","fa fa-reddit","fa fa-reddit-alien","fa fa-reddit-square","fa fa-refresh","fa fa-registered","fa fa-renren","fa fa-repeat","fa fa-reply","fa fa-reply-all","fa fa-retweet","fa fa-road","fa fa-rocket","fa fa-rss","fa fa-rss-square","fa fa-rub","fa fa-safari","fa fa-scissors","fa fa-scribd","fa fa-search","fa fa-search-minus","fa fa-search-plus","fa fa-sellsy","fa fa-server","fa fa-share","fa fa-share-alt","fa fa-share-alt-square","fa fa-share-square","fa fa-share-square-o","fa fa-shield","fa fa-ship","fa fa-shirtsinbulk","fa fa-shopping-bag","fa fa-shopping-basket","fa fa-shopping-cart","fa fa-shower","fa fa-sign-in","fa fa-sign-language","fa fa-sign-out","fa fa-signal","fa fa-simplybuilt","fa fa-sitemap","fa fa-skyatlas","fa fa-skype","fa fa-slack","fa fa-sliders","fa fa-slideshare","fa fa-smile-o","fa fa-snapchat","fa fa-snapchat-ghost","fa fa-snapchat-square","fa fa-snowflake-o","fa fa-sort","fa fa-sort-alpha-asc","fa fa-sort-alpha-desc","fa fa-sort-amount-asc","fa fa-sort-amount-desc","fa fa-sort-asc","fa fa-sort-desc","fa fa-sort-numeric-asc","fa fa-sort-numeric-desc","fa fa-soundcloud","fa fa-space-shuttle","fa fa-spinner","fa fa-spoon","fa fa-spotify","fa fa-square","fa fa-square-o","fa fa-stack-exchange","fa fa-stack-overflow","fa fa-star","fa fa-star-half","fa fa-star-half-o","fa fa-star-o","fa fa-steam","fa fa-steam-square","fa fa-step-backward","fa fa-step-forward","fa fa-stethoscope","fa fa-sticky-note","fa fa-sticky-note-o","fa fa-stop","fa fa-stop-circle","fa fa-stop-circle-o","fa fa-street-view","fa fa-strikethrough","fa fa-stumbleupon","fa fa-stumbleupon-circle","fa fa-subscript","fa fa-subway","fa fa-suitcase","fa fa-sun-o","fa fa-superpowers","fa fa-superscript","fa fa-table","fa fa-tablet","fa fa-tachometer","fa fa-tag","fa fa-tags","fa fa-tasks","fa fa-taxi","fa fa-telegram","fa fa-television","fa fa-tencent-weibo","fa fa-terminal","fa fa-text-height","fa fa-text-width","fa fa-th","fa fa-th-large","fa fa-th-list","fa fa-themeisle","fa fa-thermometer-empty","fa fa-thermometer-full","fa fa-thermometer-half","fa fa-thermometer-quarter","fa fa-thermometer-three-quarters","fa fa-thumb-tack","fa fa-thumbs-down","fa fa-thumbs-o-down","fa fa-thumbs-o-up","fa fa-thumbs-up","fa fa-ticket","fa fa-times","fa fa-times-circle","fa fa-times-circle-o","fa fa-tint","fa fa-toggle-off","fa fa-toggle-on","fa fa-trademark","fa fa-train","fa fa-transgender","fa fa-transgender-alt","fa fa-trash","fa fa-trash-o","fa fa-tree","fa fa-trello","fa fa-tripadvisor","fa fa-trophy","fa fa-truck","fa fa-try","fa fa-tty","fa fa-tumblr","fa fa-tumblr-square","fa fa-twitch","fa fa-twitter","fa fa-twitter-square","fa fa-umbrella","fa fa-underline","fa fa-undo","fa fa-universal-access","fa fa-university","fa fa-unlock","fa fa-unlock-alt","fa fa-upload","fa fa-usb","fa fa-usd","fa fa-user","fa fa-user-circle","fa fa-user-circle-o","fa fa-user-md","fa fa-user-o","fa fa-user-plus","fa fa-user-secret","fa fa-user-times","fa fa-users","fa fa-venus","fa fa-venus-double","fa fa-venus-mars","fa fa-viacoin","fa fa-viadeo","fa fa-viadeo-square","fa fa-video-camera","fa fa-vimeo","fa fa-vimeo-square","fa fa-vine","fa fa-vk","fa fa-volume-control-phone","fa fa-volume-down","fa fa-volume-off","fa fa-volume-up","fa fa-weibo","fa fa-weixin","fa fa-whatsapp","fa fa-wheelchair","fa fa-wheelchair-alt","fa fa-wifi","fa fa-wikipedia-w","fa fa-window-close","fa fa-window-close-o","fa fa-window-maximize","fa fa-window-minimize","fa fa-window-restore","fa fa-windows","fa fa-wordpress","fa fa-wpbeginner","fa fa-wpexplorer","fa fa-wpforms","fa fa-wrench","fa fa-xing","fa fa-xing-square","fa fa-y-combinator","fa fa-yahoo","fa fa-yelp","fa fa-yoast","fa fa-youtube","fa fa-youtube-play","fa fa-youtube-square");
	}
}

if( ! function_exists('freddo_options')){
	function freddo_options($name, $default = false) {
		$options = ( get_option( 'freddo_theme_options' ) ) ? get_option( 'freddo_theme_options' ) : null;
		// return the option if it exists
		if ( isset( $options[ $name ] ) ) {
			return apply_filters( "freddo_theme_options_{$name}", $options[ $name ] );
		}
		// return default if nothing else
		return apply_filters( "freddo_theme_options_{$name}", $default );
	}
}

if( ! function_exists('freddo_allowed_html')){
	function freddo_allowed_html() {
		$allowed_tags = array(
			'a' => array(
				'class' => array(),
				'id'    => array(),
				'href'  => array(),
				'rel'   => array(),
				'title' => array(),
				'target' => array(),
			),
			'abbr' => array(
				'title' => array(),
			),
			'b' => array(),
			'blockquote' => array(
				'cite'  => array(),
			),
			'cite' => array(
				'title' => array(),
			),
			'code' => array(),
			'del' => array(
				'datetime' => array(),
				'title' => array(),
			),
			'dd' => array(),
			'div' => array(
				'class' => array(),
				'title' => array(),
				'style' => array(),
			),
			'dl' => array(),
			'dt' => array(),
			'em' => array(),
			'h1' => array(),
			'h2' => array(),
			'h3' => array(),
			'h4' => array(),
			'h5' => array(),
			'h6' => array(),
			'i' => array(),
			'br' => array(),
			'img' => array(
				'alt'    => array(),
				'class'  => array(),
				'height' => array(),
				'src'    => array(),
				'width'  => array(),
			),
			'li' => array(
				'class' => array(),
			),
			'ol' => array(
				'class' => array(),
			),
			'p' => array(
				'class' => array(),
			),
			'q' => array(
				'cite' => array(),
				'title' => array(),
			),
			'span' => array(
				'class' => array(),
				'title' => array(),
				'style' => array(),
			),
			'strike' => array(),
			'strong' => array(),
			'ul' => array(
				'class' => array(),
			),
		);
		return $allowed_tags;
	}
}

if( ! function_exists('freddo_show_social_network')){
	function freddo_show_social_network() {
		$openLinks = freddo_options('_social_open_links', '_self');
		$facebookURL = freddo_options('_facebookurl', '');
		$twitterURL = freddo_options('_twitterurl', '');
		$googleplusURL = freddo_options('_googleplusurl', '');
		$linkedinURL = freddo_options('_linkedinurl', '');
		$instagramURL = freddo_options('_instagramurl', '');
		$youtubeURL = freddo_options('_youtubeurl', '');
		$pinterestURL = freddo_options('_pinteresturl', '');
		$tumblrURL = freddo_options('_tumblrurl', '');
		$flickrURL = freddo_options('_flickrurl', '');
		$vkURL = freddo_options('_vkurl', '');
		$xingURL = freddo_options('_xingurl', '');
		$redditURL = freddo_options('_redditurl', '');
		$vimeoURL = freddo_options('_vimeourl', '');
		?>
			<?php if ($facebookURL) : ?>
				<a class="freddo-social" href="<?php echo esc_url($facebookURL); ?>" target="<?php echo esc_attr($openLinks); ?>" title="<?php esc_attr_e( 'Facebook', 'freddo' ); ?>"><i class="fa fa-facebook spaceLeftRight"><span class="screen-reader-text"><?php esc_html_e( 'Facebook', 'freddo' ); ?></span></i></a>
			<?php endif; ?>
			<?php if ($twitterURL) : ?>
				<a class="freddo-social" href="<?php echo esc_url($twitterURL); ?>" target="<?php echo esc_attr($openLinks); ?>" title="<?php esc_attr_e( 'Twitter', 'freddo' ); ?>"><i class="fa fa-twitter spaceLeftRight"><span class="screen-reader-text"><?php esc_html_e( 'Twitter', 'freddo' ); ?></span></i></a>
			<?php endif; ?>
			<?php if ($googleplusURL) : ?>
				<a class="freddo-social" href="<?php echo esc_url($googleplusURL); ?>" target="<?php echo esc_attr($openLinks); ?>" title="<?php esc_attr_e( 'Google Plus', 'freddo' ); ?>"><i class="fa fa-google-plus spaceLeftRight"><span class="screen-reader-text"><?php esc_html_e( 'Google Plus', 'freddo' ); ?></span></i></a>
			<?php endif; ?>
			<?php if ($linkedinURL) : ?>
				<a class="freddo-social" href="<?php echo esc_url($linkedinURL); ?>" target="<?php echo esc_attr($openLinks); ?>" title="<?php esc_attr_e( 'Linkedin', 'freddo' ); ?>"><i class="fa fa-linkedin spaceLeftRight"><span class="screen-reader-text"><?php esc_html_e( 'Linkedin', 'freddo' ); ?></span></i></a>
			<?php endif; ?>
			<?php if ($instagramURL) : ?>
				<a class="freddo-social" href="<?php echo esc_url($instagramURL); ?>" target="<?php echo esc_attr($openLinks); ?>" title="<?php esc_attr_e( 'Instagram', 'freddo' ); ?>"><i class="fa fa-instagram spaceLeftRight"><span class="screen-reader-text"><?php esc_html_e( 'Instagram', 'freddo' ); ?></span></i></a>
			<?php endif; ?>
			<?php if ($youtubeURL) : ?>
				<a class="freddo-social" href="<?php echo esc_url($youtubeURL); ?>" target="<?php echo esc_attr($openLinks); ?>" title="<?php esc_attr_e( 'YouTube', 'freddo' ); ?>"><i class="fa fa-youtube spaceLeftRight"><span class="screen-reader-text"><?php esc_html_e( 'YouTube', 'freddo' ); ?></span></i></a>
			<?php endif; ?>
			<?php if ($pinterestURL) : ?>
				<a class="freddo-social" href="<?php echo esc_url($pinterestURL); ?>" target="<?php echo esc_attr($openLinks); ?>" title="<?php esc_attr_e( 'Pinterest', 'freddo' ); ?>"><i class="fa fa-pinterest spaceLeftRight"><span class="screen-reader-text"><?php esc_html_e( 'Pinterest', 'freddo' ); ?></span></i></a>
			<?php endif; ?>
			<?php if ($tumblrURL) : ?>
				<a class="freddo-social" href="<?php echo esc_url($tumblrURL); ?>" target="<?php echo esc_attr($openLinks); ?>" title="<?php esc_attr_e( 'Tumblr', 'freddo' ); ?>"><i class="fa fa-tumblr spaceLeftRight"><span class="screen-reader-text"><?php esc_html_e( 'Tumblr', 'freddo' ); ?></span></i></a>
			<?php endif; ?>
			<?php if ($flickrURL) : ?>
				<a class="freddo-social" href="<?php echo esc_url($flickrURL); ?>" target="<?php echo esc_attr($openLinks); ?>" title="<?php esc_attr_e( 'Flickr', 'freddo' ); ?>"><i class="fa fa-flickr spaceLeftRight"><span class="screen-reader-text"><?php esc_html_e( 'Flickr', 'freddo' ); ?></span></i></a>
			<?php endif; ?>
			<?php if ($vkURL) : ?>
				<a class="freddo-social" href="<?php echo esc_url($vkURL); ?>" target="<?php echo esc_attr($openLinks); ?>" title="<?php esc_attr_e( 'VK', 'freddo' ); ?>"><i class="fa fa-vk spaceLeftRight"><span class="screen-reader-text"><?php esc_html_e( 'VK', 'freddo' ); ?></span></i></a>
			<?php endif; ?>
			<?php if ($xingURL) : ?>
				<a class="freddo-social" href="<?php echo esc_url($xingURL); ?>" target="<?php echo esc_attr($openLinks); ?>" title="<?php esc_attr_e( 'Xing', 'freddo' ); ?>"><i class="fa fa-xing spaceLeftRight"><span class="screen-reader-text"><?php esc_html_e( 'Xing', 'freddo' ); ?></span></i></a>
			<?php endif; ?>
			<?php if ($redditURL) : ?>
				<a class="freddo-social" href="<?php echo esc_url($redditURL); ?>" target="<?php echo esc_attr($openLinks); ?>" title="<?php esc_attr_e( 'Reddit', 'freddo' ); ?>"><i class="fa fa-reddit-alien spaceLeftRight"><span class="screen-reader-text"><?php esc_html_e( 'Reddit', 'freddo' ); ?></span></i></a>
			<?php endif; ?>
			<?php if ($vimeoURL) : ?>
				<a class="freddo-social" href="<?php echo esc_url($vimeoURL); ?>" target="<?php echo esc_attr($openLinks); ?>" title="<?php esc_attr_e( 'Vimeo', 'freddo' ); ?>"><i class="fa fa-vimeo spaceLeftRight"><span class="screen-reader-text"><?php esc_html_e( 'Vimeo', 'freddo' ); ?></span></i></a>
			<?php endif; ?>
		<?php
	}
}

if( ! function_exists('freddo_loadingPage')){
	function freddo_loadingPage () {
		echo '<div class="fLoader1"><div></div></div>';
	}
}

/**
* One page map
*/
if( ! function_exists('freddo_sectionmap')){
	function freddo_sectionmap() {
		if (freddo_options('_onepage_settings_sectionmap', '') == 1) {
			$singleSection = 'slider,aboutus,features,skills,cta,services,blog,team,contact';
			$values = explode( ',', $singleSection );
			echo '<ul class="freddo_sectionmap">';
			foreach( $values as $val ) {
				if(freddo_options('_onepage_section_'.$val) == 1) {
					$sectionID = freddo_options('_onepage_id_'.$val, $val);
					$sectionText = freddo_options('_onepage_settings_map_'.$val);
					if ($sectionText) {
						echo '<li class="' . esc_attr($sectionID) . '"><a href="#' . esc_attr($sectionID) . '"><span class="box"></span></a><span class="text">' .esc_html($sectionText). '</span></li>';
					}
				}
			}
			echo '</ul>';
		}
	}
}

/**
 * Add Custom CSS to Header 
 */
function freddo_custom_css_styles() {
	echo '<style type="text/css">';
	$headerBackgroundColor = freddo_options('_header_background_color', '#121212');
	$headerTextColor = freddo_options('_header_text_color', '#f5f5f5');
	$headerAccentColor = freddo_options('_header_accent_color', '#FF1654');
	$contentBackgroundColor = freddo_options('_content_background_color', '#f5f5f5');
	$contentTextColor = freddo_options('_content_text_color', '#121212');
	$contentAccentColor = freddo_options('_content_accent_color', '#FF1654');
	$contentBorderColor = freddo_options('_content_border_color', '#e0e0e0');
	$sidebarBackgroundColor = freddo_options('_sidebar_background_color', '#f5f5f5');
	$sidebarTextColor = freddo_options('_sidebar_text_color', '#121212');
	$sidebarAccentColor = freddo_options('_sidebar_accent_color', '#FF1654');
	$footerBackgroundColor = freddo_options('_footer_background_color', '#222222');
	$footerTextColor = freddo_options('_footer_text_color', '#afafaf');
	$footerAccentColor = freddo_options('_footer_accent_color', '#e4e2e2');
	/* Header Text Color */
	?>
	.site-branding .site-description,
	.main-navigation > div > ul > li > a,
	.site-branding .site-title a,
	.freddoBigText header.entry-header,
	.freddoBigText header.entry-header .entry-meta > span i,
	.freddoBigText header.entry-header .entry-meta > span a,
	.main-navigation ul ul a,
	header.site-header .crestaMenuButton a,
	.flex-direction-nav a,
	.flexslider:hover .flex-direction-nav .flex-prev:hover,
	.flexslider:hover .flex-direction-nav .flex-next:hover,
	.flexslider .slides > li .flexText .inside,
	.scrollDown,
	.menu-toggle,
	.menu-toggle:hover,
	.menu-toggle:focus,
	.menu-toggle:active {
		color: <?php echo esc_html($headerTextColor); ?>;
	}
	header.site-header .crestaMenuButton:hover a,
	header.site-header .crestaMenuButton:active a,
	header.site-header .crestaMenuButton:focus a {
		color: <?php echo esc_html($headerTextColor); ?> !important;
	}
	.search-button .search-line,
	.hamburger-menu .hamburger-inner,
	.hamburger-menu .hamburger-inner:after,
	.hamburger-menu .hamburger-inner:before,
	.scrollDown span:before {
		background-color: <?php echo esc_html($headerTextColor); ?>;
	}
	.search-button .search-circle,
	.scrollDown span:after {
		border-color: <?php echo esc_html($headerTextColor); ?>;
	}
	@media all and (max-width: 1024px) {
		.main-navigation ul li .indicator,
		.main-navigation > div > ul > li > a,
		.main-navigation ul ul a {
			border-color: <?php echo esc_html($headerTextColor); ?>;
		}
		.main-navigation ul li .indicator:before {
			color: <?php echo esc_html($headerTextColor); ?>;
		}
	}
	<?php
	/* Header Accent Color */
	?>
	header.site-header .crestaMenuButton,
	.freddoBigText header.entry-header .entry-meta > span i,
	.main-navigation > div > ul > li > a::before,
	.flex-control-paging li a,
	.menu-toggle,
	.menu-toggle:hover,
	.menu-toggle:focus,
	.menu-toggle:active,
	.flexslider .slides > li .flexText .inside h2:after {
		background-color: <?php echo esc_html($headerAccentColor); ?>;
	}
	<?php
	/* Header Background Color */
	list($r, $g, $b) = sscanf($headerBackgroundColor, '#%02x%02x%02x');
	?>
	header.site-header {
		background-color: rgba(<?php echo esc_html($r).', '.esc_html($g).', '.esc_html($b); ?>,0.0);
	}
	header.site-header.menuMinor,
	header.site-header.noImage {
		background-color: rgba(<?php echo esc_html($r).', '.esc_html($g).', '.esc_html($b); ?>,1);
	}
	.flexslider .slides > li .flexText,
	.freddoImageOp {
		background-color: rgba(<?php echo esc_html($r).', '.esc_html($g).', '.esc_html($b); ?>,0.4);
	}
	.main-navigation ul ul a {
		background-color: <?php echo esc_html($headerBackgroundColor); ?>;
	}
	@media all and (max-width: 1024px) {
		header.site-header {
			background-color: rgba(<?php echo esc_html($r).', '.esc_html($g).', '.esc_html($b); ?>,1) !important;
		}
		.main-navigation.toggled .nav-menu {
			background: <?php echo esc_html($headerBackgroundColor); ?>;
		}
	}
	<?php
	/* Content Accent Color */
	?>
	a, a:visited,
	blockquote::before,
	.woocommerce ul.products > li .price,
	.woocommerce div.product .summary .price {
		color: <?php echo esc_html($contentAccentColor); ?>;
	}
	hr,
	.navigation.pagination .nav-links .prev,
	.woocommerce-pagination > ul.page-numbers li a.prev,
	.navigation.pagination .nav-links .next,
	.woocommerce-pagination > ul.page-numbers li a.next,
	.navigation.pagination .nav-links a,
	.woocommerce-pagination > ul.page-numbers li a,
	#wp-calendar > caption,
	.hentry header.entry-header .entry-meta > span i,
	.hentry footer.entry-footer span:not(.read-more) i,
	.tagcloud a,
	button,
	input[type="button"],
	input[type="reset"],
	input[type="submit"],
	.entry-featuredImg .entry-featuredImg-border:before,
	.entry-wooImage .entry-featuredImg-border:before,
	.entry-featuredImg .entry-featuredImg-border:after,
	.entry-wooImage .entry-featuredImg-border:after,
	footer.entry-footer span.read-more a, a.more-link,
	#toTop,
	.content-area .onsale,
	.woocommerce .wooImage .button,
	.woocommerce .wooImage .added_to_cart,
	.woocommerce-error li a,
	.woocommerce-message a,
	.return-to-shop a,
	.wc-proceed-to-checkout .button.checkout-button,
	.widget_shopping_cart p.buttons a,
	.woocommerce .wishlist_table td.product-add-to-cart a,
	.woocommerce .content-area .woocommerce-tabs .tabs li.active a,
	.widget_price_filter .ui-slider .ui-slider-range,
	.widget_price_filter .ui-slider .ui-slider-handle,
	.freddoButton,
	.freddoButton.aboutus a,
	.freddo_main_text:after,
	.serviceText:after,
	ul.freddo_sectionmap li a span.box,
	ul.freddo_sectionmap li span.text,
	.page-links a {
		background-color: <?php echo esc_html($contentAccentColor); ?>;
	}
	blockquote,
	.navigation.pagination .nav-links span.current,
	.woocommerce-pagination > ul.page-numbers li span,
	.widget .widget-title h3,
	#wp-calendar tbody td#today,
	footer.site-footer,
	.woocommerce ul.products > li:hover,
	.woocommerce ul.products > li:focus,
	.woocommerce ul.products > li h2:after {
		border-color: <?php echo esc_html($contentAccentColor); ?>;
	}
	<?php
	/* Sidebar Push Accent Color */
	?>
	#tertiary.widget-area a {
		color: <?php echo esc_html($sidebarAccentColor); ?>;
	}
	#tertiary.widget-area .tagcloud a,
	#tertiary.widget-area button,
	#tertiary.widget-area input[type="button"],
	#tertiary.widget-area input[type="reset"],
	#tertiary.widget-area input[type="submit"],
	#tertiary.widget-area .widget_price_filter .ui-slider .ui-slider-range,
	#tertiary.widget-area .widget_price_filter .ui-slider .ui-slider-handle {
		background-color: <?php echo esc_html($sidebarAccentColor); ?>;
	}
	#tertiary.widget-area .widget .widget-title h3,
	#tertiary.widget-area #wp-calendar tbody td#today {
		border-color: <?php echo esc_html($sidebarAccentColor); ?>;
	}
	<?php
	/* Footer Accent Color */
	?>
	footer.site-footer a {
		color: <?php echo esc_html($footerAccentColor); ?>;
	}
	.mainFooter .freddoFooterWidget .tagcloud a,
	.mainFooter .freddoFooterWidget button,
	.mainFooter .freddoFooterWidget input[type="button"],
	.mainFooter .freddoFooterWidget input[type="reset"],
	.mainFooter .freddoFooterWidget input[type="submit"],
	.mainFooter .freddoFooterWidget .widget_price_filter .ui-slider .ui-slider-range,
	.mainFooter .freddoFooterWidget .widget_price_filter .ui-slider .ui-slider-handle {
		background-color: <?php echo esc_html($footerAccentColor); ?>;
	}
	.mainFooter .freddoFooterWidget aside.footer .widget .widget-title h3,
	.mainFooter .freddoFooterWidget aside.footer #wp-calendar tbody td#today {
		border-color: <?php echo esc_html($footerAccentColor); ?>;
	}
	<?php
	/* Footer Background Color */
	?>
	footer.site-footer {
		background-color: <?php echo esc_html($footerBackgroundColor); ?>;
	}
	.mainFooter .freddoFooterWidget .tagcloud a,
	.mainFooter .freddoFooterWidget button,
	.mainFooter .freddoFooterWidget input[type="button"],
	.mainFooter .freddoFooterWidget input[type="reset"],
	.mainFooter .freddoFooterWidget input[type="submit"] {
		color: <?php echo esc_html($footerBackgroundColor); ?>;
	}
	<?php
	/* Footer Text Color */
	?>
	footer.site-footer {
		color: <?php echo esc_html($footerTextColor); ?>;
	}
	.mainFooter .freddoFooterWidget .tagcloud a:hover,
	.mainFooter .freddoFooterWidget .tagcloud a:focus,
	.mainFooter .freddoFooterWidget .tagcloud a:active {
		background-color: <?php echo esc_html($footerTextColor); ?>;
	}
	<?php
	/* Content Text Color */
	list($r, $g, $b) = sscanf($contentTextColor, '#%02x%02x%02x');
	?>
	body,
	input,
	select,
	optgroup,
	textarea,
	input[type="text"],
	input[type="email"],
	input[type="url"],
	input[type="password"],
	input[type="search"],
	input[type="number"],
	input[type="tel"],
	input[type="range"],
	input[type="date"],
	input[type="month"],
	input[type="week"],
	input[type="time"],
	input[type="datetime"],
	input[type="datetime-local"],
	input[type="color"],
	textarea,
	a:hover,
	a:focus,
	a:active,
	.nav-links .meta-nav,
	.search-container input[type="search"],
	.hentry header.entry-header .entry-meta > span a,
	.hentry header.entry-header h2 a,
	.hentry footer.entry-footer span:not(.read-more) a {
		color: <?php echo esc_html($contentTextColor); ?>;
	}
	.woocommerce ul.products > li .price {
		color: <?php echo esc_html($contentTextColor); ?> !important;
	}
	.search-container ::-webkit-input-placeholder {
		color: <?php echo esc_html($contentTextColor); ?>;
	}
	.search-container ::-moz-placeholder {
		color: <?php echo esc_html($contentTextColor); ?>;
	}
	.search-container :-ms-input-placeholder {
		color: <?php echo esc_html($contentTextColor); ?>;
	}
	.search-container :-moz-placeholder {
		color: <?php echo esc_html($contentTextColor); ?>;
	}
	button:hover,
	input[type="button"]:hover,
	input[type="reset"]:hover,
	input[type="submit"]:hover,
	button:active, button:focus,
	input[type="button"]:active,
	input[type="button"]:focus,
	input[type="reset"]:active,
	input[type="reset"]:focus,
	input[type="submit"]:active,
	input[type="submit"]:focus,
	.navigation.pagination .nav-links a:hover,
	.navigation.pagination .nav-links a:focus,
	.woocommerce-pagination > ul.page-numbers li a:hover,
	.woocommerce-pagination > ul.page-numbers li a:focus,
	.tagcloud a:hover,
	.tagcloud a:focus,
	.tagcloud a:active,
	footer.entry-footer span.read-more a:hover,
	footer.entry-footer span.read-more a:focus,
	a.more-link:hover,
	a.more-link:focus,
	.woocommerce ul.products > li:hover .wooImage .button,
	.woocommerce ul.products > li:hover .wooImage .added_to_cart,
	.woocommerce-error li a:hover,
	.woocommerce-message a:hover,
	.return-to-shop a:hover,
	.wc-proceed-to-checkout .button.checkout-button:hover,
	.widget_shopping_cart p.buttons a:hover,
	.freddoButton:hover,
	.freddoButton:focus,
	.freddoButton:active,
	.freddoButton.aboutus a:hover,
	.freddoButton.aboutus a:focus,
	.freddoButton.aboutus a:active,
	.page-links > .page-links-number {
		background-color: <?php echo esc_html($contentTextColor); ?>;
	}
	.entry-featuredImg .entry-featuredImg-border,
	.entry-wooImage .entry-featuredImg-border {
		background-color: rgba(<?php echo esc_html($r).', '.esc_html($g).', '.esc_html($b); ?>,0.0);
	}
	.entry-featuredImg:hover .entry-featuredImg-border,
	.entry-featuredImg:focus .entry-featuredImg-border,
	.woocommerce ul.products > li:hover .entry-featuredImg-border,
	.woocommerce ul.products > li:focus .entry-featuredImg-border {
		background-color: rgba(<?php echo esc_html($r).', '.esc_html($g).', '.esc_html($b); ?>,0.2);
	}
	input[type="text"]:focus,
	input[type="email"]:focus,
	input[type="url"]:focus,
	input[type="password"]:focus,
	input[type="search"]:focus,
	input[type="number"]:focus,
	input[type="tel"]:focus,
	input[type="range"]:focus,
	input[type="date"]:focus,
	input[type="month"]:focus,
	input[type="week"]:focus,
	input[type="time"]:focus,
	input[type="datetime"]:focus,
	input[type="datetime-local"]:focus,
	input[type="color"]:focus,
	textarea:focus,
	select:focus {
		border-color: <?php echo esc_html($contentTextColor); ?>;
	}
	.fLoader1 {
		border-bottom: <?php echo esc_html($contentTextColor); ?> 2px solid;
		border-left: <?php echo esc_html($contentTextColor); ?> 2px solid;
	}
	.fLoader1 div {
		border-bottom: <?php echo esc_html($contentTextColor); ?> 2px solid;
		border-right: <?php echo esc_html($contentTextColor); ?> 2px solid;
	}
	<?php
	/* Content Background Color */
	?>
	button,
	input[type="button"],
	input[type="reset"],
	input[type="submit"],
	.navigation.pagination .nav-links .prev,
	.woocommerce-pagination > ul.page-numbers li a.prev,
	.navigation.pagination .nav-links .next,
	.woocommerce-pagination > ul.page-numbers li a.next,
	.navigation.pagination .nav-links a,
	.woocommerce-pagination > ul.page-numbers li a,
	#wp-calendar > caption,
	.tagcloud a,
	footer.entry-footer span.read-more a, a.more-link,
	#toTop,
	.content-area .onsale,
	.woocommerce .wooImage .button,
	.woocommerce .wooImage .added_to_cart,
	.woocommerce-error li a,
	.woocommerce-message a,
	.return-to-shop a,
	.wc-proceed-to-checkout .button.checkout-button,
	.widget_shopping_cart p.buttons a,
	.woocommerce .wishlist_table td.product-add-to-cart a,
	.woocommerce .content-area .woocommerce-tabs .tabs li.active a,
	.widget_price_filter .price_slider_amount .button,
	.woocommerce div.product form.cart .button,
	.freddoButton a, .freddoButton a:hover, .freddoButton a:focus, .freddoButton a:active,
	ul.freddo_sectionmap li span.text,
	.page-links a,
	.page-links a:hover,
	.page-links a:focus,
	.page-links a:active,
	.page-links > .page-links-number {
		color: <?php echo esc_html($contentBackgroundColor); ?>;
	}
	body,
	select,
	.search-container .focus-bg,
	.freddoLoader {
		background-color: <?php echo esc_html($contentBackgroundColor); ?>;
	}
	<?php
	/* Content Border Color */
	?>
	input ~ .focus-bg, textarea ~ .focus-bg,
	#wp-calendar th,
	header.page-header,
	.wp-caption .wp-caption-text,
	.woocommerce .content-area .woocommerce-tabs .tabs,
	.woocommerce-message,
	.woocommerce-info,
	.woocommerce-error,
	.woocommerce table.shop_attributes tr,
	.woocommerce table.shop_attributes tr th,
	.woocommerce-page .entry-content table thead th,
	.woocommerce-page .entry-content table tr:nth-child(even),
	#payment .payment_methods li .payment_box,
	.widget_price_filter .price_slider_wrapper .ui-widget-content {
		background-color: <?php echo esc_html($contentBorderColor); ?>;
	}
	.star-rating:before {
		color: <?php echo esc_html($contentBorderColor); ?>;
	}
	input[type="text"],
	input[type="email"],
	input[type="url"],
	input[type="password"],
	input[type="search"],
	input[type="number"],
	input[type="tel"],
	input[type="range"],
	input[type="date"],
	input[type="month"],
	input[type="week"],
	input[type="time"],
	input[type="datetime"],
	input[type="datetime-local"],
	input[type="color"],
	textarea,
	.inc-input input:focus,
	.inc-input textarea:focus,
	select,
	.site-main .post-navigation,
	#wp-calendar tbody td,
	aside ul.menu .indicatorBar,
	.hentry,
	#comments ol .pingback,
	#comments ol article,
	#comments .reply,
	.woocommerce ul.products > li,
	body.woocommerce form.cart,
	.woocommerce .product_meta,
	.woocommerce .single_variation,
	.woocommerce .woocommerce-tabs,
	.woocommerce #reviews #comments ol.commentlist li .comment-text,
	.woocommerce p.stars a.star-1,
	.woocommerce p.stars a.star-2,
	.woocommerce p.stars a.star-3,
	.woocommerce p.stars a.star-4,
	.single-product div.product .woocommerce-product-rating,
	.woocommerce-page .entry-content table,
	.woocommerce-page .entry-content table thead th,
	#order_review, #order_review_heading,
	#payment,
	#payment .payment_methods li,
	.widget_shopping_cart p.total {
		border-color: <?php echo esc_html($contentBorderColor); ?>;
	}
	aside ul li,
	aside ul.menu li a {
		border-bottom-color: <?php echo esc_html($contentBorderColor); ?>;
	}
	<?php
	/* Push Sidebar Text Color */
	list($r, $g, $b) = sscanf($sidebarTextColor, '#%02x%02x%02x');
	?>
	#tertiary.widget-area,
	.close-hamburger,
	#tertiary.widget-area a:hover,
	#tertiary.widget-area a:focus,
	#tertiary.widget-area a:active {
		color: <?php echo esc_html($sidebarTextColor); ?>;
	}
	#tertiary.widget-area .tagcloud a:hover,
	#tertiary.widget-area .tagcloud a:focus,
	#tertiary.widget-area .tagcloud a:active,
	.close-ham-inner:before,
	.close-ham-inner:after,
	.nano > .nano-pane > .nano-slider {
		background-color: <?php echo esc_html($sidebarTextColor); ?>;
	}
	.nano > .nano-pane {
		background-color: rgba(<?php echo esc_html($r).', '.esc_html($g).', '.esc_html($b); ?>,0.15);
	}
	.nano > .nano-pane > .nano-slider {
		background-color: rgba(<?php echo esc_html($r).', '.esc_html($g).', '.esc_html($b); ?>,0.3);
	}
	<?php
	/* Push Sidebar Background Color */
	?>
	#tertiary.widget-area {
		background-color: <?php echo esc_html($sidebarBackgroundColor); ?>;
	}
	#tertiary.widget-area .tagcloud a,
	#tertiary.widget-area button,
	#tertiary.widget-area input[type="button"],
	#tertiary.widget-area input[type="reset"],
	#tertiary.widget-area input[type="submit"] {
		color: <?php echo esc_html($sidebarBackgroundColor); ?>;
	}
	<?php
	/* One page colors settings */
	if (is_page_template('template-onepage.php')) {
		$showAboutus = freddo_options('_onepage_section_aboutus', '');
		$showFeatures = freddo_options('_onepage_section_features', '');
		$showSkills = freddo_options('_onepage_section_skills', '');
		$showCta = freddo_options('_onepage_section_cta', '');
		$showServices = freddo_options('_onepage_section_services', '');
		$showBlog = freddo_options('_onepage_section_blog', '');
		$showTeam = freddo_options('_onepage_section_team', '');
		$showContact = freddo_options('_onepage_section_contact', '');
		if ($showAboutus == 1) {
			$aboutusImageBack = freddo_options('_onepage_imgback_aboutus');
			$aboutusColorBack = freddo_options('_onepage_imgcolor_aboutus', '#f5f5f5');
			$aboutusColorText = freddo_options('_onepage_textcolor_aboutus', '#121212');
			?>
			<?php if (!empty($aboutusImageBack) ) : ?>
				section.freddo_aboutus {
					background-image: url(<?php echo esc_url($aboutusImageBack); ?>);
				}
			<?php else: ?>
				.freddo_aboutus_color {
					opacity : 1;
				}
			<?php endif; ?>
			<?php if (!empty($aboutusColorBack) ) : ?>
				.freddo_aboutus_color  {
					background-color: <?php echo esc_html($aboutusColorBack); ?>;
				}
			<?php endif; ?>
			<?php if (!empty($aboutusColorText) ) : ?>
				section.freddo_aboutus {
					color: <?php echo esc_html($aboutusColorText); ?>;
				}
			<?php endif; ?>
		<?php
		}
		if ($showFeatures == 1) {
			$featuresImageBack = freddo_options('_onepage_imgback_features');
			$featuresColorBack = freddo_options('_onepage_imgcolor_features', '#121212');
			$featuresColorText = freddo_options('_onepage_textcolor_features', '#f5f5f5');
			?>
				<?php if (!empty($featuresImageBack) ) : ?>
					section.freddo_features {
						background-image: url(<?php echo esc_url($featuresImageBack); ?>);
					}
				<?php else: ?>
					.freddo_features_color  {
						opacity : 1;
					}
				<?php endif; ?>
				<?php if (!empty($featuresColorBack) ) : ?>
					.freddo_features_color, .features_columns_single:hover .featuresIcon i, .features_columns_single:focus .featuresIcon i, .features_columns_single:active .featuresIcon i {
						background-color: <?php echo esc_html($featuresColorBack); ?>;
					}
					.features_columns_single .featuresIcon i {
						color: <?php echo esc_html($featuresColorBack); ?>;
					}
				<?php endif; ?>
				<?php if (!empty($featuresColorText) ) : ?>
					section.freddo_features, .features_columns_single:hover .featuresIcon i, .features_columns_single:focus .featuresIcon i, .features_columns_single:active .featuresIcon i {
						color: <?php echo esc_html($featuresColorText); ?>;
					}
					.features_columns_single .featuresIcon i {
						background-color: <?php echo esc_html($featuresColorText); ?>;
					}
				<?php endif; ?>
			<?php
		}
		if ($showSkills == 1) {
			$skillsImageBack = freddo_options('_onepage_imgback_skills');
			$skillsColorBack = freddo_options('_onepage_imgcolor_skills', '#f5f5f5');
			$skillsColorText = freddo_options('_onepage_textcolor_skills', '#121212');
			?>
				<?php if (!empty($skillsImageBack) ) : ?>
					section.freddo_skills {
						background-image: url(<?php echo esc_url($skillsImageBack); ?>);
					}
				<?php else: ?>
					.freddo_skills_color  {
						opacity : 1;
					}
				<?php endif; ?>
				<?php if (!empty($skillsColorBack) ) : ?>
					.freddo_skills_color {
						background-color: <?php echo esc_html($skillsColorBack); ?>;
					}
				<?php endif; ?>
				<?php if (!empty($skillsColorText) ) : ?>
					section.freddo_skills {
						color: <?php echo esc_html($skillsColorText); ?>;
					}
					.skillBottom .skillBar, .skillBottom .skillRealBar, .skillBottom .skillRealBarCyrcle {
						background: <?php echo esc_html($skillsColorText); ?>;
					}
				<?php endif; ?>
			<?php
		}
		if ($showCta == 1) {
			$ctaImageBack = freddo_options('_onepage_imgback_cta');
			$ctaColorBack = freddo_options('_onepage_imgcolor_cta', '#121212');
			$ctaColorText = freddo_options('_onepage_textcolor_cta', '#f5f5f5');
			?>
				<?php if (!empty($ctaImageBack) ) : ?>
					section.freddo_cta {
						background-image: url(<?php echo esc_url($ctaImageBack); ?>);
					}
				<?php else: ?>
					.freddo_cta_color {
						opacity : 1;
					}
				<?php endif; ?>
				<?php if (!empty($ctaColorBack) ) : ?>
					.freddo_cta_color, section.freddo_cta:hover .cta_columns .ctaIcon i, section.freddo_cta:focus .cta_columns .ctaIcon i, section.freddo_cta:active .cta_columns .ctaIcon i {
						background-color: <?php echo esc_html($ctaColorBack); ?>;
					}
					.cta_columns .ctaIcon i {
						color: <?php echo esc_html($ctaColorBack); ?>;
					}
				<?php endif; ?>
				<?php if (!empty($ctaColorText) ) : ?>
					section.freddo_cta, section.freddo_cta:hover .cta_columns .ctaIcon i, section.freddo_cta:focus .cta_columns .ctaIcon i, section.freddo_cta:active .cta_columns .ctaIcon i {
						color: <?php echo esc_html($ctaColorText); ?>;
					}
					.cta_columns .ctaIcon i {
						background: <?php echo esc_html($ctaColorText); ?>;
					}
				<?php endif; ?>
			<?php
		}
		if ($showServices == 1) {
			$servicesImageBack = freddo_options('_onepage_imgback_services');
			$servicesColorBack = freddo_options('_onepage_imgcolor_services', '#f5f5f5');
			$servicesColorText = freddo_options('_onepage_textcolor_services', '#121212');
			?>
				<?php if (!empty($servicesImageBack) ) : ?>
					section.freddo_services {
						background-image: none;
					}
				<?php else: ?>
					.freddo_services_color {
						opacity : 1;
					}
				<?php endif; ?>
				<?php if (!empty($servicesColorBack) ) : ?>
					.freddo_services_color, .services_columns .singleService:hover .serviceIcon i, .services_columns .singleService:focus .serviceIcon i, .services_columns .singleService:active .serviceIcon i {
						background-color: <?php echo esc_html($servicesColorBack); ?>;
					}
					.serviceIcon i, .services_columns_single .serviceContent {
						color: <?php echo esc_html($servicesColorBack); ?>;
					}
				<?php endif; ?>
				<?php if (!empty($servicesColorText) ) : ?>
					section.freddo_services, .services_columns .singleService:hover .serviceIcon i, .services_columns .singleService:focus .serviceIcon i, .services_columns .singleService:active .serviceIcon i {
						color: <?php echo esc_html($servicesColorText); ?>;
					}
					.serviceIcon i {
						background: <?php echo esc_html($servicesColorText); ?>;
					}
					.services_columns_single.two .serviceColumnSingleColor {
						background-color: <?php echo esc_html($servicesColorText); ?>;
					}
				<?php endif; ?>
			<?php
		}
		if ($showBlog == 1) {
			$blogImageBack = freddo_options('_onepage_imgback_blog');
			$blogColorBack = freddo_options('_onepage_imgcolor_blog', '#f5f5f5');
			$blogColorText = freddo_options('_onepage_textcolor_blog', '#121212');
			?>
				<?php if (!empty($blogImageBack) ) : ?>
					section.freddo_blog {
						background-image: url(<?php echo esc_url($blogImageBack); ?>);
					}
				<?php else: ?>
					.freddo_blog_color {
						opacity : 1;
					}
				<?php endif; ?>
				<?php if (!empty($blogColorBack) ) : ?>
					.freddo_blog_color {
						background-color: <?php echo esc_html($blogColorBack); ?>;
					}
				<?php endif; ?>
				<?php if (!empty($blogColorText) ) : ?>
					section.freddo_blog,
					.freddoBlogSingle h2 a,
					.freddoBlogSingle h2 a:hover,
					.freddoBlogSingle h2 a:focus,
					.freddoBlogSingle h2 a:active {
						color: <?php echo esc_html($blogColorText); ?>;
					}
				<?php endif; ?>
			<?php
		}
		if ($showTeam == 1) {
			$teamImageBack = freddo_options('_onepage_imgback_team');
			$teamColorBack = freddo_options('_onepage_imgcolor_team', '#f5f5f5');
			$teamColorText = freddo_options('_onepage_textcolor_team', '#121212');
			?>
				<?php if (!empty($teamImageBack) ) : ?>
					section.freddo_team {
						background-image: url(<?php echo esc_url($teamImageBack); ?>);
					}
				<?php else: ?>
					.freddo_team_color {
						opacity : 1;
					}
				<?php endif; ?>
				<?php if (!empty($teamColorBack) ) : ?>
					.freddo_team_color {
						background-color: <?php echo esc_html($teamColorBack); ?>;
					}
				<?php endif; ?>
				<?php if (!empty($teamColorText) ) : ?>
					section.freddo_team {
						color: <?php echo esc_html($teamColorText); ?>;
					}
				<?php endif; ?>
			<?php
		}
		if ($showContact == 1) {
			$contactImageBack = freddo_options('_onepage_imgback_contact');
			$contactColorBack = freddo_options('_onepage_imgcolor_contact', '#121212');
			$contactColorText = freddo_options('_onepage_textcolor_contact', '#f5f5f5');
			?>
				<?php if (!empty($contactImageBack) ) : ?>
					section.freddo_contact {
						background-image: url(<?php echo esc_url($contactImageBack); ?>);
					}
				<?php else: ?>
					.freddo_contact_color {
						opacity : 1;
					}
				<?php endif; ?>
				<?php if (!empty($contactColorBack) ) : ?>
					.freddo_contact_color {
						background-color: <?php echo esc_html($contactColorBack); ?>;
					}
					.freddoCompanyAddress1Icon,
					.freddoCompanyPhoneIcon,
					.freddoCompanyFaxIcon,
					.freddoCompanyEmailIcon {
						color: <?php echo esc_html($contactColorBack); ?>;
					}
				<?php endif; ?>
				<?php if (!empty($contactColorText) ) : ?>
					section.freddo_contact,
					.contact_columns .freddoContactForm input:not([type="submit"]),
					.contact_columns .freddoContactForm input:not([type="submit"]):focus,
					.contact_columns .freddoContactForm textarea,
					.contact_columns .freddoContactForm textarea:focus {
						color: <?php echo esc_html($contactColorText); ?>;
						border-color: <?php echo esc_html($contactColorText); ?>;
					}
					.freddoCompanyAddress1Icon,
					.freddoCompanyPhoneIcon,
					.freddoCompanyFaxIcon,
					.freddoCompanyEmailIcon {
						background: <?php echo esc_html($contactColorText); ?>;
					}
				<?php endif; ?>
			<?php
		}
	}
	echo '</style>';
}
add_action('wp_head', 'freddo_custom_css_styles');

