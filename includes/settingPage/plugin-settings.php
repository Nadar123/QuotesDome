<?php
// Initialize the plugin settings
function plugin_settings_init() {
    // Register settings
    register_setting(
        'plugin_settings_group', // Option group
        'plugin_settings_options', // Option name
        'plugin_settings_sanitize' // Sanitization callback
    );

    // Add settings section
    add_settings_section(
        'plugin_settings_section', // ID
        'Quote Display Options', // Title
        'plugin_settings_section_callback', // Callback
        'plugin_settings_group' // Page
    );

    // Add settings fields
    add_settings_field(
        'quote_count', // ID
        'Number of Quotes to Display', // Title
        'plugin_settings_quote_count_callback', // Callback
        'plugin_settings_group', // Page
        'plugin_settings_section' // Section
    );

    add_settings_field(
        'quote_order', // ID
        'Quote Order', // Title
        'plugin_settings_quote_order_callback', // Callback
        'plugin_settings_group', // Page
        'plugin_settings_section' // Section
    );

}
add_action('admin_init', 'plugin_settings_init');

// Callback for quote count field
function plugin_settings_quote_count_callback() {
    $options = get_option('plugin_settings_options');
    $quote_count = isset($options['quote_count']) ? $options['quote_count'] : 1;
    ?>
    <input type="number" min="1" id="quote_count" name="plugin_settings_options[quote_count]" value="<?php echo esc_attr($quote_count); ?>" />
    <p class="description">Enter the number of quotes to display.</p>
    <?php
}

// Callback for quote order field
function plugin_settings_quote_order_callback() {
    $options = get_option('plugin_settings_options');
    $quote_order = isset($options['quote_order']) ? $options['quote_order'] : 'random';
    ?>
    <select id="quote_order" name="plugin_settings_options[quote_order]">
        <option value="random" <?php selected($quote_order, 'random'); ?>>Random Order</option>
        <option value="latest" <?php selected($quote_order, 'latest'); ?>>Latest First</option>
    </select>
    <p class="description">Select the order in which quotes should be displayed.</p>
    <?php
}

// Callback for settings section
function plugin_settings_section_callback() {
    echo '<p>Customize the appearance and behavior of the random quote display.</p>';
}

// Sanitize and validate input
function plugin_settings_sanitize($input) {
    $sanitized_input = array();

    if (isset($input['quote_count'])) {
        $sanitized_input['quote_count'] = absint($input['quote_count']);
    }

    if (isset($input['quote_order']) && in_array($input['quote_order'], array('random', 'latest'))) {
        $sanitized_input['quote_order'] = $input['quote_order'];
    }

    return $sanitized_input;
}
