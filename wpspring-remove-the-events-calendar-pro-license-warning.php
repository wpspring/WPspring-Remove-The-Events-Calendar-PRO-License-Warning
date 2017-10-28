<?php
/**
 * Plugin Name: WPspring Remove The Events Calendar PRO License Warning
 * Plugin URI: https://wpspring.com/
 * Description: This plugin removes the Events Calendar PRO license warning from the WP Admin header.
 * Version: 1.0.0
 * Author: WPspring
 * Author URI: https://wpspring.com
 * Requires at least: 3.0
 * Tested up to: 4.8.2
 *
 * @author WPspring
 */

if ( !class_exists('WPspring_Remove_Tribe_License_Warning') ) :

class WPspring_Remove_Tribe_License_Warning {

	public function __construct() {

		add_action( 'activated_plugin', array( $this, 'wpspring_remove_tribe_license_warning_activated_plugin_action' ) );

	}

 // http://stv.whtly.com/2011/09/03/forcing-a-wordpress-plugin-to-be-loaded-before-all-other-plugins/
	public function wpspring_remove_tribe_license_warning_activated_plugin_action() {

		if ( is_admin() ) {

			$path = str_replace( WP_PLUGIN_DIR . '/', '', __FILE__ );

			if ( $plugins = get_option( 'active_plugins' ) ) {

				if ( $key = array_search( $path, $plugins ) ) {

					array_splice( $plugins, $key, 1 );

					array_unshift( $plugins, $path );

					update_option( 'active_plugins', $plugins );

				}

			}

		}

		require_once( 'class-tribe-pue-checker.php' );

	}

}

$GLOBALS['wpspring_remove_tribe_license_warning'] = new WPspring_Remove_Tribe_License_Warning();

require_once( 'class-tribe-pue-checker.php' );

update_option( 'tribe_pue_key_notices', array() );

endif;
