<?php

/**
 * Template for comments and pingbacks.
 */
function smartlib_comment_template( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    switch ($comment->comment_type) :
        case 'pingback' :
        case 'trackback' :
// Display trackbacks differently than normal comments.
            ?>
            <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
            <p><?php _e('Pingback:', 'bootframe-core'); ?> <?php comment_author_link(); ?> <?php edit_comment_link(__('(Edit)', 'bootframe-core'), '<span class="edit-link">', '</span>'); ?></p>
            <?php
            break;
        default :
            // Proceed with normal comments.
            global $post;
            ?>
            <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
            <article id="comment-<?php comment_ID(); ?>" class="comment">
                <header class="comment-meta comment-author vcard">
                    <?php
                    $user_photo = get_user_meta($comment->user_id, 'smartlib_profile_image', true);
                    if (!empty($user_photo)) {
                        ?>
                        <img src="<?php echo $user_photo ?>" alt="User" width="44" height="44"/>
                    <?php

                    } else
                        echo get_avatar($comment, 44);
                    printf('<cite class="smartlib-comment-author comment-author fn">%1$s %2$s</cite>',
                        get_comment_author_link(),
                        // If current post author is also comment author, make it known visually.
                        ($comment->user_id === $post->post_author) ? '<span> ' . __('Post author', 'bootframe-core') . '</span>' : ''
                    );
                    printf('<span class="smartlib-comment-metadata pull-right"><a href="%1$s"><time datetime="%2$s">%3$s</time></a></span>',
                        esc_url(get_comment_link($comment->comment_ID)),
                        get_comment_time('c'),
                        /* translators: 1: date, 2: time */
                        sprintf(__('%1$s at %2$s', 'bootframe-core'), get_comment_date(), get_comment_time())
                    );
                    ?>
                    <?php edit_comment_link(__('Edit', 'bootframe-core'), '<p class="smartlib-edit-content-link">', '</p>'); ?>
                </header>
                <!-- .comment-meta -->

                <?php if ('0' == $comment->comment_approved) : ?>
                    <p class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.', 'bootframe-core'); ?></p>
                <?php endif; ?>

                <section class="comment-content comment">
                    <?php comment_text(); ?>
                </section>
                <!-- .comment-content -->

                <div class="reply smartlib-comment-replay">
                    <?php
                    echo preg_replace('/comment-reply-link/', 'comment-reply-link ' . 'btn btn-default btn-small pull-right',

                        get_comment_reply_link(array_merge($args, array(
                            'reply_text' => __('Reply', 'bootframe-core'),
                            'depth' => $depth,
                            'max_depth' => $args['max_depth']))), 1);

                    //comment_reply_link( array_merge( $args, array( , 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) );
                    ?>
                </div>
                <!-- .reply -->
            </article>
            <!-- #comment-## -->
            <?php
            break;
    endswitch; // end comment_type check
    //
}


function smartlib_box_footer()
{
    ?>
    <p class="smartlib-meta-line smartlib-footer-meta-line">
        <?php do_action('smartlib_author_line', 'blog_loop') ?>
        <span class="pull-right"><?php do_action('smartlib_comments_count', 'default') ?></span>
    </p>
<?php
}
/**
 * Display section header upper content
 * @param $title
 */

function smartlib_get_frontpage_section_header($title){

    if(strlen($title)>0){
        ?>
        <header class="smartlib-section-header text-center" style="padding: 40px 0">
            <h2 class="smartlib-header-small"><?php echo $title  ?></h2>
        </header>
    <?php
    }
}

/**
 * Display Front Page Sections
 */

function smartlib_display_frontmage_sections(){

    do_action('smartlib_frontpage_sections');

}





?>