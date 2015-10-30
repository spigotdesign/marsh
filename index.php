<?php get_header(); ?>

	<?php if ( !is_front_page() ) : ?>

		<?php locate_template( array( 'inc/loop-meta.php' ), true ); ?>

	<?php endif; ?>

	<div class="page-contents">

		<?php if ( have_posts() ) : ?>

		<?php if (!is_singular() ) { ?>  <div class="posts"> <?php } ?>

		<?php if (is_singular('post') ) { ?>  <div class="post-group"> <?php } ?>

		<?php while ( have_posts() ) :  ?>

			<?php the_post();  ?>

			<?php hybrid_get_content_template(); ?>

			<?php if ( is_singular() && !is_page() ) : ?>

				<?php comments_template( '', true ); ?>

			<?php endif; ?>

		<?php endwhile; ?>

		<?php if (!is_singular() ) { ?> </div> <?php } ?>

		<?php if (is_singular('post') ) { ?> </div> <?php } ?>

		<?php locate_template( array( 'inc/loop-nav.php' ), true ); ?>

		<?php else : ?>

			<?php locate_template( array( 'content/error.php' ), true ); ?>

		<?php endif; ?>

<?php get_footer();  ?>