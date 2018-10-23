<?php
/*
Plugin Name: Kades Crypto Widgets
Plugin URI: https://kadesthemes.com/wordpress-plugins/kades-crypto-widgets/
Description: Displays Cryptocurrency widgets and chart
Author: Kimi
Author URI: http://phankimi.com
Version: 1.0.3
Text Domain: kades-crypto-widgets
License: GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/
?>
<?php 
if ( ! defined ( 'WPINC' ) ) {
    die;
}

add_action( 'wp_enqueue_scripts', 'kadescrypto_enqueue_script' );
function kadescrypto_enqueue_script() {
    wp_enqueue_style( 'kades-crypto', plugins_url( '/css/kades-crypto.css', __FILE__), '311217' );
    wp_enqueue_script( 'kades-crypto', plugins_url( '/js/kades-crypto.js', __FILE__ ), array( 'jquery' ), '31217', true );
}

// Register Custom Kades Widget
class Kades_Crypto_Converter_Widgets extends WP_Widget {

    public function __construct() {
        $widget_option = array(
            'classname'     => 'kades_crypto_converter',
            'description'   => esc_html__( 'Display cryptocurrency converter widget', 'kades-crypto-widgets' )
        );
        parent::__construct( 'kades_crypto_converter', 'Kades Crypto Converter', $widget_option );
    }

    public function widget( $args, $instance ) {
        echo $args['before_widget'];

        // display the widget
        echo '<div id="kadescrypto-converter"></div>';

        echo $args['after_widget'];
    }
} 

class Kades_Crypto_Header_Widgets extends WP_Widget {

    public function __construct() {
        $widget_option = array(
            'classname'     => 'kades_crypto_header',
            'description'   => esc_html__( 'Display cryptocurrency header widget', 'kades-crypto-widgets' ) 
        );
        parent::__construct( 'kades_crypto_header', 'Kades Crypto Header', $widget_option );
    }

    public function widget( $args, $instance ) {
        echo $args['before_widget'];

        // display the widget
        echo '<div id="kadescrypto-header"></div>';

        echo $args['after_widget'];
    }
} 

class Kades_Crypto_Tabbed_Widgets extends WP_Widget {

    public function __construct() {
        $widget_option = array(
            'classname'     => 'kades_crypto_tabbed',
            'description'   => esc_html__( 'Display cryptocurrency tabbed widget', 'kades-crypto-widgets' )
        );
        parent::__construct( 'kades_crypto_tabbed', 'Kades Crypto Tabbed', $widget_option );
    }

    public function widget( $args, $instance ) {
        echo $args['before_widget'];

        // display the widget
        echo '<div id="kadescrypto-tabbed"></div>';

        echo $args['after_widget'];
    }
}

class Kades_Crypto_ICO_Widgets extends WP_Widget {

    public function __construct() {
        $widget_option = array(
            'classname'     => 'kades_crypto_icos',
            'description'   => esc_html__( 'Display Upcoming ICOs widget', 'kades-crypto-widgets' )
        );
        parent::__construct( 'kades_crypto_icos', 'Kades Crypto Upcoming ICO ', $widget_option );
    }

    public function widget( $args, $instance ) {
        echo $args['before_widget'];

        // display the widget
        echo '<div id="kadescrypto-ico"><div class="icowatchlist_list_widget" data-color="FF9F1C" data-num="5" data-type="regular"></div></div>';

        echo $args['after_widget'];
    }
} 

add_action( 'widgets_init', 'kadescrypto_register_widgets' );
function kadescrypto_register_widgets() {
    register_widget( 'Kades_Crypto_Converter_Widgets' );
    register_widget( 'Kades_Crypto_Header_Widgets' );
    register_widget( 'Kades_Crypto_Tabbed_Widgets' );
    register_widget( 'Kades_Crypto_ICO_Widgets' );
}
