<?php

/* =============================================================================
   Prev/Next Posts Navigation
   ========================================================================== */

function vc_content_nav() {
	global $wp_query;
	if( $wp_query->max_num_pages > 1 ) {
		$prev_link = get_previous_posts_link();
		$next_link = get_next_posts_link();
		$prev_url = $prev_link ? explode('"',$prev_link)[1] : false;
		$next_url = $next_link ? explode('"',$next_link)[1] : false;
		$prev_tag = $prev_url ? 'a' : 'span';
		$next_tag = $next_url ? 'a' : 'span';
		echo '<div class="pagination-links" role="navigation">'.
			'<'.$next_tag.( $next_url ? ' href="'.$next_url.'"' : '' ).' class="pagination-link next" title="&Auml;ltere Beitr&auml;ge"><span class="glyphicon glyphicon-chevron-left"></span></'.$next_tag.'> '.
			'<'.$prev_tag.( $prev_url ? ' href="'.$prev_url.'"' : '' ).' class="pagination-link prev" title="Neuere Beitr&auml;ge"><span class="glyphicon glyphicon-chevron-right"></span></'.$prev_tag.'>'.
			'</div>';
	}
}



/* =============================================================================
   Title
   ========================================================================== */

function vc_wp_title( $title, $sep ) {
	global $paged, $page;
	if( is_feed() )
		return $title;
	$site_title = get_bloginfo( 'name' );
	$site_description = get_bloginfo( 'description', 'display' );
	if( is_home() || is_front_page() )
		$title = $site_description ? $site_title.' '.$sep.' '.$site_description : $site_title;
	elseif( is_search() )
		$title = sprintf( 'Suche nach &bdquo;%s&rdquo;', get_search_query() ).' '.$sep.' '.$site_title;
	else
		$title .= $site_title;
	if( $paged >= 2 || $page >= 2 )
		$title .= ' '.$sep.' '.sprintf( 'Seite %s', max($paged,$page) );
	return $title;
}
add_filter( 'wp_title', 'vc_wp_title', 10, 2 );



?>
