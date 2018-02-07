<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Cambium
 */

/**
 * Theme Mod Defaults
 *
 * @param string $theme_mod - Theme modification name.
 * @return mixed
 */
function cambium_default( $theme_mod = '' ) {

	$default = array (
		'cambium_featured_image_size' => 'landscape',
		'cambium_sidebar_position'    => 'right',
		'cambium_fullwidth_archive'   => true,
		'cambium_copyright'           => sprintf( '&copy; Copyright %1$s - <a href="%2$s">%3$s</a>', esc_html( date_i18n( __( 'Y', 'cambium' ) ) ), esc_attr( esc_url( home_url( '/' ) ) ), esc_html( get_bloginfo( 'name' ) ) ),
		'cambium_credit'              => true,
	);

	return ( isset ( $default[$theme_mod] ) ? $default[$theme_mod] : '' );

}

/**
 * Theme Mod Wrapper
 *
 * @param string $theme_mod - Name of the theme mod to retrieve.
 * @return mixed
 */
function cambium_mod( $theme_mod = '' ) {
	return get_theme_mod( $theme_mod, cambium_default( $theme_mod ) );
}

if ( ! function_exists( 'cambium_fonts_url' ) ) :
/**
 * Register fonts for theme.
 *
 * @return string Fonts URL for the theme.
 */
function cambium_fonts_url() {

    // Fonts and Other Variables
    $fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/* Translators: If there are characters in your language that are not
    * supported by Roboto, translate this to 'off'. Do not translate
    * into your own language.
    */
    if ( 'off' !== esc_html_x( 'on', 'Roboto font: on or off', 'cambium' ) ) {
		$fonts[] = 'Roboto:400,400i,700,700i';
	}

    /* Translators: If there are characters in your language that are not
    * supported by Open Sans, translate this to 'off'. Do not translate
    * into your own language.
    */
    if ( 'off' !== esc_html_x( 'on', 'Open Sans font: on or off', 'cambium' ) ) {
		$fonts[] = 'Open Sans:400,400i,700,700i';
	}

	/* Translators: To add an additional character subset specific to your language,
	* translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'.
	* Do not translate into your own language.
	*/
	$subset = esc_html_x( 'no-subset', 'Add new subset (cyrillic, greek, devanagari, vietnamese)', 'cambium' );

	if ( 'cyrillic' === $subset ) {
		$subsets .= ',cyrillic,cyrillic-ext';
	} elseif ( 'greek' === $subset ) {
		$subsets .= ',greek,greek-ext';
	} elseif ( 'devanagari' === $subset ) {
		$subsets .= ',devanagari';
	} elseif ( 'vietnamese' === $subset ) {
		$subsets .= ',vietnamese';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	/**
	 * Filters the Google Fonts URL.
	 *
	 * @param string $fonts_url Google Fonts URL.
	 */
	return apply_filters( 'cambium_fonts_url', $fonts_url );

}
endif;

/**
 * Filter 'cambium_has_sidebar'
 * We will modify the filter only, if the `cambium_has_fullwidth_archive`.
 *
 * @param bool $sidebar
 * @return bool
 */
function cambium_has_fullwidth_archive_filter( $sidebar ) {

	if ( cambium_has_fullwidth_archive() ) {
		return false; // Sidebar must be false if archive is fullwidth.
	}

	return (bool) $sidebar;

}
add_filter( 'cambium_has_sidebar', 'cambium_has_fullwidth_archive_filter', 20 );

/**
 * Filter 'get_custom_logo'
 *
 * @return string
 */
function cambium_get_custom_logo( $html ) {
	return sprintf( '<div class="site-logo-wrapper">%1$s</div>', $html );
}
add_filter( 'get_custom_logo', 'cambium_get_custom_logo' );

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @param array $args Configuration arguments.
 * @return array
 */
function cambium_page_menu_args( $args ) {
	$args['show_home'] = true;
	$args['menu_class'] = 'site-header-menu';
	return $args;
}
add_filter( 'wp_page_menu_args', 'cambium_page_menu_args' );

/**
 * Add ID and CLASS attributes to the first <ul> occurence in wp_page_menu
 */
function cambium_page_menu_class( $class ) {
  return preg_replace( '/<ul>/', '<ul class="header-menu sf-menu">', $class, 1 );
}
add_filter( 'wp_page_menu', 'cambium_page_menu_class' );

/**
 * Filter 'excerpt_length'
 *
 * @param int $length
 * @return int
 */
function cambium_excerpt_length( $length ) {
    if ( is_admin() ) {
		return $length;
	}

    // Custom Excerpt Length
    $length = 25;

	/**
	 * Filters the Excerpt length.
	 *
	 * @param int $length Excerpt Length.
	 */
	return apply_filters( 'cambium_excerpt_length', $length );
}
add_filter( 'excerpt_length', 'cambium_excerpt_length' );

/**
 * Filter 'excerpt_more'
 *
 * Remove [...] string
 * @param str $more
 * @return str
 */
function cambium_excerpt_more( $more ) {
	if ( is_admin() ) {
		return $more;
	}

	// Custom Excerpt More
    $more = '&hellip;';

    /**
	 * Filters the Excerpt more string.
	 *
	 * @param string $excerpt_more Excerpt More.
	 */
	return apply_filters( 'cambium_excerpt_more', $more );
}
add_filter( 'excerpt_more', 'cambium_excerpt_more' );

/**
 * Filter 'the_content_more_link'
 * Prevent Page Scroll When Clicking the More Link.
 *
 * @param string $link
 * @return filtered link
 */
function cambium_the_content_more_link_scroll( $link ) {
	$link = preg_replace( '|#more-[0-9]+|', '', $link );
	return $link;
}
add_filter( 'the_content_more_link', 'cambium_the_content_more_link_scroll' );

/**
 * Filter `body_class`
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function cambium_body_classes( $classes ) {

	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Site Title & Tagline Class
	if ( display_header_text() ) {
		$classes[] = 'has-site-branding';
	}

	// Custom Header
	if ( get_header_image() ) {
		$classes[] = 'has-custom-header';
	}

	// Custom Background Image
	if ( get_background_image() ) {
		$classes[] = 'has-custom-background-image';
	}

	// Full Width Archive Class
	if ( cambium_has_fullwidth_archive() ) {
		$classes[] = 'has-full-width-archive';
	}

	// Sidebar Position Class
	if ( cambium_has_sidebar() ) {
		$classes[] = 'has-' . esc_attr( cambium_mod( 'cambium_sidebar_position' ) ) . '-sidebar';
	} else if ( ! cambium_has_fullwidth_archive() ) {
		$classes[] = 'has-no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'cambium_body_classes' );

/**
 * Blog Credits.
 *
 * @return void
 */
function cambium_credits_blog() {
	$html = '<div class="credits credits-blog">'. cambium_mod( 'cambium_copyright' ) .'</div>';

	/**
	 * Filters the Blog Credits HTML.
	 *
	 * @param string $html Blog Credits HTML.
	 */
	$html = apply_filters( 'cambium_credits_blog_html', $html );

	echo convert_chars( convert_smilies( wptexturize( stripslashes( wp_filter_post_kses( addslashes( $html ) ) ) ) ) ); // WPCS: XSS OK.
}
add_action( 'cambium_credits', 'cambium_credits_blog' );

/**
 * Designer Credits.
 *
 * @return void
 */
function cambium_credits_designer() {
	$designer_string = sprintf( '%1$s %2$s <a href="%3$s" title="%4$s">%5$s</a> <span>%6$s</span> %7$s <a href="%8$s" title="%9$s">%10$s</a>',
		esc_html( 'Cambium Theme' ),
		esc_html__( 'by', 'cambium' ),
		esc_url( 'https://bestblogthemes.com' ),
		esc_attr( 'BestBlogThemes' ),
		esc_html( 'BestBlogThemes' ),
		esc_html_x( '&sdot;', 'Footer Credit Separator', 'cambium' ),
		esc_html__( 'Powered by', 'cambium' ),
		esc_url( 'https://wordpress.org' ),
		esc_attr( 'WordPress' ),
		esc_html( 'WordPress' )
	);

	// Designer HTML
	$html = '<div class="credits credits-designer">'. $designer_string .'</div>';

	/**
	 * Filters the Designer HTML.
	 *
	 * @param string $html Designer HTML.
	 */
	$html = apply_filters( 'cambium_credits_designer_html', $html );

	echo $html; // WPCS: XSS OK.
}
add_action( 'cambium_credits', 'cambium_credits_designer' );

/**
 * Enqueues front-end CSS to hide elements.
 *
 * @see wp_add_inline_style()
 */
function cambium_hide_elements() {
	// Elements
	$elements = array();

	// Credit
	if ( false === cambium_mod( 'cambium_credit' ) ) {
		$elements[] = '.credits-designer';
	}

	// Bail if their are no elements to process
	if ( 0 === count( $elements ) ) {
		return;
	}

	// Build Elements
	$elements = implode( ',', $elements );

	// Build CSS
	$css = sprintf( '%1$s { clip: rect(1px, 1px, 1px, 1px); position: absolute; }', $elements );

	// Add Inline Style
	wp_add_inline_style( 'cambium-style', cambium_minify_css( $css ) );
}
add_action( 'wp_enqueue_scripts', 'cambium_hide_elements', 11 );

/**
 * Filter in a link to a content ID attribute for the next/previous image links on image attachment pages
 */
function cambium_attachment_link( $url, $id ) {
	if ( ! is_attachment() && ! wp_attachment_is_image( $id ) ) {
		return $url;
	}

	$image = get_post( $id );
	if ( ! empty( $image->post_parent ) && $image->post_parent != $id ) {
		$url .= '#main';
	}

	return $url;
}
add_filter( 'attachment_link', 'cambium_attachment_link', 10, 2 );

if ( ! function_exists( 'cambium_the_attached_image' ) ) :
/**
 * Print the attached image with a link to the next attached image.
 *
 * @return void
 */
function cambium_the_attached_image() {
	$post                = get_post();
	/**
	 * Filter the default Cambium attachment size.
	 *
	 * @param array $dimensions {
	 *     An array of height and width dimensions.
	 *
	 *     @type int $height Height of the image in pixels. Default 1140.
	 *     @type int $width  Width of the image in pixels. Default 1140.
	 * }
	 */
	$attachment_size     = apply_filters( 'cambium_attachment_size', 'full' );
	$next_attachment_url = wp_get_attachment_url();

	if ( $post->post_parent ) { // Only look for attachments if this attachment has a parent object.

		/*
		 * Grab the IDs of all the image attachments in a gallery so we can get the URL
		 * of the next adjacent image in a gallery, or the first image (if we're
		 * looking at the last image in a gallery), or, in a gallery of one, just the
		 * link to that image file.
		 */
		$attachment_ids = get_posts( array(
			'post_parent'    => $post->post_parent,
			'fields'         => 'ids',
			'numberposts'    => 100,
			'post_status'    => 'inherit',
			'post_type'      => 'attachment',
			'post_mime_type' => 'image',
			'order'          => 'ASC',
			'orderby'        => 'menu_order ID',
		) );

		// If there is more than 1 attachment in a gallery...
		if ( count( $attachment_ids ) > 1 ) {

			foreach ( $attachment_ids as $key => $attachment_id ) {
				if ( $attachment_id === $post->ID ) {
					break;
				}
			}

			// For next attachment
			$key++;

			if ( isset( $attachment_ids[ $key ] ) ) {
				// get the URL of the next image attachment
				$next_attachment_url = get_attachment_link( $attachment_ids[$key] );
			} else {
				// or get the URL of the first image attachment
				$next_attachment_url = get_attachment_link( $attachment_ids[0] );
			}

		}

	} // end post->post_parent check

	printf( '<a href="%1$s" title="%2$s" rel="attachment">%3$s</a>',
		esc_url( $next_attachment_url ),
		esc_attr( get_the_title() ),
		wp_get_attachment_image( $post->ID, $attachment_size )
	);

}
endif;

/**
 * Minify the CSS.
 *
 * @param string $css.
 * @return minified css
 */
function cambium_minify_css( $css ) {

    // Remove CSS comments
    $css = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css );

    // Remove space after colons
	$css = str_replace( ': ', ':', $css );

	// Remove space before curly braces
	$css = str_replace( ' {', '{', $css );

    // Remove whitespace i.e tabs, spaces, newlines, etc.
    $css = str_replace( array( "\r\n", "\r", "\n", "\t", '  ', '    ', '     '), '', $css );

    return $css;
}
