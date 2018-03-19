<?php
/**
 * Portfolio Section Partial
 */

//global variables
global $portfolio_query, $columns_number_selection, $section_background, $title_portfolio;


$style_string = 'padding: 10px 0 40px 0;';

$style_string .= 'background-color: '.$section_background;




?>
    <div class="container-fluid smartlib-portfolio-section" style="<?php echo $style_string ?>">

            <?php

            smartlib_get_frontpage_section_header($title_portfolio);

            ?>
            <ul class="smartlib-layout-list smartlib-column-list smartlib-graph-columns smartlib-<?php echo $columns_number_selection ?>-columns-list">
                <?php
                $i = 1;
                $j = 1;


                if ($portfolio_query->have_posts()) {


                    while ($portfolio_query->have_posts()) {

                        $portfolio_query->the_post();


                        if ($i == 1) {
                            ?>
                            <li class="smartlib-portfolio-item-line">

                        <?php
                        }
                        ?>



                        <div class="panel smartlib-caption-box smartlib-portfolio-item-box">


                            <div class="smartlib-thumbnail-outer"><?php the_post_thumbnail('smartlib-large-thumb') ?></div>

                            <div class="samrtlib-caption">
                                <aside class="smartlib-graph-info-box"><h4><?php the_title() ?></h4>
                                    <?php the_excerpt() ?>
                                </aside>
                            </div>
                            <div class="smartlib-caption-buttons-area">


                                <a href="<?php the_permalink() ?>" class="smartlib-icon smartlib-large-circle-icon"><i
                                        class="fa fa-link"></i></a> <a
                                    href="<?php the_post_thumbnail_url('full'); ?>"
                                    class="smartlib-icon smartlib-large-circle-icon"
                                    rel="smartlib-resize-photo[portfolio1]"><i
                                        class="fa fa-expand"></i></a>

                            </div>

                        </div>




                        </li>

                    <?php

                    } // end while

                }


                ?>

            </ul>


    </div>
<?php

wp_reset_postdata();


