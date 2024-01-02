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
        <!-- Connexion Google fonts, à faire dans assets avec wp_enqueue_style -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Imbue:opsz,wght@10..100,100&family=Josefin+Sans:wght@100;200;300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&family=Raleway:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
        <!-- Connexion Font Awesome, à faire dans assets avec wp_enqueue_style -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <!-- Connexion stylesheets, à faire dans assets avec wp_enqueue_style -->
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="assets/css/header/header.css">
        <link rel="stylesheet" href="assets/css/header/header_nav.css">
        <link rel="stylesheet" href="assets/css/home/presentation/presentation.css">
        <link rel="stylesheet" href="assets/css/home/portfolio/portfolio.css">
        <link rel="stylesheet" href="assets/css/home/expositions/expositions.css">
        <link rel="stylesheet" href="assets/css/home/contact/contact.css">
        <link rel="stylesheet" href="assets/css/galleries/galleries.css">
        <link rel="stylesheet" href="assets/css/galleries/heart-share-buttons.css">
        <link rel="stylesheet" href="assets/css/galleries/minimize-maximize-buttons.css">
        <link rel="stylesheet" href="assets/css/galleries/next-previous-buttons.css">
        <link rel="stylesheet" href="assets/css/galleries/close-button.css">
        <link rel="stylesheet" href="assets/css/footer/footer.css">
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