<?php

/* =============================================================================
   SHORTCODE: Icons
   ========================================================================== */

function wpbs_shortcode_icon( $atts, $content=null ) {
    extract( shortcode_atts( array(
        'id' => '',
        'class' => ''
    ), $atts ) );
    $html = '<span class="glyphicon glyphicon-'.$id.
        ( $class!=='' ? ' '.$class : '' ).
        '"></span>';
    return $html;
}
add_shortcode( 'icon', 'wpbs_shortcode_icon' );



?>
