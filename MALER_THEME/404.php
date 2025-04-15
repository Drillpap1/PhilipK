<?php
/**
 * Template für 404-Fehlerseiten
 * 
 * Dieses Template wird angezeigt, wenn eine Seite nicht gefunden wurde
 * 
 * @package MALER_THEME
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container">
        <section class="error-404 not-found">
            <header class="page-header">
                <h1 class="page-title">
                    <?php esc_html_e('Seite nicht gefunden', 'maler-theme'); ?>
                </h1>
            </header>

            <div class="page-content">
                <p>
                    <?php esc_html_e('Entschuldigung, die gesuchte Seite konnte nicht gefunden werden.', 'maler-theme'); ?>
                </p>

                <?php
                // Suchformular anzeigen
                get_search_form();

                // Beliebte Kategorien anzeigen
                ?>
                <div class="widget widget_categories">
                    <h2 class="widget-title">
                        <?php esc_html_e('Beliebte Kategorien', 'maler-theme'); ?>
                    </h2>
                    <ul>
                        <?php
                        wp_list_categories(array(
                            'orderby'    => 'count',
                            'order'      => 'DESC',
                            'show_count' => 1,
                            'title_li'   => '',
                            'number'     => 5,
                        ));
                        ?>
                    </ul>
                </div>

                <?php
                // Letzte Beiträge anzeigen
                ?>
                <div class="widget widget_recent_entries">
                    <h2 class="widget-title">
                        <?php esc_html_e('Neueste Beiträge', 'maler-theme'); ?>
                    </h2>
                    <ul>
                        <?php
                        $recent_posts = wp_get_recent_posts(array(
                            'numberposts' => 5,
                            'post_status' => 'publish',
                        ));
                        foreach ($recent_posts as $post) :
                            ?>
                            <li>
                                <a href="<?php echo esc_url(get_permalink($post['ID'])); ?>">
                                    <?php echo esc_html($post['post_title']); ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <?php
                // Archiv-Widget anzeigen
                the_widget('WP_Widget_Archives', array(
                    'title'    => __('Archiv', 'maler-theme'),
                    'count'    => 1,
                    'dropdown' => 1,
                ));
                ?>
            </div>
        </section>
    </div>
</main>

<?php
get_footer();
?> 