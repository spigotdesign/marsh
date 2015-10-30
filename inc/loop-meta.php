<?php $customHeader = get_header_image(); ?>

<?php if ( is_page() && !in_array( hybrid_get_theme_layout(), array( '1c' ) ) && has_post_thumbnail() ) { ?>

	<?php $bgimage = get_the_image(array('format' => 'array', 'size' => 'full' )); ?>

	<header class="page-header" style="background-image: url(<?php echo $bgimage[src]; ?>);">

		<h1 <?php hybrid_attr( 'entry-title' ); ?>><?php single_post_title(); ?></h1>

	</header>


<?php } elseif ( is_category() ) { ?>

<header class="page-header" style="background-image: url(<?php echo $customHeader; ?>);">

	<h1 class="page-title category-title"><span><?php single_cat_title(); ?></span></h1>

	<div class="loop-description category-description">
		<?php echo category_description(); ?>
	</div>

</header>

<?php } elseif ( is_tag() ) { ?>

<header class="page-header" style="background-image: url(<?php echo $customHeader; ?>);">

	<h1 class="page-title tag-title"><span><?php single_tag_title(); ?></span></h1>

	<div class="loop-description tag-description">
		<?php echo tag_description(); ?>
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
		<?php echo wpautop( sprintf( __( 'You are browsing the search results for "%s"', 'melange' ), esc_attr( get_search_query() ) ) ); ?>
	</div>

</header>

<?php } elseif ( is_post_type_archive() ) { ?>

	<?php $post_type = get_post_type_object( get_query_var( 'post_type' ) ); ?>

	<h1 class="page-title cpt-title"><span><?php post_type_archive_title(); ?></span></h1>

	<div class="loop-description cpt-description">
		<?php if ( !empty( $post_type->description ) ) echo wpautop( $post_type->description ); ?>
	</div>

<?php } elseif ( is_day() || is_month() || is_year() ) { ?>

	<?php
		if ( is_day() )
			$date = get_the_time( __( 'F d, Y', 'melange' ) );
		elseif ( is_month() )
			$date = get_the_time( __( 'F Y', 'melange' ) );
		elseif ( is_year() )
			$date = get_the_time( __( 'Y', 'melange' ) );
	?>

	<header class="page-header" style="background-image: url(<?php echo $customHeader; ?>);">

		<h1 class="page-title date-title"><span><?php echo $date; ?></span></h1>

		<div class="loop-description date-description">
			<?php echo wpautop( sprintf( __( 'You are browsing the site archives for %s.', 'melange' ), $date ) ); ?>
		</div>

	</header>

<?php } elseif ( is_archive() ) { ?>

<header class="page-header" style="background-image: url(<?php echo $customHeader; ?>);">

	<h1 class="page-title archive-title"><span><?php _e( 'Archives', 'melange' ); ?></span></h1>

	<div class="loop-description archive-description">
		<?php echo wpautop( __( 'You are browsing the site archives.', 'melange' ) ); ?>
	</div>
</header>

<?php } // End if check ?>
