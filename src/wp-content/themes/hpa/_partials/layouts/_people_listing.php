<?php

$section_id = '';
if ( get_sub_field( 'section_id' ) ):
    $section_id = 'id="' . get_sub_field( 'section_id' ) . '"';
endif;

$page_section_classes = array(
    'page-section',
    'page-section--people-listing',
    'people-listing',
);
$page_section_classes[] = 'people-listing--layout-' . get_sub_field( 'layout' );
?>

<div <?php echo ( $section_id ) ? $section_id : '';  ?> class="<?php echo implode( ' ', $page_section_classes ); ?>">

    <div class="people-listing__container container">

        <?php if ( get_sub_field( 'section_intro' ) ): ?>
        <div class="people-listing__section-intro page-section__section-intro wysiwyg-content">
            <?php the_sub_field( 'section_intro' ); ?>
        </div>
        <?php endif; ?>

        <div class="people-listing__list">

            <?php foreach ( get_sub_field( 'people' ) as $post ): setup_postdata( $post ); ?>
            <div class="people-listing__person">

                <div class="people-listing__image">

                    <?php
                    $image = get_field( 'photo' );
                    $image_src = '';
                    if( isset($image['sizes']['large']) ){
                        $image_src = $image['sizes']['large'];
                    }
                    // if( isset($image['sizes']['people-photo-prominent']) ){
                    //     $image_src = $image['sizes']['people-photo-prominent'];
                    // } elseif( isset($image['sizes']['people-photo-small']) ){
                    //     $image_src = $image['sizes']['people-photo-small'];
                    // }

                    if( $image_src ):
                    ?>
                    <img src="<?php echo $image_src; ?>" alt="Photo of <?php the_title(); ?>">
                    <?php endif; ?>

                </div>
                <div class="people-listing__content">

                    <h4 class="people-listing__name"><?php the_title(); ?></h4>

                    <?php if ( get_field( 'job_title' ) ): ?>
                    <p class="people-listing__title"><?php the_field( 'job_title' ); ?></p>
                    <?php endif; ?>

                    <?php
                    $orgs = array();
                    if ( get_field( 'organization_type' ) == 'existing' ):
                        if ( get_field( 'existing_organization' ) ): foreach ( get_field( 'existing_organization' ) as $org ):
                            $orgs[] = get_the_title( $org->ID );
                        endforeach;  endif;
                    else:
                        $orgs[] = get_field( 'organization' );
                    endif;

                    if ( !empty( $orgs ) ): ?>

                    <p class="people-listing__organization"><?php echo implode( ', ', $orgs ); ?></p>

                    <?php endif; ?>

                    <?php if ( get_field( 'external_link' ) ): ?>
                    <a href="<?php echo esc_url( get_field( 'external_link' ) ) ?>" class="people-listing__bio-link bio-link" target="_blank">View Bio</a>
                    <?php endif; ?>

                </div>

            </div>
            <?php endforeach; wp_reset_postdata(); ?>

        </div>

    </div>

</div>
