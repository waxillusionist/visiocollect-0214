<?php

/* =============================================================================
   LOOP: Default Page
   ========================================================================== */
   
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h2 class="entry-title"><?php the_title(); ?></h2>
	</header>
	<div class="entry-content">
		<?php
			do_action( 'loop-page-entry-content-alpha' );
			the_content();
			do_action( 'loop-page-entry-content-omega' );
		?>
	</div>
</article>