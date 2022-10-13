<?php

$section_id = '';
if ( get_sub_field( 'section_id' ) ):
    $section_id = 'id="' . get_sub_field( 'section_id' ) . '"';
endif;

$page_section_classes = array(
    'page-section',
    'page-section--collage',
    'collage',
);

$page_section_classes[] = 'collage--layout-' . get_sub_field( 'layout' );
?>

<div <?php echo ( $section_id ) ? $section_id : '';  ?> class="<?php echo implode( ' ', $page_section_classes ); ?>">

    <div class="collage__container container">

        <div class="collage__visuals">

            <?php

            if ( get_sub_field( 'layout' ) == 'visual' ):
                $visuals = get_sub_field( 'visual_images' );
            else:
                $visuals = get_sub_field( 'content_images' );
            endif;

            foreach ( $visuals as $visual ): ?>
            <div class="collage__visual">
                <img src="<?php echo $visual['sizes']['large']; ?>" alt="">
            </div>
            <?php endforeach; ?>

        </div>

        <div class="collage__visual--accent">
            <?php if ( get_sub_field( 'layout' ) == 'visual' ):
                $hero_connector = get_stylesheet_directory_uri() . '/assets/images/hero-connector.png';
            else:
                $hero_connector = get_stylesheet_directory_uri() . '/assets/images/Lines.png';
            endif; ?>
            <img src="<?php echo $hero_connector; ?>" alt="">
        </div>

        <div class="collage__content wysiwyg-content">

            <?php the_sub_field( 'content' ); ?>

        </div>

    </div>

</div>
