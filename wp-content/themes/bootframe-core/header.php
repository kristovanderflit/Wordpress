<!DOCTYPE html>
<!--[if lt IE 9]>
<html class="ie lt-ie9" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
    <meta charset="<?php bloginfo('charset'); ?>"/>
    <meta name="viewport" content="width=device-width"/>
    <link rel="profile" href="http://gmpg.org/xfn/11"/>
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>"/>

    <?php

    wp_head();
    ?>

</head>

<body <?php body_class(); ?>>
<?php
do_action('smartlib_before_content');
?>
<header class="smartlib-navigation-header">

    <!-- Top Bar -->
    <?php

    smartlib_top_bar();

    ?>
    <!-- End Top Bar -->
    <!-- Navigation -->

    <div class="<?php smartlib_header_wrapper_classes('smartlib-main-navigation-wrapper'); ?>">
        <nav class="navbar navbar-default  smartlib-navbar smartlib-default-top-navbar" <?php smartlib_header_attributes() ?> >
            <div class="container">
                <div class="row smartlib-expand-row">
                    <div class="col-sm-12">

                        <div class="navbar-header">
                            <?php smartlib_logo('/assets/img/logo-1.png'); ?>
                            <button type="button" class="navbar-toggle" data-toggle="collapse"
                                    data-target="#bs-example-navbar-collapse-1">
                                <span class="sr-only"><?php _e('Toggle navigation', 'bootframe-core'); ?></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>

                        </div>

                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <?php

                            $one_page_check = smartlib_if_is_one_page();

                            if (!$one_page_check) {
                                wp_nav_menu(
                                    array('theme_location' => 'main_menu',
                                        'menu_class' => 'nav navbar-nav navbar-right smartlib-menu smartlib-navbar-menu',
                                        'depth'             => 3,
                                        'fallback_cb' => 'wp_bootstrap_navwalker::fallback',
                                        'walker' => new wp_bootstrap_navwalker()

                                    ));
                            } elseif ($one_page_check) { //display one page menu


                                if ($page_children->have_posts()) : ?>
                                    <div id="smartlib-spy-scroll-nav">
                                        <ul class="nav navbar-nav navbar-right smartlib-menu smartlib-navbar-menu" id="smartlib-one-page-menu" data-scroll-offset="40">
                                            <li><a href="#smartlib-one-page-area"><?php smartlib_get_onepage_home(); ?></a></li>
                                            <?php while ($page_children->have_posts()) : $page_children->the_post(); ?>

                                                <li>

                                                    <a href="#smartlib-page-<?php the_ID(); ?>"><?php the_title() ?></a>

                                                </li>

                                            <?php endwhile; ?>
                                        </ul>
                                    </div>
                                <?php endif;
                                wp_reset_query(); ?>


                            <?php
                            }
                            ?>


                        </div>
                        <div class="smartlib-search-navigation-area">


                            <!-- Collect the nav links, forms, and other content for toggling -->


                            <?php

                            if (!$one_page_check) {
                                do_action('smartlib_top_search');
                            }
                            ?>

                        </div>

                        <!-- /.navbar-collapse -->



                    </div>
                </div>
            </div>
        </nav>
    </div>

    <!-- /.container -->
</nav>
</header>
<!-- END Navigation -->
