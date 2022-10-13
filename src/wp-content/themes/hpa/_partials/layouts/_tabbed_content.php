<?php
$section_id = '';
if ( get_sub_field( 'section_id' ) ):
    $section_id = 'id="' . get_sub_field( 'section_id' ) . '"';
endif;

$page_section_classes = array(
    'page-section',
    'page-section--tabbed-content',
    'tabbed-content',
);

$page_section_classes[] = 'page-section--background-' . get_sub_field( 'background' );
if ( get_sub_field( 'background' ) != 'white' && get_sub_field( 'background' ) != 'gray-angled' && get_sub_field( 'background' ) != 'light-color-angled' ):
    $page_section_classes[] = 'page-section--background';
endif;

if ( get_sub_field( 'background' ) == 'gray-angled' || get_sub_field( 'background' ) == 'light-color-angled' ) {
    $page_section_classes[] = 'page-section--background-angled';
}

if ( get_sub_field( 'background' ) == 'image' || get_sub_field( 'background' ) == 'image-linear-gradient' ):
    $image = get_sub_field( 'background_image' );
    $page_section_style = 'style="background-image: url(' . $image['sizes']['large'] . ')";';
endif; ?>

<div <?php echo ( $section_id ) ? $section_id : '';  ?> class="<?php echo implode( ' ', $page_section_classes ); ?>" <?php echo ( get_sub_field( 'background' ) == 'image' ) ? $page_section_style : '';  ?>>

    <?php if ( get_sub_field( 'background' ) == 'image-linear-gradient' ): ?>
        <div class="page-section__background-image-linear-gradient" <?php echo $page_section_style; ?>></div>
    <?php endif; ?>

    <div class="tabbed-content__container container">

        <?php if ( get_sub_field( 'section_intro' ) ): ?>
        <div class="tabbed-content__section-intro page-section__section-intro wysiwyg-content">
            <?php the_sub_field( 'section_intro' ); ?>
        </div>
        <?php endif; ?>

        <ul class="tabbed-content__titles">

            <?php $cnt = 0; while ( have_rows( 'tabs' ) ): the_row(); $cnt++; ?>
            <li class="tabbed-content__title <?php echo ( $cnt == 1 ) ? 'active' : '' ?>" data-title-num="<?php echo $cnt; ?>">

                <?php the_sub_field( 'title' ); ?>
                <i class="fal fa-chevron-right"></i>

            </li>
            <?php endwhile; ?>

        </ul>

        <div class="tabbed-content__contents">

            <?php $cnt = 0; while ( have_rows( 'tabs' ) ): the_row(); $cnt++; ?>
            <div class="tabbed-content__wysiwyg-content wysiwyg-content <?php echo ( $cnt == 1 ) ? 'active' : '' ?>" data-content-num="<?php echo $cnt; ?>">

                <?php the_sub_field( 'content' ); ?>

            </div>
            <?php endwhile; ?>

        </div>

    </div>

</div>
