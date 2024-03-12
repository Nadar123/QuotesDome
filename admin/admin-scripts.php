<?php
// Enqueue scripts plugin settings page

function plugin_settings_scripts() {
    wp_enqueue_script('plugin-admin-script', plugin_dir_url(__FILE__) . 'admin.js', array('jquery'), '1.0', true);
}
add_action('admin_enqueue_scripts', 'plugin_settings_scripts');
