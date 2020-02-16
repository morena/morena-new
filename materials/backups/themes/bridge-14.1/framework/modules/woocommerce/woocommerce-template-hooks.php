<?php

if (!function_exists('qode_single_product_summary_additional_tag_before')) {
	function qode_single_product_summary_additional_tag_before() {

		print '<div class="qode-single-product-summary">';
	}
}

if (!function_exists('qode_single_product_summary_additional_tag_after')) {
	function qode_single_product_summary_additional_tag_after() {

		print '</div>';
	}
}