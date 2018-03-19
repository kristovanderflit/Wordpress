<!-- Action -->
<div id="<?php echo $post_type; ?>-<?php echo $profile_id; ?>-<?php echo $action; ?>" class="postbox">
    <h3 class="hndle">
        <?php
        if ( $profile_id == 'default' ) {
            echo 'Defaults: ' . $action_label;
        } else {
            echo sprintf( __( '%s: %s: %s', $this->base->plugin->name ), $profile['formatted_service'], $profile['formatted_username'], $action_label );
        }
        ?>

        <label for="<?php echo $profile_id; ?>_<?php echo $action; ?>_enabled">
            <input type="checkbox" id="<?php echo $profile_id; ?>_<?php echo $action; ?>_enabled" name="<?php echo $this->base->plugin->name; ?>[<?php echo $profile_id; ?>][<?php echo $action; ?>][enabled]" value="1"<?php checked( $this->get_setting( $post_type, '[' . $profile_id . '][' . $action .'][enabled]', 0 ), 1, true ); ?> data-conditional="<?php echo $post_type; ?>-<?php echo $profile_id; ?>-<?php echo $action; ?>-statuses" />
            <?php _e( 'Enabled', $this->base->plugin->name ); ?>
        </label>
    </h3>

    <div id="<?php echo $post_type; ?>-<?php echo $profile_id; ?>-<?php echo $action; ?>-statuses" class="statuses">
        <?php
        // Publish / Update Statuses
        $statuses = $this->get_setting( $post_type, '['. $profile_id .'][' . $action . '][status]', array() );
        
        if ( count ( $statuses ) == 0 || ! $statuses ) {
            // Output blank first status
            $key = 0;
            require( $this->base->plugin->folder . 'views/settings-post-action-status.php' );
        } else {
            // Iterate through saved statuses
            foreach ( $statuses as $key => $status ) {
                // Load sub view
                require( $this->base->plugin->folder . 'views/settings-post-action-status.php' );
            }
        }

        // Upgrade Notice
        if ( class_exists( 'WP_To_Buffer' ) ) {
            if ( $action == 'publish' ) {
                require( $this->base->plugin->folder . 'views/settings-post-action-status-upgrade.php' );
            }
        }
        ?>
    </div>
</div>