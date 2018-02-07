<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package News_Prime
 */

?>

</div><!-- #content -->
</div><!-- #page -->
</div><!-- .container -->

<div class="conainer-fluid main-footer">
<div class="container">
	<footer id="colophon" class="site-footer" role="contentinfo">
		<div id="inner-footer" class="clearfix">
			<div class="row">				
					<div id="widget-footer" class="clearfix">

						<?php if ( is_active_sidebar( !dynamic_sidebar('news-prime-footer1'))) : ?>
							
							<div class="col-sm-2">
									
							</div>	
						
						<?php endif; ?>
				
						<?php if ( is_active_sidebar( !dynamic_sidebar('news-prime-footer2'))) : ?>
						
						<div class="col-sm-2">
							
						</div>
					
						<?php endif; ?>
						
						<?php if ( is_active_sidebar( !dynamic_sidebar('news-prime-footer3'))) : ?>

						<div class="col-sm-2">
								
						</div>	

						<?php endif; ?>
						<?php if ( is_active_sidebar( !dynamic_sidebar('news-prime-footer4'))) : ?>
						
						<div class="col-sm-2">
							
						</div>
							
						<?php endif; ?>


					</div>
				</div> 
			
		</div>	

		<div class="site-info">
			<p><?php printf(esc_html(get_theme_mod("News_Prime_copyright_text"))); ?> <a href="<?php echo esc_url( __( 'http://phoeniixx.com/', 'news-prime' ) ); ?>" rel="designer"><?php esc_html_e('phoeniixx','news-prime'); ?></a> </p>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
		</div><!-- #container -->
</div><!-- #container-fluid -->


<?php wp_footer(); ?>

</body>
</html>