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
            <div class="google-reviews-header">
                <h2>Das sagen unsere Kunden</h2>
            </div>
            <div class="google-reviews-grid">
                <!-- Review Card 1 -->
                <div class="review-card">
                    <div class="review-header">
                        <div class="reviewer-image">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/reviewer1.jpg" alt="Reviewer 1">
                        </div>
                        <div class="reviewer-info">
                            <div class="reviewer-name">Max Mustermann</div>
                            <div class="review-date">vor 2 Wochen</div>
                        </div>
                    </div>
                    <div class="review-rating">★★★★★</div>
                    <div class="review-content">
                        "Hervorragende Arbeit! Sehr professionell und sauber gearbeitet. Termine wurden eingehalten und das Ergebnis ist perfekt."
                    </div>
                    <div class="google-badge">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/google-icon.svg" alt="Google">
                        <span>Google Review</span>
                    </div>
                </div>

                <!-- Review Card 2 -->
                <div class="review-card">
                    <div class="review-header">
                        <div class="reviewer-image">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/reviewer2.jpg" alt="Reviewer 2">
                        </div>
                        <div class="reviewer-info">
                            <div class="reviewer-name">Anna Schmidt</div>
                            <div class="review-date">vor 1 Monat</div>
                        </div>
                    </div>
                    <div class="review-rating">★★★★★</div>
                    <div class="review-content">
                        "Sehr zufrieden mit der Fassadenrenovierung. Faire Preise und top Beratung. Gerne wieder!"
                    </div>
                    <div class="google-badge">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/google-icon.svg" alt="Google">
                        <span>Google Review</span>
                    </div>
                </div>

                <!-- Review Card 3 -->
                <div class="review-card">
                    <div class="review-header">
                        <div class="reviewer-image">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/reviewer3.jpg" alt="Reviewer 3">
                        </div>
                        <div class="reviewer-info">
                            <div class="reviewer-name">Peter Weber</div>
                            <div class="review-date">vor 2 Monaten</div>
                        </div>
                    </div>
                    <div class="review-rating">★★★★★</div>
                    <div class="review-content">
                        "Kompetente Beratung und erstklassige Ausführung. Das Team war pünktlich und sehr freundlich."
                    </div>
                    <div class="google-badge">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/google-icon.svg" alt="Google">
                        <span>Google Review</span>
                    </div>
                </div>

                <!-- Review Card 4 -->
                <div class="review-card">
                    <div class="review-header">
                        <div class="reviewer-image">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/reviewer4.jpg" alt="Reviewer 4">
                        </div>
                        <div class="reviewer-info">
                            <div class="reviewer-name">Lisa Meyer</div>
                            <div class="review-date">vor 3 Monaten</div>
                        </div>
                    </div>
                    <div class="review-rating">★★★★★</div>
                    <div class="review-content">
                        "Absolute Empfehlung! Die Qualität der Arbeit ist erstklassig und das Preis-Leistungs-Verhältnis stimmt."
                    </div>
                    <div class="google-badge">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/google-icon.svg" alt="Google">
                        <span>Google Review</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php
get_footer();
?> 