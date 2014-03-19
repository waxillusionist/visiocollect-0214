<?php

/* =============================================================================
   LOOP: Default Post
   ========================================================================== */

$post_id = get_the_id();
$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'thumb_ratio' );
$post_class = 'post-excerpt'.( $thumb ? ' with-thumb' : '' );

?>
<article id="post-<?php the_ID(); ?>" <?php post_class('hentry '.$post_class); ?>>
    <header class="entry-header">
        <?php if($thumb) { ?>
            <img class="entry-thumb" src="<?php echo $thumb[0] ?>" width="<?php echo $thumb[1] ?>" height="<?php echo $thumb[2] ?>" alt="<?php the_title_attribute(); ?>">
        <?php } ?>
        <h3 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
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
