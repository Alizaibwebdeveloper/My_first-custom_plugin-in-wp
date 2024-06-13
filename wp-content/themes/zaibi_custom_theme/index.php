<?php
/*
 Main template file.
 @package Ali zaib custom theme.
*/ 

get_header();
?>

<div id="primary">
    <main id="main" class="site-main mt-5" role="main">
        <?php
        if (have_posts()) {
        ?>
        <div class="container">
            <?php
            // Display page title for the blog page when not the front page
            if (is_home() && !is_front_page()) {
                $posts_page_id = get_option('page_for_posts');
                if ($posts_page_id) {
                    $posts_page_title = get_the_title($posts_page_id);
                ?>
                <header class="mb-5">
                    <h1 class="page-title">
                        <?php echo esc_html($posts_page_title); ?>
                    </h1>
                </header>
                <?php
                }
            }

            // Start the loop to display posts
            ?>
            <div class="row">
                <?php
                $index = 0;
                $no_columns = 3;

                while (have_posts()) : the_post();

                if ($index % $no_columns == 0 && $index != 0) {
                    ?>
                    </div><div class="row">
                    <?php
                }

                ?>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
                        <header class="entry-header">
                            <?php
                            // Display post title as a link to the post
                            the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
                            ?>
                        </header>
                        <div class="entry-content">
                            <?php
                            // Display the post content
                            the_excerpt();
                            ?>
                        </div>
                    </article>
                </div>
                <?php
                $index++;
                endwhile;
                ?>
            </div>
        </div>
        <?php
        } else {
            // If no posts are found
            ?>
            <div class="container">
                <p><?php esc_html_e('No posts found.', 'ali-zaib-custom-theme'); ?></p>
            </div>
            <?php
        }
        ?>
    </main>
</div>

<?php
get_footer();
?>
