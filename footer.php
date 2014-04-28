<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * Based on Wordpress' Twenty Twelve Theme
 * https://wordpress.org/themes/twentytwelve
 *
 * @package WordPress
 * @subpackage Responsive_WP
 */
?>
  </div><!-- #main .wrapper -->

  <div class="container">
    <div class="row">
      <div class="col-m-12">
        <footer id="colophon" role="contentinfo">
      		<div class="site-info">
      			&copy; <?php echo date('Y') ?>
      		</div><!-- .site-info -->
        </footer><!-- #colophon -->
      </div>
    </div>
  </div>
</div><!-- #page -->

<?php // Not sure how to enqueue these with IE conditionals. ?>
<!--[if IE 8]>
<script src="<?php echo get_template_directory_uri(); ?>/js/vendor/jquery-1.11.0.min.js"></script>
<![endif]-->

<!--[if gt IE 8]><!-->
<script src="<?php echo get_template_directory_uri(); ?>/js/vendor/jquery-2.1.0.min.js"></script>
<!--<![endif]-->

<?php wp_footer(); ?>

</body>
</html>
