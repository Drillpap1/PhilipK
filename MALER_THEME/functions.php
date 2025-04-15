<?php
/**
 * Theme Functions
 * 
 * Enthält alle wichtigen Funktionen für das Theme
 * wie Theme-Setup, Menüs, Widgets und Customizer-Optionen
 * 
 * @package MALER_THEME
 */

if (!defined('ABSPATH')) {
    exit; // Verhindert direkten Zugriff auf diese Datei
}

/**
 * Theme-Setup
 * 
 * Registriert Theme-Unterstützung für verschiedene WordPress-Funktionen
 */
function maler_theme_setup() {
    // Unterstützung für automatische Feed-Links
    add_theme_support('automatic-feed-links');

    // Unterstützung für Titel-Tag
    add_theme_support('title-tag');

    // Unterstützung für Beitragsbilder
    add_theme_support('post-thumbnails');

    // Unterstützung für HTML5-Markup
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));

    // Unterstützung für benutzerdefiniertes Logo
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ));
}
add_action('after_setup_theme', 'maler_theme_setup');

/**
 * Menüs registrieren
 * 
 * Registriert die Navigationsmenüs für das Theme
 */
function maler_register_menus() {
    register_nav_menus(array(
        'primary' => __('Hauptmenü', 'maler-theme'),
        'footer'  => __('Footer-Menü', 'maler-theme'),
    ));
}
add_action('init', 'maler_register_menus');

/**
 * Widget-Bereiche registrieren
 * 
 * Registriert die Sidebar- und Footer-Widget-Bereiche
 */
function maler_widgets_init() {
    // Haupt-Sidebar
    register_sidebar(array(
        'name'          => __('Haupt-Sidebar', 'maler-theme'),
        'id'            => 'sidebar-1',
        'description'   => __('Widgets in diesem Bereich werden in der Haupt-Sidebar angezeigt.', 'maler-theme'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));

    // Footer-Widget-Bereich
    register_sidebar(array(
        'name'          => __('Footer Widgets', 'maler-theme'),
        'id'            => 'footer-1',
        'description'   => __('Widgets in diesem Bereich werden im Footer angezeigt.', 'maler-theme'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
}
add_action('widgets_init', 'maler_widgets_init');

/**
 * Skripte und Styles einbinden
 * 
 * Lädt die notwendigen CSS- und JavaScript-Dateien
 */
function maler_scripts() {
    // Theme Stylesheet
    wp_enqueue_style('maler-theme-style', get_stylesheet_uri(), array(), wp_get_theme()->get('Version'));

    // Theme JavaScript
    wp_enqueue_script('maler-theme-script', get_template_directory_uri() . '/js/theme.js', array('jquery'), wp_get_theme()->get('Version'), true);

    // Inline CSS für dynamische Hintergrundbilder
    $inline_css = "
        .hero-section::after {
            background-image: url('" . get_template_directory_uri() . "/assets/images/hero_bg_right.png');
        }
        .about-section {
            background-image: url('" . get_template_directory_uri() . "/assets/images/About_section_bg.png');
        }
        .contact-section {
            background-image: url('" . get_template_directory_uri() . "/assets/images/contakt_section_bg.png');
        }
    ";
    wp_add_inline_style('maler-theme-style', $inline_css);
}
add_action('wp_enqueue_scripts', 'maler_scripts'); 