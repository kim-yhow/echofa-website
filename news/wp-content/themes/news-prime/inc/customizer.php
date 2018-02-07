<?php
/**
 * News Prime Theme Customizer.
 *
 * @package News Prime
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
 

function news_prime_customize_register( $wp_customize ) {


	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	
	// header option
	$wp_customize->add_section("home_page_set", array(
		"title" => __("Header Section", "news-prime"),
		"priority" => 29,
	));
	
			
			// for date on off option
			$wp_customize->add_setting("news_prime_header_date", array(
				"default" => 'off',
				"transport" => "refresh",
				'sanitize_callback' => 'news_prime_radio_sanitize_row',
			));
			$wp_customize->add_control(new WP_Customize_Control(
				$wp_customize,
				"news_prime_header_date",
				array(
				'type' => 'radio',
				'label' => __("Date On/Off", "news-prime"),
				'section' => 'home_page_set',
				'choices' => array(
					'on' => 'On',
					'off' => 'Off',
				),
			)
			));
					
			
			// for facebook icons on off option
			$wp_customize->add_setting("news_prime_social_fb_sec_on_off", array(
				"default" => 'off',
				"transport" => "refresh",
				'sanitize_callback' => 'news_prime_radio_sanitize_row',
			));
			$wp_customize->add_control(new WP_Customize_Control(
				$wp_customize,
				"news_prime_social_fb_sec_on_off",
				array(
				'type' => 'radio',
				'label' => __("Facebook Icon On/Off", "news-prime"),
				'section' => 'home_page_set',
				'choices' => array(
					'on' => 'On',
					'off' => 'Off',
				),
			)
			));
			
			// for social site link options
			// for facebook link
			$wp_customize->add_setting("news_prime_social_fb_btn_lnk", array(
				"default" => '',
				"transport" => "refresh",
				'sanitize_callback' => 'esc_url_raw',
			));
			$wp_customize->add_control(new WP_Customize_Control(
			$wp_customize,
			"news_prime_social_fb_btn_lnk",
			array(
					"label" => __("Facebook Button Link", "news-prime"),
					"section" => "home_page_set",
					"settings" => "news_prime_social_fb_btn_lnk",
					"type" => "url",
				)
			));
			
			// for twitter icons on off option
			$wp_customize->add_setting("news_prime_social_twitter_sec_on_off", array(
				"default" => 'off',
				"transport" => "refresh",
				'sanitize_callback' => 'news_prime_radio_sanitize_row',
			));
			$wp_customize->add_control(new WP_Customize_Control(
				$wp_customize,
				"news_prime_social_twitter_sec_on_off",
				array(
				'type' => 'radio',
				'label' => __("Twitter Icon On/Off", "news-prime"),
				'section' => 'home_page_set',
				'choices' => array(
					'on' => 'On',
					'off' => 'Off',
				),
			)
			));
		
			// for twitter link
			$wp_customize->add_setting("news_prime_social_twitter_btn_lnk", array(
				"default" => '',
				"transport" => "refresh",
				'sanitize_callback' => 'esc_url_raw',
			));
			$wp_customize->add_control(new WP_Customize_Control(
			$wp_customize,
			"news_prime_social_twitter_btn_lnk",
			array(
					"label" => __("Twitter Button Link", "news-prime"),
					"section" => "home_page_set",
					"settings" => "news_prime_social_twitter_btn_lnk",
					"type" => "url",
					)
			));
			
			// for linkedin icons on off option
			$wp_customize->add_setting("news_prime_social_linkedin_sec_on_off", array(
				"default" => 'off',
				"transport" => "refresh",
				'sanitize_callback' => 'news_prime_radio_sanitize_row',
			));
			$wp_customize->add_control(new WP_Customize_Control(
				$wp_customize,
				"news_prime_social_linkedin_sec_on_off",
				array(
				'type' => 'radio',
				'label' => __("Linkedin Icon On/Off", "news-prime"),
				'section' => 'home_page_set',
				'choices' => array(
					'on' => 'On',
					'off' => 'Off',
				),
			)
			));
			
			// for linkedin link
			$wp_customize->add_setting("news_prime_social_linkedin_btn_lnk", array(
				"default" => '',
				"transport" => "refresh",
				'sanitize_callback' => 'esc_url_raw',
			));
			$wp_customize->add_control(new WP_Customize_Control(
			$wp_customize,
			"news_prime_social_linkedin_btn_lnk",
			array(
					"label" => __("Linkedin Button Link", "news-prime"),
					"section" => "home_page_set",
					"settings" => "news_prime_social_linkedin_btn_lnk",
					"type" => "url",
					)
			));
			
			// for google icons on off option
			$wp_customize->add_setting("news_prime_social_google_sec_on_off", array(
				"default" => 'off',
				"transport" => "refresh",
				'sanitize_callback' => 'news_prime_radio_sanitize_row',
			));
			$wp_customize->add_control(new WP_Customize_Control(
				$wp_customize,
				"news_prime_social_google_sec_on_off",
				array(
				'type' => 'radio',
				'label' => __("Google Plus Icon On/Off", "news-prime"),
				'section' => 'home_page_set',
				'choices' => array(
					'on' => 'On',
					'off' => 'Off',
				),
			)
			));
			
			// for google link
			$wp_customize->add_setting("news_prime_social_google_btn_lnk", array(
				"default" => '',
				"transport" => "refresh",
				'sanitize_callback' => 'esc_url_raw',
			));
			$wp_customize->add_control(new WP_Customize_Control(
			$wp_customize,
			"news_prime_social_google_btn_lnk",
			array(
					"label" => __("Google Plus Button Link", "news-prime"),
					"section" => "home_page_set",
					"settings" => "news_prime_social_google_btn_lnk",
					"type" => "url",
					)
			));
			
			// for rss icons on off option
			$wp_customize->add_setting("news_prime_social_rss_sec_on_off", array(
				"default" => 'off',
				"transport" => "refresh",
				'sanitize_callback' => 'news_prime_radio_sanitize_row',
			));
			$wp_customize->add_control(new WP_Customize_Control(
				$wp_customize,
				"news_prime_social_rss_sec_on_off",
				array(
				'type' => 'radio',
				'label' => __("RSS Icon On/Off", "news-prime"),
				'section' => 'home_page_set',
				'choices' => array(
					'on' => 'On',
					'off' => 'Off',
				),
			)
			));
			
			// for rss feed link
			$wp_customize->add_setting("news_prime_social_rssfeed_btn_lnk", array(
				"default" => '',
				"transport" => "refresh",
				'sanitize_callback' => 'esc_url_raw',
			));
			$wp_customize->add_control(new WP_Customize_Control(
			$wp_customize,
			"news_prime_social_rssfeed_btn_lnk",
			array(
					"label" => __("RSS Feed Button Link", "news-prime"),
					"section" => "home_page_set",
					"settings" => "news_prime_social_rssfeed_btn_lnk",
					"type" => "url",
					)
			));
			
			
			// for advertisement on off option
			$wp_customize->add_setting("news_prime_header_advs", array(
				"default" => 'off',
				"transport" => "refresh",
				'sanitize_callback' => 'news_prime_radio_sanitize_row',
			));
			$wp_customize->add_control(new WP_Customize_Control(
				$wp_customize,
				"news_prime_header_advs",
				array(
				'type' => 'radio',
				'label' => __("Advertisement On/Off", "news-prime"),
				'section' => 'home_page_set',
				'choices' => array(
					'on' => 'On',
					'off' => 'Off',
				),
			)
			));
			
			// for advertisement image
			$wp_customize->add_setting("news_prime_header_advs_img", array(
				"default" => "",
				"transport" => "refresh",
				'sanitize_callback' => 'esc_url_raw'
			));
			$wp_customize->add_control(new WP_Customize_Image_Control(
				$wp_customize,
				"news_prime_header_advs_img",
				array(
					"label" => __("Advertisement Image", "news-prime"),
					"section" => "home_page_set",
					"settings" => "news_prime_header_advs_img",
					
				)
			));
			
			// for rss feed link
			$wp_customize->add_setting("news_prime_header_advs_link", array(
				"default" => '',
				"transport" => "refresh",
				'sanitize_callback' => 'esc_url_raw',
			));
			$wp_customize->add_control(new WP_Customize_Control(
			$wp_customize,
			"news_prime_header_advs_link",
			array(
					"label" => __("Advertisement Image Link", "news-prime"),
					"section" => "home_page_set",
					"settings" => "news_prime_header_advs_link",
					"type" => "url",
					)
			));
			
			//Footer text 
		$wp_customize->add_section("footer_sec", array(
			"title" => __("Footer Text", "news-prime"),
			"priority" => 35,
		));
				
				// for copyright text
				$wp_customize->add_setting("News_Prime_copyright_text", array(
					"default" => '',
					"transport" => "refresh",
					'sanitize_callback' => 'news_prime_text_sanitize'
				));
				$wp_customize->add_control(new WP_Customize_Control(
					$wp_customize,
					"News_Prime_copyright_text",
					array(
						"label" => __("Footer Text", "news-prime"),
						"section" => "footer_sec",
						"settings" => "News_Prime_copyright_text",
						
					)
				));
		
}
add_action( 'customize_register', 'news_prime_customize_register' );

// sanitize_callback function
function news_prime_text_sanitize( $input ) {
	return wp_kses_post( force_balance_tags( $input ) );
}


function news_prime_radio_sanitize_row($input) {
  $valid_keys = array(
		'on' => 'On',
		'off' => 'Off',
  );
  if ( array_key_exists( $input, $valid_keys ) ) {
	 return $input;
  } else {
	 return '';
  }
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function news_prime_customize_preview_js() {
	wp_enqueue_script( 'News_Prime_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'news_prime_customize_preview_js' );