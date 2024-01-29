<?php
/**
 * YC Photography theme functions
 */

/**
 * Required files
 */
require_once('inc/assets.php');
require_once('inc/menus.php');
require_once('inc/supports.php');
require_once('inc/metaboxes/frontpage_metabox.php');
// require_once('inc/metaboxes/repeater_metabox.php');

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
function yc_photography_admin_head_style() {
    // Retrieves all pages
    $query = get_posts([
        'post_type' => 'page'
    ]);
    $pageId = '';
    $everyPosts = $query;
    // global $pagenow;
    // Retrieves current page id
    if(isset($_GET['post'])):
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
    endif;
    if(isset($_GET['post']) && $_GET['post'] != 6):
        ?>
        <!-- Cancels metabox display on pages other than the home page -->
        <style>
            #frontpage_metabox_image,
            #frontpage_metabox_presentation,
            #frontpage_metabox_portfolio {
                display: none;
            }
        </style>
    <?php
    endif;
}
add_action('admin_head', 'yc_photography_admin_head_style');

function yc_photography_admin_footer_script() {
    ?>
    <script>
    function myFunction(e) {
        // console.log('okk');
        // document.getElementById("myText").value = e.target.value
        // Je sélectionne le select qui a changé
        thisVal = jQuery(e.target);
        // Je sélectionne l'élément d'après (<p>)
        thisValNext = thisVal.next();
        // console.log(thisValNext);
        // Pour pouvoir sélectionner l'élément suivant (<input>) pour lui attribuer la valeur du select
        thisValNextNext = thisValNext.next().val(thisVal.val());
        // console.log(thisValNextNext);
        // console.log(thisVal.val());
    }
    </script>
<?php
}
add_action('admin_footer', 'yc_photography_admin_footer_script');
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