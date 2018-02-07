<?php
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Anaglyh
 * @version    2.4.0
 * @author     Thomas Griffin <thomasgriffinmedia.com>
 * @author     Gary Jones <gamajo.com>
 * @copyright  Copyright (c) 2014, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/thomasgriffin/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once get_template_directory() . '/inc/libs/tgm/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'news_prime_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function news_prime_register_required_plugins(){
	$plugins = array(
      
		array( 
            'name'      => 'Ultimate Addons for SiteOrigin',
            'slug'      => 'addon-so-widgets-bundle',
            'required'  => false
        ),
		
		array( 
            'name'      => 'Widgets for SiteOrigin',
            'slug'      => 'widgets-for-siteorigin',
            'required'  => false
        ),
		
		array( 
            'name'      => 'Page Builder by SiteOrigin',
            'slug'      => 'siteorigin-panels',
            'required'  => false
        ),
		
		array( 
            'name'      => 'SiteOrigin Widgets Bundle',
            'slug'      => 'so-widgets-bundle',
            'required'  => false
        )

    );

    $config = array(
        'id'           => 'tgm_news_prime_pro',		// Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                   // Default absolute path to pre-packaged plugins.
        'menu'         		=> 'tgm-news-prime-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
        'strings'      => array(
            'page_title'                      => __( 'Install Required Plugins', 'news-prime' ),
            'menu_title'                      => __( 'Install Plugins', 'news-prime' ),
            'installing'                      => __( 'Installing Plugin: %s', 'news-prime' ), // %s = plugin name.
            'oops'                            => __( 'Something went wrong with the plugin API.', 'news-prime' ),
            'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'news-prime' ), // %1$s = plugin name(s).
            'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'news-prime' ), // %1$s = plugin name(s).
            'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'news-prime' ), // %1$s = plugin name(s).
            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'news-prime' ), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'news-prime' ), // %1$s = plugin name(s).
            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'news-prime' ), // %1$s = plugin name(s).
            'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'news-prime' ), // %1$s = plugin name(s).
            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'news-prime' ), // %1$s = plugin name(s).
            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'news-prime' ),
            'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'news-prime' ),
            'return'                          => __( 'Return to Required Plugins Installer', 'news-prime' ),
            'plugin_activated'                => __( 'Plugin activated successfully.', 'news-prime' ),
            'complete'                        => __( 'All plugins installed and activated successfully. %s', 'news-prime' ), // %s = dashboard link.
            'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        )
    );

    tgmpa( $plugins, $config );

}