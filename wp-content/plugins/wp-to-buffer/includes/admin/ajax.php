<?php
/**
 * AJAX class
 * 
 * @package WP_To_Buffer_Pro
 * @author  Tim Carr
 * @version 3.0.0
 */
class WP_To_Buffer_Pro_Ajax {

    /**
     * Holds the class object.
     *
     * @since   3.1.4
     *
     * @var     object
     */
    public static $instance;

    /**
     * Constructor
     *
     * @since   3.0.0
     */
    public function __construct() {

        // Actions
        add_action( 'wp_ajax_wp_to_buffer_pro_character_count', array( $this, 'character_count' ) );
        add_action( 'wp_ajax_wp_to_buffer_pro_clear_log', array( $this, 'clear_log' ) );
        add_action( 'wp_ajax_wp_to_buffer_pro_search_terms', array( $this, 'search_terms' ) );
        add_action( 'wp_ajax_wp_to_buffer_pro_bulk_publish', array( $this, 'bulk_publish' ) );

    }

    /**
     * Renders the given status and Post to calculate the character count on a status
     * when using the "Post to Buffer using Manual Settings" option.
     *
     * @since   3.1.6
     */
    public function character_count() {

        // Run a security check first.
        check_ajax_referer( 'wp-to-buffer-pro-character-count', 'nonce' );

        // Get post and status
        $post_id    = absint( $_POST['post_id'] );
        $post       = get_post( $post_id );
        $statuses   = $_POST['statuses'];

        // Parse statuses
        $parsed_statuses = array();
        foreach ( $statuses as $status ) {
            $parsed_statuses[] = WP_To_Buffer_Pro_Publish::get_instance()->parse_text( $post, $status );
        }

        // Return parsed status and character count
        wp_send_json_success( array(
            'parsed_statuses' => $parsed_statuses,
        ) );

    }

    /**
     * Clears the plugin log for the given Post ID
     *
     * @since   3.0.0
     */
    public function clear_log() {

        // Run a security check first.
        check_ajax_referer( 'wp-to-buffer-pro-clear-log', 'nonce' );

        // Clear log
        WP_To_Buffer_Pro_Log::get_instance()->clear_log();

        // Done
        wp_die( 1 );

    }

    /**
     * Searches for Taxonomy Terms for the given Taxonomy and freeform text
     *
     * @since   3.0.0
     */
    public function search_terms() {

        // Get vars
        $taxonomy = sanitize_text_field( $_REQUEST['taxonomy'] );
        $search = sanitize_text_field( $_REQUEST['q'] );

        // Get results
        $terms = get_terms( array(
            'taxonomy'  => $taxonomy,
            'orderby'   => 'name',
            'order'     => 'ASC',
            'hide_empty'=> 0,
            'number'    => 0,
            'fields'    => 'id=>name',
            'search'    => $search,
        ) );

        // If an error occured, bail
        if ( is_wp_error( $terms ) ) {
            return wp_send_json_error( $terms->get_error_message() );
        }

        // Build array
        $terms_array = array();
        foreach ( $terms as $term_id => $name ) {
            $terms_array[] = array(
                'id'    => $term_id,
                'text'  => $name,
            );
        }

        // Done
        wp_send_json_success( $terms_array );

    }

    /**
     * Sends a publish request to Buffer for the next Post ID in the index sequence.
     * Used for bulk publishing
     *
     * @since   3.0.5
     *
     * @return  string  JSON Result
     */
    public function bulk_publish() {

        // Run a security check first.
        check_ajax_referer( 'wp-to-buffer-pro-bulk-publish', 'nonce' );

        // Check required POST variables have been set
        if ( ! isset( $_POST['current_index'] ) || ! isset( $_POST['post_ids'] ) ) {
            wp_die( 0 ); 
        } 

        // Get required POST variables
        $current_index = absint( $_POST['current_index'] );
        $post_ids = explode( ',', $_POST['post_ids'] );

        // Get Post ID from array based on the current index
        $post_id = $post_ids[ $current_index ];

        // Send to Buffer
        $results = WP_To_Buffer_Pro_Publish::get_instance()->publish( $post_id, 'publish', true );

        // Process results into JSON array
        $json = array(
            'post'      => 'Post #' . $post_id . ': ' . get_the_title( $post_id ),
            'results'   => array(),
        );

        // If the overall result a WP error, return that result
        if ( is_wp_error( $results ) ) {
            $json['results'][] = '<span class="error">#' . ( $index + 1 ) . ' Error: ' . $results->get_error_message() . '</span>';
        } else {
            // Iterate through each status message result to see what happened
            foreach ( $results as $index => $result ) {
                if ( is_wp_error( $result ) ) {
                    $json['results'][] = '<span class="error">#' . ( $index + 1 ) . ' Error: ' . $result->get_error_message(). '</span>';
                } else {
                    $json['results'][] = '<span class="success">#' . ( $index + 1 ) . 'Success: ' . $result->updates[0]->text . '</span>';
                }
            }
        }

        // Return results
        echo json_encode( $json );
        die();

    }

    /**
     * Returns the singleton instance of the class.
     *
     * @since 3.1.4
     *
     * @return object Class.
     */
    public static function get_instance() {

        if ( ! isset( self::$instance ) && ! ( self::$instance instanceof self ) ) {
            self::$instance = new self;
        }

        return self::$instance;

    }

}

// Load the class
$wp_to_buffer_pro_ajax = WP_To_Buffer_Pro_Ajax::get_instance();