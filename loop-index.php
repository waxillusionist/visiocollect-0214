<?php

/* =============================================================================
   LOOP: Default Post
   ========================================================================== */

$post_id = get_the_id();
$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'large' );
$post_class = 'post-excerpt'.( $thumb ? ' with-thumb' : '' );
$thumb_style = $thumb ? ' style="background-image:url('.$thumb[0].')"' : '';

?>
<article id="post-<?php the_ID(); ?>" <?php post_class($post_class); ?>>
    <header class="entry-header"<?php echo $thumb_style ?>>
        <h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
        <a class="entry-link" href="<?php the_permalink(); ?>" rel="bookmark"><span class="glyphicon glyphicon-link"></span></a>
        <div class="entry-date">
            <span class="day"><?php the_time('j'); ?></span>
            <span class="monthyear"><?php the_time('M Y'); ?></span>
        </div>
    </header>
    <div class="entry-content">
        <?php the_excerpt(); ?>
    </div>
</article>
