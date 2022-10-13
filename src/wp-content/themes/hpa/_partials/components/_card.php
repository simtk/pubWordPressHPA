<?php
$cnt = 0;
if( isset( $args['cnt'] ) ):
    $cnt = $args['cnt'];
endif;

$posts_per_page = 3;
if( isset( $args['posts_per_page'] ) ):
    $posts_per_page = $args['posts_per_page'];
endif;

$image_type = 'custom';
if ( get_field( 'listing_image' ) ): 
    $image = get_field( 'listing_image' )['sizes']['large']; 
else:
    $image_type = 'default';
    if( preg_match('/stanford\.edu$/', $_SERVER['HTTP_HOST']) === 1 ): 
        $image = get_stylesheet_directory_uri() . '/assets/images/logo--stanford.png';
    else:
        $image = get_stylesheet_directory_uri() . '/assets/images/logo.png';
    endif;
endif;
?>

<div class="card <?php echo ( $cnt > $posts_per_page  ) ? 'hidden' : ''; ?>">
    <a class="card__link" href="<?php echo get_the_permalink(); ?>"><?php the_title(); ?></a>
    <div class="card__image card__image--type-<?php echo $image_type; ?>">

        <img src="<?php echo $image; ?>" alt="">

    </div>
    <div class="card__content">

        <p class="card__date"><?php echo get_the_date( 'F j, Y' ); ?></p>
        <h4 class="card__title"><?php the_title(); ?></h4>

    </div>

</div>
