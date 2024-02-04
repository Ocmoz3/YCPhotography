<?php
// add_theme_support( 'html5', [ 'gallery' ] );
// debug(get_page_template_slug( get_the_ID() ));
// debug(get_post_gallery_images());
// Tout fonctionne bien !
// !!! Par contre, il ne doit y avoir qu'une seule galerie sinon, modal bug
// PB currentSlide() parce que récupère chaque image de chaque galerie ? donc slideIndex généré x2
// debug(get_post());
add_filter('post_gallery', 'custom_gallery_html', 10, 3);
function custom_gallery_html($output, $attr, $instance) { 
    // Retrieves the images from the gallery.
    $ids = explode(',', $attr['ids']);
    // $size = $attr['size'];

    if(array_key_exists('size', $attr)):
        $size = $attr['size'];
    else: 
        $size = 'full';
    endif;

    // DIV GALLERY
    $output = '<div class="div_gallery">';
    $i = 0;
    $j = 0;
    $k = 0;
    foreach ($ids as $id) {
    
        $photo_get_name = explode('/', wp_get_attachment_metadata($id)['file'])[2];
        $photo_ext = explode('.', $photo_get_name);
        $photo_name = $photo_ext[0];
        $photo_ext = '.' . $photo_ext[1];

        $i++;

        // DIV IMG
        $output .= 
        '<div id="' . $id . '_' . $photo_name . '" class="img-container" onclick="onClick(this)">';

            $image_src = wp_get_attachment_image_src($id, $size)[0];
            $image_width = wp_get_attachment_image_src($id, $size)[1];
            $image_height = wp_get_attachment_image_src($id, $size)[2];
            $image_srcset = wp_get_attachment_image_srcset($id, $size);
            $image_sizes = wp_get_attachment_image_sizes($id, $size);
            
            set_query_var('n_slider', $i);
            $n_slider = get_query_var('n_slider');

            // IMG
            $output .= '<img id="photo-' . $id . '" width="' . $image_width . '" height="' . $image_height . '" src="' . $image_src . '" class="attachment-' . $size . ' size-' . $size . ' img-hover-opacity photos" alt="" decoding="async" loading="lazy" srcset="' . $image_srcset . '" sizes="' . $image_sizes . '" onclick="currentSlide(' . $i . ')" data-orderslide="' . $i . '">';
    
        $output .= 
        '</div>';
        // END DIV IMG
    }
    $output .= '</div>';
    // END DIV GALLERY

    // MODAL
    $output .= 
    '<!-- Modal -->
    <!-- ouverture grande modale -->
    <div id="modal01" class="img-modal">';

        // MIN MAX BUTTONS
        $output .= '
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
        </span>';

        // CLOSE BUTTON
        $output .= 
        '<!-- Close button -->
        <span id="button_disnone" class="img-close-button" onclick="closeModal()">
            <svg fill="#000000" height="25px" width="25px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 490 490" xml:space="preserve">
            <polygon points="11.387,490 245,255.832 478.613,490 489.439,479.174 255.809,244.996 489.439,10.811 478.613,0 245,234.161 
                11.387,0 0.561,10.811 234.191,244.996 0.561,479.174 "/>
            </svg>
        </span>';

        // NEXT PREV BUTTONS
        $output .= 
        '<!-- Next and previous buttons -->
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
        </a>';

        // DIV MODAL
        $output .= 
        '<!-- Modal images -->
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
                
                // permet de récupérer la valeur de param photoname et de l'attribuer à data-sharingurl (fait le lien avec JS)
                $photoname = get_query_var('photoname');

                $setInputValue = setInputValue($id);
                $image_src = wp_get_attachment_image_src($id, $size)[0];
                
                $j++;

                set_query_var('n_slider', $j);
                $n_slider = get_query_var('n_slider');

                // DIV IMG
                $output .= 
                '<!-- 1 -->
                <div id="div' . $id . '">  <!-- ouverture div image -->';

                    // IMG
                    $output .= 
                    '<img class="mySlides heart_counter' . $id . '" src="' . $image_src . '">';

                    // SHARE BUTTON
                    $output .= 
                    '<!-- share button -->
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
                    </span>';

                    // HEART BUTTON & COUNTER
                    $output .= 
                    '<!-- heart button -->
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
                // END DIV IMG
            }
            // Tjs dans modal content

            // DIV SHARE
            $output .= 
            '<!-- ouverture grand div sharing -->
            <div id="modal_social_sharing" class="modal_social_sharing">
                <!-- ouverture div sharing content -->
                <div class="modal_content_social_sharing">';

                    foreach($ids as $id) {
                        // SHARE CONTENT
                        $output .= 
                        '<!-- ouverture div sharing -->
                        <div class="div_social_sharing">';

                            // SHARE CLOSE BUTTON
                            $output .=  
                            '<div id="close_social_modal-' . $id . '" data-getid="' . $id . '" class="div_close_social_modal" onclick="displayCloseShare(this)">
                                <i class="fa-solid fa-xmark"></i>
                            </div>';
                            // END SHARE CLOSE BUTTON
                            
                            // DIV ICONS
                            $output .=  
                            '<!-- ouverture icons container -->
                            <div class="social_icons_container">';
                                require('widget-sharing-social-data.php');
                                foreach($networks as $name => $networkItem) {
                                ?>
                                    <?php
                                    // SOCIAL ICONS
                                    $output .= 
                                    '<div class="div_social ' . $name . '">
                                        <a href="' . $networkItem['sharing_url'] . '" target="_blank" title="Partager sur ' . $networkItem['label'] . '" rel="noopener"><i class="fa-brands fa-' . $name . '"></i></a>
                                    </div>';
                                }
                                $output .= 
                            '</div> <!-- fermeture icons container -->';
                            // END DIV ICONS

                            $k++;

                            set_query_var('n_slider', $k);
                            $n_slider = get_query_var('n_slider');
                            $photo_get_name = explode('/', wp_get_attachment_metadata($id)['file'])[2];
                            set_query_var('photoname', $photo_get_name);
                            $photoname = get_query_var('photoname');

                            $share_link = get_template_directory_uri() . '/' . $photoname;

                            // DIV SHARE LINK
                            $output .= 
                            '<div id="social_link_container-'.$id.'" class="social_link_container">';
                                // SHARE INPUT & BUTTON
                                $output .= 
                                '<div class="div_share_input_btn">
                                    <div class="div_link">
                                        <input type="text" disabled id="share_link-' . $id . '" class="share_link" name="share_link" value="' . $share_link . '">
                                        <input type="hidden" disabled id="share_link_hidden" class="share_link_hidden" name="share_link_hidden" value="' . $share_link . '">
                                        <input type="hidden" disabled id="share_link_n_slider" class="share_link_nslider" name="share_link_n_slider" value="' . $n_slider . '">
                                    </div>
                                    <div class="div_btn" onclick="copyToClipboard(this)">
                                        <button class="share_link_button"><i class="fa-regular fa-clone copy_icon"></i></button>
                                    </div>
                                </div>
                                <div class="div_copied">
                                    <span id="copied-'.$id.'" class="copy_span"></span>
                                </div>';
                                // END SHARE INPUT & BUTTON
                            $output .= 
                            '</div>';
                            // END SHARE LINK
                        $output .=
                        '</div>';
                        // END SHARE CONTENT
                    }
                $output .= 
            '</div> <!-- fermeture div sharing content -->
        </div> <!-- fermeture grande div sharing -->';
        // END DIV SHARE

        $output .= '</div>';
    
    $output .= '</div>'; // fermeture grande modale
    // END MODAL #modal01 .img-modal

    return $output;
}

/**
 * @param WP_Query $query
 */
// Works, if go on http://localhost/elfee/galerie/hound-gcff0e760a_1280.jpg/ -> not 404 but on galerie page
// autorise la réécriture de cette forme d'url, empêche la 404
// Attention, ne pas oublier de recharger les permalinks !!!
function capitaine_rewrite_url() {
    // $page_name = '';
    $page_name = get_query_var('pagename');
    // if(is_page('chroniques')):
    //     $page_name = 'chroniques';
    // elseif(is_page('chaos')):
    //     $page_name = 'chaos';
    // endif;
    add_rewrite_tag( '%' . $page_name . '%' ,'([^&]+)' );
    add_rewrite_tag( '%photoname%' ,'([^&]+)' );
    add_rewrite_tag( '%n_slider%' ,'([^&]+)' );
    add_rewrite_rule(
      '([^/]+)/([^/]+)/([^/]+)',
      'index.php?pagename=$matches[1]&photoname=$matches[2]&n_slider=$matches[3]',
    //   'index.php?pagename=galerie&photoname=$matches[1]',
      'top'
    );
}
add_action( 'init', 'capitaine_rewrite_url' );

// Adds 'photoname' and 'n_slider' to query vars
// pour chaque image
// pour pouvoir les récupérer ensuite dans l'url et afficher le bon slide
function montheme_query_vars($params) {
    // si je n'ajoute photoname, pre_get_post -> get_query_var renvoie vide
    $params[] = 'photoname';
    $params[] = 'n_slider';
    // }
    // echo '<pre>';
    // var_dump($params);
    // debug($params);
    // echo '</pre>';
    // die;
    return $params;
}
add_action('query_vars', 'montheme_query_vars');

// renvoie un nombre positif ou 0 selon si la query var 'n_slider' est renseignée ou vide
// permet d'afficher le bon chiffre dans le current slide, donc de récupérer la bonne valeur dans currentSlide afin d'afficher la bonne image quand lien pointe vers une image spécifiquement et que la fenêtre s'ouvre sur sur cette image mais dans le slider
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

    echo $number_of_likes;

    die();
    return true;
}
// Résultat = aucun doublon ! Une seule ligne par image !
add_action('wp_ajax_actionFunction', 'actionFunction'); // Call when user logged in
add_action('wp_ajax_nopriv_actionFunction', 'actionFunction'); // Call when user in not logged in