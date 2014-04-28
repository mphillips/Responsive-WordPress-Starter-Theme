<?php
/**
 * The template for displaying a "No posts found" message
 *
 * Based on Wordpress' Twenty Twelve Theme
 * https://wordpress.org/themes/twentytwelve
 *
 * @package WordPress
 * @subpackage Responsive_WP
 */
?>

	<article id="post-0" class="post no-results not-found">
		<header class="entry-header">
			<h1 class="entry-title"><?php _e( 'Nothing Found', 'en-US' ); ?></h1>
		</header>

		<div class="entry-content">
			<p><?php _e( 'Apologies, but no results were found. Perhaps searching will help find a related post.', 'en-US' ); ?></p>
			<?php get_search_form(); ?>
		</div><!-- .entry-content -->
	</article><!-- #post-0 -->
