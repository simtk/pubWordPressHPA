<?php

// remove from sidebar
function hpa_remove_default_post_type() {
    remove_menu_page( 'edit.php' );
}
add_action( 'admin_menu', 'hpa_remove_default_post_type' );

// remove new post from admin bar
function hpa_remove_default_post_type_menu_bar( $wp_admin_bar ) {
    $wp_admin_bar->remove_node( 'new-post' );
}
add_action( 'admin_bar_menu', 'hpa_remove_default_post_type_menu_bar', 999 );

// remove from quick draft widget
function hpa_remove_draft_widget() {
    remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
}
add_action( 'wp_dashboard_setup', 'hpa_remove_draft_widget', 999 );