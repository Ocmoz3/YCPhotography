<?php
/**
 * Functions for menus management
 */

/**
 * Registers navigation menus.
 */
function yc_photography_register_menus() {
    // add_theme_support('menus');
    register_nav_menus([
        'header' => 'Menu header',
        'portfolio_nav' => 'Menu portfolio',
        'footer_legals' => 'Liens légaux'
    ]);
}
add_action('after_setup_theme', 'yc_photography_register_menus');

/**
 * Filters the CSS class(es) applied to a menu list element.
 * Adds 'dropdown-content' class to the sub-menu ul tag.
 * 
 * @param string|array $classes Array of the CSS classes that are applied to the menu <ul>.element.
 * @param stdClass     $args    An object of wp_nav_menu() arguments.
 * 
 * @return string|array
 */
function yc_photography_submenu_classes($classes, $args)
{
    if($args->theme_location === 'header'):
        $classes[] = 'dropdown-content';
    endif;
    return $classes;
}
add_action('nav_menu_submenu_css_class', 'yc_photography_submenu_classes', 10, 3);

/**
 * Filters the CSS classes applied to a menu item’s list item element.
 * Manages menu li tag classes.
 * 
 * @param string|array $classes   Array of the CSS classes that are applied to the menu item's <li> element.
 * @param WP_Post      $menu_item The current menu item object.
 * @param stdClass     $args      An object of wp_nav_menu() arguments.
 * 
 * @return string|array
 */
function yc_photography_menu_item_classes($classes, $menu_item, $args) {
    if($args->theme_location === 'header') {
        // Adds class 'dropdown' to all first-level <li>
        if($menu_item->menu_item_parent == 0) {
            $classes[] = 'site_nav_li';
        }
    foreach ($classes as $class) {
        // Adds class 'dropdown' to <li> which have sub-menu
        if($class === 'menu-item-has-children') {
            $classes[] = 'dropdown';
        }
    }
    }
    // Adds class 'foot_hover' to footer menus in order to manage color hover
    if($args->theme_location === 'footer_legals'):
        $classes[] = 'foot_hover';
    endif;
    return $classes;
}
add_action('nav_menu_css_class', 'yc_photography_menu_item_classes', 10, 3);

/**
 * Filters the HTML attributes applied to a menu item’s anchor element.
 * Adds 'class' attribute to <a> navigation tags.
 * 
 * @param array    $atts      The HTML attributes applied to the menu item's <a> element, empty strings are ignored.
 * @param WP_Post  $menu_item The current menu item object.
 * @param stdClass $args      An object of wp_nav_menu() arguments.
 * 
 * @return array
 */
function yc_photography_menu_link_class($atts, $menu_item, $args) {
    // In case user is not on front-page, adds home path before the anchor
    // Only on first-level links
    if($menu_item->menu_item_parent == 0 && !is_front_page()):
        $atts['href'] = home_url('/') . $atts['href'];
    endif;
    // Gets menu-items classes
    $classes = $menu_item->classes;
    if(!empty($args->theme_location) && $args->theme_location === 'header'):
        // Adds class 'a_nav' to all links menu
        $atts['class'] = 'a_nav';
        // Adds class 'js-curnav-switch' to all first-level links menu
        if($menu_item->menu_item_parent == 0) {
            $atts['class'] .= ' js-curnav-switch';
        }
        // Adds class 'second_level' to links in submenu
        if($menu_item->menu_item_parent != 0) {
            $atts['class'] .= ' second_level';
        }
        foreach ($classes as $class) {
            // Adds class 'is-current' according to the current page
            // 'current-menu-parent' class is defined to submenu items which parent menu item is this of the current page
            if($class === 'current-menu-parent') {
                $atts['class'] .= ' is-current';
            }
            // Adds class 'dropbtn' to link with a submenu
            if($class === 'menu-item-has-children') {
                $atts['class'] .= ' dropbtn';
            }
        }
    endif;
    return $atts;
}
add_filter('nav_menu_link_attributes', 'yc_photography_menu_link_class', 10, 3);