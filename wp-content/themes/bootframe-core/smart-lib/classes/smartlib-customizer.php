<?php

/**
 * Project Customizer Class
 *
 * Contains methods for customizing the theme customization screen.
 *
 *
 * @subpackage project
 * @since      project 1.0
 */
class Smartlib_Customizer
{


    public static $theme_key;
    public static $default_config;
    public static $controls_array;


    public function __construct()
    {

        self::$controls_array = array();
        self::$default_config = Smartlib_Config::getInstance();
        self::$theme_key = self::$default_config->get_theme_key();

    }


    /**
     * Implement theme options into Theme Customizer on Frontend
     *
     * @see   examples for different input fields https://gist.github.com/2968549
     * @since 08/09/2012
     *
     * @param $wp_customize Theme Customizer object
     *
     * @return void
     */
    public function  register($wp_customize)
    {
        //add customizer sections
        $this->add_sections($wp_customize);

        if(!defined('SMARTLIB_THEME_INFO')){

            $this->smartlib_add_premium_info($wp_customize);

        }



    }

    /*
     * Add Customizer Sections
     */

    private function add_sections($wp_customize)
    {

        /*Put default sections in general panel*/
        $wp_customize->get_section('colors')->panel = 'design_theme_panel';
        $wp_customize->get_section('title_tagline')->panel = 'smartlib_panel_general_settings';
        $wp_customize->get_section('header_image')->panel = 'design_theme_panel';
        $wp_customize->get_section('background_image')->panel = 'design_theme_panel';
        $wp_customize->get_section('custom_css')->panel = 'design_theme_panel';
        $wp_customize->get_section('static_front_page')->panel = 'homepage_theme_panel';


    }

    function smartlib_add_premium_info($wp_customize){

        foreach(self::$default_config->premium_sections_array as $section){

            $wp_customize->add_setting( $section .'_info', array(
                'default'    => '',
                'sanitize_callback' => 'sanitize_text_field',
            ) );

            $wp_customize->add_control( new Smartlib_Customizer_Info_Field( $wp_customize, $section .'_info', array(
                'label'      => __( 'Premium Version', 'bootframe-core'),
                'section'    => $section,
                'capability' => 'edit_theme_options',
                'settings'   => $section .'_info'

            ) ) );

        }


    }




    /**
     * Live preview javascript
     *
     * @since  project 1.0
     * @return void
     */
    public function customize_preview_js()
    {

        $suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '.dev' : '';

        wp_register_script(
            self::$theme_key . '-customizer',
            get_template_directory_uri() . '/js/theme-customizer' . $suffix . '.js',
            array('customize-preview'),
            FALSE,
            TRUE
        );

        wp_enqueue_script(self::$theme_key . '-customizer');
    }











}


/**
 * Customize for textarea, extend the WP customizer
 *
 */

if (class_exists('WP_Customize_Control'))
{
    class Smartlib_Customizer_Info_Field extends WP_Customize_Control {
        public $type = 'extendinfo';

        public function render_content() {
            ?>
            <div class="smartlib-form-proversion-info-outer">
                <div class="smartlib-form-proversion-info-inner"><a
                        href="http://rocksite.pro/bootframe/bootframe-redirect-from-customizer/"
                        target="_blank"
                        class="bootframe-proversion-link" style="font-weight: bold; padding-top: 50px; font-size: 15px;"><?php _e('More available in pro version &#187;', 'bootframe-core');?></a>
                </div>
                <?php

                if(file_exists(SMART_ADMIN_DIRECTORY. '/css/img/'.$this->id .'.png')){
                    ?>
                    <div class="smartlib-color-readonly-image"><img src="<?php echo SMART_ADMIN_DIRECTORY_URI. '/css/img/'.$this->id ?>.png" alt="<?php _e('Available in pro version', 'bootframe-core') ?>" /></div>
                <?php
                }
                ?>
            </div>
        <?php
        }
    }
}









