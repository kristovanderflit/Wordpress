<?php
/**
 * Settings class
 * 
 * @package WP_To_Buffer_Pro
 * @author  Tim Carr
 * @version 3.0.0
 */
class WP_To_Buffer_Pro_Settings {

    /**
     * Holds the class object.
     *
     * @since 3.1.4
     *
     * @var object
     */
    public static $instance;

    /**
     * Migrates settings from the free version or Pro version 2.x
     *
     * @since   3.0.0
     */
    public function migrate_settings() {

        // Check if we have any old settings
        $old_settings = get_option( 'wp-to-buffer' );

        // If old settings are empty, bail
        if ( ! $old_settings ) {
            return;
        }

        // Store the old settings in a backup option key, just in case
        update_option( 'wp-to-buffer-v2', $old_settings );

        // Migrate into new settings
        // Access token
        if ( ! empty( $old_settings['accessToken'] ) ) {
            $this->update_access_token( $old_settings['accessToken'] );
        }

        // Get instances
        $api = WP_To_Buffer_Pro_Buffer_API::get_instance();
        $common = WP_To_Buffer_Pro_Common::get_instance();

        // Get Buffer Profiles
        $api->set_access_token( WP_To_Buffer_Pro_Settings::get_instance()->get_access_token() );
        $profiles = $api->profiles( true );

        // Get Actions
        $actions = $common->get_post_actions();

        // Iterate through each Post Type
        foreach ( $old_settings['enabled'] as $post_type => $old_actions ) {
            $new_settings = array();

            // Default profile
            $new_settings['default'] = array();
            
            // Default profile: actions
            foreach ( $actions as $action => $action_label ) {
                if ( $action == 'conditions' ) {
                    /**
                    * Conditions (was Filters)
                    */
                    $new_settings['default']['conditions'] = array();
                    $new_settings['default']['conditions']['enabled'] = ( isset( $old_settings['filter'][ $post_type ] ) ? $old_settings['filter'][ $post_type ] : 0 );
                    if ( $new_settings['default']['conditions']['enabled'] ) {
                        foreach ( $old_settings['tax'][ $post_type ] as $taxonomy => $items ) {
                            $new_settings['default']['conditions'][ $taxonomy ] = $items;
                        }
                    }
                } else {
                    /**
                    * Publish/Update
                    */
                    $new_settings['default'][ $action ] = array();
                    $new_settings['default'][ $action ]['enabled'] = ( isset( $old_settings['enabled'][ $post_type ][ $action ] ) ? $old_settings['enabled'][ $post_type ][ $action ] : 0 );
                    $new_settings['default'][ $action ]['status'] = array();
                    $new_settings['default'][ $action ]['status'][] = array(
                        'image'         => ( isset( $old_settings['image'][ $post_type ][ $action ] ) ? $old_settings['image'][ $post_type ][ $action ]: 0 ),
                        'sub_profile'   => 0, // Pinterest not supported in free or v2.x
                        'message'       => ( isset( $old_settings['message'][ $post_type ][ $action ] ) ? $old_settings['message'][ $post_type ][ $action ] : '' ),
                        'schedule'      => ( ( isset( $old_settings['enabled'][ $post_type ]['instant'] ) && $old_settings['enabled'][ $post_type ]['instant'] == 1 ) ? 'now' : 'queue_bottom' ),
                        'days'          => 0,
                        'hours'         => 0,
                        'minutes'       => 0,
                    );
                    if ( $old_settings['number'][ $post_type ][ $action ] == 2 ) {
                        // Alternate status
                        $new_settings['default'][ $action ]['status'][] = array(
                            'image'         => ( isset( $old_settings['image'][ $post_type ][ $action ] ) ? $old_settings['image'][ $post_type ][ $action ]: 0 ),
                            'sub_profile'   => 0, // Pinterest not supported in free or v2.x
                            'message'       => ( isset( $old_settings['alternateMessage'][ $post_type ][ $action ] ) ? $old_settings['alternateMessage'][ $post_type ][ $action ] : '' ),
                            'schedule'      => ( ( isset( $old_settings['enabled'][ $post_type ]['instant'] ) && $old_settings['enabled'][ $post_type ]['instant'] == 1 ) ? 'now' : 'queue_bottom' ),
                            'days'          => 0,
                            'hours'         => 0,
                            'minutes'       => 0,
                        );
                    }
                    if ( $old_settings['number'][ $post_type ][ $action ] == 3 ) {
                        // Original status, again
                        $new_settings['default'][ $action ]['status'][] = array(
                            'image'         => ( isset( $old_settings['image'][ $post_type ][ $action ] ) ? $old_settings['image'][ $post_type ][ $action ]: 0 ),
                            'sub_profile'   => 0, // Pinterest not supported in free or v2.x
                            'message'       => ( isset( $old_settings['message'][ $post_type ][ $action ] ) ? $old_settings['message'][ $post_type ][ $action ] : '' ),
                            'schedule'      => ( ( isset( $old_settings['enabled'][ $post_type ]['instant'] ) && $old_settings['enabled'][ $post_type ]['instant'] == 1 ) ? 'now' : 'queue_bottom' ),
                            'days'          => 0,
                            'hours'         => 0,
                            'minutes'       => 0,
                        );
                    }
                }
            }

            // Iterate through Buffer Profiles
            foreach ( $profiles as $profile_id => $profile ) {        
                // Default profile
                $new_settings[ $profile_id ] = array();
                
                // Default profile: actions
                foreach ( $actions as $action => $action_label ) {
                    if ( $action == 'conditions' ) {
                        /**
                        * Conditions (was Filters)
                        */
                        $new_settings[ $profile_id ]['conditions'] = array();
                        $new_settings[ $profile_id ]['conditions']['enabled'] = ( isset( $old_settings[ $profile_id ]['filter'][ $post_type ] ) ? $old_settings[ $profile_id ]['filter'][ $post_type ] : 0 );
                        if ( $new_settings[ $profile_id ]['conditions']['enabled'] ) {
                            foreach ( $old_settings[ $profile_id ]['tax'][ $post_type ] as $taxonomy => $items ) {
                                $new_settings[ $profile_id ]['conditions'][ $taxonomy ] = $items;
                            }
                        }
                    } else {
                        /**
                        * Publish/Update
                        */

                        // Profile enabled + overriding?
                        $new_settings[ $profile_id ]['enabled'] = ( isset( $old_settings['ids'][ $post_type ][ $profile_id ] ) ? 1 : 0 );
                        $new_settings[ $profile_id ]['override'] = ( isset( $old_settings['override'][ $post_type ][ $profile_id ] ) ? 1 : 0 );
                        
                        // Profile action
                        $new_settings[ $profile_id ][ $action ] = array();
                        $new_settings[ $profile_id ][ $action ]['enabled'] = ( isset( $old_settings[ $profile_id ]['enabled'][ $post_type ][ $action ] ) ? 1 : 0 );
                        $new_settings[ $profile_id ][ $action ]['status'] = array();
                        $new_settings[ $profile_id ][ $action ]['status'][] = array(
                            'image'         => ( isset( $old_settings[ $profile_id ]['image'][ $post_type ][ $action ] ) ? $old_settings[ $profile_id ]['image'][ $post_type ][ $action ]: 0 ),
                            'sub_profile'   => 0, // Pinterest not supported in free or v2.x
                            'message'       => ( isset( $old_settings[ $profile_id ]['message'][ $post_type ][ $action ] ) ? $old_settings[ $profile_id ]['message'][ $post_type ][ $action ] : '' ),
                            'schedule'      => ( ( isset( $old_settings[ $profile_id ]['enabled'][ $post_type ]['instant'] ) && $old_settings[ $profile_id ]['enabled'][ $post_type ]['instant'] == 1 ) ? 'now' : 'queue_bottom' ),
                            'days'          => 0,
                            'hours'         => 0,
                            'minutes'       => 0,
                        );
                        if ( $old_settings['number'][ $post_type ][ $action ] == 2 ) {
                            // Alternate status
                            $new_settings[ $profile_id ][ $action ]['status'][] = array(
                                'image'         => ( isset( $old_settings[ $profile_id ]['image'][ $post_type ][ $action ] ) ? $old_settings[ $profile_id ]['image'][ $post_type ][ $action ]: 0 ),
                                'sub_profile'   => 0, // Pinterest not supported in free or v2.x
                                'message'       => ( isset( $old_settings[ $profile_id ]['alternateMessage'][ $post_type ][ $action ] ) ? $old_settings[ $profile_id ]['alternateMessage'][ $post_type ][ $action ] : '' ),
                                'schedule'      => ( ( isset( $old_settings[ $profile_id ]['enabled'][ $post_type ]['instant'] ) && $old_settings[ $profile_id ]['enabled'][ $post_type ]['instant'] == 1 ) ? 'now' : 'queue_bottom' ),
                                'days'          => 0,
                                'hours'         => 0,
                                'minutes'       => 0,
                            );
                        }
                        if ( $old_settings['number'][ $post_type ][ $action ] == 3 ) {
                            // Original status, again
                            $new_settings[ $profile_id ][ $action ]['status'][] = array(
                                'image'         => ( isset( $old_settings[ $profile_id ]['image'][ $post_type ][ $action ] ) ? $old_settings[ $profile_id ]['image'][ $post_type ][ $action ]: 0 ),
                                'sub_profile'   => 0, // Pinterest not supported in free or v2.x
                                'message'       => ( isset( $old_settings[ $profile_id ]['message'][ $post_type ][ $action ] ) ? $old_settings[ $profile_id ]['message'][ $post_type ][ $action ] : '' ),
                                'schedule'      => ( ( isset( $old_settings[ $profile_id ]['enabled'][ $post_type ]['instant'] ) && $old_settings[ $profile_id ]['enabled'][ $post_type ]['instant'] == 1 ) ? 'now' : 'queue_bottom' ),
                                'days'          => 0,
                                'hours'         => 0,
                                'minutes'       => 0,
                            );
                        }
                    }
                }
            }

            // We now have a new settings array that's v3 compatible
            update_option( 'wp-to-buffer-pro-' . $post_type, $new_settings );
        } // Close post type

        // Clear old settings
        delete_option( 'wp-to-buffer' );

    }

    /**
     * Retrieves a setting from the options table.
     *
     * Safely checks if the key(s) exist before returning the default
     * or the value.
     *
     * @since   3.0.0
     *
     * @param   string  $type       Setting Type
     * @param   string  $key        Setting key value to retrieve
     * @param   string  $default    Default Value
     * @return  string              Value/Default Value
     */
    public function get_setting( $type, $key, $default = '' ) {

        // Get settings
        $settings = $this->get_settings( $type );

        // Convert string to keys
        $keys = explode( '][', $key );
        
        foreach ( $keys as $count => $key ) {
            // Cleanup key
            $key = trim( $key, '[]' );

            // Check if key exists
            if ( ! isset( $settings[ $key ] ) ) {
                return $default;
            }

            // Key exists - make settings the value (which could be an array or the final value)
            // of this key
            $settings = $settings[ $key ];
        }

        // If here, setting exists
        return $settings; // This will be a non-array value

    }

    /**
     * Returns the settings for the given Post Type
     *
     * @since   3.0.0
     *
     * @param   string  $type   Type
     * @return  array           Settings
     */
    public function get_settings( $type ) {

        // Get current settings
        $settings = get_option( 'wp-to-buffer-pro-' . $type );

        // Allow devs to filter before returning
        $settings = apply_filters( 'wp_to_buffer_pro_get_settings', $settings, $type );

        // Return result
        return $settings;

    }

    /**
     * Stores the given settings for the given Post Type into the options table
     *
     * @since   3.0.0
     *
     * @param   string  $type       Type
     * @param   array   $settings   Settings
     * @return  bool                Success
     */
    public function update_settings( $type, $settings ) {

        // Makes the given $settings statuses associative
        $settings = $this->make_statuses_associative( $settings );

        // Allow devs to filter before saving
        $settings = apply_filters( 'wp_to_buffer_pro_update_settings', $settings, $type );

        // update_option will return false if no changes were made, so we can't rely on this
        update_option( 'wp-to-buffer-pro-' . $type, $settings );

        // Check for duplicate statuses
        $duplicates = $this->check_for_duplicates( $settings );
        if ( $duplicates ) {
            return __( 'One or more status updates for a Post Type and Profile combination are the same. Please correct this to ensure each status update is unique, otherwise your status updates will NOT publish to Buffer as they will be seen as duplicates, which violate Facebook and Twitter\'s Terms of Service.', 'wp-to-buffer-pro' );
        }

        return true;

    }

    /**
     * Returns an array of default settings for a new installation.
     *
     * @since   3.4.0
     *
     * @return  array   Settings
     */
    public function default_installation_settings() {

        // Define default settings
        $settings = array(
            'default' => array(
                'publish' => array(
                    'enabled' => 1,
                    'status' => array(
                        'image'     => array( 1 ),
                        'message'   => array( 'New Post: {title} {url}' ),
                        'schedule'  => array( 'queue_bottom' ),
                    ),
                ),
            ),
        );

        // Allow devs to filter
        $settings = apply_filters( 'wp_to_buffer_pro_default_installation_settings', $settings );

        // Return
        return $settings;

    }

    /**
     * Helper method to determine whether the given Post Type has at least
     * one social media account enabled, and there is a publish or update
     * action enabled in the Defaults for the Post Type or the Social Media account.
     *
     * @since   3.4.0
     *
     * @param   string  $post_type  Post Type
     * @return  bool                Enabled
     */
    public function is_post_type_enabled( $post_type ) {

        // Get Settings for Post Type
        $settings = $this->get_settings( $post_type );

        // If no settings, bail
        if ( ! $settings ) {
            return false;
        }

        /**
         * Default Publish or Update enabled
         * 1+ Profiles enabled without override
         */
        $default_publish_action_enabled = $this->get_setting( $post_type, '[default][publish][enabled]', 0 );
        $default_update_action_enabled  = $this->get_setting( $post_type, '[default][update][enabled]', 0 );
        if ( $default_publish_action_enabled || $default_update_action_enabled ) {
            foreach ( $settings as $profile_id => $profile_settings ) {
                // Skip defaults
                if ( $profile_id == 'default' ) {
                    continue;
                }

                // Profile enabled, no override
                if ( isset( $profile_settings['enabled'] ) && $profile_settings['enabled'] ) {
                    if ( ! isset( $profile_settings['override'] ) || ! $profile_settings['override'] ) {
                        // Post Type is enabled with Defaults + 1+ Profile not using override settings
                        return true;
                    }     
                } 
            }
        }

        /**
         * 1+ Profiles enabled with override and publish / update enabled
         */
        foreach ( $settings as $profile_id => $profile_settings ) {
            // Skip defaults
            if ( $profile_id == 'default' ) {
                continue;
            }

            // Skip if profile not enabled
            if ( ! isset( $profile_settings['enabled'] ) || ! $profile_settings['enabled'] ) {
                continue;
            }

            // Skip if override not enabled
            if ( ! isset( $profile_settings['override'] ) || ! $profile_settings['override'] ) {
                continue;
            }

            // Profile action enabled
            if ( isset( $profile_settings['publish']['enabled'] ) && $profile_settings['publish']['enabled'] == '1' ) {
                // Post Type is enabled with 1+ Profile with override and publish enabled
                return true;
            }
            if ( isset( $profile_settings['update']['enabled'] ) && $profile_settings['update']['enabled'] == '1' ) {
                // Post Type is enabled with 1+ Profile with override and update enabled
                return true;
            }
        }

        // If here, Post Type can't be sent to Buffer
        return false;
       
    }

    /**
     * Iterates through all associative statuses for a given Post Type,
     * checking whether a profile and action combination have two or more statuses
     * that are the same.
     *
     * @since   3.1.1
     *
     * @param   array   $settings   Settings
     * @return  bool                Duplicates
     */
    public function check_for_duplicates( $settings ) {

        // Iterate through each profile
        foreach ( $settings as $profile_id => $actions ) {
            // Iterate through each action for this profile
            foreach ( $actions as $action => $statuses ) {
                // Check if this action is enabled
                if ( ! isset( $statuses['enabled'] ) || ! $statuses['enabled'] ) {
                    continue;
                }

                // Define the match flag
                $status_messages = array();

                // Iterate through each status update for this profile, to see if any two match
                foreach ( $statuses['status'] as $status ) {
                    $status_messages[] = $status['message'];
                }

                // Check if any two values in our array are the same
                // If so, this means the user is using the same status message twice, which may cause an issue
                $counts = array_count_values( $status_messages );
                foreach ( $counts as $count ) {
                    if ( $count > 1 ) {
                        return true;
                    }
                }
            }
        }

        // No duplicates found
        return false;

    }

    /**
     * Makes the given $settings statuses associative e.g.
     * $settings[profile_id][publish][status][message][0] --> $settings[profile_id][publish][status][0][message]
     *
     * @since   3.0.0
     *
     * @param   array   $settings   Settings
     * @return  array               Associative Settings
     */
    public function make_statuses_associative( $settings ) {

        // Get available actions
        $actions = WP_To_Buffer_Pro_Common::get_instance()->get_post_actions();

        // Iterate through settings, updatning statuses so they are are associative
        foreach ( $settings as $profile_id => $profile_settings ) {
            // Iterate through actions for each profile
            foreach ( $actions as $action => $action_label ) {
                // Check some statuses are specified for this action
                if ( ! isset( $profile_settings[ $action ] ) ) {
                    continue;
                }
                if ( ! isset( $profile_settings[ $action ]['status'] ) ) {
                    continue;
                }

                // Iterate through each status, to build the associative array
                $statuses = array();
                $status_count = 0;
                foreach ( $profile_settings[ $action ]['status']['message'] as $index => $message ) {
                    $statuses[ $status_count ] = array(
                        'image'                         => ( isset( $profile_settings[ $action ]['status']['image'][ $index ] ) ? $profile_settings[ $action ]['status']['image'][ $index ] : 0 ),
                        'sub_profile'                   => ( isset( $profile_settings[ $action ]['status']['sub_profile'][ $index ] ) ? $profile_settings[ $action ]['status']['sub_profile'][ $index ] : 0 ),
                        'message'                       => stripslashes( ( isset( $profile_settings[ $action ]['status']['message'][ $index ] ) ? $profile_settings[ $action ]['status']['message'][ $index ] : '' ) ),
                        'schedule'                      => ( isset( $profile_settings[ $action ]['status']['schedule'][ $index ] ) ? $profile_settings[ $action ]['status']['schedule'][ $index ] : '' ),
                        'days'                          => ( isset( $profile_settings[ $action ]['status']['days'][ $index ] ) ? $profile_settings[ $action ]['status']['days'][ $index ] : 0 ),
                        'hours'                         => ( isset( $profile_settings[ $action ]['status']['hours'][ $index ] ) ? $profile_settings[ $action ]['status']['hours'][ $index ] : 0 ),
                        'minutes'                       => ( isset( $profile_settings[ $action ]['status']['minutes'][ $index ] ) ? $profile_settings[ $action ]['status']['minutes'][ $index ] : 0 ), 
                        'schedule_custom_field_name'    => ( isset( $profile_settings[ $action ]['status']['schedule_custom_field_name'][ $index ] ) ? $profile_settings[ $action ]['status']['schedule_custom_field_name'][ $index ] : 0 ), 
                        'schedule_custom_field_relation'=> ( isset( $profile_settings[ $action ]['status']['schedule_custom_field_relation'][ $index ] ) ? $profile_settings[ $action ]['status']['schedule_custom_field_relation'][ $index ] : 'after' ),
                        'conditions'                    => array(),
                        'terms'                         => array(),
                    );

                    // Iterate through conditions to get taxonomies
                    if ( isset( $profile_settings[ $action ]['status']['conditions'] ) && count( $profile_settings[ $action ]['status']['conditions'] ) > 0 ) {
                        foreach ( $profile_settings[ $action ]['status']['conditions'] as $taxonomy => $taxonomy_conditions ) {
                            $statuses[ $status_count ]['conditions'][ $taxonomy ] = $taxonomy_conditions[ $index ];
                        }
                    }

                    // Iterate through terms to get taxonomies
                    if ( isset( $profile_settings[ $action ]['status']['terms'] ) && count( $profile_settings[ $action ]['status']['terms'] ) > 0 ) {
                        foreach ( $profile_settings[ $action ]['status']['terms'] as $taxonomy => $term_ids ) {
                            $statuses[ $status_count ]['terms'][ $taxonomy ] = explode( ',', $term_ids[ $index ] );
                        }
                    }

                    // Increment array index
                    $status_count++;
                }

                // Assign statuses back to status key
                $settings[ $profile_id ][ $action ]['status'] = $statuses;
                
            }
        }

        return $settings;

    }

    /**
     * Retrieves the access token from the options table
     *
     * @since   3.0.0
     *
     * @return  string  Access Token
     */
    public function get_access_token() {

        return get_option( 'wp-to-buffer-pro-access-token' );

    }

    /**
     * Stores the given access token into the options table
     *
     * @param   string  $access_token   Access Token
     * @return  bool                    Success
     */
    public function update_access_token( $access_token ) {

        // Allow devs to filter before saving
        $access_token = apply_filters( 'wp_to_buffer_pro_update_access_token', $access_token );

        // Return result
        return update_option( 'wp-to-buffer-pro-access-token', $access_token );

    }

    /**
     * Helper method to get a value from the options table
     *
     * @since   3.0.0
     *
     * @return  string  Access Token
     */
    public function get_option( $key, $default = '' ) {

        $result = get_option( 'wp-to-buffer-pro-' . $key );
        if ( ! $result ) {
            return $default;
        }

        return $result;

    }

    /**
     * Helper method to store a value to the options table
     *
     * @param   string  $key    Key
     * @param   string  $value  Value
     * @return  bool            Success
     */
    public function update_option( $key, $value ) {

        // Allow devs to filter before saving
        $value = apply_filters( 'wp_to_buffer_pro_update_option', $value, $key );

        // Update
        update_option( 'wp-to-buffer-pro-' . $key, $value );

        return true;

    }

    /**
     * Returns the singleton instance of the class.
     *
     * @since 3.1.4
     *
     * @return object Class.
     */
    static public function get_instance() {

        if ( ! isset( self::$instance ) && ! ( self::$instance instanceof self ) ) {
            self::$instance = new self;
        }

        return self::$instance;

    }

}

// Load the class
$wp_to_buffer_pro_settings = WP_To_Buffer_Pro_Settings::get_instance();