<?php

add_filter('siteorigin_widgets_active_widgets', 'smartlib_default_so_widgets');


/**
 *
 * Modify  & return default widget array
 * @param $active_widgets
 * @return array
 */
function smartlib_default_so_widgets($active_widgets){

    $default_active_widgets = array(

        'so-headline-widget' => true,
        'so-price-table-widget'  => true,
        'so-features-widget' => true,
        'smartlib-offer-box-widget' => true,
        'smartlib-counter-boxes-widget' => true,
        'smartlib-call-to-action-widget' => true,
        'smartlib-buttons-in-columns-widget' => true,
        'smartlib-chart-boxes-widget' => true,
        'smartlib-contactform7-widget' => true,
        'smartlib-featured-post-widget' => true,
        'smartlib-features-box-widget' => true,
        'smartlib-header-widget' => true,
        'smartlib-our-clients-widget' => true,
        'smartlib-our-team-widget' => true,
        'smartlib-portfolio-items-widget' => true,
        'smartlib-tabs-widget' =>true,
        'smartlib-testimonials-slider-widget' => true
    );

    return array_merge($default_active_widgets, $active_widgets);
}

/**
 * Add widget groups
 * @param $tabs
 * @return array
 */

function smartlib_add_widget_tabs($tabs) {
    $tabs[] = array(
        'title' => __('Bootframe Widgets', 'bootframe-core'),
        'filter' => array(
            'groups' => array('bootframe-core')
        )
    );

    return $tabs;
}
add_filter('siteorigin_panels_widget_dialog_tabs', 'smartlib_add_widget_tabs', 20);

/**
 * Add classic bootframe widgets to Bootframe tab.
 *
 * @param $widgets
 *
 * @return array
 */
function smartlib_panels_add_recommended_widgets($widgets){

    $project_widgets = __SMARTLIB::project()->project_widgets;

    foreach($project_widgets as $project_widget) {
        if( isset( $widgets[$project_widget] ) ) {
            $widgets[$project_widget]['groups'] = array('bootframe-core');
            //$widgets[$project_widget]['icon'] = 'dashicons dashicons-wordpress';
        }
    }

    return $widgets;

}

add_filter('siteorigin_panels_widgets', 'smartlib_panels_add_recommended_widgets');


