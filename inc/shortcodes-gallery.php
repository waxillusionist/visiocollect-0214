<?php

/* =============================================================================
   Gallery Shortcode Handler
   ========================================================================== */

function vc_gallery_shortcode( $output, $attr ) {

    // post and instance
    $post = get_post();
    static $instance = 0;
    $instance++;

    // attachment IDs to show
    if( !empty($attr['ids']) ) {
        if( empty($attr['orderby']) )
            $attr['orderby'] = 'post__in';
        $attr['include'] = $attr['ids'];
    }

    // sanitize order attribute
    if( isset($attr['orderby']) ) {
        $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
        if( !$attr['orderby'] )
            unset( $attr['orderby'] );
    }

    // default attributes
    extract(shortcode_atts(array(
        'order'      => 'ASC',
        'orderby'    => 'menu_order ID',
        'id'         => $post->ID,
        'link'       => 'file',
        'include'    => '',
        'exclude'    => '',
        'size'       => 'thumbnail',
        'columns'    => '4',
        'columns_xs' => '',
        'columns_sm' => '',
        'columns_md' => '',
        'columns_lg' => '',
        'style'      => 'grid',
        'lightbox'   => 'true',
        'indicators' => 'false',
        'controls'   => 'true',
        'autostart'  => 'true',
        'loop'       => 'true',
        'interval'   => '0',
        'pause'      => 'false',
        'class'      => ''
    ),$attr));
    $id = intval($id);
    if( strtolower($order) == 'rand' )
        $orderby = 'none';

    // get attachments
    if( !empty($include) ) {
        $_attachments = get_posts(array(
            'include'        => $include,
            'post_status'    => 'inherit',
            'post_type'      => 'attachment',
            'post_mime_type' => 'image',
            'order'          => $order,
            'orderby'        => $orderby
        ));
        $attachments = array();
        foreach( $_attachments as $key => $val )
            $attachments[$val->ID] = $_attachments[$key];
    }
    elseif( !empty($exclude) )
        $attachments = get_children(array(
            'post_parent'    => $id,
            'exclude'        => $exclude,
            'post_status'    => 'inherit',
            'post_type'      => 'attachment',
            'post_mime_type' => 'image',
            'order'          => $order,
            'orderby'        => $orderby
        ));
    else
        $attachments = get_children(array(
            'post_parent'    => $id,
            'post_status'    => 'inherit',
            'post_type'      => 'attachment',
            'post_mime_type' => 'image',
            'order'          => $order,
            'orderby'        => $orderby
        ));
    if( empty($attachments) )
        return '';

    // if feed, show attachment links
    if( is_feed() ) {
        $output = "\n";
        foreach( $attachments as $att_id => $attachment )
            $output .= wp_get_attachment_link($att_id, 'large', true) . "\n";
        return $output;
    }

    // with lightbox funcionality?
    $lightbox = $lightbox==='true' ? true : false;

    // columns options
    $columns = intval($columns);
    $_columns['xs']['count'] = min(12,max(0, $columns_xs==='' ? ( $columns>1 ? floor($columns/2) : $columns ) : intval($columns_xs) ));
    $_columns['sm']['count'] = min(12,max(0, $columns_sm==='' ? round($columns*.75) : intval($columns_sm) ));
    $_columns['md']['count'] = min(12,max(0, $columns_md==='' ? $columns : intval($columns_md) ));
    $_columns['lg']['count'] = min(12,max(0, $columns_lg==='' ? $columns : intval($columns_lg) ));
    foreach( $_columns as $ds => $col )
        $_columns[$ds]['width'] = 12/$col['count'];

    // carousel options
    $indicators = $indicators==='true' ? true : false;
    $controls = $controls==='true' ? true : false;
    $autostart = $autostart==='true' ? true : false;
    $loop = $loop==='true' ? true : false;
    $interval = intval($interval);

    // set numeric array index instead of IDs
    $attachments = array_values($attachments);

    // gallery alpha
    $output = '<div id="gallery-'.$instance.'" class="gallery'.
        ' galleryid-'.$id.
        ' gallery-style-'.$style.
        ' gallery-size-'.$size.
        ( $link=='file' && $lightbox ? ' gallery-lightbox' : '' ).
        ( $class!=='' ? ' '.$class : '' ).
        '">';

    // gallery styles
    switch( $style ) {

        // boostrap carousel style
        case 'carousel':
            $output_indicators = '';
            $output_slides = '';
            $carousel_id = 'gallery-carousel-'.$instance;
            foreach( $attachments as $i => $attachment ) {
                $id = $attachment->ID;
                $title = trim($attachment->post_title);
                $_img = wp_get_attachment_image_src( $id, $size );
                $caption = trim($attachment->post_excerpt);
                $has_caption = !empty($caption) ? true : false;
                if( $indicators )
                    $output_indicators .= '<li data-target="#'.$carousel_id.'" data-slide-to="'.$i.'"'.( $i==0 ? ' class="active"' : '' ).'></li>';
                $output_slides .= '<div class="item'.( $i==0 ? ' active' : '' ).'">'.
                    '<div><img src="'.$_img[0].'" width="'.$_img[1].'" height="'.$_img[2].'" alt="'.esc_attr($title).'"></div>'.
                    ( $has_caption ?
                        '<div class="carousel-caption">'.
                        $caption.
                        '</div>'
                    :'').
                    '</div>';
            }
            $output .= '<div id="'.$carousel_id.'" class="carousel slide"'.
                ( $autostart ? ' data-ride="carousel"' : '' ).
                ( $interval>0 ? ' data-interval="'.$interval.'"' : '' ).
                ( !$loop ? ' data-wrap="false"' : '' ).
                ( $pause!='hover' ? ' data-pause="'.$pause.'"' : '' ).
                '>'.
                ( $indicators ?
                    '<ol class="carousel-indicators">'.
                        $output_indicators.
                    '</ol>'
                :'').
                '<div class="carousel-inner">'.
                    $output_slides.
                '</div>'.
                ( $controls ?
                    '<a class="left carousel-control" href="#'.$carousel_id.'" data-slide="prev">'.
                        '<span class="glyphicon glyphicon-chevron-left"></span>'.
                    '</a>'.
                    '<a class="right carousel-control" href="#'.$carousel_id.'" data-slide="next">'.
                        '<span class="glyphicon glyphicon-chevron-right"></span>'.
                    '</a>'
                :'').
                '</div>';
            break;

        // 'classic' - Rows and Cols
        case 'classic':
            $output .= '<div class="gallery-row row">';
            foreach( $attachments as $i => $attachment ) {
                $id = $attachment->ID;
                $title = trim($attachment->post_title);
                $caption = trim($attachment->post_excerpt);
                $has_caption = !empty($caption) ? true : false;
                if( $link=='file' ) {
                    $_img = wp_get_attachment_image_src( $id, $size );
                    $_img_link = wp_get_attachment_image_src( $id, 'full' );
                    $img = '<a href="'.$_img_link[0].'"'.
                        ( $lightbox ?
                            ' data-toggle="lightbox"'.
                            ' data-gallery="g'.$instance.'"'.
                            ' data-parent="#gallery-'.$instance.'"'.
                            ' data-title="'.esc_attr($title).'"'.
                            ( $has_caption ? ' data-footer="'.esc_attr(wptexturize($caption)).'"' : '' )
                        :'').
                        '>'.
                        '<img src="'.$_img[0].'" width="'.$_img[1].'" height="'.$_img[2].'" alt="'.esc_attr($title).'">'.
                        '</a>';
                }
                elseif( $link=='none' )
                    $img = wp_get_attachment_image( $id, $size, false );
                else
                    $img = wp_get_attachment_link( $id, $size, true, false );
                $output .= '<div class="gallery-col col';
                $col_clear = '';
                foreach( $_columns as $ds => $col ) {
                    $output .= ' col-'.$ds.'-'.$col['width'];
                    $col_clear .= ' '.( ($i+1)%$col['count']==0 ? 'visible' : 'hidden' ).'-'.$ds;
                }
                $output .= '">'.
                        '<figure class="gallery-item">'.
                            '<div class="gallery-icon">'.$img.'</div>'.
                            ( $has_caption ?
                                '<figcaption class="gallery-caption">'.
                                    '<div class="inner">'.wptexturize($caption).'</div>'.
                                '</figcaption>'
                            :'').
                        '</figure>'.
                    '</div>'.
                    '<div class="clearfix'.$col_clear.'"></div>';
            }
            $output .= '</div>';
            break;

        // all images in one container for js handling
        default:
            $size = 'grid_gallery';
            foreach( $attachments as $i => $attachment ) {
                $id = $attachment->ID;
                $title = trim($attachment->post_title);
                $caption = trim($attachment->post_excerpt);
                $has_caption = !empty($caption) ? true : false;
                if( $link=='file' ) {
                    $_img = wp_get_attachment_image_src( $id, $size );
                    $_img_link = wp_get_attachment_image_src( $id, 'full' );
                    $img = '<a href="'.$_img_link[0].'"'.
                        ( $lightbox ?
                            ' data-toggle="lightbox"'.
                            ' data-gallery="g'.$instance.'"'.
                            ' data-parent="#gallery-'.$instance.'"'.
                            ' data-title="'.esc_attr($title).'"'.
                            ( $has_caption ? ' data-footer="'.esc_attr(wptexturize($caption)).'"' : '' )
                        :'').
                        '>'.
                        '<img src="'.$_img[0].'" width="'.$_img[1].'" height="'.$_img[2].'" alt="'.esc_attr($title).'">'.
                        '</a>';
                }
                elseif( $link=='none' )
                    $img = wp_get_attachment_image( $id, $size, false );
                else
                    $img = wp_get_attachment_link( $id, $size, true, false );
                $output .= '<figure class="gallery-item">'.
                            '<div class="gallery-icon">'.$img.'</div>'.
                            ( $has_caption ?
                                '<figcaption class="gallery-caption">'.
                                    '<div class="inner">'.wptexturize($caption).'</div>'.
                                '</figcaption>'
                            :'').
                        '</figure>';
            }
            break;
    }

    // gallery omega
    $output .= '</div>';

    // output gallery
    return $output;

}

// register gallery
add_filter( 'post_gallery', 'vc_gallery_shortcode', 10, 2 );



?>
