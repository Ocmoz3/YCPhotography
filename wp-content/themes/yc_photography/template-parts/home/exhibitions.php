<?php
/**
 * Displays the exhibitions template part on front-page
 */
?>

<section id="exhibitions">
    <h1><?php echo  get_post_meta(get_the_ID(), 'yc_exhibitions_title', true); ?></h1>
    <div class="exhibitions_container">
        <?php 
        echo get_post_meta(get_the_ID(), 'yc_exhibitions_list', true);
        ?>
    </div>
</section>