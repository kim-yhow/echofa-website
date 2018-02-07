<?php
/**
 * The template for displaying site navigation
 * @package Cambium
 */
?>

<nav id="site-navigation" class="main-navigation" role="navigation">
	<div class="main-navigation-inside">

		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'cambium' ); ?></a>
		<div class="toggle-menu-wrapper">
			<a href="#header-menu-responsive" title="<?php esc_attr_e( 'Menu', 'cambium' ); ?>" class="toggle-menu-control">
				<span class="toggle-menu-label"><?php esc_html_e( 'Menu', 'cambium' ); ?></span>
			</a>
		</div>

		<?php
		// Header Menu
		wp_nav_menu( apply_filters( 'cambium_header_menu_args', array(
			'container'       => 'div',
			'container_class' => 'site-header-menu',
			'theme_location'  => 'header-menu',
			'menu_class'      => 'header-menu sf-menu',
			'menu_id'         => 'menu-1',
			'depth'           => 3,
		) ) );
		?>

	</div><!-- .main-navigation-inside -->
</nav><!-- .main-navigation -->
