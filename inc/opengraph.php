<?php

/* =============================================================================
   Filter for wp_head
   ========================================================================== */

function vc_opengraph() {

	// no ogp on 404 pages
	if( is_404() )
		return;
	
	// default data
	$ogp_data['url']          = home_url( '/' );
	$ogp_data['site']         = trim( get_bloginfo( 'name', 'display' ) );
	$ogp_data['title']        = $ogp_data['site'];
	$ogp_data['description']  = trim( get_bloginfo( 'description', 'display' ) );
	$ogp_data['locale']       = preg_replace( '/-/', '_', get_bloginfo( 'language', 'display' ) );
	$ogp_data['image']        = $ogp_data['url'].'logo-250x250.png';
	$ogp_data['type']         = 'website';
	$ogp_data['updated_time'] = false;
	
	// default single post/page
	if( is_single() || is_page() ) {
		$post = get_queried_object();
		$post_title = apply_filters( 'the_title', $post->post_title );
		$post_descr = apply_filters( 'the_content', $post->post_excerpt ? $post->post_excerpt : $post->post_content );
		$post_img = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'ogp' );
		$ogp_data['site'] .= ' &mdash; '.$ogp_data['description'];
		$ogp_data['title'] = trim( strip_tags( $post_title ) );
		$ogp_data['description'] = trim( strip_tags( $post_descr ) );
		$ogp_data['url'] = get_permalink( $post->ID );
		$ogp_data['image'] = $post_img[0];
		if( is_single() )
			$ogp_data['updated_time'] = get_the_date( 'Y-m-d H:i:s', $post->ID );
	}

	// process text values
	$ogp_textvalues = array(
		&$ogp_data['site'],
		&$ogp_data['title'],
		&$ogp_data['description']
	);
	foreach( $ogp_textvalues as $i => $v ) {
		// replace multiple whitespace with single space
		$ogp_textvalues[$i] = preg_replace( '/\s+/', ' ', $ogp_textvalues[$i] );
		// shorten to 255 characters
		if( strlen( $ogp_textvalues[$i] ) > 255 )
			$ogp_textvalues[$i] = substr( $ogp_textvalues[$i], 0, 254 ) . '…';
		// escape to use as attributes
		$ogp_textvalues[$i] = esc_attr($ogp_textvalues[$i]);
	}

	// build html meta tags
	$output = array();
	foreach( $ogp_data as $k => $v ) {
		if( $v!==false )
			array_push( $output, '<meta property="og:'.$k.'" content="'.$v.'">' );
	}
	
	// output
	echo implode( $output, "\n" )."\n";
}

// hook into wp_head
add_action( 'wp_head', 'vc_opengraph' );



?>