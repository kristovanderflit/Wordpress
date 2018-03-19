<?php
/**
 * The Template for displaying all single posts.
 */

define('SMARTLIB_CONTENT_TYPE', 'blog_single');


get_header();

do_action('smartlib_post_header');
?>

    <section class="smartlib-content-section container">
        <?php while (have_posts()) : the_post(); ?>



            <div id="page" role="main"
                 class="<?php smartlib_layout_class('smartlib-left-content', SMARTLIB_CONTENT_TYPE) ?>">

                <?php

                get_template_part('views/content', 'single');

                ?>
                <?php do_action('smartlib_prev_next_post_navigation'); ?>

                <?php smartlib_get_related_post_box(8, 4); ?>

                <?php comments_template('', true); ?>


            </div><!-- END #page -->
        <?php endwhile; // end of the loop. ?>
        <?php

        get_sidebar(smartlib_get_sidebar_template('default', SMARTLIB_CONTENT_TYPE));

        ?>

    </section>
<?php get_footer(); ?>