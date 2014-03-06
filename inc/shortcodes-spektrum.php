<?php

/* =============================================================================
   SHORTCODE: Spektrum
   ========================================================================== */

function vc_shortcode_spektrum( $atts, $content=null ) {
	extract( shortcode_atts( array(
	),$atts));
	$items = get_posts(array(
		'posts_per_page'   => -1,
		'offset'           => 0,
		'orderby'          => 'post_date',
		'order'            => 'DESC',
		'post_type'        => 'spektrum',
		'post_status'      => 'publish',
		'suppress_filters' => true
	));
	$cats = get_categories(array(
		'type'                     => 'spektrum',
		'orderby'                  => 'name',
		'order'                    => 'ASC',
		'hide_empty'               => true,
		'hierarchical'             => false,
		'taxonomy'                 => 'spektrum_category',
		'pad_counts'               => true
	));
	// var_dump($items,$cats);
	$html = '<ul class="mixitup-controls">'.
		'<li class="filter" data-filter="all"><a href="#">Alle</a></li>';
	foreach( $cats as $i => $cat )
		$html .= '<li class="filter" data-filter=".cat'.$cat->term_id.'"><a href="#">'.$cat->name.'</a></li>';
	$html .= '</ul><div class="mixitup">';
	foreach( $items as $i => $item ) {
		$cat_ids = wp_get_object_terms( array($item->ID), 'spektrum_category', array('fields'=>'ids') );
		$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($item->ID), 'thumbnail' );
		$html .= '<div class="mix cat'.join(' cat',$cat_ids).'" data-sort="'.$i.'" data-link="'.get_permalink($item->ID).'">'.
				'<figure>'.
					'<div class="img"><img src="'.$thumb[0].'" width="'.$thumb[1].'" height="'.$thumb[2].'" alt="'.esc_attr($item->post_title).'"></div>'.
					'<figcaption>'.
						'<a href="'.get_permalink($item->ID).'">'.
							'<span class="inner">'.
								'<span class="caption-title">'.$item->post_title.'</span>'.
								'<span class="caption-content">'.$item->post_excerpt.'</span>'.
							'</span>'.
						'</a>'.
					'</figcaption>'.
				'</figure>'.
			'</div>';
	}

	$html .= '<div class="gap"></div><div class="gap"></div>'.
		'</div>';
	return $html;
}
add_shortcode( 'spektrum', 'vc_shortcode_spektrum' );



?>
