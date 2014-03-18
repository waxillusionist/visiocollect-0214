<?php

/* =============================================================================
   Head cleanup   (http://wpengineer.com/1438/wordpress-header/)
   ========================================================================== */

function vc_head_cleanup() {
    remove_action('wp_head', 'feed_links', 2);
    remove_action('wp_head', 'feed_links_extra', 3);
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
}
add_action('init', 'vc_head_cleanup');



/* =============================================================================
   Canonical link tags only for singular posts/pages
   ========================================================================== */

function vc_rel_canonical() {
    global $wp_the_query;
    if (!is_singular())
        return;
    if (!$id = $wp_the_query->get_queried_object_id())
        return;
    $link = get_permalink($id);
    echo '<link rel="canonical" href="'.$link.'">'."\n";
}

function vc_fix_canonical() {
    if (!class_exists('WPSEO_Frontend')) {
        remove_action('wp_head', 'rel_canonical');
        add_action('wp_head', 'vc_rel_canonical');
    }
}
add_action('init', 'vc_fix_canonical');



/* =============================================================================
   Remove WP "recent comments" styles
   ========================================================================== */

function vc_remove_recent_comments_styles() {
    global $wp_widget_factory;
    remove_action( 'wp_head', array($wp_widget_factory->widgets["WP_Widget_Recent_Comments"],"recent_comments_style"));
}
add_action( 'widgets_init', 'vc_remove_recent_comments_styles' );



?>
