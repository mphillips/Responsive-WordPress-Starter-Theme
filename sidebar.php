<?php
/**
 * The sidebar containing the main widget area
 *
 * If no active widgets are in the sidebar, hide it completely.
 *
 * @package WordPress
 * @subpackage Responsive_WP
 */
?>

<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
  <div class="col-m-4">
		<div id="secondary" class="widget-area" role="complementary">
			<?php dynamic_sidebar( 'sidebar-1' ); ?>
		</div><!-- #secondary -->
  </div>
<?php endif; ?>
