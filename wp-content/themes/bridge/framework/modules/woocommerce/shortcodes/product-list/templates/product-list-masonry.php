<div class="qode-pl-holder <?php echo esc_attr($holder_classes) ?>" <?php echo wp_kses($holder_data, array('data')); ?>>
	<?php if($query_result->have_posts()){ ?>
        <?php echo qode_get_woo_shortcode_module_template_part('templates/parts/categories-filter', 'product-list', '', $params); ?>
		<?php echo qode_get_woo_shortcode_module_template_part('templates/parts/ordering-filter', 'product-list', '', $params); ?>
        <div class="qode-prl-loading">
            <span class="qode-prl-loading-msg"><?php esc_html_e('Loading...', 'qode') ?></span>
        </div>
        <div class="qode-pl-outer">
            <div class="qode-pl-sizer"></div>
            <div class="qode-pl-gutter"></div>
            <?php while ($query_result->have_posts()) : $query_result->the_post();
                echo qode_get_woo_shortcode_module_template_part('templates/parts/' . $params['info_position'], 'product-list', '', $params);
                endwhile;
			?>
        </div>
	<?php }else {
		qode_get_module_template_part('templates/parts/no-posts', 'woocommerce', '', $params);
	}
	wp_reset_postdata();
	?>
</div>