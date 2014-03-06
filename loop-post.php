<?php

/* =============================================================================
   LOOP: Default Post
   ========================================================================== */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php
			echo esc_attr( sprintf( __('Permalink to %s',WPBS_TEXTDOMAIN), the_title_attribute('echo=0') ) );
		?>" rel="bookmark"><?php the_title(); ?></a></h2>
	</header>
	<div class="entry-content">
		<?php the_content(); ?>
	</div>
</article>
