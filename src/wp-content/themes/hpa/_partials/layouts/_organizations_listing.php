<?php
$section_id = '';
if ( get_sub_field( 'section_id' ) ):
    $section_id = 'id="' . get_sub_field( 'section_id' ) . '"';
endif;

$page_section_classes = array(
    'page-section',
    'page-section--organizations-listing',
    'organizations-listing',
);

$style = get_sub_field( 'style' );


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

$page_section_classes[] = 'organizations-listing--style-' . $style;

$organizations = array();
if ( get_sub_field( 'style' ) == 'simple' ):
    if ( get_sub_field( 'organizations_relationship' ) ): foreach( get_sub_field( 'organizations_relationship' ) as $post ): setup_postdata( $post );
        $organizations[] = array(
            'image' => get_field( 'image' ),
            'link_to' => get_field( 'link_to' ),
            'custom_width' => get_field( 'custom_width' ),
        );
    endforeach; wp_reset_postdata(); endif;
else:
    while ( have_rows( 'organizations_repeater' ) ): the_row();
        if ( get_sub_field( 'organization_type' ) == 'custom' ):
            $organizations[] = array(
                'image' => get_sub_field( 'image' ),
                'content' => get_sub_field( 'content' ),
                'link_to' => get_sub_field( 'link_to' ),
            );
        else:
            $org = get_sub_field( 'organization' );
            $organizations[] = array(
                'image' => get_field( 'image', $org->ID ),
                'content' => get_field( 'content', $org->ID ),
                'link_to' => get_field( 'link_to', $org->ID ),
            );
        endif;
    endwhile;
endif;

$add_cta = get_sub_field( 'add_cta' );
?>

<div <?php echo ( $section_id ) ? $section_id : '';  ?> class="<?php echo implode( ' ', $page_section_classes ); ?>" <?php echo ( get_sub_field( 'background' ) == 'image' ) ? $page_section_style : '';  ?>>

    <?php if ( get_sub_field( 'background' ) == 'image-linear-gradient' ): ?>
        <div class="page-section__background-image-linear-gradient" <?php echo $page_section_style; ?>></div>
    <?php endif; ?>

    <div class="organizations-listing__container container">

        <?php if ( get_sub_field( 'section_intro' ) ): ?>
        <div class="organizations-listing__section-intro page-section__section-intro wysiwyg-content">
            <?php the_sub_field( 'section_intro' ); ?>
        </div>
        <?php endif; ?>

        <?php if ( get_sub_field( 'carousel_heading' ) ): ?>
        <h3 class="organizations-listing__carousel-heading"><?php the_sub_field( 'carousel_heading' ); ?></h3>
        <?php endif; ?>

        <div class="organizations-listing__list organizations-listing__count-<?php echo count($organizations); ?>">

            <?php foreach( $organizations as $org ): ?>
            <div class="organizations-listing__org" <?php echo ( isset( $org['custom_width'] ) ) ? 'style="width: ' . $org['custom_width'] . '; max-width: ' . $org['custom_width'] .  ';"' : ''; ?>>

                <?php
                $image = $org['image'];
                if( isset($image['sizes']['large']) ):
                    // echo '<pre style="">'; print_r( $org['link_to'] ); echo '</pre>';
                ?>
                <div class="organizations-listing__image">
                    <?php if( is_array($org['link_to']) && !empty($org['link_to']) ):  ?>
                    <a class="organizations-listing__image-link" href="<?php echo $org['link_to']['url']; ?>" target="<?php echo $org['link_to']['target']; ?>" title="<?php echo $org['link_to']['title']; ?>">
                    <?php endif; ?>
                    <img src="<?php echo $image['sizes']['large']; ?>" alt="<?php echo $image['alt'] ? $image['alt'] : $image['title'] ; ?>">
                    <?php if( is_array($org['link_to']) && !empty($org['link_to']) ): ?>
                    </a>
                    <?php endif; ?>
                </div>
                <?php endif; ?>

                <?php if ( isset( $org['content'] ) ): ?>
                <div class="organizations-listing__content wysiwyg-content">

                    <?php echo $org['content']; ?>

                </div>
                <?php endif; ?>

            </div>
            <?php endforeach; ?>

        </div>

        <?php
        if ( $add_cta == true ):
            get_template_part( '_partials/layouts/_section_divider' );

            get_template_part( '_partials/layouts/_call_to_action', null, array(
                'default_cta' => true,
                'included_in_layout' => true,
                'cta_content_background' => get_sub_field( 'cta_content_background' ),
            )   );
        endif; ?>

    </div>

</div>
