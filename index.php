<?php

/* =============================================================================
   TEMPLATE: Default Index
   ========================================================================== */

if( have_posts() ) {

    get_header();

    get_template_part( 'snippet', 'topbar' );

    ?>
    <div class="container">
        <?php

        while(have_posts()) {

            the_post();
            get_template_part( 'loop', 'index' );

        }

        vc_content_nav();

        ?>
    </div>
    <?php

    get_template_part( 'snippet', 'footer' );
    get_footer();

}

else {

    get_template_part( '404' );

}

?>
