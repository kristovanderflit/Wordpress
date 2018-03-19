<?php

/*
 * Load integration file depends on page builder version
 */

if (function_exists('siteorigin_panels_init')){

    require_once('page-builder-integration-previous.php');

}elseif(function_exists('siteorigin_widget_get_plugin_path')){

    require_once('page-builder-integration-new.php');

}

