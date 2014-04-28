<?php
/**
 * Template Name: Full-width Page Template, No Sidebar
 *
 * Description: Use this page template to remove the sidebar from any page.
 *
 * Tip: to remove the sidebar from all posts and pages simply remove
 * any active widgets from the Main Sidebar area, and the sidebar will
 * disappear everywhere.
 *
 * @package WordPress
 * @subpackage Responsive_WP
 */

get_header(); ?>

<div class="container">
  <div class="row">
    <div class="col-m-12">

    	<div id="primary" class="site-content full-width">
    		<div id="content" role="main">

    			<?php while ( have_posts() ) : the_post(); ?>
    				<?php get_template_part( 'content', 'page' ); ?>
    				<?php comments_template( '', true ); ?>
    			<?php endwhile; // end of the loop. ?>

    		</div><!-- #content -->
    	</div><!-- #primary -->

    </div>
  </div>
</div>

<?php get_footer(); ?>
