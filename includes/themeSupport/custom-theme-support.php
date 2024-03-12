<?php
function custom_theme_support() {
    if (function_exists('add_theme_support')) {
        // Thumbnail theme support
        add_theme_support('post-thumbnails');
        
        // Define custom image sizes
        add_image_size('medium', 350, 200, true);
        add_image_size('small', 250, '', true);
    }
}
add_action('after_setup_theme', 'custom_theme_support');
