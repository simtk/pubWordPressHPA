<?php
$section_id = '';
if ( get_sub_field( 'section_id' ) ):
    $section_id = 'id="' . get_sub_field( 'section_id' ) . '"';
endif;

$page_section_classes = array(
    'page-section',
    'page-section--callout',
    'callout',
);

$page_section_classes[] = 'page-section--background-' . get_sub_field( 'background' );
if ( get_sub_field( 'background' ) != 'white' && get_sub_field( 'background' ) != 'gray-angled' && get_sub_field( 'background' ) != 'light-color-angled' ):
    $page_section_classes[] = 'page-section--background';
endif;

if ( get_sub_field( 'background' ) == 'gray-angled' || get_sub_field( 'background' ) == 'light-color-angled' ) {
    $page_section_classes[] = 'page-section--background-angled';
}

$image = '';
if ( get_sub_field( 'background' ) == 'image' ):
    $image = get_sub_field( 'background_image' );
    $page_section_style = 'style="background-image: url(' . $image['sizes']['large'] . ')";';
endif; ?>

<div <?php echo ( $section_id ) ? $section_id : '';  ?> class="<?php echo implode( ' ', $page_section_classes ); ?>" <?php echo ( $image ) ? $page_section_style : '';  ?>>

    <div class="callout__container container">

        <div class="callout__content wysiwyg-content">

            <?php the_sub_field( 'content' ); ?>

        </div>

    </div>

</div>
