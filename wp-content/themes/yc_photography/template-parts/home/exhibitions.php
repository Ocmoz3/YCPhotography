<?php
/**
 * Displays the exhibitions template part on front-page
 */

$exhibitions_title = get_post_meta(get_the_ID(), 'yc_exhibitions_title', true);
$exhibitions_list = get_post_meta(get_the_ID(), 'yc_exhibitions_list', true);
?>

<section id="exhibitions">
    <h1><?php echo esc_html($exhibitions_title); ?></h1>
    <div class="exhibitions_container">
        <?php 
        echo wp_kses_post($exhibitions_list);
        ?>
    </div>
</section>