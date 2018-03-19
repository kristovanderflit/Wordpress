<?php
/**
* Outputs Settings View for a Post Type
*
* @since 3.0
*/
?>
    
<!-- Post Type -->
<div id="<?php echo $post_type; ?>-panel" class="panel">
    
    <!-- Second level tabs -->
    <h3 class="nav-tab-wrapper needs-js" data-panel="sub-panel">  
        <!-- Default Settings -->
        <a href="#<?php echo $post_type; ?>-default" class="nav-tab nav-tab-active">
            <?php _e( 'Defaults', $this->base->plugin->name ); ?><br /><br />
        </a>
                                        
        <?php
        // Account tabs
        if ( ! is_wp_error( $profiles ) ) {
            foreach ( $profiles as $key => $profile ) {
            $profile_enabled = $this->get_setting( $post_type, '[' . $profile['id'] . '][enabled]', 0 );
               ?>
                <a href="#<?php echo $post_type; ?>-<?php echo $profile['id']; ?>" class="nav-tab image <?php echo ( $profile_enabled ? ' enabled' : ' disabled' ); ?>" title="<?php echo $profile['formatted_service'] . ': ' . $profile['formatted_username']; ?>" data-tooltip="<?php echo $profile['formatted_service'] . ': ' . $profile['formatted_username']; ?>">
                    <span class="network <?php echo $profile['service']; ?>"></span> 
                    <img src="<?php echo $profile['avatar']; ?>" width="48" height="48" alt="<?php echo $profile['formatted_username']; ?>" />
                     
                    <?php
                    if ( $profile_enabled ) {
                        ?>
                        <span class="dashicons dashicons-yes"></span>
                        <?php
                    }
                    ?>
                </a>
                <?php 
            }
        }
        unset( $profile );
        ?>
    </h3>
    
    <!-- Defaults -->
    <?php
    $profile_id = 'default';
    ?>
    <div id="<?php echo $post_type; ?>-<?php echo $profile_id; ?>-panel" class="sub-panel">
        <?php
        // Iterate through Post Actions (Publish, Update etc)
        foreach ( $post_actions as $action => $action_label ) {
            require( $this->base->plugin->folder . 'views/settings-post-action.php' );
        }
        ?>
    </div>
    <!-- /Defaults -->

    <!-- Profiles -->
    <?php
    if ( ! is_wp_error( $profiles ) ) {
        foreach ( $profiles as $key => $profile ) {
            $profile_id = $profile['id'];
            ?>
            <div id="<?php echo $post_type; ?>-<?php echo $profile_id; ?>-panel" class="sub-panel">
                <?php
                require( $this->base->plugin->folder . 'views/settings-post-actionheader.php' );
                ?>
            </div>
            <?php
        }
    }
    ?>
    <!-- /Profiles -->
</div>
<!-- /post_type -->