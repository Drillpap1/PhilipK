<?php
/**
 * Template für statische Seiten
 * 
 * Dieses Template wird für die Anzeige einzelner Seiten verwendet
 * 
 * @package MALER_THEME
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container">
        <?php
        // WordPress-Schleife für Seiten
        while (have_posts()) :
            the_post();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <?php
                    // Seitentitel
                    the_title('<h1 class="entry-title">', '</h1>');
                    ?>
                </header>

                <?php
                // Beitragsbild, falls vorhanden
                if (has_post_thumbnail()) :
                    ?>
                    <div class="post-thumbnail">
                        <?php the_post_thumbnail('large'); ?>
                    </div>
                    <?php
                endif;
                ?>

                <div class="entry-content">
                    <?php
                    // Seiteninhalt
                    the_content();

                    // Seitenumbruch-Links
                    wp_link_pages(array(
                        'before' => '<div class="page-links">' . esc_html__('Seiten:', 'maler-theme'),
                        'after'  => '</div>',
                    ));
                    ?>
                </div>

                <?php
                // Bearbeiten-Link für eingeloggte Benutzer
                if (get_edit_post_link()) :
                    ?>
                    <footer class="entry-footer">
                        <?php
                        edit_post_link(
                            sprintf(
                                /* translators: %s: Name of current post */
                                esc_html__('Bearbeiten %s', 'maler-theme'),
                                the_title('<span class="screen-reader-text">"', '"</span>', false)
                            ),
                            '<span class="edit-link">',
                            '</span>'
                        );
                        ?>
                    </footer>
                    <?php
                endif;
                ?>
            </article>
            <?php
        endwhile;
        ?>
    </div>
</main>

<?php
get_footer();
?> 