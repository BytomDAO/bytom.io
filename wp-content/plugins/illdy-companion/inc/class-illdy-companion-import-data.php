<?php

class Illdy_Companion_Import_Data {

	function __construct() {

		/**
		 * Alter theme recommended actions
		 */
		add_filter( 'illdy_required_actions', array( $this, 'generate_import_data_container' ) );

	}

	public function generate_import_data_container( $actions ) {
		$import_actions = array(
			'set_static_frontpage' => esc_html__( 'Set front page to static page', 'illdy-companion' ),
			'import_customizer'    => esc_html__( 'Import Customizer Setting', 'illdy-companion' ),
			'import_widgets'       => esc_html__( 'Import Widgets', 'illdy-companion' ),
		);
		if ( is_customize_preview() ) {
			$url  = 'themes.php?page=%1$s-welcome&tab=%2$s';
			$html = '<a class="button button-primary" id="" href="' . esc_url( admin_url( sprintf( $url, 'illdy', 'recommended-actions' ) ) ) . '">' . __( 'Import Demo Content', 'illdy-companion' ) . '</a>';
		} else {
			$html  = '<p><a class="button button-primary epsilon-ajax-button" id="add_default_sections" href="#">' . __( 'Import Demo Content', 'illdy-companion' ) . '</a>';
			$html .= '<a class="button epsilon-hidden-content-toggler" href="#welcome-hidden-content">' . __( 'Advanced', 'illdy-companion' ) . '</a></p>';
			$html .= '<div class="import-content-container" id="welcome-hidden-content">';
			$html .= '<div class="demo-content-container">';
			$html .= '<div class="checkbox-group">';
			foreach ( $import_actions as $id => $label ) {
				$html .= $this->generate_checkbox( $id, $label );
			}
			$html .= '</div>';
			$html .= '</div>';
			$html .= '</div>';
		}

		$actions[] = array(
			'id'          => 'illdy-req-ac-import-demo-content',
			'title'       => esc_html__( 'Import Demo Content', 'illdy-companion' ),
			'description' => esc_html__( 'Clicking the button below will add content, widgets and set static front page to your WordPress installation. Click advanced to customize the import process.', 'illdy-companion' ),
			'help'        => $html,
			'check'       => $this->check_content_import(),
		);

		return $actions;
	}

	/**
	 * Generate HTML for a checkbox
	 *
	 * @param $id
	 * @param $label
	 *
	 * @return string
	 */
	private function generate_checkbox( $id, $label ) {
		$string = '<label><input checked type="checkbox" class="demo-checkboxes" value="%1$s">%2$s</label>';
		return sprintf( $string, $id, $label );
	}

	public function check_content_import() {
		$illdy_content = get_option( 'illdy_show_required_actions' );
		if ( $illdy_content ) {
			return true;
		}

		return false;
	}

	public static function process_sample_content( $args = array() ) {

		$imported = true;

		if ( is_array( $args ) ) {
			foreach ( $args as $arg ) {
				$response = self::$arg();
				if ( $imported && is_array( $response ) ) {
					$imported = false;
				}
			}
		}
		if ( $imported ) {
			$illdy_show_required_actions                             = get_option( 'illdy_show_required_actions' );
			$illdy_show_required_actions['illdy-req-import-content'] = true;
			update_option( 'illdy_show_required_actions', $illdy_show_required_actions );
			return 'ok';
		} else {
			return 'nok';
		}

	}

	public static function set_static_frontpage() {
		$frontpage_title = __( 'Front Page', 'illdy-companion' );
		$blog_title      = __( 'Blog', 'illdy-companion' );

		$frontpage_id = wp_insert_post(
			array(
				'post_title'  => $frontpage_title,
				'post_status' => 'publish',
				'post_type'   => 'page',
			)
		);
		$blog_id      = wp_insert_post(
			array(
				'post_title'  => $blog_title,
				'post_status' => 'publish',
				'post_type'   => 'page',
			)
		);

		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $frontpage_id );
		update_option( 'page_for_posts', $blog_id );

		return 'ok';
	}

	public static function import_customizer() {

		$illdy_customizer_defaults = array(
			'_services_general'                          => 1,
			'_services_general_title'                    => __( 'Services', 'illdy-companion' ),
			'_services_general_entry'                    => __( 'In order to help you grow your business, our carefully selected experts can advise you in in the following areas:', 'illdy-companion' ),
			'_preloader_enable'                          => 1,
			'_preloader_background_color'                => '#ffffff',
			'_preloader_primary_color'                   => '#f1d204',
			'_preloader_secondly_color'                  => '#ffffff',
			'_text_logo'                                 => __( 'Illdy', 'illdy-companion' ),
			'_contact_bar_facebook_url'                  => '#',
			'_contact_bar_twitter_url'                   => '#',
			'_contact_bar_linkedin_url'                  => '#',
			'_email'                                     => __( 'contact@site.com', 'illdy-companion' ),
			'_phone'                                     => __( '(555) 555-5555', 'illdy-companion' ),
			'_address1'                                  => __( 'Street 221B Baker Street, ', 'illdy-companion' ),
			'_address2'                                  => __( 'London, UK', 'illdy-companion' ),
			'_general_footer_display_copyright'          => 1,
			'_footer_copyright'                          => __( '&copy; Copyright 2016. All Rights Reserved.', 'illdy-companion' ),
			'_img_footer_logo'                           => esc_url_raw( get_template_directory_uri() . '/layout/images/footer-logo.png' ),
			'_enable_post_posted_on_blog_posts'          => 1,
			'_enable_post_category_blog_posts'           => 1,
			'_enable_post_tags_blog_posts'               => 1,
			'_enable_post_comments_blog_posts'           => 1,
			'_enable_social_sharing_blog_posts'          => 1,
			'_enable_author_box_blog_posts'              => 1,
			'_team_general_show'                         => 1,
			'_team_general_title'                        => __( 'Team', 'illdy-companion' ),
			'_team_general_entry'                        => __( 'Meet the people that are going to take your business to the next level.', 'illdy-companion' ),
			'_testimonials_general_show'                 => 1,
			'_testimonials_general_title'                => __( 'Testimonials', 'illdy-companion' ),
			'_testimonials_number_of_posts'              => 4,
			'_about_general_show'                        => 1,
			'_about_general_title'                       => __( 'About', 'illdy-companion' ),
			'_about_general_entry'                       => __( 'It is an amazing one-page theme with great features that offers an incredible experience. It is easy to install, make changes, adapt for your business. A modern design with clean lines and styling for a wide variety of content, exactly how a business design should be. You can add as many images as you want to the main header area and turn them into slider.', 'illdy-companion' ),
			'_contact_us_general_show'                   => 1,
			'_contact_us_general_title'                  => __( 'Contact us', 'illdy-companion' ),
			'_contact_us_general_entry'                  => __( 'And we will get in touch as soon as possible.', 'illdy-companion' ),
			'_contact_us_general_address_title'          => __( 'Address', 'illdy-companion' ),
			'_contact_us_general_customer_support_title' => __( 'Customer Support', 'illdy-companion' ),
			'_counter_general_show'                      => 1,
			'_counter_background_type'                   => 'image',
			'_counter_background_image'                  => esc_url( get_template_directory_uri() . '/layout/images/front-page/front-page-counter.jpg' ),
			'_counter_background_color'                  => '#000000',
			'_jumbotron_general_image'                   => esc_url_raw( get_template_directory_uri() . '/layout/images/front-page/front-page-header.jpg' ),
			'_jumbotron_general_first_row_from_title'    => __( 'Clean', 'illdy-companion' ),
			'_jumbotron_general_second_row_from_title'   => __( 'Slick', 'illdy-companion' ),
			'_jumbotron_general_third_row_from_title'    => __( 'Pixel Perfect', 'illdy-companion' ),
			'_jumbotron_general_entry'                   => __( 'lldy is a great one-page theme, perfect for developers and designers but also for someone who just wants a new website for his business. Try it now!', 'illdy-companion' ),
			'_jumbotron_general_first_button_title'      => __( 'Learn more', 'illdy-companion' ),
			'illdy_jumbotron_general_first_button_url'   => '#',
			'_jumbotron_general_second_button_title'     => __( 'Download', 'illdy-companion' ),
			'illdy_jumbotron_general_second_button_url'  => '#',
			'_latest_news_general_show'                  => 1,
			'_latest_news_general_title'                 => __( 'Latest News', 'illdy-companion' ),
			'_latest_news_general_entry'                 => __( 'If you are interested in the latest articles in the industry, take a sneak peek at our blog. You have nothing to loose!', 'illdy-companion' ),
			'_latest_news_button_text'                   => __( 'See blog', 'illdy-companion' ),
			'_latest_news_number_of_posts'               => 3,
			'_projects_general_show'                     => 1,
			'_projects_general_title'                    => __( 'Projects', 'illdy-companion' ),
			'_projects_general_entry'                    => __( 'You\'ll love our work. Check it out!', 'illdy-companion' ),
			'_general_sections_order_first_section'      => 1,
			'_general_sections_order_second_section'     => 2,
			'_general_sections_order_third_section'      => 3,
			'_general_sections_order_fourth_section'     => 4,
			'_general_sections_order_fifth_section'      => 5,
			'_general_sections_order_sixth_section'      => 6,
			'_general_sections_order_seventh_section'    => 7,
			'_general_sections_order_eighth_section'     => 8,
		);

		// Set prefix
		$prefix = 'illdy';

		foreach ( $illdy_customizer_defaults as $customizer_key => $customizer_value ) {
			if ( ! $force ) {
				$current_value = get_theme_mod( $prefix . $customizer_key );
				if ( '' == $current_value ) {
					set_theme_mod( $prefix . $customizer_key, $customizer_value );
				}
			} else {
				set_theme_mod( $prefix . $customizer_key, $customizer_value );
			}
		}

		return 'ok';

	}

	public static function import_widgets() {

		$json             = '{"footer-sidebar-1":{"text-5":{"title":"PRODUCTS","text":"<ul><li><a href=\"#\" title=\"Our work\">Our work<\/a><\/li><li><a href=\"#\" title=\"Club\">Club<\/a><\/li><li><a href=\"#\" title=\"News\">News<\/a><\/li><li><a href=\"#\" title=\"Announcement\">Announcement<\/a><\/li><\/ul>","filter":false}},"footer-sidebar-2":{"text-6":{"title":"INFORMATION","text":"<ul><li><a href=\"#\" title=\"Pricing\">Pricing<\/a><\/li><li><a href=\"#\" title=\"Terms\">Terms<\/a><\/li><li><a href=\"#\" title=\"Affiliates\">Affiliates<\/a><\/li><li><a href=\"#\" title=\"Blog\">Blog<\/a><\/li><\/ul>","filter":false}},"footer-sidebar-3":{"text-7":{"title":"SUPPORT","text":"<ul><li><a href=\"#\" title=\"Documentation\">Documentation<\/a><\/li><li><a href=\"#\" title=\"FAQs\">FAQs<\/a><\/li><li><a href=\"#\" title=\"Forums\">Forums<\/a><\/li><li><a href=\"#\" title=\"Contact\">Contact<\/a><\/li><\/ul>","filter":false}},"front-page-about-sidebar":{"illdy_skill-2":{"title":"Typography","percentage":60,"icon":"fa fa-font","color":"#f18b6d"},"illdy_skill-3":{"title":"Design","percentage":82,"icon":"fa fa-pencil","color":"#f1d204"},"illdy_skill-4":{"title":"Development","percentage":86,"icon":"fa fa-code","color":"#6a4d8a"}},"front-page-projects-sidebar":{"illdy_project-3":{"title":"Project 1","image":"https:\/\/cdn.colorlib.com\/illdy\/wp-content\/uploads\/sites\/11\/2016\/03\/front-page-project-1.jpg","url":""},"illdy_project-4":{"title":"Project 2","image":"https:\/\/cdn.colorlib.com\/illdy\/wp-content\/uploads\/sites\/11\/2016\/03\/front-page-project-2.jpg","url":""},"illdy_project-5":{"title":"Project 3","image":"https:\/\/cdn.colorlib.com\/illdy\/wp-content\/uploads\/sites\/11\/2016\/03\/front-page-project-3.jpg","url":""},"illdy_project-6":{"title":"Project 4","image":"https:\/\/cdn.colorlib.com\/illdy\/wp-content\/uploads\/sites\/11\/2016\/03\/front-page-project-4.jpg","url":""}},"front-page-services-sidebar":{"illdy_service-2":{"title":"Web Design","icon":"fa fa-pencil","entry":"Consectetur adipiscing elit. Praesent molestie urna hendrerit erat tincidunt tempus. Aliquam a leo risus. Fusce a metus non augue dapibus porttitor at in mauris. Pellentesque commodo...","color":"#f18b6d"},"illdy_service-3":{"title":"WEB DEVELOPMENT","icon":"fa fa-code","entry":"Consectetur adipiscing elit. Praesent molestie urna hendrerit erat tincidunt tempus. Aliquam a leo risus. Fusce a metus non augue dapibus porttitor at in mauris. Pellentesque commodo...","color":"#f1d204"},"illdy_service-4":{"title":"SEO Analisys","icon":"fa fa-search","entry":"Consectetur adipiscing elit. Praesent molestie urna hendrerit erat tincidunt tempus. Aliquam a leo risus. Fusce a metus non augue dapibus porttitor at in mauris. Pellentesque commodo...","color":"#6a4d8a"}},"front-page-counter-sidebar":{"illdy_counter-4":{"title":"Projects","data_from":1,"data_to":260,"data_speed":2000,"data_refresh_interval":100},"illdy_counter-3":{"title":"Clients","data_from":1,"data_to":120,"data_speed":2000,"data_refresh_interval":100},"illdy_counter-2":{"title":"Coffes","data_from":1,"data_to":260,"data_speed":2000,"data_refresh_interval":100}},"front-page-team-sidebar":{"illdy_person-5":{"title":"Mark Lawrance","image":"https://cdn.colorlib.com/illdy/wp-content/themes/illdy\/layout\/images\/front-page\/front-page-team-1.jpg","position":"Web Designer","entry":"Creative, detail-oriented, always focused.","facebook_url":"#","twitter_url":"#","linkedin_url":"#","color":"#f18b6d"},"illdy_person-4":{"title":"Jane Stenton","image":"https:\/\/cdn.colorlib.com\/illdy\/wp-content\/themes\/illdy\/layout\/images\/front-page\/front-page-team-2.jpg","position":"SEO Specialist","entry":"Curious, tech-geeck and gets serious when it comes to work.","facebook_url":"#","twitter_url":"#","linkedin_url":"#","color":"#f1d204"},"illdy_person-2":{"title":"John Smith","image":"https://cdn.colorlib.com/illdy/wp-content/themes/illdy\/layout\/images\/front-page\/front-page-team-3.jpg","position":"Developer","entry":"Enthusiastic, passionate with great sense of humor.","facebook_url":"#","twitter_url":"#","linkedin_url":"#","color":"#6a4d8a"}},"front-page-testimonials-sidebar":{"illdy_testimonial-1":{"name":"Jane Smith","image":"https://cdn.colorlib.com/illdy/wp-content/themes/illdy\/layout\/images\/front-page\/front-page-testimonial-1.jpg","testimonial":"                    Awesome theme with great design and helpfull support. If you don\u2019t know how to code your own WordPress theme, but you still want a good-looking website for your business, Illdy might be exactly what you need. It is a slick theme with a lot of of features to choose from. You can customize whatever section you want and you can rest assure that no matter what device your website is viewed on \u2013 it looks great.            "},"illdy_testimonial-2":{"name":"Jane Smith","image":"https:\/\/cdn.colorlib.com\/illdy\/wp-content\/uploads\/sites\/11/2016\/02\/mike-muller-127x127.jpg","testimonial":"                    Awesome theme with great design and helpfull support. If you don\u2019t know how to code your own WordPress theme, but you still want a good-looking website for your business, Illdy might be exactly what you need. It is a slick theme with a lot of of features to choose from. You can customize whatever section you want and you can rest assure that no matter what device your website is viewed on \u2013 it looks great.            "}}}';
		$config           = json_decode( $json );
		$sidebars_widgets = get_option( 'sidebars_widgets' );
		# Parse config
		foreach ( $config as $sidebar => $elemements ) {
			# verify if the sidebar doesn't have ny widgets
			if ( strpos( $sidebar, 'orphaned_widgets' ) === false && ! is_active_sidebar( $sidebar ) ) {
				# create an empty array for active widgets
				$this_sidebar_active_widgets = array();
				# parse all widgets for current sidebar
				foreach ( $elemements as $id_widget => $args ) {
					# add current widget to current sidebar
					$this_sidebar_active_widgets[] = $id_widget;
					# split widget name in order to get widget name and index
					$id_widget_parts = explode( '-', $id_widget );
					# get widget index
					$index_widget = end( $id_widget_parts );
					#remove widget index from array
					array_pop( $id_widget_parts );
					#generate widget name
					$widget_name = implode( '-', $id_widget_parts );
					#get all widgets who are like current widget
					$widgets = get_option( 'widget_' . $widget_name );
					#check if current index exist in array
					if ( ! isset( $widgets[ $index_widget ] ) ) {
						#add current widget with his index and args
						$widgets[ $index_widget ] = get_object_vars( $args );
					}
					#update widgets who are like current widget
					update_option( 'widget_' . $widget_name, $widgets );
				}
				$sidebars_widgets[ $sidebar ] = $this_sidebar_active_widgets;
			}
		}
		update_option( 'sidebars_widgets', $sidebars_widgets );

		return 'ok';

	}
}
new Illdy_Companion_Import_Data();
