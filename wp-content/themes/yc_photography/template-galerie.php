<?php
/**
* Template Name: Page Galerie
 */

get_header();
?>

<!-- TEMPLATE -->
<?php
if($gallery = get_post_gallery(get_the_ID(), false)) :
    // echo do_shortcode(get_the_content(get_the_ID()));
    echo do_shortcode(get_the_content());
else:
    // If no gallery exists for the page, displays the "page in construction" page template.
    get_template_part('template-parts/error');
endif;
?>

<?php
get_footer();