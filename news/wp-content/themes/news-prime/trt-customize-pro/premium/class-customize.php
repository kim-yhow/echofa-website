<?php
/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class News_Prime_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function news_prime_get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->news_prime_setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function news_prime_setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'news_prime_sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'news_prime_enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	 */ 
	public function news_prime_sections( $news_prime_manager ) {

		// Load custom sections.
		require_once( trailingslashit( get_template_directory() ) . 'trt-customize-pro/premium/section-pro.php' );

		// Register custom section types.
		$news_prime_manager->register_section_type( 'News_Prime_Customize_Section_Pro' );

		// Register sections.
		$news_prime_manager->add_section(
			new News_Prime_Customize_Section_Pro(
				$news_prime_manager,
				'news_prime_pro',
				array(
					'title'    => esc_html__( 'News Prime Pro', 'news-prime' ),
					'pro_text' => esc_html__( 'Go Pro','news-prime' ),
					'pro_url'  => 'https://www.phoeniixx.com/product/news-prime/',
					'priority' => 11,
					
				)
			)
		);
	}
 
	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function news_prime_enqueue_control_scripts() {

		wp_enqueue_script( 'news-prime-customize-controls', trailingslashit( get_template_directory_uri() ) . 'trt-customize-pro/premium/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'news-prime-customize-controls', trailingslashit( get_template_directory_uri() ) . 'trt-customize-pro/premium/customize-controls.css' );
	}
}

// Doing this customizer thang!
News_Prime_Customize::news_prime_get_instance();
