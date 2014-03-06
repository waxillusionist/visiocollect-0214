<?php

/* =============================================================================
   SHORTCODE: relational Height-Fix
   ========================================================================== */

function vc_shortcode_heightfix( $atts, $content=null ) {
	extract( shortcode_atts( array(
		'tag' => 'p',
		'rel' => '',
		'class' => ''
	), $atts ) );
	$content = trim(do_shortcode($content));
	$html = '<'.$tag.' data-heightfix="rel'.
		( $rel!=='' ? '-'.$rel : '' ).'"'.
		( $class!=='' ? ' class="'.$class.'"' : '' ).
		'>'.$content.'</'.$tag.'>';
	return $html;
}
add_shortcode( 'heightfix', 'vc_shortcode_heightfix' );



?>
