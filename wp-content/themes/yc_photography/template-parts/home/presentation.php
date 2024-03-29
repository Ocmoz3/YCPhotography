<?php
/**
 * Displays the presentation template part on front-page
 */

$presentation_title = get_post_meta(get_the_ID(), 'yc_presentation_title', true);
$presentation_test = get_post_meta(get_the_ID(), 'yc_presentation_text', true);

if(!empty($presentation_test)):
?>

    <section id="presentation">
        <h1><?php echo esc_html($presentation_title); ?></h1>
        <div id="yoast_home_paragraph" class="div_presentation">
            <?php echo wpautop(wp_kses_post($presentation_test)); ?>
        </div>
    </section>

<?php
endif;