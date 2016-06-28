<?php

// Do not delete these lines
	if ( ! empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename( $_SERVER['SCRIPT_FILENAME'] ) )
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<div class="alert alert-help">
			<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', 'luxe_framework' ); ?></p>
		</div>
	<?php
		return;
	}
?>

<?php // You can start editing here. ?>

<?php if ( have_comments() ) : ?>
	<h4 id="comments" class=""><?php comments_number( __( '<span>No</span> comments', 'luxe_framework' ), __( 'Showing <span>1</span> comment', 'luxe_framework' ), _n( 'Showing <span>%</span> comment', 'Showing <span>%</span> comments', get_comments_number(), 'luxe_framework' ) );?></h4>

	<nav class="comment-nav">
		<ul class="clearfix">
				<li><?php previous_comments_link() ?></li>
				<li><?php next_comments_link() ?></li>
		</ul>
	</nav>

	<ol class="commentlist">
		<?php wp_list_comments( 'type=comment&callback=luxe_comments' ); ?>
	</ol>

	<nav class="comment-nav">
		<ul class="clearfix">
				<li><?php previous_comments_link() ?></li>
				<li><?php next_comments_link() ?></li>
		</ul>
	</nav>

	<?php else : // this is displayed if there are no comments so far ?>

	<?php if ( comments_open() ) : ?>
			<?php // If comments are open, but there are no comments. ?>

	<?php else : // comments are closed ?>

	<?php // If comments are closed. ?>
	<!--p class="nocomments"><?php _e( 'Comments are closed.', 'luxe_framework' ); ?></p-->

	<?php endif; ?>

<?php endif; ?>


<?php if ( comments_open() ) : ?>

<section id="respond" class="respond-form">


	<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
		<div class="alert alert-help">
			<p><?php printf( __( 'You must be %1$slogged in%2$s to post a comment.', 'luxe_framework' ), '<a href="<?php echo wp_login_url( get_permalink() ); ?>">', '</a>' ); ?></p>
		</div>
	<?php else : ?>

	<?php

		$commenter = wp_get_current_commenter();
		$req = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true'" : '' );

		$fields =  array(

		  'author' =>
		    '<p class="comment-form-author"><label for="author">' . __( 'Name', 'domainreference' ) . '</label> ' .
		    ( $req ? '<span class="required">*</span>' : '' ) .
		    '<input id="author" name="author" type="text" placeholder="'. __( 'Name', 'luxe_framework' ) .'" value="' . esc_attr( $commenter['comment_author'] ) .
		    '" size="30"' . $aria_req . ' /></p>',

		  'email' =>
		    '<p class="comment-form-email"><label for="email">' . __( 'Email', 'domainreference' ) . '</label> ' .
		    ( $req ? '<span class="required">*</span>' : '' ) .
		    '<input id="email" name="email" type="text" placeholder="'. __( 'Enter email', 'luxe_framework' ) .'" value="' . esc_attr(  $commenter['comment_author_email'] ) .
		    '" size="30"' . $aria_req . ' /></p>',

		);

		$args = array(
			'id_form'           => 'commentform',
			'id_submit'         => 'submit',
			'title_reply'       => __( 'Leave a Comment', 'luxe_framework' ),
			'title_reply_to'    => __( 'Leave a Reply to %s', 'luxe_framework'  ),
			'cancel_reply_link' => __( 'Cancel Reply', 'luxe_framework'  ),
			'label_submit'      => __( 'Leave a Comment', 'luxe_framework'  ),

			'comment_field' =>  '<p class="comment-form-comment"><label for="comment">' . __( 'Comment', 'luxe_framework' ) .
			'</label><textarea id="comment" placeholder="'. __( 'Comment', 'luxe_framework' ) .'" name="comment" cols="45" rows="8" aria-required="true">' .
			'</textarea></p>',	
			'fields' => apply_filters( 'comment_form_default_fields', $fields),
			);


		comment_form($args, $post->ID); 

	?>

	<?php endif; // If registration required and not logged in ?>
</section>

<?php endif; // if you delete this the sky will fall on your head ?>
