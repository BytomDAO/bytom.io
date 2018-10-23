<?php

class Illdy_Widget_Counter extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'illdy_counter', __( '[Illdy] - Counter', 'illdy-companion' ), array(
				'description' => __( 'Add this widget in "Front page - Counter Sidebar".', 'illdy-companion' ),
			)
		);
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
			'title'                 => '',
			'data_from'             => '',
			'data_to'               => '',
			'data_speed'            => '',
			'data_refresh_interval' => '',
		);
		$instance = wp_parse_args( $instance, $defaults );

		$output  = '<span class="counter-number" data-from="' . esc_attr( $instance['data_from'] ) . '" data-to="' . esc_attr( $instance['data_to'] ) . '" data-speed="' . esc_attr( $instance['data_speed'] ) . '" data-refresh-interval="' . esc_attr( $instance['data_refresh_interval'] ) . '"></span>';
		$output .= '<span class="counter-description">' . esc_html( $instance['title'] ) . '</span>';

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
			'title'                 => __( 'Projects', 'illdy-companion' ),
			'data_from'             => 1,
			'data_to'               => 260,
			'data_speed'            => 2000,
			'data_refresh_interval' => 100,
		);
		$instance = wp_parse_args( $instance, $defaults );

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'illdy-companion' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'data_from' ); ?>"><?php _e( 'Data from:', 'illdy-companion' ); ?></label>
			<span class="widefat" style="font-style: italic; display: block;"><?php _e( 'Counter should start at', 'illdy-companion' ); ?></span>
			<input class="widefat" id="<?php echo $this->get_field_id( 'data_from' ); ?>" name="<?php echo $this->get_field_name( 'data_from' ); ?>" type="number" value="<?php echo esc_attr( $instance['data_from'] ); ?>">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'data_to' ); ?>"><?php _e( 'Data to:', 'illdy-companion' ); ?></label>
			<span class="widefat" style="font-style: italic; display: block;"><?php _e( 'Counter should end at', 'illdy-companion' ); ?></span>
			<input class="widefat" id="<?php echo $this->get_field_id( 'data_to' ); ?>" name="<?php echo $this->get_field_name( 'data_to' ); ?>" type="text" value="<?php echo esc_attr( $instance['data_to'] ); ?>">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'data_speed' ); ?>"><?php _e( 'Data speed:', 'illdy-companion' ); ?></label>
			<span class="widefat" style="font-style: italic; display: block;"><?php _e( 'How long it should take to count between the target numbers.', 'illdy-companion' ); ?></span>
			<input class="widefat" id="<?php echo $this->get_field_id( 'data_speed' ); ?>" name="<?php echo $this->get_field_name( 'data_speed' ); ?>" type="number" value="<?php echo esc_attr( $instance['data_speed'] ); ?>">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'data_refresh_interval' ); ?>"><?php _e( 'Data refresh interval:', 'illdy-companion' ); ?></label>
			<span class="widefat" style="font-style: italic; display: block;"><?php _e( 'How often the element should be updated.', 'illdy-companion' ); ?></span>
			<input class="widefat" id="<?php echo $this->get_field_id( 'data_refresh_interval' ); ?>" name="<?php echo $this->get_field_name( 'data_refresh_interval' ); ?>" type="number" value="<?php echo esc_attr( $instance['data_refresh_interval'] ); ?>">
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
		$instance                          = array();
		$instance['title']                 = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
		$instance['data_from']             = ( '' != $new_instance['data_from'] ) ? absint( $new_instance['data_from'] ) : '';
		$instance['data_to']               = ( '' != $new_instance['data_to'] ) ? absint( $new_instance['data_to'] ) : '';
		$instance['data_speed']            = ( ! empty( $new_instance['data_speed'] ) ) ? absint( $new_instance['data_speed'] ) : '';
		$instance['data_refresh_interval'] = ( ! empty( $new_instance['data_refresh_interval'] ) ) ? absint( $new_instance['data_refresh_interval'] ) : '';

		return $instance;
	}

}

function illdy_register_widget_counter() {
	register_widget( 'Illdy_Widget_Counter' );
}
add_action( 'widgets_init', 'illdy_register_widget_counter' );
