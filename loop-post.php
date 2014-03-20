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
<div class="pagination">
    <?php
        $next_post = get_next_post();
        $next_url = $next_post ? get_permalink($next_post->ID) : false;
        $next_tag = $next_post ? 'a' : 'span';
        $next_title = $next_post ? esc_attr(strip_tags(apply_filters('the_title',$next_post->post_title))) : '';
        $prev_post = get_adjacent_post();
        $prev_url = $prev_post ? get_permalink($prev_post->ID) : false;
        $prev_tag = $prev_post ? 'a' : 'span';
        $prev_title = $prev_post ? esc_attr(strip_tags(apply_filters('the_title',$prev_post->post_title))) : '';
        echo '<'.$prev_tag.( $prev_url ? ' href="'.$prev_url.'"' : '' ).' class="pagination-link next" title="'.$prev_title.'"><span class="glyphicon glyphicon-chevron-left"></span></'.$prev_tag.'>'.
             '<'.$next_tag.( $next_url ? ' href="'.$next_url.'"' : '' ).' class="pagination-link prev" title="'.$next_title.'"><span class="glyphicon glyphicon-chevron-right"></span></'.$next_tag.'> ';
    ?>
</div>
