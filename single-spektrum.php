<?php

/* =============================================================================
   TEMPLATE: Custom Posttype "Spektrum"
   ========================================================================== */

get_header();

get_template_part( 'snippet', 'topbar' );

the_post();

?>
<div class="container">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="entry-content">
            <?php the_content(); ?>
        </div>
    </article>
</div>
<?php

get_template_part( 'snippet', 'footer' );

get_footer();

?>
