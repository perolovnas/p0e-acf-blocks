<?php
/**
 * Plugin Name:       p0e ACF Custom Blocks
 * Description:       Collection of ACF blocks
 * Requires at least: 6.1
 * Requires PHP:      7.0
 * Version:           0.1.1
 * Author:            Per Olov Näs
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       example-p0e-acf-block
 *
 * @package           p0e
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Registers the block's assets for the editor and the frontend.
 *
 * @see https://developer.wordpress.org/block-editor/developers/block-api/block-edit-save/#editor-scripts
 */
function register_styles_and_scripts() {
	wp_register_script( 'mixitup', plugin_dir_url( __FILE__ ) . '/blocks/post-documents/mixitup.min.js', true );
	wp_register_script( 'mixitup_multi', plugin_dir_url( __FILE__ ) . '/blocks/post-documents/mixitup-multifilter.min.js', true );
	wp_register_script( 'wp-block-acf-post-documents', plugin_dir_url( __FILE__ ) . '/blocks/post-documents/script.js', filemtime( plugin_dir_path( __FILE__ ) . '/blocks/header/script.js' ), true );
}
add_action( 'wp_enqueue_scripts', 'register_styles_and_scripts' );
add_action( 'admin_enqueue_scripts', 'register_styles_and_scripts' );


/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function oas_acf_blocks() {
	register_block_type( __DIR__ . '/blocks/header' );
	register_block_type( __DIR__ . '/blocks/post-documents' );
	register_block_type( __DIR__ . '/blocks/post-loop' );
}
add_action( 'init', 'oas_acf_blocks' );
