<?php

/* =============================================================================
   Retrieve custom post thumbnail src and size
   ========================================================================== */

function get_mpt_src( $id, $size='', $post_obj=null ) {
	if( !class_exists('MultiPostThumbnails') )
		return null;
	if( $post_obj===null ) {
		global $post;
		$post_obj = $post;
	}
	$size = empty($size) ? $id : $size;
	$post_id = $post_obj->ID;
	$post_type = $post_obj->post_type;
	$img_id = MultiPostThumbnails::get_post_thumbnail_id( $post_type, $id, $post_id );
	$img_src = wp_get_attachment_image_src( $img_id, $size );
	return is_array($img_src) ? $img_src : false;
}



/* =============================================================================
   Check for multiple post thumbnails support
   ========================================================================== */

if( !class_exists('MultiPostThumbnails')) {

	function vc_adminerror_mptplugin() {
		echo '<div id="message" class="error"><p><strong>'.
			'You have to install and activate the plugin <a href="" target="_blank">Multiple Post Thumbnails</a> to use this theme.'.
			'</strong></p></div>';
	}
	add_action( 'admin_notices', 'vc_adminerror_mptplugin' );

}
else {

	/* =============================================================================
	   Multiple post thumbnail definitions
	   ========================================================================== */

	$types = array( 'post', 'page' );
	foreach($types as $type) {
		new MultiPostThumbnails(array(
			'label' => 'Parallax Bild',
			'id' => 'parallax',
			'post_type' => $type
		));
	}
	add_image_size('parallax', 1600, 0, false );


}



?>
