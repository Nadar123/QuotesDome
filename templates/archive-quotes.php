<?php
/**
 * The template for displaying Quotes archive page.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package QuotesDome Plugin
 */

get_header();

?>
<?php include plugin_dir_path( __FILE__ ) . 'inc/filters.php';?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">

        <?php
        $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
        $args = array(
            'post_type'      => 'quotes',
            'posts_per_page' => 3, 
            'paged'          => $paged
        );

        $quotes_query = new WP_Query( $args );
            if ( $quotes_query->have_posts() ) : ?>
            <?php include plugin_dir_path( __FILE__ ) . 'inc/quotesPosts.php';?>
        <?php else : ?>
            <p>No quotes found.</p>
        <?php endif;
         wp_reset_postdata();?>
    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();

