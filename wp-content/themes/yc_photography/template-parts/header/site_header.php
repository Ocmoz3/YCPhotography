<?php
/**
 * Displays the site header
 */
?>

<!-- HEADER -->
<header id="site_header">
    <div class="div_header">
        <!-- NAV -->
        <nav class="site_nav main_nav">
            <ul id="ul_burger" class="site_nav_ul main_ul ul_shadow ul_burger">
                <li class="site_nav_li main_li">
                    <a id="home_link" class="a_nav js-curnav-switch" href="#home">Home</a>
                </li>
                <li class="site_nav_li">
                    <a class="a_nav js-curnav-switch" href="#presentation">présentation</a>
                </li>
                <li class="site_nav_li dropdown">
                    <a class="a_nav dropbtn js-curnav-switch" href="#portfolio">portfolio</a>
                    <ul class="dropdown-content">
                        <li>
                            <a href="chronicles.php" class="a_nav second_level">chroniques</a>
                        </li>
                        <li>
                            <a href="chaos.php" class="a_nav second_level">chaos</a>
                        </li>
                        <li>
                            <a href="graphic_city.php" class="a_nav second_level">cité graphique</a>
                        </li>
                        <li>
                            <a href="intra-muros.php" class="a_nav second_level">intra-muros</a>
                        </li>
                        <li>
                            <a href="beyond_the_walls.php" class="a_nav second_level">au-delà des murs</a>
                        </li>
                        <li>
                            <a href="walk_on_the_wild_style.php" class="a_nav second_level">walk on the wild side</a>
                        </li>
                    </ul>
                </li>
                <li class="site_nav_li"><a class="a_nav js-curnav-switch" href="#exhibitions">expositions</a></li>
                <li class="site_nav_li"><a class="a_nav js-curnav-switch" href="#contact">contact</a></li>
            </ul>
        </nav>
        <a id="link_burger" href="#" title="Menu">
            <span id="burger"></span>
        </a>
    </div>
</header>