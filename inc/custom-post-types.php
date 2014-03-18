<?php

/* =============================================================================
   Custom post types
   ========================================================================== */

function vc_custom_posts() {

    register_post_type( 'spektrum',
        array(
            'labels' => array(
                'name' => 'Spektrum',
                'singular_name' => __( 'Projekt' )
            ),
            'public' => true,
            'has_archive' => true,
            'menu_position' => 20,
            'capability_type' => 'post',
            'supports' => array(
                'title',
                'editor',
                'thumbnail',
                'excerpt',
                'custom-fields',
                'revisions',
                'page-attributes'
            )
        )
    );
    register_taxonomy( 'spektrum_category', 'spektrum', array(
        'hierarchical' => true
    ));
    register_taxonomy_for_object_type( 'spektrum_category', 'spektrum' );

}
add_action( 'init', 'vc_custom_posts' );



?>
