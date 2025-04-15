<?php
/**
 * Header Template
 * 
 * Enthält die grundlegende HTML-Struktur des Headers
 * und wichtige Meta-Informationen für die Website
 * 
 * @package MALER_THEME
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <!-- Zeichensatz-Deklaration -->
    <meta charset="<?php bloginfo('charset'); ?>">
    <!-- Viewport für responsive Darstellung -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- WordPress Header Hooks -->
    <?php wp_head(); ?>
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/navigation.js"></script>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
    <!-- Header-Bereich -->
    <header id="masthead" class="site-header">
        <div class="container">
            <!-- Logo oder Site-Title -->
            <div class="site-branding">
                <?php
                if (has_custom_logo()) :
                    the_custom_logo();
                else :
                ?>
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="custom-logo-link">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/header_logo.png" alt="Malermeister Philip Krzywinski Logo" class="custom-logo">
                    </a>
                <?php endif; ?>
            </div>

            <!-- Burger Menu Button -->
            <button class="menu-toggle" aria-controls="mobile-menu" aria-expanded="false">
                <span class="burger-line"></span>
                <span class="burger-line"></span>
                <span class="burger-line"></span>
            </button>

            <!-- Fullscreen Mobile Menu -->
            <div class="mobile-menu-overlay">
                <button class="close-menu">
                    <span class="close-line"></span>
                    <span class="close-line"></span>
                </button>
                <nav class="mobile-navigation">
                    <ul class="mobile-menu">
                        <li><a href="<?php echo esc_url(home_url('/')); ?>">HOME</a></li>
                        <li><a href="<?php echo esc_url(home_url('/ueber-mich/')); ?>">ÜBER MICH</a></li>
                        <li><a href="<?php echo esc_url(home_url('/leistungen/')); ?>">LEISTUNGEN</a></li>
                        <li><a href="<?php echo esc_url(home_url('/kontakt/')); ?>">KONTAKT</a></li>
                    </ul>
                </nav>
            </div>

            <!-- Desktop Navigation -->
            <nav id="site-navigation" class="main-navigation">
                <ul class="nav-menu">
                    <li><a href="<?php echo esc_url(home_url('/')); ?>">HOME</a></li>
                    <li><a href="<?php echo esc_url(home_url('/ueber-mich/')); ?>">ÜBER MICH</a></li>
                    <li><a href="<?php echo esc_url(home_url('/leistungen/')); ?>">LEISTUNGEN</a></li>
                    <li><a href="<?php echo esc_url(home_url('/kontakt/')); ?>">KONTAKT</a></li>
                </ul>
            </nav>

            <!-- Contact Box -->
            <div class="header-contact">
                <a href="tel:+123456789" class="contact-icon">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/phone_icon.png" alt="Telefon">
                </a>
                <a href="https://instagram.com/" target="_blank" class="contact-icon">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/instagram_icon.png" alt="Instagram">
                </a>
            </div>
        </div>
    </header> 