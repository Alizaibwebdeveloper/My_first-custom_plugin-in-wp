<?php
/*
 Single Post Template
 @package Ali Zaib Custom Theme
*/

get_header();

// Hide title based on custom metabox
$post_id = get_the_ID();
$hide_title = get_post_meta($post_id, 'hide_page_title', true);
$heading_class = !empty($hide_title) && 'yes' === $hide_title ? 'hide' : '';

?>

<div id="primary">
    <main id="main" class="site-main mt-5" role="main">

        <?php if (have_posts()) : ?>
            <div class="container">
                <?php
                // Display page title for the blog page when not the front page
                if (is_home() && !is_front_page()) {
                    $posts_page_id = get_option('page_for_posts');
                    if ($posts_page_id) {
                        $posts_page_title = get_the_title($posts_page_id);
                        ?>
                        <header class="mb-5">
                            <h1 class="page-title <?php echo esc_attr($heading_class); ?>">
                                <?php echo esc_html($posts_page_title); ?>
                            </h1>
                        </header>
                        <?php
                    }
                }

                // Start the loop to display posts
                while (have_posts()) : the_post();
                    ?>

                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <header class="entry-header">
                            <?php
                            // Display the featured image if it exists
                            if (has_post_thumbnail()) {
                                the_post_thumbnail('large', ['class' => 'img-fluid mb-3']);
                            }

                            if ('yes' !== $hide_title) {
                                the_title('<h1 class="entry-title">', '</h1>');
                            }
                            ?>
                        </header><!-- .entry-header -->

                        <div class="entry-content">
                            <?php
                            the_content();

                            // Display the author information
                            zaibi_custom_posted_by();
                            ?>
                        </div><!-- .entry-content -->

                        <footer class="entry-footer">
                            <?php
                            $posted_on = sprintf(
                                /* translators: %s: post date. */
                                esc_html_x('Posted on %s', 'post date', 'zaibi-custom-theme'),
                                '<a href="'. esc_url(get_permalink()) .'" rel="bookmark">'. esc_html(get_the_date()) .'</a>'
                            );

                            echo '<span class="text_secondary">'.$posted_on.'</span>';
                            ?>
                        </footer><!-- .entry-footer -->
                    </article><!-- #post-<?php the_ID(); ?> -->

                    <?php
                    // If comments are open or we have at least one comment, load up the comment template.
                    if (comments_open() || get_comments_number()) :
                        comments_template();
                    endif;

                endwhile; // End of the loop
                ?>

            </div><!-- .container -->
        <?php else : ?>
            <?php get_template_part('template_parts/content', 'none'); ?>
        <?php endif; ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
?>
