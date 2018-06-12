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
