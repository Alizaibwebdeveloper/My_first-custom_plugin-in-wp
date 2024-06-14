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

                // Include the template part for displaying posts
                get_template_part('template_parts/content');
                
                $index++;
                endwhile;
                ?>
            </div>
        </div>
        <?php
        } else {
            // If no posts are found
            ?>
            <?php
                
            
            get_template_part('template_parts/content-none');
            
        }
        ?>
        <?php
            
        
        get_template_part('template_parts/content-none');

        get_template_part('template_parts/template-tags');


        
        ?>
    </main>
</div>

<?php
get_footer();
?>
