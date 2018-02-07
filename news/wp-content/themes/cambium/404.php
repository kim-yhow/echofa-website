<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package Cambium
 */

get_header(); ?>

	<div class="page-header-wrapper">
		<div class="container">

			<div class="row">
				<div class="col">

					<header class="page-header">
						<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'cambium' ); ?></h1>
					</header><!-- .page-header -->

				</div><!-- .col -->
			</div><!-- .row -->

		</div><!-- .container -->
	</div><!-- .page-header-wrapper -->

	<div class="site-content-inside">
		<div class="container">
			<div class="row">

				<section id="primary" class="content-area <?php cambium_layout_class( 'content' ); ?>">
					<main id="main" class="site-main" role="main">

						<div class="post-wrapper post-wrapper-single post-wrapper-single-404">
							<?php get_template_part( 'template-parts/content', '404' ); ?>
						</div><!-- .post-wrapper -->

					</main><!-- #main -->
				</section><!-- #primary -->

				<?php get_sidebar(); ?>

			</div><!-- .row -->
		</div><!-- .container -->
	</div><!-- .site-content-inside -->

<?php get_footer(); ?>
