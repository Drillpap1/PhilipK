<?php
/**
 * Template für Archiv-Seiten
 * 
 * Dieses Template wird für die Anzeige von Archiv-Seiten verwendet,
 * wie Kategorien, Tags, Autoren und Datumsarchive
 * 
 * @package MALER_THEME
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container">
        <?php
        // Archiv-Header
        if (have_posts()) :
            ?>
            <header class="page-header">
                <?php
                // Archiv-Titel
                the_archive_title('<h1 class="page-title">', '</h1>');
                
                // Archiv-Beschreibung
                the_archive_description('<div class="archive-description">', '</div>');
                ?>
            </header>

            <?php
            // Start der WordPress-Schleife
            while (have_posts()) :
                the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header">
                        <?php
                        // Beitragstitel
                        the_title(sprintf('<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>');
                        
                        // Beitrags-Meta-Informationen
                        if ('post' === get_post_type()) :
                            ?>
                            <div class="entry-meta">
                                <?php
                                // Veröffentlichungsdatum
                                echo get_the_date();
                                
                                // Autor
                                echo ' | ' . esc_html__('Von', 'maler-theme') . ' ';
                                the_author_posts_link();
                                ?>
                            </div>
                        <?php endif; ?>
                    </header>

                    <?php
                    // Beitragsbild, falls vorhanden
                    if (has_post_thumbnail()) :
                        ?>
                        <div class="post-thumbnail">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('medium'); ?>
                            </a>
                        </div>
                        <?php
                    endif;
                    ?>

                    <div class="entry-summary">
                        <?php
                        // Beitragsauszug
                        the_excerpt();
                        ?>
                    </div>

                    <footer class="entry-footer">
                        <?php
                        // Kategorien
                        $categories_list = get_the_category_list(esc_html__(', ', 'maler-theme'));
                        if ($categories_list) {
                            printf('<span class="cat-links">' . esc_html__('Kategorien: %1$s', 'maler-theme') . '</span>', $categories_list);
                        }

                        // Tags
                        $tags_list = get_the_tag_list('', esc_html__(', ', 'maler-theme'));
                        if ($tags_list) {
                            printf('<span class="tags-links">' . esc_html__('Tags: %1$s', 'maler-theme') . '</span>', $tags_list);
                        }
                        ?>
                    </footer>
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
get_footer();
?> 