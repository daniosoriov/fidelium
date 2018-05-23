<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package cshero
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
        <div class="st-comments-wrap clearfix">
            <h4 class="comments-title">
                <span><?php comments_number(__('Comments','wp_suarez'),__('1 Comments','wp_suarez'),__('% Comments','wp_suarez')); ?></span>
            </h4>

            <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
            <nav id="comment-nav-above" class="comment-navigation col-xs-12 col-sm-12 col-md-12 col-lg-12" role="navigation">
                <h1 class="screen-reader-text"><?php __( 'Comment navigation','wp_suarez'); ?></h1>
                <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments','wp_suarez') ); ?></div>
                <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;','wp_suarez') ); ?></div>
            </nav><!-- #comment-nav-above -->
            <?php endif; // check for comment navigation ?>

            <ol class="comment-list">
                <?php
                    wp_list_comments( array(
                        'style'      => 'ol',
                        'short_ping' => true,
                        'avatar_size' => 140,
                        'callback' => 'cshero_custom_form'
                    ) );
                ?>
            </ol><!-- .comment-list -->

            <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
            <nav id="comment-nav-below" class="comment-navigation" role="navigation">
                <h1 class="screen-reader-text"><?php __( 'Comment navigation','wp_suarez'); ?></h1>
                <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments','wp_suarez') ); ?></div>
                <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;','wp_suarez') ); ?></div>
            </nav><!-- #comment-nav-below -->
            <?php endif; // check for comment navigation ?>
        </div>
	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php __( 'Comments are closed.','wp_suarez'); ?></p>
	<?php endif; ?>

	<?php
	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name__mail' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	$args = array(
			'id_form'           => 'commentform',
			'id_submit'         => 'submit',
			'title_reply'       => __( 'Post a comment','wp_suarez'),
			'title_reply_to'    => __( 'Leave a Reply to %s','wp_suarez'),
			'cancel_reply_link' => __( 'Cancel Reply','wp_suarez'),
			'label_submit'      => __( 'Submit','wp_suarez'),

			'comment_field' =>  '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" placeholder="'.__('Write your comment here.','wp_suarez').'" aria-required="true">' .
			'</textarea></p>',
			'comment_notes_before' => '',
			'fields' => apply_filters( 'comment_form_default_fields', array(

					'author' =>
					'<p class="comment-form-author">'.
					'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
					'" size="30"' . $aria_req . ' placeholder="'.__('Name (Required)','wp_suarez').'"/></p>',

					'email' =>
					'<p class="comment-form-email">'.
					'<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
					'" size="30"' . $aria_req . ' placeholder="'.__('E-mail (Required)','wp_suarez').'"/></p>',

					'url' =>
					'<p class="comment-form-url">'.
					'<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
					'" size="30" placeholder="'.__('Website','wp_suarez').'"/></p>'
			)
			),
	);
	comment_form($args);
	?>

</div><!-- #comments -->
