<?php
/**
* Template Name: Page Galerie
 */
?>

<?php
get_header();


// $output = apply_filters('post_gallery', '', $attr);
// if ( $output != '' )
//     return $output;
/**
 * @param WP_Query $query
 */
// Works, if go on http://localhost/elfee/galerie/hound-gcff0e760a_1280.jpg/ -> not 404 but on galerie page
// autorise la réécriture de cette forme d'url, empêche la 404
// Attention, ne pas oublier de recharger les permalinks !!!
// function capitaine_rewrite_url() {
//     add_rewrite_tag( '%chroniques%' ,'([^&]+)' );
//     add_rewrite_tag( '%photoname%' ,'([^&]+)' );
//     add_rewrite_tag( '%n_slider%' ,'([^&]+)' );
//     add_rewrite_rule(
//       'galerie/([^/]+)/([^/]+)',
//       'index.php?pagename=chroniques&photoname=$matches[1]&n_slider=$matches[2]',
//     //   'index.php?pagename=galerie&photoname=$matches[1]',
//       'top'
//     );
// }
// add_action( 'init', 'capitaine_rewrite_url' );

// Adds 'photoname' and 'n_slider' to query vars
// pour chaque image
// pour pouvoir les récupérer ensuite dans l'url et afficher le bon slide
function montheme_query_vars($params) {
    // if(is_attachment()) {
    // si je n'ajoute photoname, pre_get_post -> get_query_var renvoie vide
    $params[] = 'photoname';
    $params[] = 'n_slider';
    // }
    echo '<pre>';
    var_dump($params);
    debug($params);
    echo '</pre>';
    // die;
    return $params;
}
add_action('query_vars', 'montheme_query_vars');

// // permet de filtrer, altérer des valeurs (après leur tri ?) mais avant leur affichage
// // pas utilisée ici parce que fait directement dans le template (lui-même géré dans un filtre) donc revient au même
// function montheme_pre_get_posts($query) {
//     // if(get_post_type() == 'attachment')
//     if(is_admin() || !$query->is_main_query()) {
//         return;
//     }
//     if(is_page_template('template-galerie.php')) {
//         // die;
//         // debug(get_post_gallery(get_queried_object_id(), false));
//         $get_attachments_ids = get_post_gallery(get_queried_object_id(), false)['ids'];
//         // debug($get_attachments_ids);
//         // debug(wp_get_attachment_metadata(get_queried_object_id()));
//         if(!empty(get_query_var('photoname'))) {
            
//         }

//     }
//     // get_query_var va chercher dans l'url !!!
//     // var_dump(get_query_var('photoname'));
//     // var_dump(get_query_var('n_slider'));

//     // echo '<pre>';
//     // var_dump($query);
//     // echo '</pre>';
//     // die;
// }
// add_action('pre_get_posts', 'montheme_pre_get_posts');

// renvoie un nombre positifi ou 0 selon si la query var 'n_slider' est renseignée ou vide
// permet d'afficher le bon cifrre dans le current slide, donc de récupérer la bonne valeur dans currentSlide afin d'afficher la bonne image quand lien pointe vers une image spécifiquement et que fenêtre s'ouvre sur sur cette image mais dans le slider
function not_empty_var() {
    // si la query var 'n_slider' n'est pas vide
    if(!empty(get_query_var('n_slider'))) {
        // récupère-moi cette query var
        $numb = get_query_var('n_slider');
    } else {
        // sinon, renvoie-moi 0
        $numb = 0;
    }
    return $numb;
}

// Fonction qui permet d'afficher le nombre de likes pour chaque image 
function setInputValue($id) {
    global $wpdb;
    // Fonction SQL si on était sûr de n'avoir qu'une seule valeur par image dans bdd
    $number_of_likes = $wpdb->get_var("SELECT likes FROM wp_likes WHERE att_id = $id");
    // Select last key 
    // $number_of_likes = $wpdb->get_var("SELECT likes FROM wp_likes WHERE att_id = $id ORDER BY ID DESC LIMIT 1");
    if(empty($number_of_likes)) {
        $number_of_likes = 0;
    }
    return $number_of_likes;
}

// /**
//  * Nettoie les règles d'écriture à chaque changement de thème
//  */
// // Au chargement de notre thème
// add_action('after_switch_theme', 'flush_rewrite_rules');
// // À chaque changement de thème
// add_action('switch_theme', 'flush_rewrite_rules');

// add_theme_support( 'html5', [ 'gallery' ] );
// debug(get_page_template_slug( get_the_ID() ));
// debug(get_post_gallery_images());
// Tout fonctionne bien !
// !!! Par contre, il ne doit y avoir qu'une seule galerie sinon, modal bug
// PB currentSlide() parce que récupère chaque image de chaque galerie ? donc slideIndex généré x2
// debug(get_post());
add_filter('post_gallery', 'custom_gallery_html', 10, 3);
function custom_gallery_html($output, $attr, $instance) { 
    // die;
    // debug($output);
    // Retrieve the images from the gallery
    $ids = explode(',', $attr['ids']);
    $size = $attr['size'];
    // $size = '';
    if(array_key_exists('size', $attr)):
        $size = $attr['size'];
    else: 
        $size = 'full';
    endif;

    // echo '<div style="border: 5px solid purple;">' . not_empty_var() . '</div>';

    $output = '<div class="div_gallery">';
    // Fonctionne mais ne fonctionne pas car l'image appelée via current slide se déclenche au click
    // $i = not_empty_var();
    $i = 0;
    // debug($i);
    $j = 0;
    $k = 0;
    foreach ($ids as $id) {
    
        // debug(wp_get_attachment_metadata($id));
        // debug(wp_get_attachment_metadata($id)['file']);
        // debug(explode('/', wp_get_attachment_metadata($id)['file']));
        // $photo_get_name = explode('/', wp_get_attachment_metadata($id)['file'])[2];
        $photo_get_name = explode('/', wp_get_attachment_metadata($id)['file'])[2];
        $photo_ext = explode('.', $photo_get_name);
        $photo_name = $photo_ext[0];
        $photo_ext = '.' . $photo_ext[1];
        // debug($photo_get_name);
        // debug($photo_name);
        // debug($photo_ext);
    
        // global $wp_query;
        // echo $photoname;
        // $photoname = '';
        // add_query_arg('photoname', $photo_get_name, get_template_directory_uri() . $photo_get_name);
        // // echo '<div style="border: 10px solid yellow;">' . $photo_get_name . '</div>';
        // set_query_var('photoname', $photo_get_name);
        // $photoname = get_query_var('photoname');
        // echo '<div style="border: 10px solid red;">' . $photoname . '</div>';
        // echo $wp_query->query_vars['photoname'];
        
    
        $i++;

        $output .= '<div id="' . $id . '_' . $photo_name . '" class="img-container" onclick="onClick(this)">';
        $image_src = wp_get_attachment_image_src($id, $size)[0];
        $image_width = wp_get_attachment_image_src($id, $size)[1];
        $image_height = wp_get_attachment_image_src($id, $size)[2];
        $image_srcset = wp_get_attachment_image_srcset($id, $size);
        $image_sizes = wp_get_attachment_image_sizes($id, $size);
        
        // $i++;
        // echo $i;
        set_query_var('n_slider', $i);
        $n_slider = get_query_var('n_slider');
        // echo $n_slider;

        $output .= '<img id="photo-' . $id . '" style="cursor: pointer;" width="' . $image_width . '" height="' . $image_height . '" src="' . $image_src . '" class="attachment-' . $size . ' size-' . $size . ' img-hover-opacity photos" alt="" decoding="async" loading="lazy" srcset="' . $image_srcset . '" sizes="' . $image_sizes . '" onclick="currentSlide(' . $i . ')" data-orderslide="' . $i . '">';
    
        $output .= '</div>';
    }
    $output .= '</div>';
    $output .= '<!-- Modal -->
    <div id="modal01" class="img-modal"> <!-- ouverture grande modale -->

        <!-- maximize icon -->
        <span id="button_maximize" class="maximize_icon" onclick="openFullscreen();">
            <svg fill="#000000" width="25px" height="25px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
            viewBox="0 0 202.205 202.205" style="enable-background:new 0 0 202.205 202.205;" xml:space="preserve">
                <g>
                    <g>
                        <polygon style="fill:#010002;" points="202.205,74.268 202.198,0 127.933,0.011 127.93,5.902 192.131,5.912 110.329,87.71 
                            114.498,91.876 196.3,10.078 196.293,74.268 		"/>
                        <polygon style="fill:#010002;" points="87.7,110.343 5.902,192.141 5.902,127.947 0,127.947 0,202.205 74.25,202.205 
                            74.268,196.314 10.067,196.304 91.862,114.505 		"/>
                    </g>
                </g>
            </svg>
        </span>

        <!-- minimize icon -->
        <span id="button_minimize" class="minimize_icon" onclick="closeFullscreen();">
            <svg fill="#000000" width="25px" height="25px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
            viewBox="0 0 60 60" style="enable-background:new 0 0 60 60;" xml:space="preserve">
                <g>
                    <path d="M59.707,0.293c-0.391-0.391-1.023-0.391-1.414,0L36,22.586V5c0-0.552-0.447-1-1-1s-1,0.448-1,1v20
                        c0,0.13,0.027,0.26,0.077,0.382c0.101,0.245,0.296,0.44,0.541,0.541C34.74,25.973,34.87,26,35,26h20c0.553,0,1-0.448,1-1
                        s-0.447-1-1-1H37.414L59.707,1.707C60.098,1.316,60.098,0.684,59.707,0.293z"/>
                    <path d="M25.382,34.077C25.26,34.027,25.13,34,25,34H5c-0.553,0-1,0.448-1,1s0.447,1,1,1h17.586L0.293,58.293
                        c-0.391,0.391-0.391,1.023,0,1.414C0.488,59.902,0.744,60,1,60s0.512-0.098,0.707-0.293L24,37.414V55c0,0.552,0.447,1,1,1
                        s1-0.448,1-1V35c0-0.13-0.026-0.26-0.077-0.382C25.822,34.373,25.627,34.178,25.382,34.077z"/>
                </g>
            </svg>
        </span>

        <!-- Close button -->
        <span id="button_disnone" class="img-close-button" onclick="closeModal()">
            <svg fill="#000000" height="25px" width="25px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 490 490" xml:space="preserve">
            <polygon points="11.387,490 245,255.832 478.613,490 489.439,479.174 255.809,244.996 489.439,10.811 478.613,0 245,234.161 
                11.387,0 0.561,10.811 234.191,244.996 0.561,479.174 "/>
            </svg>
        </span>

        <!-- Next and previous buttons -->
        <a class="prev" onclick="plusSlides(-1)">
            <svg xmlns="http://www.w3.org/2000/svg" fill="#000000" stroke="none" width="30" height="30" viewBox="0 0 15 27">
                <g fill-rule="evenodd">
                    <path fill-rule="nonzero" d="M14.258 1.53L13.198.47-.061 13.728l13.259 13.258 1.06-1.06L2.061 13.728z"></path>
                </g>
            </svg>
        </a>

        <a class="next" onclick="plusSlides(1)">
            <svg fill="#000000" stroke="none" width="30" height="30" viewBox="0 0 15 27">
                <g fill-rule="evenodd">
                    <path fill-rule="nonzero" d="M.198 25.926l1.06 1.06 13.259-13.258L1.258.47.198 1.53l12.197 12.198z"></path>
                </g>
            </svg>
        </a>

        <!-- Modal images -->
        <div class="img-modal-content img-animate-zoom"> <!-- ouverture modal content -->
            <!-- Ici, générer automatiquement la balise img -->';
            foreach($ids as $id) {
                // $i++;
                $photo_get_name = explode('/', wp_get_attachment_metadata($id)['file'])[2];
                $photo_ext = explode('.', $photo_get_name);
                $photo_name = $photo_ext[0];
                $photo_ext = '.' . $photo_ext[1];

                // Sans JS, récupère bien query var pour chaque image MAIS possible grâce au set_query_var
                // debug(get_query_var('photoname'));
                // permet de changer url dynamiquement quand slide les photos GRÂCE et SI url dynamiques avc JS.

                // donne la valeur de base !!!! dans template à l'ouverture du doc récupérée en JS
                set_query_var('photoname', $photo_get_name);
                // echo $photoname;
                
                // permet de récupérer la valeur de param photoname et de l'attribuer à data-sharingurl (fait le lien avec JS)
                $photoname = get_query_var('photoname');

                // echo '<div style="border: 5px solid green">'.$photoname.'</div>';

                // echo '<hr>';

                // echo '<div style="border: 10px solid red;">' . $photoname . '</div>';
                // echo $wp_query->query_vars['photoname'];
                // wp_reset_postdata();

                $setInputValue = setInputValue($id);
                // echo '<div style="border: 10px solid red;">'.$setInputValue.'</div>';
                $image_src = wp_get_attachment_image_src($id, $size)[0];
                
                $j++;

                // echo '<div style="border: 5px solid yellow">'.$j.'</div>';


                set_query_var('n_slider', $j);
                $n_slider = get_query_var('n_slider');

                // echo '<hr>';
                // echo '<hr>';
                // echo '<div style="border: 5px solid red">'.$n_slider.'</div>';

                $output .=  
                '<!-- 1 -->
                <div id="div' . $id . '">  <!-- ouverture div image -->
                    <img class="mySlides heart_counter' . $id . '" src="' . $image_src . '">
                    <!-- share button -->
                    <span id="share" class="share" onclick="displayModalShare(this)" data-sharingUrl="' . $photoname . '" data-nslider="' . $n_slider . '">
                        <svg fill="#000000" height="18px" width="18px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                        viewBox="0 0 512 512" xml:space="preserve">
                            <g>
                                <g>
                                    <path d="M512,241.7L273.643,3.343v156.152c-71.41,3.744-138.015,33.337-188.958,84.28C30.075,298.384,0,370.991,0,448.222v60.436
                                        l29.069-52.985c45.354-82.671,132.173-134.027,226.573-134.027c5.986,0,12.004,0.212,18.001,0.632v157.779L512,241.7z
                                        M255.642,290.666c-84.543,0-163.661,36.792-217.939,98.885c26.634-114.177,129.256-199.483,251.429-199.483h15.489V78.131
                                        l163.568,163.568L304.621,405.267V294.531l-13.585-1.683C279.347,291.401,267.439,290.666,255.642,290.666z"/>
                                </g>
                            </g>
                        </svg>
                    </span>

                    <!-- heart button -->
                    <span id="heart" class="heart">
                        <svg fill="#000000" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="-18.02 -18.02 636.86 636.86" xml:space="preserve" stroke="#000000" stroke-width="18.02472">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"/>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/>
                            <g id="SVGRepo_iconCarrier"> <g> <g> <path d="M300.413,579.295l-3.838-2.256c-0.417-0.244-42.267-24.99-93.594-66.887C155.53,471.42,89.913,409.596,46.783,335.031 C15.751,281.351,0.011,227.687,0,175.529c-0.002-22.647,4.062-43.951,12.079-63.319c7.697-18.593,18.843-34.986,33.129-48.724 c28.135-27.056,66.771-41.957,108.79-41.957c25.468,0,48.491,4.055,68.428,12.051c19.008,7.624,35.286,18.838,48.382,33.333 c13.457,14.893,23.404,33.046,29.605,53.767c6.201-20.723,16.148-38.872,29.607-53.767c13.098-14.494,29.377-25.709,48.385-33.332 c19.939-7.997,42.965-12.051,68.434-12.051c42.016,0,80.648,14.901,108.783,41.957c14.287,13.738,25.434,30.132,33.131,48.725 c8.016,19.368,12.078,40.672,12.072,63.319c-0.01,52.166-15.752,105.83-46.795,159.502c-19.068,32.977-44.084,66.23-74.354,98.834 c-24.145,26.008-51.676,51.676-81.828,76.289c-51.328,41.896-93.182,66.641-93.598,66.887L300.413,579.295z M153.998,36.672 c-38.085,0-72.993,13.399-98.293,37.729c-26.54,25.522-40.566,60.49-40.561,101.125c0.01,49.464,15.066,100.579,44.75,151.925 c23.146,40.018,68.384,102.131,152.449,170.795c41.561,33.947,76.727,56.404,88.071,63.408 c11.345-7.002,46.513-29.461,88.074-63.408c46.4-37.898,110.512-98.295,152.436-170.795 c29.691-51.34,44.752-102.455,44.76-151.926c0.012-40.634-14.014-75.602-40.555-101.125 c-25.301-24.329-60.207-37.729-98.287-37.729c-45.842,0-81.363,13.59-105.584,40.393c-21.766,24.088-33.271,58.135-33.271,98.461 h-15.143c0-40.325-11.505-74.373-33.27-98.461C235.353,50.263,199.833,36.672,153.998,36.672z"/> </g> </g> </g>
                        </svg>
                    </span>

                    <!-- heart counter -->
                    <span id="heart_counter' . $id . '" class="heart_counter">'.$setInputValue.'</span>
                    <input type="hidden" class="input_storage heart_counter_' . $id . '" id="dname" name="dname" value="'.$setInputValue.'">
                    <input type="hidden" class="input_storage_att_id" id="att_id" name="att_id" value="' . $id . '">

                </div> <!-- fermeture div image -->';
            }
            // Tjs dans modal content

            // SHARING
            // Ajouter la modale 'share' ici
            $output .= 
            '<!-- ouverture grand div sharing -->
            <div id="modal_social_sharing" class="modal_social_sharing" style="z-index: 999999999; display: inline-flex; padding-top: 100px; position: fixed; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.4);">

                <!-- ouverture div sharing content -->
                <div class="modal_content_social_sharing' . $id . '" style="height: 250px; width: 500px; background-color: white; margin: auto;display: flex; align-items: center; justify-content: center; position: relative;">

                    <div id="close_social_modal" class="div_close_social_modal" style="position: absolute; top: 20px; right: 20px; color: black; font-siez: 1.2rem; cursor: pointer;" onclick="displayCloseShare()">
                        <i class="fa-solid fa-xmark"></i>
                    </div>';

                    foreach($ids as $id) {
                        // Récupérer url de chaque image

                        $output .= 
                        '<!-- ouverture div sharing -->
                        <div class="div_social_sharing" style="width: 60%;">

                            <!-- ouverture icons container -->
                            <div class="social_icons_container" style="display: flex; justify-content: space-between; padding: .5rem; flex-wrap: wrap; gap: .5rem;">';
                                require('inc/widget-sharing-social-data.php');
                                foreach($networks as $name => $networkItem) {
                                ?>
                                    <?php

                                    $output .= 
                                    '<div class="div_social ' . $name . '" style="cursor: pointer;">
                                        <!-- <a href="http://www.facebook.com/sharer.php?u=http://www.example.com" target="_blank" title="Partager sur Facebook" rel="noopener"><i class="fa-brands fa-facebook"></i></a> -->
                                        <a href="' . $networkItem['sharing_url'] . '" target="_blank" title="Partager sur ' . $networkItem['label'] . '" rel="noopener"><i class="fa-brands fa-' . $name . '"></i></a>
                                    </div>';
                                    
                                }
                                $output .= 
                            '</div> <!-- fermeture icons container -->';

                            $k++;

                            // echo '<div style="border: 5px solid yellow">'.$k.'</div>';


                            set_query_var('n_slider', $k);
                            $n_slider = get_query_var('n_slider');
                            $photo_get_name = explode('/', wp_get_attachment_metadata($id)['file'])[2];
                            set_query_var('photoname', $photo_get_name);
                            $photoname = get_query_var('photoname');

                            // echo '<hr>';
                            // echo '<hr>';
                            // echo '<div style="border: 5px solid red">'.$n_slider.'</div>';
                            // echo '<hr>';
                            // echo '<hr>';
                            // echo '<hr>';

                            $share_link = get_template_directory_uri() . '/' . $photoname;

                            $output .= 
                            '<div id="social_link_container'.$id.'" class="social_link_container" style="padding: .5rem;">
                                <div style="display: flex; margin-bottom: .5rem; position: relative;">
                                    <div class="div_link" style="border: 1px solid black; width: 90%;">
                                        <input type="text" disabled id="share_link" name="share_link" value="' . $share_link . '" style="border: none; padding: .8rem .5rem; width: 100%;">
                                        <input type="hidden" disabled id="share_link_hidden" name="share_link_hidden" value="' . $share_link . '" style="border: none; padding: .8rem .5rem; width: 100%;">
                                        <input type="hidden" disabled id="share_link_n_slider" name="share_link_n_slider" value="' . $n_slider . '" style="border: none; padding: .8rem .5rem; width: 100%;">
                                    </div>
                                    <div class="div_btn" style="border: 1px solid black;" onclick="copyToClipboard(this)">
                                        <button id="share_link_button" style="cursor: pointer; border: none; padding: .8rem; width: 100%; height: 100%; background-color: black;"><i class="fa-regular fa-clone" style="color: white; font-size: 1rem;"></i></button>
                                    </div>
                                </div>
                                <div>
                                <span id="copied" style="padding: .5rem; text-align: center; position: absolute; bottom: 0; left: 50%; transform: translate(-50%, -50%);"></span>
                                </div>
                            </div>';

                        $output .=
                        '</div> <!-- fermeture div sharing -->';
                    }
                $output .= 
            '</div> <!-- fermeture div sharing content -->
        </div> <!-- fermeture grande div shraing -->';

        $output .= '</div>'; // ATTENTION: il manquait celle-ci. À quoi correspond-elle ?
    
    $output .= '</div>'; // fermeture grande modale
    return $output;
}

?>



<style>
    .div_social i,
    .div_close_social_modal i {
        color: black;
        font-size: 1.5rem;
    }
</style>



<!-- TEMPLATE -->
<?php
echo get_the_title(get_the_ID());
add_theme_support( 'html5', [ 'gallery' ] );
if ( $gallery = get_post_gallery( get_the_ID(), false ) ) :
    debug($gallery);
    // the_content();
    echo do_shortcode(get_the_content(get_the_ID()));
endif;
?>


<!-- Old version style -->
<style type="text/css">
    .big_gallery {
        padding: 50px;
    }
    .big_gallery figure {
        margin: 0;
    }
    .gallery {
        display: flex;
        flex-flow: row wrap;
        gap: 20px;
        margin-bottom: 20px;
    }
    .gallery-item {
        width: calc(50% - 20px);
        height: 100%;
    }
    .gallery-item:nth-child(2n) {
        width: calc(25% - 20px);
        height: 100%;
    }
    .gallery-item:nth-child(3n) {
        width: calc(25% - 20px);
        height: 100%;
    }
    .gallery-item img {
        height: 250px;
        object-fit: cover;
    }
</style>
<?php
get_footer();
