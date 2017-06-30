<?php
/*
Template Name: IOM archives
*/
get_header(); ?>

    <h1>This is the custom IOM archive</h1>
    <div class="container">

        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

            <a href="<?php the_permalink(); ?>">
                <h1><?php the_title(); ?></h1>
                <?php the_content(); ?>
            </a>

            <hr/>

        <?php endwhile; else: ?>
            <p><?php _e('Beklager, siden findes ikke.'); ?></p>
        <?php endif; ?>

    </div>

<?php get_footer(); ?>