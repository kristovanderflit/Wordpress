<?php

function smartlib_widgets_collection($folders){

    $folders[] = SMART_TEMPLATE_DIRECTORY . SMART_LIB_DIRECTORY. 'widgets/';

    return $folders;
}
add_filter('siteorigin_widgets_widget_folders', 'smartlib_widgets_collection');