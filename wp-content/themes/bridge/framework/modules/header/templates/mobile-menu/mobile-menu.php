<nav class="mobile_menu">
	<?php
	wp_nav_menu( array( 'theme_location' => 'top-navigation' ,
		'container'  => '',
		'container_class' => '',
		'menu_class' => '',
		'menu_id' => '',
		'fallback_cb' => 'top_navigation_fallback',
		'link_before' => '<span>',
		'link_after' => '</span>',
		'walker' => new qode_type2_walker_nav_menu()
	));
	?>
</nav>