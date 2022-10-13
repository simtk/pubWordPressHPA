<?php
$section_id = '';
if ( get_sub_field( 'section_id' ) ):
    $section_id = 'id="' . get_sub_field( 'section_id' ) . '"';
endif;

$page_section_classes = array(
    'page-section',
    'page-section--news-listing',
    'news-listing'
);

$news_array = array();
$total_news_items = 0;
$posts_per_page = get_sub_field( 'posts_per_page' );
if ( get_sub_field( 'listing_type' ) == 'auto' ):
    $args = array(
        'post_type' => 'news',
        'orderby' => 'date',
        'order' => 'DESC',
    );

    if ( get_sub_field( 'categories' ) ):
        $args['tax_query'] = array(
            'relation' => 'OR',
            array(
                'taxonomy' => 'category',
                'field' => 'term_id',
                'terms' => get_sub_field( 'categories' ),
            ),
        );
    endif;

    $news_query = new WP_Query($args);
    if ( $news_query->have_posts() ):
        $news_array = $news_query->posts;

        $total_news_items = $news_query->post_count;
    endif;
    wp_reset_postdata();

else:
    $news_array = get_sub_field( 'news' );

    $total_news_items = count( $news_array );
endif;
?>

<div <?php echo ( $section_id ) ? $section_id : '';  ?> class="<?php echo implode( ' ', $page_section_classes ); ?>">

    <div class="container">

        <?php if ( get_sub_field( 'section_intro' ) ): ?>
        <div class="news-listing__section-intro page-section__section-intro wysiwyg-content">
            <?php the_sub_field( 'section_intro' ); ?>
        </div>
        <?php endif; ?>

        <div class="news-listing__list" data-posts-per-page="<?php echo $posts_per_page; ?>">

            <?php
            $cnt = 0;
            foreach( $news_array as $post ): setup_postdata( $post ); $cnt++;

                get_template_part( '_partials/components/_card', null, array(
                    'posts_per_page' => $posts_per_page,
                    'cnt' => $cnt,
                ) );

            endforeach; wp_reset_postdata(); ?>

            <?php if ( $total_news_items > $posts_per_page ): ?>
            <div class="pagination">
                <a href="" class="button news-listing__load-more">Load More</a>
            </div>
            <?php endif; ?>

        </div>

    </div>

</div>
