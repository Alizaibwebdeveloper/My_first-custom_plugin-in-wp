<?php

/*
 * Plugin Name:       my_thirdrdplugin
 * Description:       This is my Third custom plugin that is developed by me.
 * Plugin URI:        https://example.com/plugins/my_thirdrdplugin/
 * Version:           1.10.3
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Ali zaib(Wordpress developer)
 * Author URI:        https://author.example.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://example.com/my-plugin/
 * Text Domain:       my_thirdrdplugin
 * Domain Path:       /languages
 */


 defined('ABSPATH') || die("Sorry You cannot Access this folder Directerly");

 register_activation_hook(__FILE__, 'my_thirdplugin_activation');
 function my_thirdplugin_activation(){

    global $wpdb,$table_prefix;
    $wp_emp = $table_prefix.'emp';
    $q ="CREATE TABLE IF NOT EXISTS `$wp_emp` (`id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(50) NOT NULL , `email` VARCHAR(100) NOT NULL , `status` BOOLEAN NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
    $wpdb->query($q);

   //  $q = "INSERT INTO $wp_emp (id, name, email, status) VALUES (NULL, 'Ali zaib', 'alizaib12220@gmail.com', 1)";
   $data = array(
      'name' => 'Ali zaib',
      'email' => 'alizaib12220@gmail.com',
    'status' => 1
   );

    $wpdb->insert($wp_emp,$data);

 }

 register_deactivation_hook(__FILE__,'my_thirdplugin_deactivation');
 function my_thirdplugin_deactivation(){

   global $wpdb,$table_prefix;
   $wp_emp = $table_prefix.'emp';
   $q ="TRUNCATE TABLE IF EXISTS `$wp_emp`";
   $wpdb->query($q);
 }

 add_shortcode('my_shortcode', 'my_shortcode_func');

 function my_shortcode_func($atrrs){
   $atrrs = array_change_key_case($atrrs,'CASE_LOWER');
   $atrrs= shortcode_atts(array(
     'msg' => 'How are you a php developer!'
   ),$atrrs);
    return 'How are you a php developer!'.$atrrs['msg'];
 }