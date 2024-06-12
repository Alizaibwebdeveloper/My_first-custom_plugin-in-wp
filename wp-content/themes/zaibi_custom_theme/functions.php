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

// Hook the enqueue function to the appropriate action
add_action( 'wp_enqueue_scripts', 'zaibi_custom_theme_enqueue' );
