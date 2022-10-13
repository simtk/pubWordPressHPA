<?php
$section_id = '';
if ( get_sub_field( 'section_id' ) ):
    $section_id = 'id="' . get_sub_field( 'section_id' ) . '"';
endif;

$page_section_classes = array(
    'page-section',
    'page-section--section-header',
    'section-header',
); ?>

<div <?php echo ( $section_id ) ? $section_id : '';  ?> class="<?php echo implode( ' ', $page_section_classes ); ?>">

    <div class="section-header__container container">

        <?php if ( get_sub_field( 'icon' ) ): $icon = get_sub_field( 'icon' ); ?>
        <div class="section-header__icon">

            <img src="<?php echo $icon['sizes']['large']; ?>" alt="">

        </div>
        <?php endif; ?>
        <h3 class="section-header__title"><?php the_sub_field( 'title' ); ?></h3>

    </div>

</div>
