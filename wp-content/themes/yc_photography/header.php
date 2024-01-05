<?php
/**
 * The header for the theme
 * 
 * This is the template that displays all of the <head> section and everything up until <main class="container">
 */
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

        <!--  -->
        <!-- <link rel="stylesheet" href="assets/css/galleries/galleries.css">
        <link rel="stylesheet" href="assets/css/galleries/heart-share-buttons.css">
        <link rel="stylesheet" href="assets/css/galleries/minimize-maximize-buttons.css">
        <link rel="stylesheet" href="assets/css/galleries/next-previous-buttons.css">
        <link rel="stylesheet" href="assets/css/galleries/close-button.css">
        <link rel="stylesheet" href="assets/css/footer/footer.css"> -->


        <!-- <title>Yann Cielat - Photographie</title> -->
        <?php wp_head() ?>
    </head>
    <!-- BODY -->
    <body <?php body_class(); ?>>
    <?php 
    if(function_exists('wp_body_open')):
        wp_body_open(); 
    endif;
    ?>
        <main class="container">
            <?php get_template_part('template-parts/header/site_header');