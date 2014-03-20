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
<a class="top-link" href="#top-of-page"><span class="glyphicon glyphicon-chevron-up"></span></a>
