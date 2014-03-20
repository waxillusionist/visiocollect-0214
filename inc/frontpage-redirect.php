<?php

/* =============================================================================
   If child of frontpage, redirect to parent page
   ========================================================================== */

function vc_frontpage_redirect() {
    if( !is_admin() && !in_array($GLOBALS['pagenow'],array('wp-login.php','wp-register.php')) ) {
        $frontpage_id = get_option('page_on_front');
        $post_obj = get_queried_object();
        if( $frontpage_id>0 && $post_obj && isset($post_obj->post_parent) && $post_obj->post_parent==$frontpage_id ) {
            $post_parent_obj = get_post($post_obj->post_parent);
            wp_redirect( get_permalink($post_parent_obj->ID).'#'.$post_obj->post_name );
        }
    }
}
add_action( 'wp', 'vc_frontpage_redirect' );



?>
