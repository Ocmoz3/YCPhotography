<?php
/**
 * Displays the portfolio template part on front-page
 */

$get_custom_repeater_metas = get_post_meta(get_the_ID(), 'custom_repeater_item', true);
$portfolio_title = get_post_meta(get_the_ID(), 'yc_portfolio_title', true);

if(!empty($get_custom_repeater_metas)):
?>

    <section id="portfolio">
        <h1><?php echo esc_html($portfolio_title); ?></h1>
        <?php
        ?>
        <nav class="nav_portfolio">
            <ul class="ul_portfolio_nav">
                <?php
                foreach($get_custom_repeater_metas as $get_custom_repeater_meta):
                    $get_item1 = $get_custom_repeater_meta['item1'];
                    $get_item2 = $get_custom_repeater_meta['item2'];
                    // Transforms the "é" character into an "e" character and spaces into hyphens for href attribute.
                    $href_item2 = yc_photography_turns_into_slug($get_item2);
                ?>
                    <li id="portfolio1" class="li_portfolio_nav">
                        <a class="a_portfolio" href="<?php echo $href_item2; ?>">
                            <img src="<?php echo esc_url($get_item1); ?>" alt="" class="img_portfolio">
                            <span class="span_portfolio"><?php echo esc_html($get_item2); ?></span>
                            <p class="p_portfolio_hover"><?php echo esc_html($get_item2); ?></p>
                        </a>
                    </li>
                <?php
                endforeach;
                ?>
            </ul>
        </nav>
    </section>

<?php
endif;