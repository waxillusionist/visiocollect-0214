<?php

/* =============================================================================
   SHORTCODE: Blog
   ========================================================================== */

function vc_shortcode_blog( $atts, $content=null ) {
    extract( shortcode_atts( array(
    ),$atts));
    $items = get_posts(array(
        'numberposts'   => 3
    ));
    $html = '<div class="row blog-overview">';
    foreach( $items as $i => $post ) {
        setup_postdata($post);
        $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );
        $html .= ($i<2?'<div class="col col-sm-6">':'').
            '<div class="post-preview"'.($thumb?' style="background-image:url('.$thumb[0].')"':'').'>'.
                '<div class="entry-link"><a href="'.get_permalink($post->ID).'" rel="bookmark"><span class="glyphicon glyphicon-link"></span></a></div>'.
                '<div class="entry-date published" datetime="'.get_post_time('c', false, $post, true).'">'.get_post_time('j. M \'y', false, $post, true).'</div>'.
                '<div class="preview-wrap">'.
                    '<h3 class="entry-title"><a href="'.get_permalink($post->ID).'" rel="bookmark">'.get_the_title($post->ID).'</a></h3>'.
                    '<div class="entry-excerpt">'.get_the_excerpt().'</div>'.
                '</div>'.
            '</div>'.
            ($i!=1?'</div>':'');
    }
    $html .= '</div>';
    return $html;
}
add_shortcode( 'blog', 'vc_shortcode_blog' );



?>
