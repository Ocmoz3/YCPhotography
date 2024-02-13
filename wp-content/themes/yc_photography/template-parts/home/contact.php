<?php
/**
 * Displays the contact template part on front-page
 */

$contact_title = get_post_meta(get_the_ID(), 'yc_contact_title', true);
$contact_form = get_post_meta(get_the_ID(), 'yc_contact_form', true);
?>

<section id="contact">
    <div class="div_around_contact">
        <h1><?php echo esc_html($contact_title); ?></h1>
        <?php
        echo do_shortcode(wp_kses_post($contact_form));
        // include('svg/insta-svg.php');
        dynamic_sidebar('social-network-widget');
        ?>
    </div>
</section>