<?php
/**
 * Header and footer's sidebars and widget management
 */

require_once('OCSocialNetworkWidget.php');

/**
 * Fires after all default WordPress widgets have been registered.
 * 
 * Registers header and footer's Infos Contact widget.
 */
function sn_register_sidebars() {
    // Register widget
    register_widget(OC_Social_Network_Widget::class);
}
add_action('widgets_init', 'sn_register_sidebars');

/**
 * Enqueues specific widget styles.
 */
function sn_widget_enqueue_styles() {
    wp_enqueue_style( 'sn_widget_css', plugins_url( 'assets/css/sn-widget.css', __FILE__ ) );
    wp_enqueue_script( 'sn_widget_js', plugins_url( 'assets/js/sn-widget.js', __FILE__ ), ['jquery'], null, true );
}
add_action( 'wp_enqueue_scripts', 'sn_widget_enqueue_styles' );