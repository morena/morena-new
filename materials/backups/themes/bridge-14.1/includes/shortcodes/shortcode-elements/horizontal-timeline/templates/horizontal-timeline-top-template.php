<div class="qode-horizontal-timeline <?php echo esc_attr($holder_classes); ?>">
	<div class="qode-timeline">
	    <div class="qode-events-wrapper">
	        <div class="qode-events">
	            <ol>
	                <?php foreach($timeline_params as $key=>$value) { ?>
	                    <li><a href="javascript:void(0)" data-date="<?php echo esc_attr($key) ?>"><span class="qode-event-text"><?php echo esc_html($value); ?></span><span class="circle-outer"><span class="circle-inner"></span></span></a></li>
	                <?php } ?>
	            </ol>
	            <span class="qode-filling-line" aria-hidden="true"></span>
	            <div class="qode-dots"></div>
	        </div>
	    </div>
	    <ul class="qode-timeline-navigation">
	        <li><a href="#0" class="qode-prev inactive"></a></li>
	        <li><a href="#0" class="qode-next"></a></li>
	    </ul>
	</div>
	<div class="qode-events-content">
	    <ol>
	        <?php echo do_shortcode($content); ?>
	    </ol>
	</div>
</div>