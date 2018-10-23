<?php
/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class Freddo_Updgrade_Pro_Button {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	 */
	public function sections( $manager ) {

		// Load custom sections.
		require_once( trailingslashit( get_template_directory() ) . 'inc/pro-button/section-pro.php' );

		// Register custom section types.
		$manager->register_section_type( 'Freddo_Updgrade_Section_Pro' );

		// Register sections.
		$manager->add_section(
			new Freddo_Updgrade_Section_Pro(
				$manager,
				'cresta_freddo_buy_pro',
				array(
					'priority' => 1,
					'title'    => esc_html__( 'Freddo PRO Theme', 'freddo' ),
					'pro_text' => esc_html__( 'More Info',         'freddo' ),
					'pro_url'  => 'https://crestaproject.com/downloads/freddo/',
				)
			)
		);
		$manager->add_section(
			new Freddo_Updgrade_Section_Pro(
				$manager,
				'cresta_freddo_documentation',
				array(
					'priority' => 999,
					'title'    => esc_html__( 'Freddo documentation', 'freddo' ),
					'pro_text' => esc_html__( 'Documentation',         'freddo' ),
					'pro_url'  => admin_url( add_query_arg( array( 'page' => 'freddo-welcome', 'tab' => 'documentation' ), 'themes.php' ) )
				)
			)
		);
		$manager->add_section(
			new Freddo_Updgrade_Section_Pro(
				$manager,
				'cresta_freddo_locked_pro',
				array(
					'priority' => 1,
					'title'    => esc_html__( 'Change sections position', 'freddo' ),
					'pro_text' => esc_html__( 'PRO Version',         'freddo' ),
					'pro_url'  => 'https://crestaproject.com/downloads/freddo/',
					'panel'  => 'cresta_freddo_onepage',
				)
			)
		);
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'freddo-customize-controls-pro-button', trailingslashit( get_template_directory_uri() ) . 'inc/pro-button/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'freddo-customize-controls-pro-button', trailingslashit( get_template_directory_uri() ) . 'inc/pro-button/customize-controls.css' );
	}
}

// Doing this customizer thang!
Freddo_Updgrade_Pro_Button::get_instance();
