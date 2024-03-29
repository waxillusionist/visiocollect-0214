<?php

/* =============================================================================
   If not in admin backend...
   ========================================================================== */

if( !is_admin() && !in_array($GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php') ) ) :



    /* =============================================================================
       Replace Wordpress' jQuery version with a Google CDN version
       ========================================================================== */

    function vc_replace_jquery() {
        if( !is_admin() ) {
            $jquery_cdn = 'https://ajax.googleapis.com/ajax/libs/jquery/'.THEME_JQUERY_VERSION.'/jquery.min.js';
            wp_deregister_script('jquery');
            wp_register_script( 'jquery', $jquery_cdn, false, THEME_JQUERY_VERSION, false );
        }
    }
    add_action('init', 'vc_replace_jquery' );



    /* =============================================================================
       jQuery local fallback   (http://wordpress.stackexchange.com/a/12450)
       ========================================================================== */

    function vc_jquery_fallback( $src, $handle = null ) {
        static $run_next = false;
        if( $run_next ) {
            $jquery_local = THEME_URI.'assets/js/vendor/jquery/jquery.min.js';
            echo '<script type="text/javascript">/*//<![CDATA[*/window.jQuery || document.write(\'<script type="text/javascript" src="'.$jquery_local.'"><\/script>\');/*//]]>*/</script>'."\n";
            $run_next = false;
        }
        if( $handle === 'jquery' )
            $run_next = true;
        return $src;
    }
    add_filter( 'script_loader_src', 'vc_jquery_fallback', 10, 2 );
    add_action( 'wp_head', 'vc_jquery_fallback', 2 );



/* =============================================================================
   End if not in admin backend.
   ========================================================================== */

endif;



/* =============================================================================
   Add html5shiv and respond.js for IE<9
   ========================================================================== */

function vc_fix_ltie9() {
    echo '<!--[if lt IE 9]>'."\n".
        '<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>'."\n".
        '<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>'."\n".
        // '<script src="'.THEME_URI.'assets/js/vendor/skrollr/skrollr.ie.min.js"></script>'."\n".
        '<![endif]-->'."\n";
}
add_action( 'wp_head', 'vc_fix_ltie9' );



/* =============================================================================
   Enqueue Scripts and Styles
   ========================================================================== */

function vc_scripts_n_styles() {
    wp_enqueue_style('vc-styles', THEME_URI.'assets/css/styles.min.css', array(), 'cb95');
    wp_register_script('modernizr', THEME_URI.'assets/js/vendor/modernizr/modernizr.min.js', array(), null, false);
    wp_register_script('gmaps-api', 'https://maps.google.com/maps/api/js?sensor=false', array(), null, false);
    $script_dependencies = array('modernizr','jquery','gmaps-api');
    wp_register_script('vc-scripts', THEME_URI.'assets/js/scripts.min.js', $script_dependencies, '6091', false);
    wp_enqueue_script('vc-scripts');
}
add_action( 'wp_enqueue_scripts', 'vc_scripts_n_styles', 99 );

?>
