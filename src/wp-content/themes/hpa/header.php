<!doctype html>
<!--[if lt IE 7]> <html class="lt-ie10 lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>    <html class="lt-ie10 lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>    <html class="lt-ie10 lt-ie9"> <![endif]-->
<!--[if IE 9]>    <html class="lt-ie10"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="en"> <!--<![endif]-->
<head>
    <?php the_field('google_analytics_tag', 'option'); ?>
    <?php /* <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-5HX772B');</script>
    <!-- End Google Tag Manager --> */ ?>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <link rel="shortcut icon" href="/favicon.ico" />

    <style type="text/css">
        :root {
            --solid-theme-color: <?php the_field( 'solid_color', 'options' ); ?>;
            --gradient-theme-color: linear-gradient(<?php the_field( 'gradient_color', 'options' ); ?>);
            --left-rule-gradient-theme-color: linear-gradient(<?php the_field( 'left_rule_color_gradient', 'options' ); ?>);
        }
    </style>

    <title><?php wp_title(); ?></title>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <?php /* <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5HX772B"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) --> */ ?>


    <?php if ( get_field( 'additional_header', 'options' ) ): ?>
    <div class="additional-header">
        <?php the_field( 'additional_header', 'options' ); ?>
    </div>
    <?php endif;?>

    <header class="page-section page-section--site-header site-header" role="banner">

        <div class="site-header__container container">

            <?php if ( get_field( 'logo', 'options' ) ): ?>
            <div class="site-header__logo">
                <a href="/">
                    <?php $image = get_field( 'logo', 'options'); ?>
                    <img src="<?php echo $image['sizes']['large']; ?>" alt="Home logo">
                </a>
            </div>
            <?php endif; ?>
            <div class="site-header__navigation">
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'primary',
                    'depth' => 1,
                    'container' => false,
                ) );
                ?>
                <div class="site-header__hamburger">

                    <div class="hamburger hamburger--spring">

                        <div class="hamburger-box">

                            <div class="hamburger-inner"></div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="site-header__utility-navigation">

                <div class="site-header__utility-navigation-wrapper">

                    <div class="site-header__utility-close">

                        <i class="fal fa-times"></i>

                    </div>

                    <div class="site-header__primary-nav--mobile">

                        <?php
                        wp_nav_menu( array(
                            'theme_location' => 'primary',
                            'depth' => 1,
                            'container' => false,
                        ) );
                        ?>

                    </div>

                    <?php
                        wp_nav_menu( array(
                            'theme_location' => 'utility',
                            'depth' => 1,
                            'container' => false,
                        ) );
                    ?>

                    <?php if ( have_rows( 'accounts', 'options' ) ): ?>
                    <ul class="site-header__socials">

                        <?php while ( have_rows( 'accounts', 'options' ) ): the_row(); ?>
                        <li class="site-header__social">

                            <a href="<?php echo esc_url( get_sub_field( 'link' )['url'] ); ?>" target="_blank">
                                <span><?php the_sub_field( 'link' )['title'] ?></span>
                                <i class="<?php echo get_sub_field( 'icon' ); ?>"></i>
                            </a>

                        </li>
                        <?php endwhile; ?>

                    </ul>
                    <?php endif; ?>

                    <?php
                    wp_nav_menu( array(
                        'theme_location' => 'footer',
                        'depth' => 1,
                        'container' => false,
                    ) );
                    ?>
                </div>

            </div>

        </div>

    </header>

    <div id="content" role="main" class="page-section--main">
