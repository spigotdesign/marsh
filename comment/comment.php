<article <?php hybrid_attr( 'comment' ); ?>>
	<header class="comment-meta">
		<?php echo get_avatar( $comment ); ?>
		<cite <?php hybrid_attr( 'comment-author' ); ?>><?php comment_author_link(); ?></cite><br />
		<time <?php hybrid_attr( 'comment-published' ); ?>><?php printf( __( '%s ago', 'melange' ), human_time_diff( get_comment_time( 'U' ), current_time( 'timestamp' ) ) ); ?></time>
		<a <?php hybrid_attr( 'comment-permalink' ); ?>><?php _e( 'Permalink', 'melange' ); ?></a>
		<?php edit_comment_link(); ?>
	</header>

	<div <?php hybrid_attr( 'comment-content' ); ?>>
		<?php comment_text(); ?>
	</div>

	<?php hybrid_comment_reply_link(); ?>
</article>