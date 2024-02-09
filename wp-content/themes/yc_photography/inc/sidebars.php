<?php
/**
 * Registers the social network sidebar.
 * 
 * Register widget triggers 'Widgets' menu item display in admin menu bar.
 */

/**
 * Fires after all default WordPress widgets have been registered.
 */
function yc_photography_register_sidebars() {
    // Register sidebars
    register_sidebar([
        'id' => 'social-network-widget',
        'name' => 'Réseaux sociaux',
        'before_widget' => '',
        'after_widget' => '',
    ]);
}
add_action('widgets_init', 'yc_photography_register_sidebars');