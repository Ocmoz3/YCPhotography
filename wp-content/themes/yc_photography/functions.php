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
require_once('inc/metaboxes/FrontPageMetabox.php');


// rq: doit être dans functions.php pour fonctionner, peut-être une question de priorité
// permet d'injecter le nombre de likes pour chaque image en bdd
// si l'image a déjà un ou plusieurs likes, la valeur n'est pas ajoutée, seule la ligne est mise à jour
// système qui permet de ne pas avoir une ligne à caque mais seulement une ligne par image, la bdd de données n'est pas alourdie et le fonctionnement allégé puisque qu'il n'y a pas besoin de sélectionner plusieurs lignes pour une image et ensuite sélectionner la dernière donnée misa à jour, aucun doublon de ligne pour une image
function actionFunction() {
    $att_id = $_POST['att_id'];
    $value = $_POST['dname'];
    // Pour vérification, s'affiche dans alert (if ajax success dans ajax-handle.js)
    // echo $value;
    // echo $att_id;
    // Connexion bdd
    global $wpdb;
    // Je vérifie si cette image a déjà une ligne dans cette table
    // Je sélectionne le nombre de 
    $number_of_likes = $wpdb->get_var("SELECT COUNT(likes) FROM wp_likes WHERE att_id = $att_id");
    echo $number_of_likes;
    // Si aucune ligne de la base de données correspond à cette image -> l'insérer
    if($number_of_likes == 0) {
    $wpdb->insert(
        'wp_likes',
        array(
        'att_id' => $att_id,
        'likes' => $value
        ),
        array(
        '%d',
        '%d'
        )
    );
    } 
    // Sinon, si une ligne existe déjà à cette image, mettre à jour cette ligne
    else {
    $wpdb->update(
    'wp_likes',
    array(
    'likes' => $value
    ),
    array(
        'att_id' => $att_id,
    ),
    array(
    '%d',
    // '%d'
    )
    );
}
    die();
    return true;
}
// Résultat = aucun doublon ! Une seule ligne par image !
add_action('wp_ajax_actionFunction', 'actionFunction'); // Call when user logged in
add_action('wp_ajax_nopriv_actionFunction', 'actionFunction'); // Call when user in not logged in


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
        echo '</style>';
    endif;
}
add_action( 'wp_head', 'move_admin_bar' );


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


// ADMIN SECTION
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
            #frontpage_metabox_portfolio,
            #frontpage_metabox_exhibitions,
            #frontpage_metabox_contact {
                display: none;
            }
        </style>
    <?php
    endif;
}
add_action('admin_head', 'yc_photography_admin_head_style');

// META BOXES
/**
 * Prints scripts or data before the default admin footer scripts.
 * 
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