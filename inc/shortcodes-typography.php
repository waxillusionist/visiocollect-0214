<?php

/* =============================================================================
   SHORTCODE: Quotes
   ========================================================================== */

function wpbs_shortcode_quote( $atts, $content=null ) {
	extract( shortcode_atts( array(
		'source' => '',
		'url' => '',
		'footer' => '%s',
		'align' => 'left',
		'class' => ''
	), $atts ) );
	$content = wpautop(trim(do_shortcode($content)));
	$html = '<blockquote class="'.
		( $class!=='' ? ' '.$class : '' ).
		( $align=='right' ? ' blockquote-reverse' : '' ).
		'">'.
		$content.
		( $source!=='' ?
			'<footer>'.
				sprintf($footer,
					'<cite>'.
					( $url!=='' ?
						'<a href="'.$url.'" title="'.esc_attr($source).'">'.
						$source.
						'</a>'
					: $source ).
					'</cite>'
				).
			'</footer>'
		:'').
		'</blockquote>';
	return $html;
}
add_shortcode( 'quote', 'wpbs_shortcode_quote' );



/* =============================================================================
   SHORTCODE: Lead paragraph
   ========================================================================== */

function wpbs_shortcode_lead( $atts, $content=null ) {
	extract( shortcode_atts( array(
		'class' => ''
	), $atts ) );
	$content = trim(do_shortcode($content));
	$html_alpha = '<p class="lead'.
		( $class!=='' ? ' '.$class : '' ).
		'">';
	$html_omega = '</p>';
	$content = preg_replace( '/(\n\r?){2,}/', $html_omega.$html_alpha, $content );
	$html = $html_alpha.$content.$html_omega;
	return $html;
}
add_shortcode( 'lead', 'wpbs_shortcode_lead' );



?>
