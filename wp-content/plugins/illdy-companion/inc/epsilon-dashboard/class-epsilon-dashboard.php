<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( ! class_exists( 'Epsilon_Dashboard' ) ) {
	/**
	 * Dashboard Widget
	 */
	final class Epsilon_Dashboard {

		/**
		 * The script version
		 *
		 * @var string Script version
		 */
		public $script_version = '1.0.0';
		/**
		 * The script url
		 *
		 * @var string The URL of the script
		 */
		public $script_url;

		/**
		 * The class instance
		 *
		 * @var Epsilon_Dashboard The singleton instance of the class
		 */
		public static $instance;

		/**
		 * The title of the widget
		 *
		 * @var string The dashboard widget title
		 */
		public $dashboard_name;
		/**
		 * Array that holds the urls of the blog feeds
		 *
		 * @var array Feeds to fetch news from
		 */
		public $feeds;
		/**
		 * The feed items array
		 *
		 * @var array The feeds items
		 */
		public $items;

		/**
		 * The instance of the class
		 *
		 * @var Epsilon_Dashboard The singleton instance
		 */
		public static function instance( $args ) {
			if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Epsilon_Dashboard ) ) {
				self::$instance = new Epsilon_Dashboard;

				if ( isset( $args['feed_url'] ) ) {
					self::$instance->setup_vars( $args );
					self::$instance->load_hooks();
				}
			}

			return self::$instance;
		}

		/**
		 * Load hooks to show the widget
		 */
		public function load_hooks() {
			add_action( 'wp_dashboard_setup', array( &$this, 'add_widget' ) );
			add_action( 'wp_network_dashboard_setup', array( &$this, 'add_widget' ) );
		}

		/**
		 * Setup class variables
		 */
		public function setup_vars( $args ) {
			if ( ! isset( $args['widget_title'] ) ) {
				$args['widget_title'] = apply_filters( 'epsilon_dashboard_widget_name', esc_html__( 'WordPress Guides/Tutorials', 'illdy-companion' ) );
			}
			$this->dashboard_name = $args['widget_title'];
			$this->feeds          = (array) $args['feed_url'];
			$abs                  = untrailingslashit( ( dirname( __FILE__ ) ) );
			$parts                = str_replace( untrailingslashit( ABSPATH ), '', $abs );
			$parts                = explode( DIRECTORY_SEPARATOR, $parts );
			$parts                = array_filter( $parts );
			$this->script_url     = site_url() . '/' . implode( '/', $parts );
		}

		/**
		 * Add widget to the dashboard
		 *
		 * @return string|void
		 */
		function add_widget() {
			global $wp_meta_boxes;
			if ( isset( $wp_meta_boxes['dashboard']['normal']['core']['epsilon_dashboard'] ) ) {
				return;
			}
			// Load SimplePie Instance
			$feed = fetch_feed( $this->feeds );
			// TODO report error when is an error loading the feed
			if ( is_wp_error( $feed ) ) {
				return '';
			}
			$feed->enable_cache( true );
			$feed->enable_order_by_date( true );
			$feed->set_cache_class( 'WP_Feed_Cache' );
			$feed->set_file_class( 'WP_SimplePie_File' );
			$feed->set_cache_duration( apply_filters( 'wp_feed_cache_transient_lifetime', 7200, $this->feeds ) );
			do_action_ref_array( 'wp_feed_options', array( $feed, $this->feeds ) );
			$feed->strip_comments( true );
			$feed->strip_htmltags(
				array(
					'base',
					'blink',
					'body',
					'doctype',
					'embed',
					'font',
					'form',
					'frame',
					'frameset',
					'html',
					'iframe',
					'input',
					'marquee',
					'meta',
					'noscript',
					'object',
					'param',
					'script',
					'style',
				)
			);
			$feed->init();
			$feed->handle_content_type();
			$items       = $feed->get_items( 0, 5 );
			$this->items = array();
			foreach ( (array) $items as $item ) {
				$this->items[] = array(
					'title' => $item->get_title(),
					'date'  => $item->get_date( 'U' ),
					'link'  => $item->get_permalink(),
				);
			}
			if ( ! empty( $this->items ) ) {
				wp_add_dashboard_widget( 'epsilon_dashboard', $this->dashboard_name, array( &$this, 'render_dashboard_widget' ) );
			}
		}

		/**
		 * Render widget content
		 */
		function render_dashboard_widget() {
			?>
			<style type="text/css">

				.epsilon-dw-feed-item {
					display: flex;
					align-items: center;
				}

				.epsilon-dw-feed-item a {
					float: left;
					width: 89.9%;
				}

				.epsilon-dw-feed-item .epsilon-dw-day-container {
					width: 100%;
					letter-spacing: 3px;
					display: block;
				}

				.epsilon-dw-feed-item .epsilon-dw-month-container {

					width: 100%;
					display: block;
					font-weight: 600;
					padding: 0px;
					margin-top: -6px;
					text-transform: uppercase;
					font-size: 10px;
					letter-spacing: 1px;
				}

				.epsilon-dw-feed-item .epsilon-dw-date-container {
					float: left;
					min-height: 30px;
					margin-right: 0.1%;
					width: 10%;
					text-align: center;
				}

			</style>
			<ul>
				<?php
				if ( ! empty( $this->items ) ) {
					foreach ( $this->items as $item ) {
						$query_args = array(
							'utm_campaign' => 'feed',
							'utm_medium'   => 'dashboard_widget',
						);
						?>
						<li class="epsilon-dw-feed-item">
							<span class="epsilon-dw-date-container">
								<span class="epsilon-dw-day-container"><?php echo date( 'd', $item['date'] ); ?></span> 
								<span class="epsilon-dw-month-container"><?php echo substr( date( 'M', $item['date'] ), 0, 3 ); ?></span>
							</span>
							<a href="<?php echo add_query_arg( $query_args, $item['link'] ); ?>" target="_blank"><?php echo $item['title']; ?></a>
							<div class="clear"></div>
						</li>
						<?php
					}
				}
				?>
			</ul>

			<?php

		}
	}

}// End if().
