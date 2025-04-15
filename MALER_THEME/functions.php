<?php
/**
 * Theme Functions
 * 
 * Enthält alle wichtigen Funktionen für das Theme
 * wie Theme-Setup, Menüs, Widgets und Customizer-Optionen
 * 
 * @package MALER_THEME
 * @version 1.1.0
 */

if (!defined('ABSPATH')) {
    exit; // Verhindert direkten Zugriff auf diese Datei
}

/**
 * Theme-Konstanten definieren
 * Verbessert Lesbarkeit und Wartbarkeit
 */
define('MALER_THEME_VERSION', '1.1.0');
define('MALER_THEME_DIR', get_template_directory());
define('MALER_THEME_URI', get_template_directory_uri());

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
        'style',
        'script',
    ));

    // Unterstützung für benutzerdefiniertes Logo
    add_theme_support('custom-logo', array(
        'height'      => 216,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    
    // Unterstützung für Selective Refresh Widgets
    add_theme_support('customize-selective-refresh-widgets');
    
    // Unterstützung für den Block-Editor
    add_theme_support('editor-styles');
    add_theme_support('responsive-embeds');
    add_theme_support('wp-block-styles');
}
add_action('after_setup_theme', 'maler_theme_setup');

/**
 * Menüs registrieren
 * 
 * Registriert die Navigationsmenüs für das Theme
 */
function maler_register_menus() {
    register_nav_menus(array(
        'primary' => esc_html__('Hauptmenü', 'maler-theme'),
        'mobile'  => esc_html__('Mobile Menü', 'maler-theme'),
        'footer'  => esc_html__('Footer-Menü', 'maler-theme'),
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
        'name'          => esc_html__('Haupt-Sidebar', 'maler-theme'),
        'id'            => 'sidebar-1',
        'description'   => esc_html__('Widgets in diesem Bereich werden in der Haupt-Sidebar angezeigt.', 'maler-theme'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));

    // Footer-Widget-Bereich
    register_sidebar(array(
        'name'          => esc_html__('Footer Widgets', 'maler-theme'),
        'id'            => 'footer-1',
        'description'   => esc_html__('Widgets in diesem Bereich werden im Footer angezeigt.', 'maler-theme'),
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
 * Verbesserte Methode nach Best-Practices
 */
function maler_scripts() {
    // Fonts preconnect für Performance-Optimierung
    add_filter('style_loader_tag', 'maler_add_preconnect', 10, 4);
    
    // Theme-Stylesheet
    wp_enqueue_style('maler-theme-style', get_stylesheet_uri(), array(), MALER_THEME_VERSION);
    
    // FontAwesome (optional) für Icons
    // wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css', array(), '5.15.4');
    
    // Navigation Script - mit defer-Attribut
    wp_enqueue_script('maler-navigation', MALER_THEME_URI . '/assets/js/navigation.js', array(), MALER_THEME_VERSION, true);
    wp_script_add_data('maler-navigation', 'defer', true);
    
    // Für Browser, die defer noch nicht unterstützen
    wp_add_inline_script('maler-navigation', '', 'before');
    
    // Theme allgemeine Funktionen
    wp_enqueue_script('maler-theme-script', MALER_THEME_URI . '/assets/js/theme.js', array(), MALER_THEME_VERSION, true);
    
    // Inline CSS für dynamische Hintergrundbilder - nur wenn nötig
    $inline_css = "
        .hero-section::after {
            background-image: url('" . MALER_THEME_URI . "/assets/images/hero_bg_right.png');
        }
        .about-section {
            background-image: url('" . MALER_THEME_URI . "/assets/images/About_section_bg.png');
        }
        .contact-section {
            background-image: url('" . MALER_THEME_URI . "/assets/images/contakt_section_bg.png');
        }
    ";
    wp_add_inline_style('maler-theme-style', $inline_css);
}
add_action('wp_enqueue_scripts', 'maler_scripts');

/**
 * Fügt preconnect für Google Fonts hinzu
 *
 * @param string $html    Der Link-Tag für das geladene Stylesheet.
 * @param string $handle  Der registrierte Handle für das Stylesheet.
 * @param string $href    Die URL des Stylesheets.
 * @param string $media   Das Media-Attribut.
 * @return string         Der modifizierte Link-Tag.
 */
function maler_add_preconnect($html, $handle, $href, $media) {
    // Preconnect für Google Fonts
    if ($handle === 'maler-theme-style') {
        $html = '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n" .
                '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n" .
                $html;
    }
    return $html;
}

/**
 * Bereinigt WordPress-Header
 * Entfernt unnötige Elemente für bessere Performance
 */
function maler_clean_header() {
    // Entfernt WordPress-Versions-Nummer
    remove_action('wp_head', 'wp_generator');
    
    // Entfernt Windows Live Writer Manifest-Links
    remove_action('wp_head', 'wlwmanifest_link');
    
    // Entfernt RSD-Link
    remove_action('wp_head', 'rsd_link');
    
    // Entfernt Shortlink
    remove_action('wp_head', 'wp_shortlink_wp_head');
    
    // Entfernt Emoji-Skripte (wenn nicht benötigt)
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
}
add_action('after_setup_theme', 'maler_clean_header');

/**
 * Theme-Optionen im Customizer
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer Objekt.
 */
function maler_customize_register($wp_customize) {
    // Füge hier Customizer-Optionen hinzu
    // z.B. Farben, Logos, etc.
    
    // Beispiel: Primarfarbe des Themes
    $wp_customize->add_setting('primary_color', array(
        'default'           => '#2A5154',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'primary_color', array(
        'label'    => esc_html__('Primärfarbe', 'maler-theme'),
        'section'  => 'colors',
        'settings' => 'primary_color',
    )));
}
add_action('customize_register', 'maler_customize_register'); 