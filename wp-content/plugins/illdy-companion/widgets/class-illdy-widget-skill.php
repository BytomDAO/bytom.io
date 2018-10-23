<?php

class Illdy_Widget_Skill extends WP_Widget {

	/**
	* Register widget with WordPress.
	*/
	function __construct() {
		parent::__construct(
			'illdy_skill', __( '[Illdy] - Skill', 'illdy-companion' ), array(
				'description' => __( 'Add this widget in "Front page - About Sidebar".', 'illdy-companion' ),
			)
		);

		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'admin_footer-widgets.php', array( $this, 'print_scripts' ), 9999 );
	}

	/**
	 * Enqueue scripts.
	 *
	 * @since 1.0
	 *
	 * @param string $hook_suffix
	 */
	public function enqueue_scripts( $hook_suffix ) {
		if ( 'widgets.php' !== $hook_suffix ) {
			return;
		}

		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'wp-color-picker' );
		wp_enqueue_script( 'underscore' );
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

				function initIconPicker( widget ) {
					widget.find( '.fontawesome-picker' ).fontIconPicker();
				}

				function onFormUpdate( event, widget ) {
					initColorPicker( widget );
					initIconPicker( widget );
				}

				$( document ).on( 'widget-added widget-updated', onFormUpdate );

				$( document ).ready( function() {
					$( '#widgets-right .widget:has(.color-picker)' ).each( function () {
						initColorPicker( $( this ) );
					} );
					$('#widgets-right .widget:has(.fontawesome-picker)').each( function(){
						initIconPicker( $(this) );
					} )
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
			'title'      => '',
			'percentage' => '',
			'icon'       => '',
			'color'      => '',
		);
		$instance = wp_parse_args( $instance, $defaults );

		$output = '';

		$output     .= '<div class="skill" data-skill-progress-bar-width="' . esc_attr( $instance['percentage'] ) . '" data-skill-color="' . esc_attr( $instance['color'] ) . '">';
		$output     .= '<div class="skill-top clearfix">';
			$output .= '<div class="skill-progress-bar"></div>';
		$output     .= '</div><!--/.skill-top.clearfix-->';
		$output     .= '<div class="skill-bottom">';
			$output .= '<i class="fa ' . esc_attr( $instance['icon'] ) . '"></i><span>' . esc_html( $instance['title'] ) . '</span>';
		$output     .= '</div><!--/.skill-bottom-->';
		$output     .= '</div><!--/.skill-->';

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
			'title'      => '',
			'percentage' => '',
			'icon'       => '',
			'color'      => '',
		);
		$instance = wp_parse_args( $instance, $defaults );

		$get_fontawesome_icons = Illdy_Companion_Helper::fontawesome_icons();
		?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'illdy-companion' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'percentage' ); ?>"><?php _e( 'Percentage:', 'illdy-companion' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'percentage' ); ?>" name="<?php echo $this->get_field_name( 'percentage' ); ?>" type="number" value="<?php echo esc_attr( $instance['percentage'] ); ?>">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'icon' ); ?>"><?php _e( 'Icon:', 'illdy-companion' ); ?></label>
			<select class="widefat fontawesome-picker" id="<?php echo $this->get_field_id( 'icon' ); ?>" name="<?php echo $this->get_field_name( 'icon' ); ?>">
				<option value="all-font-awesome-icons"><?php _e( 'All Font Awesome Icons', 'illdy-companion' ); ?></option>
				<?php foreach ( $get_fontawesome_icons as $key => $get_fontawesome_icon ) : ?>
					<option value="fa <?php echo esc_attr( $key ); ?>" <?php selected( $instance['icon'], 'fa ' . $key ); ?>>fa <?php echo esc_html( $get_fontawesome_icon ); ?></option>
				<?php endforeach; ?>
			</select>
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
		$instance               = array();
		$instance['title']      = ( ! empty( $new_instance['title'] ) ) ? wp_kses_post( $new_instance['title'] ) : '';
		$instance['percentage'] = ( ! empty( $new_instance['percentage'] ) ? absint( $new_instance['percentage'] ) : '' );
		$instance['icon']       = ( ! empty( $new_instance['icon'] ) ? sanitize_text_field( $new_instance['icon'] ) : '' );
		$instance['color']      = ( ! empty( $new_instance['color'] ) ? sanitize_hex_color( $new_instance['color'] ) : '' );

		return $instance;
	}

}

add_action( 'widgets_init', 'illdy_register_widget_skill' );
function illdy_register_widget_skill() {
	register_widget( 'Illdy_Widget_Skill' );
}
