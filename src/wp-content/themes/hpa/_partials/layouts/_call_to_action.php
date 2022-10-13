<?php
$section_id = '';
if ( get_sub_field( 'section_id' ) ):
    $section_id = 'id="' . get_sub_field( 'section_id' ) . '"';
endif;

$page_section_classes = array(
    'page-section',
    'page-section--call-to-action',
    'call-to-action',
);

// if cta is pulled in programmatically, use the default type
$type = get_sub_field( 'type' );
if ( isset( $args['default_cta'] ) ):
    $type = 'default';
endif;

// if cta is included at the bottom of a different layout
$included_in_layout = false;
if ( isset( $args['included_in_layout'] ) ):
    $included_in_layout = true;
endif;

// if cta is included at the bottom of a different layout 
if ( isset( $args['cta_content_background'] ) ):
    $cta_content_background = $args['cta_content_background'];
endif;

if ( $included_in_layout == false ):
    $background = get_field( 'call_to_action_background', 'options' );
    $background_image = get_field( 'call_to_action_background_image', 'options' );

    if ( $type == 'custom' ):
        $background = get_sub_field( 'background_select' )['background'];
        $background_image = get_sub_field( 'background_image' );
    endif;

    $page_section_classes[] = 'page-section--background-' . $background;
    if ( get_sub_field( 'background' ) != 'white' && get_sub_field( 'background' ) != 'gray-angled' && get_sub_field( 'background' ) != 'light-color-angled' ):
        $page_section_classes[] = 'page-section--background';
    endif;

    if ( get_sub_field( 'background' ) == 'gray-angled' || get_sub_field( 'background' ) == 'light-color-angled' ) {
        $page_section_classes[] = 'page-section--background-angled';
    }

    if ( $background == 'image' || $background == 'image-linear-gradient' ):

        $page_section_style = 'style="background-image: url(' . $background_image['sizes']['large'] . ')";';

        if ( $background == 'image' ):
        endif;
    endif;
endif;

$section_intro = get_field( 'call_to_action_section_intro', 'options' );
$content = get_field( 'call_to_action_content', 'options' );
$form = get_field( 'call_to_action_form_embed', 'options' );
$cta_content_background = get_field( 'call_to_action_content_background', 'options' );

if ( $type == 'custom' ):
    $section_intro = get_sub_field( 'section_intro' );
    $content = get_sub_field( 'content' );
    $form = get_sub_field( 'form_embed' );
endif; ?>

<div <?php echo ( $section_id ) ? $section_id : '';  ?> class="<?php echo implode( ' ', $page_section_classes ); ?>" <?php echo ( $background == 'image' ) ? $page_section_style : '';  ?>>

    <?php if ( $background == 'image-linear-gradient' ): ?>
        <div class="page-section__background-image-linear-gradient" <?php echo $page_section_style; ?>></div>
    <?php endif; ?>

    <div class="call-to-action__container container">

        <div class="call-to-action__wrapper <?php echo ( $cta_content_background == true ) ? 'call-to-action__wrapper--without' : '' ?>">
            <?php if ( $section_intro ): ?>
            <div class="call-to-action__section-intro wysiwyg-content">

                <?php echo $section_intro; ?>

            </div>
            <?php endif; ?>

            <div class="call-to-action__content wysiwyg-content">

                <?php echo $content; ?>

            </div>

            <div class="call-to-action__form">

                <?php echo $form; ?>

            </div>

        </div>

    </div>

</div>
