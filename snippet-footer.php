<?php

/* =============================================================================
   Global Footer
   ========================================================================== */
?>
<div class="global-footer">
	<div class="container">
		<div class="widget-area" role="complementary">
			<?php
			if( is_active_sidebar('footer-sidebar') )
				dynamic_sidebar('footer-sidebar');
			?>
		</div>
	</div>
</div>
