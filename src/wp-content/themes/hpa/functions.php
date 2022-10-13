<?php
require_once( '_functions/acf.php' );
//require_once( '_functions/facetwp.php' );
require_once( '_functions/helpers.php' );
require_once( '_functions/menus.php' );
require_once( '_functions/styles.php' );
require_once( '_functions/scripts.php' );
require_once( '_functions/image-sizes.php' );


/*
 * Create custom post types
 */

// menu positions FYI:
// 15 - posts
// 20 - pages
// 21 - news
// 22 - people
// 23 - organizations
// 31 - global content

require_once( '_functions/posts/news.php' );
require_once( '_functions/posts/organizations.php' );
require_once( '_functions/posts/people.php' );
require_once( '_functions/posts/posts.php' );

/*
 * Taxonomies
 */
require_once( '_functions/taxonomies.php' );

/*
 * Add class to body if there is additional header
 */
function header_body_class( $classes ) {
    if ( get_field( 'additional_header', 'options' ) ):
        $classes[] = 'body--has-additional-header';
    endif;

    return $classes;
}
add_filter( 'body_class', 'header_body_class' );

/*
 * Add body class for pages with hero
 */

function hero_body_class( $classes ) {

    while ( have_rows( 'content_rows' ) ) : the_row();
        if ( get_row_layout() == 'hero' ):
            $classes[] = 'body--has-hero';
        endif;
    endwhile;

    return $classes;
}
add_filter( 'body_class', 'hero_body_class' );


/*
 * Add style and style selector to admin editor
 */

function hpa_add_editor_styles() {
    add_editor_style( get_template_directory_uri() .'/../hpa/assets/css/editor.css' );
}
add_action( 'admin_init', 'hpa_add_editor_styles' );

function hpa_mce_buttons_2( $buttons ) {
    array_unshift( $buttons, 'styleselect' );
    return $buttons;
}
add_filter( 'mce_buttons_2', 'hpa_mce_buttons_2' );

function hpa_mce_before_init( $init_array ) {
    $style_formats = array(
        array(
            'title' => 'Button',
            'selector' => 'a',
            'classes' => 'button',
        ),
        array(
            'title' => 'Link w/ Arrow',
            'inline' => 'span',
            'classes' => 'link-with-arrow',
            'wrapper' => false,
        ),
        array(
            'title' => 'Eyebrow',
            'inline' => 'span',
            'classes' => 'eyebrow',
            'wrapper' => false,
        ),
        array(
            'title' => 'Larger Text',
            'inline' => 'span',
            'classes' => 'larger-text',
            'wrapper' => false,
        ),
        array(
            'title' => 'Smaller Text',
            'inline' => 'span',
            'classes' => 'smaller-text',
            'wrapper' => false,
        ),
        array(
            'title' => 'Citation',
            'inline' => 'span',
            'classes' => 'citation',
            'wrapper' => false,
        ),
        array(
            'title' => 'Left Rule Style',
            'block' => 'div',
            'classes' => 'left-rule-style',
            'wrapper' => true,
        ),
        array(
            'title' => 'Red Headline',
            'inline' => 'span',
            'classes' => 'red-headline',
            'wrapper' => false,
        ),
        array(
            'title' => 'Green Headline',
            'inline' => 'span',
            'classes' => 'green-headline',
            'wrapper' => false,
        ),
    );
    $init_array['style_formats'] = json_encode( $style_formats );

    return $init_array;
}
add_filter( 'tiny_mce_before_init', 'hpa_mce_before_init' );


/*
 * Remove the jquery migrate console message
 */

add_action( 'wp_default_scripts', function( $scripts ) {

    if ( is_admin() ) {
        return;
    }

    if ( ! empty( $scripts->registered['jquery'] ) ) {
        $scripts->registered['jquery']->deps = array_diff( $scripts->registered['jquery']->deps, array( 'jquery-migrate' ) );
    }
} );


/**
 * Remove the WP REST API JSON Endpoints for logged out users
 * We remove the initial routes from the REST api (like /wp-json/v2/users) and plugins (like facet-wp) add their own routes.
 * @link https://stackoverflow.com/questions/37816170/rest-api-plugin-wordpress-disable-default-routes
 */

function hpa_restrict_rest_api_access() {

    if ( !current_user_can('edit_others_pages') ) {
        remove_action( 'rest_api_init', 'create_initial_rest_routes', 99 );
    }
}
add_action( 'rest_api_init', 'hpa_restrict_rest_api_access', 1 );


/**
 * Disable the emoji's
 */
function hpa_disable_emojis() {
   remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
   remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
   remove_action( 'wp_print_styles', 'print_emoji_styles' );
   remove_action( 'admin_print_styles', 'print_emoji_styles' );
   remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
   remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
   remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
}
add_action( 'init', 'hpa_disable_emojis' );


/**
 * Filter a few parameters into YouTube oEmbed requests
 *
 * @link http://goo.gl/yl5D3
 */
function hpa_youtube_player( $html, $url, $args ) {
  return str_replace( '?feature=oembed', '?feature=oembed&rel=0', $html );
}
add_filter( 'oembed_result', 'hpa_youtube_player', 10, 3 );


/*
 * Allow svg uploads
 */

function hpa_mime_types( $mime_types ) {
    $mime_types['svg'] = 'image/svg+xml';
    return $mime_types;
}
add_filter( 'upload_mimes', 'hpa_mime_types', 1, 1 );


/**
 * Disable Gutenberg using Gutenberg Ramp plugin
 *
 * @link https://wordpress.org/plugins/gutenberg-ramp/
 */

if ( function_exists( 'gutenberg_ramp_load_gutenberg' ) ) {
    gutenberg_ramp_load_gutenberg( false );
}
