<?php 
/**
 * Class:: QuoteMetaBox
 */
class QuoteMetaBox {
    
    public function __construct() {
        add_action('add_meta_boxes', array($this, 'quotes_meta_box'));
        add_action('save_post_quotes', array($this, 'save_quote_meta_box'));
    }

    // meta boxes for custom fields
    public function quotes_meta_box() {
        add_meta_box(
            'quote_meta_box',        // Meta box ID
            'Quote Details',         // Title of the meta box
            array($this, 'display_quote_meta_box'),// Callback function to display the meta box
            'quotes',                // Custom post type name
            'normal',                // Context
            'high'                   // Priority
        );
    }

    // Callback function to display meta box
    public function display_quote_meta_box($post) {
        // Retrieve current values for fields if they exist
        $quote_text = get_post_meta($post->ID, 'quote_text', true);
        $author = get_post_meta($post->ID, 'author', true);
        // Output fields
        ?>
        <p>
            <label for="quote_text">Quote Text:</label><br>
            <textarea id="quote_text" name="quote_text" rows="4" style="width: 100%;"><?php echo esc_textarea($quote_text); ?></textarea>
        </p>
        <p>
            <label for="author">Author:</label><br>
            <input type="text" id="author" name="author" value="<?php echo esc_attr($author); ?>" style="width: 100%;">
        </p>
        <?php
    }

    // Save custom field values
    public function save_quote_meta_box($post_id) {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        if (isset($_POST['quote_text'])) {
            update_post_meta($post_id, 'quote_text', sanitize_textarea_field($_POST['quote_text']));
        }

        if (isset($_POST['author'])) {
            update_post_meta($post_id, 'author', sanitize_text_field($_POST['author']));
        }
    }
}

$quote_meta_box = new QuoteMetaBox();
