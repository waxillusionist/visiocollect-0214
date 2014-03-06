<?php

/* =============================================================================
   TEMPLATE: Default Page
   ========================================================================== */

get_header();

get_template_part( 'snippet', 'topbar' );

?>
<div class="container">
	<?php

	the_post();
	get_template_part( 'loop', 'page' );

	?>
</div>
<?php

get_template_part( 'snippet', 'footer' );

get_footer();

?>
