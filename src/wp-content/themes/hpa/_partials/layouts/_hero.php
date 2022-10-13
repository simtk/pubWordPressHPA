<?php
$page_section_classes = array(
    'page-section',
    'page-section--hero',
    'hero',
); ?>

<div class="<?php echo implode( ' ', $page_section_classes ); ?>">

    <div class="hero__container container">

        <h1 class="hero__title"><?php the_sub_field( 'hero_title' ); ?></h1>

        <?php $embed = get_sub_field( 'modal_video' ); 
        if ( $embed ):

            // Use preg_match to find iframe src.
            preg_match('/src="(.+?)"/', $embed, $matches);
            $src = $matches[1];

            // Add extra parameters to src and replcae HTML.
            $params = array(
                'rel' => 0,
            );
            
            $new_src = add_query_arg($params, $src);
            $embed = str_replace($src, $new_src, $embed);

            // Add extra attributes to iframe HTML.
            $attributes = 'frameborder="0"';
            $embed = str_replace('></iframe>', ' ' . $attributes . '></iframe>', $embed);
        ?>
        <div class="hero__modal">

            <div class="hero__modal-cta wysiwyg-content">
                <div class="hero__modal-cta-button">

                    <?php $icon = get_stylesheet_directory_uri() . '/assets/images/play-button.svg'; ?>
                    <img src="<?php echo $icon; ?>" alt="">

                </div>
                <?php the_sub_field( 'video_cta' ); ?>

            </div>

            <div class="hero__modal-video">
                <?php echo $embed; ?>
            </div>

        </div>
        <?php endif; ?>

        <?php if ( get_sub_field( 'background_images' ) ): ?>
        <div class="hero__images">
            
            <?php foreach( get_sub_field( 'background_images' ) as $image ): ?>
            <div class="hero__image">
                <img src="<?php echo $image['sizes']['large']; ?>" alt="">
            </div>
            <?php endforeach; ?>

            
        </div>
        <div class="hero__image-connector">

            <?php $hero_connector = get_stylesheet_directory_uri() . '/assets/images/hero-connector.png'; ?>
            <img src="<?php echo $hero_connector; ?>" alt="">

        </div>
        <?php endif; ?>

        <div class="hero__content wysiwyg-content">

            <?php the_sub_field( 'content' ); ?>

        </div>

    </div>

</div>