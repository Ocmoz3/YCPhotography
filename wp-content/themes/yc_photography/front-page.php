<?php
/**
 * Front-page template
 */

get_header();

get_template_part('template-parts/home/image_banner'); 

// include('template-parts/home/presentation.php');
get_template_part('template-parts/home/presentation');

// include('template-parts/home/portfolio.php');
get_template_part('template-parts/home/portfolio');

// include('template-parts/home/expositions.php');
get_template_part('template-parts/home/exhibitions');


// include('template-parts/home/contact.php');
get_template_part('template-parts/home/contact');
?>

<?php
get_footer();