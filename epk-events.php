<?php
/**
 * Plugin Name: EPK Events
 * 
 * Description: This plugin handles all functionality for a custom Events slider.
 * Version: 1.0.0
 * Author: Beer City Bands
 * Author URI: https://beercitybands.com/
 * 
 * @link https://codex.wordpress.org/Plugin_API
 *
 * @since 1.0.0
 */

$cpt = 'event';

define( 'EPK_EVENTS_VERSION', '1.0.0' );
define( 'EPK_EVENTS_PATH', plugin_dir_path( __FILE__ ) );
define( 'EPK_EVENTS_URL', plugin_dir_url( __FILE__ ) );

// CPT
require_once EPK_EVENTS_PATH . "register-$cpt.php";

// ACF
require_once EPK_EVENTS_PATH . "acf-$cpt.php";

// Shortcode [epk_events] COMING SOON!
// require_once EPK_EVENTS_PATH . 'shortcode-epk_event.php';

if( ! function_exists( 'epk_events_enqueues' ) ) {
	function epk_events_enqueues() {
		/**
		 * Enqueue all Scripts & Styles
		 * 
		 * @since 1.0.0
		 * 
		 * @return void
		 */
		// enqueue Font Awesome
		$fa_version = '6.5.1';
		wp_enqueue_style( 'font-awesome-css', "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/$fa_version/css/all.min.css" );
	}
	add_action( 'wp_enqueue_scripts', 'epk_events_enqueues', 10, 1 );
}

if( ! function_exists( 'epk_events_admin_enqueues' ) ) {
	function epk_events_admin_enqueues() {
		/**
		 * Enqueue all Scripts & Styles for the Admin Editor
		 * 
		 * @since 1.0.0
		 * 
		 * @return void
		 */
		global $pagenow;

		if( $pagenow === 'post.php' && isset( $_GET['post'] ) ) {
			$post_id = $_GET['post'];
			$post_type = get_post_type( $post_id );

			if( $post_type === 'epk_event' ) {
				// enqueue admin.css
				wp_enqueue_style( 'epk-events-css-admin', EPK_EVENTS_URL . 'admin.css', null, EPK_EVENTS_VERSION );
			}
		}
	}
	add_action( 'admin_enqueue_scripts', 'epk_events_admin_enqueues', 10, 1 );
}
