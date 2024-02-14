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
require_once('inc/sidebars.php');
require_once('inc/metaboxes/FrontPageMetabox.php');
require_once('inc/metaboxes/LikesMetabox.php');
require_once('inc/galleries.php');

/**
 * Cleans up writing rules every time you change theme
 */
// When loading the theme.
add_action('after_switch_theme', 'flush_rewrite_rules');
// Each time you change theme.
add_action('switch_theme', 'flush_rewrite_rules');

// CONTACT FORM 7
/**
 * Removes <br/>, <p> and <span> from user form contact.
 */
add_filter('wpcf7_form_elements', function($content) {
    $content = preg_replace('/<(span).*?class="\s*(?:.*\s)?wpcf7-form-control-wrap(?:\s[^"]+)?\s*"[^\>]*>(.*)<\/\1>/i', '\2', $content);
    $content = str_replace('<br />', '', $content);
    $content = str_replace('<p>', '', $content);
    $content = str_replace('</p>', '', $content);
    $content = str_replace('<span>', '', $content);
    $content = str_replace('</span>', '', $content);
    return $content;
});

/**
 * Replaces all accents with their unaccented equivalents.
*/
function yc_photography_turns_into_slug($str){
    $unwanted_array = array(
        'Š'=>'S', 'š'=>'s', 'Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
        'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U',
        'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss', 'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c',
        'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o',
        'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y',
        ' ' => '-'
    );
    $str = strtr( $str, $unwanted_array );
    return $str;
}

// ADMIN SECTION

/**
 * Moves WordPress Admin Bar to the bottom.
 * 
 * Important function due to header fixed position.
 */
function move_admin_bar() {
    if (is_admin_bar_showing()):
        echo '<style type="text/css">';
        if (wp_is_mobile()):
            // show_admin_bar(false);
            echo '#wpadminbar {
                position: fixed !important;
            }';
            // echo 'body{margin-top: -46px; padding-bottom: 0}';
        endif;
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
        echo '/* RESPONSIVE */
        @media screen and (max-width: 600px) {
            #wpadminbar {
                position: fixed;
            }
        }
        ';
        echo '</style>';
    endif;
}
add_action( 'wp_head', 'move_admin_bar' );

/**
 * Prints scripts or data before the default footer scripts.
 * 
 * This hook is for admin only and can’t be used to add anything on the front end.
 * Displays WYSIWYG text editor on edit post ONLY for Gallery page in admin part
 */
function yc_photography_admin_head_style() {
    if(isset($_GET['post']) && $_GET['post'] != 6):
        ?>
        <!-- Cancels metabox display on pages other than the home page -->
        <style>
            #frontpage_metabox_image,
            #frontpage_metabox_presentation,
            #frontpage_metabox_portfolio,
            #frontpage_metabox_exhibitions,
            #frontpage_metabox_contact {
                display: none;
            }
        </style>
    <?php
    else:
    ?>
    
        <!-- Cancels base WYSIWYG display on front page and displays front page meta boxes -->
        <style>
            #frontpage_metabox_image,
            #frontpage_metabox_presentation,
            #frontpage_metabox_portfolio,
            #frontpage_metabox_exhibitions,
            #frontpage_metabox_contact {
                display: block;
            }
            #postdivrich {
                display: none !important;
            }
        </style>
    <?php
    endif;
}
add_action('admin_head', 'yc_photography_admin_head_style');

// META BOXES

/**
 * Prints scripts or data before the default admin footer scripts.
 */
function yc_photography_admin_footer_script() {
    ?>
    <script type="text/javascript">
        // Retrieves the value of the select field and assigns it to the hidden field.
        function myFunction(e) {
            thisVal = jQuery(e.target);
            thisValNext = thisVal.next();
            getValue = thisValNext.val(thisVal.val());
        }
        <?php
        if(isset($_GET['post']) && $_GET['post'] == 6):
        ?>
            // Script that deletes or adds a metabox ('repeater', portfolio type)
            // Loads only on edit post for front page.
            jQuery(document).ready(function($){
                jQuery(document).on('click', '.cxc-remove-item', function() {
                    jQuery(this).parents('tr.cxc-sub-row').remove();
                }); 				
                jQuery(document).on('click', '.cxc-add-item', function() {
                    var p_this = jQuery(this);    
                    var row_no = parseFloat( jQuery('.cxc-item-table tr.cxc-sub-row').length );
                    console.log(row_no);
                    var row_html = jQuery('.cxc-item-table .cxc-hide-tr').html().replace(/rand_no/g, row_no).replace(/hide_custom_repeater_item/g, 'custom_repeater_item');
                    jQuery('.cxc-item-table tbody').append('<tr class="cxc-sub-row">' + row_html + '</tr>');    
                });
            });
            // Adds class 'metabox_title' to inputs which id attribute ends with 'title'.
            inputTitle = jQuery('input[id$="_title"]');
            inputTitle.addClass('metabox_title');
        <?php
        endif;
        ?>
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