<?php
/**
 * YC Photography theme functions
 */

/**
 * Required files
 */
require_once('inc/assets.php');
require_once('inc/menus.php');
require_once('inc/metaboxes/metabox.php');

/* Disable WordPress Admin Bar for all users */
// add_filter( 'show_admin_bar', '__return_false' );

/* Important function due to header fixed position */
/* Move WordPress Admin Bar to the bottom */
function move_admin_bar() {
    if (is_admin_bar_showing()) {
        echo '<style type="text/css">';
        if (wp_is_mobile()) {
        // show_admin_bar(false);
        echo '#wpadminbar {
            position: fixed !important;
        }';
        // echo 'body{margin-top: -46px; padding-bottom: 0}';
        } 
        //   else {
        echo 'body {
            margin-top: -46px;
            padding-bottom: 20px;
        }
        body.admin-bar #wphead {
            padding-top: 0;
        }
        body.admin-bar #footer {
            padding-bottom: 32px;
        }
        #wpadminbar {
            top: auto !important;bottom: 0;
        }
        #wpadminbar .quicklinks .menupop .ab-sub-wrapper {
            bottom: 32px;
        }
        #wpadminbar .quicklinks .menupop ul {
            bottom: 0;
        }
        .admin-bar .header-inner.is-sticky {
            top: 0;
        }';
          echo '</style>';
    }
}
add_action( 'wp_head', 'move_admin_bar' );


/**
 * Prints scripts or data before the default footer scripts.
 * 
 * This hook is for admin only and can’t be used to add anything on the front end.
 * Displays WYSIWYG text editor on edit post ONLY for Gallery page in admin part
 */
function yc_photography_admin_footer_function() {
    // Retrieves all pages
    $query = get_posts([
        'post_type' => 'page'
    ]);
    $everyPosts = $query;
    // global $pagenow;
    // Retrieves current page id
    $pageId = $_GET['post'];
    foreach($everyPosts as $onePost):
        // Only for home page
        if($onePost->post_name === 'home'):
            // Get Home page ID
            $pageHomeId = $onePost->ID;
            // Undisplays the base WYSIWYG 
            // if($pagenow == 'post.php' && $_GET['post'] == $pageId) {
            if($pageHomeId == $pageId):
                echo 
                '<style>
                    #postdivrich {
                        display: none;
                    }
                </style>';
            // }
            endif;
        endif;
    endforeach;
}
add_action('admin_footer', 'yc_photography_admin_footer_function');

// Must be removed when put into production.
// Debugging function for development.
function debug($value) {
    echo '<div class="custom_debug" style="border: 5px solid grey; max-width: 500px; width: 100%; height: 300px; overflow-y: scroll; overflow-x: hidden; margin: 2em; padding: 1em;background-color: black; color: white; margin: 0 auto;">';
    echo '<pre style="white-space: break-spaces;">';
    print_r($value);
    echo '</pre>';
    echo '</div>';
    // die;
}