<?php

class Illdy_Widget_Parallax extends WP_Widget {

	function __construct() {
		add_action( 'admin_init', array( $this, 'enqueue' ) );
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue' ) );
		add_action( 'customize_preview_init', array( $this, 'enqueue' ) );
		$widget_ops = array(
			'classname'                   => 'illdy_home_parallax',
			'description'                 => esc_html__( 'Illdy FrontPage Parallax Section', 'illdy-companion' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'illdy_home_parallax', esc_html__( '[Illdy] Parralax Section For FrontPage', 'illdy-companion' ), $widget_ops );
	}

	public function enqueue() {
		wp_enqueue_style( 'illdy-companion-epsilon-styles', ILLDY_COMPANION_ASSETS_DIR . '/css/epsilon.css' );
		wp_enqueue_script( 'illdy-companion-epsilon-object', ILLDY_COMPANION_ASSETS_DIR . '/js/epsilon.js', array( 'jquery' ) );
	}

	function widget( $args, $instance ) {

		$defaults = array(
			'title'         => '',
			'image_src'     => '',
			'image_pos'     => 'left',
			'body_content'  => '',
			'button1'       => '',
			'button2'       => '',
			'button1_link'  => '',
			'button2_link'  => '',
			'border_bottom' => '',
		);
		$instance = wp_parse_args( $instance, $defaults );

		echo $args['before_widget'];
		/* Classes */
		$class1 = ( 'background-full' == $instance['image_pos'] ) ? 'cover fullscreen image-bg' : ( ( 'background-small' == $instance['image_pos'] ) ? 'small-screen image-bg p0' : ( ( 'right' == $instance['image_pos'] ) ? 'bg-secondary' : ( ( 'bottom' == $instance['image_pos'] ) ? 'bg-secondary pb0' : '' ) ) );
		$class2 = ( ( 'background-full' == $instance['image_pos'] ) || ( 'background-small' == $instance['image_pos'] ) ) ? 'top-parallax-section' : ( ( 'right' == $instance['image_pos'] ) ? 'col-md-4 col-sm-5 mb-xs-24' : ( ( 'left' == $instance['image_pos'] ) ? 'col-md-4 col-md-offset-1 col-sm-5 col-sm-offset-1' : ( ( 'bottom' == $instance['image_pos'] ) ? 'col-sm-10 col-sm-offset-1 text-center' : ( ( 'top' == $instance['image_pos'] ) ? 'col-sm-10 col-sm-offset-1 text-center mt30' : '' ) ) ) );
		$class3 = ( ( 'background-full' == $instance['image_pos'] ) || ( 'background-small' == $instance['image_pos'] ) ) ? 'col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 text-center' : '';
		$class4 = ( 'left' == $instance['image_pos'] || 'right' == $instance['image_pos'] ) ? 'row align-children' : 'row';
		$class5 = ( 'right' == $instance['image_pos'] ) ? 'col-md-7 col-md-offset-1 col-sm-6 col-sm-offset-1 text-center' : '';
		$class6 = ( 'left' == $instance['image_pos'] ) ? 'col-md-7 col-sm-6 text-center mb-xs-24' : '';
		$class7 = ( 'background-full' == $instance['image_pos'] ) ? 'fullscreen' : '';
		if ( 'on' == $instance['border_bottom'] ) {
			$class1 .= ' border-bottom';
		}
		/**
		 * Widget Content
		 */
		?>
		<section class="<?php echo esc_attr( $class1 ); ?>">
			<?php
			if ( ( 'background-full' == $instance['image_pos'] || 'background-small' == $instance['image_pos'] ) && '' != $instance['image_src'] ) {
			?>
			<div class="parallax-window <?php echo esc_attr( $class7 ); ?>" data-parallax="scroll" data-image-src="<?php echo esc_url( $instance['image_src'] ); ?>" data-ios-fix="true" data-over-scroll-fix="true" data-android-fix="true">
				<div class="<?php echo ( 'background-full' == $instance['image_pos'] ) ? 'align-transform' : ''; ?>">
					<?php } else { ?>
					<div class="container">
						<?php } ?>

						<div class="<?php echo esc_attr( $class4 ); ?>">

							<?php
							if ( ( 'left' == $instance['image_pos'] || 'top' == $instance['image_pos'] ) && '' != $instance['image_src'] ) {
								?>
								<div class="<?php echo esc_attr( $class6 ); ?>">
									<img class="cast-shadow img-responsive" alt="<?php echo esc_attr( $instance['title'] ); ?>" src="<?php echo esc_url( $instance['image_src'] ); ?>">
								</div>
								<?php
							}
							?>

							<div class="<?php echo esc_attr( $class2 ); ?>">
								<div class="<?php echo esc_attr( $class3 ); ?>">
									<?php
									echo ( '' != $instance['title'] ) ? ( ( 'background-full' == $instance['image_pos'] ) || ( 'background-small' == $instance['image_pos'] ) ) ? '<h1>' . esc_html( $instance['title'] ) . '</h1>' : '<h3>' . esc_html( $instance['title'] ) . '</h3>' : '';
									echo ( '' != $instance['body_content'] ) ? '<div class="mb32">' . wp_kses_post( $instance['body_content'] ) . '</div>' : '';
									echo ( '' != $instance['button2'] && '' != $instance['button2_link'] ) ? '<a class="button" href="' . esc_url( $instance['button2_link'] ) . '">' . esc_html( $instance['button2'] ) . '</a>' : '';
									echo ( '' != $instance['button1'] && '' != $instance['button1_link'] ) ? '<a class="button right-button" href="' . esc_url( $instance['button1_link'] ) . '">' . esc_html( $instance['button1'] ) . '</a>' : '';
									?>
								</div>
							</div>
							<!--end of row-->
							<?php
							if ( ( 'right' == $instance['image_pos'] || 'bottom' == $instance['image_pos'] ) && '' != $instance['image_src'] ) {
								?>
								<div class="<?php echo esc_attr( $class5 ); ?>">
									<img class="cast-shadow img-responsive" alt="<?php echo esc_attr( $instance['title'] ); ?>" src="<?php echo esc_url( $instance['image_src'] ); ?>">
								</div>
								<?php
							}
							?>
						</div>
					</div>
					<?php if ( 'background-full' == $instance['image_pos'] || 'background-small' == $instance['image_pos'] ) { ?>
				</div>
				<?php } ?>
		</section>
		<div class="clearfix"></div>
		<?php
		echo $args['after_widget'];
	}

	function form( $instance ) {

		$defaults = array(
			'title'         => '',
			'image_src'     => '',
			'image_pos'     => '',
			'body_content'  => '',
			'button1'       => '',
			'button2'       => '',
			'button1_link'  => '',
			'button2_link'  => '',
			'border_bottom' => '',
		);
		$instance = wp_parse_args( $instance, $defaults );

		?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title ', 'illdy-companion' ); ?></label>

			<input type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" class="widefat"/>
		</p>

		<p class="illdy-media-control" data-delegate-container="<?php echo esc_attr( $this->get_field_id( 'image_src' ) ); ?>">
			<label for="<?php echo esc_attr( $this->get_field_id( 'image_src' ) ); ?>">
				<?php
				_e( 'Image', 'illdy-companion' );
				?>
				:</label>

			<img src="<?php echo esc_url( $instance['image_src'] ); ?>"/>

			<input type="hidden" name="<?php echo esc_attr( $this->get_field_name( 'image_src' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'image_src' ) ); ?>" value="<?php echo esc_url( $instance['image_src'] ); ?>" class="image-id blazersix-media-control-target">

			<button type="button" class="button upload-button"><?php _e( 'Choose Image', 'illdy-companion' ); ?></button>
			<button type="button" class="button remove-button"><?php _e( 'Remove Image', 'illdy-companion' ); ?></button>
		</p>

		<p class="illdy-editor-container">
			<label for="<?php echo esc_attr( $this->get_field_id( 'body_content' ) ); ?>"><?php esc_html_e( 'Content ', 'illdy-companion' ); ?></label>

			<textarea name="<?php echo esc_attr( $this->get_field_name( 'body_content' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'body_content' ) ); ?>" class="widefat"><?php echo wp_kses_post( $instance['body_content'] ); ?></textarea>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'image_pos' ) ); ?>"><?php esc_html_e( 'Image Position ', 'illdy-companion' ); ?></label>
			<select name="<?php echo esc_attr( $this->get_field_name( 'image_pos' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'image_pos' ) ); ?>" class="widefat">
				<option value="left" <?php selected( $instance['image_pos'], 'left' ); ?>><?php _e( 'Left', 'illdy-companion' ); ?></option>
				<option value="right" <?php selected( $instance['image_pos'], 'right' ); ?>><?php _e( 'Right', 'illdy-companion' ); ?></option>
				<option value="top" <?php selected( $instance['image_pos'], 'top' ); ?>><?php _e( 'Top', 'illdy-companion' ); ?></option>
				<option value="bottom" <?php selected( $instance['image_pos'], 'bottom' ); ?>><?php _e( 'Bottom', 'illdy-companion' ); ?></option>
				<option value="background-full" <?php selected( $instance['image_pos'], 'background-full' ); ?>><?php _e( 'Background Full', 'illdy-companion' ); ?></option>
				<option value="background-small" <?php selected( $instance['image_pos'], 'background-small' ); ?>><?php _e( 'Background Small', 'illdy-companion' ); ?></option>
			</select>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'button1' ) ); ?>"><?php esc_html_e( 'Button 1 Text ', 'illdy-companion' ); ?></label>

			<input type="text" value="<?php echo esc_attr( $instance['button1'] ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'button1' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'button1' ) ); ?>" class="widefat"/>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'button1_link' ) ); ?>"><?php esc_html_e( 'Button 1 Link ', 'illdy-companion' ); ?></label>

			<input type="text" value="<?php echo esc_url( $instance['button1_link'] ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'button1_link' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'button1_link' ) ); ?>" class="widefat"/>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'button2' ) ); ?>"><?php esc_html_e( 'Button 2 Text ', 'illdy-companion' ); ?></label>

			<input type="text" value="<?php echo esc_attr( $instance['button2'] ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'button2' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'button2' ) ); ?>" class="widefat"/>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'button2_link' ) ); ?>"><?php esc_html_e( 'Button 2 Link ', 'illdy-companion' ); ?></label>

			<input type="text" value="<?php echo esc_url( $instance['button2_link'] ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'button2_link' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'button2_link' ) ); ?>" class="widefat"/>
		</p>

		<div class="checkbox_switch">
				<span class="customize-control-title onoffswitch_label">
					<?php _e( 'Border bottom', 'illdy-companion' ); ?>
				</span>
			<div class="onoffswitch">
				<input type="checkbox" id="<?php echo esc_attr( $this->get_field_name( 'border_bottom' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'border_bottom' ) ); ?>" class="onoffswitch-checkbox" value="on"
					<?php checked( $instance['border_bottom'], 'on' ); ?>>
				<label class="onoffswitch-label" for="<?php echo esc_attr( $this->get_field_name( 'border_bottom' ) ); ?>"></label>
			</div>
		</div>
		<?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance                  = array();
		$instance['title']         = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
		$instance['image_src']     = ( ! empty( $new_instance['image_src'] ) ) ? esc_url_raw( $new_instance['image_src'] ) : '';
		$instance['image_pos']     = ( ! empty( $new_instance['image_pos'] ) ) ? sanitize_text_field( $new_instance['image_pos'] ) : '';
		$instance['body_content']  = ( ! empty( $new_instance['body_content'] ) ) ? wp_kses_post( $new_instance['body_content'] ) : '';
		$instance['button1']       = ( ! empty( $new_instance['button1'] ) ) ? wp_kses_post( $new_instance['button1'] ) : '';
		$instance['button2']       = ( ! empty( $new_instance['button2'] ) ) ? wp_kses_post( $new_instance['button2'] ) : '';
		$instance['button1_link']  = ( ! empty( $new_instance['button1_link'] ) ) ? esc_url_raw( $new_instance['button1_link'] ) : '';
		$instance['button2_link']  = ( ! empty( $new_instance['button2_link'] ) ) ? esc_url_raw( $new_instance['button2_link'] ) : '';
		$instance['border_bottom'] = ( ! empty( $new_instance['border_bottom'] ) ) ? sanitize_text_field( $new_instance['border_bottom'] ) : '';

		return $instance;
	}
}

add_action( 'widgets_init', 'illdy_register_widget_parallax' );
function illdy_register_widget_parallax() {
	register_widget( 'Illdy_Widget_Parallax' );
}

?>
