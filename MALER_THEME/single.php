<?php
/**
 * Template für einzelne Blog-Beiträge
 * 
 * Dieses Template wird für die Anzeige einzelner Blog-Beiträge verwendet
 * 
 * @package MALER_THEME
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container">
        <?php
        // WordPress-Schleife für einzelne Beiträge
        while (have_posts()) :
            the_post();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <?php
                    // Beitragstitel
                    the_title('<h1 class="entry-title">', '</h1>');

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
                            
                            // Kategorien
                            $categories_list = get_the_category_list(esc_html__(', ', 'maler-theme'));
                            if ($categories_list) {
                                echo ' | ' . esc_html__('Kategorien:', 'maler-theme') . ' ' . $categories_list;
                            }
                            ?>
                        </div>
                    <?php endif; ?>
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
                    // Beitragsinhalt
                    the_content();

                    // Seitenumbruch-Links
                    wp_link_pages(array(
                        'before' => '<div class="page-links">' . esc_html__('Seiten:', 'maler-theme'),
                        'after'  => '</div>',
                    ));
                    ?>
                </div>

                <footer class="entry-footer">
                    <?php
                    // Tags
                    $tags_list = get_the_tag_list('', esc_html__(', ', 'maler-theme'));
                    if ($tags_list) {
                        printf('<span class="tags-links">' . esc_html__('Tags: %1$s', 'maler-theme') . '</span>', $tags_list);
                    }

                    // Bearbeiten-Link für eingeloggte Benutzer
                    if (get_edit_post_link()) :
                        edit_post_link(
                            sprintf(
                                /* translators: %s: Name of current post */
                                esc_html__('Bearbeiten %s', 'maler-theme'),
                                the_title('<span class="screen-reader-text">"', '"</span>', false)
                            ),
                            '<span class="edit-link">',
                            '</span>'
                        );
                    endif;
                    ?>
                </footer>
            </article>

            <?php
            // Beitragsnavigation
            the_post_navigation(array(
                'prev_text' => '<span class="nav-subtitle">' . esc_html__('Vorheriger:', 'maler-theme') . '</span> <span class="nav-title">%title</span>',
                'next_text' => '<span class="nav-subtitle">' . esc_html__('Nächster:', 'maler-theme') . '</span> <span class="nav-title">%title</span>',
            ));

            // Kommentare
            if (comments_open() || get_comments_number()) :
                comments_template();
            endif;

        endwhile;
        ?>
    </div>
</main>

<?php
get_footer();
?> 