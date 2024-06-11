<?php

/*
* Plugin Name:       Like and Dislike Post Plugin
* Plugin URI:        https://example.com/plugins/likes_dislikes-plugin/
* Description:       You can Like and Dislike any post as your requirements or according to your specification
* Version:           1.10.3
* Requires at least: 5.2
* Requires PHP:      7.2
* Author:            Ali zaib(Wordpress developer)
* Author URI:        https://author.example.com/
* License:           GPL v2 or later
* License URI:       https://www.org/licenses/gpl-2.0.html
* Update URI:        https://example.com/likes_dislikes-plugin/
* Text Domain:       likes_dislikes-plugin 
* Domain Path:       /languages
*/

defined('ABSPATH') || die("Sorry You cannot Access this folder Directerly");

define('PLUGIN_PATH', plugin_dir_path(__FILE__));
define('PLUGIN_URL', plugin_dir_url(__FILE__));
define('PLUGIN_FILE', __FILE__);
define('TABLE_NAME', 'likesdislikes');

class likedislikes {

    private static $instance = null;

    public static function instance() {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct() {
        // Initialize the plugin by hooking into the_content filter
        add_filter('the_content', array($this, 'add_likes_dislikes'));
    }

    public function add_likes_dislikes($content) {
        if (is_user_logged_in()) {
            // If logged in, add like and dislike buttons to the content
            $description = "
            <ul>
            <li><a href='#'>Like</a></li>
            <li><a href='#'>Dislike</a></li>
            </ul>
            ";
            // Append the buttons to the content
            return $content . $description;
        }
        // If user is not logged in, return the original content
        return $content;
    }
    

}

// Initialize the plugin
likedislikes::instance();
