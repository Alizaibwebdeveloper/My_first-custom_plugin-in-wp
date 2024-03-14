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

    register_taxonomy('news_categories', ['news'], array(
           'labels' => array(
            'name' => _x('News Categories', 'taxonomy general name'),
            'singular_name' => _x('News Category', 'taxonomy singular name'),
            'search_items' => __('Search News Categories'),
            'all_items' => __('All News Categories'),
            'parent_item' => __('Parent News Category'),
            'parent_item_colon' => __('Parent News Category:'),
            'edit_item' => __('Edit News Category'),
            'view_item' => __('View News Category'),
            'update_item' => __('Update News Category'),
            'add_new_item' => __('Add New Category'),
            'new_item_name' => __('New News Category Name'),
            'not_found' => __('No News Categories found.'),
            'no_items' => __('No News Categories'),
            'items_list_navigation' => __('News Categories Navigation List'),
            'items_list' => __('News Categories List'),
            'most_used' => _x('Most Used', 'categories'),
        ),
        'hierarchical' => true,
        'public' => true,
    ));
    
}