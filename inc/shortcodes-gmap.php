<?php

/* =============================================================================
   SHORTCODE: GoogleMaps
   ========================================================================== */

function vc_shortcode_gmap( $atts, $content=null ) {
	extract( shortcode_atts( array(
		'id' => '',
		'address' => '',
		'width' => '',
		'height' => '240px',
		'center' => '',
		'map_type_id' => '',
		'map_type_control' => '',
		'map_type_control_position' => '',
		'map_type_control_style' => '',
		'zoom' => '',
		'max_zoom' => '',
		'min_zoom' => '',
		'pan_control' => '',
		'pan_control_position' => '',
		'rotate_control' => '',
		'rotate_control_position' => '',
		'scale_control' => '',
		'scale_control_position' => '',
		'street_view_control' => '',
		'street_view_control_position' => '',
		'zoom_control' => '',
		'zoom_control_position' => '',
		'zoom_control_style' => '',
		'overview_map_control' => '',
		'overview_map_control_opened' => '',
		'disable_default_ui' => '',
		'disable_double_click_zoom' => '',
		'draggable' => '',
		'draggable_cursor' => '',
		'dragging_cursor' => '',
		'keyboard_shortcuts' => '',
		'no_clear' => '',
		'background_color' => '',
		'scrollwheel' => '',
		'heading' => '',
		'tilt' => '',
		'class' => ''
	), $atts ) );
	$fullwidth_class = strpos($class,'full-width')!==false ? true : false;
	$fullwidth = $fullwidth_class || $width=='full' ? true : false;
	$width = $fullwidth ? '100%' : $width;
	$html_alpha = 		( $fullwidth && !$fullwidth_class ? '<div class="full-width">' : '' ).
		'<div class="gmap'.
		( $class!=='' ? ' '.$class : '' ).
		'"';
	$html_omega = '></div>'.
		( $fullwidth ? '</div><div class="spacer" style="height:'.$height.'"></div>' : '' );;
	$html = $html_alpha.
		( $id!=='' ? ' id="'.$id.'"' : '' ).
		( $address!=='' ? ' data-address="'.$address.'"' : '' ).
		( $width!=='' ? ' data-width="'.$width.'"' : '' ).
		( $height!=='' ? ' data-height="'.$height.'"' : '' ).
		( $center!=='' ? ' data-center="'.$center.'"' : '' ).
		( $map_type_id!=='' ? ' data-map-type-id="'.$map_type_id.'"' : '' ).
		( $map_type_control!=='' ? ' data-map-type-control="'.$map_type_control.'"' : '' ).
		( $map_type_control_position!=='' ? ' data-map-type-control-position="'.$map_type_control_position.'"' : '' ).
		( $map_type_control_style!=='' ? ' data-map-type-control-style="'.$map_type_control_style.'"' : '' ).
		( $zoom!=='' ? ' data-zoom="'.$zoom.'"' : '' ).
		( $max_zoom!=='' ? ' data-max-zoom="'.$max_zoom.'"' : '' ).
		( $min_zoom!=='' ? ' data-min-zoom="'.$min_zoom.'"' : '' ).
		( $pan_control!=='' ? ' data-pan-control="'.$pan_control.'"' : '' ).
		( $pan_control_position!=='' ? ' data-pan-control-position="'.$pan_control_position.'"' : '' ).
		( $rotate_control!=='' ? ' data-rotate-control="'.$rotate_control.'"' : '' ).
		( $rotate_control_position!=='' ? ' data-rotate-control-position="'.$rotate_control_position.'"' : '' ).
		( $scale_control!=='' ? ' data-scale-control="'.$scale_control.'"' : '' ).
		( $scale_control_position!=='' ? ' data-scale-control-position="'.$scale_control_position.'"' : '' ).
		( $street_view_control!=='' ? ' data-street-view-control="'.$street_view_control.'"' : '' ).
		( $street_view_control_position!=='' ? ' data-street-view-control-position="'.$street_view_control_position.'"' : '' ).
		( $zoom_control!=='' ? ' data-zoom-control="'.$zoom_control.'"' : '' ).
		( $zoom_control_position!=='' ? ' data-zoom-control-position="'.$zoom_control_position.'"' : '' ).
		( $zoom_control_style!=='' ? ' data-zoom-control-style="'.$zoom_control_style.'"' : '' ).
		( $overview_map_control!=='' ? ' data-overview-map-control="'.$overview_map_control.'"' : '' ).
		( $overview_map_control_opened!=='' ? ' data-overview-map-control-opened="'.$overview_map_control_opened.'"' : '' ).
		( $disable_default_ui!=='' ? ' data-disable-default-u-i="'.$disable_default_ui.'"' : '' ).
		( $disable_double_click_zoom!=='' ? ' data-disable-double-click-zoom="'.$disable_double_click_zoom.'"' : '' ).
		( $draggable!=='' ? ' data-draggable="'.$draggable.'"' : '' ).
		( $draggable_cursor!=='' ? ' data-draggable-cursor="'.$draggable_cursor.'"' : '' ).
		( $dragging_cursor!=='' ? ' data-dragging-cursor="'.$dragging_cursor.'"' : '' ).
		( $keyboard_shortcuts!=='' ? ' data-keyboard-shortcuts="'.$keyboard_shortcuts.'"' : '' ).
		( $no_clear!=='' ? ' data-no-clear="'.$no_clear.'"' : '' ).
		( $background_color!=='' ? ' data-background-color="'.$background_color.'"' : '' ).
		( $scrollwheel!=='' ? ' data-scrollwheel="'.$scrollwheel.'"' : '' ).
		( $heading!=='' ? ' data-heading="'.$heading.'"' : '' ).
		( $tilt!=='' ? ' data-tilt="'.$tilt.'"' : '' ).
		$html_omega;
	return $html;
}
add_shortcode( 'gmap', 'vc_shortcode_gmap' );



?>