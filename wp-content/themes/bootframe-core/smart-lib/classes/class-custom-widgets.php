<?php

/**
 * Smartlib Widgets Classes
 *
 * Theme's widgets extends the default WordPress
 * widgets by giving users highly-customizable widget settings.
 *
 * @subpackage Smartlib
 * @since      Smartlib 1.0
 */




/**
 * Recent_Posts widget class
 *
 * @since 1.0
 *
 */
class Smart_Widget_Recent_Posts extends WP_Widget
{

    function __construct()
    {

        $widget_ops = array('classname' => 'smartlib-last-articles-widget', 'description' => __("The most recent posts on your site (extended contorls)", 'bootframe-core'));
        parent::__construct('smartlib-recent-posts', __(ucfirst('bootframe-core') . ' Extended Recent Posts', 'bootframe-core'), $widget_ops);
        $this->alt_option_name = 'widget_recent_entries_Smartlib';

        add_action('save_post', array($this, 'flush_widget_cache'));
        add_action('deleted_post', array($this, 'flush_widget_cache'));
        add_action('switch_theme', array($this, 'flush_widget_cache'));
    }

    function widget($args, $instance)
    {

        $cache = wp_cache_get('smartlib-recent-posts', 'widget');

        $title = apply_filters('widget_title', empty($instance['title']) ? __('Recent Posts', 'bootframe-core') : $instance['title'], $instance, $this->id_base);
        if (empty($instance['number']) || !$number = absint($instance['number']))
            $number = 10;
        $show_date = isset($instance['show_date']) ? $instance['show_date'] : false;
        $show_post_thumbnail = isset($instance['show_post_thumbnail']) ? $instance['show_post_thumbnail'] : false;
        $show_post_author = isset($instance['show_post_author']) ? $instance['show_post_author'] : false;

        $r = new WP_Query(apply_filters('widget_posts_args', array('posts_per_page' => $number, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true)));
        ?>
        <?php echo $args['before_widget']; ?>
        <?php if ($title) echo $args['before_title'] . $title . $args['after_title']; ?>
        <div class="smartlib-inside-box panel-body">
            <?php

            if ($r->have_posts()) :
                ?>
                <ul class="smartlib-layout-list smartlib-vertical-list">
                    <?php while ($r->have_posts()) : $r->the_post(); ?>
                        <li class="smartlib-content-with-separator">
                            <div class="row">
                                <div class="col-xs-4 smartlib-no-padding-right">
                                    <?php
                                    if ('' != get_the_post_thumbnail() && $show_post_thumbnail) {
                                        ?>

                                        <a href="<?php the_permalink() ?>"
                                           class="smartlib-widget-image-outer"><?php the_post_thumbnail('smartlib-medium-square'); ?>
                                        </a>

                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="col-xs-8">

                                    <h4 class="widget-post-title"><a
                                            href="<?php the_permalink() ?>"><?php if (get_the_title()) the_title();
                                            else the_ID(); ?></a></h4>

                                    <p class="smartlib-meta-line">
                                        <?php do_action('smartlib_date_and_link', 'blog_loop') ?>
                                        <?php do_action('smartlib_author_line', 'blog_loop') ?>
                                    </p>

                                </div>
                            </div>
                        </li>
                    <?php endwhile;

                    wp_reset_postdata();
                    ?>
                </ul>
            <?php
            endif;
            ?>
        </div>
        <?php echo $args['after_widget']; ?>
        <?php
        // Reset the global $the_post as this query will have stomped on it
        wp_reset_postdata();


        /*
                $cache[$args['widget_id']] = ob_get_flush();
                wp_cache_set( 'widget_recent_posts', $cache, 'widget' );
        
            */
    }

    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['number'] = (int)$new_instance['number'];
        $instance['show_date'] = (bool)isset($new_instance['show_date']) ? 1 : 0;
        $instance['show_post_thumbnail'] = (bool)isset($new_instance['show_post_thumbnail']) ? 1 : 0;
        $instance['show_post_author'] = (bool)isset($new_instance['show_post_author']) ? 1 : 0;

        $this->flush_widget_cache();

        $alloptions = wp_cache_get('alloptions', 'options');
        if (isset($alloptions['widget_recent_entries']))
            delete_option('widget_recent_entries');

        return $instance;
    }

    function flush_widget_cache()
    {
        wp_cache_delete('widget_recent_posts', 'widget');
    }

    function form($instance)
    {


        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
        $number = isset($instance['number']) ? absint($instance['number']) : 5;
        $show_date = isset($instance['show_date']) ? (bool)$instance['show_date'] : false;
        $show_post_thumbnail = isset($instance['show_post_thumbnail']) ? (bool)$instance['show_post_thumbnail'] : true;
        $show_post_author = isset($instance['show_post_author']) ? (bool)$instance['show_post_author'] : true;
        ?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'bootframe-core'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
                   name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>"/></p>

        <p>
            <label
                for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts to show:', 'bootframe-core'); ?></label>
            <input id="<?php echo $this->get_field_id('number'); ?>"
                   name="<?php echo $this->get_field_name('number'); ?>"
                   type="text" value="<?php echo $number; ?>" size="3"/></p>

        <p><input class="checkbox" type="checkbox" <?php checked($show_date); ?>
                  id="<?php echo $this->get_field_id('show_date'); ?>"
                  name="<?php echo $this->get_field_name('show_date'); ?>"/>
            <label
                for="<?php echo $this->get_field_id('show_date'); ?>"><?php _e('Display post date?', 'bootframe-core'); ?></label>
        </p>

        <p><input class="checkbox" type="checkbox" <?php checked($show_post_thumbnail); ?>
                  id="<?php echo $this->get_field_id('show_post_thumbnail'); ?>"
                  name="<?php echo $this->get_field_name('show_post_thumbnail', 'bootframe-core'); ?>"/>
            <label
                for="<?php echo $this->get_field_id('show_post_thumbnail'); ?>"><?php _e('Display post thumbnail?', 'bootframe-core'); ?></label>
        </p>

        <p><input class="checkbox" type="checkbox" <?php checked($show_post_author); ?>
                  id="<?php echo $this->get_field_id('show_post_author'); ?>"
                  name="<?php echo $this->get_field_name('show_post_author'); ?>"/>
            <label
                for="<?php echo $this->get_field_id('show_post_author'); ?>"><?php _e('Display post author?', 'bootframe-core'); ?></label>
        </p>
    <?php
    }
}


/**
 * One author info widget
 *
 * @since 1.0
 *
 */
class Smart_Widget_One_Author extends WP_Widget
{

    function __construct()
    {
        $widget_ops = array('classname' => 'bootframe_one_author', 'description' => __("Short  info & avatar", 'bootframe-core'));
        parent::__construct('bootframe_one-author', __(ucfirst('bootframe-core') . ' One Author Profile', 'bootframe-core'), $widget_ops);
        $this->alt_option_name = 'smartlib-one-author';

        add_action('save_post', array($this, 'flush_widget_cache'));
        add_action('deleted_post', array($this, 'flush_widget_cache'));
        add_action('switch_theme', array($this, 'flush_widget_cache'));
    }

    function widget($args, $instance)
    {

        wp_reset_postdata();
        $title = apply_filters('widget_title', $instance['title']);


        $author = get_userdata($instance['user_id']);


        $name = $author->display_name;

        $avatar = get_avatar($instance['user_id'], $instance['size']);
        $description = get_the_author_meta('description', $instance['user_id']);
        $author_link = get_author_posts_url($instance['user_id']);


        ?>

        <?php echo $args['before_widget']; ?>
        <?php if ($title) echo $args['before_title'] . $title . $args['after_title']; ?>
        <div class="smartlib-inside-box panel-body">
            <span class="widget-image-outer"><?php echo $avatar ?></span>
            <h4><a href="<?php echo $author_link ?>"><?php echo $name ?></a></h4>

            <p class="description-widget"><?php echo $description ?></p>
            <?php echo $args['after_widget']; ?>
        </div>
    <?php
    }

    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['size'] = strip_tags($new_instance['size']);
        $instance['user_id'] = strip_tags($new_instance['user_id']);

        return $instance;
    }

    function form($instance)
    {
        if (array_key_exists('title', $instance)) {
            $title = esc_attr($instance['title']);
        } else {
            $title = '';
        }

        if (array_key_exists('user_id', $instance)) {
            $user_id = esc_attr($instance['user_id']);
        } else {
            $user_id = 1;
        }

        if (array_key_exists('size', $instance)) {
            $size = esc_attr($instance['size']);
        } else {
            $size = 64;
        }

        ?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'bootframe-core'); ?>
                <input class="widefat"
                       id="<?php echo $this->get_field_id('title'); ?>"
                       name="<?php echo $this->get_field_name('title'); ?>"
                       type="text"
                       value="<?php echo $title; ?>"/></label>
        </p>
        <p><label for="<?php echo $this->get_field_id('user_id'); ?>"><?php _e('Authot Name:', 'bootframe-core'); ?>
                <select id="<?php echo $this->get_field_id('user_id'); ?>"
                        name="<?php echo $this->get_field_name('user_id'); ?>" value="<?php echo $user_id; ?>">
                    <?php

                    $args = array(
                        'order' => 'ASC'
                    );

                    $users = get_users($args);;

                    foreach ($users as $row) {
                        echo "<option value='$row->ID' " . ($row->ID == $user_id ? "selected='selected'" : '') . ">$row->user_nicename</option>";
                    }
                    ?>
                </select></label></p>
        <p><label for="<?php echo $this->get_field_id('size'); ?>"><?php _e('Avatar Size:', 'bootframe-core'); ?>
                <select id="<?php echo $this->get_field_id('size'); ?>"
                        name="<?php echo $this->get_field_name('size'); ?>"
                        value="<?php echo $size; ?>">
                    <?php
                    for ($i = 16; $i <= 256; $i += 16) {
                        echo "<option value='$i' " . ($size == $i ? "selected='selected'" : '') . ">$i</option>";
                    }
                    ?>
                </select></label></p>
    <?php
    }

    function flush_widget_cache()
    {
        wp_cache_delete('bootframe_one_author', 'widget');
    }
}


/**
 * Add social profile icons -  widget
 *
 * @since 1.0
 *
 */
class Smart_Widget_Social_Icons extends WP_Widget
{

    public $form_args;

    function __construct()
    {
        $widget_ops = array('classname' => 'bootframe_widget_social_icons', 'description' => __("Add social profile icons", 'bootframe-core'));
        parent::__construct('smartlib-social-icons', __(ucfirst('bootframe-core') . '  Social Icons', 'bootframe-core'), $widget_ops);
        $this->alt_option_name = 'smartlib-social-icons';

        add_action('save_post', array($this, 'flush_widget_cache'));
        add_action('deleted_post', array($this, 'flush_widget_cache'));
        add_action('switch_theme', array($this, 'flush_widget_cache'));

        $this->form_args = array(
            'title',
            'facebook',
            'gplus',
            'twitter',
            'youtube',
            'pinterest',
            'linkedin',
            'rss'

        );
    }

    function widget($args, $instance)
    {
        $title = apply_filters('widget_title', $instance['title']);


        echo $args['before_widget'];
        ?>
        <?php if ($title) echo $args['before_title'] . $title . $args['after_title']; ?>
        <div class="smartlib-inside-box panel-body">
            <ul class="smartlib-layout-list smartlib-horizontal-list">
                <?php
                foreach ($this->form_args as $row) {
                    if (isset($instance[$row]) && !empty($instance[$row]) && $row != 'title') {
                        ?>
                        <li><a href="<?php echo $instance[$row] ?>"
                               class="smartlib-icon smartlib-large-square-icon smartlib-<?php echo $row ?>-ico"><i
                                    class="<?php echo apply_filters('smartlib_get_awesome_ico', 'fa fa-share', $row); ?>"></i></a>
                        </li>
                    <?php
                    }
                } ?>
            </ul>
        </div>
        <?php
        echo $args['after_widget']; ?>
    <?php
    }

    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;

        foreach ($this->form_args as $row) {
            $instance[$row] = strip_tags($new_instance[$row]);
        }

        return $instance;
    }

    function form($instance)
    {

        $form_values = array();

        foreach ($this->form_args as $row) {
            if (array_key_exists($row, $instance)) {
                $form_values[$row] = $instance[$row];
            } else {
                $form_values[$row] = '';
            }
        }

        ?>
	<p>
		<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Short Title:', 'bootframe-core'); ?>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $form_values['title']; ?>" /></label>
	<hr />
	</p>

	<p>
		<label for="<?php echo $this->get_field_id('facebook'); ?>"><?php _e('Facebook:', 'bootframe-core'); ?>
			<input class="widefat" id="<?php echo $this->get_field_id('facebook'); ?>" name="<?php echo $this->get_field_name('facebook'); ?>" type="text" value="<?php echo $form_values['facebook']; ?>" /></label>
	</p>

	<p>
		<label for="<?php echo $this->get_field_id('gplus'); ?>"><?php _e('Google+:', 'bootframe-core'); ?>
			<input class="widefat" id="<?php echo $this->get_field_id('gplus'); ?>" name="<?php echo $this->get_field_name('gplus'); ?>" type="text" value="<?php echo $form_values['gplus']; ?>" /></label>
	</p>

	<p>
		<label for="<?php echo $this->get_field_id('youtube'); ?>"><?php _e('Youtube:', 'bootframe-core'); ?>
			<input class="widefat" id="<?php echo $this->get_field_id('youtube'); ?>" name="<?php echo $this->get_field_name('youtube'); ?>" type="text" value="<?php echo $form_values['youtube']; ?>" /></label>
	</p>

	<p>
		<label for="<?php echo $this->get_field_id('twitter'); ?>"><?php _e('Twitter:', 'bootframe-core'); ?>
			<input class="widefat" id="<?php echo $this->get_field_id('twitter'); ?>" name="<?php echo $this->get_field_name('twitter'); ?>" type="text" value="<?php echo $form_values['twitter']; ?>" /></label>
	</p>

	<p>
		<label for="<?php echo $this->get_field_id('pinterest'); ?>"><?php _e('Pinterest:', 'bootframe-core'); ?>
			<input class="widefat" id="<?php echo $this->get_field_id('pinterest'); ?>" name="<?php echo $this->get_field_name('pinterest'); ?>" type="text" value="<?php echo $form_values['pinterest']; ?>" /></label>
	</p>
	<p>
		<label for="<?php echo $this->get_field_id('linkedin'); ?>"><?php _e('LinkedIn:', 'bootframe-core'); ?>
			<input class="widefat" id="<?php echo $this->get_field_id('linkedin'); ?>" name="<?php echo $this->get_field_name('linkedin'); ?>" type="text" value="<?php echo $form_values['linkedin']; ?>" /></label>
	</p>



	<?php
    }

    function flush_widget_cache()
    {
        wp_cache_delete('smartlib-social-icons', 'widget');
    }
}




/**
 * Recent Video Widget
 *
 * @since 1.0
 *
 */
class Smart_Widget_Recent_Videos extends WP_Widget
{


    function __construct()
    {
        $widget_ops = array('classname' => 'smartlib-video_widget', 'description' => __("Displays last posts from the video post format", 'bootframe-core'));
        parent::__construct('smartlib-recent-video-widget', __(ucfirst('bootframe-core') . '  Recent Video', 'bootframe-core'), $widget_ops);
        $this->alt_option_name = 'smartlib-recent-videos-widget';

        add_action('save_post', array($this, 'flush_widget_cache'));
        add_action('deleted_post', array($this, 'flush_widget_cache'));
        add_action('switch_theme', array($this, 'flush_widget_cache'));


    }

    function widget($args, $instance)
    {
        $title = apply_filters('widget_title', $instance['title']);

        $limit = is_int($instance['video_limit']) ? $instance['video_limit'] : 4;


        echo $args['before_widget'];
        ?>
        <?php if ($title) echo $args['before_title'] . $title . $args['after_title'];
        ?>
        <div class="smartlib-inside-box panel-body">
            <?php

            $query = new WP_Query(
                array(
                    'posts_per_page' => $limit,
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'post_format',
                            'field' => 'slug',
                            'terms' => array('post-format-video')
                        )
                    )
                )
            );
            if ($query->have_posts()) {
                ?>

                <ul class="smartlib-layout-list smartlib-column-list smartlib-graph-columns smartlib-2-columns-list">
                    <?php
                    while ($query->have_posts()) {
                        $query->the_post();
                        if ('' != get_the_post_thumbnail()) {
                            ?>
                            <li>
                                <a href="<?php the_permalink(); ?>"
                                   class="smartlib-thumbnail-outer"><?php the_post_thumbnail('medium-square') ?></a>
                            </li>

                        <?php
                        }
                    }
                    ?></ul>

            <?php
            }
            wp_reset_postdata();
            ?>
        </div>
        <?php
        echo $args['after_widget']; ?>
    <?php
    }

    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['video_limit'] = $new_instance['video_limit'];

        return $instance;
    }

    function form($instance)
    {

        $form_values = array();

        if (array_key_exists('title', $instance)) {
            $title = esc_attr($instance['title']);
        } else {
            $title = '';
        }

        if (array_key_exists('video_limit', $instance)) {
            $limit = esc_attr($instance['video_limit']);
        } else {
            $limit = '';
        }



        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'bootframe-core'); ?>
                <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
                       name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>"/></label>

        </p>

        <p>
            <label for="<?php echo $this->get_field_id('video_limit'); ?>"><?php _e('Limit:', 'bootframe-core'); ?>
                <input class="widefat" id="<?php echo $this->get_field_id('video_limit'); ?>"
                       name="<?php echo $this->get_field_name('video_limit'); ?>" type="text"
                       value="<?php echo $limit; ?>"/></label>

        </p>

    <?php
    }

    function flush_widget_cache()
    {
        wp_cache_delete('smartlib-recent-video-widget', 'widget');
    }
}

/**
 * Add Recent Gallery Widget
 *
 * @since 1.0
 *
 */
class Smart_Widget_Recent_Galleries extends WP_Widget
{


    function __construct()
    {
        $widget_ops = array('classname' => 'smartlib_gallery_recent_widget', 'description' => __("Displays last posts from the gallery post format", 'bootframe-core'));
        parent::__construct('smartlib-recent-gallery-widget', __(ucfirst('bootframe-core') . '  Recent Galleries', 'bootframe-core'), $widget_ops);
        $this->alt_option_name = 'smartlib-gallery_recent_widget';

        add_action('save_post', array($this, 'flush_widget_cache'));
        add_action('deleted_post', array($this, 'flush_widget_cache'));
        add_action('switch_theme', array($this, 'flush_widget_cache'));


    }

    function widget($args, $instance)
    {
        $title = apply_filters('widget_title', $instance['title']);

        $limit = is_int($instance['gallery_limit']) ? $instance['gallery_limit'] : 4;


        echo $args['before_widget'];
        ?>
        <?php if ($title) echo $args['before_title'] . $title . $args['after_title'];
        ?>
        <div class="smartlib-inside-box panel-body">
            <?php

            $query = new WP_Query(
                array(
                    'posts_per_page' => $limit,
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'post_format',
                            'field' => 'slug',
                            'terms' => array('post-format-gallery')
                        )
                    )
                )
            );
            if ($query->have_posts()) {
                ?>


                <ul class="smartlib-layout-list smartlib-column-list smartlib-graph-columns smartlib-2-columns-list">
                    <?php
                    while ($query->have_posts()) {

                        $query->the_post();

                        ?>

                        <?php

                        if ('' != get_the_post_thumbnail()) {
                            ?>
                            <li>
                                <a href="<?php the_permalink(); ?>"
                                   class="smartlib-thumbnail-outer"><?php the_post_thumbnail('medium-square') ?></a>
                            </li>
                        <?php
                        } else if (!empty($featured_image)) {
                            ?>
                            <li>
                                <a href="<?php the_permalink(); ?>"
                                   class="smartlib-thumbnail-outer"><?php echo $featured_image ?></a></li>
                        <?php

                        }
                        ?>

                    <?php
                    }
                    wp_reset_postdata();
                    ?>
                </ul>



            <?php
            }

            ?>
        </div>

        <?php
        echo $args['after_widget'];
    }

    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['gallery_limit'] = $new_instance['gallery_limit'];

        return $instance;
    }

    function form($instance)
    {

        $form_values = array();

        if (array_key_exists('title', $instance)) {
            $title = esc_attr($instance['title']);
        } else {
            $title = '';
        }

        if (array_key_exists('gallery_limit', $instance)) {
            $limit = esc_attr($instance['gallery_limit']);
        } else {
            $limit = '';
        }



        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'bootframe-core'); ?>
                <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
                       name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>"/></label>

        </p>

        <p>
            <label for="<?php echo $this->get_field_id('gallery_limit'); ?>"><?php _e('Limit:', 'bootframe-core'); ?>
                <input class="widefat" id="<?php echo $this->get_field_id('gallery_limit'); ?>"
                       name="<?php echo $this->get_field_name('gallery_limit'); ?>" type="text"
                       value="<?php echo $limit; ?>"/></label>

        </p>

    <?php
    }

    function flush_widget_cache()
    {
        wp_cache_delete('smartlib-recent-gallery-widget', 'widget');
    }

}





/**
 * Contact Form & Widget
 *
 * @since 1.0
 *
 */
class Smart_Widget_Contact_Form extends WP_Widget
{

    function __construct()
    {

        $widget_ops = array('classname' => 'smartlib-contact-form-widget', 'description' => __("Display Contact Form 7 form in Your sidebar", 'bootframe-core'));
        parent::__construct('smartlib-contact-form-widget', __(ucfirst('bootframe-core') . ' Contact Form 7 Form', 'bootframe-core'), $widget_ops);
        $this->alt_option_name = 'smartlib-contact-form-widget';

        add_action('save_post', array($this, 'flush_widget_cache'));
        add_action('deleted_post', array($this, 'flush_widget_cache'));
        add_action('switch_theme', array($this, 'flush_widget_cache'));
    }

    function widget($args, $instance)
    {

        $cache = wp_cache_get('smartlib-contact-form-widget', 'widget');

        $title = apply_filters('widget_title', empty($instance['title']) ? __('Contact Form', 'bootframe-core') : $instance['title'], $instance, $this->id_base);

        $form_id = isset($instance['form_id']) ? $instance['form_id'] : false;
        if ($form_id) {
            $contact_form = get_post($form_id);
        }


        ?>
        <?php echo $args['before_widget']; ?>
        <?php if ($title) echo apply_filters('smartlib_widget_before_title', $args['before_title'], $instance) . $title . apply_filters('smartlib_widget_after_title', $args['after_title'], $instance); ?>
        <div class="smartlib-inside-box panel-body">
            <?php
            if ($form_id) {
                echo do_shortcode('[contact-form-7 id="' . $contact_form->ID . '" title="' . $contact_form->post_title . '"]');
            }
            ?>
        </div>
        <?php echo $args['after_widget']; ?>
        <?php
        // Reset the global $the_post as this query will have stomped on it
        wp_reset_postdata();


        /*
                $cache[$args['widget_id']] = ob_get_flush();
                wp_cache_set( 'widget_recent_posts', $cache, 'widget' );

            */
    }

    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['form_id'] = (int)$new_instance['form_id'];


        $this->flush_widget_cache();

        $alloptions = wp_cache_get('alloptions', 'options');
        if (isset($alloptions['smartlib-contact-form-widget']))
            delete_option('smartlib-contact-form-widget');

        return $instance;
    }

    function flush_widget_cache()
    {
        wp_cache_delete('smartlib-contact-form-widget', 'widget');
    }

    function form($instance)
    {

        if (!defined('WPCF7_PLUGIN_NAME')) {
            ?>
            <p><?php _e('Please install Contact Form 7 plugin from', 'bootframe-core') ?> <a
                    href="https://wordpress.org/plugins/contact-form-7/">wordpress.org</a></p>
            <?php
            return;
        }

        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
        $form_id = isset($instance['form_id']) ? $instance['form_id'] : 5;

        $post_args = array('post_type' => 'wpcf7_contact_form');
        $contact_forms = get_posts($post_args);

        ?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'bootframe-core'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
                   name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>"/></p>

        <p>
            <label for="<?php echo $this->get_field_id('form_id'); ?>"><?php _e('Select Form:', 'bootframe-core'); ?></label>
            <select id="<?php echo $this->get_field_id('form_id'); ?>"
                    name="<?php echo $this->get_field_name('form_id'); ?>" class="widefat" style="width:100%;">
                <?php
                foreach ($contact_forms as $contact_form) {
                    ?>
                    <option <?php echo $contact_form->ID == $form_id ? 'selected="selected"' : '' ?>
                        value="<?php echo $contact_form->ID; ?>"><?php echo $contact_form->post_title; ?></option>
                <?php
                }
                ?>
            </select>
        </p>


    <?php
    }
}


/**
 * Add Section header widget
 *
 * @since 1.0
 *
 */
class Smart_Widget_Section_Header extends WP_Widget
{


    function __construct()
    {
        $widget_ops = array('classname' => 'smartlib-header-section-widget', 'description' => __("Section Header", 'bootframe-core'));
        parent::__construct('smartlib-header-section-widget', __(ucfirst('bootframe-core') . '  Section Header', 'bootframe-core'), $widget_ops);
        $this->alt_option_name = 'smartlib-header-section-widget';

        add_action('save_post', array($this, 'flush_widget_cache'));
        add_action('deleted_post', array($this, 'flush_widget_cache'));
        add_action('switch_theme', array($this, 'flush_widget_cache'));


    }

    function widget($args, $instance)
    {
        $title = apply_filters('widget_title', $instance['title']);

        $header_subtitle = strlen($instance['header_subtitle']) > 0 ? $instance['header_subtitle'] : '';
        $header_align = strlen($instance['header_align']) > 0 ? $instance['header_align'] : 'left';
        $header_size = strlen($instance['header_size']) ? $instance['header_size'] : 'large';

        ?>
        <?php echo $args['before_widget']; ?>
        <header
            class="smartlib-section-header<?php echo apply_filters('smartlib_algin_text', 'text-center', $header_align); ?>">
            <h2 class="<?php echo 'smartlib-header-' . $header_size ?>"><?php echo $title ?></h2>
            <?php
            if (strlen($header_align) > 0) {
                ?>
                <p><?php echo $header_subtitle ?></p>
            <?php
            }
            ?>
        </header>
        <?php echo $args['after_widget']; ?>
    <?php

    }

    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['header_size'] = strip_tags($new_instance['header_size']);
        $instance['header_align'] = $new_instance['header_align'];
        $instance['header_subtitle'] = $new_instance['header_subtitle'];

        return $instance;
    }

    function form($instance)
    {

        $form_values = array();

        if (array_key_exists('title', $instance)) {
            $title = esc_attr($instance['title']);
        } else {
            $title = '';
        }
        if (array_key_exists('header_subtitle', $instance)) {
            $header_subtitle = esc_attr($instance['header_subtitle']);
        } else {
            $header_subtitle = '';
        }
        if (array_key_exists('header_align', $instance)) {
            $header_align = esc_attr($instance['header_align']);
        } else {
            $header_align = '';
        }
        if (array_key_exists('header_size', $instance)) {
            $header_size = esc_attr($instance['header_size']);
        } else {
            $header_size = '';
        }

        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'bootframe-core'); ?>
                <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
                       name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>"/></label>

        </p>
        <p>
            <label
                for="<?php echo $this->get_field_id('header_subtitle'); ?>"><?php _e('Header Subtitle:', 'bootframe-core'); ?>
                <input class="widefat" id="<?php echo $this->get_field_id('header_subtitle'); ?>"
                       name="<?php echo $this->get_field_name('header_subtitle'); ?>" type="text"
                       value="<?php echo $header_subtitle; ?>"/></label>

        </p>
        <p>
            <label
                for="<?php echo $this->get_field_id('header_align'); ?>"><?php _e('Header Align:', 'bootframe-core'); ?></label>
            <select id="<?php echo $this->get_field_id('header_align'); ?>"
                    name="<?php echo $this->get_field_name('header_align'); ?>" class="widefat" style="width:100%;">
                <option <?php echo $header_align == 'left' ? 'selected="selected"' : '' ?>
                    value="left"><?php _e('Left Align', 'bootframe-core'); ?></option>
                <option <?php echo $header_align == 'center' ? 'selected="selected"' : '' ?>
                    value="center"><?php _e('Center Align', 'bootframe-core'); ?></option>
                <option <?php echo $header_align == 'right' ? 'selected="selected"' : '' ?>
                    value="right"><?php _e('Right Align', 'bootframe-core'); ?></option>
            </select>
        </p>
        <p>
            <label
                for="<?php echo $this->get_field_id('header_size'); ?>"><?php _e('Header Size:', 'bootframe-core'); ?></label>
            <select id="<?php echo $this->get_field_id('header_size'); ?>"
                    name="<?php echo $this->get_field_name('header_size'); ?>" class="widefat" style="width:100%;">
                <option <?php echo $header_size == 'small' ? 'selected="selected"' : '' ?>
                    value="small"><?php _e('Small', 'bootframe-core'); ?></option>
                <option <?php echo $header_size == 'medium' ? 'selected="selected"' : '' ?>
                    value="medium"><?php _e('Medium', 'bootframe-core'); ?></option>
                <option <?php echo $header_size == 'large' ? 'selected="selected"' : '' ?>
                    value="large"><?php _e('Large', 'bootframe-core'); ?></option>
            </select>
        </p>

    <?php
    }

    function flush_widget_cache()
    {
        wp_cache_delete('smartlib-recent-gallery-widget', 'widget');
    }

}

/**
 * Portfolio Items Widget
 *
 * @since 1.0
 *
 */
class Smart_Widget_Portfolio_Items extends WP_Widget
{


    function __construct()
    {
        $widget_ops = array('classname' => 'smartlib_portfolio_items_widget', 'description' => __("Displays last portfolio item", 'bootframe-core'));
        parent::__construct('smartlib_portfolio_items_widget', __(ucfirst('bootframe-core') . '  Portfolio Items', 'bootframe-core'), $widget_ops);
        $this->alt_option_name = 'smartlib_portfolio_items_widget';

        add_action('save_post', array($this, 'flush_widget_cache'));
        add_action('deleted_post', array($this, 'flush_widget_cache'));
        add_action('switch_theme', array($this, 'flush_widget_cache'));


    }

    function widget($args, $instance)
    {
        $title = apply_filters('widget_title', $instance['title']);

        $limit = is_int($instance['items_limit']) ? $instance['items_limit'] : 4;
        $portfolio_taxonomy = strlen($instance['portfolio_taxonomy']) > 0 ? (int)$instance['portfolio_taxonomy'] : 0;

        echo $args['before_widget'];
        ?>
        <?php if ($title) echo $args['before_title'] . $title . $args['after_title'];
        ?>
        <div class="smartlib-widget-content-area">
            <?php

            $query_args =
                array(
                    'posts_per_page' => $limit,
                    'post_type' => 'smartlib_portfolio',

                );

            if ($portfolio_taxonomy > 0) {

                $tax_query['tax_query'] = array(
                    array(
                        'taxonomy' => 'portfolio_category',
                        'field' => 'ID',
                        'terms' => $portfolio_taxonomy
                    )
                );
                $query_args = array_merge($query_args, $tax_query);

            }


            $query = new WP_Query($query_args);

            if ($query->have_posts()) {
                ?>


                <ul class="smartlib-layout-list smartlib-column-list smartlib-graph-columns smartlib-<?php echo $limit ?>-columns-list">
                    <?php
                    while ($query->have_posts()) {

                        $query->the_post();
                        ?>

                        <li>
                            <div class="smartlib-widget panel smartlib-caption-box">

                                <div
                                    class="smartlib-thumbnail-outer"><?php the_post_thumbnail('smartlib-large-thumb') ?></div>

                                <div class="samrtlib-caption">
                                    <aside class="smartlib-graph-info-box">
                                        <h4><?php the_title() ?></h4>
                                        <p><?php the_excerpt() ?></p>
                                    </aside>
                                </div>
                                <div class="smartlib-caption-buttons-area"><a href="<?php the_permalink(); ?>"
                                                                              class="btn btn-primary smartlib-more-link"><?php _e('View More', 'bootframe-core') ?></a>
                                </div>
                            </div>

                        </li>
                    <?php
                    }
                    wp_reset_postdata();
                    ?>
                </ul>



            <?php
            }

            ?>
        </div>

        <?php
        echo $args['after_widget'];
    }

    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['items_limit'] = $new_instance['items_limit'];
        $instance['portfolio_taxonomy'] = isset($new_instance['portfolio_taxonomy']) ? $new_instance['portfolio_taxonomy'] : '';

        return $instance;
    }

    function form($instance)
    {
        if (!defined('SMARTLIB_PLUGIN_PATH')) {
            ?>
            <p><?php _e('Please install Smartlib Tools', 'bootframe-core') ?> </p>
            <?php
            return;
        }


        if (array_key_exists('title', $instance)) {
            $title = esc_attr($instance['title']);
        } else {
            $title = '';
        }

        if (array_key_exists('items_limit', $instance)) {
            $items_limit = esc_attr($instance['items_limit']);
        } else {
            $items_limit = 4;
        }

        if (array_key_exists('portfolio_taxonomy', $instance)) {
            $portfolio_taxonomy = esc_attr($instance['portfolio_taxonomy']);
        } else {
            $portfolio_taxonomy = 0;
        }

        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'bootframe-core'); ?>
                <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
                       name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>"/></label>

        </p>
        <?php

        $terms = get_terms('portfolio_category');
        if (!empty($terms) && !is_wp_error($terms)) {
            ?>
            <p>
                <label
                    for="<?php echo $this->get_field_id('portfolio_taxonomy'); ?>"><?php _e('Portfolio Category:', 'bootframe-core'); ?>
                    <select name="<?php echo $this->get_field_name('portfolio_taxonomy'); ?>">
                        <option><?php _e('All', 'bootframe-core') ?></option>
                        <?php
                        foreach ($terms as $term) {
                            ?>
                            <option <?php echo $term->term_id == $portfolio_taxonomy ? 'selected="selected"' : '' ?>
                                value="<?php echo $term->term_id; ?>"><?php echo $term->name ?></option>
                        <?php

                        }
                        ?>
                    </select>
            </p>
        <?php
        }

        ?>


        <p>
            <label
                for="<?php echo $this->get_field_id('items_limit'); ?>"><?php _e('How many items is displayed:', 'bootframe-core'); ?></label>
            <select name="<?php echo $this->get_field_name('items_limit'); ?>">
                <option <?php echo $items_limit == '2' ? 'selected="selected"' : '' ?> value="2">2</option>
                <option <?php echo $items_limit == '3' ? 'selected="selected"' : '' ?> value="3">3</option>
                <option <?php echo $items_limit == '4' ? 'selected="selected"' : '' ?> value="4">4</option>
                <option <?php echo $items_limit == '5' ? 'selected="selected"' : '' ?> value="5">5</option>
                <option <?php echo $items_limit == '6' ? 'selected="selected"' : '' ?> value="6">6</option>
            </select>


        </p>

    <?php
    }

    function flush_widget_cache()
    {
        wp_cache_delete('smartlib-recent-gallery-widget', 'widget');
    }

}



/**
 * Testimonial Items Widget
 *
 * @since 1.0
 *
 */
class Smart_Widget_Testimonial_Items extends WP_Widget
{


    function __construct()
    {
        $widget_ops = array('classname' => 'smartlib_testimonial_items_widget', 'description' => __("Displays testimonials", 'bootframe-core'));
        parent::__construct('smartlib_testimonial_items_widget', __(ucfirst('bootframe-core') . '  Testimonials', 'bootframe-core'), $widget_ops);
        $this->alt_option_name = 'smartlib_testimonial_items_widget';

        add_action('save_post', array($this, 'flush_widget_cache'));
        add_action('deleted_post', array($this, 'flush_widget_cache'));
        add_action('switch_theme', array($this, 'flush_widget_cache'));


    }

    function widget($args, $instance)
    {

        $title = apply_filters('widget_title', $instance['title']);

        $columns_per_slide = 2;

        $query_args =
            array(

                'post_type' => 'smartlib_testimonial',

            );
        $query_testimonial = new WP_Query($query_args);
        $limit = $query_testimonial->found_posts;

        ?>


        <?php echo $args['before_widget']; ?>

        <div class="smartlib-slider-container smartlib-center-align smartlib-slider-bottom-nav">
            <ul class="smartlib-layout-list smartlib-testimonial-slides slides">
                <?php
                $i = 1;
                $j = 1;
                while ($query_testimonial->have_posts()) {


                    $query_testimonial->the_post();

                    if ($i == 1) {
                        ?>
                        <li class="smartlib-testimonial-box">
                        <div class="row">
                    <?php
                    }
                    ?>
                    <div class="col-sm-6">


                        <div class="panel smartlib-center-align">
                            <div class="panel-body smartlib-inside-box">
                                <p><?php the_content() ?></p>

                                <div class="smartlib-image-with-text-left">
                                    <span
                                        class="smartlib-image-outer pull-left"><?php the_post_thumbnail('smartlib-small-square') ?></span>

                                    <p class="smartlib-testimonial-author">
                                        <strong><?php echo get_post_meta(get_the_ID(), 'stool_client_name', true); ?></strong><br/>
                                        <small><?php echo get_post_meta(get_the_ID(), 'stool_company_name', true); ?></small>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                    if ($i % $columns_per_slide == 0 || $j == $limit) {
                        ?>
                        </div>
                        </li>
                        <?php
                        $i = 1;
                    } else {
                        $i++;
                    }

                    $j++;

                }// end while

                wp_reset_postdata();

                ?>

            </ul>
        </div>

        <?php echo $args['after_widget']; ?>
    <?php


    }

    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);

        return $instance;
    }

    function form($instance)
    {
        if (!defined('SMARTLIB_PLUGIN_PATH')) {
            ?>
            <p><?php _e('Please install Smartlib Tools', 'bootframe-core') ?> </p>
            <?php
            return;
        }


        if (array_key_exists('title', $instance)) {
            $title = esc_attr($instance['title']);
        } else {
            $title = '';
        }

        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'bootframe-core'); ?>
                <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
                       name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>"/></label>

        </p>

    <?php
    }

    function flush_widget_cache()
    {
        wp_cache_delete('smartlib-recent-gallery-widget', 'widget');
    }

}









/**
 * Sangar Slider Widget
 *
 * @since 1.0
 *
 */
class Smartlib_Widget_Sangar_Slider extends WP_Widget
{

    function __construct()
    {

        $widget_ops = array('classname' => 'smartlib-sangar-slider-widget', 'description' => __("Display Sangar Slider in Your sidebar", 'bootframe-core'));
        parent::__construct('smartlib-sangar-slider-widget', __(ucfirst('bootframe-core') . ' Sangar Slider', 'bootframe-core'), $widget_ops);


    }

    function widget($args, $instance)
    {

        $slider_id = isset($instance['slider_id']) ? $instance['slider_id'] : false;

      
        ?>
        <?php echo $args['before_widget']; ?>

        <div class="smartlib-sangar-sider-area">
            <?php
            if ($slider_id) {
                echo do_shortcode('[sangar-slider id="' . $slider_id . '"]');
            }
            ?>
        </div>
        <?php echo $args['after_widget']; ?>
        <?php
        // Reset the global $the_post as this query will have stomped on it




    }

    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;

        $instance['slider_id'] = (int)$new_instance['slider_id'];

        return $instance;
    }


    function form($instance)
    {

        if (!defined('SANGAR_SLIDER_ACTIVATED')) {
            ?>
            <p><?php _e('Please install Sangar Slider Plugin', 'bootframe-core') ?> </p>
            <?php
            return;
        }


        $slider_id = isset($instance['slider_id']) ? $instance['slider_id'] : 0;

        $post_args = array('post_type' => 'sangar_slider');
        $sliders = get_posts($post_args);

        ?>

            <label for="<?php echo $this->get_field_id('slider_id'); ?>"><?php _e('Choose slider:', 'bootframe-core'); ?></label>
            <select id="<?php echo $this->get_field_id('slider_id'); ?>"
                    name="<?php echo $this->get_field_name('slider_id'); ?>" class="widefat" style="width:100%;">
                    <option><?php _e('No slider', 'bootframe-core') ?></option>
                <?php
                foreach ($sliders as $slider) {
                    ?>
                    <option <?php echo $slider->ID == $slider_id ? 'selected="selected"' : '' ?>
                        value="<?php echo $slider->ID; ?>"><?php echo $slider->post_title; ?></option>
                <?php
                }
                ?>
            </select>
        </p>


    <?php
    }


}

/**
 * Portfolio Items Widget
 *
 * @since 1.0
 *
 */
class Smart_Widget_Last_Articles_Columns extends WP_Widget
{


    function __construct()
    {
        $widget_ops = array('classname' => 'smartlib_last_articles_columns_widget', 'description' => __("Displays the latest articles in Columns", 'bootframe-core'));
        parent::__construct('smartlib_last_articles_columns_widget', __(ucfirst('bootframe-core') . '  Last Articles in  Columns', 'bootframe-core'), $widget_ops);
        $this->alt_option_name = 'smartlib_last_articles_columns_widget';

        add_action('save_post', array($this, 'flush_widget_cache'));
        add_action('deleted_post', array($this, 'flush_widget_cache'));
        add_action('switch_theme', array($this, 'flush_widget_cache'));


    }

    function widget($args, $instance)
    {


        $limit = $instance['items_limit'] ? $instance['items_limit'] : 4;
        $articles_category = strlen($instance['articles_category']) > 0 ? (int)$instance['articles_category'] : 0;
        $show_shadow = $instance['show_shadow'];
        $show_decoration = $instance['show_decoration'];

        echo $args['before_widget'];
        echo $args['after_title'];

        ?>

        <?php

        $query_args =
            array(
                'posts_per_page' => $limit,
                'post_type' => 'post',
                'post__not_in' => get_option('sticky_posts')

            );

        if ($articles_category > 0) {

            $query_args =
                array(
                    'posts_per_page' => $limit,
                    'post_type' => 'post',
                    'cat' => $articles_category
                );

        }


        $query = new WP_Query($query_args);

        if ($query->have_posts()) {
            ?>


            <ul class="smartlib-layout-list smartlib-column-list smartlib-<?php echo $limit ?>-columns-list">
                <?php
                while ($query->have_posts()) {

                    $query->the_post();

                    $class= '';

                    if($show_shadow=='1'){

                        $class .= ' smartlib-panel-shadow';
                    }

                    if($show_decoration=='1'){

                        $class .= ' smartlib-panel-decoration';
                    }

                    ?>

                    <li>
                        <div class="panel <?php echo $class ?> smartlib-inside-box smartlib-widget">
                            <?php smartlib_post_thumbnail_block('smartlib-large-thumb', 'default') ?>

                            <div class="panel-body">
                                <h4><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h4>

                                <p><?php the_excerpt() ?></p>
                                <a href="<?php the_permalink() ?>"
                                   class="btn btn-primary"><?php _e('Read more', 'bootframe-core'); ?></a>
                        	<span class="pull-right">
											<?php do_action('smartlib_comments_count', 'default'); ?>
										</span>
                            </div>
                        </div>

                    </li>
                <?php
                }
                wp_reset_postdata();
                ?>
            </ul>



        <?php
        }

        ?>


        <?php
        echo $args['after_widget'];
    }

    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;

        $instance['items_limit'] = $new_instance['items_limit'];
        $instance['articles_category'] = isset($new_instance['articles_category']) ? $new_instance['articles_category'] : '';
        $instance['show_shadow'] = $new_instance['show_shadow'];
        $instance['show_decoration'] = $new_instance['show_decoration'];


        return $instance;
    }

    function form($instance)
    {
        $show_shadow = $instance['show_shadow'];
        $show_decoration = $instance['show_decoration'];


        if (array_key_exists('items_limit', $instance)) {
            $items_limit = $instance['items_limit'];
        } else {
            $items_limit = 4;
        }

        if (array_key_exists('articles_category', $instance)) {
            $articles_category = esc_attr($instance['articles_category']);
        } else {
            $articles_category = 0;
        }

        ?>

        <?php

        $categories = get_categories();
        if (!empty($categories) && !is_wp_error($categories)) {
            ?>
            <p>
                <label
                    for="<?php echo $this->get_field_id('articles_category'); ?>"><?php _e('Category Articles:', 'bootframe-core'); ?>
                    <select name="<?php echo $this->get_field_name('articles_category'); ?>">
                        <option><?php _e('All', 'bootframe-core') ?></option>
                        <?php
                        foreach ($categories as $term) {
                            ?>
                            <option <?php echo $term->term_id == $articles_category ? 'selected="selected"' : '' ?>
                                value="<?php echo $term->term_id; ?>"><?php echo $term->name ?></option>
                        <?php

                        }
                        ?>
                    </select>
            </p>
        <?php
        }

        ?>


        <p>
            <label
                for="<?php echo $this->get_field_id('items_limit'); ?>"><?php _e('How many items is displayed:', 'bootframe-core'); ?></label>
            <select name="<?php echo $this->get_field_name('items_limit'); ?>">
                <option <?php echo $items_limit == '2' ? 'selected="selected"' : '' ?> value="2">2</option>
                <option <?php echo $items_limit == '3' ? 'selected="selected"' : '' ?> value="3">3</option>
                <option <?php echo $items_limit == '4' ? 'selected="selected"' : '' ?> value="4">4</option>
                <option <?php echo $items_limit == '5' ? 'selected="selected"' : '' ?> value="5">5</option>
                <option <?php echo $items_limit == '6' ? 'selected="selected"' : '' ?> value="6">6</option>
            </select>


        </p>
        <p>
            <label
                for="<?php echo $this->get_field_id('show_shadow'); ?>"><?php _e('Show box shadow', 'bootframe-core'); ?></label><br />
            <input type="radio" name="<?php echo $this->get_field_name('show_shadow'); ?>" value="0" <?php echo ($show_shadow=='0')?'checked="checked"':'';?>>No<br />

            <input type="radio" name="<?php echo $this->get_field_name('show_shadow'); ?>" value="1" <?php echo ($show_shadow=='1')?'checked="checked"':'';?>>Yes
        </p>
        <p>
            <label
                for="<?php echo $this->get_field_id('show_decoration'); ?>"><?php _e('Show box decoration', 'bootframe-core'); ?></label><br />
            <input type="radio" name="<?php echo $this->get_field_name('show_decoration'); ?>" value="0" <?php echo ($show_decoration=='0')?'checked="checked"':'';?>>No<br />

            <input type="radio" name="<?php echo $this->get_field_name('show_decoration'); ?>" value="1" <?php echo ($show_decoration=='1')?'checked="checked"':'';?>>Yes
        </p>
    <?php
    }

    function flush_widget_cache()
    {
        wp_cache_delete('smartlib_last_articles_columns_widget', 'widget');
    }

}






