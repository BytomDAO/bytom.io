<?php

class Illdy_Widget_Person extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'illdy_person', __( '[Illdy] - Person', 'illdy-companion' ), array(
				'description' => __( 'Add this widget in "Front page - Team Sidebar".', 'illdy-companion' ),
			)
		);

		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'admin_footer-widgets.php', array( $this, 'print_scripts' ), 9999 );
	}

	/**
	 *  Enqueue Scripts
	 */
	public function enqueue_scripts() {
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'wp-color-picker' );
		wp_enqueue_script( 'underscore' );
		wp_enqueue_media();
		wp_enqueue_script( 'illdy-widget-upload-image', ILLDY_COMPANION_ASSETS_DIR . 'js/widget-upload-image.js', false, '1.0', true );
	}

	/**
	 * Print scripts.
	 *
	 * @since 1.0
	 */
	public function print_scripts() {
		?>
		<script>
			( function( $ ){
				function initColorPicker( widget ) {
					widget.find( '.color-picker' ).wpColorPicker( {
						defaultColor : '#f1d204',
						change: _.throttle( function() { // For Customizer
							$(this).trigger( 'change' );
						}, 3000 )
					});
				}

				function onFormUpdate( event, widget ) {
					initColorPicker( widget );
				}

				$( document ).on( 'widget-added widget-updated', onFormUpdate );

				$( document ).ready( function() {
					$( '#widgets-right .widget:has(.color-picker)' ).each( function () {
						initColorPicker( $( this ) );
					} );
				} );
			}( jQuery ) );
		</script>
		<?php
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget'];

		$defaults = array(
			'title'        => '',
			'image'        => '',
			'position'     => '',
			'entry'        => '',
			'facebook_url' => '',
			'twitter_url'  => '',
			'linkedin_url' => '',
			'github_url'   => '',
			'color'        => '#000000',
		);
		$instance = wp_parse_args( $instance, $defaults );

		$image_id                 = illdy_get_image_id_from_image_url( $instance['image'] );
		$get_attachment_image_src = wp_get_attachment_image_src( $image_id, 'illdy-front-page-person' );

		$output = '';

		$output             .= '<div class="person clearfix" data-person-color="' . esc_attr( $instance['color'] ) . '">';
			$output         .= '<div class="person-image">';
				$output     .= ( $image_id ? '<img src="' . $get_attachment_image_src[0] . '" alt="' . esc_attr( $instance['title'] ) . '" title="' . esc_attr( $instance['title'] ) . '" />' : ( $instance['image'] ? '<img src="' . $instance['image'] . '" alt="' . esc_attr( $instance['title'] ) . '" title="' . esc_html( $instance['title'] ) . '" />' : '' ) );
			$output         .= '</div><!--/.person-image-->';
			$output         .= '<div class="person-content">';
				$output     .= '<h6>' . esc_html( $instance['title'] ) . '</h6>';
				$output     .= '<p class="person-position">' . esc_html( $instance['position'] ) . '</p>';
				$output     .= '<p>' . wp_kses_post( $instance['entry'] ) . '</p>';
				$output     .= '<ul class="person-content-social clearfix">';
					$output .= ( $instance['facebook_url'] ) ? '<li><a href="' . esc_url( $instance['facebook_url'] ) . '" title="' . __( 'Facebook', 'illdy-companion' ) . '" target="_blank" rel="nofollow"><i class="fa fa-facebook"></i></a></li>' : '';
					$output .= ( $instance['twitter_url'] ) ? '<li><a href="' . esc_url( $instance['twitter_url'] ) . '" title="' . __( 'Twitter', 'illdy-companion' ) . '"><i class="fa fa-twitter" target="_blank" rel="nofollow"></i></a></li>' : '';
					$output .= ( $instance['linkedin_url'] ) ? '<li><a href="' . esc_url( $instance['linkedin_url'] ) . '" title="' . __( 'LinkedIn', 'illdy-companion' ) . '"><i class="fa fa-linkedin" target="_blank" rel="nofollow"></i></a></li>' : '';
					$output .= ( $instance['github_url'] ) ? '<li><a href="' . esc_url( $instance['github_url'] ) . '" title="' . __( 'GitHub', 'illdy-companion' ) . '"><i class="fa fa-github" target="_blank" rel="nofollow"></i></a></li>' : '';
				$output     .= '</ul><!--/.person-content-social.clearfix-->';
			$output         .= '</div><!--/.person-content-->';
		$output             .= '</div><!--/.person.clearfix-->';

		echo $output;

		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {

		$defaults = array(
			'title'        => __( '[Illdy] - Person', 'illdy-companion' ),
			'image'        => get_template_directory_uri() . '/layout/images/front-page/front-page-project-1.jpg',
			'position'     => '',
			'entry'        => '',
			'facebook_url' => '',
			'twitter_url'  => '',
			'linkedin_url' => '',
			'github_url'   => '',
			'color'        => '#000000',
		);
		$instance = wp_parse_args( $instance, $defaults );

		?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'illdy-companion' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>">
		</p>

		<p>
			<label for="<?php echo $this->get_field_name( 'image' ); ?>"><?php _e( 'Image:', 'illdy-companion' ); ?></label>
			<input type="text" class="widefat custom_media_url_<?php echo $this->get_field_id( 'image' ); ?>" name="<?php echo $this->get_field_name( 'image' ); ?>" id="<?php echo $this->get_field_id( 'image' ); ?>" value="<?php echo $instance['image']; ?>" style="margin-top:5px;">
			<input type="button" class="button button-primary custom_media_button" id="custom_media_button_service" data-fieldid="<?php echo $this->get_field_id( 'image' ); ?>" name="<?php echo $this->get_field_name( 'image' ); ?>" value="<?php _e( 'Upload Image', 'illdy-companion' ); ?>" style="margin-top: 5px;">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'position' ); ?>"><?php _e( 'Position:', 'illdy-companion' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'position' ); ?>" name="<?php echo $this->get_field_name( 'position' ); ?>" type="text" value="<?php echo esc_attr( $instance['position'] ); ?>">
		</p>

		<p class="illdy-editor-container">
			<label for="<?php echo $this->get_field_id( 'entry' ); ?>"><?php _e( 'Entry:', 'illdy-companion' ); ?></label>
			<textarea name="<?php echo esc_attr( $this->get_field_name( 'entry' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'entry' ) ); ?>" class="widefat"><?php echo wp_kses_post( $instance['entry'] ); ?></textarea>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'facebook_url' ); ?>"><?php _e( 'Facebook URL:', 'illdy-companion' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'facebook_url' ); ?>" name="<?php echo $this->get_field_name( 'facebook_url' ); ?>" type="text" value="<?php echo esc_attr( $instance['facebook_url'] ); ?>">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'twitter_url' ); ?>"><?php _e( 'Twitter URL:', 'illdy-companion' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'twitter_url' ); ?>" name="<?php echo $this->get_field_name( 'twitter_url' ); ?>" type="text" value="<?php echo esc_attr( $instance['twitter_url'] ); ?>">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'linkedin_url' ); ?>"><?php _e( 'LinkedIn URL:', 'illdy-companion' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'linkedin_url' ); ?>" name="<?php echo $this->get_field_name( 'linkedin_url' ); ?>" type="text" value="<?php echo esc_attr( $instance['linkedin_url'] ); ?>">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'github_url' ); ?>"><?php _e( 'GitHub URL:', 'illdy-companion' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'github_url' ); ?>" name="<?php echo $this->get_field_name( 'github_url' ); ?>" type="text" value="<?php echo esc_attr( $instance['github_url'] ); ?>">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'color' ); ?>"><?php _e( 'Color:', 'illdy-companion' ); ?></label><br>
			<input type="text" name="<?php echo $this->get_field_name( 'color' ); ?>" class="color-picker" id="<?php echo $this->get_field_id( 'color' ); ?>" value="<?php echo esc_attr( $instance['color'] ); ?>" data-default-color="#000000" />
		</p>
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
		$instance                 = array();
		$instance['title']        = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
		$instance['image']        = ! empty( $new_instance['image'] ) ? esc_url_raw( $new_instance['image'] ) : '';
		$instance['position']     = ( ! empty( $new_instance['position'] ) ) ? sanitize_text_field( $new_instance['position'] ) : '';
		$instance['entry']        = ( ! empty( $new_instance['entry'] ) ) ? wp_kses_post( $new_instance['entry'] ) : '';
		$instance['facebook_url'] = ( ! empty( $new_instance['facebook_url'] ) ? esc_url_raw( $new_instance['facebook_url'] ) : '' );
		$instance['twitter_url']  = ( ! empty( $new_instance['twitter_url'] ) ? esc_url_raw( $new_instance['twitter_url'] ) : '' );
		$instance['linkedin_url'] = ( ! empty( $new_instance['linkedin_url'] ) ? esc_url_raw( $new_instance['linkedin_url'] ) : '' );
		$instance['github_url']   = ( ! empty( $new_instance['github_url'] ) ? esc_url_raw( $new_instance['github_url'] ) : '' );
		$instance['color']        = ( ! empty( $new_instance['color'] ) ? sanitize_text_field( $new_instance['color'] ) : '' );

		return $instance;
	}

}

function illdy_register_widget_person() {
	register_widget( 'Illdy_Widget_Person' );
}
add_action( 'widgets_init', 'illdy_register_widget_person' );
