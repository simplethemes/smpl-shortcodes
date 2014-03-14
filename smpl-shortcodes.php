<?php
/*
Plugin Name: Simple Shortcodes
Description: This plugin works in conjuction with the SMPL framework to create shortcodes for many of the framework's internal elements.
Version: 1.0.6
Author: simplethemes
Author URI: http://www.simplethemes.com
License: GPL2

    Copyright 2013  Simple Themes

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License version 2,
    as published by the Free Software Foundation.

    You may NOT assume that you can use any other version of the GPL.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    The license for this software can likely be found here:
    http://www.gnu.org/licenses/gpl-2.0.html

*/

define( 'SMPL_SHORTCODES_PLUGIN_VERSION', '1.0.0' );
define( 'SMPL_SHORTCODES_PLUGIN_DIR', dirname( __FILE__ ) );
define( 'SMPL_SHORTCODES_PLUGIN_URI', plugins_url( '' , __FILE__ ) );

/**
 * Run Shortcodes
 *
 * @since 1.0.0
 */
function smpl_shortcodes_init() {

	global $_smpl_shortcode_generator;
	global $_smpl_shortcode_options;
	global $_smpl_disbale_css;


	if( is_admin() ) {

		// Add shortcode generator -- Can be disabled from WP > Settings > Writing
		if( get_option( 'smpl_shortcode_generator' ) != 'no' ) {
			include_once( SMPL_SHORTCODES_PLUGIN_DIR . '/includes/admin/generator/class-smpl-shortcode-generator.php' );
			$_smpl_shortcode_generator = new SMPL_Shortcode_Generator();
		}

		// Add shortcode options, Settings > Writing.
		include_once( SMPL_SHORTCODES_PLUGIN_DIR . '/includes/admin/options/class-smpl-shortcode-options.php' );
		$_smpl_shortcode_options = new SMPL_Shortcode_Options();

		// Add settings link on plugins page
		function smpl_shortcode_settings_link($links) {
		  $settings_link = '<a href="options-writing.php">Settings</a>';
		  array_unshift($links, $settings_link);
		  return $links;
		}

		$plugin = plugin_basename(__FILE__);
		add_filter("plugin_action_links_$plugin", 'smpl_shortcode_settings_link' );


	} else {

		// Include shortcodes
		include_once( SMPL_SHORTCODES_PLUGIN_DIR . '/includes/shortcodes.php' );

		// [raw] -- Can be disabled from WP > Settings > Writing
		if( get_option( 'smpl_raw' ) != 'no' ) {
			remove_filter( 'the_content', 'wptexturize' );
			remove_filter( 'the_content', 'wpautop' );
			remove_filter( 'the_content', 'shortcode_unautop' );
			add_filter( 'the_content', 'smpl_content_formatter', 99 ); // Before do_shortcode()
		}

		// Columns -- @todo clean this mess up, and create single [column] shortcode
		add_shortcode( 'one_sixth', 'smpl_shortcode_column' );			// 1/6
		add_shortcode( 'one_fourth', 'smpl_shortcode_column' );			// 1/4
		add_shortcode( 'one_third', 'smpl_shortcode_column' );			// 1/3
		add_shortcode( 'one_half', 'smpl_shortcode_column' );			// 1/2
		add_shortcode( 'two_third', 'smpl_shortcode_column' );			// 2/3
		add_shortcode( 'two_thirds', 'smpl_shortcode_column' );			// 2/3
		add_shortcode( 'three_fourth', 'smpl_shortcode_column' );		// 3/4
		add_shortcode( 'three_fourths', 'smpl_shortcode_column' );		// 3/4
		add_shortcode( 'one_fifth', 'smpl_shortcode_column' );			// 1/5
		add_shortcode( 'two_fifth', 'smpl_shortcode_column' );			// 2/5
		add_shortcode( 'two_fifths', 'smpl_shortcode_column' );			// 2/5
		add_shortcode( 'three_fifth', 'smpl_shortcode_column' );		// 3/5
		add_shortcode( 'three_fifths', 'smpl_shortcode_column' );		// 3/5
		add_shortcode( 'four_fifth', 'smpl_shortcode_column' );			// 4/5
		add_shortcode( 'four_fifths', 'smpl_shortcode_column' );		// 4/5
		add_shortcode( 'clear', 'smpl_shortcode_clear' );				// Clear row

		// Legacy Columns
		add_shortcode( 'one_sixth_last', 'smpl_shortcode_legacy_column_last' );			// 1/6
		add_shortcode( 'one_fourth_last', 'smpl_shortcode_legacy_column_last' );		// 1/4
		add_shortcode( 'one_third_last', 'smpl_shortcode_legacy_column_last' );			// 1/3
		add_shortcode( 'one_half_last', 'smpl_shortcode_legacy_column_last' );			// 1/2
		add_shortcode( 'two_third_last', 'smpl_shortcode_legacy_column_last' );			// 2/3
		add_shortcode( 'two_thirds_last', 'smpl_shortcode_legacy_column_last' );		// 2/3
		add_shortcode( 'three_fourth_last', 'smpl_shortcode_legacy_column_last' );		// 3/4
		add_shortcode( 'three_fourths_last', 'smpl_shortcode_legacy_column_last' );		// 3/4
		add_shortcode( 'one_fifth_last', 'smpl_shortcode_legacy_column_last' );			// 1/5
		add_shortcode( 'two_fifth_last', 'smpl_shortcode_legacy_column_last' );			// 2/5
		add_shortcode( 'two_fifths_last', 'smpl_shortcode_legacy_column_last' );		// 2/5
		add_shortcode( 'three_fifth_last', 'smpl_shortcode_legacy_column_last' );		// 3/5
		add_shortcode( 'three_fifths_last', 'smpl_shortcode_legacy_column_last' );		// 3/5
		add_shortcode( 'four_fifth_last', 'smpl_shortcode_legacy_column_last' );		// 4/5
		add_shortcode( 'four_fifths_last', 'smpl_shortcode_legacy_column_last' );		// 4/5

		// Components
		add_shortcode( 'button', 'smpl_shortcode_button' );
		add_shortcode( 'note', 'smpl_shortcode_alert' );
		add_shortcode( 'divider', 'smpl_shortcode_divider' );
		add_shortcode( 'clearline', 'smpl_shortcode_divider' );
		add_shortcode( 'clearfade', 'smpl_shortcode_clearfade' );
		add_shortcode( 'cta', 'smpl_shortcode_cta' );
		add_shortcode( 'callout', 'smpl_shortcode_callout' );


		// Inline Elements
		add_shortcode( 'blockquote', 'smpl_shortcode_blockquote' );
		add_shortcode( 'youtube', 'smpl_shortcode_youtube' );
		add_shortcode( 'vimeo', 'smpl_shortcode_vimeo' );


		// Tabs, Toggles, and Accordion
		add_shortcode( 'tabgroup', 'smpl_shortcode_tabgroup' );
		add_shortcode( 'tab', 'smpl_shortcode_tab' );
		add_shortcode( 'accordion', 'smpl_shortcode_accordion' );
		add_shortcode( 'toggle', 'smpl_shortcode_toggle' );


		// Display Posts
		add_shortcode( 'latest', 'smpl_shortcode_latest' );

	}

}
add_action( 'after_setup_theme', 'smpl_shortcodes_init' );

/**
 * Register text domain for localization.
 *
 * @since 1.0.0
 */
function smpl_shortcodes_textdomain() {
	load_plugin_textdomain( 'smpl_shortcodes', false, SMPL_SHORTCODES_PLUGIN_DIR . '/languages' );
}
add_action( 'plugins_loaded', 'smpl_shortcodes_textdomain' );

/**
 * Include Stylesheet
 *
 * @since 1.0.0
 */
function smpl_shortcodes_scripts() {
	if( get_option( 'smpl_disable_scripts' ) != 'no' ) {
    wp_enqueue_style('smpl_shortcodes', SMPL_SHORTCODES_PLUGIN_URI .'/assets/css/smpl-shortcodes.css');
    wp_enqueue_script('smpl_shortcodes', SMPL_SHORTCODES_PLUGIN_URI .'/assets/js/smpl-shortcodes.js',array('jquery'), true);
	}
}
add_action( 'wp_enqueue_scripts', 'smpl_shortcodes_scripts');
