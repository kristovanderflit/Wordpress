<?php
/**
 * Template for displaying Search Results pages.
 */

get_header();

define('SMARTLIB_CONTENT_TYPE', 'blog_loop');

do_action('smartlib_archive_header');
?>


<section class="smartlib-content-section container">
    <header class="page-header smartlib-above-content-header">
        <h1 class="archive-title"><?php printf(__('Search Results for: %s', 'bootframe-core'), '<span>' . get_search_query() . '</span>'); ?></h1>
    </header>
</section>

<section class="smartlib-content-section container">

    <div id="page" role="main"
         class="<?php smartlib_layout_class('col-sm-16 col-md-12', SMARTLIB_CONTENT_TYPE) ?>">

        <?php if (have_posts()) : ?>

            <?php

            /* Start the search Loop */
            while (have_posts()) : the_post();

                get_template_part('views/content-search');

            endwhile;

            ?>

            <?php

            smartlib_list_pagination('nav-below');

            ?>

        <?php else : ?>
            <article <?php post_class('smartlib-page-container'); ?> >
                <div class="entry-content">
                    <p><?php _e('Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'bootframe-core'); ?></p>
                    <?php get_search_form(); ?>
                </div>
            </article>
        <?php endif; ?>


    </div>
    <!-- END #page -->

    <?php

    get_sidebar(smartlib_get_sidebar_template('default', SMARTLIB_CONTENT_TYPE));

    ?>
</section>
<?php get_footer(); ?>
