<?php

/* =============================================================================
   TEMPLATE: Single Post
   ========================================================================== */

get_header();

get_template_part( 'snippet', 'topbar' );

?>
<div class="container">
	<?php

	the_post();
	get_template_part( 'loop', 'post' );

	?>
</div>
<?php

get_template_part( 'snippet', 'footer' );

get_footer();

?>
