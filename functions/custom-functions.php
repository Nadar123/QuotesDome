<?php

function get_custom_post_type_template( $archive_template ) {
    global $post;

    if ( is_post_type_archive( 'quotes' ) ) {
        $archive_template = dirname( __FILE__ ) . '/../templates/archive-quotes.php';
    }

    return $archive_template;
}

add_filter( 'archive_template', 'get_custom_post_type_template' );
