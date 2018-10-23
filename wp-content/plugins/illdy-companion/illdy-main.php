<?php

// Include Illdy Companion Helper
require_once plugin_dir_path( __FILE__ ) . 'inc/class-illdy-companion-helper.php';

// Include Illdy Companion Importer
require_once plugin_dir_path( __FILE__ ) . 'inc/class-illdy-companion-import-data.php';

/**
 * Plugin companion widgets
 */
require_once plugin_dir_path( __FILE__ ) . 'widgets/class-illdy-widget-recent-posts.php';
require_once plugin_dir_path( __FILE__ ) . 'widgets/class-illdy-widget-skill.php';
require_once plugin_dir_path( __FILE__ ) . 'widgets/class-illdy-widget-project.php';
require_once plugin_dir_path( __FILE__ ) . 'widgets/class-illdy-widget-service.php';
require_once plugin_dir_path( __FILE__ ) . 'widgets/class-illdy-widget-counter.php';
require_once plugin_dir_path( __FILE__ ) . 'widgets/class-illdy-widget-person.php';
require_once plugin_dir_path( __FILE__ ) . 'widgets/class-illdy-widget-parallax.php';
require_once plugin_dir_path( __FILE__ ) . 'widgets/class-illdy-widget-testimonial.php';

if ( ! function_exists( 'illdy_companion_admin_scripts' ) ) {

	/**
	 * Function to enqueue admin resources - CSS/JS
	 */
	function illdy_companion_admin_scripts( $hook_suffix ) {

		wp_enqueue_style( 'illdy-companion-admin-css', plugins_url( '/assets/css/admin.css', __FILE__ ) );
		wp_enqueue_style( 'font-awesome', plugins_url( '/assets/css/font-awesome.min.css', __FILE__ ), array(), '4.5.0', 'all' );
		wp_enqueue_style( 'illdy-companion-iconpicker-css', plugins_url( '/assets/css/jquery.fonticonpicker.css', __FILE__ ) );
		wp_enqueue_style( 'illdy-companion-iconpicker-theme-css', plugins_url( '/assets/css/jquery.fonticonpicker.grey.min.css', __FILE__ ) );
		wp_enqueue_script( 'illdy-companion-iconpicker-js', plugins_url( '/assets/js/iconpicker.min.js', __FILE__ ), array( 'jquery' ) );
		wp_enqueue_script( 'illdy-companion-admin-js', plugins_url( '/assets/js/admin.js', __FILE__ ), array( 'jquery' ) );

		wp_localize_script(
			'illdy-companion-admin-js', 'illdyCompanion', array(
				'ajaxurl' => esc_url( admin_url( 'admin-ajax.php' ) ),
			)
		);

		if ( 'widgets.php' == $hook_suffix ) {
			wp_enqueue_script( 'illdy-widget-text-editor', ILLDY_COMPANION_ASSETS_DIR . 'js/widget-text-editor.js', false, '1.0', true );
		}

	}

	add_action( 'admin_enqueue_scripts', 'illdy_companion_admin_scripts' );

}

if ( ! function_exists( 'illdy_companion_customizer_scripts' ) ) {

	/**
	 * Function to enqueue admin resources - CSS/JS
	 */
	function illdy_companion_customizer_scripts() {

		wp_enqueue_style( 'illdy-companion-iconpicker-css', plugins_url( '/assets/css/jquery.fonticonpicker.css', __FILE__ ) );
		wp_enqueue_style( 'font-awesome', plugins_url( '/assets/css/font-awesome.min.css', __FILE__ ), array(), '4.5.0', 'all' );
		wp_enqueue_script( 'illdy-companion-iconpicker-js', plugins_url( '/assets/js/iconpicker.min.js', __FILE__ ), array( 'jquery' ) );
		wp_enqueue_style( 'illdy-companion-iconpicker-theme-css', plugins_url( '/assets/css/jquery.fonticonpicker.grey.min.css', __FILE__ ) );
		wp_enqueue_script( 'illdy-companion-admin-js', plugins_url( '/assets/js/admin.js', __FILE__ ), array( 'jquery' ), '', true );

		wp_localize_script(
			'illdy-companion-admin-js', 'illdyCompanion', array(
				'ajaxurl' => esc_url( admin_url( 'admin-ajax.php' ) ),
			)
		);
	}

	add_action( 'customize_controls_enqueue_scripts', 'illdy_companion_customizer_scripts' );
}

if ( ! function_exists( 'illdy_companion_customize_register' ) ) {
	/**
	 * Function that adds back the customizer sections we were asked to remove from the theme
	 *
	 * @param $wp_customize
	 */
	function illdy_companion_customize_register( $wp_customize ) {

		// Set prefix
		$prefix = 'illdy';

		if ( ! $wp_customize->get_setting( $prefix . '_services_general_entry' ) ) {

			$wp_customize->add_setting(
				$prefix . '_services_general_entry', array(
					'sanitize_callback' => 'wp_kses_post',
					'default'           => __( 'In order to help you grow your business, our carefully selected experts can advise you in in the following areas:', 'illdy-companion' ),
					'transport'         => 'postMessage',
				)
			);

			if ( class_exists( 'Epsilon_Control_Text_Editor' ) ) {

				$wp_customize->add_control(
					new Epsilon_Control_Text_Editor(
						$wp_customize, $prefix . '_services_general_entry', array(
							'label'    => __( 'Entry', 'illdy-companion' ),
							'section'  => $prefix . '_panel_services',
							'priority' => 3,
							'type'     => 'epsilon-text-editor',
						)
					)
				);

			} else {

				$wp_customize->add_control(
					$prefix . '_services_general_entry', array(
						'label'       => __( 'Entry', 'illdy-companion' ),
						'description' => __( 'Add the content for this section.', 'illdy-companion' ),
						'section'     => $prefix . '_panel_services',
						'priority'    => 3,
						'type'        => 'textarea',
					)
				);

			}
		}

		if ( ! $wp_customize->get_setting( $prefix . '_team_general_entry' ) ) {

			$wp_customize->add_setting(
				$prefix . '_team_general_entry', array(
					'sanitize_callback' => 'wp_kses_post',
					'default'           => __( 'Meet the people that are going to take your business to the next level.', 'illdy-companion' ),
					'transport'         => 'postMessage',
				)
			);

			if ( class_exists( 'Epsilon_Control_Text_Editor' ) ) {

				$wp_customize->add_control(
					new Epsilon_Control_Text_Editor(
						$wp_customize, $prefix . '_team_general_entry', array(
							'label'    => __( 'Entry', 'illdy-companion' ),
							'section'  => $prefix . '_panel_team',
							'priority' => 3,
							'type'     => 'epsilon-text-editor',
						)
					)
				);

			} else {

				$wp_customize->add_control(
					$prefix . '_team_general_entry', array(
						'label'       => __( 'Entry', 'illdy-companion' ),
						'description' => __( 'Add the content for this section.', 'illdy-companion' ),
						'section'     => $prefix . '_panel_team',
						'priority'    => 3,
						'type'        => 'textarea',
					)
				);

			}
		}

		if ( ! $wp_customize->get_setting( $prefix . '_about_general_entry' ) ) {

			$wp_customize->add_setting(
				$prefix . '_about_general_entry', array(
					'sanitize_callback' => 'wp_kses_post',
					'default'           => __( 'It is an amazing one-page theme with great features that offers an incredible experience. It is easy to install, make changes, adapt for your business. A modern design with clean lines and styling for a wide variety of content, exactly how a business design should be. You can add as many images as you want to the main header area and turn them into slider.', 'illdy-companion' ),
					'transport'         => 'postMessage',
				)
			);

			if ( class_exists( 'Epsilon_Control_Text_Editor' ) ) {

				$wp_customize->add_control(
					new Epsilon_Control_Text_Editor(
						$wp_customize, $prefix . '_about_general_entry', array(
							'label'    => __( 'Entry', 'illdy-companion' ),
							'section'  => $prefix . '_panel_about',
							'priority' => 3,
							'type'     => 'epsilon-text-editor',
						)
					)
				);

			} else {

				$wp_customize->add_control(
					$prefix . '_about_general_entry', array(
						'label'       => __( 'Entry', 'illdy-companion' ),
						'description' => __( 'Add the content for this section.', 'illdy-companion' ),
						'section'     => $prefix . '_panel_about',
						'priority'    => 3,
						'type'        => 'textarea',
					)
				);

			}
		}

		if ( ! $wp_customize->get_setting( $prefix . '_jumbotron_general_entry' ) ) {

			$wp_customize->add_setting(
				$prefix . '_jumbotron_general_entry', array(
					'sanitize_callback' => 'wp_kses_post',
					'default'           => __( 'lldy is a great one-page theme, perfect for developers and designers but also for someone who just wants a new website for his business. Try it now!', 'illdy-companion' ),
					'transport'         => 'postMessage',
				)
			);

			if ( class_exists( 'Epsilon_Control_Text_Editor' ) ) {

				$wp_customize->add_control(
					new Epsilon_Control_Text_Editor(
						$wp_customize, $prefix . '_jumbotron_general_entry', array(
							'label'    => __( 'Entry', 'illdy-companion' ),
							'section'  => $prefix . '_jumbotron_general',
							'priority' => 5,
							'type'     => 'epsilon-text-editor',
						)
					)
				);

			} else {

				$wp_customize->add_control(
					$prefix . '_jumbotron_general_entry', array(
						'label'       => __( 'Entry', 'illdy-companion' ),
						'description' => __( 'The content added in this field will show below title.', 'illdy-companion' ),
						'section'     => $prefix . '_jumbotron_general',
						'priority'    => 5,
						'type'        => 'textarea',
					)
				);

			}
		}

		if ( ! $wp_customize->get_setting( $prefix . '_latest_news_general_entry' ) ) {

			$wp_customize->add_setting(
				$prefix . '_latest_news_general_entry', array(
					'sanitize_callback' => 'wp_kses_post',
					'default'           => __( 'If you are interested in the latest articles in the industry, take a sneak peek at our blog. You have nothing to loose!', 'illdy-companion' ),
					'transport'         => 'postMessage',
				)
			);

			if ( class_exists( 'Epsilon_Control_Text_Editor' ) ) {

				$wp_customize->add_control(
					new Epsilon_Control_Text_Editor(
						$wp_customize, $prefix . '_latest_news_general_entry', array(
							'label'    => __( 'Entry', 'illdy-companion' ),
							'section'  => $prefix . '_latest_news_general',
							'priority' => 3,
							'type'     => 'epsilon-text-editor',
						)
					)
				);

			} else {

				$wp_customize->add_control(
					$prefix . '_latest_news_general_entry', array(
						'label'       => __( 'Entry', 'illdy-companion' ),
						'description' => __( 'Add the content for this section.', 'illdy-companion' ),
						'section'     => $prefix . '_latest_news_general',
						'priority'    => 3,
						'type'        => 'textarea',
					)
				);

			}
		}

		if ( ! $wp_customize->get_setting( $prefix . '_projects_general_entry' ) ) {

			$wp_customize->add_setting(
				$prefix . '_projects_general_entry', array(
					'sanitize_callback' => 'wp_kses_post',
					'default'           => __( 'You\'ll love our work. Check it out!', 'illdy-companion' ),
					'transport'         => 'postMessage',
				)
			);

			if ( class_exists( 'Epsilon_Control_Text_Editor' ) ) {

				$wp_customize->add_control(
					new Epsilon_Control_Text_Editor(
						$wp_customize, $prefix . '_projects_general_entry', array(
							'label'    => __( 'Entry', 'illdy-companion' ),
							'section'  => $prefix . '_panel_projects',
							'priority' => 3,
							'type'     => 'epsilon-text-editor',
						)
					)
				);

			} else {

				$wp_customize->add_control(
					$prefix . '_projects_general_entry', array(
						'label'       => __( 'Entry', 'illdy-companion' ),
						'description' => __( 'Add the content for this section.', 'illdy-companion' ),
						'section'     => $prefix . '_panel_projects',
						'priority'    => 3,
						'type'        => 'textarea',
					)
				);

			}
		}

		if ( ! $wp_customize->get_setting( $prefix . '_contact_us_entry' ) ) {
			$wp_customize->add_setting(
				$prefix . '_contact_us_entry', array(
					'sanitize_callback' => 'wp_kses_post',
					'default'           => __( 'And we will get in touch as soon as possible.', 'illdy-companion' ),
					'transport'         => 'postMessage',
				)
			);

			if ( class_exists( 'Epsilon_Control_Text_Editor' ) ) {

				$wp_customize->add_control(
					new Epsilon_Control_Text_Editor(
						$wp_customize, $prefix . '_contact_us_entry', array(
							'label'    => __( 'Entry', 'illdy-companion' ),
							'section'  => $prefix . '_contact_us',
							'priority' => 3,
							'type'     => 'epsilon-text-editor',
						)
					)
				);

			} else {

				$wp_customize->add_control(
					$prefix . '_contact_us_entry', array(
						'label'       => __( 'Entry', 'illdy-companion' ),
						'description' => __( 'Add the content for this section.', 'illdy-companion' ),
						'section'     => $prefix . '_contact_us',
						'priority'    => 3,
						'type'        => 'textarea',
					)
				);

			}
		}

	}

	// hook our function
	add_action( 'customize_register', 'illdy_companion_customize_register', 20 );
} // End if().

function illdy_get_attachment_image() {
	$id  = intval( $_POST['attachment_id'] );
	$src = wp_get_attachment_image_src( $id, 'full', false );
	if ( ! empty( $src[0] ) ) {
		echo esc_url( $src[0] );
	}
	die();
}
add_action( 'wp_ajax_illdy_get_attachment_media', 'illdy_get_attachment_image' );
