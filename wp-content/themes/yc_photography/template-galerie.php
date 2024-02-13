<?php
/**
* Template Name: Page Galerie
 */

get_header();
?>

<!-- TEMPLATE -->
<?php
// echo get_the_title(get_the_ID());
if($gallery = get_post_gallery( get_the_ID(), false)) :
    echo do_shortcode(get_the_content(get_the_ID()));
else:
    // If no gallery exists for the page, displays the "page in constrcution" page template.
    get_template_part('template-parts/error');
endif;
?>

<?php
get_footer();