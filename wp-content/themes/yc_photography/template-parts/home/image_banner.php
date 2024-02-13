<?php
/**
 * Displays the image banner template part on front-page
 */

$img_src = get_post_meta(get_the_ID(), 'yc_frontpage_image', true);
?>

<div id="home" class="site_max_width">
    <img src="<?php echo esc_url($img_src); ?>" alt="">
</div>