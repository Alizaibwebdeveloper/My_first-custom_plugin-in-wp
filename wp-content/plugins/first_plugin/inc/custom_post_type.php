<?php

add_action('init','first_plugin_news_post');

function first_plugin_news_post(){

    register_post_type('news',array(

        'label'=> 'first_plugin_post',
        'labels'=> array(

        ),
        'public'=> true,
        'description'=> 'First plugin post type creation By Ali zaib (wordpress developer)',
         'supports'=> ['title','editor','comments','custom_fields', 'thumbnail']


    ));
}