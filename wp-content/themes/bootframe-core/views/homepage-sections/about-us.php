<?php
/**
 * About Us Section Partial
 */

//global variables
global $post_content, $title_about_us, $custom_image, $section_background;

$style_string = 'padding: 10px 0 40px 0;';

$style_string .= 'background-color: '.$section_background;

?>
<div class="container-fluid smartlib-about-us-section" style="<?php echo $style_string ?>">
    <?php

    smartlib_get_frontpage_section_header($title_about_us);

    ?>
    <div class="container">
    <div class="row">

        <?php

        if ($post_content->have_posts()) {

            while ($post_content->have_posts()):$post_content->the_post();


                if (strlen($custom_image) > 0) {

                    $col_class = 'col-md-6';

                } else {

                    $col_class = 'col-md-12';

                }
                ?>

                <div class="<?php echo $col_class ?>">
                    <div class="smartlib-section-content"><?php the_content(); ?></div>
                </div>

                <?php

                if (strlen($custom_image) > 0) {

                    ?>

                    <div class="<?php echo $col_class ?> smartlib-image-column">

                        <img src="<?php echo $custom_image ?>" class="alignnone img-responsive size-full">

                    </div>
                <?php

                }


            endwhile;


        }
        wp_reset_postdata();
        ?>
    </div>
    </div>
</div>