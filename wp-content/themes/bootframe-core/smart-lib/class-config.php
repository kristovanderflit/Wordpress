<?php

/**
 * PROJECT CONFIG CLASS
 * Includes layout settings
 */
class Smartlib_Config
{

    private static $instance;
    public $customizer_control;

    private function __construct()
    {

        $this->customizer_control = array();

        if(class_exists('Smartlib_Customizer_Options')){

            $this->customizer_control = new Smartlib_Customizer_Options($this);

        }

    }

    public $excerpt_length = 20;
    public $theme_prefix = 'smartlib';
    public static $theme_key = 'bstarter';

    /*define default sizes*/

    public $project_default_sizes = array(

        'layout_size' => 1200,
        'page_content_size' => 880,
        'sidebar_size' => 320,
        'project_gutter_width' => 30,

    );


    /*define project menu*/

    public $project_menus = array(
        'top_pages' => 'Top Pages Menu',
        'main_menu' => 'Main Menu',
        'footer_pages' => 'Bottom Menu'
    );

    /*define project sidebars*/
    public $project_sidebars = array(
        'main_sidebar' => array(

            'name' => 'Main Sidebar',
            'description' => 'Appears on  Front Page',
            'before_widget' => '<li><div id="%1$s" class="panel widget smartlib-widget %2$s">',
            'after_widget' => '</div></li>',
            'before_title' => '<header class="panel-heading smartlib-widget-header"><h3 class="panel-title">',
            'after_title' => '</h3></header>',
        ),
        'frontpage_content_sidebar' => array(
            'name' => 'Frontpage Content',
            'description' => 'Appears on Category page',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h3 class="widget-title"><span>',
            'after_title' => '</span></h3>'
        ),
        'page_sidebar' => array(
            'name' => 'Default Page Sidebar',
            'description' => 'Default sidebar on the page',
            'before_widget' => '<li><div id="%1$s" class="panel widget smartlib-widget %2$s">',
            'after_widget' => '</div></li>',
            'before_title' => '<header class="panel-heading smartlib-widget-header"><h3 class="panel-title">',
            'after_title' => '</h3></header>'
        ),
        'shop_sidebar' => array(
            'name' => 'Shop Sidebar',
            'description' => 'Apperas on archive product page',
            'before_widget' => '<li><div id="%1$s" class="panel widget smartlib-widget %2$s">',
            'after_widget' => '</div></li>',
            'before_title' => '<header class="panel-heading smartlib-widget-header"><h3 class="panel-title">',
            'after_title' => '</h3></header>'
        ),

        'shop_single_sidebar' => array(
            'name' => 'Shop Product Sidebar',
            'description' => 'Apperas on single product page',
            'before_widget' => '<li><div id="%1$s" class="panel widget smartlib-widget %2$s">',
            'after_widget' => '</div></li>',
            'before_title' => '<header class="panel-heading smartlib-widget-header"><h3 class="panel-title">',
            'after_title' => '</h3></header>'
        ),

        'sidebar-footer' => array(
            'name' => 'Sidebar Footer',
            'description' => 'Appears in footer',
            'before_widget' => '<div class="col-lg-3 col-sm-6"><div id="%1$s" class="smartlib-inside-box panel widget-no-padding smartlib-widget %2$s">',
            'after_widget' => '</div></div>',
            'before_title' => '<header class="panel-heading"><h3 class="widget-title">',
            'after_title' => '</h3></header>'
        ),


    );


    public $assign_context_sidebar = array(
        'default' => array('<ul class="smartlib-layout-list smartlib-column-list smartlib-widgets-list smartlib-sm-2-columns-list">', 'main_sidebar', '</ul>'),
        'frontpage_content' => array('<ul class="smartlib-layout-list smartlib-column-list smartlib-widgets-list smartlib-sm-2-columns-list">', 'main_sidebar', '</ul>'),
        'page' => array('<ul class="smartlib-layout-list smartlib-column-list smartlib-widgets-list smartlib-sm-2-columns-list">', 'page_sidebar', '</ul>'),
        'woocommerce_default' => array('<ul class="smartlib-layout-list smartlib-column-list smartlib-widgets-list smartlib-sm-2-columns-list">', 'shop_sidebar', '</ul>'),
        'woocommerce_single' => array('<ul class="smartlib-layout-list smartlib-column-list smartlib-widgets-list smartlib-sm-2-columns-list">', 'shop_single_sidebar', '</ul>'),
    );

    //contains all customizer settings which goes to css header output
    public $css_propeties_array = array(
        'main_font_color' => array(
            'property' => 'color',
            'selectors' => 'body,p,h1,h2,h3,h4,h5,h6'
        ),
        'header_color' => array(
            'property' => 'color',
            'selectors' => 'h1,h2,h3,h4,h5,h6, .entry-title a'
        ),
        'sidebar_color' => array(
            'property' => 'background',
            'selectors' => '.widget-title'
        ),
        'link_color' => array(
            'property' => 'color',
            'selectors' => 'a, p a'
        ),

        /*nabar with menu*/

        'smartlib_background_navbar_default'=> array(
            'property' => 'background',
            'property_type' => 'background_with_opacity',
            'property_extended' => 'smartlib_background_navbar_opacity_default',  //property opacity extend backgroud property
            'selectors' => '.smartlib-main-navigation-wrapper .smartlib-default-top-navbar, .smartlib-navigation-header .smartlib-default-top-navbar.affix, .smartlib-navigation-header .smartlib-default-top-navbar .smartlib-search-navigation-area .smartlib-navbar-search-form.animated .smartlib-input-search-outer'
        ),



        'smartlib_menu_fonts' => array(
            'property' => 'font-family',
            'selectors' => '.smartlib-default-top-navbar .smartlib-navbar-menu a'
        ),

        'smartlib_menu_link_color_default' => array(
            'property' => 'color',
            'selectors' => '.smartlib-default-top-navbar .smartlib-navbar-menu.smartlib-menu > li > a'
        ),
        'smartlib_menu_link_hover_color_default' => array(
            'property' => 'color',
            'selectors' => '.smartlib-default-top-navbar .smartlib-navbar-menu li a:hover, .smartlib-default-top-navbar .smartlib-navbar-menu li.current-menu-ancestor a'
        ),

        'smartlib_menu_text_transform_default' => array(
            'property' => 'text-transform',
            'selectors' => '.smartlib-default-top-navbar .smartlib-navbar-menu a'
        ),

        'smartlib_menu_bolding_default' => array(
            'property' => 'font-weight',
            'selectors' => '.smartlib-default-top-navbar .smartlib-navbar-menu a'
        ),

        'smartlib_menu_decoration_color_default' => array(
            'property' => 'background',
            'selectors' => '.smartlib-navbar-menu.navbar-nav > li > a:before'
        ),

        'smartlib_menu_icon_color_default' => array(
            'property' => 'color',
            'selectors' => '.smartlib-search-navigation-area .smartlib-navbar-search-form .btn'
        ),

        'smartlib_menu_link_hover_background_default' => array(
            'property' => 'background',
            'selectors' => '.smartlib-default-top-navbar .smartlib-navbar-menu > li > a:hover,.smartlib-default-top-navbar .smartlib-navbar-menu > li.active > a,.smartlib-default-top-navbar .smartlib-navbar-menu li.current-menu-ancestor > a, .smartlib-default-top-navbar .navbar-nav > li.dropdown.open > a, .navbar-default .navbar-toggle:focus'
        ),

        /*footer*/

        'smartlib_sidebar_background_footer_default' => array(
            'property' => 'background',
            'selectors' => '.smartlib-footer-area .smartlib-dark-section'
        ),
        'smartlib_header_footer_color_default' => array(
            'property' => 'color',
            'selectors' => '.smartlib-footer-area .smartlib-widget h3.widget-title'
        ),
        'smartlib_decorator_color_default' => array(
            'property' => 'background',
            'selectors' => '.smartlib-footer-area h3.smartlib-header-with-decorator:after'
        ),
        'smartlib_text_footer_color_default' => array(
            'property' => 'color',
            'selectors' => '.smartlib-footer-area .smartlib-widget, .smartlib-footer-area .smartlib-dark-section *,.smartlib-footer-area .smartlib-widget a, .smartlib-footer-area .smartlib-widget li, .smartlib-footer-area .smartlib-widget p'
        ),
        'smartlib_border_color_default' => array(
            'property' => 'border-color',
            'selectors' => '.smartlib-footer-sidebar .smartlib-widget'
        ),

        //General font

        'smartlib_general_font_family_default' => array(
            'property' => 'font-family',
            'check_default' => 'fonts',
            'selectors' => 'body, p:not(.sangar-content p)'
        ),

        'smartlib_general_text_color_default' => array(
            'property' => 'color',
            'selectors' => 'body, p:not(.sangar-content p)'
        ),

        /*heading*/

        //h1
        'smartlib_h1_font_family_default' => array(
            'property' => 'font-family',
            'selectors' => 'h1',
            'check_default' => 'fonts',
        ),
        'smartlib_h1_text_color_default' => array(
            'property' => 'color',
            'selectors' => 'h1'
        ),
        'smartlib_h1_text_size_default' => array(
            'property' => 'font-size',
            'unit' => 'px',
            'selectors' => 'h1'
        ),

        'smartlib_h1_text_transform_default' => array(
            'property' => 'text-transform',
            'selectors' => 'h1'
        ),
        'smartlib_h1_text_bolding_default' => array(
            'property' => 'font-weight',
            'selectors' => 'h1'
        ),


        //h2
        'smartlib_h2_font_family_default' => array(
            'property' => 'font-family',
            'selectors' => 'h2',
            'check_default' => 'fonts',
        ),
        'smartlib_h2_text_color_default' => array(
            'property' => 'color',
            'selectors' => 'h2'
        ),
        'smartlib_h2_text_size_default' => array(
            'property' => 'font-size',
            'unit' => 'px',
            'selectors' => 'h2'
        ),

        'smartlib_h2_text_transform_default' => array(
            'property' => 'text-transform',
            'selectors' => 'h2'
        ),
        'smartlib_h2_text_bolding_default' => array(
            'property' => 'font-weight',
            'selectors' => 'h2'
        ),

        //h3
        'smartlib_h3_font_family_default' => array(
            'property' => 'font-family',
            'selectors' => 'h3',
            'check_default' => 'fonts'

        ),
        'smartlib_h3_text_color_default' => array(
            'property' => 'color',
            'selectors' => 'h3'
        ),
        'smartlib_h3_text_size_default' => array(
            'property' => 'font-size',
            'unit' => 'px',
            'selectors' => 'h3'
        ),

        'smartlib_h3_text_transform_default' => array(
            'property' => 'text-transform',
            'selectors' => 'h3'
        ),
        'smartlib_h3_text_bolding_default' => array(
            'property' => 'font-weight',
            'selectors' => 'h3'
        ),

        //h4
        'smartlib_h4_font_family_default' => array(
            'property' => 'font-family',
            'check_default' => 'fonts',
            'selectors' => 'h4'
        ),
        'smartlib_h4_text_color_default' => array(
            'property' => 'color',
            'selectors' => 'h4'
        ),
        'smartlib_h4_text_size_default' => array(
            'property' => 'font-size',
            'unit' => 'px',
            'selectors' => 'h4'
        ),

        'smartlib_h4_text_transform_default' => array(
            'property' => 'text-transform',
            'selectors' => 'h4'
        ),
        'smartlib_h4_text_bolding_default' => array(
            'property' => 'font-weight',
            'selectors' => 'h4'
        ),

        //h5
        'smartlib_h5_font_family_default' => array(
            'property' => 'font-family',
            'check_default' => 'fonts',
            'selectors' => 'h5'
        ),
        'smartlib_h5_text_color_default' => array(
            'property' => 'color',
            'selectors' => 'h5'
        ),
        'smartlib_h5_text_size_default' => array(
            'property' => 'font-size',
            'unit' => 'px',
            'selectors' => 'h5'
        ),

        'smartlib_h5_text_transform_default' => array(
            'property' => 'text-transform',
            'selectors' => 'h5'
        ),
        'smartlib_h5_text_bolding_default' => array(
            'property' => 'font-weight',
            'selectors' => 'h5'
        ),


        //h6
        'smartlib_h6_font_family_default' => array(
            'property' => 'font-family',
            'check_default' => 'fonts',
            'selectors' => 'h6'
        ),
        'smartlib_h6_text_color_default' => array(
            'property' => 'color',
            'selectors' => 'h6'
        ),
        'smartlib_h6_text_size_default' => array(
            'property' => 'font-size',
            'unit' => 'px',
            'selectors' => 'h6'
        ),

        'smartlib_h6_text_transform_default' => array(
            'property' => 'text-transform',
            'selectors' => 'h6'
        ),
        'smartlib_h6_text_bolding_default' => array(
            'property' => 'font-weight',
            'selectors' => 'h6'
        ),

        /*links*/
        'smartlib_link_text_color_default' => array(
            'property' => 'color',
            'selectors' => 'a'
        ),
        'smartlib_link_hover_text_color_default' => array(
            'property' => 'color',
            'selectors' => 'a:hover, a:focus'
        ),

        /*BUTTONS*/

        /*default*/

        'smartlib_default_button_background' => array(
            'property' => 'background',
            'selectors' => '.btn.btn-default:before'
        ),

        'smartlib_default_button_hover_background' => array(
            'property' => 'background',
            'selectors' => '.btn.btn-default:hover:after'
        ),

        'smartlib_default_button_text_color' => array(
            'property' => 'color',
            'selectors' => '.btn.btn-default'
        ),

        'smartlib_default_button_border_color' => array(
            'property' => 'border-color',
            'selectors' => '.btn.btn-default'
        ),

        'smartlib_default_button_font_family' => array(
            'property' => 'font-family',
            'selectors' => '.btn.btn-default',
            'check_default' => 'fonts'
        ),

        'smartlib_default_button_text_transform' => array(
            'property' => 'text-transform',
            'selectors' => '.btn.btn-default'
        ),

        /*primary*/

        'smartlib_primary_button_background' => array(
            'property' => 'background',
            'selectors' => '.btn.btn-primary:before, .smartlib-btn-go-top, .button.add_to_cart_button:before'
        ),

        'smartlib_primary_button_hover_background' => array(
            'property' => 'background',
            'selectors' => '.btn.btn-primary:hover:after, .smartlib-btn-go-top:hover, .button.add_to_cart_button:hover:after'
        ),

        'smartlib_primary_button_text_color' => array(
            'property' => 'color',
            'selectors' => '.btn.btn-primary'
        ),

        'smartlib_primary_button_border_color' => array(
            'property' => 'border-color',
            'selectors' => '.btn.btn-primary'
        ),

        'smartlib_primary_button_font_family' => array(
            'property' => 'font-family',
            'check_default' => 'fonts',
            'selectors' => '.btn.btn-primary'
        ),

        'smartlib_primary_button_text_transform' => array(
            'property' => 'text-transform',
            'selectors' => '.btn.btn-primary'
        ),

        /*success*/

        'smartlib_success_button_background' => array(
            'property' => 'background',
            'selectors' => '.btn.btn-success:before'
        ),

        'smartlib_success_button_hover_background' => array(
            'property' => 'background',
            'selectors' => '.btn.btn-success:hover:after'
        ),

        'smartlib_success_button_text_color' => array(
            'property' => 'color',
            'selectors' => '.btn.btn-success'
        ),

        'smartlib_success_button_border_color' => array(
            'property' => 'border-color',
            'selectors' => '.btn.btn-success'
        ),

        'smartlib_success_button_font_family' => array(
            'property' => 'font-family',
            'check_default' => 'fonts',
            'selectors' => '.btn.btn-success'
        ),

        'smartlib_success_button_text_transform' => array(
            'property' => 'text-transform',
            'selectors' => '.btn.btn-success'
        ),

        /*info*/

        'smartlib_info_button_background' => array(
            'property' => 'background',
            'selectors' => '.btn.btn-info:before'
        ),

        'smartlib_info_button_hover_background' => array(
            'property' => 'background',
            'selectors' => '.btn.btn-info:hover:after'
        ),

        'smartlib_info_button_text_color' => array(
            'property' => 'color',
            'selectors' => '.btn.btn-info'
        ),

        'smartlib_info_button_border_color' => array(
            'property' => 'border-color',
            'selectors' => '.btn.btn-info'
        ),

        'smartlib_info_button_font_family' => array(
            'property' => 'font-family',
            'check_default' => 'fonts',
            'selectors' => '.btn.btn-info'
        ),

        'smartlib_info_button_text_transform' => array(
            'property' => 'text-transform',
            'selectors' => '.btn.btn-info'
        ),

        /*warning*/

        'smartlib_warning_button_background' => array(
            'property' => 'background',
            'selectors' => '.btn.btn-warning:before'
        ),

        'smartlib_warning_button_hover_background' => array(
            'property' => 'background',
            'selectors' => '.btn.btn-warning:hover:after'
        ),

        'smartlib_warning_button_text_color' => array(
            'property' => 'color',
            'selectors' => '.btn.btn-warning'
        ),

        'smartlib_warning_button_border_color' => array(
            'property' => 'border-color',
            'selectors' => '.btn.btn-warning'
        ),

        'smartlib_warning_button_font_family' => array(
            'property' => 'font-family',
            'check_default' => 'fonts',
            'selectors' => '.btn.btn-warning'
        ),

        'smartlib_warning_button_text_transform' => array(
            'property' => 'text-transform',
            'selectors' => '.btn.btn-warning'
        ),

        /*danger*/

        'smartlib_danger_button_background' => array(
            'property' => 'background',
            'selectors' => '.btn.btn-danger:before'
        ),

        'smartlib_danger_button_hover_background' => array(
            'property' => 'background',
            'selectors' => '.btn.btn-danger:hover:after'
        ),

        'smartlib_danger_button_text_color' => array(
            'property' => 'color',
            'selectors' => '.btn.btn-danger'
        ),

        'smartlib_danger_button_border_color' => array(
            'property' => 'border-color',
            'selectors' => '.btn.btn-danger'
        ),

        'smartlib_danger_button_font_family' => array(
            'property' => 'font-family',
            'check_default' => 'fonts',
            'selectors' => '.btn.btn-danger'
        ),

        'smartlib_danger_button_text_transform' => array(
            'property' => 'text-transform',
            'selectors' => '.btn.btn-danger'
        ),

        //navbar

        'smartlib_background_dropdown_default' => array(
            'property' => 'background-color',
            'selectors' => '.dropdown-menu, .smartlib-navbar-menu  li .dropdown-menu li a:hover:before, .smartlib-navbar-menu  li .dropdown-menu li a:hover'
        ),

        'smartlib_dropdown_link_color_default' => array(
            'property' => 'color',
            'selectors' => '.smartlib-navbar-menu .dropdown-menu li a, .smartlib-bottom-navbar .navbar-collapse ul li a, .smartlib-navbar-menu.smartlib-menu .open .dropdown-menu  li  a'
        ),

        'smartlib_dropdown_link_hover_color_default' => array(
            'property' => 'color',
            'selectors' => '.smartlib-default-top-navbar .smartlib-navbar-menu  li .dropdown-menu li a:hover,smartlib-default-top-navbar .smartlib-navbar-menu.smartlib-menu .open .dropdown-menu  li.active a,smartlib-default-top-navbar .smartlib-navbar-menu.smartlib-menu .open a.dropdown-toggle'
        ),

        'smartlib_dropdown_link_hover_background_default' => array(
            'property' => 'background',
            'selectors' => '.smartlib-navbar-menu  li .dropdown-menu li a:hover:after, .smartlib-navbar-menu li.dropdown.open .dropdown-toggle, .smartlib-default-top-navbar  .smartlib-navbar-menu .open .dropdown-menu  li.active > a, .smartlib-default-top-navbar .navbar-nav > li.dropdown.open ul.dropdown-menu > li > a:hover:after'
        ),


        /* Widgets headlines */


        'smartlib_widgets_headlines_default' => array(
            'property' => 'color',
            'selectors' => '.smartlib-widget header h3'
        ),

        'smartlib_widgets_headlines_underline_default'=> array(
            'property' => 'border-bottom-color',
            'selectors' => '.smartlib-widget header'
        ),

    );

    public $smartlib_safe_fonts = array(
        'Verdana' => array(
            'label' => 'Verdana'
        ),
        'Arial' => array(
            'label' => 'Arial'
        )
    );

    public $smartlib_fonts = array(
        'smartlib_general_font_family_default' => '"Montserrat", sans-serif',
        'smartlib_menu_fonts' => 'Montserrat',
        'smartlib_header_fonts' => 'Arial',
        'smartlib_h1_font_family_default' => 'Montserrat',
        'smartlib_h2_font_family_default' => 'Montserrat, sans-serif',
        'smartlib_h3_font_family_default' => 'Montserrat',
        'smartlib_h4_font_family_default' => 'Roboto',
        'smartlib_h5_font_family_default' => 'Roboto',
        'smartlib_h6_font_family_default' => 'Roboto',
        'smartlib_default_button_font_family' => 'Roboto',
    );

    public static $promoted_formats = array(
        'video', 'gallery'
    );

    public $layout_class_array = array(
        0 => array(

            'sidebar' => '',

            'content' => 'smartlib-no-sidebar'
        ),
        1 => array(

            'sidebar' => 'smartlib-right-sidebar',

            'content' => 'smartlib-left-content'
        ),
        2 => array(

            'sidebar' => 'smartlib-left-sidebar',

            'content' => 'smartlib-right-content'
        ),


    );


    public $layout_sizes = array(
        'layout' => array(
            'size' => 1200,
            'container' => '.container, .smartlib-content-section,.smartlib-full-strech-section .panel-row-style',
            'customizer_key' => 'smartlib_layout_width'
        ),
        'sidebar' => array(
            'size' => 320,
            'container' => '.smartlib-right-sidebar, .smartlib-left-sidebar',
            'customizer_key' => 'smartlib_section_smartlib_sidebar_resize'
        ),
        'content' => array(
            'size' => array('layout', 'sidebar'),//first  param: minuend ; second param: subtrahend
            'container' => '.smartlib-left-content, .smartlib-right-content',
            'customizer_key' => ''
        ),
    );
    /*
         * Array maping awesome class
         */
    public $icon_awesome_translate_class = array(
        'gallery' => 'fa fa-picture-o',
        'video' => 'fa fa-video-camera',
        'default_icon' => 'fa fa-caret-square-o-right',
        'tag_icon' => 'fa fa-tags',
        'twitter' => 'fa fa-twitter',
        'facebook' => 'fa fa-facebook',
        'gplus' => 'fa fa-google-plus',
        'pinterest' => 'fa fa-pinterest',
        'linkedin' => 'fa fa-linkedin-square',
        'instagram' => 'fa fa-instagram',
        'youtube' => 'fa fa-youtube',
        'twitter_large' => 'fa fa-twitter',
        'facebook_large' => 'fa fa-facebook',
        'gplus_large' => 'fa fa-google-plus',
        'pinterest_large' => 'fa fa-pinterest-p',
        'linkedin_large' => 'fa fa-linkedin',
        'youtube_large' => 'fa fa-youtube',
        'comments' => 'fa fa-comment',
        'more-link' => 'fa fa-angle-right',
        'rss' => 'fa fa-rss',
        'email' => 'fa fa-envelope'
    );

    public $supported_social_media = array(
        'facebook' => 'Facebook', 'gplus' => 'Google Plus', 'pinterest' => 'Pinterest', 'twitter' => 'Twitter', 'rss' => 'RSS', 'linkedin' => 'Linked In', 'instagram' => 'Instagram'
    );

    /* Meta keys array*/

    public $smartlib_meta_keys = array(
        'author_meta_image' => 'smartlib_profile_image'
    );


    public function get_promoted_formats()
    {
        return self::$promoted_formats;
    }

    public function get_theme_key()
    {
        return self::$theme_key;
    }


    /**
     * Return array with starter content
     * @return array
     */


    public function get_theme_starter_content()
    {

        $theme_starter_content = array(

            'homepage' => array(
                'sections' => array(
                    'slider_section' => array(

                        'images' => array(

                            1 => get_template_directory_uri() . '/assets/img/slider/slide1.jpg',
                            2 => get_template_directory_uri() . '/assets/img/slider/slide2.jpg',
                            3 => get_template_directory_uri() . '/assets/img/slider/slide3.jpg',

                        )

                    ),
                    'services_section' => array(
                        array(
                            'smartlib_service_box_title' => esc_attr__('Name of service 1', 'bootframe-core'),
                            'smartlib_service_box_image' => get_template_directory_uri() . '/assets/img/widget/download.png',
                            'smartlib_service_box_text' => esc_attr__('Describe of service 1', 'bootframe-core'),
                            'smartlib_service_box_button_label' => esc_attr__('Button 1', 'bootframe-core'),
                            'smartlib_service_box_button_url' => '#'
                        ),
                        array(
                            'smartlib_service_box_title' => esc_attr__('Name of service 2', 'bootframe-core'),
                            'smartlib_service_box_image' => get_template_directory_uri() . '/assets/img/widget/mobile2.png',
                            'smartlib_service_box_text' => esc_attr__('Describe of service 2', 'bootframe-core'),
                            'smartlib_service_box_button_label' => esc_attr__('Button 2', 'bootframe-core'),
                            'smartlib_service_box_button_url' => '#'
                        ),
                        array(
                            'smartlib_service_box_title' => esc_attr__('Name of service 3', 'bootframe-core'),
                            'smartlib_service_box_image' => get_template_directory_uri() . '/assets/img/widget/full-battery.png',
                            'smartlib_service_box_text' => esc_attr__('Describe of service 3', 'bootframe-core'),
                            'smartlib_service_box_button_label' => esc_attr__('Button 3', 'bootframe-core'),
                            'smartlib_service_box_button_url' => '#'
                        ),
                        array(
                            'smartlib_service_box_title' => esc_attr__('Name of service 4', 'bootframe-core'),
                            'smartlib_service_box_image' => get_template_directory_uri() . '/assets/img/widget/pointer.png',
                            'smartlib_service_box_text' => esc_attr__('Describe of service 4', 'bootframe-core'),
                            'smartlib_service_box_button_label' => esc_attr__('Button 4', 'bootframe-core'),
                            'smartlib_service_box_button_url' => '#'
                        ),
                    ),
                    'about_us_section' => array(
                        'about_us_section_title' => __('About Us', 'bootframe-core'),
                        'about_us_page_id' => 1,
                        'about_us_image' => '',
                        'about_us_background' => '#fff',
                    ),

                    'call_to_action_section' => array(
                        'call_to_action_title' => __('Call to action', 'bootframe-core'),
                        'call_to_action_content' => 'Content',
                        'call_to_action_button_label' => __('Check Us', 'bootframe-core'),
                        'call_to_action_button_link' => '#',
                        'call_to_action_background_color' => '#1bb999',
                        'call_to_action_background_image' => get_template_directory_uri() . '/assets/img/homepage/bg-call-to-action-1.jpg',
                    ),
                    'portfolio_section' => array(
                        'portfolio_title' => __('Portfolio', 'bootframe-core'),
                        'portfolio_number' => 4,
                        'portfolio_taxonomy' => 'all',
                        'portfolio_background' => '',

                    ),
                    'contact_section' => array(
                        'contact_title' => __('Contact Section', 'bootframe-core'),
                        'contact_form' => 1,
                        'contact_map' => '',
                        'contact_background' => '#fff',


                    ),
                    'our_clients_section' => array(
                        'our_clients_title' => __('Our Clients', 'bootframe-core'),
                        'section_background' => '',

                        'boxes' => array(
                            array(
                                'box_link' => '',
                                'box_image' => get_template_directory_uri() . '/assets/img/homepage/our-clients.jpg',
                            ),
                            array(
                                'box_link' => '',
                                'box_image' => get_template_directory_uri() . '/assets/img/homepage/our-clients.jpg',
                            ),
                            array(
                                'box_link' => '',
                                'box_image' => get_template_directory_uri() . '/assets/img/homepage/our-clients.jpg',
                            ),
                            array(
                                'box_link' => '',
                                'box_image' => get_template_directory_uri() . '/assets/img/homepage/our-clients.jpg',
                            ),
                            array(
                                'box_link' => '',
                                'box_image' => get_template_directory_uri() . '/assets/img/homepage/our-clients.jpg',
                            ),
                            array(
                                'box_link' => '',
                                'box_image' => get_template_directory_uri() . '/assets/img/homepage/our-clients.jpg',
                            ),
                        )


                    ),
                    'counter_section' => array(
                        'counter_title' => __('Counter', 'bootframe-core'),
                        'section_background' => '',
                        'counter_background_image' => get_template_directory_uri() . '/assets/img/homepage/bg-call-to-action-1.jpg',

                        'boxes' => array(
                            array(
                                'number_label' => 'Counter 1',
                                'number' => '122',
                            ),
                            array(
                                'number_label' => 'Counter 2',
                                'number' => '1022',
                            ),
                            array(
                                'number_label' => 'Counter 3',
                                'number' => '152',
                            ),
                            array(
                                'number_label' => 'Counter 4',
                                'number' => '1252',
                            ),

                        )


                    ),

                    'features_icons_section' => array(
                        'features_icons_title' => __('Features', 'bootframe-core'),
                        'section_background' => '',
                        'boxes' => array(
                            array(

                                'box_title' => esc_attr__('Feature 1', 'bootframe-core'),
                                'box_icon' => 'fa-cogs',
                                'box_description' => esc_attr__('Describe of feature 1', 'bootframe-core'),

                            ),
                            array(

                                'box_title' => esc_attr__('Feature 2', 'bootframe-core'),
                                'box_icon' => 'fa-backward',
                                'box_description' => esc_attr__('Describe of feature 2', 'bootframe-core'),

                            ),
                            array(

                                'box_title' => esc_attr__('Feature 3', 'bootframe-core'),
                                'box_icon' => 'fa-users',
                                'box_description' => esc_attr__('Describe of feature 3', 'bootframe-core'),

                            ),

                            array(

                                'box_title' => esc_attr__('Feature 4', 'bootframe-core'),
                                'box_icon' => 'fa-comments',
                                'box_description' => esc_attr__('Describe of feature 4', 'bootframe-core'),

                            ),

                            array(

                                'box_title' => esc_attr__('Feature 5', 'bootframe-core'),
                                'box_icon' => 'fa-picture-o',
                                'box_description' => esc_attr__('Describe of feature 5', 'bootframe-core'),

                            ),

                            array(

                                'box_title' => esc_attr__('Feature 6', 'bootframe-core'),
                                'box_icon' => 'fa-calendar',
                                'box_description' => esc_attr__('Describe of feature 6', 'bootframe-core'),

                            ),

                            array(

                                'box_title' => esc_attr__('Feature 7', 'bootframe-core'),
                                'box_icon' => 'fa-map-marker',
                                'box_description' => esc_attr__('Describe of feature 7', 'bootframe-core'),

                            ),
                            array(

                                'box_title' => esc_attr__('Feature 8', 'bootframe-core'),
                                'box_icon' => 'fa-compass',
                                'box_description' => esc_attr__('Describe of feature 8', 'bootframe-core'),

                            ),


                        ),

                    ),

                    'testimonials_section' => array(
                        'testimonials_title' => __('Testimonials', 'bootframe-core'),
                        'section_background' => '',
                    )


                )
            )

        );

        return $theme_starter_content;

    }

    /**
     * Get Default frontpage sections order
     * @return array
     */

    public function get_frontpage_sections_order()
    {

        $frontpage_sections_order = array(
            0 => 'homepage_theme_slider_section',
            1 => 'homepage_theme_last_posts_section',
            2 => 'homepage_theme_services_section',
            3 => 'homepage_theme_custom_page_section',
            4 => 'homepage_theme_portfolio_section',
            5 => 'homepage_theme_contact_section',
            6 => 'homepage_theme_our_clients_section',
            7 => 'homepage_theme_counter_section',
            8 => 'homepage_theme_feature_icons_section',
            9 => 'homepage_theme_testimonials_section'
        );

        return $frontpage_sections_order;

    }

    public $premium_sections_array = array(


        'smartlib_main_menu_section',
        'smartlib_header_section',
        'smartlib_header2_styles',
        'smartlib_header3_styles',
        'smartlib_header4_styles',
        'smartlib_header5_styles',
        'smartlib_header6_styles',
        'smartlib_section_default_button',
        'smartlib_section_primary_button',
        'smartlib_section_success_button',
        'smartlib_section_info_button',
        'smartlib_section_warning_button',
        'smartlib_section_danger_button',
        'smartlib_footer_section',
        'smartlib_layout',
        'smartlib_blog_settings',
        'smartlib_wocommerce_section',
        'smartlib_frontpage_more_slides'
    );


    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new Smartlib_Config();

        }
        return self::$instance;
    }
}