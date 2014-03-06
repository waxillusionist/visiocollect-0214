<form role="search" class="searchform" method="get" action="<?php echo home_url('/'); ?>">
    <div class="input-group">
        <input class="form-control" type="text" placeholder="<?php
        	echo esc_attr( 'Suche&hellip;' );
		?>" value="<?php
        	the_search_query();
        ?>" name="s">
        <div class="input-group-btn">
        	<button class="btn btn-default" type="submit">
        		<span class="sr-only"><?php
        			echo esc_attr(__('Search',THEME_TEXTDOMAIN));
        		?>"></span>
        		<span class="glyphicon glyphicon-search"></span>
        	</button>
        </div>
    </div>
</form>
