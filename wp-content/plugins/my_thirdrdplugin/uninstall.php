<?php

if(!defined('WP_UNINSTALL_PLUGIN')){

header('Location: /plugin_customization');
die();

}

global $wpdb,$table_prefix;
$wp_emp =$table_prefix.'emp';
$q = "DROP TABLE `wp_wmp';";
$wpdb->query($q);