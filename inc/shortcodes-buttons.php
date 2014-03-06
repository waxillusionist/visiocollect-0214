<?php

/* =============================================================================
   SHORTCODE: Button
   ========================================================================== */

function wpbs_shortcode_button( $atts, $content=null ) {
	extract( shortcode_atts( array(
		'type' => 'button',
		'style' => 'primary',
		'size' => '',
		'block' => 'false',
		'disabled' => 'false',
		'active' => 'false',
		'icon' => '',
		'url' => '',
		'class' => ''
	), $atts ) );
	$active = $active==='true' ? true : false;
	$content = trim($content);
	if( in_array( $type, array('submit','input') ) ) {
		$html_alpha = '<input type="'.( $type=='submit' ? 'submit' : 'input' ).'" class="btn';
		$html_omega = '" value="'.esc_attr(strip_tags($content)).'">';
	}
	else {
		$block = $block==='true' ? true : false;
		$disabled = $disabled==='true' ? true : false;
		$content = substr( wpautop('<p>'.wptexturize($content).'</p>'), 3, -5 );
		if( $icon!=='' )
			$content = '<span class="glyphicon glyphicon-'.$icon.'"></span>'.( $content!='' ? ' '.$content : '' );
		if( $url!=='' ) {
			$html_alpha = '<a href="'.$url.'" role="button" class="btn'.
				( $disabled ? ' disabled' : '' );
			$html_omega = '">'.$content.'</a>';
		}
		else {
			$html_alpha = '<button type="button"'.
				( $disabled ? ' disabled="disabled"' : '' ).
				' class="btn';
			$html_omega = '">'.$content.'</button>';
		}
	}
	$html = $html_alpha.
		( $style!=='' ? ' btn-'.$style : '' ).
		( $size!=='' ? ' btn-'.$size : '' ).
		( $block ? ' btn-block' : '' ).
		( $active ? ' active' : '' ).
		( $class!=='' ? ' '.$class : '' ).
		$html_omega;
	return $html;
}
add_shortcode( 'button', 'wpbs_shortcode_button' );



/* =============================================================================
   SHORTCODE: Buttongroup
   ========================================================================== */

function wpbs_shortcode_btngroup( $atts, $content=null ) {
	extract( shortcode_atts( array(
		'size' => '',
		'vertical' => 'false',
		'justified' => 'false',
		'class' => ''
	), $atts ) );
	$content = preg_replace('/[\n\r]+/','',do_shortcode(trim($content)));
	$vertical = $vertical==='true' ? true : false;
	$justified = $justified==='true' ? true : false;
	$html = '<div class="btn-group'.
		( $size!=='' ? ' btn-group-'.$size : '' ).
		( $vertical ? ' btn-group-vertical' : '' ).
		( $vertical ? ' btn-group-justified' : '' ).
		( $class!=='' ? ' '.$class : '' ).
		'">'.
		$content.
		'</div>';
	return $html;
}
add_shortcode( 'btngroup', 'wpbs_shortcode_btngroup' );

for( $i=0; $i<10; $i++ )
	add_shortcode( 'btngroup'.$i, 'wpbs_shortcode_btngroup' );



/* =============================================================================
   SHORTCODE: Toolbar
   ========================================================================== */

function wpbs_shortcode_toolbar( $atts, $content=null ) {
	extract( shortcode_atts( array(
		'class' => ''
	), $atts ) );
	$content = preg_replace('/[\n\r]+/','',do_shortcode(trim($content)));
	$html = '<div class="btn-toolbar'.
		( $class!=='' ? ' '.$class : '' ).
		'" role="toolbar">'.
		$content.
		'</div>';
	return $html;
}
add_shortcode( 'toolbar', 'wpbs_shortcode_toolbar' );



?>