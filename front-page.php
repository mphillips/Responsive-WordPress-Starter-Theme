<?php
/**
 * Template Name: Front Page Template
 *
 * Description: A page template that provides a key component of WordPress as a CMS
 * by meeting the need for a carefully crafted introductory page. The front page template
 * in Twenty Twelve consists of a page content area for adding text, images, video --
 * anything you'd like -- followed by front-page-only widgets in one or two columns.
 *
 * @package WordPress
 * @subpackage Responsive_WP
 */

get_header(); ?>

<div class="container">
  <div class="row">
    <div class="col-m-12">

    	<div id="primary" class="site-content front-page">
    		<div id="content" role="main">

    			<?php while ( have_posts() ) : the_post(); ?>

    				<?php get_template_part( 'content', 'front-page' ); ?>

    			<?php endwhile; // end of the loop. ?>

    		</div><!-- #content -->
    	</div><!-- #primary -->

    </div>
  </div>
</div>

<?php get_footer(); ?>
