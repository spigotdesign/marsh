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

	<?php $bgimage = get_the_image(array('format' => 'array', 'size' => 'full' )); ?>

	<div class="page-marquee" style="background-image: url(<?php echo $bgimage[src]; ?>);">

		<div class="contain">

			<h1><?php the_field('main_headline'); ?></h1>

			<h2><span><?php the_field('sub_headline'); ?></h2>

		</div>

	</div>

	<div class="page-contents">

		<article <?php hybrid_attr( 'post' ); ?>>

			<?php the_content(); ?>

		</article>

	

<?php endwhile; // End found posts loop. ?>

<?php endif; // End check for posts. ?>

<?php get_footer(); // Loads the footer.php template. ?>