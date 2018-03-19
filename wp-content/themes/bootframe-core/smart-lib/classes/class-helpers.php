<?php


class __SMARTLIB_HELPERS {


    static function conditional_is_single()
    {
        global $post;
        return is_single();
    }

    static function conditional_is_page()

    {
        global $post;
        return is_page();
    }

    static function conditional_navbar_is_fixed(){
        $option = get_theme_mod('smartlib_fixed_navbar_default', '2');

        if($option=='1'){
            return true;
        }else{
            return false;
        }

    }

    static function active_callback_cart_in_menu(){

        $option = get_theme_mod('smartlib_display_cart_button_in_menu');

        if($option=='1'){
            return true;
        }else{
            return false;
        }

    }

    /**
     * Check if native site icon exists
     * @return bool
     */

    static function conditional_has_site_icon(){

        if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) {

           return true;
        }

        return false;

    }

    static function get_all_pages_array(){

        $post_args = array('post_type' => 'page', 'posts_per_page'=>-1);
        $pages = get_posts($post_args);

        $pages_array= array('' =>__('Expand the list', 'bootframe-core'));

        foreach ($pages as $page) {

            $pages_array[$page->ID] = $page->post_title;

        }

        return $pages_array;

    }

    /**
     * Get array of custom post
     * @param string $post_type
     * @return array
     */

    static function get_custom_posts_array($post_type='post'){

        $post_args = array('post_type' => $post_type, 'posts_per_page'=>-1);
        $pages = get_posts($post_args);

        $pages_array= array();

        foreach ($pages as $page) {

            $pages_array[$page->ID] = $page->post_title;

        }

        return $pages_array;

    }

    /**
     * Get array of portolio items categories
     * @return array
     */

    static function get_portfolio_categories_array(){

        $categories_array = array();


        $categories_array['all'] = __('All', 'bootframe-core');

        if (defined('SMARTLIB_PLUGIN_PATH')) {

            $categories = get_terms( 'portfolio_category');

            if(count($categories)>0){

                foreach ( $categories as $category ) {

                    $categories_array[$category->term_id] = $category->name;

                }


            }


        }



        return $categories_array;

    }

    /**
     * Get categories array for select list
     * @return array
     */

    static function get_categories_array(){

        $categories_array = array();
        $categories = get_categories();

        $categories_array['all'] = __('All', 'bootframe-core');

        foreach ( $categories as $category ) {

            $categories_array[$category->term_id] = $category->cat_name;

        }

        return $categories_array;

    }

    /**
     * Convert Hex Color
     * @param $hex
     * @return string
     */


    static function hex2rgb($hex) {
        $hex = str_replace("#", "", $hex);

        if(strlen($hex) == 3) {
            $r = hexdec(substr($hex,0,1).substr($hex,0,1));
            $g = hexdec(substr($hex,1,1).substr($hex,1,1));
            $b = hexdec(substr($hex,2,1).substr($hex,2,1));
        } else {
            $r = hexdec(substr($hex,0,2));
            $g = hexdec(substr($hex,2,2));
            $b = hexdec(substr($hex,4,2));
        }
        $rgb = "$r, $g, $b";
        //return implode(",", $rgb); // returns the rgb values separated by commas
        return $rgb;
    }

    /**
     * return layout option based on cutomizer and post meta settings
     * @param $type
     * @return int|mixed|string
     */


    static function smartlib_sidebar_layout_variant($type){

        global $post;

        $option = get_theme_mod( 'smartlib_layout_' . $type );

        //get category option
        $cat = get_query_var('cat');

        $cat_extra_data = get_option( 'category_' . $cat );

        $category_variant = isset($cat_extra_data['smartlib_layout_category'])? (int)$cat_extra_data['smartlib_layout_category']:0;



        if(isset($post) && is_singular('page')){

            $option = get_post_meta( $post->ID, 'smartlib_layout_' . $type, true );

        }

        if ( $option  =='' ) {

            $option = get_theme_mod( 'smartlib_layout_default', 1 );

        }

        //if category option = 1 force no sidebar

        if($category_variant ==1){
            $option = 0;
        }

        return (int)$option;

    }

    /**
     * Get Final settings ovveriden by single post / page settings
     * @param $global
     * @param $specific
     * @param string $default_value
     * @param string $setting_type
     * @return array|false|mixed|string
     */
    static function smartlib_get_final_settings($global, $specific, $default_value='', $setting_type=''){

        global $post;

        $post_meta_setting = get_post_meta($post->ID, $specific, true);
        $global_setting = get_theme_mod( $global, $default_value );

        if(strlen($post_meta_setting)>0&&$post_meta_setting !='0'){


            //Include the difference between image settings (meta=ID, theme_mod=path)

            if( $setting_type=='background'){


                $img = wp_get_attachment_image_src($post_meta_setting, 'full');

                return $img[0];

            }

            return $post_meta_setting;

        }else{

            return $global_setting;

        }

    }

    /**
     * Get proper setting based on type parameter
     * @param $setting_prefix
     * @param $type
     * @param int $default
     * @return string
     */

    static function smartlib_get_settings_based_on_type($setting_prefix, $type, $default=0){

        $setting = get_theme_mod( $setting_prefix .'_'.$type, $default);

        if($setting==$default){

            $setting = get_theme_mod( $setting_prefix .'_default', $default);

        }

        return $setting;

    }


    /**
     * Get icons array
     * @return array|bool
     */

    static function get_font_icons_select(){
        $icons = smk_font_awesome( 'readable' );

        /*
         $icons_extend = array();

         foreach($icons as $key => $row){

             $icons_extend[$key] = '<span><i class="fa '. $key .'"></i>'.$row.'</span>';

         }
        */

        return $icons;
    }


    /**
     * Return Default Contact Form 7 ID
     * @return int|string
     */

    static function get_default_form_ID(){

        $forms_array = self::get_custom_posts_array('wpcf7_contact_form');

        $default_form_id = 0;

        if(count($forms_array)> 0){

            foreach ($forms_array as $form_id => $form) {

                $default_form_id =  $form_id;

            }

        }


        return $default_form_id;

    }


}

