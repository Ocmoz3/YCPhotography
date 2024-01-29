<?php
/**
 * Displays the portfolio template part on front-page
 */
?>

<section id="portfolio">
    <h1><?php echo get_post_meta(get_the_ID(), 'yc_portfolio_title', true); ?></h1>
    <?php
    $get_custom_repeater_metas = get_post_meta(get_the_ID(), 'custom_repeater_item', true);
   
    ?>
    <nav style="width: 100%;">
        <ul class="ul_portfolio_nav">
            <?php
            foreach($get_custom_repeater_metas as $get_custom_repeater_meta):
            ?>
                <li id="portfolio1" class="li_portfolio_nav">
                    <a class="a_portfolio" href="<?php echo $get_custom_repeater_meta['item2']; ?>.php">
                        <img src="<?php echo $get_custom_repeater_meta['item1']; ?>" alt="" class="img_portfolio">
                        <span class="span_portfolio"><?php echo $get_custom_repeater_meta['item2']; ?></span>
                        <p class="p_portfolio_hover"><?php echo $get_custom_repeater_meta['item2']; ?></p>
                    </a>
                </li>
            <?php
            endforeach;
            ?>
        </ul>
    </nav>
</section>