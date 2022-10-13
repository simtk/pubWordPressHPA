<?php

/*
 * Add global content page
 */

if ( function_exists( 'acf_add_options_page' ) ) {

    acf_add_options_page( array(
        'page_title'    => 'Global Site Content',
        'position'      => 31,
        'menu_title'    => 'Global Content',
        'menu_slug'     => 'global-content',
        'capability'    => 'edit_posts',
        'redirect'      => false,
    ) );

    // allow editors to access options page
    $role_object = get_role( 'editor' ); // get the the role object
    $role_object->add_cap( 'edit_theme_options' ); // add $cap capability to this role object
}


/*
 * Store ACF fields in files
 */

function hpa_acf_json_save_point( $path ) {
    return get_stylesheet_directory() . '/_fields';
}
add_filter( 'acf/settings/save_json', 'hpa_acf_json_save_point' );

function hpa_acf_json_load_point( $paths ) {
    unset($paths[0]);
    return array( get_stylesheet_directory() . '/_fields' );
}
add_filter( 'acf/settings/load_json', 'hpa_acf_json_load_point' );