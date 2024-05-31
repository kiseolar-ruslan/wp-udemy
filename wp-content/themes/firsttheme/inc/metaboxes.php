<?php

function firsttheme_add_metabox()
{
    add_meta_box(
        'car_metabox',
        esc_html__('Cars Setting', 'firsttheme'),
        'firsttheme_cars_metabox_html',
        'car',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'firsttheme_add_metabox');

function firsttheme_cars_metabox_html($post)
{
    $car_price  = get_post_meta($post->ID, 'car_price', true);
    $car_engine = get_post_meta($post->ID, 'car_engine', true);

    wp_nonce_field('firstthemerandomstring', '_carmetabox');
    ?>
    <p>
        <label for="car_price"><?php esc_html_e('Car price', 'firsttheme'); ?></label>
        <input type="text" id="car_price" name="car_price" value="<?php echo esc_attr($car_price); ?>">
    </p>
    <p>
        <label for="car_engine"><?php esc_html_e('Car Engine', 'firsttheme'); ?></label>
        <select id="car_engine" name="car_engine">
            <option value=""><?php esc_html_e('Select Engine', 'firsttheme'); ?></option>
            <option value="manual" <?php echo ($car_engine === 'manual') ? 'selected' : '' ?>><?php esc_html_e('Manual', 'firsttheme'); ?></option>
            <option value="automatic" <?php echo ($car_engine === 'automatic') ? 'selected' : '' ?>><?php esc_html_e('Automatic', 'firsttheme'); ?></option>
        </select>
    </p>
  <?php
}

function firsttheme_save_metabox($post_id, $post)
{
    if (isset($_POST['_carmetabox']) === false || wp_verify_nonce($_POST['_carmetabox'], 'firstthemerandomstring') === false) {
        return $post_id;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }

    if ($post->post_type !== 'car') {
        return $post_id;
    }

    if (current_user_can('edit_posts', $post_id) === false) {
        return $post_id;
    }

    if (isset($_POST['car_price']) === true) {
        update_post_meta($post_id, 'car_price', sanitize_text_field($_POST['car_price']));
    } else {
        delete_post_meta($post_id, 'car_price');
    }

    if (isset($_POST['car_engine']) === true) {
        update_post_meta($post_id, 'car_engine', sanitize_text_field($_POST['car_engine']));
    } else {
        delete_post_meta($post_id, 'car_engine');
    }

    return $post_id;
}
add_action('save_post', 'firsttheme_save_metabox', 10, 2);