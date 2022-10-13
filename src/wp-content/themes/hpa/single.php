<?php get_header(); ?>

<div class="page-section page-section--page-title page-title">

    <div class="container">

        <div class="page-title__wysiwyg-content wysiwyg-content">

            <h1>News</h1>

        </div>

    </div>
</div>
<div class="post">

    <div class="page-section page-section--post-details post__details">

        <div class="container">

            <div class="post__details-content wysiwyg-content">

                <h2 class="post__title"><?php the_title(); ?></h2>

                <div class="post__date-tags">
                    <p class="post__date"><?php echo get_the_date( 'F d, Y' ); ?></p>

                    <?php
                    // grab associated tags
                    $tags = get_the_terms(  get_the_id(), 'category' );
                    $tags_array = array();
                    if ( $tags ): foreach( $tags as $tag ):
                        $tags_array[] = $tag->name;
                    endforeach; endif;
                    if ( !empty( $tags_array ) ): ?>
                    <p class="post__tags"><span>Related To:</span> <?php echo implode( '/', $tags_array ); ?></p>
                    <?php endif; ?>
                </div>

            </div>

            <?php
            // if there are associate organizations, cycle thru them and output the image
            if ( get_field( 'published_by' ) == 'organizations' && get_field( 'organizations' ) ): ?>
            <div class="post__details-organizations">
                <p class="eyebrow">Collaborators</p>
                <div class="post__details-organizations-wrapper">
                    <?php foreach( get_field( 'organizations' ) as $org ): ?>
                        <div class="post__details-organization">

                            <?php
                            $logo = get_field( 'image', $org->ID );
                            if( isset($logo['sizes']['large']) ):
                            ?>
                            <img src="<?php echo $logo['sizes']['large']; ?>" alt="<?php echo $logo['alt']; ?>" width="<?php echo $logo['sizes']['large-width']; ?>" height="<?php echo $logo['sizes']['large-height']; ?>">
                            <?php endif; ?>

                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <?php
            // if authors are selected instead
            elseif ( get_field( 'published_by' ) == 'author' ): ?>
            <div class="post__details-authors">
                <div class="post__details-content--background"></div>
                <?php
                $author = array();

                // if existing author, grab title, organizations and bio from selected person post
                if ( get_field( 'author_type' ) == 'existing' ):

                    foreach( get_field( 'author' ) as $post ): setup_postdata( $post );

                        $author = array(
                            'name' => get_the_title(),
                            'org' => NULL,
                            'bio' => NULL,
                        );

                        // if person has organziations select them and set them in authors array
                        if ( get_field( 'organization_type' ) ==  'existing' ):
                            if ( get_field( 'existing_organization' ) ): foreach( get_field( 'existing_organization' ) as $org ):
                                $author['org'][] = get_the_title( $org->ID );
                            endforeach;  endif;
                        else:
                            // if person has custom organziation, grab title and set it in authors array
                            if ( get_field( 'organization' ) ):
                                $author['org'] = get_field( 'organization' );
                            endif;
                        endif;

                        // if there is a bio, add it to authors array
                        if ( get_field( 'external_link' ) ):
                            $author['bio'] = get_field( 'external_link' );
                        endif;


                    endforeach; wp_reset_postdata();

                else:

                    // if custom author grab all associated fields
                    $author = array(
                        'name' => get_field( 'name' ),
                        'org' => get_field( 'organization' ) ? array( get_field( 'organization' ) ) : NULL,
                        'bio' => get_field( 'external_link' ) ? get_field( 'external_link' ) : NULL,
                    );

                endif; ?>

                <p class="eyebrow">Written by</p>
                <p class="post__details-author-name"><?php echo $author['name']; ?></p>

                <?php if ( isset( $author['org'] ) ): ?>
                <p class="post__details-author-org">
                    <?php 
                    if ( is_array( $author['org'] ) ):
                        echo implode( ', ', $author['org'] );
                    else:
                        echo $author['org'];
                    endif; ?>
                </p>
                <?php endif; ?>

                <?php if ( isset( $author['bio'] ) ): ?>
                <div class="post__details-author-bio">

                    <a href="<?php echo esc_url( $author['bio'] ); ?>" class="bio-link">View Bio<i class="fal fa-long-arrow-right"></i></a>

                </div>
                <?php endif; ?>

            </div>
            <?php endif; ?>

        </div>
    </div>

    <div class="post__layouts">
        <?php get_template_part( '_partials/fields/_content_rows' ); ?>
    </div>

    <?php
    $latest_news = array();

    // if latest news is selected
    if ( get_field( 'related_news' ) ):

        $latest_news = get_field( 'related_news' );
    else:

        // if not grab the latest 3
        $latest_query = new WP_Query(array(
            'post_type' => 'news',
            'posts_per_page' => 3,
            'orderby' => 'date',
            'order' => 'DESC',
        ));
        if ( $latest_query->have_posts() ):
            $latest_news = $latest_query->posts;
        endif; wp_reset_postdata();

    endif;

    // output
    if ( $latest_news ): ?>
    <div class="post__latest-news">

        <div class="container">

            <h3>Latest News</h3>
            <div class="post__latest-news-list">
                <?php foreach( $latest_news as $post ): setup_postdata( $post );
                    get_template_part( '_partials/components/_card' );
                endforeach; wp_reset_postdata(); ?>
            </div>

        </div>

    </div>
    <?php endif; ?>

    <?php

    // if there isnt a cta layout in the flexible content, output the default one at the bottom of the page
    $has_cta = false;
    while ( have_rows( 'content_rows' ) ) : the_row();
        if ( get_row_layout() == 'call_to_action' ):
            $has_cta = true;
        endif;
    endwhile;

    if ( $has_cta == false ):
        get_template_part( '_partials/layouts/_call_to_action', null, array(
            'default_cta' => true,
        ) );
    endif;
    ?>

</div>

<?php get_footer(); ?>
