<?php
function theme_name_footer_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Footer Widget Area', 'theme-name' ),
        'id'            => 'footer-widget-area',
        'description'   => __( 'Add widgets here to appear in your footer.', 'theme-name' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
}
add_action( 'widgets_init', 'theme_name_footer_widgets_init' );
