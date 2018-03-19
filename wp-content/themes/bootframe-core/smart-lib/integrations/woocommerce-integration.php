<?php
/**
 * Based on Woocommerce Woowrap Plugin
 * Author: Steve North (62 Design)
 * Author URI: http://62design.co.uk/
 **/

if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {


    add_filter('woocommerce_enqueue_styles', '__return_empty_array');

    /*
     * Remove filters
     */
    remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);

// Container Wrapping
    function before_content()
    {
        echo '';
    }

    add_action('woocommerce_before_main_content', 'before_content', 1);
    function after_content()
    {
        echo '';
    }

    add_action('woocommerce_after_main_content', 'after_content', 20);

    function before_archive_description()
    {
        echo '<div class="col-sm-12">';
    }

    add_action('woocommerce_archive_description', 'before_archive_description', 1);
    add_action('woocommerce_before_shop_loop', 'before_archive_description', 1);
    function after_archive_description()
    {
        echo '</div>';
    }

    add_action('woocommerce_archive_description', 'after_archive_description', 40);
    add_action('woocommerce_before_shop_loop', 'after_archive_description', 40);
    function clearfix_append()
    {
        echo '<div class="clearfix"></div>';
    }


    // Change number or products per row to 3

    add_filter('loop_shop_columns', 'loop_columns');
    if (!function_exists('loop_columns')) {
        function loop_columns()
        {
            return 3; // 3 products per row
        }
    }
}

/**
 * WooCommerce cart button
 */

/**
 * These functions will add WooCmmerce or Easy Digital Downloads cart icons/menu items to the "top_nav" WordPress menu area (if it exists).
 * Please customize the following code to fit your needs.
 */

/**
 * This function adds the WooCommerce or Easy Digital Downloads cart icons/items to the top_nav menu area as the last item.
 */
add_filter('wp_nav_menu_items', 'my_wp_nav_menu_items', 10, 2);
function my_wp_nav_menu_items($items, $args, $ajax = false)
{
    // Top Navigation Area Only
    if ((isset($ajax) && $ajax) || (property_exists($args, 'theme_location') && $args->theme_location === 'main_menu')) {

        $minicart = get_minicart_template_as_variable();


        //Initialize string variable

        $drop_down = '';

        // Get theme options

        $cart_in_menu = get_theme_mod('smartlib_display_cart_button_in_menu', '1');
        $mini_cart = get_theme_mod('smartlib_display_mini_cart_in_menu', '1');


        if (class_exists('woocommerce') && ($cart_in_menu == '1')) {


            $css_class = 'menu-item menu-item-type-cart menu-item-type-woocommerce-cart ';

            if ($mini_cart == '1') {

                $drop_down = 'data-toggle="dropdown"';
            }


            // Is this the cart page?
            if (is_cart())
                $css_class .= ' current-menu-item';
            $items .= '<li class="' . esc_attr($css_class) . '">';
            $items .= '<a class="cart-contents dropdown-toggle" ' . $drop_down . ' href="' . esc_url(WC()->cart->get_cart_url()) . '"><i class="fa fa-shopping-cart fa-lg" aria-hidden="true"></i><small>&nbsp;&nbsp;';
            $items .= wp_kses_data(WC()->cart->get_cart_total()) . '</small>&nbsp;&nbsp;<span class="label label-danger">' . WC()->cart->get_cart_contents_count() . '</span></a>';

            if ($mini_cart == '1') {

                $items .= '<div class="dropdown-menu smartlib-woocomerce-mini-cart" role="menu">' . $minicart . '</div>';

            }

            $items .= '</li>';

        } // Easy Digital Downloads
        else if (class_exists('Easy_Digital_Downloads')) {
            $css_class = 'menu-item menu-item-type-cart menu-item-type-edd-cart';
            // Is this the cart page?
            if (edd_is_checkout())
                $css_class .= ' current-menu-item';
            $items .= '<li class="' . esc_attr($css_class) . '">';
            $items .= '<a class="cart-contents dropdown-toggle" ' . $drop_down . ' href="' . esc_url(edd_get_checkout_uri()) . '"><i class="fa fa-shopping-cart fa-lg" aria-hidden="true"></i><small>&nbsp;&nbsp;';
            $items .= wp_kses_data(edd_cart_subtotal()) . '</small>&nbsp;&nbsp;<span class="label label-danger">' . edd_get_cart_quantity() . '</span></a>';

            if ($mini_cart == '1') {

                $items .= '<div class="dropdown-menu smartlib-woocomerce-mini-cart" role="menu">' . $minicart . '</div>';

            }

            $items .= '</li>';

        }
    }
    return $items;
}

/**
 * This function updates the Top Navigation WooCommerce cart link contents when an item is added via AJAX.
 */
add_filter('woocommerce_add_to_cart_fragments', 'my_woocommerce_add_to_cart_fragments');
function my_woocommerce_add_to_cart_fragments($fragments)
{
    // Add our fragment
    $fragments['li.menu-item-type-woocommerce-cart'] = my_wp_nav_menu_items('', new stdClass(), true);
    return $fragments;
}

/**
 *
 * Return minicart snippet as variable
 * @return string
 */

function get_minicart_template_as_variable()
{

    global $args;

    if (function_exists('wc_get_template')) {




        ob_start();

        woocommerce_mini_cart();

        $minicart = ob_get_contents();

        ob_end_clean();

        return $minicart;
    }
}

/**
 * Adding Bootstrap Forms to WooCommerce
 */

add_filter('woocommerce_form_field_args', 'wc_form_field_args', 10, 3);
function wc_form_field_args($args, $key, $value)
{
    $args['input_class'] = array('form-control');
    return $args;
}
