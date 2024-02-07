<?php
/**
 * Displays the site navigation in the header
 */
?>

<!-- NAV -->
<div class="div_header">
    <?php
    wp_nav_menu([
        'theme_location'  => 'header',
        'menu_class'      => 'ul_nav site_nav_ul main_ul ul_shadow ul_burger',
        'menu_id'         => 'ul_burger',
        'container_class' => 'site_nav main_nav',
        'container'       => 'nav',
    ]);
    ?>
    <div id="div_link_burger" class="div_link_burger">
        <a id="link_burger" href="#" title="Menu">
            <span id="burger"></span>
        </a>
    </div>
</div>