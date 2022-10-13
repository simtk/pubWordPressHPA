<?php

function hpa_enqueue_scripts() {
    // wp_deregister_script('jquery');
    // wp_enqueue_script('jquery', 'https://code.jquery.com/jquery-3.6.0.min.js', '', '', true);

    wp_register_script( 'script', get_template_directory_uri().'/assets/js/index.js', '', filemtime( get_stylesheet_directory().'/assets/js/index.js' ) );
    wp_enqueue_script( 'script', '', '', '', true );
}
add_action( 'wp_enqueue_scripts', 'hpa_enqueue_scripts', 9999 );