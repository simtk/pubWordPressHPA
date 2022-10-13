<?php
$section_id = '';
if ( get_sub_field( 'section_id' ) ):
    $section_id = 'id="' . get_sub_field( 'section_id' ) . '"';
endif;

$page_section_classes = array(
    'page-section',
    'page-section--quote',
    'quote',
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
endif;

if ( get_sub_field( 'citation_type' ) == 'existing' ):
    $id = get_sub_field( 'author' )[0]->ID;
    $person = array(
        'name' => get_sub_field( 'author' )[0]->post_title,
        'image' => get_field( 'photo', $id ),
    );

    if ( get_field( 'organization_type', $id ) == 'custom' ):
        if ( get_field( 'organization', $id ) ):
            $person['org'] = get_field( 'organization', $id );
        endif;
    else:
        if ( get_field( 'existing_organization', $id ) ):
            $person['org'] = get_field( 'existing_organization', $id )[0]->post_title;
        endif;
    endif;
else:
    $person = array(
        'name' => get_sub_field( 'name' ),
        'image' => get_sub_field( 'image' ),
    );
endif; ?>

<div <?php echo ( $section_id ) ? $section_id : '';  ?> class="<?php echo implode( ' ', $page_section_classes ); ?>" <?php echo ( get_sub_field( 'background' ) == 'image' ) ? $page_section_style : '';  ?>>

    <?php if ( get_sub_field( 'background' ) == 'image-linear-gradient' ): ?>
        <div class="page-section__background-image-linear-gradient" <?php echo $page_section_style; ?>></div>
    <?php endif; ?>

    <div class="quote__container container">

        <?php if( isset($person['image']['sizes']['large']) ): ?>
        <div class="quote__image">
            <img src="<?php echo $person['image']['sizes']['large']; ?>" alt="">
        </div>
        <?php endif; ?>

        <div class="quote__content wysiwyg-content">

            <h3 class="quote__quote"><?php the_sub_field( 'quote', false, false ); ?></h3>
            <p class="quote__citation"><?php echo $person['name']; ?></p>
            
            <?php if ( isset( $person['org'] ) ): ?>
            <p class="quote__organization"><?php echo $person['org']; ?></p>
            <?php endif;?>

        </div>

    </div>

</div>
