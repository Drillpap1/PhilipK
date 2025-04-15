<?php
/**
 * Main Template File
 * 
 * Dies ist das Standard-Template für die Anzeige von Inhalten
 * wenn kein spezifischeres Template gefunden wird
 * 
 * @package MALER_THEME
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container">
        <?php
        // Start der WordPress-Schleife
        if (have_posts()) :
            // Header für Archiv-Seiten
            if (is_home() && !is_front_page()) :
                ?>
                <header>
                    <h1 class="page-title"><?php single_post_title(); ?></h1>
                </header>
                <?php
            endif;

            // Start des Beitrags-Loops
            while (have_posts()) :
                the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header">
                        <?php
                        // Beitragstitel
                        the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '">', '</a></h2>');
                        
                        // Beitrags-Meta-Informationen
                        if ('post' === get_post_type()) :
                            ?>
                            <div class="entry-meta">
                                <?php
                                echo get_the_date();
                                ?>
                            </div>
                        <?php endif; ?>
                    </header>

                    <div class="entry-content">
                        <?php
                        // Beitragsauszug oder vollständiger Inhalt
                        if (is_singular()) :
                            the_content();
                        else :
                            the_excerpt();
                        endif;
                        ?>
                    </div>
                </article>
                <?php
            endwhile;

            // Pagination
            the_posts_pagination(array(
                'prev_text' => __('Vorherige', 'maler-theme'),
                'next_text' => __('Nächste', 'maler-theme'),
            ));

        else :
            // Keine Beiträge gefunden
            ?>
            <p><?php esc_html_e('Keine Beiträge gefunden.', 'maler-theme'); ?></p>
            <?php
        endif;
        ?>
    </div>
</main>

<?php
get_sidebar();
get_footer();
?> 