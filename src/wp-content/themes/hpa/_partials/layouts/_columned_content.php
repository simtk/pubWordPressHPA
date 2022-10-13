<?php
$section_id = '';
if ( get_sub_field( 'section_id' ) ):
    $section_id = 'id="' . get_sub_field( 'section_id' ) . '"';
endif;

$page_section_classes = array(
    'page-section',
    'page-section--columned-content',
    'columned-content',
);

$page_section_classes[] = 'page-section--background-' . get_sub_field( 'background' );
if ( get_sub_field( 'background' ) != 'white' && get_sub_field( 'background' ) != 'gray-angled' && get_sub_field( 'background' ) != 'light-color-angled' ):
    $page_section_classes[] = 'page-section--background';
endif;

if ( get_sub_field( 'background' ) == 'gray-angled' || get_sub_field( 'background' ) == 'light-color-angled' ) {
    $page_section_classes[] = 'page-section--background-angled';
}

$image = '';
if ( get_sub_field( 'background' ) == 'image' || get_sub_field( 'background' ) == 'image-linear-gradient' ):
    $image = get_sub_field( 'background_image' );
    $page_section_style = 'style="background-image: url(' . $image['sizes']['large'] . ')";';
endif; ?>

<div <?php echo ( $section_id ) ? $section_id : '';  ?> class="<?php echo implode( ' ', $page_section_classes ); ?>" <?php echo ( get_sub_field( 'background' ) == 'image' ) ? $page_section_style : '';  ?>>

    <?php if ( get_sub_field( 'background' ) == 'image-linear-gradient' ): ?>
        <div class="page-section__background-image-linear-gradient" <?php echo $page_section_style; ?>></div>
    <?php endif; ?>

    <div class="columned-content__container container">

        <?php if ( get_sub_field( 'section_intro' ) ): ?>
        <div class="columned-content__section-intro page-section__section-intro wysiwyg-content">
            <?php the_sub_field( 'section_intro' ); ?>
        </div>
        <?php endif; ?>

        <div class="columned-content__columns columned-content__columns--per-row-<?php the_sub_field( 'columns_per_row' ); ?>">

            <?php
            while ( have_rows( 'columns' ) ) : the_row();
                $column_width = get_sub_field( 'column_width' );
            ?>
            <div class="columned-content__column wysiwyg-content" <?php echo ( $column_width ) ? 'style="width: ' . $column_width . ';"' : '' ?>>
                <?php the_sub_field( 'content' ); ?>
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
