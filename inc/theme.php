<?php

/* =============================================================================
   Prev/Next Posts Navigation
   ========================================================================== */

function vc_content_nav() {
	global $wp_query;
	if( $wp_query->max_num_pages > 1 ) {
		echo '<div class="wp-navigation" role="navigation"><div class="wp-nav-next">';
		previous_posts_link( __( 'Next Page', THEME_TEXTDOMAIN ) );
		echo '</div><div class="wp-nav-previous">';
		next_posts_link( __( 'Previous page', THEME_TEXTDOMAIN ) );
		echo '</div></div>';
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
