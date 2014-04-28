<?php
/**
 * The Template for displaying all single posts
 *
 * Based on Wordpress' Twenty Twelve Theme
 * https://wordpress.org/themes/twentytwelve
 *
 * @package WordPress
 * @subpackage Responsive_WP
 */

get_header(); ?>

<?php get_template_part( 'content-wrapper', 'open' ); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', get_post_format() ); ?>

				<nav class="nav-single clearfix">
					<h3 class="assistive-text"><?php _e( 'Post navigation', 'en-US' ); ?></h3>
					<span class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'en-US' ) . '</span> %title' ); ?></span>
					<span class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'en-US' ) . '</span>' ); ?></span>
				</nav><!-- .nav-single -->

				<?php comments_template( '', true ); ?>

			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_template_part( 'content-primary', 'close' ); ?>

<?php get_sidebar(); ?>

<?php get_template_part( 'content-wrapper', 'close' ); ?>

<?php get_footer(); ?>
