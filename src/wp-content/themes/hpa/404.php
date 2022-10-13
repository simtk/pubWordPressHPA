<?php get_header(); ?>

<?php
$args = array(
    'name' => 'page-not-found',
    'post_type' => 'page',
);
$the_query = new WP_Query( $args );
if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

    <?php
    $has_hero = false;
    while ( have_rows( 'content_rows' ) ) : the_row();
        if ( get_row_layout() == 'hero' ):
            $has_hero = true;
        endif;
    endwhile;

    if ( !$has_hero ): ?>

        <div class="page-section page-section--page-title page-title">

            <div class="container">

                <div class="page-title__wysiwyg-content wysiwyg-content">

                    <h1><?php the_title(); ?></h1>

                </div>

            </div>
        </div>

    <?php endif; ?>

<?php get_template_part( '_partials/fields/_content_rows' ); ?>

<?php endwhile; endif; ?>

<?php get_footer(); ?>
