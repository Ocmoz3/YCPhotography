<?php
/**
 * Displays the image banner template part on front-page
 */
?>

<div id="home" class="site_max_width">
    <img src="<?php echo  get_post_meta(get_the_ID(), 'yc_frontpage_image', true); ?>" alt="">
</div>