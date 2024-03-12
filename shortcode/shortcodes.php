<?php
/**
 * Class::Random Quote Shortcode
 */
class Random_Quote_Shortcode {

    public function __construct() {
        add_shortcode('random_quote', array($this, 'random_quote_shortcode'));
    }

    // Shortcode function
    public function random_quote_shortcode($atts) {
        // Shortcode attributes: default values

        $atts = shortcode_atts(array(
            'text_color' => '#000', 
            'font_size' => '20px',     
            'bg_color' => '#ffffff'
        ), $atts, 'random_quote');

        // random quote
        $args = array(
            'post_type' => 'quotes',
            'posts_per_page' => 1,
            'orderby' => 'rand'
        );
        $quotes_query = new WP_Query($args);

        // Check for any quotes post 
        if ($quotes_query->have_posts()) {
            $output = '<div class="random-quote" style="background-color: ' . esc_attr($atts['bg_color']) . '; padding: 20px;">';

            while ($quotes_query->have_posts()) {
                $quotes_query->the_post();
                $quote_text = get_post_meta(get_the_ID(), 'quote_text', true);
                $author = get_post_meta(get_the_ID(), 'author', true);

                // Format the quote based on attributes
                $output .= '<blockquote style="color: ' . esc_attr($atts['text_color']) . '; font-size: ' . esc_attr($atts['font_size']) . ';">';
                $output .= esc_html($quote_text);
                $output .= '<p>Author-' . esc_html($author) . '</p>';
                $output .= '</blockquote>';
            }

            // End building the output
            $output .= '</div>';

            // Reset Post Data
            wp_reset_postdata();

            return $output;
        } else {
            return 'No quotes found.';
        }
    }
}

$random_quote_shortcode = new Random_Quote_Shortcode();
