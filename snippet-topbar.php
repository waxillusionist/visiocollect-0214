<?php

/* =============================================================================
   SNIPPET: Top Bar
   ========================================================================== */

global $topbar_fluid;
$topbar_fluid = isset($topbar_fluid)   ? $topbar_fluid   : false;

?>
<div id="topbar" role="navigation" class="main-navbar navbar fix-top<?php
    echo ( $topbar_fluid   ? ' fluid'   : ' fixed-width' );
    ?>">
    <div>
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main">
                <span class="sr-only"><?php _e('Toggle navigation',THEME_TEXTDOMAIN); ?></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <h1><a class="navbar-brand" rel="home" href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('description','display')); ?>"><span><?php bloginfo('name'); ?></span></a></h1>
        </div>
        <div class="navbar-main navbar-collapse collapse">
            <?php
            if( has_nav_menu('topbar-left') ) {
                wp_nav_menu( array(
                    'theme_location'    => 'topbar-left',
                    'depth'             => 2,
                    'container'         => '',
                    'container_class'   => '',
                    'menu_class'        => 'nav navbar-nav',
                    'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                    'walker'            => new wp_bootstrap_navwalker())
                );
            }
            if( has_nav_menu('topbar-right') )
            wp_nav_menu( array(
                'theme_location'    => 'topbar-right',
                'depth'             => 2,
                'container'         => '',
                'container_class'   => '',
                'menu_class'        => 'nav navbar-nav navbar-right',
                'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                'walker'            => new wp_bootstrap_navwalker())
            );
            ?>
        </div>
    </div>
</div>
