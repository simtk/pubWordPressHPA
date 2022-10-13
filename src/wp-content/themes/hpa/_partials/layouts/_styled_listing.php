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

    <div class="styled-listing__container container">

        <?php if ( get_sub_field( 'section_intro' ) ): ?>
        <div class="styled-listing__section-intro page-section__section-intro wysiwyg-content">
            <?php the_sub_field( 'section_intro' ); ?>
        </div>
        <?php endif; ?>

        <div class="styled-listing__list">

            <?php while ( have_rows( 'cards' ) ): the_row(); ?>
            <div class="styled-listing__card">

                <div class="styled-listing__image">

                    <?php if ( get_sub_field( 'background_image' ) ):
                        $image = get_sub_field( 'background_image' ); ?>
                        <img src="<?php echo $image['sizes']['large']; ?>" alt="">
                    <?php endif; ?>

                </div>

                <div class="styled-listing__content">

                    <h3 class="styled-listing__title"><?php the_sub_field( 'card_title' ); ?><i class="fal fa-chevron-down"></i></h3>
                    <div class="styled-listing__wysiwyg-content wysiwyg-content">
                        <?php the_sub_field( 'card_content' ); ?>
                    </div>

                </div>

            </div>
            <?php endwhile; ?>

        </div>

    </div>

</div>
