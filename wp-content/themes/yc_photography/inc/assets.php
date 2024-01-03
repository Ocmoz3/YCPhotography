<?php
/**
 * Enqueue styles and scripts
 */

// USER SECTION
function yc_photography_register_styles() {
    if(!is_admin() || !is_blog_admin()):
        // STYLESHEETS
        wp_enqueue_style('main_stylesheet', get_stylesheet_uri());
        // GOOGLE FONTS
        wp_enqueue_style('add_google_fonts','https://fonts.googleapis.com/css2?family=Imbue:opsz,wght@10..100,100&family=Josefin+Sans:wght@100;200;300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&family=Raleway:wght@100;200;300;400;500;600;700;800;900&display=swap', array(), null);
        // FONT-AWESOME
        wp_enqueue_style( 'font_awesome', 'https://use.fontawesome.com/releases/v6.4.2/css/all.css' );
        // HEADER
        wp_enqueue_style('header_stylesheet', get_template_directory_uri() . '/assets/css/header/header.css');
        wp_enqueue_style('header_nav_stylesheet', get_template_directory_uri() . '/assets/css/header/header_nav.css');
    endif;
}
add_action('wp_enqueue_scripts', 'yc_photography_register_styles');