<div class="box-select">
    <select class="quotes-filter author" data-type="author">
        <option value="">Author</option>
        <?php
        $args = array(
            'post_type'      => 'quotes',
            'posts_per_page' => -1,
            'meta_key'       => 'author', // Change to your custom field key
        );
    
        $quotes_query = new WP_Query( $args );
        $authors = array();
    
        if ( $quotes_query->have_posts() ) {
            while ( $quotes_query->have_posts() ) {
                $quotes_query->the_post();
                $author = get_post_meta( get_the_ID(), 'author', true );
                if ( ! empty( $author ) && ! in_array( $author, $authors ) ) {
                    $authors[] = $author;
                }
            }
        }
    
        wp_reset_postdata();
    
        foreach ( $authors as $author ) {
            echo '<option value="' . esc_attr( $author ) . '">' . esc_html( $author ) . '</option>';
        }
        ?>
    </select>
    
    <select class="quotes-filter category" data-type="category">
        <option value="">Category</option>
        <?php
        $categories = get_terms( array(
            'taxonomy' => 'category',
            'hide_empty' => false,
        ) );
    
        foreach ( $categories as $category ) {
            echo '<option value="' . esc_attr( $category->slug ) . '">' . esc_html( $category->name ) . '</option>';
        }
        ?>
    </select>
    
    <select class="quotes-filter tag" data-type="tag">
        <option value="">Tag</option>
        <?php
        $tags = get_terms( array(
            'taxonomy' => 'post_tag',
            'hide_empty' => false,
        ) );
    
        foreach ( $tags as $tag ) {
            echo '<option value="' . esc_attr( $tag->slug ) . '">' . esc_html( $tag->name ) . '</option>';
        }
        ?>
    </select>
</div>