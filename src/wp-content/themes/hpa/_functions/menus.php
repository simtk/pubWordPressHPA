<?php

/*
 * Adjust menu order of media so it's above all the content
 */

function hpa_custom_menu_order() {
    return array( 'index.php', 'upload.php' );
}
add_filter( 'custom_menu_order', '__return_true' );
add_filter( 'menu_order', 'hpa_custom_menu_order' );


/*
 * Remove comments and theme customizer menu items
 */

function hpa_custom_menu_page_removing() {
    remove_menu_page( 'edit-comments.php' );
    remove_submenu_page( 'themes.php', 'customize.php?return=%2Fwp-admin%2F' );
}
add_action( 'admin_menu', 'hpa_custom_menu_page_removing' );


/*
 * Create menus
 */

register_nav_menus( array(
        'primary' => 'Primary Navigation'
) );

register_nav_menus( array(
        'utility' => 'Utility Navigation'
) );

register_nav_menus( array(
    'footer' => 'Footer Navigation'
) );