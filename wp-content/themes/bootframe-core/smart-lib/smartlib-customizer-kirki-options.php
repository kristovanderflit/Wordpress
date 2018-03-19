<?php



//get default velues
global $default_settings, $default_home_sections_order, $default_config;

$default_settings = apply_filters('smartlib_default_theme_content', array());
$default_fonts = apply_filters('smartlib_default_fonts', array());
$default_home_sections_order = apply_filters('smartlib_home_sections_order', array());






add_action( 'init', function() {

    global $default_settings, $default_home_sections_order, $default_fonts;

    Kirki::add_config('bootframe-core', array(
        'capability' => 'edit_theme_options',
        'option_type' => 'theme_mod',
    ));

    /**
     * GENERAL SETTINGS
     */

    Kirki::add_panel('smartlib_panel_general_settings', array(
        'priority' => 1,
        'title' =>  __( 'General Settings', 'bootframe-core'),

    ));


    //add section: logo
    Kirki::add_section('smartlib_section_logo', array(
        'title' => __('Logo & favicon', 'bootframe-core'),
        'panel' => 'smartlib_panel_general_settings',
        'priority' => 20,
    ));



    /*LOGO*/

    Kirki::add_field( 'smartlib_logo', array(
        'type'        => 'image',
        'settings'    => 'smartlib_logo',
        'label'       => __('Upload Logo', 'bootframe-core'),
        'section'     => 'smartlib_section_logo',
        'default'     => '',
        'priority'    => 10,
    ) );




    /* Favicon */



    Kirki::add_field( 'smartlib_favicon', array(
        'type'        => 'image',
        'settings'    => 'smartlib_favicon',
        'label' => __('Upload favicon', 'bootframe-core'),
        'section'     => 'smartlib_section_logo',
        'default'     => '',
        'priority'    => 10,
    ) );

    /*
     * Loading Animation
     */

    Kirki::add_section('smartlib_section_preloader', array(
        'title' => __('Loading Animation', 'bootframe-core'),
        'panel' => 'smartlib_panel_general_settings',
        'priority' => 30,
    ));

    Kirki::add_field('smartlib_show_preloader', array(
        'type' => 'toggle',

        'setting' => 'smartlib_show_preloader',
        'label' => __('Enabling this option will display animation while page loads', 'bootframe-core'),
        'section' => 'smartlib_section_preloader',
        'default' => '1',
        'priority' => 1,



    ));

    /*
     * Gallery
     */

    Kirki::add_section('section_smartlib_gallery_default', array(
        'title' => __('Gallery', 'bootframe-core'),
        'priority' => 31,
        'panel' => 'smartlib_panel_general_settings',
    ));




    Kirki::add_field('section_smartlib_gallery_pretty_photo', array(
        'type' => 'toggle',

        'setting' => 'section_smartlib_gallery_pretty_photo',
        'label' => __('Enabling this option will display photos using prettyPhoto lightbox', 'bootframe-core'),
        'section' => 'section_smartlib_gallery_default',
        'default' => '1',
        'priority' => 1,

    ));


     /*
      * Custom code
      */

    Kirki::add_section('section_smartlib_custom_code', array(
        'title' => __('Custom Code', 'bootframe-core'),
        'priority' => 80,
        'panel' => 'smartlib_panel_general_settings',
    ));


    Kirki::add_field('custom_code_header', array(
        'type' => 'textarea',
        'setting' => 'custom_code_header',
        'label' => __('Custom Scripts for Header [header.php]', 'bootframe-core'),
        'section' => 'section_smartlib_custom_code',

        'priority' => 1,
    ));

    Kirki::add_field('custom_code_footer', array(
        'type' => 'textarea',
        'setting' => 'custom_code_footer',
        'label' => __('Custom Scripts for Footer [footer.php]', 'bootframe-core'),
        'section' => 'section_smartlib_custom_code',

        'priority' => 1,
    ));



    /*
     * Layout
     */

    Kirki::add_section('smartlib_layout', array(
        'title' => __('Layout', 'bootframe-core'),
        'priority' => 40,
        'panel'          => 'smartlib_panel_general_settings',
    ));


    Kirki::add_field('smartlib_layout_width', array(
        'type' => 'slider',
        'setting' => 'smartlib_layout_width',
        'label' => __('Page Width', 'bootframe-core'),
        'section' => 'smartlib_layout',
        'default' => 1200,
        'priority' => 3,
        'choices' => array(
            'min' => 960,
            'max' => 1500,
            'step' => 1,
        ),
    ));

    Kirki::add_field('smartlib_section_smartlib_sidebar_resize', array(
        'type' => 'slider',
        'setting' => 'smartlib_section_smartlib_sidebar_resize',
        'label' => __('Sidebar Width', 'bootframe-core'),
        'section' => 'smartlib_layout',
        'default' => 320,
        'priority' => 4,
        'choices' => array(
            'min' => 200,
            'max' => 400,
            'step' => 1,
        ),
    ));


    Kirki::add_field('smartlib_layout_default', array(
        'type' => 'radio-image',
        'setting' => 'smartlib_layout_default',
        'label' => __('Default Layout Settings:', 'bootframe-core'),
        'section' => 'smartlib_layout',
        'priority' => 1,
        'default' => 1,
        'choices' => array(
            0 => SMART_KIRKI_URI . 'assets/images/1c.png',
            1 => SMART_KIRKI_URI . '/assets/images/2cr.png',
            2 => SMART_KIRKI_URI . '/assets/images/2cl.png',
        )
    ));


    /*
     * PAGES SETTINGS
     */


    Kirki::add_section('smartlib_pages_settings', array(
        'title' => __('Pages Settings', 'bootframe-core'),
        'priority' => 80,
        'panel'          => 'smartlib_panel_general_settings',
    ));


    Kirki::add_field('smartlib_pages_breadcrumb_page', array(
        'type' => 'toggle',
        'mode' => 'buttonset',
        'setting' => 'smartlib_pages_breadcrumb_page',
        'label' => __('Show Breadcrumb:', 'bootframe-core'),
        'section' => 'smartlib_pages_settings',
        'default' => 1,
        'priority' => 10,
        'choices' => array(
            0 => __('Off', 'bootframe-core'),
            1 => __('On', 'bootframe-core'))
    ));

    Kirki::add_field('smartlib_breadcrumb_separator_page', array(
        'type' => 'text',
        'setting' => 'smartlib_breadcrumb_separator_page',
        'label' => __('Breadcrumb separator:', 'bootframe-core'),
        'section' => 'smartlib_pages_settings',
        'default' => ' / ',
        'priority' => 10,

    ));

    Kirki::add_field('smartlib_breadcrumb_homepage_name', array(
        'type' => 'text',
        'setting' => 'smartlib_breadcrumb_homepage_name',
        'label' => __('Breadcrumb Home Page Name:', 'bootframe-core'),
        'section' => 'smartlib_pages_settings',
        'default' => __('Home', 'bootframe-core'),
        'priority' => 10,

    ));




    /*
    * BLOG SETTINGS
    */

    Kirki::add_section('smartlib_blog_settings', array(
        'title' => __('Blog Settings', 'bootframe-core'),
        'priority' => 80,
        'panel'          => 'smartlib_panel_general_settings',
    ));

    Kirki::add_field('smartlib_pagination_posts', array(
        'type' => 'toggle',
        'mode' => 'buttonset',
        'setting' => 'smartlib_pagination_posts',
        'label' => __('Pagination', 'bootframe-core'),
        'section' => 'smartlib_blog_settings',
        'default' => '1',
        'priority' => 1,
        'choices' => array(
            '0' => __('Hide', 'bootframe-core'),
            '1' => __('Prev/Next', 'bootframe-core'),
            '2' => __('Numbers', 'bootframe-core'))
    ));

    Kirki::add_field('smartlib_show_author_default', array(
        'type' => 'toggle',
        'mode' => 'buttonset',
        'setting' => 'smartlib_show_author_default',
        'label' => __('Show Author (Default)', 'bootframe-core'),
        'section' => 'smartlib_blog_settings',
        'default' => '1',
        'priority' => 1,
        'choices' => array(
            '0' => __('OFF', 'bootframe-core'),
            '1' => __('ON', 'bootframe-core'))
    ));

    Kirki::add_field('smartlib_show_date_default', array(
        'type' => 'toggle',
        'mode' => 'buttonset',
        'setting' => 'smartlib_show_date_default',
        'label' => __('Show Date (Default)', 'bootframe-core'),
        'section' => 'smartlib_blog_settings',
        'default' => '1',
        'priority' => 1,
        'choices' => array(
            '0' => __('OFF', 'bootframe-core'),
            '1' => __('ON', 'bootframe-core'))
    ));

    Kirki::add_field('smartlib_show_category_default', array(
        'type' => 'toggle',
        'mode' => 'buttonset',
        'setting' => 'smartlib_show_category_default',
        'label' => __('Show Categories (Default)', 'bootframe-core'),
        'section' => 'smartlib_blog_settings',
        'default' => '1',
        'priority' => 1,
        'choices' => array(
            '0' => __('OFF', 'bootframe-core'),
            '1' => __('ON', 'bootframe-core'))
    ));

    Kirki::add_field('smartlib_show_postformat_default', array(
        'type' => 'toggle',
        'mode' => 'buttonset',
        'setting' => 'smartlib_show_postformat_default',
        'label' => __('Show Post Format (Default)', 'bootframe-core'),
        'section' => 'smartlib_blog_settings',
        'default' => '1',
        'priority' => 1,
        'choices' => array(
            '0' => __('OFF', 'bootframe-core'),
            '1' => __('ON', 'bootframe-core'))
    ));



    /**
     * Fonts & Text Colors
     */

    Kirki::add_panel('typography_theme_panel', array(
        'priority' => 1,
        'title' =>  __( 'Typography', 'bootframe-core'),

    ));


    //General text settings



    Kirki::add_field('smartlib_general_font_family_default', array(
        'type' => 'select',
        'label' => __('Font Family', 'bootframe-core'),
        'section' => 'smartlib_general_text_styles',
        'setting' => 'smartlib_general_font_family_default',
        'description' => __('Choose a default font for your site', 'bootframe-core'),
        'default' => $default_fonts['smartlib_general_font_family_default'],
        'priority' => 1,
        'choices' => Kirki_Fonts::get_font_choices()
    ));

    Kirki::add_field('smartlib_general_text_color_default', array(
        'type' => 'color',

        'setting' => 'smartlib_general_text_color_default',
        'label' => __('Text Color', 'bootframe-core'),
        'section' => 'smartlib_general_text_styles',
        'default' => '#2c3f50',
        'priority' => 2,
    ));

    Kirki::add_section('smartlib_general_text_styles', array(
        'title' => __('General Text Settings', 'bootframe-core'),
        'priority' => 2,
        'panel'          => 'typography_theme_panel',
    ));

    //Header 1 styles

    Kirki::add_section('smartlib_header1_styles', array(
        'title' => __('H1 Style', 'bootframe-core'),
        'priority' => 2,
        'panel'          => 'typography_theme_panel',
    ));


    Kirki::add_field('smartlib_h1_font_family_default', array(
        'type' => 'select',
        'label' => __('H1 Font Family', 'bootframe-core'),
        'section' => 'smartlib_header1_styles',
        'setting' => 'smartlib_h1_font_family_default',
        'description' => __('Choose a default font family for H1 heading', 'bootframe-core'),
        'default' => $default_fonts['smartlib_h1_font_family_default'],
        'priority' => 1,
        'choices' => Kirki_Fonts::get_font_choices()
    ));

    Kirki::add_field('smartlib_h1_text_color_default', array(
        'type' => 'color',

        'setting' => 'smartlib_h1_text_color_default',
        'label' => __('H1 Text Color', 'bootframe-core'),
        'section' => 'smartlib_header1_styles',
        'default' => '#2c3f50',
        'priority' => 2,
    ));

    Kirki::add_field('smartlib_h1_text_size_default', array(
        'type' => 'slider',

        'setting' => 'smartlib_h1_text_size_default',
        'label' => __('H1 Font Size (px)', 'bootframe-core'),
        'section' => 'smartlib_header1_styles',
        'default' => 65,
        'priority' => 3,
        'choices' => array(
            'min' => 30,
            'max' => 80,
            'step' => 1,
        ),
    ));

    Kirki::add_field('smartlib_h1_text_transform_default', array(
        'type' => 'select',

        'setting' => 'smartlib_h1_text_transform_default',
        'label' => __('H1 Text Transform', 'bootframe-core'),
        'section' => 'smartlib_header1_styles',
        'priority' => 3,
        'default' => 'uppercase',
        'choices' => array(
            'none' => __('None', 'bootframe-core'),
            'uppercase' => __('Uppercase', 'bootframe-core')
        )
    ));

    Kirki::add_field('smartlib_h1_text_bolding_default', array(
        'type' => 'select',
        'mode' => 'buttonset',
        'setting' => 'smartlib_h1_text_bolding_default',
        'label' => __('H1 Font Weight', 'bootframe-core'),
        'section' => 'smartlib_header1_styles',
        'priority' => 4,
        'default' => 'normal',
        'choices' => array(
            'normal' => __('Normal', 'bootframe-core'),
            'bold' => __('Bold', 'bootframe-core')
        )
    ));


    Kirki::add_section('smartlib_header2_styles', array(
        'title' => __('H2 Style', 'bootframe-core'),
        'priority' => 2,
        'panel'          => 'typography_theme_panel',
    ));


    Kirki::add_field('smartlib_h2_font_family_default', array(
        'type' => 'select',
        'label' => __('H2 Font Family', 'bootframe-core'),
        'section' => 'smartlib_header2_styles',
        'setting' => 'smartlib_h2_font_family_default',
        'description' => __('Choose a default font family for H1 heading', 'bootframe-core'),
        'default' => $default_fonts['smartlib_h2_font_family_default'],
        'priority' => 1,
        'choices' => Kirki_Fonts::get_font_choices()
    ));

    Kirki::add_field('smartlib_h2_text_color_default', array(
        'type' => 'color',

        'setting' => 'smartlib_h2_text_color_default',
        'label' => __('H2 Text Color', 'bootframe-core'),
        'section' => 'smartlib_header2_styles',
        'default' => '#2c3f50',
        'priority' => 2,
    ));

    Kirki::add_field('smartlib_h2_text_size_default', array(
        'type' => 'slider',

        'setting' => 'smartlib_h2_text_size_default',
        'label' => __('H2 Font Size (px)', 'bootframe-core'),
        'section' => 'smartlib_header2_styles',
        'default' => 52,
        'priority' => 3,
        'choices' => array(
            'min' => 25,
            'max' => 70,
            'step' => 1,
        ),
    ));

    Kirki::add_section('smartlib_header3_styles', array(
        'title' => __('H3 Style', 'bootframe-core'),
        'priority' => 3,
        'panel'          => 'typography_theme_panel',
    ));
    Kirki::add_section('smartlib_header4_styles', array(
        'title' => __('H4 Style', 'bootframe-core'),
        'priority' => 4,
        'panel'          => 'typography_theme_panel',
    ));

    Kirki::add_section('smartlib_header5_styles', array(
        'title' => __('H5 Style', 'bootframe-core'),
        'priority' => 5,
        'panel'          => 'typography_theme_panel',
    ));

    Kirki::add_section('smartlib_header6_styles', array(
        'title' => __('H6 Style', 'bootframe-core'),
        'priority' => 6,
        'panel'          => 'typography_theme_panel',
    ));

    Kirki::add_section('smartlib_link_styles', array(
        'title' => __('Links Style', 'bootframe-core'),
        'priority' => 7,
        'panel'          => 'typography_theme_panel',
    ));

    Kirki::add_field('smartlib_link_text_color_default', array(
        'type' => 'color',

        'setting' => 'smartlib_link_text_color_default',
        'label' => __('Links Text Color', 'bootframe-core'),
        'section' => 'smartlib_link_styles',
        'default' => '#1bbc9d',
        'priority' => 1,
    ));

    Kirki::add_field('smartlib_link_hover_text_color_default', array(
        'type' => 'color',

        'setting' => 'smartlib_link_hover_text_color_default',
        'label' => __('Links Hover Text Color', 'bootframe-core'),
        'section' => 'smartlib_link_styles',
        'default' => '#2c3f52',
        'priority' => 2,
    ));


    /**
     * Design
     */

    Kirki::add_panel('design_theme_panel', array(
        'priority' => 1,
        'title' =>  __( 'Design', 'bootframe-core'),

    ));

    Kirki::add_section('smartlib_section_default_button', array(
        'title' => __('Default Button', 'bootframe-core'),
        'panel' => 'design_theme_panel',
        'priority' => 1,
    ));


    /*default button*/

    Kirki::add_field('smartlib_default_button_background', array(
        'type' => 'color',
        'setting' => 'smartlib_default_button_background',
        'label' => __('Background Default Button', 'bootframe-core'),
        'section' => 'smartlib_section_default_button',
        'priority' => 2,
    ));

    Kirki::add_field('smartlib_default_button_hover_background' , array(
        'type' => 'color',
        'setting' => 'smartlib_default_button_hover_background',
        'label' => __('Background Default Button Hover', 'bootframe-core'),
        'section' => 'smartlib_section_default_button',
        'priority' => 2,
    ));












    Kirki::add_section('smartlib_section_primary_button', array(
        'title' => __('Primary Button', 'bootframe-core'),
        'panel' => 'design_theme_panel',
        'priority' => 2,
    ));


    /*primary button*/

    Kirki::add_field('smartlib_primary_button_background', array(
        'type' => 'color',
        'setting' => 'smartlib_primary_button_background',
        'label' => __('Background  Button', 'bootframe-core'),
        'section' => 'smartlib_section_primary_button',
        'priority' => 2,
    ));

    Kirki::add_field('smartlib_primary_button_hover_background', array(
        'type' => 'color',
        'setting' => 'smartlib_primary_button_hover_background',
        'label' => __('Background Button Hover', 'bootframe-core'),
        'section' => 'smartlib_section_primary_button',
        'priority' => 2,
    ));

    Kirki::add_section('smartlib_section_success_button', array(
        'title' => __('Success Button', 'bootframe-core'),
        'panel' => 'design_theme_panel',
        'priority' => 3,
    ));

    Kirki::add_section('smartlib_section_info_button', array(
        'title' => __('Info Button', 'bootframe-core'),
        'panel' => 'design_theme_panel',
        'priority' => 4,
    ));

    Kirki::add_section('smartlib_section_warning_button', array(
        'title' => __('Warning Button', 'bootframe-core'),
        'panel' => 'design_theme_panel',
        'priority' => 5,
    ));

    Kirki::add_section('smartlib_section_danger_button', array(
        'title' => __('Danger Button', 'bootframe-core'),
        'panel' => 'design_theme_panel',
        'priority' => 6,
    ));

   /*
   * Navbar Section
   */

    Kirki::add_panel( 'smartlib_panel_navbar', array(
        'priority'    => 20,
        'title'       => __( 'Navbar Section', 'bootframe-core'),

    ) );


    //Top bar section


    Kirki::add_section('smartlib_topbar_section', array(
        'title' => __('Top Bar Section', 'bootframe-core'),
        'priority' => 10,
        'panel'          => 'smartlib_panel_navbar',
    ));



    Kirki::add_field('smartlib_show_top_bar_default', array(
        'type' => 'toggle',
        'mode' => 'buttonset',
        'setting' => 'smartlib_show_top_bar_default',
        'label' => __('Show Top Bar', 'bootframe-core'),
        'section' => 'smartlib_topbar_section',
        'default' => '1',
        'priority' => 5,

    ));

    Kirki::add_field('smartlib_display_social_links_top', array(
        'type' => 'toggle',
        'setting' => 'smartlib_display_social_links_top',
        'label' => __('Display social buttons in top bar', 'bootframe-core'),
        'section' => 'smartlib_topbar_section',
        'priority' => 10,
        'default' => '1',
    ));

    Kirki::add_field( 'smartlib_text_header', array(
        'type'     => 'text',
        'settings' => 'smartlib_text_header',
        'label' => __('Header info', 'bootframe-core'),
        'section'  => 'smartlib_topbar_section',
        'priority' => 10,
    ) );


    //main navbar

    Kirki::add_section('smartlib_header_section', array(
        'title' => __('Main Navbar Style', 'bootframe-core'),
        'priority' => 20,
        'panel'          => 'smartlib_panel_navbar',
    ));

    Kirki::add_field('smartlib_show_search_in_navbar_default', array(
        'type' => 'toggle',

        'setting' => 'smartlib_show_search_in_navbar_default',
        'label' => __('Search in navigation area', 'bootframe-core'),
        'section' => 'smartlib_header_section',
        'default' => '1',
        'priority' => 3,

    ));

    Kirki::add_field('smartlib_fixed_navbar_default', array(
        'type' => 'toggle',
        'setting' => 'smartlib_fixed_navbar_default',
        'label' => __('Fixed Top Navbar', 'bootframe-core'),
        'section' => 'smartlib_header_section',
        'default' => '1',
        'priority' => 1,

    ));

    Kirki::add_field('smartlib_ingrid_navbar_default', array(
        'type' => 'toggle',
        'setting' => 'smartlib_ingrid_navbar_default',
        'label' => __('In Grid Navbar', 'bootframe-core'),
        'section' => 'smartlib_header_section',
        'default' => '1',
        'priority' => 1,

    ));


    Kirki::add_field('smartlib_navbar_over_content_default', array(
        'type' => 'toggle',
        'setting' => 'smartlib_navbar_over_content_default',
        'label' => __('Display navbar over content', 'bootframe-core'),
        'description' => __('You can also change this setting on every single page. At this point, choose option which you will use most often', 'bootframe-core'),
        'section' => 'smartlib_header_section',
        'default' => '0',
        'priority' => 2,

    ));


    //Menu


    Kirki::add_section('smartlib_main_menu_section', array(
        'title' => __('Main Menu', 'bootframe-core'),
        'priority' => 20,
        'panel'          => 'smartlib_panel_navbar',
    ));



    //Main Menu

    Kirki::add_field('smartlib_menu_fonts', array(
        'type' => 'select',
        'label' => __('Menu Font Family', 'bootframe-core'),
        'section' => 'smartlib_main_menu_section',
        'setting' => 'smartlib_menu_fonts',
        'default' => $default_fonts['smartlib_menu_fonts'],
        'priority' => 1,
        'choices' => Kirki_Fonts::get_font_choices()
    ));

    Kirki::add_field('smartlib_menu_link_color_default', array(
        'type' => 'color',

        'setting' => 'smartlib_menu_link_color_default',
        'label' => __('Links Color', 'bootframe-core'),
        'section' => 'smartlib_main_menu_section',
        'default' => '#ffffff',
        'priority' => 1,
    ));

    Kirki::add_field('smartlib_menu_link_hover_color_default', array(
        'type' => 'color',

        'setting' => 'smartlib_menu_link_hover_color_default',
        'label' => __('Links Hover/Active Color', 'bootframe-core'),
        'section' => 'smartlib_main_menu_section',
        'default' => '#ffffff',
        'priority' => 2,
    ));

    Kirki::add_field('smartlib_menu_link_hover_background_default', array(
        'type' => 'color',

        'setting' => 'smartlib_menu_link_hover_background_default',
        'label' => __('Links Hover/Active Background', 'bootframe-core'),
        'section' => 'smartlib_main_menu_section',
        'default' => '#2c3e51',
        'priority' => 4,
    ));



    /*
     * Footer
     */



    Kirki::add_section('smartlib_footer_section', array(
        'title' => __('Footer Section', 'bootframe-core'),
        'priority' => 21,
    ));

    //footer text

    Kirki::add_field( 'smartlib_text_footer', array(
        'type'     => 'text',
        'settings' => 'smartlib_text_footer',
        'label' => __('Copyright text', 'bootframe-core'),
        'section'  => 'smartlib_footer_section',
        'default'  => esc_attr__( 'This is a defualt value', 'bootframe-core'),
        'priority' => 10,
    ) );

    Kirki::add_field('smartlib_display_sidebar_footer_default', array(
        'type' => 'toggle',
        'setting' => 'smartlib_display_sidebar_footer_default',
        'label' => __('Display sidebar in footer', 'bootframe-core'),
        'section' => 'smartlib_footer_section',
        'priority' => 1,
        'default' => '1',

    ));

    Kirki::add_field('smartlib_sidebar_background_footer_default', array(
        'type' => 'color',

        'setting' => 'smartlib_sidebar_background_footer_default',
        'label' => __('Footer Sidebar Background', 'bootframe-core'),
        'section' => 'smartlib_footer_section',
        'default' => '#2c3f52',
        'priority' => 2,
    ));

    Kirki::add_field('smartlib_header_footer_color_default', array(
        'type' => 'color',
        'setting' => 'smartlib_header_footer_color_default',
        'label' => __('Footer Headers Color', 'bootframe-core'),
        'section' => 'smartlib_footer_section',
        'default' => '#1bb999',
        'priority' => 3,
    ));




    /*WooCommerce Section*/

    if(class_exists( 'WooCommerce' )){

        Kirki::add_section('smartlib_wocommerce_section', array(
            'title' => __('WooCommerce Layout Settings', 'bootframe-core'),
            'priority' => 15,
        ));

    }

    /**
     * Homepage Panel and options
     */

    Kirki::add_panel('homepage_theme_panel', array(
        'priority' => 10,
        'title' => __('Home Page', 'bootframe-core'),
        'description' => __('All sections form Home Page', 'bootframe-core'),
    ));

    Kirki::add_section('homepage_theme_slider_section', array(
        'title' => __('Home Slider', 'bootframe-core'),
        'panel' => 'homepage_theme_panel', // Not typically needed.
        'priority' => 160,
        'capability' => 'edit_theme_options',
    ));

    Kirki::add_field('homepage_theme_slider_section_display', array(
        'type' => 'toggle',
        'settings' => 'homepage_theme_slider_section_display',
        'label' => __('Display Slider Section', 'bootframe-core'),
        'section' => 'homepage_theme_slider_section',
        'default' => '1',
        'priority' => 0,
    ));


    for ($i = 1; $i <= 3; $i++) {

        Kirki::add_field('header_legend_' . $i, array(
            'type' => 'header_legend',
            'setting' => 'header_legend_' . $i,
            'label' => __('Slide', 'bootframe-core') . ' ' . $i . ': ',
            'section' => 'homepage_theme_slider_section',
            'active_callback' => array(
                array(
                    'setting' => 'homepage_theme_slider_section_display',
                    'operator' => '==',
                    'value' => '1',
                ),
            ),
            'priority' => $i,
        ));

        Kirki::add_field('smartlib_slide_image_' . $i, array(
            'type' => 'image',
            'setting' => 'smartlib_slide_image_' . $i,
            'label' => __('Slide', 'bootframe-core') . ' ' . $i . ': ' . __('Slide Image', 'bootframe-core'),
            'section' => 'homepage_theme_slider_section',
            'default' => get_template_directory_uri() . '/assets/img/slider/slide' . $i . '.jpg',
            'active_callback' => array(
                array(
                    'setting' => 'homepage_theme_slider_section_display',
                    'operator' => '==',
                    'value' => '1',
                ),
            ),
            'priority' => $i,


        ));

        Kirki::add_field('smartlib_slide_header_' . $i, array(
            'type' => 'text',
            'setting' => 'smartlib_slide_header_' . $i,
            'label' => __('Slide', 'bootframe-core') . ' ' . $i . ': ' . __('Header Text', 'bootframe-core'),
            'section' => 'homepage_theme_slider_section',
            'description' => __('Main heading text / leave blank to hide', 'bootframe-core'),
            'default' => __('Super Awesome Title', 'bootframe-core') . ' #' . $i,
            'active_callback' => array(
                array(
                    'setting' => 'homepage_theme_slider_section_display',
                    'operator' => '==',
                    'value' => '1',
                ),
            ),
            'priority' => $i,
            'partial_refresh' => array(
                'smartlib_slide_header_' . $i => array(
                    'selector' => '.slider-list li:nth-child(' . $i . ') .smartlib-slider-content h1',
                    'render_callback' => function ($i) {
                        return get_theme_mod('smartlib_slide_header_' . $i);
                    },
                ),

            ),
        ));

        Kirki::add_field('smartlib_slide_button_text_1_' . $i, array(
            'type' => 'text',
            'setting' => 'smartlib_slide_button_text_1_' . $i,
            'label' => __('Slide', 'bootframe-core') . ' ' . $i . ': ' . __('Button #1 Text', 'bootframe-core'),
            'section' => 'homepage_theme_slider_section',
            'description' => __('The text for the button / leave blank to hide', 'bootframe-core'),
            'default' => __('Slider Button #1', 'bootframe-core'),
            'active_callback' => array(
                array(
                    'setting' => 'homepage_theme_slider_section_display',
                    'operator' => '==',
                    'value' => '1',
                ),
            ),
            'priority' => $i,
            'partial_refresh' => array(
                'smartlib_slide_button_text_1_' . $i => array(
                    'selector' => '.slider-list li:nth-child(' . $i . ') .smartlib-slider-content .btn-default',
                    'render_callback' => function ($i) {
                        return get_theme_mod('smartlib_slide_button_text_1_' . $i);
                    },
                ),

            ),
        ));

        Kirki::add_field('smartlib_slide_button_url_1_' . $i, array(
            'type' => 'text',
            'setting' => 'smartlib_slide_button_url_1_' . $i,
            'label' => __('Slide', 'bootframe-core') . ' ' . $i . ': ' . __('Button #1 URL', 'bootframe-core'),
            'section' => 'homepage_theme_slider_section',
            'active_callback' => array(
                array(
                    'setting' => 'homepage_theme_slider_section_display',
                    'operator' => '==',
                    'value' => '1',
                ),
            ),
            'priority' => $i,

        ));

        Kirki::add_field('smartlib_slide_button_text_2_' . $i, array(
            'type' => 'text',
            'setting' => 'smartlib_slide_button_text_2_' . $i,
            'label' => __('Slide', 'bootframe-core') . ' ' . $i . ': ' . __('Button #2 Text', 'bootframe-core'),
            'section' => 'homepage_theme_slider_section',
            'description' => __('The text for the button / leave blank to hide', 'bootframe-core'),
            'default' => __('Slider Button #2', 'bootframe-core'),
            'active_callback' => array(
                array(
                    'setting' => 'homepage_theme_slider_section_display',
                    'operator' => '==',
                    'value' => '1',
                ),
            ),
            'priority' => $i,
            'partial_refresh' => array(
                'smartlib_slide_button_text_2_' . $i => array(
                    'selector' => '.slider-list li:nth-child(' . $i . ') .smartlib-slider-content .btn-primary',
                    'render_callback' => function ($i) {
                        return get_theme_mod('smartlib_slide_button_text_2_' . $i);
                    },
                ),

            ),
        ));

        Kirki::add_field('smartlib_slide_button_url_2_' . $i, array(
            'type' => 'text',
            'setting' => 'smartlib_slide_button_url_2_' . $i,
            'label' => __('Slide', 'bootframe-core') . ' ' . $i . ': ' . __('Slide', 'bootframe-core') . ' ' . $i . ': ' . __('Button #2 URL', 'bootframe-core'),
            'section' => 'homepage_theme_slider_section',
            'active_callback' => array(
                array(
                    'setting' => 'homepage_theme_slider_section_display',
                    'operator' => '==',
                    'value' => '1',
                ),
            ),
            'priority' => $i,
        ));

        Kirki::add_field('smartlib_slider_customizer_separator_' . $i, array(
            'type' => 'separator',
            'settings' => 'smartlib_slider_customizer_separator_' . $i,
            'section' => 'homepage_theme_slider_section',
            'active_callback' => array(
                array(
                    'setting' => 'homepage_theme_slider_section_display',
                    'operator' => '==',
                    'value' => '1',
                ),
            ),
            'priority' => $i,
        ));


    }

    /**
     * Add Services Section
     */

    Kirki::add_section('homepage_theme_services_section', array(
        'title' => __('Services Section', 'bootframe-core'),
        'panel' => 'homepage_theme_panel', // Not typically needed.
        'priority' => 160,
        'capability' => 'edit_theme_options',
    ));

    Kirki::add_field('homepage_theme_services_section_display', array(
        'type' => 'toggle',
        'settings' => 'homepage_theme_services_section_display',
        'label' => __('Display Services Section', 'bootframe-core'),
        'section' => 'homepage_theme_services_section',
        'default' => '1',
        'priority' => 0,
    ));

    Kirki::add_field('smartlib_services_section_title', array(
            'type' => 'text',
            'setting' => 'smartlib_services_section_title',
            'label' => __('Section Title', 'bootframe-core'),
            'section' => 'homepage_theme_services_section',
            'description' => __('Change title of the section', 'bootframe-core'),
            'default' => __('Our Services', 'bootframe-core'),
            'active_callback' => array(
                array(
                    'setting' => 'homepage_theme_services_section_display',
                    'operator' => '==',
                    'value' => '1',
                ),
            ),
            'partial_refresh' => array(
                'smartlib_services_section_title' => array(
                    'selector' => '.smartlib-services-section .smartlib-section-header .smartlib-header-small',
                    'render_callback' => function () {
                        return get_theme_mod('smartlib_services_section_title');
                    },
                ),

            ),
            'priority' => 0)
    );

    /**
     * Add Services Boxes Repater
     */

    Kirki::add_field('smartlib_service_box', array(
        'type' => 'repeater',
        'label' => esc_attr__('Boxes with services', 'bootframe-core'),
        'section' => 'homepage_theme_services_section',
        'priority' => 10,
        'row_label' => array(
            'type' => 'field',
            'value' => esc_attr__('new box', 'bootframe-core'),
            'field' => 'smartlib_service_box_title',
        ),

        'settings' => 'smartlib_service_box',
        'active_callback' => array(
            array(
                'setting' => 'homepage_theme_services_section_display',
                'operator' => '==',
                'value' => '1',
            ),
        ),


        'default' => $default_settings['homepage']['sections']['services_section'],
        'fields' => array(
            'smartlib_service_box_title' => array(
                'type' => 'text',
                'label' => esc_attr__('Name of service', 'bootframe-core'),

                'default' => '',


            ),
            'smartlib_service_box_image' => array(
                'type' => 'image',
                'label' => esc_attr__('Image of the service', 'bootframe-core'),

                'default' => '',
            ),

            'smartlib_service_box_text' => array(
                'type' => 'text',
                'label' => esc_attr__('Describe of service', 'bootframe-core'),

                'default' => '',
            ),

            'smartlib_service_box_button_label' => array(
                'type' => 'text',
                'label' => esc_attr__('Button Label', 'bootframe-core'),

                'default' => '',
            ),

            'smartlib_service_box_button_url' => array(
                'type' => 'text',
                'label' => esc_attr__('Button URL', 'bootframe-core'),

                'default' => '',
            ),
        )


    )



    );


    /*
     * Add Last posts section
     */


    Kirki::add_section('homepage_theme_last_posts_section', array(
        'title' => __('Last Posts Section', 'bootframe-core'),
        'panel' => 'homepage_theme_panel', // Not typically needed.
        'priority' => 160,
        'capability' => 'edit_theme_options',
    ));


    Kirki::add_field('homepage_theme_last_posts_section_display', array(
        'type' => 'toggle',
        'settings' => 'homepage_theme_last_posts_section_display',
        'label' => __('Display Latest Post Section', 'bootframe-core'),
        'section' => 'homepage_theme_last_posts_section',
        'default' => '1',
        'priority' => 0,
    ));

    Kirki::add_field('smartlib_latest_posts_section_title', array(
            'type' => 'text',
            'setting' => 'smartlib_latest_posts_section_title',
            'label' => __('Section Title', 'bootframe-core'),
            'section' => 'homepage_theme_last_posts_section',
            'description' => __('Change title of the section', 'bootframe-core'),
            'default' => __('Latest Posts', 'bootframe-core'),
            'partial_refresh' => array(
                'smartlib_latest_posts_section_title' => array(
                    'selector' => '.smartlib-latest-posts-section .smartlib-section-header .smartlib-header-small',
                    'render_callback' => function () {
                        return get_theme_mod('smartlib_latest_posts_section_title');
                    },
                ),

            ),
            'active_callback' => array(
                array(
                    'setting' => 'homepage_theme_last_posts_section_display',
                    'operator' => '==',
                    'value' => '1',
                ),
            ),
            'priority' => 0)
    );


    /**
     * Front Page About Us Section / Custom Section
     */

    Kirki::add_section('homepage_theme_custom_page_section', array(
        'title' => __('About Us Section', 'bootframe-core'),
        'panel' => 'homepage_theme_panel', // Not typically needed.
        'priority' => 160,
        'capability' => 'edit_theme_options',
    ));

    Kirki::add_field('homepage_theme_custom_page_section_display', array(
        'type' => 'toggle',
        'settings' => 'homepage_theme_custom_page_section_display',
        'label' => __('Display About Us', 'bootframe-core'),
        'section' => 'homepage_theme_custom_page_section',
        'default' => '1',
        'priority' => 0,
    ));

    Kirki::add_field('homepage_theme_custom_page_section_title', array(
        'type' => 'text',
        'settings' => 'homepage_theme_custom_page_section_title',
        'label' => __('Section Title', 'bootframe-core'),
        'section' => 'homepage_theme_custom_page_section',
        'default' => $default_settings['homepage']['sections']['about_us_section']['about_us_section_title'],
        'priority' => 10,
        'partial_refresh' => array(
            'homepage_theme_custom_page_section_title' => array(
                'selector' => '.smartlib-about-us-section .smartlib-section-header h2',
                'render_callback' => function () {
                    return get_theme_mod('homepage_theme_custom_page_section_title');
                },
            ),

        ),
        'active_callback' => array(
            array(
                'setting' => 'homepage_theme_custom_page_section_display',
                'operator' => '==',
                'value' => '1',
            ),
        ),
    ));

    Kirki::add_field('homepage_theme_custom_page_section_page_id', array(
        'type' => 'dropdown-pages',
        'settings' => 'homepage_theme_custom_page_section_page_id',
        'label' => __('Select a page from the list', 'bootframe-core'),
        'section' => 'homepage_theme_custom_page_section',
        'default' => $default_settings['homepage']['sections']['about_us_section']['about_us_page_id'],
        'partial_refresh' => array(
            'homepage_theme_custom_page_section_page_id' => array(
                'selector' => '.smartlib-about-us-section .smartlib-section-content',
                'render_callback' => function () {
                    return get_theme_mod('homepage_theme_custom_page_section_page_id');
                },
            ),

        ),
        'active_callback' => array(
            array(
                'setting' => 'homepage_theme_custom_page_section_display',
                'operator' => '==',
                'value' => '1',
            ),
        ),
        'priority' => 10,
    ));

    Kirki::add_field('homepage_theme_custom_page_section_image', array(
        'type' => 'image',
        'settings' => 'homepage_theme_custom_page_section_image',
        'label' => __('Image', 'bootframe-core'),

        'section' => 'homepage_theme_custom_page_section',
        'default' => $default_settings['homepage']['sections']['about_us_section']['about_us_image'],
        'partial_refresh' => array(
            'homepage_theme_custom_page_section_image' => array(
                'selector' => '.smartlib-about-us-section .smartlib-image-column',
                'render_callback' => function () {
                    return get_theme_mod('homepage_theme_custom_page_section_image');
                },
            ),

        ),
        'active_callback' => array(
            array(
                'setting' => 'homepage_theme_custom_page_section_display',
                'operator' => '==',
                'value' => '1',
            ),
        ),
        'priority' => 10,
    ));

    Kirki::add_field('homepage_theme_custom_page_section_background', array(
        'type' => 'color',
        'settings' => 'homepage_theme_custom_page_section_background',
        'label' => __('Background Color', 'bootframe-core'),
        'section' => 'homepage_theme_custom_page_section',
        'default' => $default_settings['homepage']['sections']['about_us_section']['about_us_background'],
        'priority' => 10,
        'active_callback' => array(
            array(
                'setting' => 'homepage_theme_custom_page_section_display',
                'operator' => '==',
                'value' => '1',
            ),
        ),

    ));


    /**
     * Front Page Call to Action Section
     */

    Kirki::add_section('homepage_theme_call_to_action_section', array(
        'title' => __('Call to Action Section', 'bootframe-core'),
        'panel' => 'homepage_theme_panel', // Not typically needed.
        'priority' => 160,
        'capability' => 'edit_theme_options',
    ));

    Kirki::add_field('homepage_theme_call_to_action_section_display', array(
        'type' => 'toggle',
        'settings' => 'homepage_theme_call_to_action_section_display',
        'label' => __('Display Call to Action', 'bootframe-core'),
        'section' => 'homepage_theme_call_to_action_section',
        'default' => '1',
        'priority' => 0,
    ));

    Kirki::add_field('homepage_theme_call_to_action_section_title', array(
        'type' => 'text',
        'settings' => 'homepage_theme_call_to_action_section_title',
        'label' => __('Section Title', 'bootframe-core'),
        'section' => 'homepage_theme_call_to_action_section',
        'default' => $default_settings['homepage']['sections']['call_to_action_section']['call_to_action_title'],
        'priority' => 10,
        'partial_refresh' => array(
            'homepage_theme_call_to_action_section_title' => array(
                'selector' => '.smartlib-call-to-action-box .smartlib-call-to-action-title',
                'render_callback' => function () {
                    return get_theme_mod('homepage_theme_call_to_action_section_title');
                },
            ),

        ),
        'active_callback' => array(
            array(
                'setting' => 'homepage_theme_call_to_action_section_display',
                'operator' => '==',
                'value' => '1',
            ),
        ),
    ));

    Kirki::add_field('homepage_theme_call_to_action_section_content', array(
        'type' => 'textarea',
        'settings' => 'homepage_theme_call_to_action_section_content',
        'label' => __('Section Content', 'bootframe-core'),
        'section' => 'homepage_theme_call_to_action_section',
        'default' => $default_settings['homepage']['sections']['call_to_action_section']['call_to_action_content'],
        'priority' => 10,
        'partial_refresh' => array(
            'homepage_theme_call_to_action_section_content' => array(
                'selector' => '.smartlib-call-to-action-box .smartlib-call-to-action-content',
                'render_callback' => function () {
                    return get_theme_mod('homepage_theme_call_to_action_section_content');
                },
            ),

        ),
        'active_callback' => array(
            array(
                'setting' => 'homepage_theme_call_to_action_section_display',
                'operator' => '==',
                'value' => '1',
            ),
        ),
    ));

    Kirki::add_field('homepage_theme_call_to_action_section_button_label', array(
        'type' => 'text',
        'settings' => 'homepage_theme_call_to_action_section_button_label',
        'label' => __('Button Label', 'bootframe-core'),
        'section' => 'homepage_theme_call_to_action_section',
        'default' => $default_settings['homepage']['sections']['call_to_action_section']['call_to_action_button_label'],
        'priority' => 10,
        'partial_refresh' => array(
            'homepage_theme_call_to_action_section_button_label' => array(
                'selector' => '.smartlib-call-to-action-box .btn-lg',
                'render_callback' => function () {
                    return get_theme_mod('homepage_theme_call_to_action_section_button_label');
                },
            ),

        ),
        'active_callback' => array(
            array(
                'setting' => 'homepage_theme_call_to_action_section_display',
                'operator' => '==',
                'value' => '1',
            ),
        ),
    ));

    Kirki::add_field('homepage_theme_call_to_action_section_button_link', array(
        'type' => 'text',
        'settings' => 'homepage_theme_call_to_action_section_button_link',
        'label' => __('Button Link', 'bootframe-core'),
        'description' => __('Paste URL', 'bootframe-core'),
        'section' => 'homepage_theme_call_to_action_section',
        'default' => $default_settings['homepage']['sections']['call_to_action_section']['call_to_action_button_link'],
        'priority' => 10,

        'active_callback' => array(
            array(
                'setting' => 'homepage_theme_call_to_action_section_display',
                'operator' => '==',
                'value' => '1',
            ),
        ),
    ));


    Kirki::add_field('homepage_theme_call_to_action_section_background_image', array(
        'type' => 'image',
        'settings' => 'homepage_theme_call_to_action_section_background_image',
        'label' => __('Background Image', 'bootframe-core'),

        'section' => 'homepage_theme_call_to_action_section',
        'default' => $default_settings['homepage']['sections']['call_to_action_section']['call_to_action_background_image'],

        'active_callback' => array(
            array(
                'setting' => 'homepage_theme_call_to_action_section_display',
                'operator' => '==',
                'value' => '1',
            ),
        ),
        'priority' => 10,
    ));

    Kirki::add_field('homepage_theme_call_to_action_section_background_color', array(
        'type' => 'color',
        'settings' => 'homepage_theme_call_to_action_section_background_color',
        'label' => __('Overlay Background Color', 'bootframe-core'),
        'section' => 'homepage_theme_call_to_action_section',
        'default' => $default_settings['homepage']['sections']['call_to_action_section']['call_to_action_background_color'],
        'priority' => 10,
        'choices' => array(
            'alpha' => true,
        ),
        'active_callback' => array(
            array(
                'setting' => 'homepage_theme_call_to_action_section_display',
                'operator' => '==',
                'value' => '1',
            ),
        ),

    ));

    /*
     * Add Portfolio section
     */


    Kirki::add_section('homepage_theme_portfolio_section', array(
        'title' => __('Portfolio Section', 'bootframe-core'),
        'panel' => 'homepage_theme_panel', // Not typically needed.
        'priority' => 160,
        'capability' => 'edit_theme_options',
    ));


    Kirki::add_field('homepage_theme_portfolio_section_display', array(
        'type' => 'toggle',
        'settings' => 'homepage_theme_portfolio_section_display',
        'label' => __('Display Portfolio Section', 'bootframe-core'),
        'section' => 'homepage_theme_portfolio_section',
        'default' => '1',
        'priority' => 0,
    ));

    Kirki::add_field('smartlib_portfolio_section_title', array(
            'type' => 'text',
            'setting' => 'smartlib_portfolio_section_title',
            'label' => __('Section Title', 'bootframe-core'),
            'section' => 'homepage_theme_portfolio_section',
            'description' => __('Change title of the section', 'bootframe-core'),
            'default' => $default_settings['homepage']['sections']['portfolio_section']['portfolio_title'],
            'partial_refresh' => array(
                'smartlib_portfolio_section_title' => array(
                    'selector' => '.smartlib-portfolio-section .smartlib-section-header h2',
                    'render_callback' => function () {
                        return get_theme_mod('smartlib_portfolio_section_title');
                    },
                ),

            ),
            'active_callback' => array(
                array(
                    'setting' => 'homepage_theme_portfolio_section_display',
                    'operator' => '==',
                    'value' => '1',
                ),
            ),
            'priority' => 0)
    );

    Kirki::add_field('smartlib_portfolio_section_limit', array(
        'type' => 'number',
        'settings' => 'smartlib_portfolio_section_limit',
        'label' => esc_attr__('Number of columns', 'bootframe-core'),
        'section' => 'homepage_theme_portfolio_section',
        'default' => $default_settings['homepage']['sections']['portfolio_section']['portfolio_number'],
        'choices' => array(
            'min' => 1,
            'max' => 8,
            'step' => 1,
        ),
        'active_callback' => array(
            array(
                'setting' => 'homepage_theme_portfolio_section_display',
                'operator' => '==',
                'value' => '1',
            ),
        ),



    ));

    Kirki::add_field('smartlib_portfolio_section_taxonomy', array(
        'type' => 'select',
        'settings' => 'smartlib_portfolio_section_taxonomy',

        'section' => 'homepage_theme_portfolio_section',
        'default' => 'all',
        'priority' => 10,
        'multiple' => 0,
        'choices' => __SMARTLIB_HELPERS::get_portfolio_categories_array(),
        'active_callback' => array(
            array(
                'setting' => 'homepage_theme_portfolio_section_display',
                'operator' => '==',
                'value' => '1',
            ),
        ),
    ));

    Kirki::add_field('smartlib_portfolio_section_background_color', array(
        'type' => 'color',
        'settings' => 'smartlib_portfolio_section_background_color',
        'label' => __('Background Color', 'bootframe-core'),
        'section' => 'homepage_theme_portfolio_section',
        'default' => $default_settings['homepage']['sections']['portfolio_section']['portfolio_background'],
        'priority' => 10,

        'active_callback' => array(
            array(
                'setting' => 'homepage_theme_portfolio_section_display',
                'operator' => '==',
                'value' => '1',
            ),
        ),

    ));

    /*
    * Add Contact section
    */
    Kirki::add_section('homepage_theme_contact_section', array(
        'title' => __('Contact Section', 'bootframe-core'),
        'panel' => 'homepage_theme_panel', // Not typically needed.
        'priority' => 160,
        'capability' => 'edit_theme_options',
    ));


    Kirki::add_field('homepage_theme_contact_section_display', array(
        'type' => 'toggle',
        'settings' => 'homepage_theme_contact_section_display',
        'label' => __('Contact Section', 'bootframe-core'),
        'section' => 'homepage_theme_contact_section',
        'default' => '1',
        'priority' => 0,
    ));


    Kirki::add_field('homepage_theme_contact_section_title', array(
        'type' => 'text',
        'settings' => 'homepage_theme_contact_section_title',
        'label' => __('Section Title', 'bootframe-core'),
        'section' => 'homepage_theme_contact_section',
        'default' => $default_settings['homepage']['sections']['contact_section']['contact_title'],
        'priority' => 10,
        'partial_refresh' => array(
            'homepage_theme_contact_section_title' => array(
                'selector' => '.smartlib-contact-section .smartlib-widget-header h3',
                'render_callback' => function () {
                    return get_theme_mod('homepage_theme_contact_section_title');
                },
            ),

        ),
        'active_callback' => array(
            array(
                'setting' => 'homepage_theme_contact_section_display',
                'operator' => '==',
                'value' => '1',
            ),
        ),
    ));

    Kirki::add_field('homepage_theme_contact_section_form', array(
        'type' => 'select',
        'settings' => 'homepage_theme_contact_section_form',
        'label' => __('Select a Form', 'bootframe-core'),
        'section' => 'homepage_theme_contact_section',
        'description' => __('Contact Form 7 Plugin  is needed', 'bootframe-core'),
        'priority' => 10,
        'multiple' => 0,
        'choices' => __SMARTLIB_HELPERS::get_custom_posts_array('wpcf7_contact_form'),
        'active_callback' => array(
            array(
                'setting' => 'homepage_theme_contact_section_display',
                'operator' => '==',
                'value' => '1',
            ),
        ),

    ));


    Kirki::add_field('homepage_theme_contact_section_map', array(
        'type' => 'textarea',
        'settings' => 'homepage_theme_contact_section_map',
        'label' => __('Map', 'bootframe-core'),
        'description' => __('Paste iframe map', 'bootframe-core'),
        'section' => 'homepage_theme_contact_section',
        'default' => $default_settings['homepage']['sections']['contact_section']['contact_map'],
        'priority' => 10,
        'sanitize_callback' => function ($iframe) {
            return $iframe;
        },
        'partial_refresh' => array(
            'homepage_theme_contact_section_map' => array(
                'selector' => '.smartlib-contact-section .smartlib-contact-iframe-map',
                'render_callback' => function () {
                    return get_theme_mod('homepage_theme_contact_section_map');
                },
            ),

        ),
        'active_callback' => array(
            array(
                'setting' => 'homepage_theme_contact_section_display',
                'operator' => '==',
                'value' => '1',
            ),
        ),
    ));

    Kirki::add_field('smartlib_contact_section_background_color', array(
        'type' => 'color',
        'settings' => 'smartlib_contact_section_background_color',
        'label' => __('Background Color', 'bootframe-core'),
        'section' => 'homepage_theme_contact_section',
        'default' => $default_settings['homepage']['sections']['contact_section']['contact_background'],
        'priority' => 10,

        'active_callback' => array(
            array(
                'setting' => 'homepage_theme_contact_section_display',
                'operator' => '==',
                'value' => '1',
            ),
        ),

    ));

    /*
    * Add Our Clients section
    */


    Kirki::add_section('homepage_theme_our_clients_section', array(
        'title' => __('Our Clients', 'bootframe-core'),
        'panel' => 'homepage_theme_panel', // Not typically needed.
        'priority' => 160,
        'capability' => 'edit_theme_options',
    ));

    Kirki::add_field('homepage_theme_our_clients_section_display', array(
        'type' => 'toggle',
        'settings' => 'homepage_theme_our_clients_section_display',
        'label' => __('Display Our Clients Section', 'bootframe-core'),
        'section' => 'homepage_theme_our_clients_section',
        'default' => '1',
        'priority' => 0,
    ));

    Kirki::add_field('smartlib_our_clients_section_title', array(
            'type' => 'text',
            'setting' => 'smartlib_our_clients_section_title',
            'label' => __('Section Title', 'bootframe-core'),
            'section' => 'homepage_theme_our_clients_section',
            'description' => __('Change title of the section', 'bootframe-core'),
            'default' => __('Our Clients', 'bootframe-core'),
            'active_callback' => array(
                array(
                    'setting' => 'homepage_theme_our_clients_section_display',
                    'operator' => '==',
                    'value' => '1',
                ),
            ),
            'priority' => 0,
            'partial_refresh' => array(
                'smartlib_our_clients_section_title' => array(
                    'selector' => '.smartlib-our-clients-section .smartlib-section-header h2',
                    'render_callback' => function () {
                        return get_theme_mod('homepage_theme_contact_section_map');
                    },
                ),

            ),

        )
    );

    /**
     * Add Services Boxes Repater
     */

    Kirki::add_field('smartlib_our_clients_box', array(
        'type' => 'repeater',
        'label' => esc_attr__('Boxes with clients logo', 'bootframe-core'),
        'section' => 'homepage_theme_our_clients_section',
        'priority' => 10,
        'row_label' => array(
            'type' => 'text',
            'value' => esc_attr__('Logo', 'bootframe-core'),

        ),


        'settings' => 'smartlib_our_clients_box',
        'active_callback' => array(
            array(
                'setting' => 'homepage_theme_our_clients_section_display',
                'operator' => '==',
                'value' => '1',
            ),
        ),






        'default' => $default_settings['homepage']['sections']['our_clients_section']['boxes'],
        'fields' => array(
            'box_image' => array(
                'type' => 'image',
                'label' => esc_attr__('Clients logo', 'bootframe-core'),

                'default' => '',
            ),
            'box_link' => array(
                'type' => 'text',
                'label' => esc_attr__('Link', 'bootframe-core'),

                'default' => '',

            ),

        )
    )
    );

    Kirki::add_field('smartlib_our_clients_section_background_color', array(
        'type' => 'color',
        'settings' => 'smartlib_our_clients_section_background_color',
        'label' => __('Background Color', 'bootframe-core'),
        'section' => 'homepage_theme_our_clients_section',
        'default' => $default_settings['homepage']['sections']['our_clients_section']['section_background'],
        'priority' => 10,

        'active_callback' => array(
            array(
                'setting' => 'homepage_theme_our_clients_section_display',
                'operator' => '==',
                'value' => '1',
            ),
        ),

    ));


    /*
* Add Counter section
*/


    Kirki::add_section('homepage_theme_counter_section', array(
        'title' => __('Counter Section', 'bootframe-core'),
        'panel' => 'homepage_theme_panel', // Not typically needed.
        'priority' => 160,
        'capability' => 'edit_theme_options',
    ));

    Kirki::add_field('homepage_theme_counter_section_display', array(
        'type' => 'toggle',
        'settings' => 'homepage_theme_counter_section_display',
        'label' => __('Display Counter Section', 'bootframe-core'),
        'section' => 'homepage_theme_counter_section',
        'default' => '1',
        'priority' => 0,
    ));

    Kirki::add_field('smartlib_counter_section_title', array(
            'type' => 'text',
            'setting' => 'smartlib_counter_section_title',
            'label' => __('Section Title', 'bootframe-core'),
            'section' => 'homepage_theme_counter_section',
            'description' => __('Change title of the section', 'bootframe-core'),
            'default' => $default_settings['homepage']['sections']['counter_section']['counter_title'],
            'active_callback' => array(
                array(
                    'setting' => 'homepage_theme_counter_section_display',
                    'operator' => '==',
                    'value' => '1',
                ),
            ),
            'priority' => 0,
            'partial_refresh' => array(
                'smartlib_counter_section_title' => array(
                    'selector' => '.smartlib-counter-section .smartlib-section-header h2',
                    'render_callback' => function () {
                        return get_theme_mod('smartlib_counter_section_title');
                    },
                ),

            ),

        )
    );

    /**
     * Add Counter Repater
     */

    Kirki::add_field('smartlib_counter_box', array(
            'type' => 'repeater',
            'label' => esc_attr__('Counter Boxes', 'bootframe-core'),
            'section' => 'homepage_theme_counter_section',
            'priority' => 10,
            'row_label' => array(
                'type' => 'field',
                'value' => esc_attr__('Counter box', 'bootframe-core'),
                'field' => 'number_label',
            ),


            'settings' => 'smartlib_counter_box',
            'active_callback' => array(
                array(
                    'setting' => 'homepage_theme_counter_section_display',
                    'operator' => '==',
                    'value' => '1',
                ),
            ),



            'default' => $default_settings['homepage']['sections']['counter_section']['boxes'],
            'fields' => array(
                'number_label' => array(
                    'type' => 'text',
                    'label' => esc_attr__('Label', 'bootframe-core'),

                    'default' => '',
                ),
                'number' => array(
                    'type' => 'text',
                    'label' => esc_attr__('Number', 'bootframe-core'),

                    'default' => 1,

                ),

            )
        )
    );

    Kirki::add_field('homepage_theme_counter_section_background_image', array(
        'type' => 'image',
        'settings' => 'homepage_theme_counter_section_background_image',
        'label' => __('Background Image', 'bootframe-core'),

        'section' => 'homepage_theme_counter_section',
        'default' => $default_settings['homepage']['sections']['counter_section']['counter_background_image'],

        'active_callback' => array(
            array(
                'setting' => 'homepage_theme_counter_section_display',
                'operator' => '==',
                'value' => '1',
            ),
        ),
        'priority' => 10,
    ));

    Kirki::add_field('smartlib_counter_section_background_color', array(
        'type' => 'color',
        'settings' => 'smartlib_counter_section_background_color',
        'label' => __('Background Color', 'bootframe-core'),
        'section' => 'homepage_theme_counter_section',
        'default' => $default_settings['homepage']['sections']['counter_section']['section_background'],
        'priority' => 10,

        'active_callback' => array(
            array(
                'setting' => 'homepage_theme_counter_section_display',
                'operator' => '==',
                'value' => '1',
            ),
        ),

    ));



    /*
* Add Feature icons section
*/


    Kirki::add_section('homepage_theme_feature_icons_section', array(
        'title' => __('Feature Icons Section', 'bootframe-core'),
        'panel' => 'homepage_theme_panel', // Not typically needed.
        'priority' => 160,
        'capability' => 'edit_theme_options',
    ));

    Kirki::add_field('homepage_theme_feature_icons_section_display', array(
        'type' => 'toggle',
        'settings' => 'homepage_theme_feature_icons_section_display',
        'label' => __('Display Feature Icons Section', 'bootframe-core'),
        'section' => 'homepage_theme_feature_icons_section',
        'default' => '1',
        'priority' => 0,
    ));

    Kirki::add_field('smartlib_feature_icons_section_title', array(
            'type' => 'text',
            'setting' => 'smartlib_feature_icons_section_title',
            'label' => __('Section Title', 'bootframe-core'),
            'section' => 'homepage_theme_feature_icons_section',
            'description' => __('Change title of the section', 'bootframe-core'),
            'default' => $default_settings['homepage']['sections']['features_icons_section']['features_icons_title'],
            'active_callback' => array(
                array(
                    'setting' => 'homepage_theme_feature_icons_section_display',
                    'operator' => '==',
                    'value' => '1',
                ),
            ),
            'priority' => 0,
            'partial_refresh' => array(
                'smartlib_feature_icons_section_title' => array(
                    'selector' => '.smartlib-features-icons-section .smartlib-header-small',
                    'render_callback' => function () {
                        return get_theme_mod('smartlib_feature_icons_section_title');
                    },
                ),

            ),

        )
    );

    /**
     * Add feature_icons Repater
     */



    Kirki::add_field('smartlib_feature_icons_box', array(
            'type' => 'repeater',
            'label' => esc_attr__('Feature icons box', 'bootframe-core'),
            'section' => 'homepage_theme_feature_icons_section',
            'priority' => 10,
            'row_label' => array(
                'type' => 'field',
                'value' => esc_attr__('Icon box', 'bootframe-core'),
                'field' => 'box_title',
            ),


            'settings' => 'smartlib_feature_icons_box',
            'active_callback' => array(
                array(
                    'setting' => 'homepage_theme_feature_icons_section_display',
                    'operator' => '==',
                    'value' => '1',
                ),
            ),



            'default' => $default_settings['homepage']['sections']['features_icons_section']['boxes'],
            'fields' => array(
                'box_title' => array(

                    'type' => 'text',
                    'label' => esc_attr__('Box Title', 'bootframe-core'),

                ),

                'box_icon' => array(

                    'type' => 'select',
                    'label' => esc_attr__('Box Icon', 'bootframe-core'),
                    'choices' => __SMARTLIB_HELPERS::get_font_icons_select()

                ),

                'box_description' => array(

                    'type' => 'text',
                    'label' => esc_attr__('Box Description', 'bootframe-core'),

                ),

            )
        )

    );

    Kirki::add_field('smartlib_feature_icons_section_background', array(
        'type' => 'color',
        'settings' => 'smartlib_feature_icons_section_background',
        'label' => __('Background Color', 'bootframe-core'),
        'section' => 'homepage_theme_feature_icons_section',
        'default' => $default_settings['homepage']['sections']['features_icons_section']['section_background'],
        'priority' => 10,

        'active_callback' => array(
            array(
                'setting' => 'homepage_theme_feature_icons_section_display',
                'operator' => '==',
                'value' => '1',
            ),
        ),

    ));


    /*
     * Testimonials posts section
     */


    Kirki::add_section('homepage_theme_testimonials_section', array(
        'title' => __('Testimonials Section', 'bootframe-core'),
        'panel' => 'homepage_theme_panel', // Not typically needed.
        'priority' => 160,
        'capability' => 'edit_theme_options',
    ));


    Kirki::add_field('homepage_theme_testimonials_section_display', array(
        'type' => 'toggle',
        'settings' => 'homepage_theme_testimonials_section_display',
        'label' => __('Display Testimonials Section', 'bootframe-core'),
        'section' => 'homepage_theme_testimonials_section',
        'default' => '1',
        'priority' => 0,
    ));

    Kirki::add_field('smartlib_testimonials_section_title', array(
            'type' => 'text',
            'setting' => 'smartlib_testimonials_section_title',
            'label' => __('Section Title', 'bootframe-core'),
            'section' => 'homepage_theme_testimonials_section',
            'description' => __('Change title of the section', 'bootframe-core'),
            'default' => __('Testimonials', 'bootframe-core'),
            'partial_refresh' => array(
                'smartlib_testimonials_section_title' => array(
                    'selector' => '.smartlib-testimonials-section .panel-heading h3',
                    'render_callback' => function () {
                        return get_theme_mod('smartlib_testimonials_section_title');
                    },
                ),

            ),
            'active_callback' => array(
                array(
                    'setting' => 'homepage_theme_testimonials_section_display',
                    'operator' => '==',
                    'value' => '1',
                ),
            ),
            'priority' => 0)
    );




    /**
     * Front Page Sections Order
     */

    Kirki::add_section('homepage_theme_sections_order', array(
        'title' => __('Front Page Sections Order', 'bootframe-core'),
        'panel' => 'homepage_theme_panel', // Not typically needed.
        'priority' => 160,
        'capability' => 'edit_theme_options',
    ));


    Kirki::add_field('sections_order', array(
        'type' => 'sortable',
        'settings' => 'homepage_theme_sections_order',
        'label' => __('Sections Order', 'bootframe-core'),
        'section' => 'homepage_theme_sections_order',
        'default' => $default_home_sections_order,
        'choices' => array(
            'homepage_theme_slider_section' => esc_attr__('Slider Section', 'bootframe-core'),
            'homepage_theme_services_section' => esc_attr__('Services Section', 'bootframe-core'),
            'homepage_theme_last_posts_section' => esc_attr__('Last Posts Section', 'bootframe-core'),
            'homepage_theme_custom_page_section' => esc_attr__('About Us Section', 'bootframe-core'),
            'homepage_theme_call_to_action_section' => esc_attr__('Call to Action Section', 'bootframe-core'),
            'homepage_theme_portfolio_section' => esc_attr__('Portfolio Section', 'bootframe-core'),
            'homepage_theme_contact_section'=> esc_attr__('Contact Section', 'bootframe-core'),
            'homepage_theme_our_clients_section'=> esc_attr__('Our Clients Section', 'bootframe-core'),
            'homepage_theme_counter_section'=> esc_attr__('Counter Section', 'bootframe-core'),
            'homepage_theme_feature_icons_section'=> esc_attr__('Feature Icons Section', 'bootframe-core'),
            'homepage_theme_testimonials_section'=> esc_attr__('Testimonials Section', 'bootframe-core'),



        ),
        'priority' => 10,
    ));



});
