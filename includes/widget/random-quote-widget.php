<?php
class Random_Quote_Widget extends WP_Widget {
 
    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
            'random_quote_widget', // Base ID
            'Random Quote Widget', // Name
            array( 'description' => __( 'Displays a random quote.', 'your-textdomain' ) )
        );
    }
 
    /**
     * Front-end display of widget.
     */
    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance['title'] );
        echo $args['before_widget'];
        if ( ! empty( $title ) ) {
            echo $args['before_title'] . $title . $args['after_title'];
        }
        // Display the random quote here
        echo '<div class="random-quote-widget">';
        echo '<p>' . $this->get_random_quote() . '</p>';
        echo '</div>';
        echo $args['after_widget'];
    }
 
    /**
     * Back-end widget form.
     */
    public function form( $instance ) {
        $title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        <?php
    }
 
    /**
     * Sanitize widget form values as they are saved.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        return $instance;
    }
 
    /**
     * Function to get a random quote.
     */
    private function get_random_quote() {
        $args = array(
            'post_type'      => 'quotes',
            'posts_per_page' => 1,
            'orderby'        => 'rand'
        );
        $quotes_query = new WP_Query( $args );
        $quote = '';
        if ( $quotes_query->have_posts() ) {
            while ( $quotes_query->have_posts() ) {
                $quotes_query->the_post();
                $quote_text = get_post_meta( get_the_ID(), 'quote_text', true );
                $quote_author = get_post_meta( get_the_ID(), 'author', true );
                $quote = '<em>' . esc_html( $quote_text ) . '</em> - ' . esc_html( $quote_author );
            }
        }
        wp_reset_postdata();
        return $quote;
    }
}

// Register the widget
function register_random_quote_widget() {
    register_widget( 'Random_Quote_Widget' );
}
add_action( 'widgets_init', 'register_random_quote_widget' );
