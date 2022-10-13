<?php
$section_id = '';
if ( get_sub_field( 'section_id' ) ):
    $section_id = 'id="' . get_sub_field( 'section_id' ) . '"';
endif;

$page_section_classes = array(
    'page-section',
    'page-section--content-with-visual',
    'content-with-visual',
);

$page_section_classes[] = 'content-with-visual--height-' . get_sub_field( 'layout_height' );
$page_section_classes[] = 'page-section--background-' . get_sub_field( 'background' );

if ( get_sub_field( 'background' ) != 'white' && get_sub_field( 'background' ) != 'gray-angled' && get_sub_field( 'background' ) != 'light-color-angled' ):
    $page_section_classes[] = 'page-section--background';
endif;

$image = '';
if ( get_sub_field( 'background' ) == 'image' || get_sub_field( 'background' ) == 'image-linear-gradient' ):
    $image = get_sub_field( 'background_image' );
    $page_section_style = 'style="background-image: url(' . $image['sizes']['large'] . ')";';
endif;

if ( get_sub_field( 'background' ) == 'gray-angled' || get_sub_field( 'background' ) == 'light-color-angled' ) {
    $page_section_classes[] = 'page-section--background-angled';
}

$page_section_classes[] = 'content-with-visual--layout-' . get_sub_field( 'layout' );
$page_section_classes[] = 'content-with-visual--visual-position-' . get_sub_field( 'visual_position' );

$media_string = '';
if ( get_sub_field( 'visual_type' ) == 'image' ):

    $image = get_sub_field( 'image' );
    $media_string = '<img src="' . $image['sizes']['large'] . '" alt="">';
    $page_section_classes[] = 'content-with-visual--image-' . get_sub_field( 'image_size' );

else:
    if ( get_sub_field( 'video_type' ) == 'file' ):

        $video = get_sub_field( 'video' );
        $media_string = '<video autoplay="0" muted loop playsinline>';
        $media_string .= '<source src="' . $video["url"] . '" type="' . $video["mime_type"] . '">';
        $media_string .= '</video>';

    else:

        $media_string = get_sub_field( 'video_embed' );

    endif;
endif; ?>

<div <?php echo ( $section_id ) ? $section_id : '';  ?> class="<?php echo implode( ' ', $page_section_classes ); ?>" <?php echo ( get_sub_field( 'background' ) == 'image' ) ? $page_section_style : '';  ?>>

    <?php if ( get_sub_field( 'background' ) == 'image-linear-gradient' ): ?>
        <div class="page-section__background-image-linear-gradient" <?php echo $page_section_style; ?>></div>
    <?php endif; ?>

    <?php if ( get_sub_field( 'section_intro' ) ): ?>

    <div class="container">

        <div class="content-with-visual__section-intro page-section__section-intro wysiwyg-content">

            <?php the_sub_field( 'section_intro' ); ?>

        </div>

    </div>
    <?php endif; ?>

    <?php if ( get_sub_field( 'layout' ) == 'contained' ): ?>
    <div class="container">
    <?php endif;?>

        <div class="content-with-visual__wrapper">

            <div class="content-with-visual__content">
                <div class="wysiwyg-content">
                    <?php the_sub_field( 'content' ); ?>
                </div>
            </div>

            <div class="content-with-visual__visual">
                <?php echo $media_string; ?>

                <?php if ( get_sub_field( 'caption' ) ): ?>
                <p class="content-with-visual__caption"><?php the_sub_field( 'caption' ); ?></p>
                <?php endif; ?>
            </div>

        </div>

    <?php if ( get_sub_field( 'layout' ) == 'contained' ): ?>
    </div>
    <?php endif;?>

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
