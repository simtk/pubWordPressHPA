<?php

function hpa_register_news_post_type() {

    register_post_type( 'news', array(
        'hierarchical' => true,
        'has_archive' => false,
        'labels' => array(
            'name' => __( 'News' ),
            'singular_name' => __( 'News' )
        ),
        'public' => true,
        'menu_icon' => 'dashicons-media-text',
        'menu_position' => 21,
        'rewrite' => array(
            'with_front' => true,
            'slug' => 'news'
        ),
        'show_ui' => true,
        'show_in_menu' => true,
        'supports' => array( 'title', 'page-attributes', 'revisions' ),
    ) );

}
add_action( 'init', 'hpa_register_news_post_type' );