<?php get_header(); ?>

<?php
$has_hero = false;
while ( have_rows( 'content_rows' ) ) : the_row();
    if ( get_row_layout() == 'hero' ):
        $has_hero = true;
    endif;
endwhile;

if ( !$has_hero && have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <div class="page-section page-section--page-title page-title">

        <div class="container">

            <div class="page-title__wysiwyg-content wysiwyg-content">

                <h1><?php the_title(); ?></h1>

            </div>

        </div>
    </div>

<?php endwhile; endif; ?>

<?php get_template_part( '_partials/fields/_content_rows' ); ?>

<?php 
// if there isnt a cta layout in the flexible content, output the default one at the bottom of the page
$has_cta = false;
while ( have_rows( 'content_rows' ) ) : the_row();
    if ( get_sub_field( 'add_cta' ) ):
        $has_cta = true;
    endif;
    if ( get_row_layout() == 'call_to_action' ):
        $has_cta = true;
    endif;
endwhile;

if ( $has_cta == false ):
    get_template_part( '_partials/layouts/_call_to_action', null, array(
        'default_cta' => true,
        'cta_content_background' => get_field( 'call_to_action_content_background', 'options' ),
    )  );
endif; ?>

<?php if ( get_field( 'footnotes' ) ): ?>
<div class="page-section page-section--footnotes footnotes">

    <div class="container">

        <div class="footnotes__content wysiwyg-content">
            <?php the_field( 'footnotes' ); ?>
        </div>

    </div>

</div>
<?php endif; ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <?php if ( get_post()->post_content ): ?>
    <div class="page-section page-section--basic-content basic-content">

        <div class="container">

            <div class="basic-content__wysiwyg-content wysiwyg-content">

                <?php the_content(); ?>

            </div>

        </div>
    </div>
    <?php endif; ?>

<?php endwhile; endif; ?>

<?php get_footer(); ?>
