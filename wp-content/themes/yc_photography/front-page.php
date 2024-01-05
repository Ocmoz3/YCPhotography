<?php
/**
 * Front-page template
 */

get_header();
?>
<div id="home" class="site_max_width">
    <img src="<?php echo get_template_directory_uri() ?>/assets/img/Photo_Yann_par_Mickaël_Liblin_edited.jpg" alt="">
</div>
<?php
// include('template-parts/home/presentation.php');
get_template_part('template-parts/home/presentation');

// include('template-parts/home/portfolio.php');
get_template_part('template-parts/home/portfolio');

// include('template-parts/home/expositions.php');
get_template_part('template-parts/home/exhibitions');

// $front_page_id = get_option('page_on_front');
// $front_page_id = get_the_ID();
// debug($front_page_id);
// debug(get_post_meta($front_page_id, 'yc_long', true));
// debug(get_post_meta($front_page_id)); // récupère toutes les metas de la page
// echo '<div style="border: 5px solid orange;">' . get_post_meta($front_page_id, 'yc_long', true) . '</div>';
// echo get_post_meta($front_page_id, 'yc_long', true);

// include('template-parts/home/contact.php');
get_template_part('template-parts/home/contact');
?>

<?php
get_footer();