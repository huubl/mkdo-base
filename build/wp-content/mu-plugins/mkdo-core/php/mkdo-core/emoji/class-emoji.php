<?php
/**
 * Emoji
 *
 * @since 1.0.0
 *
 * @package MKDO_Core
 */

namespace MKDO_Core;

/**
 * Functions relating to Emoji
 */
class Emoji {

	/**
	 * Go.
	 *
	 * @since 1.0.0
	 */
	public function run() {

		// Settings check.
		$do_run = apply_filters( MKDO_CORE_PREFIX . '_remove_emoji', true );
		if ( ! $do_run ) {
			return;
		}

		add_action( 'init', array( $this, 'mkdo_core_disable_emoji' ) );
	}

	/**
	 *  Disable WP Emoji
	 */
	public function mkdo_core_disable_emoji() {

		// Remove emoji scripts.
		remove_action( 'admin_print_styles', 'print_emoji_styles' );
		remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );

		// Remove emoji styles.
		remove_action( 'wp_print_styles', 'print_emoji_styles' );

		// Remove emoji from email.
		remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );

		// Remove emoji from feeds.
		remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
		remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

		// Remove TinyMCE emojis.
		add_filter( 'tiny_mce_plugins', array( $this, 'mkdo_core_disable_emoji_tinymce' ) );
	}

	/**
	 * Remove TinyMCE Emoji
	 *
	 * @param array $plugins Array of TinyMCE plugins.
	 * @return array         The modified plugin array.
	 */
	public function mkdo_core_disable_emoji_tinymce( $plugins ) {

		// Make sure that the array is an array.
		if ( ! is_array( $plugins ) ) {
			$plugins = array();
		}

		// Remove the emoji plugin from the array.
		return array_diff( $plugins, array( 'wpemoji' ) );
	}
}
