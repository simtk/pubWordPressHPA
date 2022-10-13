<?php
$section_id = '';
if ( get_sub_field( 'section_id' ) ):
    $section_id = 'id="' . get_sub_field( 'section_id' ) . '"';
endif;

$page_section_classes = array(
    'page-section',
    'page-section--content-with-details',
    'content-with-details',
);
?>

<div <?php echo ( $section_id ) ? $section_id : '';  ?> class="<?php echo implode( ' ', $page_section_classes ); ?>">

    <div class="accordion__container container">

        <?php if ( get_sub_field( 'section_intro' ) ): ?>
        <div class="content-with-details__section-intro page-section__section-intro wysiwyg-content">
            <?php the_sub_field( 'section_intro' ); ?>
        </div>
        <?php endif; ?>

        <div class="content-with-details__wrapper">

            <div class="content-with-details__details">

                <div class="content-with-details__content wysiwyg-content">

                    <?php the_sub_field( 'content' ); ?>

                </div>
                <div class="content-with-details__image">

                    <?php $image = get_sub_field( 'image' ); ?>
                    <img src="<?php echo $image['sizes']['large']; ?>" alt="">

                </div>

            </div>

            <div class="accordion__items">

                <?php while ( have_rows( 'items' ) ): the_row(); ?>
                <div class="accordion__item">

                    <button class="accordion__title" type="button">
                        <i class="fal fa-chevron-down"></i><?php the_sub_field( 'item_title' ); ?>
                    </button>
                    <div class="accordion__content">
                        <?php the_sub_field( 'item_content' ); ?>
                    </div>

                </div>
                <?php endwhile; ?>

            </div>

        </div>

    </div>

</div>
