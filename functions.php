<?php

/* =============================================================================
   Theme Vars
   ========================================================================== */

$theme = wp_get_theme( explode( '/themes/', get_stylesheet_directory() )[1] );

define( 'THEME_ABSPATH',        dirname( __FILE__ ).'/' );
define( 'THEME_PATH',           substr( THEME_ABSPATH, strrpos( (string) THEME_ABSPATH ,'wp-content') ) );
define( 'THEME_URI',            home_url('/'.THEME_PATH) );
define( 'THEME_IMG',            THEME_URI.'assets/img/' );
define( 'THEME_NAME',           $theme->Name );
define( 'THEME_VERSION',        $theme->Version );
define( 'THEME_TEXTDOMAIN',     $theme->get('TextDomain') );
define( 'THEME_JQUERY_VERSION', '1.11.0' );

/* =============================================================================
   Inclusions
   ========================================================================== */

foreach( array(
	'inc/setup.php',
	'inc/contactform.php',
	'inc/ops-redirect.php',
	'inc/cleanup.php',
	'inc/relative-urls.php',
	'inc/custom-post-types.php',
	'inc/multiple-post-thumbnails.php',
	'inc/opengraph.php',
	'inc/scriptsnstyles.php',
	'inc/theme.php',
	'inc/vendor/wp_bootstrap_navwalker.php',
	'inc/shortcodes-grid.php',
	'inc/shortcodes-typography.php',
	'inc/shortcodes-buttons.php',
	'inc/shortcodes-buttons.php',
	'inc/shortcodes-gmap.php',
	'inc/shortcodes-bgimage.php',
	'inc/shortcodes-gallery.php',
	'inc/shortcodes-spacer.php',
	'inc/shortcodes-spektrum.php',
	'inc/shortcodes-heightfix.php'
) as $f )
	require_once THEME_ABSPATH.$f;

?>
