<?php
/**
 * The template for displaying Archive pages.
 */

define('SMARTLIB_CONTENT_TYPE', 'blog_loop');

get_header();

do_action('smartlib_archive_header');
?>
    <section class="smartlib-content-section container">


        <header class="archive-header smartlib-above-content-header">



            <?php
            // If a user has filled out their description, show a bio on their entries.
            if (get_the_author_meta('description')) : ?>
                <div class="smartlib-author-info">
                    <?php echo get_avatar(get_the_author_meta('user_email'), apply_filters('smartlib_author_bio_avatar_size', 68)); ?>
                    <!-- .author-avatar -->
                    <div class="smartlib-author-description">
                        <h3><?php printf(__('About %s', 'bootframe-core'), get_the_author()); ?></h3>

                        <p><?php the_author_meta('description'); ?></p>
                    </div>
                    <!-- .author-description	-->
                </div><!-- .author-info -->
            <?php endif; ?>
        </header>
        <!-- .archive-header -->
    </section>
<?php if (have_posts()) : ?>

    <section class="smartlib-content-section container">

    <div id="page" role="main" class="<?php smartlib_layout_class('col-sm-16 col-md-12', 'blog_loop') ?>">
    <?php
    /* Start the Loop */
    while (have_posts()) : the_post();
        get_template_part('views/content-loop', smartlib_get_loop_variant());
    endwhile;
    ?>

    <?php
    smartlib_list_pagination('nav-below');
    ?>

<?php else : ?>
    <?php get_template_part('views/content', 'none'); ?>
<?php endif; ?>


    </div><!-- #page -->

<?php

get_sidebar(smartlib_get_sidebar_template('default', SMARTLIB_CONTENT_TYPE));

?>
</section>

<?php get_footer(); ?>