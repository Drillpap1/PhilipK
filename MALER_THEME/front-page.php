<?php
/**
 * Template Name: Front Page
 * 
 * @package MALER_THEME
 */

get_header();
?>

<main id="primary" class="site-main">
    <!-- Hero Section -->
    <section class="hero-section">
        <!-- Linke Hälfte mit Text -->
        <div class="hero-content">
            <div class="hero-text">
                <h1>Qualität in jedem Pinselstrich</h1>
                <p>von ihrem Malermeister aus Bornheim</p>
                <a href="#kontakt" class="cta-button">Projekt starten</a>
            </div>
        </div>
        <!-- Rechte Hälfte mit Bild -->
        <div class="hero-image"></div>
    </section>

    <!-- About Section -->
    <section class="about-section">
        <div class="container">
            <div class="about-content">
                <h2>Über mich</h2>
                <p>Ich bin Philip Krzywinski, Malermeister aus Bornheim, NRW. Mit Leidenschaft für das Handwerk und einem Blick fürs Detail setze ich seit Jahren Projekte um, die durch Qualität, Sauberkeit und Termintreue überzeugen. Ob farbige Akzente im Wohnzimmer, ein frischer Fassadenanstrich oder die Neugestaltung von Büroräumen – ich bringe Farbe in Ihr Projekt.</p>
                <?php if (has_post_thumbnail()) : ?>
                    <div class="about-image">
                        <?php the_post_thumbnail('large'); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services-section">
        <div class="services-grid">
            <div class="service-item">
                <div class="service-header">
                    <div class="service-icon">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/private_wohnräume_icon.png" alt="Private Wohnräume">
                    </div>
                    <h3 class="service-title">Private Wohnräume</h3>
                </div>
                <p>Ob Altbau, Wohnung oder Einfamilienhaus – hier sorgt der Malermeister für stilvolle Innenanstriche, moderne Tapeten, kreative Wandgestaltung, saubere Lackierarbeiten und die fachgerechte Beseitigung von Schimmel.</p>
            </div>

            <div class="service-item">
                <div class="service-header">
                    <div class="service-icon">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/kommerzielle_gebäude_icon.png" alt="Kommerzielle Gebäude">
                    </div>
                    <h3 class="service-title">Kommerzielle Gebäude</h3>
                </div>
                <p>Büro, Restaurant oder Ladenfläche – in gewerblichen Objekten bringt der Malermeister nicht nur Farbe ins Spiel, sondern auch funktionale und repräsentative Gestaltung, langlebige Beschichtungen und akustische Lösungen.</p>
            </div>

            <div class="service-item">
                <div class="service-header">
                    <div class="service-icon">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/fassaden_icon.png" alt="Fassaden & Außenbereiche">
                    </div>
                    <h3 class="service-title">Fassaden & Außenbereiche</h3>
                </div>
                <p>Von der Wohnanlage bis zum Firmengebäude: Im Außenbereich übernimmt der Malermeister Fassadenanstriche, Wärmedämmung, Betonschutz sowie Holzpflege – und beseitigt auch unerwünschte Graffitis zuverlässig.</p>
            </div>
        </div>
    </section>

    <!-- Painter Image Section -->
    <section class="painter-section">
        <div class="painter-container">
            <div class="painter-image">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/maler_freigestellt.png" alt="Ihr Malermeister">
            </div>
            <div class="painter-content">
                <h2>Ihr Experte für hochwertige Malerarbeiten</h2>
                <p>Mit jahrelanger Erfahrung und einem Auge fürs Detail sorge ich für perfekte Ergebnisse bei allen Ihren Malerprojekten. Von der klassischen Wandgestaltung bis hin zu speziellen Techniken - Qualität und Kundenzufriedenheit stehen bei mir an erster Stelle.</p>
                <p>Profitieren Sie von meiner Expertise und lassen Sie uns gemeinsam Ihre Räume in neuem Glanz erstrahlen.</p>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section">
        <div class="container">
            <div class="contact-content">
                <div class="contact-form">
                    <?php echo do_shortcode('[contact-form-7 id="FORM_ID" title="Kontaktformular"]'); ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Google Reviews Section -->
    <section class="google-reviews-section">
        <div class="google-reviews-container">
            <div class="google-reviews-grid">
                <!-- Review Card 1 -->
                <div class="review-card">
                    <div class="review-header">
                        <div class="reviewer-info">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Appartment.png" alt="Familie Berger" class="reviewer-image">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/google_logo.png" alt="Google Logo" class="google-logo">
                        </div>
                    </div>
                    <div class="review-content">
                        „Absolut empfehlenswert! Herr Krzywinski hat unser Wohnzimmer nicht nur gestrichen, sondern mit einer tollen Wandgestaltung in Szene gesetzt. Alles verlief sauber, pünktlich und mit viel Liebe zum Detail. So stellt man sich Handwerk heute vor!"
                    </div>
                    <div class="reviewer-name">Familie Berger, Bornheim</div>
                    <div class="review-rating">★★★★★</div>
                </div>

                <!-- Review Card 2 -->
                <div class="review-card">
                    <div class="review-header">
                        <div class="reviewer-info">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Appartment.png" alt="Inhaber Werbeagentur Lumen GmbH" class="reviewer-image">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/google_logo.png" alt="Google Logo" class="google-logo">
                        </div>
                    </div>
                    <div class="review-content">
                        „Wir haben unsere komplette Bürofläche von Herrn Krzywinski und seinem Team renovieren lassen – von der Farbberatung bis zur Ausführung alles top! Besonders beeindruckt hat uns die schnelle Umsetzung bei gleichbleibend hoher Qualität."
                    </div>
                    <div class="reviewer-name">Inhaber Werbeagentur Lumen GmbH</div>
                    <div class="review-rating">★★★★★</div>
                </div>

                <!-- Review Card 3 -->
                <div class="review-card">
                    <div class="review-header">
                        <div class="reviewer-info">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Appartment.png" alt="Sabine K." class="reviewer-image">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/google_logo.png" alt="Google Logo" class="google-logo">
                        </div>
                    </div>
                    <div class="review-content">
                        „Ich bin begeistert vom Ergebnis! Die Fassade meines Hauses sieht aus wie neu. Herr Krzywinski hat nicht nur sauber gearbeitet, sondern uns auch super beraten, welche Farben am besten zur Umgebung passen."
                    </div>
                    <div class="reviewer-name">Sabine K., Wesseling</div>
                    <div class="review-rating">★★★★★</div>
                </div>

                <!-- Review Card 4 -->
                <div class="review-card">
                    <div class="review-header">
                        <div class="reviewer-info">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Appartment.png" alt="Tamina R." class="reviewer-image">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/google_logo.png" alt="Google Logo" class="google-logo">
                        </div>
                    </div>
                    <div class="review-content">
                        „Sehr freundlich, zuverlässig und extrem professionell. Ich habe Herrn Krzywinski für Lackierarbeiten an Türen und Zargen beauftragt – sieht alles aus wie frisch vom Werk. Preis-Leistung stimmt absolut!"
                    </div>
                    <div class="reviewer-name">Tamina R., Brühl</div>
                    <div class="review-rating">★★★★★</div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php
get_footer();
?> 