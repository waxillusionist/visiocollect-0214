<?php

/* =============================================================================
   If child of OnePageScroller, redirect to parent page
   ========================================================================== */

function vc_onepagescroller_redirect() {
	if( !is_admin() ) {
		$post_obj = get_queried_object();
		if( $post_obj && isset($post_obj->post_parent) && $post_obj->post_parent>0 ) {
			$post_parent_obj = get_post($post_obj->post_parent);
			if( $post_parent_obj->post_type=='page' && get_page_template_slug($post_parent_obj->ID)=='custompage-onepagescroller.php' )
				wp_redirect( get_permalink($post_parent_obj->ID).'#'.$post_obj->post_name );
		}
	}
}
add_action( 'wp', 'vc_onepagescroller_redirect' );



?>