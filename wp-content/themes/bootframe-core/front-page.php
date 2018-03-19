<?php
/**
 * BootFrame home template file.
 *
 *
 *
 * @since      BootFrame 1.0
 */

$homepage_version = get_theme_mod('smartlib_homepage_version', '1');

define('SMARTLIB_CONTENT_TYPE', 'blog_loop');

if (!defined('SMARTLIB_THEME_INFO')) {

    $homepage_version = 0;

}


get_header(); ?>

<div class="smartlib-page-blocks">

    <?php

    /**
     * Default Home Page
     */



    if ($homepage_version == '1' && !is_home()) {

        while (have_posts()):the_post();
            the_content();
        endwhile;

    } else if(!is_home()) {
        smartlib_display_frontmage_sections();
    }

    /**
     * Posts List
     */

    if (is_home()) {

        ?>
        <section class="smartlib-full-width-section smartlib-dark-section smartlib-page-image-header smartlib-overlay-over-background" style="background-color: transparent; background-image: url(<?php echo( get_header_image() ); ?>);" data-type="background" data-overlay-color="0">
            <div class="container smartlib-no-padding">
                <header class="archive-header smartlib-above-content-header">
                    <h1 class="archive-title"><?php echo get_bloginfo('description') ?></h1>

                </header>



                <!-- .archive-header -->
            </div>

        </section>
        <?php





        if (have_posts()) : ?>

            <section class="smartlib-content-section container">
            <div id="page" role="main" class="<?php smartlib_layout_class('smartlib-page-area', 'blog_loop') ?>">
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
    <?php

    }



    ?>

</div>
<?php

get_footer(); ?>


