<?php

global $post;

$header_bg = smartlib_get_final_settings('smartlib_content_header_backgound_image_default','smartlib_page_header_background', '', 'background');
$dark_section = smartlib_get_final_settings('smartlib_content_header_dark_section_default','smartlib_header_dark_section');
$paralax_section = smartlib_get_final_settings('smartlib_header_paralax_effect_default','smartlib_header_paralax_effect');
$section_overlay_color = smartlib_get_final_settings('smartlib_page_header_background_default','smartlib_page_header_color_background');
$show_title = smartlib_get_final_settings('smartlib_show_page_title_default','smartlib_page_title_page');





    ?>
    <section class="<?php echo apply_filters('smartlib_page_header_class', 'smartlib-full-width-section smartlib-page-image-header',  $dark_section, $paralax_section, $section_overlay_color); ?>" <?php echo apply_filters('smartlib_content_header_attributes', '', $header_bg,  $section_overlay_color);?>>

        <div class="container smartlib-no-padding">

            <div class="smartlib-table-container">

                <div class="smartlib-table-cell">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="smartlib-breadcrumb">
                                <?php do_action('smartlib_breadcrumb'); ?>
                            </div>

                            <?php

                            if(strlen($show_title)==0 || $show_title=='1') {
                                ?>

                                <h1 class="page-header smartlib-page-title"><?php the_title() ?>
                                    <small><?php echo smartlib_get_subtitle() ?></small>
                                </h1>

                            <?php
                            }
                            ?>
                        </div>

                    </div>

                </div>


            </div>
        </div>
    </section>
    <?php

?>
