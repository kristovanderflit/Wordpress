<?php
/**
 * The template for displaying all pages.
 *
 */

get_header();

define('SMARTLIB_CONTENT_TYPE', 'page');

do_action('smartlib_post_header');

?>

    <section class="smartlib-content-section container">


        <div id="page" class="<?php smartlib_layout_class('smartlib-page-area', SMARTLIB_CONTENT_TYPE) ?>">

            <?php

            while (have_posts()) : the_post();


                get_template_part('views/content', 'page');

                ?>

                <?php comments_template('', true); ?>

            <?php endwhile; // end of the loop. ?>

        </div>

        <!--end #page-->

        <?php

        get_sidebar(smartlib_get_sidebar_template('default', SMARTLIB_CONTENT_TYPE));

        ?>

    </section>

<?php get_footer(); ?>