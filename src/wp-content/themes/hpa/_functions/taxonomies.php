<?php

// register category taxonomies
function hpa_register_category_taxonomy() {

    $category_args = array(
        'labels' => array(
            'name' => 'Categories',
            'singular_name' => 'Category',
        ),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_quick_edit' => true,
        'meta_box_cb' => false,
    );

    register_taxonomy( 'category', array( 'news' ), $category_args );

}
add_action( 'init', 'hpa_register_category_taxonomy' );