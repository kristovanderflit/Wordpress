<?php
/**
* Install class
* 
* @package  WP_To_Buffer_Pro
* @author   Tim Carr
* @version  3.2.5
*/
class WP_To_Buffer_Pro_Install {

    /**
     * Holds the class object.
     *
     * @since   3.2.5
     *
     * @var     object
     */
    public static $instance;

    /**
     * Holds the base object.
     *
     * @since   3.2.5
     *
     * @var     object
     */
    public $base;

    /**
     * Activation routine
     * - Installs database tables as necessary
     *
     * @since   3.2.5
     *
     * @param   bool    $network_wide   Network Wide activation
     */
    static public function activate( $network_wide = false ) {

        // Check if we are on a multisite install, activating network wide, or a single install
        if ( is_multisite() && $network_wide ) {
            // Multisite network wide activation
            // Iterate through each blog in multisite, creating table
            $sites = wp_get_sites( array( 
                'limit' => 0 
            ) );
            foreach ( $sites as $site ) {
                switch_to_blog( $site->blog_id );

                // Run activation routines here
                WP_To_Buffer_Pro_Install::get_instance()->install();

                restore_current_blog();
            }
        } else {
            // Run activation routines here
            WP_To_Buffer_Pro_Install::get_instance()->install();
        }

    }

    /**
     * Activation routine when a WPMU site is activated
     * - Installs database tables as necessary
     *
     * We run this because a new WPMU site may be added after the plugin is activated
     * so will need necessary database tables
     *
     * @since   3.2.5
     */
    static public function activate_wpmu_site( $blog_id ) {

        switch_to_blog( $blog_id );
        $this->activate();
        restore_current_blog();

    }

    /**
     * Runs installation routines for first time users
     *
     * @since   3.4.0
     */
    public function install() {

        // Get settings instance
        $settings_instance = WP_To_Buffer_Pro_Settings::get_instance();

        // Bail if settings already exist
        $settings = $settings_instance->get_settings( 'post' );
        if ( $settings != false ) {
            return;
        }

        // Get default installation settings
        $settings = $settings_instance->default_installation_settings();
        $settings_instance->update_settings( 'post', $settings );

    }

    /**
     * Returns the singleton instance of the class.
     *
     * @since   3.2.5
     *
     * @return  object Class.
     */
    public static function get_instance() {

        if ( ! isset( self::$instance ) && ! ( self::$instance instanceof self ) ) {
            self::$instance = new self;
        }

        return self::$instance;

    }

}