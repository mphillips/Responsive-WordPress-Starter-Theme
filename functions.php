<?php
/**
 * Responsive WP
 *
 * Based on WordPress' Twenty Twelve Theme
 * https://wordpress.org/themes/twentytwelve
 * @package WordPress
 * @subpackage Responsive_WP
 */

// Set up the content width value based on the theme's design and stylesheet.
if ( ! isset( $content_width ) ) {
	$content_width = 720;
}

/**
 * Sets up theme defaults and registers the various WordPress features.
 */
function responsivewp_setup() {
	load_theme_textdomain( 'en-US', get_template_directory() . '/languages' );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// This theme supports a variety of post formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'link', 'quote', 'status', 'gallery') );

	// This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', __( 'Primary Menu', 'en-US' ) );

	/*
	 * This theme supports custom background color and image,
	 * and here we also set up the default background color.
	 */
	add_theme_support( 'custom-background', array(
		'default-color' => 'ffffff',
	) );

	// This theme uses a custom image size for featured images, displayed on "standard" posts.
	add_theme_support( 'post-thumbnails' );

	set_post_thumbnail_size( 720, 9999 ); // Unlimited height, soft crop
}

add_action( 'after_setup_theme', 'responsivewp_setup' );

/**
 * Enqueue scripts and styles for front-end.
 */
function responsivewp_scripts_styles() {
	global $wp_styles;

	wp_enqueue_script( 'ie10mobilefix', get_template_directory_uri() . '/js/responsive.ie10mobilefix.min.js', array(), false, false );

	// Loads our main stylesheet.
	wp_enqueue_style( 'responsivewp-style', get_stylesheet_uri() );

	/*
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'responsivejs', get_template_directory_uri() . '/js/responsive.min.js', array(), false, true );

	// Adds JavaScript for handling the navigation menu hide-and-show behavior.
	wp_enqueue_script( 'responsivewp-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '1.0', true );
}

add_action( 'wp_enqueue_scripts', 'responsivewp_scripts_styles' );

/**
 * Filter the page title.
 *
 * Creates a nicely formatted and more specific title element text
 * for output in head of document, based on current view.
 */
function responsivewp_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() ) {
		return $title;
	}

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );

	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 ) {
		$title = "$title $sep " . sprintf( __( 'Page %s', 'en-US' ), max( $paged, $page ) );
	}

	return $title;
}

add_filter( 'wp_title', 'responsivewp_wp_title', 10, 2 );

/**
 * Filter the page menu arguments.
 *
 * Makes our wp_nav_menu() fallback -- wp_page_menu() -- show a home link.
 */
function responsivewp_page_menu_args( $args ) {
	if ( ! isset( $args['show_home'] ) ) {
		$args['show_home'] = true;
	}

	return $args;
}

add_filter( 'wp_page_menu_args', 'responsivewp_page_menu_args' );

/**
 * Register sidebars.
 *
 * Registers our main widget area and the front page widget areas.
 */
function responsivewp_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Main Sidebar', 'en-US' ),
		'id' => 'sidebar-1',
		'description' => __( 'Appears on posts and pages except the optional Front Page template, which has its own widgets', 'en-US' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'First Front Page Widget Area', 'en-US' ),
		'id' => 'sidebar-2',
		'description' => __( 'Appears when using the optional Front Page template with a page set as Static Front Page', 'en-US' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Second Front Page Widget Area', 'en-US' ),
		'id' => 'sidebar-3',
		'description' => __( 'Appears when using the optional Front Page template with a page set as Static Front Page', 'en-US' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}

add_action( 'widgets_init', 'responsivewp_widgets_init' );

if ( ! function_exists( 'responsivewp_content_nav' ) ) :
	/**
	 * Displays navigation to next/previous pages when applicable.
	 */
	function responsivewp_content_nav( $html_id ) {
		global $wp_query;

		$html_id = esc_attr( $html_id );

		if ( $wp_query->max_num_pages > 1 ) : ?>
			<nav id="<?php echo $html_id; ?>" class="navigation" role="navigation">
				<h3 class="assistive-text"><?php _e( 'Post navigation', 'en-US' ); ?></h3>
				<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'en-US' ) ); ?></div>
				<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'en-US' ) ); ?></div>
			</nav><!-- #<?php echo $html_id; ?> .navigation -->
		<?php endif;
}
endif;

if ( ! function_exists( 'responsivewp_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own responsivewp_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 */
function responsivewp_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php _e( 'Pingback:', 'en-US' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'en-US' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
		// Proceed with normal comments.
		global $post;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<header class="comment-meta comment-author vcard">
				<?php
					echo get_avatar( $comment, 44 );
					printf( '<cite><b class="fn">%1$s</b> %2$s</cite>',
						get_comment_author_link(),
						// If current post author is also comment author, make it known visually.
						( $comment->user_id === $post->post_author ) ? '<span class="author-tag">' . __( 'Post author', 'en-US' ) . '</span>' : ''
					);
					printf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
						esc_url( get_comment_link( $comment->comment_ID ) ),
						get_comment_time( 'c' ),
						/* translators: 1: date, 2: time */
						sprintf( __( '%1$s at %2$s', 'en-US' ), get_comment_date(), get_comment_time() )
					);
				?>
			</header><!-- .comment-meta -->

			<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'en-US' ); ?></p>
			<?php endif; ?>

			<section class="comment-content comment">
				<?php comment_text(); ?>
				<?php edit_comment_link( __( 'Edit', 'en-US' ), '<p class="edit-link">', '</p>' ); ?>
			</section><!-- .comment-content -->

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'en-US' ), 'after' => ' <span>&darr;</span>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->
	<?php
		break;
	endswitch; // end comment_type check
}
endif;

if ( ! function_exists( 'responsivewp_entry_meta' ) ) :
	/**
	 * Set up post entry meta.
	 *
	 * Prints HTML with meta information for current post: categories, tags, permalink, author, and date.
	 *
	 * Create your own responsivewp_entry_meta() to override in a child theme.
	 */
	function responsivewp_entry_meta() {
		// Translators: used between list items, there is a space after the comma.
		$categories_list = get_the_category_list( __( ', ', 'en-US' ) );

		// Translators: used between list items, there is a space after the comma.
		$tag_list = get_the_tag_list( '', __( ', ', 'en-US' ) );

		$date = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>',
			esc_url( get_permalink() ),
			esc_attr( get_the_time() ),
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() )
		);

		$author = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( __( 'View all posts by %s', 'en-US' ), get_the_author() ) ),
			get_the_author()
		);

		// Translators: 1 is category, 2 is tag, 3 is the date and 4 is the author's name.
		if ( $tag_list ) {
			$utility_text = __( 'This entry was posted in %1$s and tagged %2$s on %3$s<span class="by-author"> by %4$s</span>.', 'en-US' );
		} elseif ( $categories_list ) {
			$utility_text = __( 'This entry was posted in %1$s on %3$s<span class="by-author"> by %4$s</span>.', 'en-US' );
		} else {
			$utility_text = __( 'This entry was posted on %3$s<span class="by-author"> by %4$s</span>.', 'en-US' );
		}

		printf(
			$utility_text,
			$categories_list,
			$tag_list,
			$date,
			$author
		);
	}
endif;

/**
 * Extend the default WordPress body classes.
 *
 * Extends the default WordPress body class to denote:
 * 1. Using a full-width layout, when no active widgets in the sidebar
 *    or full-width template.
 * 2. Front Page template: thumbnail in use and number of sidebars for
 *    widget areas.
 * 3. White or empty background color to change the layout and spacing.
 * 4. Custom fonts enabled.
 * 5. Single or multiple authors.
 */
function responsivewp_body_class( $classes ) {
	$background_color = get_background_color();
	$background_image = get_background_image();

	if ( ! is_active_sidebar( 'sidebar-1' ) || is_page_template( 'full-width.php' ) ) {
		$classes[] = 'full-width';
	}

	if ( is_page_template( 'front-page.php' ) ) {
		$classes[] = 'template-front-page';

		if ( has_post_thumbnail() ) {
			$classes[] = 'has-post-thumbnail';
		}

		if ( is_active_sidebar( 'sidebar-2' ) && is_active_sidebar( 'sidebar-3' ) ) {
			$classes[] = 'two-sidebars';
		}
	}

	if ( empty( $background_image ) ) {
		if ( empty( $background_color ) ) {
			$classes[] = 'custom-background-empty';
		}
		elseif ( in_array( $background_color, array( 'fff', 'ffffff' ) ) ) {
			$classes[] = 'custom-background-white';
		}
	}

	// Enable custom font class only if the font CSS is queued to load.
	if ( wp_style_is( 'responsivewp-fonts', 'queue' ) ) {
		$classes[] = 'custom-font-enabled';
	}

	if ( ! is_multi_author() ) {
		$classes[] = 'single-author';
	}

	return $classes;
}

add_filter( 'body_class', 'responsivewp_body_class' );

/**
 * Adjust content width in certain contexts.
 *
 * Adjusts content_width value for full-width and single image attachment
 * templates, and when there are no active widgets in the sidebar.
 */
function responsivewp_content_width() {
	if ( is_page_template( 'full-width.php' ) || is_attachment() || ! is_active_sidebar( 'sidebar-1' ) ) {
		global $content_width;
		$content_width = 960;
	}
}

add_action( 'template_redirect', 'responsivewp_content_width' );

/**
 * Register postMessage support.
 *
 * Add postMessage support for site title and description for the Customizer.
 */
function responsivewp_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}

add_action( 'customize_register', 'responsivewp_customize_register' );

/**
 * Enqueue Javascript postMessage handlers for the Customizer.
 *
 * Binds JS handlers to make the Customizer preview reload changes asynchronously.
 */
function responsivewp_customize_preview_js() {
	wp_enqueue_script( 'responsivewp-customizer', get_template_directory_uri() . '/js/theme-customizer.js', array( 'customize-preview' ), '20130301', true );
}

add_action( 'customize_preview_init', 'responsivewp_customize_preview_js' );

// Hide the admin bar on the public site
add_filter('show_admin_bar', '__return_false');
