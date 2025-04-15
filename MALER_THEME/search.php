<?php
/**
 * The template for displaying search results pages
 *
 * @package MALER_THEME
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container">
        <header class="page-header">
            <h1 class="page-title">
                <?php
                /* translators: %s: search query. */
                printf(esc_html__('Suchergebnisse für: %s', 'maler-theme'), '<span>' . get_search_query() . '</span>');
                ?>
            </h1>
        </header>

        <?php if (have_posts()) : ?>
            <div class="search-results">
                <?php
                while (have_posts()) :
                    the_post();
                    ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('search-result-item'); ?>>
                        <header class="entry-header">
                            <?php the_title(sprintf('<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>'); ?>
                        </header>

                        <div class="entry-summary">
                            <?php the_excerpt(); ?>
                        </div>

                        <footer class="entry-footer">
                            <?php
                            if ('post' === get_post_type()) :
                                ?>
                                <div class="entry-meta">
                                    <?php
                                    echo get_the_date();
                                    ?>
                                </div>
                            <?php endif; ?>
                        </footer>
                    </article>
                <?php
                endwhile;
                ?>
            </div>

            <?php
            the_posts_pagination(array(
                'prev_text' => __('Vorherige', 'maler-theme'),
                'next_text' => __('Nächste', 'maler-theme'),
            ));
            ?>

        <?php else : ?>
            <div class="no-results">
                <p><?php esc_html_e('Keine Ergebnisse gefunden. Bitte versuchen Sie es mit anderen Suchbegriffen.', 'maler-theme'); ?></p>
                <?php get_search_form(); ?>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php
get_footer();
?> 