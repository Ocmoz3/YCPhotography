<?php
/**
 * Displays the contact template part on front-page
 */
?>

<section id="contact" style="background-color: black; width: 100%; max-width: unset; position: relative;">
    <h1 style="color: white;"><?php echo get_post_meta(get_the_ID(), 'yc_contact_title', true); ?></h1>
    <?php
    echo do_shortcode(get_post_meta(get_the_ID(), 'yc_contact_form', true));
    // include('svg/insta-svg.php');
    ?>
</section>