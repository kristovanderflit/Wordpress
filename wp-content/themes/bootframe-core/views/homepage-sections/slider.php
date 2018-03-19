<?php
/**
 * Slider Section Partial
 */

//global variables
global $default_images;

?>

<div class="smartlib-slider-container smartlib-main-slider metaslider">
    <div class="flexslider">
    <ul class="smartlib-layout-list slider-list slides">

        <?php for ($i = 1;
                   $i <= 3;
                   $i++) {

            /**
             * Get Slider Variables
             */

            $title = get_theme_mod('smartlib_slide_header_' . $i, __('Super Awesome Title', 'bootframe-core') . ' #' . $i);
            $image = get_theme_mod('smartlib_slide_image_' . $i, $default_images[$i]);
            $button_text_1 = get_theme_mod('smartlib_slide_button_text_1_' . $i, __('Slider Button #1', 'bootframe-core'));
            $button_url_1 = get_theme_mod('smartlib_slide_button_url_1_' . $i, '#');
            $button_text_2 = get_theme_mod('smartlib_slide_button_text_2_' . $i, __('Slider Button #2', 'bootframe-core'));
            $button_url_2 = get_theme_mod('smartlib_slide_button_url_2_' . $i, '#');


            if (strlen($image) > 0) {

                $style_attribute = 'style="background: url(' . $image . ') no-repeat"';

            }

            if (strlen($title) > 0) {
                ?>

                <li>
                    <img src="<?php echo $image ?>" alt="<?php echo $title; ?>" />
                    <div class="smartlib-single-slide-inside">

                        <div class="container smartlib-table-container">
                            <div class="smartlib-table-cell">
                                <div class="smartlib-slider-content">

                                    <?php
                                    if (strlen($title) > 0) {
                                        ?>
                                        <h1 class="text-center animated bounceIn" data-delay="0.1"
                                            data-animation="bounceIn" style="color: #fff">
                                            <?php echo $title ?>
                                        </h1>
                                    <?php
                                    }
                                    ?>

                                    <div class="smartlib-main-slider-description text-center">
                                        <p style="padding-top: 70px">
                                            <?php
                                            if (strlen($button_text_1) > 0) {
                                                ?>
                                                <a href="<?php echo $button_url_1 ?>"
                                                   class="btn btn-default btn-lg"
                                                   data-delay="1"><?php echo $button_text_1 ?></a>
                                            <?php
                                            }
                                            ?>
                                            <?php
                                            if (strlen($button_text_2) > 0) {
                                                ?>
                                                <a href="<?php echo $button_url_2 ?>"
                                                   class="btn btn-primary btn-lg "><?php echo $button_text_2 ?></a>
                                            <?php
                                            }
                                            ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </li>

            <?php
            }
        }
        ?>
    </ul>

    </div>
</div>