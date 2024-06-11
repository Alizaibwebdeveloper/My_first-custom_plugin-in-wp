<?php
/**
 * Zaibi Custom Plugin 
 *
 * @package zaibi-custom-plugin
 * @author  Ali Zaib
 *
 * @wordpress-plugin
 * Plugin Name:       Zaibi Custom Plugin
 * Plugin URI:        https://codeytek.com/zaibi-custom-plugin/
 * Description:       Adds Gutenberg Blocks.
 * Version:           1.0.1
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Ali Zaib
 * Author URI:        https://codeytek.com/about/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       zaibi-custom-plugin
 * Domain Path:       /languages
 */

/**
 * Bootstrap the plugin.
 */
if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
    require_once __DIR__ . '/vendor/autoload.php';
}

require_once untrailingslashit( plugin_dir_path( __FILE__ ) ) . '/inc/custom-functions.php';

use zaibi_wp_custom\Plugin;

if ( class_exists( 'zaibi_wp_custom\Plugin' ) ) {
    $the_plugin = new Plugin();

    register_activation_hook( __FILE__, [ $the_plugin, 'activate' ] );
    register_deactivation_hook( __FILE__, [ $the_plugin, 'deactivate' ] );
}
