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
        // HOME
        wp_enqueue_style('home_presentation_stylesheet', get_template_directory_uri() . '/assets/css/home/presentation/presentation.css');
        wp_enqueue_style('home_portfolio_stylesheet', get_template_directory_uri() . '/assets/css/home/portfolio/portfolio.css');
        wp_enqueue_style('home_exhibitions_stylesheet', get_template_directory_uri() . '/assets/css/home/exhibitions/exhibitions.css');
        wp_enqueue_style('home_contact_stylesheet', get_template_directory_uri() . '/assets/css/home/contact/contact.css');
        // SCRIPTS
        wp_enqueue_script('header_nav_script', get_template_directory_uri() . '/assets/js/header/header_nav.js', ['jquery'], false, true);
    endif;
}
add_action('wp_enqueue_scripts', 'yc_photography_register_styles');