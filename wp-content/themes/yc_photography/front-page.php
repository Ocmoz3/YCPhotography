<?php
/**
 * Front-page template
 */

get_header();

get_template_part('template-parts/home/image_banner'); 

get_template_part('template-parts/home/presentation');

get_template_part('template-parts/home/portfolio');

get_template_part('template-parts/home/exhibitions');

get_template_part('template-parts/home/contact');
?>

<?php
get_footer();