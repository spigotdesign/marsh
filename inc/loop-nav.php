	<?php if ( is_attachment() ) : ?>

		<nav class="loop-nav">
			<?php previous_post_link( '%link', '<span class="previous">' . __( '&larr; Return to entry', 'melange' ) . '</span>' ); ?>
		</nav>

	<?php elseif ( is_singular( 'post' ) ) : ?>

		<nav class="loop-nav">
			<?php previous_post_link( '%link', '<span class="previous">' . __( '&larr; Previous', 'melange' ) . '</span>' ); ?>
			<?php next_post_link( '%link', '<span class="next">' . __( 'Next &rarr;', 'melange' ) . '</span>' ); ?>
		</nav>

	<?php elseif ( !is_singular() && current_theme_supports( 'loop-pagination' ) ) : loop_pagination( array( 'prev_text' => __( '&larr; Previous', 'melange' ), 'next_text' => __( 'Next &rarr;', 'melange' ) ) ); ?>

	<?php elseif ( !is_singular() && $nav = get_posts_nav_link( array( 'sep' => '', 'prelabel' => '<span class="previous">' . __( '&larr; Previous', 'melange' ) . '</span>', 'nxtlabel' => '<span class="next">' . __( 'Next &rarr;', 'melange' ) . '</span>' ) ) ) : ?>

		<nav class="loop-nav">
			<?php echo $nav; ?>
		</nav><!-- .loop-nav -->

	<?php endif; ?>