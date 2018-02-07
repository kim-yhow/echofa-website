<?php
/**
 * news-prime functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package news-prime
 */

if ( ! function_exists( 'news_prime_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
 
function news_prime_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed at WordPress.org.
	 * If you're building a theme based on news-prime, use a find and replace
	 * to change 'news-prime' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'news-prime' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	// for custom logo
				add_theme_support( 'custom-logo', array(
					'height'      => 248,
					'width'       => 248,
					'flex-height' => true,
				) );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// Thumbnail sizes
	add_image_size( 'news-prime-featured', 600, 600, true );
	
	add_image_size( 'news-prime-featured-single', 980, 600, true );
	
	add_editor_style('editor-style.css');
	
	set_post_thumbnail_size( 825, 510, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'news-prime' ),
	) );

	
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// custom logo 
	if ( ! function_exists( 'news_prime_custom_logo' ) ) :
	/**
	* Displays the optional custom logo.
	*
	*	 Does nothing if the custom logo is not available.
	*
	* @since Twenty Fifteen 1.5
	*/
	function news_prime_custom_logo() {
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}
}
	endif;

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'news_prime_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
	
}
endif;
add_action( 'after_setup_theme', 'news_prime_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function news_prime_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'news_prime_content_width', 640 );
}
add_action( 'after_setup_theme', 'news_prime_content_width', 0 );


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function news_prime_widgets_init() {
	register_sidebar( array(
					'name'          => esc_html__( 'Sidebar', 'news-prime' ),
					'id'            => 'sidebar-1',
					'description'   => esc_html__( 'Add widgets here.', 'news-prime' ),
					'before_widget' => '<section id="%1$s" class="widget %2$s">',
					'after_widget'  => '</section>',
					'before_title'  => '<h2 class="widget-title">',
					'after_title'   => '</h2>',
				) );

	register_sidebar(array(
					'id' => 'news-prime-footer1',
					'name' => esc_html__( 'Footer 1', 'news-prime' ),
					'description'   => esc_html__( 'Add widgets here.', 'news-prime' ),
					'before_widget' => '<section id="%1$s" class="widget col-sm-3 %2$s">',
					'after_widget' => '</section>',
					'before_title' => '<h2 class="widgettitle">',
					'after_title' => '</h2>',
				));
				
				register_sidebar(array(
					'id' => 'news-prime-footer2',
					'name' => esc_html__( 'Footer 2', 'news-prime' ),
					'description'   => esc_html__( 'Add widgets here.', 'news-prime' ),
					'before_widget' => '<section id="%1$s" class="widget col-sm-3 %2$s">',
					'after_widget' => '</section>',
					'before_title' => '<h2 class="widgettitle">',
					'after_title' => '</h2>',
				));
				register_sidebar(array(
					'id' => 'news-prime-footer3',
					'name' => esc_html__( 'Footer 3', 'news-prime' ),
					'description'   => esc_html__( 'Add widgets here.', 'news-prime' ),
					'before_widget' => '<section id="%1$s" class="widget col-sm-3 %2$s">',
					'after_widget' => '</section>',
					'before_title' => '<h2 class="widgettitle">',
					'after_title' => '</h2>',
				));
				register_sidebar(array(
					'id' => 'news-prime-footer4',
					'name' => esc_html__( 'Footer 4', 'news-prime' ),
					'description'   => esc_html__( 'Add widgets here.', 'news-prime' ),
					'before_widget' => '<section id="%1$s" class="widget col-sm-3 %2$s">',
					'after_widget' => '</section>',
					'before_title' => '<h2 class="widgettitle">',
					'after_title' => '</h2>',
				));
							
				register_sidebar(array(
					'id' => 'news-prime-recent-post',
					'name' => esc_html__( 'Recent Post Widget', 'news-prime' ),
					'description'   => esc_html__( 'Add widgets here.', 'news-prime' ),
					'before_widget' => '<section id="%1$s" class="widget %2$s">',
					'after_widget' => '</section>',
					'before_title' => '<h2 class="widgettitle">',
					'after_title' => '</h2>',
				));
			

}

add_action( 'widgets_init', 'news_prime_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function news_prime_scripts() {

	wp_enqueue_script( 'news-prime-navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery'), '20151215', true );

	wp_enqueue_script( 'news-prime-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array('jquery'), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_style ( 'news-prime-raleway-font','https://fonts.googleapis.com/css?family=Merriweather|Montserrat', array(), '1.0', 'all' );

	wp_enqueue_style( 'bootstrap-css', get_template_directory_uri() .'/css/bootstrap.min.css',array(),'3.3.4' );

	wp_enqueue_style( 'font-awesome', get_template_directory_uri() .'/css/font-awesome-4.7.0/css/font-awesome.min.css',array(),'4.7.0' );

	wp_enqueue_style( 'news-prime-style', get_stylesheet_uri() );

	wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '3.3.4', true );
	
	wp_enqueue_script( 'news-prime-custom-js', get_template_directory_uri() . '/js/news-prime-custom-js.js', array('jquery'), '3.3.4', true );
	
	wp_enqueue_script( 'news-prime-custom-fronten-widgets', get_template_directory_uri(). '/js/news-prime-custom-fronten-widgets.js' ,array('jquery'), '1.0', true);
	
	wp_enqueue_style( 'news-prime-slider', get_template_directory_uri() .'/css/news-prime-slider.css',array(),'3.3.5' );
	
}  

add_action( 'wp_enqueue_scripts', 'news_prime_scripts' );

// admin script
function news_prime_admin_script($news_prime_hook){
	
	if($news_prime_hook != 'appearance_page_news_prime_pro') {
		return;
	} 
    
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() .'/css/font-awesome-4.7.0/css/font-awesome.min.css',array(),'4.7.0' );
	wp_enqueue_style( 'news-prime-custom-css', get_template_directory_uri() .'/css/news-prime-custom.css',array(),'1.0' );

}

add_action( 'admin_enqueue_scripts', 'news_prime_admin_script' );
			
// Display an optional post thumbnail.
if ( ! function_exists( 'news_prime_post_thumbnail')) :

	function news_prime_post_thumbnail() {
	
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
	
			return;
	
		}
	
	
		if ( is_singular() ) :	
	
		?>
	
	
		<div class="entry-summary">
	
			<?php the_post_thumbnail(); ?>
	
		</div><!-- .post-thumbnail -->
	
	
		<?php else : ?>
	
	
		<div class="post-thumbnail">
			<a href="<?php the_permalink(); ?>">
	
				<?php
	
					the_post_thumbnail('post-thumbnail', array( 'alt' => get_the_title() ));
	
				?>
	
			</a>
		</div>
	
	
	
		<?php endif; // End is_singular()
	
	}

endif;
	
/**
 * Clean up the_excerpt()
 */
function news_prime_excerpt_length($length) {
	
	if ( is_admin() ) {
        return $length;
    }else{
		return 50;
	}
	
}		

add_filter('excerpt_length', 'news_prime_excerpt_length');

function news_prime_excerpt_more($more) {
 
	if ( is_admin() ) {
		return $more;
	}

	$more = sprintf( '<p class="link-more"><a href="%1$s" class="more-link">%2$s</a></p>',
		esc_url( get_permalink( get_the_ID() ) ),
		/* translators: %s: Name of current post */
		sprintf( __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'news-prime' ), get_the_title( get_the_ID() ) )
	);
	return ' &hellip; ' . $more;
 
}

add_filter('excerpt_more', 'news_prime_excerpt_more');	


/*Add theme menu page*/
 
add_action('admin_menu', 'news_prime_menu');

function news_prime_menu() {
	
	$news_prime_page_title = __("News Prime",'news-prime');
	
	$news_prime_menu_title = __("News Prime",'news-prime');
	
	add_theme_page($news_prime_page_title, $news_prime_menu_title, 'edit_theme_options', 'news_prime_pro', 'news_prime_pro_page');  
	
} 

/*
**
** Premium Theme Feature Page
**
*/

function news_prime_pro_page(){
	
	if ( is_admin() ) {
		
		$importer_active=sanitize_text_field((string)$_GET['active_class']);
		
		$importer_new = (isset($importer_active))?$importer_active:'';
		?>
		
		<div id="profile-page" class="wrap">
		
			<h2><?php _e( 'News Prime', 'news-prime' ) ?></h2>
			
			<h2 class="nav-tab-wrapper woo-nav-tab-wrapper">
			
				<a class="nav-tab<?php  if($importer_new==1 || $importer_new==''){ echo esc_attr( " active" ); }?>" href="?page=news_prime_pro&amp;importer=demo-documentation&amp;active_class=1"><?php _e('Live Demo and Documentation','news-prime'); ?></a>
				
				<a class="nav-tab<?php  if($importer_new==2){ echo esc_attr( " active" ); }?>" href="?page=news_prime_pro&amp;importer=free-vs-pro&amp;active_class=2"><?php _e('Free Vs Pro','news-prime'); ?></a>
				
				<a class="nav-tab<?php  if($importer_new==3){ echo esc_attr( " active" ); }?>" href="?page=news_prime_pro&amp;importer=phoen-data-importer&amp;active_class=3"><?php _e('One Click Demo Import','news-prime'); ?></a>
			
			</h2>
					
		</div>
	
		<?php
		
		$coupon_importer=sanitize_text_field($_GET['importer']);
		
		$importer = (isset($coupon_importer))?$coupon_importer:'';
		 
		if($importer=='' || $importer == 'demo-documentation'){
			 
			 include_once( get_template_directory(). '/inc/admin/premium-screen/demo-documentation.php');
			 
		}elseif($importer == 'free-vs-pro' ){
			 
			 include_once( get_template_directory(). '/inc/admin/premium-screen/index.php');
			 
		}elseif ($importer == 'phoen-data-importer' ) { ?>
		 
			<div class="demo-import-tab-content info-tab-content">
				<?php if ( has_action( 'news-prime_phoen_importer_tab_main' ) ) {
					do_action( 'news-prime_phoen_importer_tab_main' );
				} else { ?>
					<div id="plugin-filter" class="demo-import-boxed">
						<?php
					   $plugin_name = 'theme-data-importor-by-phoeniixx';
						$status = is_dir( WP_PLUGIN_DIR . '/' . $plugin_name );
						$button_class = 'install-now button';
						$button_txt = esc_html__( 'Install Now', 'news-prime' );
						if ( ! $status ) {
							$install_url = wp_nonce_url(
								add_query_arg(
									array(
										'action' => 'install-plugin',
										'plugin' => $plugin_name
									),
									network_admin_url( 'update.php' )
								),
								'install-plugin_'.$plugin_name
							);

						} else {
							$install_url = add_query_arg(array(
								'action' => 'activate',
								'plugin' => rawurlencode( $plugin_name . '/' . $plugin_name . '.php' ),
								'plugin_status' => 'all',
								'paged' => '1',
								'_wpnonce' => wp_create_nonce('activate-plugin_' . $plugin_name . '/' . $plugin_name . '.php'),
							), network_admin_url('plugins.php'));
							$button_class = 'activate-now button-primary';
							$button_txt = esc_html__( 'Active Now', 'news-prime' );
						}

						$detail_link = add_query_arg(
							array(
								'importer' => 'plugin-information',
								'plugin' => $plugin_name,
								'TB_iframe' => 'true',
								'width' => '772',
								'height' => '349',

							),
							network_admin_url( 'plugin-install.php' )
						);

						echo '<p>';
						printf( esc_html__(
							'%1$s you will need to install and activate the %2$s plugin first.', 'news-prime' ),
							'<b>'.esc_html__( 'Hey.', 'news-prime' ).'</b>',
							'<a class="thickbox open-plugin-details-modal" href="'.esc_url( $detail_link ).'">'.esc_html__( 'One Click Demo Importer By Phoeniixx', 'news-prime' ).'</a>'
						);
						echo '</p>';

						echo '<p class="plugin-card-'.esc_attr( $plugin_name ).'"><a href="'.esc_url( $install_url ).'" data-slug="'.esc_attr( $plugin_name ).'" class="'.esc_attr( $button_class ).'">'.$button_txt.'</a></p>';

						?>
					</div>
					<?php
				} ?>
			</div>
			<?php 
		}
		
	} 

}

/**
*Load News Prime Widget
*/
require get_template_directory() . '/inc/widgets/news_prime_style1.php';
require get_template_directory() . '/inc/widgets/news_prime_style2.php';
require get_template_directory() . '/inc/widgets/news_prime_popular_post.php';
require get_template_directory() . '/inc/widgets/news_prime_author.php';
require get_template_directory() . '/inc/widgets/news_prime_recent_post.php';
require get_template_directory() . '/inc/widgets/news_prime_sidebar_tab.php';
require get_template_directory() . '/inc/widgets/news_prime_images_slider.php';

/* Include Premium Button Class File*/
require_once( trailingslashit( get_template_directory() ) . 'trt-customize-pro/premium/class-customize.php' );

/**
 * Implement the TGM 
 */
require get_template_directory() . '/inc/libs/execute-libs.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';


require get_template_directory(). '/inc/phoen_dashboard.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';