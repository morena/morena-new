<nav class="mobile_menu">
	<?php
	echo '<ul>';
	wp_nav_menu( array( 'theme_location' => 'left-top-navigation' ,
		'container'  => '',
		'container_class' => '',
		'menu_class' => '',
		'menu_id' => '',
		'fallback_cb' => '',
		'link_before' => '<span>',
		'link_after' => '</span>',
		'walker' => new qode_type4_walker_nav_menu(),
		'items_wrap'      => '%3$s'
	));
	wp_nav_menu( array( 'theme_location' => 'right-top-navigation' ,
		'container'  => '',
		'container_class' => '',
		'menu_class' => '',
		'menu_id' => '',
		'fallback_cb' => '',
		'link_before' => '<span>',
		'link_after' => '</span>',
		'walker' => new qode_type4_walker_nav_menu(),
		'items_wrap'      => '%3$s'
	));
	echo '</ul>';
	?>
</nav>