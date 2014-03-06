<?php

/* =============================================================================
   TEMPLATE: 404
   ========================================================================== */

global $body_class;
$body_class = 'error-404';

get_header();

get_template_part( 'snippet', 'topbar' );

?>
<div class="fullscreen">
	<div class="inner">
		<h2>
			<small>Error 404</small>
			Mir hen leider nix gfonda&hellip;
		</h2>
		<p>
			<a href="http://visiocollect.com/"><span class="glyphicon glyphicon-play"></span> visiocollect.com</a>
		</p>
	</div>
</div>
<?php

get_footer();

?>
