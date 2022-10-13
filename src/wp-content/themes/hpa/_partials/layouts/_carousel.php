<?php
$section_id = '';
if ( get_sub_field( 'section_id' ) ):
    $section_id = 'id="' . get_sub_field( 'section_id' ) . '"';
endif;

$page_section_classes = array(
    'page-section',
    'page-section--styled-listing',
    'styled-listing',
);
?>

<div <?php echo ( $section_id ) ? $section_id : '';  ?> class="<?php echo implode( ' ', $page_section_classes ); ?>">

    <div class="carousel__container container">

        <?php if ( get_sub_field( 'section_intro' ) ): ?>
        <div class="carousel__section-intro page-section__section-intro wysiwyg-content">
            <?php the_sub_field( 'section_intro' ); ?>
        </div>
        <?php endif; ?>

        <div class="carousel__carousel-wrapper">

            <?php while ( have_rows( 'carousel_items' ) ): the_row(); ?>
            <div class="carousel__item">

                <div class="carousel__content">

                    <div class="carousel__wysiwyg-content wysiwyg-content">
                        <?php the_sub_field( 'content' ); ?>
                    </div>

                </div>

                <div class="carousel__image">

                    <?php $image = get_sub_field( 'image' ); ?>
                    <img src="<?php echo $image['sizes']['large']; ?>" alt="">

                </div>

            </div>

            <?php endwhile; ?>

        </div>

        <?php
        if ( isset($add_cta) && $add_cta == true ):
            get_template_part( '_partials/layouts/_section_divider' );

            get_template_part( '_partials/layouts/_call_to_action', null, array(
                'default_cta' => true,
                'included_in_layout' => true,
                'cta_content_background' => get_sub_field( 'cta_content_background' ),
            )   );
        endif; ?>

    </div>

</div>
