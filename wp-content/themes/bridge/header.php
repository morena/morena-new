<?php global $qode_options_proya, $wp_query; ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<?php
	if (isset($_SERVER['HTTP_USER_AGENT']) && (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false)) {
		echo('<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">');
	} ?>

	<title><?php wp_title(''); ?></title>

	<?php
	/**
	 * qode_header_meta hook
	 *
	 * @see qode_header_meta() - hooked with 10
	 * @see qode_user_scalable_meta() - hooked with 10
	 */
	do_action('qode_header_meta');
	?>

	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <?php if(qode_options()->getOption('favicon_image') !== ''){ ?>
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo esc_url($qode_options_proya['favicon_image']); ?>">
        <link rel="apple-touch-icon" href="<?php echo esc_url($qode_options_proya['favicon_image']); ?>"/>
    <?php } ?>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">

<?php
$params = qode_header_parameters();
extract($params);

echo qode_get_module_template_part('templates/parts/ajax-loader', 'header');

echo qode_get_module_template_part('templates/side-area/side-area', 'header', '', $params);
?>

<div class="wrapper">
	<div class="wrapper_inner">

    <?php do_action('qode_after_wrapper_inner'); ?>

    <!-- Google Analytics start -->
    <?php if (qode_options()->getOptionValue('google_analytics_code') != ""){?>
        <script>
            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', '<?php echo $qode_options_proya['google_analytics_code']; ?>']);
            _gaq.push(['_trackPageview']);

            (function() {
                var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
            })();
        </script>
    <?php } ?>
    <!-- Google Analytics end -->

	<?php
    if($enable_vertical_menu) {
		echo qode_get_module_template_part('templates/vertical-header', 'header', '', $params);
	}else{
        switch($header_bottom_appearance){
            case 'stick menu_bottom':
				$header_appearance_slug = 'stick_menu_bottom';
                break;
            case 'fixed fixed_minimal':
                $header_appearance_slug = 'fixed_minimal';
                break;
            default:
                $header_appearance_slug = $header_bottom_appearance;
            break;
        }
        echo qode_get_module_template_part('templates/header-appearance/header', 'header', $header_appearance_slug, $params);
    }

	echo qode_get_module_template_part('templates/parts/back-to-top', 'header', '', $params);
	echo qode_get_module_template_part('templates/popup-menu/popup-menu', 'header', '', $params);
	echo qode_get_module_template_part('templates/parts/fullscreen-search', 'header', '', $params);
    ?>
	
	
    <?php if(qode_options()->getOptionValue('paspartu') == 'yes'){ ?>
    <div class="paspartu_outer <?php echo qode_get_paspartu_class(); ?>">
        <?php if(qode_options()->getOptionValue('vertical_area') == "yes" && qode_options()->getOptionValue('vertical_menu_inside_paspartu') == 'no') { ?>
            <div class="paspartu_middle_inner">
        <?php }?>

        <?php if((qode_options()->getOptionValue('paspartu_on_top') == 'yes' && qode_options()->getOptionValue('paspartu_on_top_fixed') == 'yes') ||
            (qode_options()->getOptionValue('vertical_area') == "yes" && qode_options()->getOptionValue('vertical_menu_inside_paspartu') == 'yes')){ ?>
            <div class="paspartu_top"></div>
        <?php }?>

        <div class="paspartu_left"></div>
        <div class="paspartu_right"></div>
        <div class="paspartu_inner">
    <?php } ?>

    <?php if(is_active_sidebar('left_side_fixed')){ ?>
        <div class="qode_left_side_fixed">
            <?php 
                dynamic_sidebar('left_side_fixed');
            ?>
        </div>
    <?php } ?>

    <div class="content <?php echo qode_get_content_class(); ?>">
    <?php
    $animation = get_post_meta($id, "qode_show-animation", true);
    if (!empty($_SESSION['qode_animation']) && $animation == ""){ $animation = $_SESSION['qode_animation']; }
    if(in_array(qode_options()->getOptionValue('page_transitions'), array('1', '2', '3', '4')) || in_array($animation, array("updown","fade","updown_fade","leftright"))){ ?>
        <div class="meta">

            <?php
            /**
             * qode_ajax_meta hook
             *
             * @hooked qode_ajax_meta - 10
             */
            do_action('qode_ajax_meta'); ?>

            <span id="qode_page_id"><?php echo $wp_query->get_queried_object_id(); ?></span>
            <div class="body_classes"><?php echo implode( ',', get_body_class()); ?></div>
        </div>
    <?php } ?>
    <div class="content_inner <?php echo $animation;?> ">
    <?php if(in_array(qode_options()->getOptionValue('page_transitions'), array('1', '2', '3', '4')) || in_array($animation, array("updown","fade","updown_fade","leftright"))){
         do_action('qode_visual_composer_custom_shortcodce_css');
    } ?>
