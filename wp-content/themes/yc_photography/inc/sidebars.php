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
        // 'class' => 'header_sidebar',
        'before_widget' => '',
        'after_widget' => '',
    ]);
    // register_sidebar([
    //     'id' => 'infos-contact-header',
    //     'name' => 'Coordonnées header',
    //     'class' => 'header_sidebar',
    //     'before_widget' => '',
    //     'after_widget' => '',
    // ]);
    // register_sidebar([
    //     'id' => 'infos-contact-footer',
    //     'name' => 'Coordonnées footer',
    //     'before_widget' => '<div class="footer_second_col"><div class="foot_contact"><p>Contactez-moi</p></div>',
    //     'after_widget' => '</div>',
    // ]);
    // register_sidebar([
    //     'id' => 'form-contact',
    //     'name' => 'Formulaire de contact',
    //     'before_widget' => '<div class="footer_third_col">',
    //     'after_widget' => '</div>',
    // ]);

}
add_action('widgets_init', 'yc_photography_register_sidebars');