<?php

/* =============================================================================
   LOOP: Default Post
   ========================================================================== */

$post_id = get_the_id();
$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'large' );
$thumb_html = $thumb ? '<div class="entry-image" style="background-image:url('.$thumb[0].')"></div>' : '';

?>
<article id="post-<?php the_ID(); ?>" <?php post_class('post-single'); ?>>
	<?php echo $thumb_html; ?>
	<header class="entry-header">
		<h2 class="entry-title"><?php the_title(); ?></a></h2>
	</header>
	<div class="entry-content">
		<?php the_content(); ?>
	</div>
</article>
