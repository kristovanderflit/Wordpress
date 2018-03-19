<?php

global $wp_customize;

add_action( 'customize_register', 'kirki_add_custom_controls' );

function kirki_add_custom_controls( $wp_customize ) {

    class Kirki_Custom_Control_Separator extends WP_Customize_Control {
        public $type = 'separator';
        public function render_content() { ?>
            <hr />
        <?php
        }
    }
    add_filter( 'kirki/control_types', function( $controls ) {
        $controls['separator'] = 'Kirki_Custom_Control_Separator';
        return $controls;
    } );

    /**
     * The custom control class
     */
    class Kirki_Custom_Control_Header_Legend extends WP_Customize_Control {
        public $type = 'header_legend';
        public function render_content() { ?>
            <?php if ( ! empty( $this->label ) ) : ?>
                <h3><?php echo esc_html( $this->label ); ?></h3>
                <hr />
            <?php endif; ?>
        <?php
        }



    }
    // Register our custom control with Kirki
    add_filter( 'kirki/control_types', function( $controls ) {
        $controls['header_legend'] = 'Kirki_Custom_Control_Header_Legend';
        return $controls;
    } );




}

