<?php
/**
 * Enqueue Scripts and Styles
 */

function quotes_enqueue_scripts() {
    // Enqueue JavaScript
    wp_enqueue_script( 'quotes-ajax', plugin_dir_url( __FILE__ ) . '../../assets/js/quotes-ajax.js', array( 'jquery' ), '1.0', true );

    // Localize the script with new data
    $ajax_params = array(
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'nonce'    => wp_create_nonce( 'quotes_ajax_nonce' ),
    );
    wp_localize_script( 'quotes-ajax', 'quotes_ajax_params', $ajax_params );

    // Enqueue CSS
    wp_enqueue_style( 'quotes-style', plugin_dir_url( __FILE__ ) . '../../build/css/style.css', array(), '1.0' );
}
add_action( 'wp_enqueue_scripts', 'quotes_enqueue_scripts' );