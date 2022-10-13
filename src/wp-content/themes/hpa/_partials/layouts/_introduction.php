<?php
$page_section_classes = array(
    'page-section',
    'page-section--introduction',
    'introduction',
); ?>

<div class="<?php echo implode( ' ', $page_section_classes ); ?>">

    <div class="introduction__container container">

        <div class="introduction__content wysiwyg-content">

            <?php the_sub_field( 'content' ) ?>

        </div>

        <?php if ( have_rows( 'links' ) ):?> 
        <ul class="introduction__links">
            <?php while ( have_rows( 'links' ) ): the_row(); ?>

            <li class="introduction__link">

                <a href="<?php the_sub_field( 'section_id' ); ?>">
                    <?php if ( get_sub_field( 'icon' ) ): $icon = get_sub_field( 'icon' ); ?>
                    <img src="<?php echo $icon['sizes']['large']; ?>" alt="">
                    <?php endif; 
                    the_sub_field( 'link_text' );
                    ?>
                </a>

            </li>

            <?php endwhile; ?>
        </ul>
        <?php endif; ?>

    </div>

</div>