<?php

function hpa_register_people_post_type() {

    register_post_type( 'people', array(
        'hierarchical' => true,
        'has_archive' => false,
        'labels' => array(
            'name' => __( 'People' ),
            'singular_name' => __( 'Person' )
        ),
        'public' => true,
        'menu_icon' => 'dashicons-groups',
        'menu_position' => 22,
        'rewrite' => array(
            'with_front' => true,
            'slug' => 'people'
        ),
        'show_ui' => true,
        'show_in_menu' => true,
        'supports' => array( 'title', 'page-attributes', 'revisions' ),
    ) );

}
add_action( 'init', 'hpa_register_people_post_type' );