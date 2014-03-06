<?php

/* =============================================================================
   SHORTCODE: Spacer
   ========================================================================== */

function vc_shortcode_spacer( $atts, $content=null ) {
	extract( shortcode_atts( array(
		'height' => '',
		'class' => ''
	),$atts));
	return '<div class="spacer'.
		( $class!=='' ? ' '.$class : '' ).'"'.
		( $height!=='' ? ' style="height:'.$height.';margin-bottom:0;"' : '' ).
		'></div>';
}
add_shortcode( 'spacer', 'vc_shortcode_spacer' );



?>