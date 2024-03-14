<?php
/**
 * Enqueues styles and scripts
 */

// USER SECTION
function yc_photography_register_styles() {
    if(!is_admin() || !is_blog_admin()):
        // STYLESHEETS
        wp_enqueue_style('main_stylesheet', get_stylesheet_uri());
        // GOOGLE FONTS
        wp_enqueue_style('add_google_fonts','https://fonts.googleapis.com/css2?family=Imbue:opsz,wght@10..100,100&family=Josefin+Sans:wght@100;200;300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&family=Raleway:wght@100;200;300;400;500;600;700;800;900&display=swap', array(), null);
        // FONT-AWESOME
        wp_enqueue_style('font_awesome', 'https://use.fontawesome.com/releases/v6.4.2/css/all.css');
        // HEADER
        wp_enqueue_style('header_stylesheet', get_template_directory_uri() . '/assets/css/header/header.css');
        wp_enqueue_style('header_nav_stylesheet', get_template_directory_uri() . '/assets/css/header/header_nav.css');
        // FOOTER
        wp_enqueue_style('footer_stylesheet', get_template_directory_uri() . '/assets/css/footer/footer.css');
        wp_enqueue_style('legals_stylesheet', get_template_directory_uri() . '/assets/css/legals/legals.css');
        // HOME
        if(is_front_page()):
            wp_enqueue_style('home_image_banner_stylesheet', get_template_directory_uri() . '/assets/css/home/image_banner/image_banner.css');
            wp_enqueue_style('home_presentation_stylesheet', get_template_directory_uri() . '/assets/css/home/presentation/presentation.css');
            wp_enqueue_style('home_portfolio_stylesheet', get_template_directory_uri() . '/assets/css/home/portfolio/portfolio.css');
            wp_enqueue_style('home_exhibitions_stylesheet', get_template_directory_uri() . '/assets/css/home/exhibitions/exhibitions.css');
            wp_enqueue_style('home_contact_stylesheet', get_template_directory_uri() . '/assets/css/home/contact/contact.css');
        endif;
        // GALLERIES
        if(is_page_template('template-galerie.php')):
            wp_enqueue_style('galleries_main_stylesheet', get_template_directory_uri() . '/assets/css/galleries/galleries.css');
            // MODAL
            wp_enqueue_style('modal_main_stylesheet', get_template_directory_uri() . '/assets/css/galleries/modal/modal.css');
            wp_enqueue_style('modal_close_stylesheet', get_template_directory_uri() . '/assets/css/galleries/modal/close-button.css');
            wp_enqueue_style('modal_likes_share_stylesheet', get_template_directory_uri() . '/assets/css/galleries/modal/heart-share-buttons.css');
            wp_enqueue_style('modal_minmax_stylesheet', get_template_directory_uri() . '/assets/css/galleries/modal/minimize-maximize-buttons.css');
            wp_enqueue_style('modal_nextprev_stylesheet', get_template_directory_uri() . '/assets/css/galleries/modal/next-previous-buttons.css');
            wp_enqueue_style('share_modal_stylesheet', get_template_directory_uri() . '/assets/css/galleries/modal/share_modal.css');
            wp_enqueue_script('gallery_modal_script', get_template_directory_uri() . '/assets/js/galleries/galleries.js', ['jquery'], false, true);
            // Ajax mechanical loads only for "gallery" page templates.
            wp_enqueue_script('myTheme', get_template_directory_uri() . '/assets/js/galleries/ajax-handle.js', ['jquery'], null, true);
            // including ajax script in the plugin Myajax.ajaxurl
            wp_localize_script( 'myTheme', 'MyAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php')));
        endif;
        // ERROR (404, page under contruction)
        wp_enqueue_style('error_stylesheet', get_template_directory_uri() . '/assets/css/error.css');
        // SCRIPTS
        wp_enqueue_script('header_nav_script', get_template_directory_uri() . '/assets/js/header/header_nav.js', ['jquery'], false, true);
    endif;
}
add_action('wp_enqueue_scripts', 'yc_photography_register_styles');


// ADMIN SECTION
/**
 * Registers an editor stylesheet for the WYSIWYG theme.
 */
function yc_photography_theme_add_editor_styles() {
    add_editor_style( 'custom-editor-style.css' );
    // Adds Google font
    add_editor_style( 'https://fonts.googleapis.com/css?family=Raleway' );
}
add_action( 'admin_init', 'yc_photography_theme_add_editor_styles' );

/**
 * Enqueues admin section stylesheets.
 */
function yc_photography_register_admin_assets() {
    // LIKES META BOX
        wp_enqueue_style('admin_likes_metabox_css', get_template_directory_uri() . '/assets/admin/css/likes_metabox.css');
    // FRONTPAGE META BOX
    if(isset($_GET['post']) && $_GET['post'] == 6):
        wp_enqueue_style('admin_uploader_css', get_template_directory_uri() . '/assets/admin/css/metaboxes/uploader.css');
        wp_enqueue_style('admin_text_css', get_template_directory_uri() . '/assets/admin/css/metaboxes/text.css');
        wp_enqueue_style('admin_custom_repeater_css', get_template_directory_uri() . '/assets/admin/css/metaboxes/custom_repeater.css');
    endif;
    // GOOGLE FONTS
    wp_enqueue_style('add_google_fonts','https://fonts.googleapis.com/css2?family=Imbue:opsz,wght@10..100,100&family=Josefin+Sans:wght@100;200;300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&family=Raleway:wght@100;200;300;400;500;600;700;800;900&display=swap', array(), null);
}   
add_action('admin_enqueue_scripts', 'yc_photography_register_admin_assets');