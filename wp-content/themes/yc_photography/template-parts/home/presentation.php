<?php
/**
 * Displays the presentation template part on front-page
 */

$presentation_title = get_post_meta(get_the_ID(), 'yc_presentation_title', true);
$presentation_test = get_post_meta(get_the_ID(), 'yc_presentation_text', true);
?>

<section id="presentation">
    <h1><?php echo esc_html($presentation_title); ?></h1>
    <div class="div_presentation">
        <?php echo wp_kses_post($presentation_test); ?>
    </div>
</section>