    </div>

    <footer class="page-section page-section--site-footer site-footer" role="contentinfo">

        <div class="site-footer__container container">

        <?php if ( get_field( 'alternate_logo', 'options' ) ): ?>
            <div class="site-footer__logo">
                <a href="https://humanperformancealliance.org/">
                    <?php $image = get_field( 'alternate_logo', 'options'); ?>
                    <img src="<?php echo $image['sizes']['large']; ?>" alt="">
                </a>
            </div>
            <?php endif; ?>

            <div class="site-footer__content">

                <div class="site-footer__navigation">
                    <?php
                    wp_nav_menu( array(
                        'theme_location' => 'footer',
                        'depth' => 1,
                        'container' => false,
                    ) );
                    ?>
                    <div class="site-footer__copyright wysiwyg-content">

                        <p><?php the_field( 'copyright', 'options' ); ?></p>

                    </div>

                    <?php if ( have_rows( 'accounts', 'options' ) ): ?>
                    <ul class="site-footer__socials">

                        <?php while ( have_rows( 'accounts', 'options' ) ): the_row(); ?>
                        <li class="site-footer__social">

                            <a href="<?php echo esc_url( get_sub_field( 'link' )['url'] ); ?>" target="_blank">
                                <span><?php echo get_sub_field( 'link' )['title'] ?></span>
                                <i class="<?php echo get_sub_field( 'icon' ); ?>"></i>
                            </a>

                        </li>
                        <?php endwhile; ?>

                    </ul>
                    <?php endif; ?>

                </div>
                <?php if ( get_field( 'additional_footer_copy', 'options' ) ): ?>
                <div class="site-footer__additional-copy wysiwyg-content">
                    <?php the_field( 'additional_footer_copy', 'options' ); ?>
                </div>
                <?php endif; ?>

            </div>

        </div>

    </footer>

    <?php if ( get_field( 'additional_footer', 'options' ) ): ?>
    <div class="additional-footer">
        <?php the_field( 'additional_footer', 'options'); ?>
    </div>
    <?php endif; ?>

    <?php wp_footer(); ?>

</body>
</html>
