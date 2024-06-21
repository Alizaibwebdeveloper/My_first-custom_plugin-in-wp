<?php
/*
 Template part for displaying posts.
 @package Ali zaib custom theme.
*/

?>

<?php
/*
 Template part for displaying posts.
 @package Ali zaib custom theme.
*/

?>

<div class="col-lg-4 col-md-6 col-sm-12">
    <article <?php post_class('mb-5'); ?> id="post-<?php the_ID(); ?>">
        <div class="card">
            <?php if (has_post_thumbnail()) : ?>
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail('medium', ['class' => 'card-img-top', 'alt' => get_the_title()]); ?>
                </a>
            <?php endif; ?>
            <div class="card-body">
                <h2 class="card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <div class="card-text">
                    <?php the_excerpt(); ?>
                </div>
                <a href="<?php the_permalink(); ?>" class="btn btn-primary">Read more</a>
            </div>
        </div>

        <div class="entry-meta mb-3">

        <?php

        zaibi_custom_posted_on();
        zaibi_custom_posted_by();
            
        ?>


        </div>
    </article>
</div>


