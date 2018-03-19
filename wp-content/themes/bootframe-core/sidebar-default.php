<?php
/**
 * Display  sidebar with BootFrame
 */

?>
<section id="sidebar"
         class="<?php echo apply_filters('smartlib_sidebar_layout_class', '',SMARTLIB_CONTENT_TYPE) ?>">
    <?php echo apply_filters('smartlib_before_sidebar', '<ul class="smartlib-layout-list smartlib-widgets-list smartlib-vertical-list smartlib-column-list smartlib-sm-2-columns-list">', SMARTLIB_CONTENT_TYPE) ?>

    <?php

    dynamic_sidebar(smartlib_get_context_sidebar(SMARTLIB_CONTENT_TYPE));

    ?>


    <?php echo apply_filters('smartlib_after_sidebar', '</ul>', SMARTLIB_CONTENT_TYPE) ?>


</section>