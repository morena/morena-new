<?php
$loading_animation = true;
if (qode_options()->getOptionValue('loading_animation') == 'off'){ $loading_animation = false; };

$loading_image =  "";
if (qode_options()->getOptionValue('loading_image') !== ''){ $loading_image = qode_options()->getOptionValue('loading_image'); };

?>
<?php if($loading_animation){
	if(qode_options()->getOptionValue('page_loading_effect') == 'yes') : ?>
		<div class="qode-page-loading-effect-holder">
	<?php endif; ?>
	<div class="ajax_loader"><div class="ajax_loader_1"><?php if($loading_image != ""){ ?><div class="ajax_loader_2"><img itemprop="image" src="<?php echo $loading_image; ?>" alt="" /></div><?php } else{ qode_loading_spinners(); } ?></div></div>
	<?php if(qode_options()->getOptionValue('page_loading_effect') == 'yes') : ?>
		</div>
	<?php endif; ?>
<?php } ?>