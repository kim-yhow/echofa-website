<?php
/**
 * Cambium Theme Customizer
 *
 * @package Cambium
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function cambium_customize_register ( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'background_color' )->transport = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	/**
	 * Theme Options Panel
	 */
	$wp_customize->add_panel( 'cambium_theme_options', array(
	    'title'     => esc_html__( 'Theme Options', 'cambium' ),
	    'priority'  => 1,
	) );

	/**
	 * General Options Section
	 */
	$wp_customize->add_section( 'cambium_general_options', array (
		'title'     => esc_html__( 'General Options', 'cambium' ),
		'panel'     => 'cambium_theme_options',
		'priority'  => 10,
		'description' => esc_html__( 'Personalize the settings of your theme.', 'cambium' ),
	) );

	// Featured Image Size
	$wp_customize->add_setting ( 'cambium_featured_image_size', array (
		'default'           => cambium_default( 'cambium_featured_image_size' ),
		'sanitize_callback' => 'cambium_sanitize_select',
	) );

	$wp_customize->add_control ( 'cambium_featured_image_size', array (
		'label'    => esc_html__( 'Featured Image Size', 'cambium' ),
		'section'  => 'cambium_general_options',
		'priority' => 1,
		'type'     => 'select',
		'choices'  => array(
			'square'    => esc_html__( 'Square',    'cambium'),
			'landscape' => esc_html__( 'Landscape', 'cambium'),
			'portrait'  => esc_html__( 'Portrait',  'cambium'),
		),
	) );

	// Main Sidebar Position
	$wp_customize->add_setting ( 'cambium_sidebar_position', array (
		'default'           => cambium_default( 'cambium_sidebar_position' ),
		'sanitize_callback' => 'cambium_sanitize_select',
	) );

	$wp_customize->add_control ( 'cambium_sidebar_position', array (
		'label'    => esc_html__( 'Main Sidebar Position (if active)', 'cambium' ),
		'section'  => 'cambium_general_options',
		'priority' => 2,
		'type'     => 'select',
		'choices'  => array(
			'right' => esc_html__( 'Right', 'cambium'),
			'left'  => esc_html__( 'Left',  'cambium'),
		),
	) );

	// Fullwidth Archive Control
	$wp_customize->add_setting ( 'cambium_fullwidth_archive', array (
		'default'           => cambium_default( 'cambium_fullwidth_archive' ),
		'sanitize_callback' => 'cambium_sanitize_checkbox',
	) );

	$wp_customize->add_control ( 'cambium_fullwidth_archive', array (
		'label'    => esc_html__( 'Display Archives at Fullwidth', 'cambium' ),
		'section'  => 'cambium_general_options',
		'priority' => 3,
		'type'     => 'checkbox',
	) );

	/**
	 * Footer Section
	 */
	$wp_customize->add_section( 'cambium_footer_options', array (
		'title'       => esc_html__( 'Footer Options', 'cambium' ),
		'panel'       => 'cambium_theme_options',
		'priority'    => 20,
		'description' => esc_html__( 'Personalize the footer settings of your theme.', 'cambium' ),
	) );

	// Copyright Control
	$wp_customize->add_setting ( 'cambium_copyright', array (
		'default'           => cambium_default( 'cambium_copyright' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'wp_kses_post',
	) );

	$wp_customize->add_control ( 'cambium_copyright', array (
		'label'    => esc_html__( 'Copyright', 'cambium' ),
		'section'  => 'cambium_footer_options',
		'priority' => 1,
		'type'     => 'textarea',
	) );

	// Credit Control
	$wp_customize->add_setting ( 'cambium_credit', array (
		'default'           => cambium_default( 'cambium_credit' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'cambium_sanitize_checkbox',
	) );

	$wp_customize->add_control ( 'cambium_credit', array (
		'label'    => esc_html__( 'Display Designer Credit', 'cambium' ),
		'section'  => 'cambium_footer_options',
		'priority' => 2,
		'type'     => 'checkbox',
	) );

	// Support Section
	$wp_customize->add_section( 'cambium_support_options', array(
		'title'       => esc_html__( 'Support Options', 'cambium' ),
		'description' => esc_html__( 'Thanks for your interest in Cambium! If you have any questions or run into any trouble, please visit us the following links. We will get you fixed up!', 'cambium' ),
		'panel'       => 'cambium_theme_options',
		'priority'    => 30,
	) );

	// Theme Support
	$wp_customize->add_setting ( 'cambium_theme_support', array(
		'default' => '',
	) );

	$wp_customize->add_control(
		new Cambium_Button_Control(
			$wp_customize,
			'cambium_theme_support',
			array(
				'label'         => esc_html__( 'Cambium Support', 'cambium' ),
				'section'       => 'cambium_support_options',
				'priority'      => 1,
				'type'          => 'cambium-button',
				'button_tag'    => 'a',
				'button_class'  => 'button button-primary',
				'button_href'   => 'https://bestblogthemes.com/contact/',
				'button_target' => '_blank',
			)
		)
	);

	// Theme Review Section
	$wp_customize->add_section( 'cambium_review_options', array(
		'title'       => esc_html__( 'Enjoying the theme?', 'cambium' ),
		'description' => esc_html__( 'Why not leave us a review on WordPress.org? We\'d really appreciate it!', 'cambium' ),
		'panel'       => 'cambium_theme_options',
		'priority'    => 40,
	) );

	// Theme
	$wp_customize->add_setting ( 'cambium_theme_review', array(
		'default' => '',
	) );

	$wp_customize->add_control(
		new Cambium_Button_Control(
			$wp_customize,
			'cambium_theme_review',
			array(
				'label'         => esc_html__( 'Review on WordPress.org', 'cambium' ),
				'section'       => 'cambium_review_options',
				'type'          => 'cambium-button',
				'button_tag'    => 'a',
				'button_class'  => 'button button-primary',
				'button_href'   => 'https://wordpress.org/support/theme/cambium/reviews',
				'button_target' => '_blank',
			)
		)
	);
}
add_action( 'customize_register', 'cambium_customize_register' );

/**
 * Button Control Class
 */
if ( class_exists( 'WP_Customize_Control' ) ) {

	class Cambium_Button_Control extends WP_Customize_Control {
		/**
		 * @access public
		 * @var string
		 */
		public $type = 'cambium-button';

		/**
		 * HTML tag to render button object.
		 *
		 * @var  string
		 */
		protected $button_tag = 'button';

		/**
		 * Class to render button object.
		 *
		 * @var  string
		 */
		protected $button_class = 'button button-primary';

		/**
		 * Link for <a> based button.
		 *
		 * @var  string
		 */
		protected $button_href = 'javascript:void(0)';

		/**
		 * Target for <a> based button.
		 *
		 * @var  string
		 */
		protected $button_target = '';

		/**
		 * Click event handler.
		 *
		 * @var  string
		 */
		protected $button_onclick = '';

		/**
		 * ID attribute for HTML tab.
		 *
		 * @var  string
		 */
		protected $button_tag_id = '';

		/**
		 * Render the control's content.
		 */
		public function render_content() {
		?>
			<span class="center">
				<?php
				// Print open tag
				echo '<' . esc_html( $this->button_tag );

				// button class
				if ( ! empty( $this->button_class ) ) {
					echo ' class="' . esc_attr( $this->button_class ) . '"';
				}

				// button or href
				if ( 'button' == $this->button_tag ) {
					echo ' type="button"';
				} else {
					echo ' href="' . esc_url( $this->button_href ) . '"' . ( empty( $this->button_tag ) ? '' : ' target="' . esc_attr( $this->button_target ) . '"' );
				}

				// onClick Event
				if ( ! empty( $this->button_onclick ) ) {
					echo ' onclick="' . esc_js( $this->button_onclick ) . '"';
				}

				// ID
				if ( ! empty( $this->button_tag_id ) ) {
					echo ' id="' . esc_attr( $this->button_tag_id ) . '"';
				}

				echo '>';

				// Print text inside tag
				echo esc_html( $this->label );

				// Print close tag
				echo '</' . esc_html( $this->button_tag ) . '>';
				?>
			</span>
		<?php
		}
	}

}

/**
 * Sanitize Select.
 *
 * @param string $input Slug to sanitize.
 * @param WP_Customize_Setting $setting Setting instance.
 * @return string Sanitized slug if it is a valid choice; otherwise, the setting default.
 */
function cambium_sanitize_select( $input, $setting ) {

	// Ensure input is a slug.
	$input = sanitize_key( $input );

	// Get list of choices from the control associated with the setting.
	$choices = $setting->manager->get_control( $setting->id )->choices;

	// If the input is a valid key, return it; otherwise, return the default.
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

/**
 * Sanitize the checkbox.
 *
 * @param bool $checked Whether the checkbox is checked.
 * @return bool Whether the checkbox is checked.
 */
function cambium_sanitize_checkbox( $checked ) {
	return ( ( isset( $checked ) && true === $checked ) ? true : false );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function cambium_customize_preview_js() {
	wp_enqueue_script( 'cambium_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20140120', true );
}
add_action( 'customize_preview_init', 'cambium_customize_preview_js' );
