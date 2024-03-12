<?php
// Register the plugin settings page
function plugin_settings_page() {
    if (!current_user_can('manage_options')) {
        return;
    }

    // Output the settings page HTML
    ?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <form method="post" action="options.php">
            <?php
            // Output security fields for the registered setting "plugin_settings_group"
            settings_fields('plugin_settings_group');
            // Output setting sections and their fields
            do_settings_sections('plugin_settings_group');
            // Output submit button
            submit_button('Save Settings');
            ?>
        </form>
    </div>
    <?php
}

// Hook into the admin menu to add the plugin settings page
function add_plugin_menu() {
    add_options_page(
        'Plugin Settings',
        'Plugin Settings',
        'manage_options',
        'plugin_settings',
        'plugin_settings_page'
    );
}
add_action('admin_menu', 'add_plugin_menu');
