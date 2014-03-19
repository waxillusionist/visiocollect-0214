<?php

/* =============================================================================
   Content width for media embeds
   ========================================================================== */

global $content_width;
// default bootstrap container width: 1140px
$content_width = 1140;



/* =============================================================================
   Auto-paragraph filter after shortcodes
   ========================================================================== */

remove_filter( 'the_content', 'wpautop' );
add_filter( 'the_content', 'wpautop' , 12 );



/* =============================================================================
   Theme Setup
   ========================================================================== */

function vc_setup() {

    // make theme translation ready
    load_theme_textdomain( THEME_TEXTDOMAIN, THEME_URI.'languages' );

    // add visual editor styles
    add_editor_style('assets/css/editor-styles.min.css');

    // add RSS feed links to <head> for posts and comments
    //add_theme_support( 'automatic-feed-links' );

    // add support for post thumbnails and custom image sizes
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 380, 0, false );
    add_image_size( 'thumb_ratio', 380, 0, false );
    add_image_size( 'fullscreen', 1600, 0, false );


    // register menus
    register_nav_menus(array(
        'topbar-left' => __('TopBar Left Menu',THEME_TEXTDOMAIN),
        'topbar-right' => __('TopBar Right Menu',THEME_TEXTDOMAIN)
    ));

}
add_action( 'after_setup_theme', 'vc_setup' );



/* =============================================================================
   Widgets / Sidebars
   ========================================================================== */

function vc_widgets_init() {

    register_sidebar( array(
        'name'          => __('Main Sidebar',THEME_TEXTDOMAIN),
        'id'            => 'main-sidebar',
        'description'   => __('The main Sidebar of this theme.',THEME_TEXTDOMAIN),
        'class'         => '',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>'
    ) );

    register_sidebar( array(
        'name'          => __('Footer Sidebar',THEME_TEXTDOMAIN),
        'id'            => 'footer-sidebar',
        'description'   => __('This sidebar is shown in theme footer.',THEME_TEXTDOMAIN),
        'class'         => '',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>'
    ) );

}
add_action( 'widgets_init', 'vc_widgets_init' );



/* =============================================================================
   Excerpt Properties
   ========================================================================== */

function vc_excerpt_word_count( $length ) {
    return 40;
}
add_filter( 'excerpt_length', 'vc_excerpt_word_count', 999 );

function vc_excerpt_more_text( $more ) {
    return '&hellip;';
}
add_filter( 'excerpt_more', 'vc_excerpt_more_text' );



?>
