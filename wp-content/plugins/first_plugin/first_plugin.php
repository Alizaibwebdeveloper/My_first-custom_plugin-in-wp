<?php
/*
 * Plugin Name:       My First Plugin
 * Plugin URI:        https://example.com/plugins/first_plugin/
 * Description:       Handle the basics with this plugin.
 * Version:           1.10.3
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Ali zaib(Wordpress developer)
 * Author URI:        https://author.example.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://example.com/my-plugin/
 * Text Domain:       first-plugin 
 * Domain Path:       /languages
 */

 

 defined('ABSPATH') || die("Sorry You cannot Access this folder Directerly");

define('PLUGIN_PATH',plugin_dir_path(__FILE__));
define('PLUGIN_URL',plugin_dir_url(__FILE__));
define('PLUGIN_FILE',__FILE__);

 
  include plugin_dir_path(__FILE__) . 'first_plugin_shorcode.php';
  include plugin_dir_path(__FILE__) . 'inc/metaboxes.php';
  include plugin_dir_path(__FILE__) . 'inc/custom_post_type.php';
  include plugin_dir_path(__FILE__) . 'inc/ajax.php';
  include plugin_dir_path(__FILE__) . 'inc/db.php';



 add_filter('the_title', 'first_plugin_the_title');

 function first_plugin_the_title($title){

  return $title;

 }

 add_action('wp_enqueue_scripts', 'first_plugin_wp_enqueue_scripts');
 add_action('wp_admin_enqueue_script','first_plugin_wp_enqueue_scripts');

function first_plugin_wp_enqueue_scripts() {
    wp_enqueue_script('jquery');
    wp_enqueue_style('first_plugin', plugin_dir_url(__FILE__) . "assets/css/style.css");
    wp_enqueue_script('first_plugin_script', plugin_dir_url(__FILE__) . "assets/js/custom.js", array(), '1.0.0', true);
    // wp_localize_script()
}

function first_plugin_admin_wp_enqueue_scripts(){

    wp_enqueue_script('first_plugin_script', plugin_dir_url(__FILE__) . "assets/js/custom.js", array(), '1.0.0', true);

}


add_action('admin_menu', 'first_plugin_menu');
add_action('admin_menu', 'first_plugin_process_for_setting');

function first_plugin_menu() {
    add_menu_page(
        'First Plugin Option',
        'First Plugin Option',
        'manage_options',
        'first_plugin_option',
        'first_plugin_option_func'
        // icon_url (optional)
        // position (optional)
    );

        add_submenu_page('first_plugin_option','first_plugin_setting','first_pugin_setting','manage_options','first_plugin_setting','first_plugin_setting_func');

        add_dashboard_page('Theme option', 'Theme_options','manage_options','first_plugin_theme_setting','Theme_option_func');

}

register_activation_hook(__FILE__, function(){

add_option('first_plugin_option1','');

});

register_deactivation_hook(__FILE__, function(){

delete_option('first_plugin_option1');

});

 function first_plugin_process_for_setting(){

    register_setting('first_plugin_option_group','first_plugin_option_name');
    if (isset($_POST['first_plugin_option1'])) {
        $option_value = sanitize_text_field($_POST['first_plugin_option1']);
        update_option('first_plugin_option1', $option_value);
    }
    

 }

function first_plugin_option_func() { ?>



<div class="wrap">

<?php settings_errors('')   ?>

<form action="options.php" method="post">
<?php

settings_fields('first_plugin_option_group');

?>

<label for="">setting one</label>

<input type="text" id="Ajax_form" name="first_plugin_option1" value="<?php echo esc_html(get_option('first_plugin_option1')); ?>">


<?php

submit_button('save changes');


?>
</form>

<?php  include plugin_dir_path(__FILE__) . 'inc/api.php';?>

</div>


<?php
   
}

function first_plugin_setting_func(){

 echo "<h1>first_plugin_setting</h1>";

}

function Theme_option_func(){
      echo "<h1>Theme_function</h1>";
}
















