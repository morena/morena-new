<?php

function printy($var){
  echo '<pre>';
  var_dump($var);
  echo '</pre>';
}

// enqueue the child theme stylesheet

Function wp_schools_enqueue_scripts() {
wp_register_style( 'childstyle', get_stylesheet_directory_uri() . '/style.css'  );
wp_enqueue_style( 'childstyle' );
}
add_action( 'wp_enqueue_scripts', 'wp_schools_enqueue_scripts', 11);


add_filter( 'woocommerce_product_tabs', 'remove_woocommerce_product_tabs', 98 );

function remove_woocommerce_product_tabs( $tabs ) {
    unset( $tabs['description'] );
    return $tabs;
}

//add_action( 'woocommerce_after_single_product_summary', 'woocommerce_product_description_tab' );


 // Remove WP Version From Styles
 add_filter( 'style_loader_src', 'sdt_remove_ver_css_js', 9999 );
 // Remove WP Version From Scripts
 add_filter( 'script_loader_src', 'sdt_remove_ver_css_js', 9999 );

 // Function to remove version numbers
 function sdt_remove_ver_css_js( $src ) {
 	if ( strpos( $src, 'ver=' ) )
 		$src = remove_query_arg( 'ver', $src );
 	return $src;
 }

 /*
 * Woocommerce Remove excerpt from single product
 */
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
add_action( 'woocommerce_single_product_summary', 'the_content', 20 );