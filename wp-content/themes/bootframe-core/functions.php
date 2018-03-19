<?php

// Load Smart Library

/**
 * Load Smart Library
 */
require_once locate_template('/smart-lib/load.php' );
require_once locate_template('/smart-lib/init.php');
require_once locate_template('/smart-lib/classes/smartlib-factory.php');
require_once locate_template('/smart-lib/activation.php');//Theme activation page


/**
 * Initialize Smartlib Library
 */

__SMARTLIB::init();

//Load Libraries that needs __SMARTLIB::init();

require_once locate_template('/smart-lib/smartlib-customizer-kirki-options.php' );


/**
 * Sets up theme defaults and registers the various WordPress features
 */

function smartlib_setup()
{


    /**
     * Load textdomain.
     */

    load_theme_textdomain('bootframe-core', get_template_directory() . '/languages');


    /**
     * editor-style.css to match the theme style
     */
    add_editor_style();

    /**
     * Set the default content width.
     */
    $GLOBALS['content_width'] = 1200;


    /**
     * Register nav menus
     */

    if (count(__SMARTLIB::config()->project_menus) > 0) {
        foreach (__SMARTLIB::config()->project_menus as $id => $name) {
            register_nav_menu($id, $name);
        }
    }

    /**
     * register sidebars form config class
     */


    if (count(__SMARTLIB::config()->project_sidebars) > 0) {
        foreach (__SMARTLIB::config()->project_sidebars as $id => $sidebar) {
            $args = array(
                'name' => $sidebar['name'],
                'id' => $id,
                'description' => $sidebar['description'],
                'before_widget' => $sidebar['before_widget'],
                'after_widget' => $sidebar['after_widget'],
                'before_title' => $sidebar['before_title'],
                'after_title' => $sidebar['after_title']
            );
            register_sidebar($args);
        }
    }


    /**
     * Add thumbnail support
     */

    add_theme_support('post-thumbnails');

    set_post_thumbnail_size(624, 9999); // Unlimited height, soft crop
    add_image_size('smartlib-small-square', 100, 100, true);
    add_image_size('smartlib-medium-square', 200, 200, true);
    add_image_size('smartlib-medium-thumb', 250, 180, true);
    add_image_size('smartlib-large-thumb', 500, 400, true);
    add_image_size('smartlib-medium-image-portfolio', 800, 500, true);
    add_image_size('smartlib-content-wide', 1000, 520, true);
    add_image_size('smartlib-content-medium', 350, 250, true);
    add_image_size('col-sm-square', 350, 350, true);

    /**
     * Header image support
     */

    $args = array(
        'width'         => 1200,
        'height'        => 280,
        'default-image' => get_template_directory_uri() . '/assets/img/slider/slide3.jpg',
    );
    add_theme_support( 'custom-header', $args );

    /**
     * Add title tag support
     */
    add_theme_support('title-tag');

    /**
     * WooCommerce support
     */
    add_theme_support('woocommerce');

    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );

    /**
     * Custom background
     */
    add_theme_support('custom-background', array(
        'default-color' => 'fff',
    ));

    /**
     * Shortcode support
     */
    add_theme_support('shortcode');


    /**
     * Adds RSS feed links to <head> for posts and comments.
     */
    add_theme_support('automatic-feed-links');

    /**
     * This theme supports a variety of post formats.
     */
    add_theme_support('post-formats', array('aside', 'image', 'link', 'quote', 'status', 'video', 'gallery'));

}

add_action('after_setup_theme', 'smartlib_setup');

function smartlib_get_sidebar($name){

  $name = 'bla';

    return $name;

}

add_action('get_sidebar', 'smartlib_get_sidebar');





