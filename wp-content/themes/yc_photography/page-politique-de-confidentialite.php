<?php
/**
 * The Privacy policy page template
 */

get_header();

$post_slug = get_post_field('post_name', get_post());
$check_content = get_post_field('post_content', get_post());
$the_content = get_the_content();
$the_content = wpautop($the_content);

if(!empty($check_content)):
?>

    <div id="<?php echo $post_slug; ?>" class="legals_page">
        <h1><?php the_title(); ?></h1>
        <?php
        echo $the_content;
        ?>
    </div>

<?php
else:
    // If no content exists for the page, displays the "page in construction" page template.
    get_template_part('template-parts/error');
endif;

get_footer();