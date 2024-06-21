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
require_once AQUILA_DIR_PATH . '/inc/helpers/autoloader.php';

function zaibi_get_theme_instance() {
    return \ZAIBI_CUSTOM_THEME\Inc\ZAIBI_THEME::get_instance();
}

// Function to enqueue styles and scripts
function zaibi_custom_theme_enqueue() {
    // Enqueue main stylesheet
    wp_enqueue_style('style-css', get_stylesheet_uri());

    // Enqueue main JavaScript
    wp_enqueue_script('main-js', get_template_directory_uri() . '/assets/main.js', array(), null, true);

    // Enqueue Bootstrap Stylesheet
    wp_enqueue_style('bootstrap-css', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css', array(), '4.5.2');

    // Enqueue Bootstrap JS
    wp_enqueue_script('bootstrap-js', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js', array('jquery'), '4.5.2', true);
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

    add_theme_support('custom-background', [
        'default-color' => '0000ff',
        'default-image' => get_template_directory_uri() . '/images/wapuu.jpg',
    ]);

    // Add custom post thumbnail
    add_theme_support('post-thumbnails');

    // Add custom post customize-selective-refresh-widgets
    add_theme_support('customize-selective-refresh-widgets');

    // Add custom post automatic-feed-links
    add_theme_support('automatic-feed-links');

    // Add custom post Html5
    add_theme_support('html5', [
        'caption',
        'comment-form',
        'comment-list',
        'gallery',
        'search-form',
    ]);

    add_editor_style();

    // Add wp_block_style
    add_theme_support('wp_block_styles');

    // Add image_align _wide
    add_theme_support('align-wide');

    global $content_width;
    if (!isset($content_width)) {
        $content_width = 1240;
    }
}

// Hook the enqueue function to the appropriate action
add_action('wp_enqueue_scripts', 'zaibi_custom_theme_enqueue');
add_action('after_setup_theme', 'setup_theme');

// Creating and registering WordPress Dynamic Menu
function register_my_menus() {
    register_nav_menus([
        'zaibi_header-menu' => esc_html__('Header Menu', 'zaibi-custom-theme'),
        'zaibi_footer-menu' => esc_html__('Footer Menu', 'zaibi-custom-theme'),
    ]);
}
add_action('init', 'register_my_menus');

function get_menu_id($location) {
    // Get all the location
    $locations = get_nav_menu_locations();

    $menu_id = $locations[$location];

    return !empty($menu_id) ? $menu_id : '';
}

// Function to get child menu items
function get_child_menu_items($menu_array, $parent_id) {
    $child_menu_array = [];

    if (!empty($menu_array) && is_array($menu_array)) {
        foreach ($menu_array as $menu) {
            if (intval($menu->menu_item_parent) === $parent_id) {
                $child_menu_array[] = $menu;
            }
        }
    }

    return $child_menu_array;
}

// Code for registered Metaboxes
/**
 * Register custom meta boxes.
 */
function zaibi_custom_theme_register_meta_boxes() {
    $screens = ['post']; // Add your custom post types here
    foreach ($screens as $screen) {
        add_meta_box(
            'hide_page_title',                        
            __('Hide Page Title', 'zaibi-custom-theme'), 
            'zaibi_custom_meta_box_html',             
            $screen,                                 
            'side'                               
        );
    }
}
add_action('add_meta_boxes', 'zaibi_custom_theme_register_meta_boxes');

/**
 * Meta box HTML content.
 *
 * @param WP_Post $post The post object.
 */
/**
 * Meta box HTML content.
 *
 * @param WP_Post $post The post object.
 */
function zaibi_custom_meta_box_html($post) {
    // Nonce field for security
    wp_nonce_field('zaibi_hide_title_nonce_action', 'zaibi_hide_title_nonce');

    // Get the current value of the custom field
    $value = get_post_meta($post->ID, 'hide_page_title', true);
    ?>
    <p>
        <label for="zaibi_hide_title_field">
            <?php esc_html_e('Hide the page title', 'zaibi-custom-theme'); ?>
        </label>
    </p>
    <p>
        <select name="zaibi_hide_title_field" id="zaibi_hide_title_field" class="postbox">
            <option value=""><?php esc_html_e('Select', 'zaibi-custom-theme'); ?></option>
            <option value="yes" <?php selected($value, 'yes'); ?>><?php esc_html_e('Yes', 'zaibi-custom-theme'); ?></option>
            <option value="no" <?php selected($value, 'no'); ?>><?php esc_html_e('No', 'zaibi-custom-theme'); ?></option>
        </select>
    </p>
    <?php
}


/**
 * Save the meta box data.
 *
 * @param int $post_id The post ID.
 */
/**
 * Save the meta box data.
 *
 * @param int $post_id The post ID.
 */
function zaibi_save_post_meta_data($post_id) {
    // Check nonce for security
    if (!isset($_POST['zaibi_hide_title_nonce']) || !wp_verify_nonce($_POST['zaibi_hide_title_nonce'], 'zaibi_hide_title_nonce_action')) {
        return;
    }

    // Check if the user has permissions to save data
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Save or delete the meta value
    if (isset($_POST['zaibi_hide_title_field'])) {
        update_post_meta(
            $post_id,
            'hide_page_title',
            sanitize_text_field($_POST['zaibi_hide_title_field'])
        );
    } else {
        delete_post_meta($post_id, 'hide_page_title');
    }
}
add_action('save_post', 'zaibi_save_post_meta_data');


// function for getting a post meta date posted on 



function zaibi_custom_posted_on(){


    $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
    if (get_the_time('U')!== get_the_modified_time('U')) {
        $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
    }

    $time_string = sprintf(
        $time_string,
        esc_attr(get_the_date('c')),
        esc_html(get_the_date()),
        esc_attr(get_the_modified_date('c')),
        esc_html(get_the_modified_date())
    );

    $posted_on = sprintf(
        /* translators: %s: post date. */
        esc_html_x('Posted on %s', 'post date', 'zaibi-custom-theme'),
        '<a href="'. esc_url(get_permalink()). '" rel="bookmark">'. $time_string. '</a>'
    );

    echo '<span "posted_one text_secondary">'.$posted_on.'</span>';
}

//  function  for getmeta Data of custom post type Author

function zaibi_custom_posted_by() {
    // Fetch the author details
    $author_id = get_the_author_meta('ID');
    $author_name = get_the_author_meta('display_name');
    $author_url = get_the_author_meta('user_url');
    $author_description = get_the_author_meta('description');
    $author_avatar = get_avatar($author_id, 100);
    $author_link = get_author_posts_url($author_id);
    
    // Generate the author link
    $author_link = '<a href="'. esc_url($author_link) .'">'. esc_html($author_name) .'</a>';

    // Display the author information
    echo '<div class="posted-by">';
    echo $author_avatar; // Display the author avatar
    echo '<div class="author-details">';
    echo '<p class="author-name">by ' . $author_link .'</p>'; // Display the author name with a link to their posts
    if ($author_description) {
        echo '<p class="author-description">'. esc_html($author_description) .'</p>'; // Display the author description if available
    }
    echo '</div>';
    echo '</div>';
}




