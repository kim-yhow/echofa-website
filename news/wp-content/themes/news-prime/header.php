 <?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package News_Prime
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div class="header_w_custom">
<div class="custom-header">
	<div class="custom-header-media">
		<?php the_custom_header_markup(); ?>
	</div>
</div>
<div class="header_main_top">
<div class="container-fluid header_main">
	<div class="container">
		<div class="row">
			<div class="col-sm-6 col-lg-6 col-xs-6 news_prime_date">
				
				<?php if(get_theme_mod("news_prime_header_date") != '' && get_theme_mod("news_prime_header_date") == 'on'): ?>
					<span class="news_prime_date_wrap">  <?php $news_prime_date= getdate(date("U"));
						echo " $news_prime_date[mday] $news_prime_date[month], $news_prime_date[year]";?>
					</span>
				<?php endif; ?>
				
				
			</div>
			<div class="col-sm-6 col-lg-6 col-xs-6 icon_menu">
				<ul>
					<?php if(get_theme_mod("news_prime_social_fb_sec_on_off") != '' && get_theme_mod("news_prime_social_fb_sec_on_off") == 'on'): ?>
						<li class="social-icon facebook"><a href="<?php echo esc_url(get_theme_mod("news_prime_social_fb_btn_lnk"));?>"><span class="fa fa-facebook"></span></a></li>
					<?php endif; ?>
					
					<?php if(get_theme_mod("news_prime_social_twitter_sec_on_off") != '' && get_theme_mod("news_prime_social_twitter_sec_on_off") == 'on'): ?>
						<li class="social-icon twitter"><a href="<?php echo esc_url(get_theme_mod("news_prime_social_twitter_btn_lnk"));?>"><span class="fa fa-twitter"></span></a></li>
					<?php endif; ?>
					
					<?php if(get_theme_mod("news_prime_social_linkedin_sec_on_off") != '' && get_theme_mod("news_prime_social_linkedin_sec_on_off") == 'on'): ?>
						<li class="social-icon linkedin"><a href="<?php echo esc_url(get_theme_mod("news_prime_social_linkedin_btn_lnk"));?>"><span class="fa fa-linkedin"></span></a></li>
					<?php endif; ?>
					
					<?php if(get_theme_mod("news_prime_social_google_sec_on_off") != '' && get_theme_mod("news_prime_social_google_sec_on_off") == 'on'): ?>
						<li class="social-icon google"><a href="<?php echo esc_url(get_theme_mod("news_prime_social_google_btn_lnk"));?>"><span class="fa fa-google-plus"></span></a></li>
					<?php endif; ?>
					
					<?php if(get_theme_mod("news_prime_social_rss_sec_on_off") != '' && get_theme_mod("news_prime_social_rss_sec_on_off") == 'on'): ?>
						<li class="social-icon rss"><a href="<?php echo esc_url(get_theme_mod("news_prime_social_rssfeed_btn_lnk"));?>"><span class="fa fa-rss"></span></a></li>
					<?php endif; ?>
					
				</ul>
			</div>
		</div>
	</div>	
</div>

<div class="container news-prime-header-wrap">
	<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'news-prime' ); ?></a>

		
			<header id="masthead" class="site-header" role="banner">
				<div class="col-sm-3 logo-site">
					<div class="site-branding">
						<?php
						News_Prime_custom_logo();?>
						
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<?php
						$description = get_bloginfo( 'description', 'display' );
						if ( $description || is_customize_preview() ) : ?>
							<p class="site-description"><?php echo esc_html($description); /* WPCS: xss ok. */ ?></p>
						<?php
						endif; ?>
					</div><!-- .site-branding -->
				</div>
				<div class="col-sm-9 news_prime_advertise">
					
						<?php if(get_theme_mod("news_prime_header_advs") != '' && get_theme_mod("news_prime_header_advs") == 'on'): ?>
							<a href="<?php echo esc_url(get_theme_mod("news_prime_header_advs_link"));?>" target="_blank">
								<?php if(get_theme_mod("news_prime_header_advs_img") != ''): ?>
      
								  <img src="<?php echo esc_url(get_theme_mod("news_prime_header_advs_img")); ?>" />
							  
							  <?php endif;?>
							</a>
						<?php endif; ?>
		
				</div>
			
			</header><!-- #masthead -->
	
	
	</div> <!--  #page end -->
</div> <!-- container end -->	

<div class="container-fluid news_prime_menu">
	<div class="container">
		<header id="masthead" class="site-header" role="banner">
				
				<div class="nav-section">
					<nav id="site-navigation" class="main-navigation" role="navigation">
						<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' , 'container_class'=> 'news-prime-main-nav') ); ?>
					</nav><!-- #site-navigation --> 
				</div>
				<div class="news-prime-search-form-main">
					<span class="news-prime-search-icon"><a href="javascript:void(0);"><i class="fa fa-search"></i></a></span>
					
					<div class="news-prime-search-overlay"></div>
					<div class="news-prime-search-form">
						<?php 	get_search_form();?>
						<span class="news-prime-search-close-icon"><i class="fa fa-times"></i></span>
					</div>
				</div>
			
			</header><!-- #masthead -->
	</div>
</div>	
</div>	
</div>

<!--Recent Post Widget Area on home Page-->
<?php if (is_front_page() ) : ?>
<div class="container-fluid news_prime_recent_post_main">
	<div class="container">
		<div class="news_prime_recent_post">			
				
				<?php if ( is_active_sidebar( !dynamic_sidebar('news-prime-recent-post'))) : ?>
				<?php endif; ?>
		</div>		
	</div>
</div>
<?php endif; ?>
<!--#Recent Post Widget Area on home Page-->

	<div class="container">		
	<div id="content" class="site-content">