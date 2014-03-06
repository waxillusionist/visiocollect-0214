<?php

/* =============================================================================
   TEMPLATE: Default Index
   ========================================================================== */

if( have_posts() ) {

	get_header();

	get_template_part( 'snippet', 'topbar' );

	?>
	<div class="container">
		<div class="row">
			<div class="col-sm-8">
				<?php

				while(have_posts()) {

					the_post();
					get_template_part( 'loop', 'post' );

				}

				vc_content_nav();

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

	get_footer();

}

else {

	get_template_part( '404' );

}

?>
