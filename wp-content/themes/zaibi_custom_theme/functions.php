<?php
/**
 * Main Theme functions
 *
 * @package Zaibi-custom-theme
 */

// Ensure the constant is defined

if (!defined('AQUILA_DIR_PATH')) {
    define('AQUILA_DIR_PATH', untrailingslashit(get_template_directory()));
}

// Include the autoloader


require_once AQUILA_DIR_PATH.'/inc/helpers/autoloader.php';

function zaibi_get_theme_instace(){

    return \ZAIBI_CUSTOM_THEME\Inc\ZAIBI_THEME::get_instance();
}

// Function to enqueue styles and scripts
function zaibi_custom_theme_enqueue() {
    // Enqueue main stylesheet
    wp_enqueue_style( 'style-css', get_stylesheet_uri() );

    // Enqueue main JavaScript
    wp_enqueue_script( 'main-js', get_template_directory_uri() . '/assets/main.js', array(), null, true );

    // Enqueue Bootstrap Stylesheet
    wp_enqueue_style( 'bootstrap-css', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css', array(), '4.5.2' );

    // Enqueue Bootstrap JS
    wp_enqueue_script( 'bootstrap-js', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js', array( 'jquery' ), '4.5.2', true );
}


 function setup_theme() {


    add_theme_support('title-tag');

    // Add support for a custom logo with the specified dimensions and options.
    add_theme_support('custom-logo', [
        'height'      => 250,
        'width'       => 250,
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => ['site-title', 'site-description'],
    ]);

    add_theme_support( 'custom-background',[

        'default-color' => '0000ff',
        'default-image' => get_template_directory_uri() . '/images/wapuu.jpg',
    ] );

    // Add custom post thumbnail

    add_theme_support( 'post-thumbnails' );


    // Add custom post customize-selective-refresh-widgets


    add_theme_support('customize-selective-refresh-widgets');

   // Add custom post automatic-feed-links

   add_theme_support('automatic-feed-links');

    // Add custom post Html5

    add_theme_support( 'html5', [
        'caption',
        'comment-form',
        'comment-list',
        'gallery',
       'search-form',
    ] );

    add_editor_style();

    // Add wp_block_style

    add_theme_support( 'wp_block_styles' );

    // Add image_align _wide

    add_theme_support('align-wide');

    global $content_width;
    if (! isset( $content_width ) ) {
        $content_width = 640;
    }


}


// Hook the enqueue function to the appropriate action
add_action( 'wp_enqueue_scripts', 'zaibi_custom_theme_enqueue' );
add_action( 'after_setup_theme', 'setup_theme' );

