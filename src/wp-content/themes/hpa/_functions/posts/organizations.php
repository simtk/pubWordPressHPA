<?php

function hpa_register_organizations_post_type() {

    register_post_type( 'organizations', array(
        'hierarchical' => true,
        'has_archive' => false,
        'labels' => array(
            'name' => __( 'Organizations' ),
            'singular_name' => __( 'Organization' )
        ),
        'public' => true,
        'menu_icon' => 'dashicons-networking',
        'menu_position' => 23,
        'rewrite' => array(
            'with_front' => true,
            'slug' => 'organizations'
        ),
        'show_ui' => true,
        'show_in_menu' => true,
        'supports' => array( 'title', 'page-attributes', 'revisions' ),
    ) );

}
add_action( 'init', 'hpa_register_organizations_post_type' );