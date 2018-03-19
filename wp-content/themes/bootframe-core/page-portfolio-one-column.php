<?php
/**
 * Template Name: Portfolio One Column
 *
 */

define('SMARTLIB_CONTENT_TYPE', 'page');

get_header();

do_action('smartlib_post_header');
?>

<section class="smartlib-content-section smartlib-portfolio-content container">


    <div id="page" class="<?php smartlib_layout_class('smartlib-page-area', SMARTLIB_CONTENT_TYPE) ?>">



                <?php
                $args = array('post_type' => 'smartlib_portfolio', 'posts_per_page' => -1);

                $portfolio_query = new WP_Query($args);


                if ($portfolio_query->have_posts()) {

                    while ($portfolio_query->have_posts()): $portfolio_query->the_post();

                        get_template_part('views/content-portfolio', 'sidebar');



                    endwhile;
                }
                ?>




    </div>

    <!--end #page-->

    <?php

    get_sidebar(smartlib_get_sidebar_template('default', SMARTLIB_CONTENT_TYPE));

    ?>

</section>

<?php get_footer(); ?>


