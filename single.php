<?php

/* =============================================================================
   TEMPLATE: Single Post
   ========================================================================== */

get_header();

get_template_part( 'snippet', 'topbar' );

?>
<div class="container">
	<div class="row">
		<div class="col-sm-8">
			<?php

			the_post();
			get_template_part( 'loop', 'post' );

			?>
		</div>
		<div class="col-sm-3 col-sm-offset-1">
			<?php

			get_sidebar();

			?>
		</div>
	</div>
</div>
<?php

get_template_part( 'snippet', 'footer' );

get_footer();

?>
