<?php
/**
 * The Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * Based on WordPress' Twenty Twelve Theme
 * https://wordpress.org/themes/twentytwelve
 *
 * @package WordPress
 * @subpackage Responsive_WP
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
	<meta content="width=device-width, initial-scale=1" name="viewport">
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<title><?php wp_title( '|', true, 'right' ); ?></title>

	<?php wp_head(); ?>

	<?php // Not sure how to enqueue these with IE conditionals. ?>
	<!--[if lt IE 9 &!(IEMobile)]>
	    <script src="<?php echo get_template_directory_uri(); ?>/js/vendor/html5shiv.min.js"></script>
	    <script src="<?php echo get_template_directory_uri(); ?>/js/vendor/respond.min.js"></script>
	<![endif]-->
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<div class="container">
		<div class="row">
			<div class="col-m-12">
				<header id="masthead" class="site-header clearfix" role="banner">
					<button id="menu-toggle"><?php _e( 'Menu', 'en-US' ); ?></button>

					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>

					<?php if ( bloginfo( 'description' ) ) : ?>
						<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
					<?php endif; ?>

					<nav id="site-navigation" class="main-navigation" role="navigation">
						<a class="assistive-text" href="#content" title="<?php esc_attr_e( 'Skip to content', 'en-US' ); ?>"><?php _e( 'Skip to content', 'en-US' ); ?></a>
						<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
					</nav><!-- #site-navigation -->

					<?php if ( get_header_image() ) : ?>
						<p id="site-header-image"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php header_image(); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" /></a></p>
					<?php endif; ?>
				</header><!-- #masthead -->
			</div>
		</div>
	</div>

	<div id="main" class="wrapper">
