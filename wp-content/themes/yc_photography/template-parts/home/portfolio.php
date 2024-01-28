<?php
/**
 * Displays the portfolio template part on front-page
 */
?>

<section id="portfolio">
    <h1>portfolio</h1>
    <?php
    // debug(get_post_meta(get_the_ID(), 'custom_repeater_item', true));
    $get_custom_repeater_metas = get_post_meta(get_the_ID(), 'custom_repeater_item', true);
   
    ?>
    <nav style="width: 100%;">
        <ul class="ul_portfolio_nav">
            <!-- id -->
            <?php
            foreach($get_custom_repeater_metas as $get_custom_repeater_meta):
                // debug($get_custom_repeater_meta['item2']);
            ?>
            <li id="portfolio1" class="li_portfolio_nav">
                <!-- href = page galerie -->
                <!-- <a class="a_portfolio" href="chronicles.php"> -->
                <a class="a_portfolio" href="<?php echo get_post_meta(get_the_ID(), 'yc_portfolio_select', true); ?>.php">
                    <!-- Champ pour l'image = uploader -->
                    <!-- <img src="<?php //echo get_template_directory_uri() ?>/assets/img/chronicles.jpg" alt="" class="img_portfolio"> -->
                    <!-- <img src="<?php echo get_post_meta(get_the_ID(), 'yc_portfolio_image', true); ?>" alt="" class="img_portfolio"> -->
                    <img src="<?php echo $get_custom_repeater_meta['item1']; ?>" alt="" class="img_portfolio">
                    <!-- Champ nom de la page = text -->
                    <!-- <span class="span_portfolio"><?php echo get_post_meta(get_the_ID(), 'yc_portfolio_select', true); ?></span> -->
                    <span class="span_portfolio"><?php echo $get_custom_repeater_meta['item2']; ?></span>
                    <!-- Même champ qu'au dessus = nom de la page HOVER -->
                    <p class="p_portfolio_hover"><?php echo $get_custom_repeater_meta['item2']; ?></p>
                </a>
            </li>
            <?php
            endforeach;
            ?>
            <!--  -->
            <!-- <li id="portfolio2" class="li_portfolio_nav">
                <a class="a_portfolio" href="#">
                    <img src="<?php echo get_template_directory_uri() ?>/assets/img/chaos.jpg" alt="" class="img_portfolio">
                    <span class="span_portfolio">chaos</span>
                    <p class="p_portfolio_hover">chaos</p>
                </a>
            </li> -->
            <!--  -->
            <!-- <li id="portfolio3" class="li_portfolio_nav">
                <a class="a_portfolio" href="#">
                    <img src="<?php echo get_template_directory_uri() ?>/assets/img/graphic_city.jpg" alt="" class="img_portfolio">
                    <span class="span_portfolio" style="text-align: left">cité graphique</span>
                    <p class="p_portfolio_hover">cité graphique</p>
                </a>
            </li> -->
            <!--  -->
            <!-- <li id="portfolio4" class="li_portfolio_nav">
                <a class="a_portfolio" href="#">
                    <img src="<?php echo get_template_directory_uri() ?>/assets/img/intra-muros.jpg" alt="" class="img_portfolio">
                    <span class="span_portfolio">intra-muros</span>
                    <p class="p_portfolio_hover">intra-muros</p>
                </a>
            </li> -->
            <!--  -->
            <!-- <li id="portfolio5" class="li_portfolio_nav">
                <a class="a_portfolio" href="#">
                    <img src="<?php echo get_template_directory_uri() ?>/assets/img/beyond_the_walls.jpg" alt="" class="img_portfolio">
                    <span class="span_portfolio">au-delà des murs</span>
                    <p class="p_portfolio_hover">au-delà des murs</p>
                </a>
            </li> -->
            <!--  -->
            <!-- <li id="portfolio6" class="li_portfolio_nav">
                <a class="a_portfolio" href="#">
                    <img src="<?php echo get_template_directory_uri() ?>/assets/img/walk_on_the_wild_side.jpg" alt="" class="img_portfolio">
                    <span class="span_portfolio">walk on the wild side</span>
                    <p class="p_portfolio_hover">walk on the wild side</p>
                </a>
            </li> -->
        </ul>
    </nav>
</section>