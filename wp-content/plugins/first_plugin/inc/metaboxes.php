<?php

add_action('admin_init', 'first_plugin_add_metabox');

function first_plugin_add_metabox() {
    add_meta_box('_my_custommetaboxes', 'Custom Metaboxes', 'first_plugin_custommetaboxes', ['post', 'page']);
}

function first_plugin_custommetaboxes($post) {
    $_mymetabox = get_post_meta($post->ID, '_mymetabox', true) ?: "";
    $_myselectbox = get_post_meta($post->ID, '_myselectbox', true) ?: "";
    ?>

    <input type="text" id="_mymetabox" name="_mymetabox" class="" value="<?php echo esc_attr($_mymetabox); ?>" >

    <br>

    <select name="_myselectbox" id="_myselectbox">
        <option value="1" <?php selected($_myselectbox, 1); ?>>One</option>
        <option value="2" <?php selected($_myselectbox, 2); ?>>Two</option>
        <option value="3" <?php selected($_myselectbox, 3); ?>>Three</option>
    </select>

    <?php
}

add_action('save_post', 'first_plugin_save_post');

function first_plugin_save_post($post_id) {
    if (array_key_exists('_mymetabox', $_POST) && array_key_exists('_myselectbox', $_POST)) {
        update_post_meta($post_id, '_mymetabox', sanitize_hex_color($_POST['_mymetabox']));
        update_post_meta($post_id, '_myselectbox', sanitize_text_field($_POST['_myselectbox']));
    }
}

add_action('the_post', 'first_plugin_custom_the_post');

function first_plugin_custom_the_post($post) {
    if(is_single() || is_home() || is_front_page()) {
        $_mymetabox = get_post_meta($post->ID, '_mymetabox', true) ?: "";
        $_myselectbox = get_post_meta($post->ID, '_myselectbox', true) ?: "";
        ?>

        <style>
            /* Apply background color based on the metabox value */
            article#post-<?php echo esc_attr($post->ID); ?> {
                background-color: <?php echo esc_attr($_mymetabox); ?>;
                color: #fff;
            }
            
            <?php if ($_myselectbox == 1): ?>
            article#post-<?php echo esc_attr($post->ID); ?> {
                border: 1px solid red;
            }
            <?php elseif ($_myselectbox == 2): ?>
            article#post-<?php echo esc_attr($post->ID); ?> {
                border: 1px solid blue;
            }
            <?php elseif ($_myselectbox == 3): ?>
            article#post-<?php echo esc_attr($post->ID); ?> {
                border: 1px solid green;
            }
            <?php endif; ?>
        </style>

        <?php
    }
}
