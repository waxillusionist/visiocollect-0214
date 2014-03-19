<?php

/* =============================================================================
   TEMPLATE: Default Index
   ========================================================================== */

if( have_posts() ) {

    get_header();

    get_template_part( 'snippet', 'topbar' );

    ?>
    <div class="container">
        <h2 class="entry-title">Blog</h2>
        <div class="row blog-grid">
            <?php
            $i = 0;
            while(have_posts()) {
                echo '<div class="col col-sm-6 col-md-4">';
                the_post();
                get_template_part( 'loop', 'index' );
                echo '</div>';
                echo $i>0&&$i%2==0?'<div class="clear visible-sm"></div>':'';
                echo $i>0&&$i%3==0?'<div class="clear visible-md"></div>':'';
                $i++;
            }
            ?>
        </div>
        <?php vc_content_nav(); ?>
    </div>
    <?php

    get_template_part( 'snippet', 'footer' );
    get_footer();

}

else {

    get_template_part( '404' );

}

?>
