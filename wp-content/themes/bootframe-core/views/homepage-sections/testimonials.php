<?php
/**
 * Testimonials Section Partial
 */

//global variables
global $title_testimonials, $testimonials_array, $section_background, $limit;

$style_string = 'padding: 10px 0 40px 0;';

if (strlen($section_background) > 0) {

    $style_string .= 'background-color: ' . $section_background;

}


?>
<div class="container-fluid smartlib-testimonials-section" style="<?php echo $style_string ?>">
    <div class="container">
        <?php

        smartlib_get_frontpage_section_header($title_testimonials);

        ?>
        <?php



        /**
         * Testimomnials Loop
         */

        if ($testimonials_array->have_posts()) {
            ?>

            <ul class="smartlib-layout-list smartlib-testimonial-slides slides">
                <?php
                $i = 1;
                $j = 1;


                $columns_number_selection = 2;

                if ($columns_number_selection > 0) {

                    $columns_per_slide = 12 / $columns_number_selection;

                } else {
                    $columns_per_slide = 6;
                }


                while ($testimonials_array->have_posts()):$testimonials_array->the_post();


                    if ($i == 1) {
                        ?>
                        <li class="smartlib-testimonial-box">
                        <div class="row">
                    <?php
                    }
                    ?>
                    <div class="col-sm-<?php echo $columns_per_slide ?>">


                        <div class="panel smartlib-center-align smartlib-testimonial-box-widget">
                            <div class="panel-body smartlib-inside-box text-left">
                                <p><?php the_content() ?></p>


                                <?php
                                if (has_post_thumbnail()) {
                                    ?>
                                    <span
                                        class="smartlib-image-outer pull-left">
                                        <?php
                                        the_post_thumbnail('thumbnail')
                                        ?>
                                    </span>
                                <?php
                                }
                                ?>

                                <p class="smartlib-testimonial-author">
                                    <strong><?php the_title() ?></strong><br/>

                                </p>

                            </div>
                        </div>
                    </div>

                    <?php
                    if ($i % $columns_number_selection == 0 || $j == $limit) {
                        ?>
                        </div>
                        </li>
                        <?php
                        $i = 1;
                    } else {
                        $i++;
                    }

                    $j++;

                endwhile;// end while


                ?>

            </ul>

        <?php

        }

        wp_reset_postdata();

        ?>
    </div>
</div>