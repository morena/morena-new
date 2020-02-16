<?php

/*************** YITH WISHLIST FILTERS - begin ***************/

//Change yith wishlist button position on single product page
//add_filter( 'yith_wcwl_positions', 'qode_woocommerce_wishlist_position', 10 );

//Add yith wishlist button
//add_action( 'qode_woocommerce_after_product_image', 'qode_woocommerce_wishlist_shortcode', 3 );
add_action('qode_woocommerce_info_below_image_hover', 'qode_woocommerce_wishlist_shortcode', 2);

//Remove quick view button from wishlist
remove_all_actions('yith_wcwl_table_after_product_name');


/*************** YITH WISHLIST FILTERS - end ***************/

