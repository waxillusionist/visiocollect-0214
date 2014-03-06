<?php

/* =============================================================================
   SHORTCODE: Bootstrap Grid System - Rows
   ========================================================================== */

function wpbs_shortcode_row( $atts, $content=null ) {
	extract( shortcode_atts( array(
		'class' => ''
	), $atts ) );
	$content = do_shortcode($content);
	$html = '<div class="row'.
		( $class!=='' ? ' '.$class : '' ).
		'">'.
		$content.
		'</div>';
	return $html;
}
add_shortcode( 'row', 'wpbs_shortcode_row' );

for( $i=0; $i<10; $i++ )
	add_shortcode( 'row'.$i, 'wpbs_shortcode_row' );



/* =============================================================================
   SHORTCODE: Bootstrap Grid System - Cols
   ========================================================================== */

function wpbs_shortcode_col( $atts, $content=null ) {
	extract( shortcode_atts( array(
		'xs' => '0',
		'sm' => '0',
		'md' => '0',
		'lg' => '0',
		'xs_offset' => '0',
		'sm_offset' => '0',
		'md_offset' => '0',
		'lg_offset' => '0',
		'xs_push' => '0',
		'sm_push' => '0',
		'md_push' => '0',
		'lg_push' => '0',
		'xs_pull' => '0',
		'sm_pull' => '0',
		'md_pull' => '0',
		'lg_pull' => '0',
		'class' => ''
	), $atts ) );
	$content = wpautop(trim(do_shortcode($content)));
	$html = '<div class="col'.
		( $xs!='0' ? ' col-xs-'.$xs : '' ).
		( $sm!='0' ? ' col-sm-'.$sm : '' ).
		( $md!='0' ? ' col-md-'.$md : '' ).
		( $lg!='0' ? ' col-lg-'.$lg : '' ).
		( $xs_offset!='0' ? ' col-xs-offset-'.$xs_offset : '' ).
		( $sm_offset!='0' ? ' col-sm-offset-'.$sm_offset : '' ).
		( $md_offset!='0' ? ' col-md-offset-'.$md_offset : '' ).
		( $lg_offset!='0' ? ' col-lg-offset-'.$lg_offset : '' ).
		( $xs_push!='0' ? ' col-xs-push-'.$xs_push : '' ).
		( $sm_push!='0' ? ' col-sm-push-'.$sm_push : '' ).
		( $md_push!='0' ? ' col-md-push-'.$md_push : '' ).
		( $lg_push!='0' ? ' col-lg-push-'.$lg_push : '' ).
		( $xs_pull!='0' ? ' col-xs-pull-'.$xs_pull : '' ).
		( $sm_pull!='0' ? ' col-sm-pull-'.$sm_pull : '' ).
		( $md_pull!='0' ? ' col-md-pull-'.$md_pull : '' ).
		( $lg_pull!='0' ? ' col-lg-pull-'.$lg_pull : '' ).
		( $class!=='' ? ' '.$class : '' ).'">'.
		$content.
		'</div>';
	return $html;
}
add_shortcode( 'col', 'wpbs_shortcode_col' );

for( $i=0; $i<10; $i++ )
	add_shortcode( 'col'.$i, 'wpbs_shortcode_col' );



/* =============================================================================
   SHORTCODE: Clear
   ========================================================================== */

function wpbs_shortcode_clear( $atts, $content=null ) {
	extract( shortcode_atts( array(
		'visible' => '',
		'hidden' => ''
	), $atts ) );
	$visible = trim($visible);
	$hidden = trim($hidden);
	$visible = !empty($visible) ? explode(' ',$visible) : array();
	$hidden = !empty($hidden) ? explode(' ',$hidden) : array();
	$html = '<div class="row'.
		( !empty($visible) ? ' visible-'.implode(' visible-',$visible) : '' ).
		( !empty($hidden) ? ' hidden-'.implode(' hidden-',$hidden) : '' ).
		'">'.
		$content.
		'</div>';
	return $html;
}
add_shortcode( 'clear', 'wpbs_shortcode_clear' );



?>
