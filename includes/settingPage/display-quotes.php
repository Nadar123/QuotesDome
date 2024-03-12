<?php
// Display random quotes
function display_random_quotes() {
    // Retrieve plugin settings
    $options = get_option('plugin_settings_options');
    $quote_count = isset($options['quote_count']) ? $options['quote_count'] : 1;
    $quote_order = isset($options['quote_order']) ? $options['quote_order'] : 'random';

    // Query quotes based on settings
    $args = array(
        'post_type'      => 'quotes',
        'posts_per_page' => $quote_count,
        'orderby'        => ($quote_order === 'random') ? 'rand' : 'date',
    );

    $quotes_query = new WP_Query($args);

    // Display quotes
    if ($quotes_query->have_posts()) :
    ?>
        <div class="quotes-archive">
            <?php
            while ($quotes_query->have_posts()) :
                $quotes_query->the_post();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('quote'); ?>>
                <header class="entry-header">
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="featured-image">
                            <?php the_post_thumbnail('small'); ?>
                        </div>
                    <?php endif; ?>
                </header>
                <div class="quotes-content-wrapper">
                    <div class="quotes-content">
                        <h2 class="entry-title"><?php the_title(); ?></h2>
                        <?php
                            $quote_text = get_post_meta(get_the_ID(), 'quote_text', true);
                        ?>
                        <?php if (!empty($quote_text)) : ?>
                            <p class="quote-text"><?php echo esc_html($quote_text); ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="author">
                        <?php 
                            $quote_author = get_post_meta(get_the_ID(), 'author', true);
                        ?>
                        <?php if (!empty($quote_author)) : ?>
                            <p class="quote-author"> Author- <?php echo esc_html($quote_author); ?></p>
                        <?php endif; ?>
                    </div>    
                </div>
            </article>
            <?php endwhile; ?>
        </div>
        <?php wp_reset_postdata(); ?>
    <?php else : ?>
        <p>No quotes found.</p>
    <?php endif;
}

//  Displaying random quotes
function random_quotes_shortcode() {
    ob_start();
    display_random_quotes();
    return ob_get_clean();
}
add_shortcode('random_quotes', 'random_quotes_shortcode');
