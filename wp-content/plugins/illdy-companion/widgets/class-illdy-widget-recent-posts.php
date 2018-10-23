<?php

class Illdy_Widget_Recent_Posts extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'illdy_recent_posts', __( '[Illdy] - Recent Posts', 'illdy-companion' ), array(
				'description' => __( 'Thiw widget will display the latest posts with thumbnail image on the left side.', 'illdy-companion' ),
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
			'title'         => '',
			'display_title' => '',
			'numberofposts' => 4,
		);
		$instance = wp_parse_args( $instance, $defaults );

		if ( $instance['display_title'] ) {
			echo $args['before_title'] . esc_html( $instance['title'] ) . $args['after_title'];
		}

		$post_query_args = array(
			'post_type'              => 'post',
			'pagination'             => false,
			'posts_per_page'         => absint( $instance['numberofposts'] ),
			'ignore_sticky_posts'    => true,
			'cache_results'          => true,
			'update_post_meta_cache' => true,
			'update_post_term_cache' => true,
		);

		$post_query = new WP_Query( $post_query_args );

		if ( $post_query->have_posts() ) {
			while ( $post_query->have_posts() ) {
				$post_query->the_post();

				global $post;

				$output          = '<div class="widget-recent-post clearfix">';
					$output     .= ( has_post_thumbnail( $post->ID ) ? '<div class="recent-post-image">' : '' );
						$output .= ( has_post_thumbnail( $post->ID ) ? get_the_post_thumbnail( $post->ID, 'illdy-widget-recent-posts' ) : '' );
					$output     .= ( has_post_thumbnail( $post->ID ) ? '</div><!--/.recent-post-image-->' : '' );
					$output     .= '<a href="' . esc_url( get_the_permalink() ) . '" title="' . esc_attr( get_the_title() ) . '" class="recent-post-title">' . esc_html( get_the_title() ) . '</a>';
					$output     .= '<a href="' . esc_url( get_the_permalink() ) . '" title="' . __( 'More...', 'illdy-companion' ) . '" class="recent-post-button">' . __( 'More...', 'illdy-companion' ) . '</a>';
				$output         .= '</div><!--/.widget-recent-post.clearfix-->';

				echo $output;

			}
		} else {
			echo __( 'No posts found.', 'illdy-companion' );
		}

		wp_reset_postdata();

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
			'title'         => __( '[Illdy] - Recent Posts', 'illdy-companion' ),
			'display_title' => '',
			'numberofposts' => 4,
		);
		$instance = wp_parse_args( $instance, $defaults );

		?>

		<div class="checkbox_switch" style="margin-top:15px;margin-bottom: 0;">
			<span class="customize-control-title onoffswitch_label"><?php _e( 'Display title?', 'illdy-companion' ); ?></span>
			<div class="onoffswitch">
				<input type="checkbox" id="<?php echo $this->get_field_id( 'display_title' ); ?>" name="<?php echo $this->get_field_name( 'display_title' ); ?>" class="onoffswitch-checkbox" value="1" <?php checked( $instance['display_title'] ); ?>>
				<label class="onoffswitch-label" for="<?php echo $this->get_field_id( 'display_title' ); ?>"></label>
			</div>
		</div>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'illdy-companion' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'numberofposts' ); ?>"><?php _e( 'Number of posts:', 'illdy-companion' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'numberofposts' ); ?>" name="<?php echo $this->get_field_name( 'numberofposts' ); ?>" type="number" value="<?php echo esc_attr( $instance['numberofposts'] ); ?>">
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
		$instance                  = array();
		$instance['display_title'] = $new_instance['display_title'];
		$instance['title']         = ( ! empty( $new_instance['title'] ) ) ? wp_kses_post( $new_instance['title'] ) : '';
		$instance['numberofposts'] = ( ! empty( $new_instance['numberofposts'] ) ? absint( $new_instance['numberofposts'] ) : '' );

		return $instance;
	}

}

function illdy_register_widget_recent_posts() {
	register_widget( 'Illdy_Widget_Recent_Posts' );
}
add_action( 'widgets_init', 'illdy_register_widget_recent_posts' );
