
<?php

add_action('init', 'first_plugin_init');

 function first_plugin_init(){

    add_shortcode('test', 'first_plugin_my_shortcode');

 }

 function first_plugin_my_shortcode($atts , $content =''){

    $atts = shortcode_atts(array(
        'message'=> " Hello world!"
    ),$atts,'test');
 
    return $content;
 }


