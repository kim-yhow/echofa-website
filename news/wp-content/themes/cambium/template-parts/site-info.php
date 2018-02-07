<?php
/**
 * The template for displaying site info
 * @package Cambium
 */
?>

<div class="site-info">
	<div class="site-info-inside">

		<div class="container">

			<?php if ( has_nav_menu( 'footer-menu' ) ) : ?>
			<div class="row">
				<div class="col">
					<nav id="secondary-navigation" class="secondary-navigation" role="navigation">
						<?php
						wp_nav_menu( apply_filters( 'cambium_footer_menu_args', array(
							'container'       => 'div',
							'container_class' => 'site-footer-menu',
							'fallback_cb'     => false,
							'theme_location'  => 'footer-menu',
							'menu_class'      => 'footer-menu',
							'menu_id'         => 'menu-2',
							'depth'           => 1,
						) ) );
						?>
					</nav><!-- .secondary-navigation -->
				</div><!-- .col -->
			</div><!-- .row -->
			<?php endif; ?>

			<?php if ( has_nav_menu( 'social-menu-footer' ) ) : ?>
			<div class="row">
				<div class="col">
					<?php
					wp_nav_menu( apply_filters( 'cambium_social_menu_footer_args', array(
						'container'       => 'div',
						'container_class' => 'site-social-menu site-social-menu-footer',
						'fallback_cb'     => false,
						'theme_location'  => 'social-menu-footer',
						'menu_class'      => 'social-menu-footer',
						'menu_id'         => 'menu-5',
						'depth'           => 1,
						'link_before'     => '<span class="screen-reader-text">',
						'link_after'      => '</span>',
					) ) );
					?>
				</div><!-- .col -->
			</div><!-- .row -->
			<?php endif; ?>

			<div class="row">
				<div class="col">
					<div class="credits-wrapper">
						<?php do_action( 'cambium_credits' ); ?>
					</div><!-- .credits -->
				</div><!-- .col -->
			</div><!-- .row -->

		</div><!-- .container -->

	</div><!-- .site-info-inside -->
</div><!-- .site-info -->
