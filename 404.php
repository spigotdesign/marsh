<?php @header( 'HTTP/1.1 404 Not found', true, 404 );

get_header(); // Loads the header.php template. ?>

	

	<div class="page-contents">

		<div class="entry">

		<h1 class="error-404-title entry-title"><?php _e( '404 Error: Page Not Found', 'melange' ); ?></h1>

			<p><?php printf( __( 'You tried going to %1$s, and it cannot be found. Sorry!', 'melange' ), '<code>' . site_url( esc_url( $_SERVER['REQUEST_URI'] ) ) . '</code>' ); ?></p>

			<p>There could be a few different reasons for this:</p>

				<ul>
					<li>The page was moved.</li>
					<li>The page no longer exists.</li>
					<li>The URL is slightly incorrect.</li>
				</ul>

			<p>To get you back on track, please use the navigation to browse, or try searching: </p>

			<?php get_search_form(); ?>

		</div>
	

<?php get_footer(); // Loads the footer.php template. ?>