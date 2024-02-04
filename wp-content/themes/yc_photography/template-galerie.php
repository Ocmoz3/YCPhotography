<?php
/**
* Template Name: Page Galerie
 */

get_header();
?>

<!-- TEMPLATE -->
<?php
echo get_the_title(get_the_ID());
echo '<div style="border: 5px solid red;">' . get_query_var('pagename') . '</div>';
// debug(get_queried_object());
add_theme_support( 'html5', [ 'gallery' ] );
if ( $gallery = get_post_gallery( get_the_ID(), false ) ) :
    echo do_shortcode(get_the_content(get_the_ID()));
endif;
?>

<?php
get_footer();