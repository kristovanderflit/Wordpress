<div class="smartlib-top-navbar">
    <div class="container">
        <div class="row">

            <div class="col-xs-7 col-md-9">

                <?php

                //If WPML is installed and active

                if (class_exists('SitePress')) {

                    ?>
                    <nav class="nav nav-pills nav-top smartlib-language-menu">
                        <p><span class="smartlib-label-inside-menu"><?php _e('Languages', 'bootframe-core') ?>: </span></p>
                        <?php do_action('icl_language_selector'); ?>
                    </nav>
                <?php

                }

                if (function_exists('pll_the_languages')) {
                    ?>
                    <nav class="nav nav-pills nav-top smartlib-language-menu">
                        <p><span class="smartlib-label-inside-menu"><?php _e('Languages', 'bootframe-core') ?>: </span></p>
                        <ul class="smartlib-polylang-languages-list"><?php pll_the_languages(); ?></ul>
                    </nav>
                <?php
                }


                ?>

                <?php
                if (has_nav_menu('top_pages')) {
                    wp_nav_menu(
                        array('theme_location' => 'top_pages',
                            'menu_class' => 'nav nav-pills nav-top hidden-xs hidden-sm hidden-md',
                            'container_class' => 'smartlib-topbar-menu',
                            'depth' => 1
                        ));
                }

                /**
                 * Get top header info
                 */

                $info = get_theme_mod('smartlib_text_header', '');
                $phone_number = get_theme_mod('smartlib_phone_header', '');
                $email = get_theme_mod('smartlib_email_header', '');

                ?>

                <ul class="smartlib-layout-list smartlib-top-bar-info">

                    <?php

                    if (strlen($info) > 0) {
                        ?>
                        <li><?php echo $info ?></li>
                    <?php
                    }

                    if (strlen($phone_number) > 0) {
                        ?>
                        <li><i class="fa fa-phone fa-lg" aria-hidden="true"></i> <?php echo $phone_number ?></li>
                    <?php
                    }
                    ?>
                    <?php
                    if (strlen($email) > 0) {
                        ?>
                        <li><i class="fa fa-envelope fa-lg" aria-hidden="true"></i> <a href="mailto:<?php echo $email ?>"><?php echo $email ?></a></li>
                    <?php
                    }
                    ?>

                </ul>


                <p class="smartlib-top-bar-info"></p>

            </div>
            <div class="col-xs-5 col-md-3 hidden-xs">
                <?php do_action('smartlib_social_links', 'top') ?>
            </div>


        </div>
    </div>
</div>