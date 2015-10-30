<?php
/**
 * Template Name: Front Page
 *
 * This is the template used for displaying the home page. 
 *
 * @package mcnulty
 * @subpackage Template
 */

get_header(); ?>

<?php if ( have_posts() ) : // Checks if any posts were found. ?>

<?php while ( have_posts() ) : // Begins the loop through found posts. ?>

	<?php the_post(); // Loads the post data. ?>

	<div class="page-contents">

		<?php $bgimage = get_the_image(array('format' => 'array', 'size' => 'full' )); ?>

		<section class="marquee" style="background-image: url(<?php echo $bgimage[src]; ?>);">

			<div class="contain">

				<?php the_content(); ?>

			</div>

		</section>


	</div>

<?php endwhile; // End found posts loop. ?>

<?php endif; // End check for posts. ?>

<?php get_footer(); // Loads the footer.php template. ?>