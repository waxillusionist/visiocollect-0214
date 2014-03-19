<?php

/* =============================================================================
   LOOP: Default Post
   ========================================================================== */

$post_id = get_the_id();
$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'large' );

?>
<article id="post-<?php the_ID(); ?>" <?php post_class('post-single'); ?>>
    <header class="entry-header">
        <h2 class="entry-title"><?php the_title(); ?></a></h2>
        <time class="entry-date published" datetime="<?php the_time('c'); ?>"><?php the_time('j. M \'y'); ?></time>
        <?php if($thumb) { ?>
            <img class="entry-thumb" src="<?php echo $thumb[0] ?>" width="<?php echo $thumb[1] ?>" height="<?php echo $thumb[2] ?>" alt="<?php the_title_attribute(); ?>">
        <?php } ?>
    </header>
    <div class="entry-content">
        <?php the_content(); ?>
    </div>
</article>
