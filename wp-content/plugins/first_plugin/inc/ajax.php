
<?php

add_action('wp_ajax_my_ajax_action', 'first_plugin_ajax_action');

function first_plugin_ajax_action() {
    if (isset($_POST['option1'])) {
        $option1_value = sanitize_text_field($_POST['option1']);
        update_option('first_plugin_option1', $option1_value);
        echo 'Field successfully updated!';
    } else {
        echo 'Error: Option not provided.';
    }
    wp_die();
}
