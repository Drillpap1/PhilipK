<?php
/**
 * Footer Template
 * 
 * Enthält die grundlegende HTML-Struktur des Footers
 * und wichtige Footer-Widgets sowie Copyright-Informationen
 * 
 * @package MALER_THEME
 */
?>
    <!-- Footer-Bereich -->
    <footer id="colophon" class="site-footer">
        <div class="container">
            <div class="footer-content">
                <!-- Footer Logo -->
                <div class="footer-logo">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/footer_logo.png" alt="Malermeister Philip Krzywinski Logo">
                </div>

                <!-- Adresse -->
                <div class="footer-address">
                    <h3>Adresse</h3>
                    <p>
                        Malermeister Philip Krzywinski<br>
                        Sandstraße 5<br>
                        53332 Bornheim
                    </p>
                </div>

                <!-- Rechtliches -->
                <div class="footer-legal">
                    <h3>Rechtliches</h3>
                    <ul>
                        <li><a href="<?php echo esc_url(home_url('/impressum/')); ?>">Impressum</a></li>
                        <li><a href="<?php echo esc_url(home_url('/datenschutz/')); ?>">Datenschutz</a></li>
                    </ul>
                </div>
            </div>

            <!-- Copyright-Information -->
            <div class="site-info">
                <p>
                    <?php
                    printf(
                        /* translators: %1$s: Jahr, %2$s: Site-Name */
                        esc_html__('© %1$s %2$s', 'maler-theme'),
                        '2025',
                        'Malermeister Philip Krzywinski'
                    );
                    ?>
                </p>
            </div>
        </div>
    </footer>
</div><!-- #page -->

<!-- WordPress Footer Hooks -->
<?php wp_footer(); ?>
</body>
</html> 