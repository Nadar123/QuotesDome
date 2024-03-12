
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
    <?php the_posts_pagination(); 
   // wp_reset_postdata();
    ?> 
</div>