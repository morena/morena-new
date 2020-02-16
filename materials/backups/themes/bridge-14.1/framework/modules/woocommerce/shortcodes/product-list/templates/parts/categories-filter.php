<?php if($show_category_filter == 'yes'){ ?>
<div class="qode-pl-categories">
    <h6 class="qode-pl-categories-label"><?php esc_html_e('Categories','qode'); ?></h6>
	<ul>
        <?php print $categories_filter_list; ?>
    </ul>
</div>
<?php } ?>