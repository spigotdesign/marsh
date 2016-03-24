<?php if ( is_page() || is_singular('post') || is_category() || is_tag() ) { ?>

	<?php if ( has_post_thumbnail() ) { ?>

		<?php $bgimage = get_the_image(array('format' => 'array', 'size' => 'full' )); ?>
		<?php $bgimage = $bgimage[src]; ?>

	<?php } else { ?>

		<?php $images = get_field('header_images', 'option'); ?>
		<?php $rand = array_rand($images, 1); ?>
		<?php $bgimage = $images[$rand]['url']; ?>

	<?php } ?>

	<header class="page-marquee" style="background-image: url(<?php echo $bgimage; ?>);">

		<div class="contain">

			<h1 <?php hybrid_attr( 'entry-title' ); ?>>
				<?php single_post_title(); ?>
				<?php single_cat_title(); ?>
				<?php single_tag_title(); ?>
			</h1>

		</div>

	</header>

<?php } elseif ( is_tax() ) { ?>

<header class="page-header" style="background-image: url(<?php echo $customHeader; ?>);">

	<h1 class="page-title tax-title"><span><?php single_term_title(); ?></span></h1>

	<div class="loop-description tax-description">
		<?php echo term_description( '', get_query_var( 'taxonomy' ) ); ?>
	</div>

</header>

<?php } elseif ( is_author() ) { ?>

	<h1 class="page-title fn n author-title"><span><?php the_author_meta( 'display_name', get_query_var( 'author' ) ); ?></span></h1>

	<div class="loop-description author-description">
		<?php echo wpautop( get_the_author_meta( 'description', get_query_var( 'author' ) ) ); ?>
	</div>

<?php } elseif ( is_search() ) { ?>

<header class="page-header" style="background-image: url(<?php echo $customHeader; ?>);">

	<h1 class="page-title search-title"><span><?php echo esc_attr( get_search_query() ); ?></span></h1>

	<div class="loop-description search-description">
		<?php echo wpautop( sprintf( __( 'You are browsing the search results for "%s"', 'marsh' ), esc_attr( get_search_query() ) ) ); ?>
	</div>

</header>

<?php } elseif ( is_post_type_archive() ) { ?>

	<?php $post_type = get_post_type_object( get_query_var( 'post_type' ) ); ?>

	<h1 class="page-title cpt-title"><span><?php post_type_archive_title(); ?></span></h1>

	<div class="loop-description cpt-description">
		<?php if ( !empty( $post_type->description ) ) echo wpautop( $post_type->description ); ?>
	</div>

<?php } elseif ( is_day() || is_month() || is_year() ) { ?>

<?php $images = get_field('header_images', 'option'); ?>
		<?php $rand = array_rand($images, 1); ?>
		<?php $bgimage = $images[$rand]['url']; ?>

	<?php
		if ( is_day() )
			$date = get_the_time( __( 'F d, Y', 'marsh' ) );
		elseif ( is_month() )
			$date = get_the_time( __( 'F Y', 'marsh' ) );
		elseif ( is_year() )
			$date = get_the_time( __( 'Y', 'marsh' ) );
	?>


		<header class="page-marquee" style="background-image: url(<?php echo $bgimage; ?>);">

		<div class="contain">

			<h1 <?php hybrid_attr( 'entry-title' ); ?>><?php echo $date; ?></h1>
			<p>You're browsing the archives for <?php echo $date; ?></p>

		</div>

	</header>

	</header>



<?php } // End if check ?>
