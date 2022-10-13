<?php
$section_id = '';
if ( get_sub_field( 'section_id' ) ):
    $section_id = 'id="' . get_sub_field( 'section_id' ) . '"';
endif;

$page_section_classes = array(
    'page-section',
    'page-section--gallery',
    'gallery',
);

$page_section_classes[] = 'gallery--visual-position-' . get_sub_field( 'visual_position' );


$gallery_items = array();
if ( have_rows( 'visuals' ) ): while ( have_rows( 'visuals' ) ): the_row();

    $media_string = '';
    if ( get_sub_field( 'visual_type' ) == 'image' ):

        $image = get_sub_field( 'image' );
        $media_string = '<img src="' . $image['sizes']['medium'] . '" alt="">';

        $gallery_items[] = array(
            'visual' => $media_string,
            'thumbnail' => $media_string,
            'type' => 'image'
        );

    else:
        if ( get_sub_field( 'video_type' ) == 'file' ):

            $video = get_sub_field( 'video' );
            $image = get_sub_field( 'poster_image' );

            $gallery_items[] = array(
                'visual' => '<video src="' . $video['url'] . '" playsinline controls></video>',
                'thumbnail' => '<img src="' . $image['sizes']['medium'] . '" alt="">',
                'type' => 'video'
            );

        else:

            $video = get_sub_field( 'oembed_video' );

            preg_match('/src="(.+?)"/', $video, $matches_url );
            $src = $matches_url[1];

            preg_match('/embed(.*?)?feature/', $src, $matches_id );
            $id = $matches_id[1];
            $id = str_replace( str_split( '?/' ), '', $id );

            $media_string = '<img src="http://img.youtube.com/vi/' . $id . '/mqdefault.jpg">';

            $gallery_items[] = array(
                'visual' => $video,
                'thumbnail' => $media_string,
                'type' => 'video'
            );

        endif;
    endif;

endwhile; endif; ?>


<div <?php echo ( $section_id ) ? $section_id : '';  ?> class="<?php echo implode( ' ', $page_section_classes ); ?>" <?php echo ( $image ) ? $page_section_style : '';  ?>>

    <div class="gallery__container container">
        <?php if ( get_sub_field( 'section_intro' ) ): ?>

        <div class="gallery__section-intro page-section__section-intro wysiwyg-content">
            <?php the_sub_field( 'section_intro' ); ?>
        </div>

        <?php endif; ?>


        <div class="gallery__content">
            <div class="wysiwyg-content">
                <?php the_sub_field( 'content' ); ?>
            </div>
        </div>

        <div class="gallery__visuals-wrapper">

            <div class="gallery__visual-spotlight">

                <div class="gallery__visual-spotlight-container">
                <?php if ( $gallery_items ): foreach( $gallery_items as $item ): ?>

                    <div class="gallery__visual">
                        <?php echo $item['visual']; ?>
                    </div>

                <?php endforeach; endif; ?>
                </div>

            </div>

            <div class="gallery__visual-navigator">

                <div class="gallery__visual-navigator-container">
                <?php if ( $gallery_items ): foreach( $gallery_items as $item ): ?>

                    <div class="gallery__visual-thumbnail <?php echo 'gallery__visual-thumbnail--type-' . $item['type']; ?>">
                        <?php echo $item['thumbnail']; ?>
                    </div>

                <?php endforeach; endif; ?>
                </div>

            </div>

        </div>

    </div>

</div>
