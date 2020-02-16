<div class="<?php echo $wrapper_class; ?>" <?php echo $logo_style; ?>>
	<div class="<?php echo $image_class; ?>">
		<a itemprop="url" href="<?php echo home_url('/'); ?>" <?php echo $logo_style; ?>>
            <?php if($show_logo_image){ ?> <img itemprop="image" class="normal" src="<?php echo $logo_image; ?>" alt="Logo"/> <?php } ?>
			<?php if($show_logo_image_light){ ?> <img itemprop="image" class="light" src="<?php echo $logo_image_light; ?>" alt="Logo"/> <?php } ?>
			<?php if($show_logo_image_dark){ ?> <img itemprop="image" class="dark" src="<?php echo $logo_image_dark; ?>" alt="Logo"/> <?php } ?>
			<?php if($show_logo_image_sticky){ ?> <img itemprop="image" class="sticky" src="<?php echo $logo_image_sticky; ?>" alt="Logo"/> <?php } ?>
			<?php if($show_logo_image_mobile){ ?> <img itemprop="image" class="mobile" src="<?php echo $logo_image_mobile; ?>" alt="Logo"/> <?php } ?>
			<?php if($show_logo_image_popup && qode_options()->getOptionValue('enable_popup_menu') == 'yes'){ ?> <img itemprop="image" class="popup" src="<?php echo $logo_image_popup; ?>" alt="Logo"/> <?php } ?>
		</a>
	</div>
	<?php if($show_logo_image_fixed_hidden) { ?>
        <div class="q_logo_hidden">
            <a itemprop="url" href="<?php echo home_url('/'); ?>"><img itemprop="image" alt="Logo" src="<?php echo $logo_image_fixed_hidden; ?>" style="height: 100%;"></a>
        </div>
	<?php } ?>
</div>