<?php

/* =============================================================================
   SHORTCODE: Background Image Containers
   ========================================================================== */

function vc_shortcode_bgimage( $atts, $content=null ) {
    extract( shortcode_atts( array(
        'width' => 'full',
        'height' => '',
        'id' => '',
        'file' => '',
        'color' => '',
        'position' => '',
        'size' => '',
        'attachment' => '',
        'repeat' => '',
        'parallax' => false,
        'multiplier' => '.25',
        'class' => ''
    ), $atts ) );
    $parallax = $parallax==='true';
    if( $id!=='' ) {
        $img = wp_get_attachment_image_src( intval($id), 'full' );
        $file = $img[0];
    }
    $content = wpautop(trim(do_shortcode($content)));
    $fullwidth_class = strpos($class,'full-width')!==false ? true : false;
    $fullwidth = $fullwidth_class || $width=='full' ? true : false;
    $width = $fullwidth ? '100%' : $width;
    $html_alpha = '<div class="bg-image'.
        ( $parallax ? ' parallax' : '' ).
        ( $class!=='' ? ' '.$class : '' ).
        ( $fullwidth && !$fullwidth_class ? ' full-width' : '' ).
        '"';
    $html_omega = '><div class="inner">'.$content.'</div></div>'.
        ( $fullwidth ?
            '<div class="spacer '.
            ($parallax?'parallax':'bgimage').
            '-spacer" '.
            ( $height!=='' ? ' style="height:'.$height.'"' : '' ).
            '></div>'
        :'');
    $html = $html_alpha.
        ' style="'.
        ( $width!=='' ? 'width:'.$width.';' : '' ).
        ( $height!=='' ? 'min-height:'.$height.';' : '' ).
        ( $file!=='' ? 'background-image:url(\''.$file.'\');' : '' ).
        ( $color!=='' ? 'background-color:'.$color.';' : '' ).
        ( $position!=='' ? 'background-position:'.$position.';' : '' ).
        ( $size!=='' ? 'background-size:'.$size.';' : '' ).
        ( $attachment!=='' ? 'background-attachment:'.$attachment.';' : '' ).
        ( $repeat!=='' ? 'background-repeat:'.$repeat.';' : '' ).
        '"'.
        ( $parallax ?
            ( $multiplier!=='' ? ' data-stellar-background-ratio="'.$multiplier.'"' : '' )
        :'').
        $html_omega;
    return $html;
}
add_shortcode( 'bgimage', 'vc_shortcode_bgimage' );



/* =============================================================================
   SHORTCODE: Parallax Containers
   ========================================================================== */

function vc_shortcode_parallax( $atts, $content=null ) {
    $atts['parallax'] = 'true';
    return vc_shortcode_bgimage( $atts, $content );
}
add_shortcode( 'parallax', 'vc_shortcode_parallax' );



?>
