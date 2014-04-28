<?php
/**
 * Opens the content grid wrapper
 *
 * @package WordPress
 * @subpackage Responsive_WP
 */
?>

<div class="container">
  <div class="row">
  <?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
    <div class="col-m-8">
  <?php else : ?>
    <div class="col-m-12">
  <?php endif; ?>
