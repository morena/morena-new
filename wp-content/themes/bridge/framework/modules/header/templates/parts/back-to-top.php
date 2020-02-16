<?php
if(qode_options()->getOptionValue('show_back_button') == "yes"){

	$back_to_top_html = '<i class="fa fa-arrow-up"></i>';
	$back_to_top_icon_pack = qode_options()->getOptionValue('qode_back_to_top_icon_pack');

	if(isset($back_to_top_icon_pack) && !empty($back_to_top_icon_pack)) {
		$back_to_top_icon_param = qode_icon_collections()->getIconCollectionParamNameByKey($back_to_top_icon_pack);
		$back_to_top_icon = qode_options()->getOptionValue('qode_back_to_top_icon_pack_' . $back_to_top_icon_param);
		if(isset($back_to_top_icon) && !empty($back_to_top_icon)){
			$back_to_top_html = qode_icon_collections()->getIconHTML($back_to_top_icon, $back_to_top_icon_pack);
		}
	}
	?>
	<a id="back_to_top" href="#">
        <span class="fa-stack">
            <?php echo $back_to_top_html; ?>
        </span>
	</a>
<?php } ?>