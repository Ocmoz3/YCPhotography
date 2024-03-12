<?php
/**
 * Defines what can the theme supports
 */

function yc_photography_supports() {
    // Title in the tab
    add_theme_support('title-tag');
    // Active customize logo
    add_theme_support('custom-logo');
    // Active customize header (color, image)
    // add_theme_support('custom-header');
    // Thumbnails
    add_theme_support('post-thumbnails');
    // Gallery
    add_theme_support( 'html5', [ 'gallery' ] );
};
add_action('after_setup_theme', 'yc_photography_supports');