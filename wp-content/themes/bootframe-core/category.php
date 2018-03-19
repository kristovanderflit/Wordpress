<?php
/**
 * The template for displaying Category pages.
 */

define('SMARTLIB_CONTENT_TYPE', 'blog_loop');

get_header();

do_action('smartlib_archive_header');

?>
    <section class="smartlib-content-section container">

        <div id="page" role="main"
             class="<?php smartlib_layout_class('col-sm-16 col-md-12', 'blog_loop') ?>">

            <?php if (have_posts()) : ?>

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


        </div>
        <!-- END #page -->

        <?php

        get_sidebar(smartlib_get_sidebar_template('default', SMARTLIB_CONTENT_TYPE));

        ?>
    </section>
<?php get_footer(); ?>