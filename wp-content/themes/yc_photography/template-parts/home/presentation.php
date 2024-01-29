<?php
/**
 * Displays the presentation template part on front-page
 */
?>

<section id="presentation">
    <h1><?php echo  get_post_meta(get_the_ID(), 'yc_presentation_title', true); ?></h1>
    <div class="div_presentation">
        <?php echo  get_post_meta(get_the_ID(), 'yc_presentation_text', true); ?>
    </div>
</section>