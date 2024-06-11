<?php
    
/*

Main Theme function!
@package Zaibi-custom-theme


*/


function zaibi_cutom_theme_enque(){

wp_enqueue_style('style-css',get_stylesheet_uri() );
wp_enqueue_script('main-js', get_template_directory_uri().'/assets/main.js',[], true);


// Adding Boostrap in our theme

    // Enqueue Bootstrap Stylesheet


      wp_enqueue_style('bootstrap-css', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css');

    // Enqueue Bootstrap JS
      wp_enqueue_script('bootstrap-js', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js', array('jquery'), null, true);

}

add_action( 'wp_enqueue_scripts', 'zaibi_cutom_theme_enque' );

?>