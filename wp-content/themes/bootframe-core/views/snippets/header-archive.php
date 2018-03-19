<?php

global $post;

$header_bg = smartlib_get_settings_based_on_type('smartlib_content_header_backgound_image', SMARTLIB_CONTENT_TYPE);
$dark_section = smartlib_get_settings_based_on_type('smartlib_content_header_dark_section', SMARTLIB_CONTENT_TYPE);
$paralax_section = smartlib_get_settings_based_on_type('smartlib_header_paralax_effect', SMARTLIB_CONTENT_TYPE);
$section_overlay_color = smartlib_get_settings_based_on_type('smartlib_page_header_background', SMARTLIB_CONTENT_TYPE);
$show_title = smartlib_get_settings_based_on_type('smartlib_show_page_title', SMARTLIB_CONTENT_TYPE, '1');




?>
<section class="<?php echo apply_filters('smartlib_page_header_class', 'smartlib-full-width-section smartlib-page-image-header',  $dark_section, $paralax_section, $section_overlay_color); ?>" <?php echo apply_filters('smartlib_content_header_attributes', '', $header_bg,  $section_overlay_color);?>>
    <div class="container smartlib-no-padding">
        <?php do_action('smartlib_breadcrumb'); ?>
        <?php
        if($show_title=='1') {
            ?>
            <header class="archive-header smartlib-above-content-header">
                <h1 class="archive-title"><?php
                    if (is_day()) :
                        printf(__('Daily Archives: %s', 'bootframe-core'), '<span>' . get_the_date() . '</span>');
                    elseif (is_month()) :
                        printf(__('Monthly Archives: %s', 'bootframe-core'), '<span>' . get_the_date(_x('F Y', 'monthly archives date format', 'bootframe-core')) . '</span>');
                    elseif (is_year()) :
                        printf(__('Yearly Archives: %s', 'bootframe-core'), '<span>' . get_the_date(_x('Y', 'yearly archives date format', 'bootframe-core')) . '</span>');
                    else :
                        _e('Archives', 'bootframe-core');
                    endif;
                    ?></h1>

                <?php if (category_description()) : // Show an optional category description ?>
                    <div class="archive-meta"><?php echo category_description(); ?></div>
                <?php endif; ?>
            </header>

        <?php
        }
        ?>


        <!-- .archive-header -->
    </div>

</section>
