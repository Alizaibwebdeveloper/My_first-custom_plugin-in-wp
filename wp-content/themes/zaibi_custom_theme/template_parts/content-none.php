<?php
    /*
    The Template file for Displaying a message that no posts were found.
    @package zaibi-custom-theme
    */
?>

<section class="no-results not-found">
    <div class="container">
        <header class="page-header">
            <h1 class="page-title">
                <?php _e( 'Nothing Found', 'zaibi-custom-theme' ); ?>
            </h1>
        </header>

        <div class="page-content">
            <?php
                if ( is_home() && current_user_can( 'publish_posts' ) ) {
                    ?>
                    <p>
                        <?php
                            echo wp_kses(
                                sprintf(
                                    __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'zaibi-custom-theme' ),
                                    admin_url( 'post-new.php' )
                                ),
                                array(
                                    'a' => array(
                                        'href' => array()
                                    )
                                )
                            );
                        ?>
                    </p>
                    <?php
                } elseif ( is_search() ) {
                    ?>
                    <p><?php _e( 'It seems we can’t find what you’re looking for. Perhaps searching can help.', 'zaibi-custom-theme' ); ?></p>
                    <?php
                    echo get_search_form();
                    ?>
                    <p>Search form should appear above this line.</p>
                    <?php
                } else {
                    ?>
                    <p><?php _e( 'It seems we can’t find what you’re looking for. Perhaps searching can help.', 'zaibi-custom-theme' ); ?></p>
                    <?php
                    echo get_search_form();
                    ?>
                    <p>Search form should appear above this line.</p>
                    <?php
                }
            ?>
        </div>
    </div>
</section>
