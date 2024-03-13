<?php

add_action('admin_init', 'first_plugin_add_metabox');

function first_plugin_add_metabox() {
    add_meta_box('_my_custommetaboxes', 'Custom Metaboxes', 'first_plugin_custommetaboxes', ['post', 'page']);
}

function first_plugin_custommetaboxes($post) {
    $_mymetabox = get_post_meta($post->ID, '_mymetabox', true) ? get_post_meta($post->ID, '_mymetabox', true) : "";

    $_myselectbox = get_post_meta($post->ID, '_myselectbox', true) ? get_post_meta($post->ID, '_myselectbox', true) : "";
    ?>

    <input type="text" id="_mymetabox" name="_mymetabox" class="" value="<?php echo esc_attr($_mymetabox); ?>" >

    <br>

    <select name="_select_box" id="">

    <option value="1" <?php  echo $_myselectbox==1 ?  'selected':'' ?>>one</option>
    <option value="2" <?php  echo $_myselectbox==2 ?  'selected':'' ?>>Two</option>
    <option value="3" <?php  echo $_myselectbox==3 ?  'selected':'' ?>>Three</option>


    </select>

    <?php
}

add_action('save_post', 'first_plugin_save_post');

function first_plugin_save_post($post_id) {
    if (array_key_exists('_mymetabox', $_POST) && array_key_exists('_select_box', $_POST)) {
        update_post_meta($post_id, '_mymetabox', $_POST['_mymetabox']);
        update_post_meta($post_id, '_myselectbox', $_POST['_select_box']);
    }
}
