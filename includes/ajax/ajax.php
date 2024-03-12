<?php

// AJAX Callback to Filter Quotes by Author
function filter_quotes_callback() {
    check_ajax_referer( 'quotes_ajax_nonce', 'nonce' );

    $author = $_POST['author'];
    $category = $_POST['category'];
    $tag = $_POST['tag'];
    $paged = isset($_POST['paged']) ? $_POST['paged'] : 1;

   
    $args = array(
        'post_type'      => 'quotes',
        'posts_per_page' => 3,
        'orderby'        => 'meta_value',
        'order'          => 'ASC',
        'paged'          => $paged,
    );

     if(strlen($author)) {
        $args['meta_query'] = array(
          array(
                'key'   => 'author',
                'value' => $author,
          ));
    }
    if(strlen($category)) {
        $args['tax_query'] = array(
        array(
            'taxonomy' => 'category',
            'field' => 'slug',
            'terms' => $category
        )
        );
    }
      if(strlen($tag)) {
        $args['tag'] = $tag;
    }
    $quotes_query = new WP_Query( $args );
    $GLOBALS["wp_query"] = $quotes_query;

    ob_start();
    

    if ( $quotes_query->have_posts() ) : ?>
        <div class="quotes-archive-wrapper">
            <div class="quotes-archive">
                <?php
                $count = 0;
                while ( $quotes_query->have_posts() ) :
                    $quotes_query->the_post();
                    $count++;
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
                            </div class="">    
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>
            
                <?php 
                the_posts_pagination(); 
                wp_reset_postdata();
                ?> 
           
        </div>
        <?php else : ?>
            <p>No quotes found.</p>
        <?php endif;
            $output = ob_get_clean();
            wp_send_json( $output );
        wp_die();
}
add_action( 'wp_ajax_filter_quotes', 'filter_quotes_callback' );
add_action( 'wp_ajax_nopriv_filter_quotes', 'filter_quotes_callback' );