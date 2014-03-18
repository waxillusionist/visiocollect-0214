<?php

/* =============================================================================
   TEMPLATE: Default Page
   ========================================================================== */

?>
<div id="main-sidebar" class="widget-area" role="complementary">
    <?php
        if( is_active_sidebar('main-sidebar') ) {
            dynamic_sidebar('main-sidebar');
        }
        else {
            ?>

            <?php
        }
    ?>
</div>
