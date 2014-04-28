<?php
/**
 * Search form
 *
 * Based on WordPress' Twenty Twelve Theme
 * https://wordpress.org/themes/twentytwelve
 *
 * @package WordPress
 * @subpackage Responsive_WP
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
  <p>
    <label class="screen-reader-text">
      <?php echo _x( 'Search for:', 'label' ); ?>
    </label>

    <input type="search" class="search-field inline-block" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder' ); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label' ); ?>" />

    <input type="submit" class="search-submit btn-inline" value="<?php echo esc_attr_x( 'Search', 'submit button' ); ?>" />
  </p>
</form>
