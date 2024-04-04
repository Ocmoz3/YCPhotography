<?php
/**
 * Displays the image banner template part on front-page
 */

$img_src = get_post_meta(get_the_ID(), 'yc_frontpage_image', true);
$id = attachment_url_to_postid($img_src);

if(!empty($img_src)):
?>

    <section id="home" class="site_max_width">
        <picture>
            <?php 
            echo yc_photography_get_src_tags($img_src, $id);
            ?>
            <img src="<?php echo esc_url($img_src); ?>" alt="<?php echo esc_attr(yc_photography_get_file_name($img_src)); ?>" decoding="async" loading="lazy">
        </picture>
    </section>

<?php
endif;