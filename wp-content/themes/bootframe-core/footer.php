<footer class="smartlib-footer-area ">
    <!--Footer sidebar-->

    <?php do_action('smartlib_footer_sidebar', 'default'); ?>



    <!--Footer bottom - customizer-->
    <section class="smartlib-bottom-footer">
        <div class="container">
            <div class="row">

                <div class="col-sm-6 smartlib-no-padding-left">
                    <?php

                    $one_page_check = smartlib_if_is_one_page();
                    if (has_nav_menu('footer_pages') && !$one_page_check) {

                        wp_nav_menu(
                            array('theme_location' => 'footer_pages',
                                'menu_class' => 'smartlib-menu smartlib-horizontal-menu', 'depth' => 1));

                    }

                    ?>
                </div>
                <div class="col-lg-6">
                    <?php do_action('smartlib_social_links', 'footer') ?>
                </div>
            </div>

        </div>
        <div class="container">
            <div class="row">

                <div class="col-lg-12">
                    <p><?php smartlib_get_section_info_text('footer'); ?></p>
                </div>

            </div>
        </div>
    </section>
    <!--END Footer bottom - customizer-->
</footer>

<?php
do_action('smartlib_after_content');
wp_footer();

?>

</body>
</html>
