<?php
if (!function_exists ('add_action')) {
	header('Status: 403 Forbidden');
	header('HTTP/1.1 403 Forbidden');
	exit();
}
class Qode_Import
{

    private static $instance;
    private $revSliderFolder;
    private $layerSliderFolder;
    private $importURI;

    public static function getInstance()
    {
        if (self::$instance === null) {
            return new self();
        }

        return self::$instance;
    }

    function __construct()
    {

        $this->revSliderFolder = 'qode-rev-sliders';
        $this->layerSliderFolder = 'qode-layer-sliders';
        $this->importURI = 'http://export.qodethemes.com/';

    }

    public function demos_import_list() {

        $demos = array(
            'bridge' => array(
                'title' => esc_html__('Demo - Original', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array('LayerSlider_Export.zip'),
                'required-plugins' => array('js_composer', 'woocommerce', 'LayerSlider')
            ),
            'bridge3' => array(
                'title' => esc_html__('Demo 3 - Business', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(
                    'sliders'   => array('LayerSlider_Export_Bridge3.zip'),
                    'pairs'     => array(14 => 1, 13 => 2),
                    'slider_in_content' => false
                ),
                'required-plugins' => array('js_composer', 'LayerSlider')
            ),
            'bridge4' => array(
                'title' => esc_html__('Demo 4 - Agency', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer')
            ),
            'bridge5' => array(
                'title' => esc_html__('Demo 5 - Estate', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(
                    'sliders'   => array('LayerSlider_Export_Bridge5.zip'),
                    'pairs'     => array(15 => 1, 13 => 2),
                    'slider_in_content' => false
                ),
                'required-plugins' => array('js_composer', 'LayerSlider')
            ),
            'bridge6' => array(
                'title' => esc_html__('Demo 6 - Light', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(
                    'sliders'   => array('LayerSlider_Export_Bridge6.zip'),
                    'pairs'     => array(15 => 1, 13 => 2),
                    'slider_in_content' => false
                ),
                'required-plugins' => array('js_composer')
            ),
            'bridge7' => array(
                'title' => esc_html__('Demo 7 - Urban', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(
                    'sliders'   => array('LayerSlider_Export_Bridge7.zip'),
                    'pairs'     => array(13 => 1),
                    'slider_in_content' => false
                ),
                'required-plugins' => array('js_composer')
            ),
            'bridge8' => array(
                'title' => esc_html__('Demo 8 - Fashion', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(
                    'sliders'   => array('LayerSlider_Export_Bridge8.zip'),
                    'pairs'     => array(13 => 1),
                    'slider_in_content' => false
                ),
                'required-plugins' => array('js_composer')
            ),
            'bridge9' => array(
                'title' => esc_html__('Demo 9 - Cafe', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(
                    'sliders'   => array('LayerSlider_Export_Bridge9.zip'),
                    'pairs'     => array(14 => 1, 13 => 2),
                    'slider_in_content' => false
                ),
                'required-plugins' => array('js_composer')
            ),
            'bridge10' => array(
                'title' => esc_html__('Demo 10 - One Page', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer')
            ),
            'bridge11' => array(
                'title' => esc_html__('Demo 11 - Modern', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(
                    'sliders'   => array('LayerSlider_Export_Bridge11.zip'),
                    'pairs'     => array(13 => 1),
                    'slider_in_content' => false
                ),
                'required-plugins' => array('js_composer')
            ),
            'bridge12' => array(
                'title' => esc_html__('Demo 12 - University', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(
                    'sliders'   => array('LayerSlider_Export_Bridge12.zip'),
                    'pairs'     => array(13 => 1),
                    'slider_in_content' => false
                ),
                'required-plugins' => array('js_composer')
            ),
            'bridge13' => array(
                'title' => esc_html__('Demo 13 - Winery', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(
                    'sliders'   => array('LayerSlider_Export_Bridge13.zip'),
                    'pairs'     => array(16 => 1, 15 => 2, 13 => 3),
                    'slider_in_content' => true
                ),
                'required-plugins' => array('js_composer', 'woocommerce')
            ),
            'bridge14' => array(
                'title' => esc_html__('Demo 14 - Restaurant', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer')
            ),
            'bridge15' => array(
                'title' => esc_html__('Demo 15 - Construct', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer')
            ),
            'bridge16' => array(
                'title' => esc_html__('Demo 16 - Portfolio Masonry', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer')
            ),
            'bridge17' => array(
                'title' => esc_html__('Demo 17 - Vintage', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer')
            ),
            'bridge18' => array(
                'title' => esc_html__('Demo 18 - Creative Business', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer')
            ),
            'bridge19' => array(
                'title' => esc_html__('Demo 19 - Catalog', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer')
            ),
            'bridge20' => array(
                'title' => esc_html__('Demo 20 - Portfolio', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer')
            ),
            'bridge21' => array(
                'title' => esc_html__('Demo 21 - Minimalist', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer')
            ),
            'bridge22' => array(
                'title' => esc_html__('Demo 22 - Dark Parallax', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer')
            ),
            'bridge23' => array(
                'title' => esc_html__('Demo 23 - Split Screen', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer')
            ),
            'bridge24' => array(
                'title' => esc_html__('Demo 24 - Avenue', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer')
            ),
            'bridge25' => array(
                'title' => esc_html__('Demo 25 - Portfolio Pinterest', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer')
            ),
            'bridge26' => array(
                'title' => esc_html__('Demo 26 - Health', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer')
            ),
            'bridge27' => array(
                'title' => esc_html__('Demo 27 - Flat', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(
                    'sliders'   => array('LayerSlider_Export_Bridge27.zip'),
                    'pairs'     => array(14 => 1),
                    'slider_in_content' => false
                ),
                'required-plugins' => array('js_composer', 'contact-form-7', 'LayerSlider')
            ),
            'bridge28' => array(
                'title' => esc_html__('Demo 28 - Wireframey', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7', 'woocommerce')
            ),
            'bridge29' => array(
                'title' => esc_html__('Demo 29 - Denim', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridge30' => array(
                'title' => esc_html__('Demo 30 - Mist', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridge31' => array(
                'title' => esc_html__('Demo 31 - Architecture', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridge32' => array(
                'title' => esc_html__('Demo 32 - Small Brand', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(
                    'sliders'   => array('LayerSlider_Export_Bridge32.zip'),
                    'pairs'     => array(14 => 1, 13 => 2),
                    'slider_in_content' => false
                ),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridge33' => array(
                'title' => esc_html__('Demo 33 - Creative', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(
                    'sliders'   => array('LayerSlider_Export_Bridge33.zip'),
                    'pairs'     => array(14 => 1, 13 => 2),
                    'slider_in_content' => false
                ),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridge34' => array(
                'title' => esc_html__('Demo 34 - Parallax', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridge35' => array(
                'title' => esc_html__('Demo 35 - Minimal', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridge36' => array(
                'title' => esc_html__('Demo 36 - Simple Blog', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridge37' => array(
                'title' => esc_html__('Demo 37 - Pinterest Blog', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridge38' => array(
                'title' => esc_html__('Demo 38 - Studio', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(
                    'sliders'   => array('LayerSlider_Export_Bridge38.zip'),
                    'pairs'     => array(15 => 1, 14 => 2),
                    'slider_in_content' => false
                ),
                'required-plugins' => array('js_composer', 'contact-form-7', 'LayerSlider')
            ),
            'bridge39' => array(
                'title' => esc_html__('Demo 39 - Contemporary Art', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(
                    'sliders'   => array('LayerSlider_Export_Bridge39.zip'),
                    'pairs'     => array(14 => 1, 13 => 2),
                    'slider_in_content' => false
                ),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridge40' => array(
                'title' => esc_html__('Demo 40 - Chocolaterie', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(
                    'sliders'   => array('LayerSlider_Export_Bridge40.zip'),
                    'pairs'     => array(14 => 1, 13 => 2),
                    'slider_in_content' => false
                ),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridge41' => array(
                'title' => esc_html__('Demo 41 - Branding', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridge42' => array(
                'title' => esc_html__('Demo 42 - Collection', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridge43' => array(
                'title' => esc_html__('Demo 43 - Creative Vintage', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridge44' => array(
                'title' => esc_html__('Demo 44 - Coming Soon Simple', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridge45' => array(
                'title' => esc_html__('Demo 45 - Coming Soon Creative', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridge46' => array(
                'title' => esc_html__('Demo 46 - Lawyer', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridge47' => array(
                'title' => esc_html__('Demo 47 - Health Blog', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridge48' => array(
                'title' => esc_html__('Demo 48 - Photography Split Screen', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridge49' => array(
                'title' => esc_html__('Demo 49 - Agency One Page', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridge50' => array(
                'title' => esc_html__('Demo 50 - Fashion Shop', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(
                    'sliders'   => array('LayerSlider_Export_Bridge50.zip'),
                    'pairs'     => array(15 => 1, 14 => 2, 13 => 3),
                    'slider_in_content' => true
                ),
                'required-plugins' => array('js_composer', 'contact-form-7', 'woocommerce')
            ),
            'bridge51' => array(
                'title' => esc_html__('Demo 51 - Company', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridge52' => array(
                'title' => esc_html__('Demo 52 - Wellness', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridge53' => array(
                'title' => esc_html__('Demo 53 - Case Study', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridge54' => array(
                'title' => esc_html__('Demo 54 - Design Studio', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridge55' => array(
                'title' => esc_html__('Demo 55 - Digital Agency', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridge56' => array(
                'title' => esc_html__('Demo 56 - Organic', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridge57' => array(
                'title' => esc_html__('Demo 57 - Jazz', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridge58' => array(
                'title' => esc_html__('Demo 58 - Wedding', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridge59' => array(
                'title' => esc_html__('Demo 59 - Jeans', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridge60' => array(
                'title' => esc_html__('Demo 60 - Innovation', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridge61' => array(
                'title' => esc_html__('Demo 61 - Travel Blog', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridge62' => array(
                'title' => esc_html__('Demo 62 - Passepartout', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridge63' => array(
                'title' => esc_html__('Demo 63 - Graphic Studio', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridge64' => array(
                'title' => esc_html__('Demo 64 - Cupcake', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer')
            ),
            'bridge65' => array(
                'title' => esc_html__('Demo 65 - Sunglasses Shop', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7', 'woocommerce')
            ),
            'bridge66' => array(
                'title' => esc_html__('Demo 66 - Kids', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridge67' => array(
                'title' => esc_html__('Demo 67 - Animals', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridge68' => array(
                'title' => esc_html__('Demo 68 - Photo Studio', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(
                    'sliders'   => array('LayerSlider_Export_Bridge68.zip'),
                    'pairs'     => array(14 => 1, 13 => 2),
                    'slider_in_content' => true
                ),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridge69' => array(
                'title' => esc_html__('Demo 69 - Urban Fashion', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridge70' => array(
                'title' => esc_html__('Demo 70 - Marine', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7', 'woocommerce')
            ),
            'bridge71' => array(
                'title' => esc_html__('Demo 71 - Interior Design', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'woocommerce')
            ),
            'bridge72' => array(
                'title' => esc_html__('Demo 72 - Bar &amp; Grill', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(
                    'sliders'   => array('LayerSlider_Export_Bridge72.zip'),
                    'pairs'     => array(14 => 1),
                    'slider_in_content' => false
                ),
                'required-plugins' => array('js_composer', 'contact-form-7', 'LayerSlider')
            ),
            'bridge73' => array(
                'title' => esc_html__('Demo 73 - Brewery', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(
                    'sliders'   => array('LayerSlider_Export_Bridge73.zip'),
                    'pairs'     => array(13 => 1),
                    'slider_in_content' => false
                ),
                'required-plugins' => array('js_composer', 'contact-form-7', 'woocommerce', 'LayerSlider')
            ),
            'bridge74' => array(
                'title' => esc_html__('Demo 74 - Corporate', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridge75' => array(
                'title' => esc_html__('Demo 75 - Office', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridge76' => array(
                'title' => esc_html__('Demo 76 - Paper', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridge77' => array(
                'title' => esc_html__('Demo 77 - Simple Photography', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridge78' => array(
                'title' => esc_html__('Demo 78 - Furniture', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridge79' => array(
                'title' => esc_html__('Demo 79 - Skin Care', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(
                    'sliders'   => array('LayerSlider_Export_Bridge79.zip'),
                    'pairs'     => array(14 => 1),
                    'slider_in_content' => false
                ),
                'required-plugins' => array('js_composer', 'contact-form-7', 'woocommerce', 'LayerSlider')
            ),
            'bridge80' => array(
                'title' => esc_html__('Demo 80 - Rustic', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridge81' => array(
                'title' => esc_html__('Demo 81 - Cargo', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridge82' => array(
                'title' => esc_html__('Demo 82 - Creative Photography', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridge83' => array(
                'title' => esc_html__('Demo 83 - Construction', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridge84' => array(
                'title' => esc_html__('Demo 84 - Campaign', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridge85' => array(
                'title' => esc_html__('Demo 85 - Dim Sum', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(
                    'sliders'   => array('LayerSlider_Export_Bridge85.zip'),
                    'pairs'     => array(14 => 1),
                    'slider_in_content' => true
                ),
                'required-plugins' => array('js_composer', 'contact-form-7', 'LayerSlider')
            ),
            'bridge86' => array(
                'title' => esc_html__('Demo 86 - Flat Company', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridge87' => array(
                'title' => esc_html__('Demo 87 - Photography Portfolio', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridge88' => array(
                'title' => esc_html__('Demo 88 - Charity', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridge89' => array(
                'title' => esc_html__('Demo 89 - Handmade', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7', 'woocommerce')
            ),
            'bridge90' => array(
                'title' => esc_html__('Demo 90 - Telecom', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridge91' => array(
                'title' => esc_html__('Demo 91 - Black-And-White', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridge92' => array(
                'title' => esc_html__('Demo 92 - Pets', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(
                    'sliders'   => array('LayerSlider_Export_Bridge92.zip'),
                    'pairs'     => array(14 => 1),
                    'slider_in_content' => true
                ),
                'required-plugins' => array('js_composer', 'contact-form-7', 'LayerSlider')
            ),
            'bridge93' => array(
                'title' => esc_html__('Demo 93 - Designer Personal', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(
                    'sliders'   => array('LayerSlider_Export_Bridge93.zip'),
                    'pairs'     => array(14 => 1),
                    'slider_in_content' => true
                ),
                'required-plugins' => array('js_composer', 'contact-form-7', 'LayerSlider')
            ),
            'bridge94' => array(
                'title' => esc_html__('Demo 94 - Modern Business', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer')
            ),
            'bridge95' => array(
                'title' => esc_html__('Demo 95 - Contemporary Company', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(
                    'sliders'   => array('LayerSlider_Export_Bridge95.zip'),
                    'pairs'     => array(14 => 1),
                    'slider_in_content' => true
                ),
                'required-plugins' => array('js_composer', 'contact-form-7', 'LayerSlider')
            ),
            'bridge96' => array(
                'title' => esc_html__('Demo 96 - Bridge Communication Demo', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(
                    'sliders'   => array('LayerSlider_Export_Bridge96.zip'),
                    'pairs'     => array(14 => 1),
                    'slider_in_content' => true
                ),
                'required-plugins' => array('js_composer', 'contact-form-7', 'LayerSlider')
            ),
            'bridge97' => array(
                'title' => esc_html__('Demo 97 - Bridge Blog Slider Demo', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(
                    'sliders'   => array('LayerSlider_Export_Bridge97.zip'),
                    'pairs'     => array(14 => 1),
                    'slider_in_content' => false
                ),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridge98' => array(
                'title' => esc_html__('Demo 98 - Bridge Fashion Photography Demo', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridge99' => array(
                'title' => esc_html__('Demo 99 - Bridge Urban Shop Demo', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(
                    'sliders'   => array('LayerSlider_Export_Bridge99.zip'),
                    'pairs'     => array(14 => 1),
                    'slider_in_content' => true
                ),
                'required-plugins' => array('js_composer', 'woocommerce')
            ),
            'bridge100' => array(
                'title' => esc_html__('Demo 100 - Bridge CV Demo', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer')
            ),
            'bridge101' => array(
                'title' => esc_html__('Concept 101 - Standard', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridge102' => array(
                'title' => esc_html__('Concept 102 - Split Screen', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridge103' => array(
                'title' => esc_html__('Concept 103 - Left Menu Initially Hidden', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridge104' => array(
                'title' => esc_html__('Concept 104 - Left Menu With Background Image', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridge105' => array(
                'title' => esc_html__('Concept 105 - Left Menu', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridge106' => array(
                'title' => esc_html__('Concept 106 - Blog with Slider', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridge107' => array(
                'title' => esc_html__('Concept 107 - Masonry Gallery', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridge108' => array(
                'title' => esc_html__('Concept 108 - Short Slider', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridge109' => array(
                'title' => esc_html__('Concept 109 - Angled Sections', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridge110' => array(
                'title' => esc_html__('Concept 110 - Grid', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(
                    'sliders'   => array('LayerSlider_Export_Bridge110.zip'),
                    'pairs'     => array(14 => 1),
                    'slider_in_content' => true
                ),
                'required-plugins' => array('js_composer', 'contact-form-7', 'woocommerce')
            ),
            'bridge111' => array(
                'title' => esc_html__('Concept 111 - Elegant Slider', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridge112' => array(
                'title' => esc_html__('Concept 112 - Full Screen Sections', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridge113' => array(
                'title' => esc_html__('Concept 113 - Shop Grid', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(
                    'sliders'   => array('LayerSlider_Export_Bridge113.zip'),
                    'pairs'     => array(14 => 1),
                    'slider_in_content' => false
                ),
                'required-plugins' => array('js_composer', 'contact-form-7', 'woocommerce')
            ),
            'bridge114' => array(
                'title' => esc_html__('Concept 114 - Shop Wide', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7', 'woocommerce')
            ),
            'bridge115' => array(
                'title' => esc_html__('Concept 115 - One Page Site', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridge116' => array(
                'title' => esc_html__('Concept 116 - Dark Border', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridge117' => array(
                'title' => esc_html__('Concept 117 - Portfolio with Left Menu', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridge118' => array(
                'title' => esc_html__('Concept 118 - Portfolio Pinterest Style', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridge119' => array(
                'title' => esc_html__('Concept 119 - Shop with Left Menu', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7', 'woocommerce')
            ),
            'bridge120' => array(
                'title' => esc_html__('Concept 120 - Photo Slider', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridge121' => array(
                'title' => esc_html__('Concept 121 - Blog in Grid', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridge122' => array(
                'title' => esc_html__('Concept 122 - Blog Pinterest Style', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer')
            ),
            'bridge123' => array(
                'title' => esc_html__('Concept 123 - Video Slider', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridge124' => array(
                'title' => esc_html__('Concept 124 - Blog Loop', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridgedb1' => array(
                'title' => esc_html__('New Demo 1 - App Showcase', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridgedb2' => array(
                'title' => esc_html__('New Demo 2 - Creative Agency', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7', 'qode-instagram-widget')
            ),
            'bridgedb3' => array(
                'title' => esc_html__('New Demo 3 - Construction Company', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridgedb4' => array(
                'title' => esc_html__('New Demo 4 - Modern Restaurant', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridgedb5' => array(
                'title' => esc_html__('New Demo 5 - Wedding Announcement', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridgedb6' => array(
                'title' => esc_html__('New Demo 6 - Online Agency', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridgedb7' => array(
                'title' => esc_html__('New Demo 7 - Rock Band', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridgedb8' => array(
                'title' => esc_html__('New Demo 8 - Craftsman', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridgedb9' => array(
                'title' => esc_html__('New Demo 9 - Corporation', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridgedb10' => array(
                'title' => esc_html__('New Demo 10 - Modern Photography', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridgedb11' => array(
                'title' => esc_html__('New Demo 11 - Illustrator Portfolio', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridgedb12' => array(
                'title' => esc_html__('New Demo 12 - Urban Store', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7', 'woocommerce')
            ),
            'bridgedb13' => array(
                'title' => esc_html__('New Demo 13 - Vibrant Portfolio', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridgedb14' => array(
                'title' => esc_html__('New Demo 14 - Photography Tiles', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridgedb15' => array(
                'title' => esc_html__('New Demo 15 - Freelance Designer', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridgedb16' => array(
                'title' => esc_html__('New Demo 16 - Clothing Store', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7', 'woocommerce')
            ),
            'bridgedb17' => array(
                'title' => esc_html__('New Demo 17 - Urban Studio', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridgedb18' => array(
                'title' => esc_html__('New Demo 18 - Masonry Shop', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7', 'woocommerce')
            ),
            'bridgedb19' => array(
                'title' => esc_html__('New Demo 19 - Fullscreen Shop', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7', 'woocommerce')
            ),
            'bridgedb20' => array(
                'title' => esc_html__('New Demo 20 - Photographer', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridgedb21' => array(
                'title' => esc_html__('New Demo 21 - Designer Portfolio', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridgedb22' => array(
                'title' => esc_html__('New Demo 22 - Tech Showcase', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer')
            ),
            'bridgedb23' => array(
                'title' => esc_html__('New Demo 23 - Metro Blog', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7', 'qode-instagram-widget')
            ),
            'bridgedb24' => array(
                'title' => esc_html__('New Demo 24 - Nature Blog', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7', 'qode-instagram-widget')
            ),
            'bridgedb25' => array(
                'title' => esc_html__('New Demo 25 - Modern Blog', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7', 'qode-instagram-widget')
            ),
            'bridgedb26' => array(
                'title' => esc_html__('New Demo 26 - Creative Blog', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridgedb27' => array(
                'title' => esc_html__('New Demo 27 - Minimal Blog', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridgedb28' => array(
                'title' => esc_html__('New Demo 28 - Fashion Blog', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7', 'qode-instagram-widget')
            ),
            'bridgedb29' => array(
                'title' => esc_html__('New Demo 29 - Lifestyle Blog', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridgedb30' => array(
                'title' => esc_html__('New Demo 30 - Chequered Blog', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7', 'qode-instagram-widget')
            ),
            'bridgedb31' => array(
                'title' => esc_html__('New Demo 31 - Headlines Blog', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridgedb32' => array(
                'title' => esc_html__('New Demo 32 - Tech Blog', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridgedb33' => array(
                'title' => esc_html__('New Demo 33 - Photography Parallax', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridgedb34' => array(
                'title' => esc_html__('New Demo 34 - Bauhaus', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridgedb35' => array(
                'title' => esc_html__('New Demo 35 - Illustrator', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridgedb36' => array(
                'title' => esc_html__('New Demo 36 - Maintenance Mode', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer')
            ),
            'bridgedb37' => array(
                'title' => esc_html__('New Demo 37 - Agency Minimal', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridgedb38' => array(
                'title' => esc_html__('New Demo 38 - Conference', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridgedb39' => array(
                'title' => esc_html__('New Demo 39 - 3D Artist', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridgedb40' => array(
                'title' => esc_html__('New Demo 40 - Developer', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7', 'qode-instagram-widget', 'qode-twitter-feed')
            ),
            'bridgedb41' => array(
                'title' => esc_html__('New Demo 41 - Web Agency', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridgedb42' => array(
                'title' => esc_html__('New Demo 42 - UX/UI Design', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer')
            ),
            'bridgedb43' => array(
                'title' => esc_html__('New Demo 43 - Digital', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridgedb44' => array(
                'title' => esc_html__('New Demo 44 - Product Showcase', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'woocommerce')
            ),
            'bridgedb45' => array(
                'title' => esc_html__('New Demo 45 - Sportswear', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7', 'woocommerce', 'qode-instagram-widget')
            ),
            'bridgedb46' => array(
                'title' => esc_html__('New Demo 46 - Interior Decoration', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7', 'woocommerce')
            ),
            'bridgedb47' => array(
                'title' => esc_html__('New Demo 47 - Boutique', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7', 'woocommerce', 'qode-instagram-widget')
            ),
            'bridgedb48' => array(
                'title' => esc_html__('New Demo 48 - Summer Shop', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7', 'woocommerce', 'qode-instagram-widget', 'qode-twitter-feed')
            ),
            'bridgedb49' => array(
                'title' => esc_html__('New Demo 49 - Furniture Shop', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7', 'woocommerce')
            ),
            'bridgedb50' => array(
                'title' => esc_html__('New Demo 50 - Leather Shop', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7', 'woocommerce', 'qode-instagram-widget')
            ),
            'bridgedb51' => array(
                'title' => esc_html__('New Demo 51 - Minimal Shop', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7', 'woocommerce')
            ),
            'bridgedb52' => array(
                'title' => esc_html__('New Demo 52 - Tiled Shop', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7', 'woocommerce')
            ),
            'bridgedb53' => array(
                'title' => esc_html__('New Demo 53 - Digital Startup', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridgedb54' => array(
                'title' => esc_html__('New Demo 54 - Skater', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7', 'woocommerce', 'qode-instagram-widget')
            ),
            'bridgedb55' => array(
                'title' => esc_html__('New Demo 55 - Bicycle Brand', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridgedb56' => array(
                'title' => esc_html__('New Demo 56 - Fashion Agency', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7', 'qode-instagram-widget')
            ),
            'bridgedb57' => array(
                'title' => esc_html__('New Demo 57 - Biker Club', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridgedb58' => array(
                'title' => esc_html__('New Demo 58 - Artist Portfolio', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7', 'woocommerce', 'qode-instagram-widget')
            ),
            'bridgedb59' => array(
                'title' => esc_html__('New Demo 59 - Hipster Agency', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7', 'qode-instagram-widget')
            ),
            'bridgedb60' => array(
                'title' => esc_html__('New Demo 60 - Barber', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7', 'qode-instagram-widget')
            ),
            'bridgedb61' => array(
                'title' => esc_html__('New Demo 61 - Photo Gallery', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridgedb62' => array(
                'title' => esc_html__('New Demo 62 - Skate Shop', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7', 'woocommerce', 'qode-instagram-widget')
            ),
            'bridgedb63' => array(
                'title' => esc_html__('New Demo 63 - Outdoors', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7', 'qode-instagram-widget')
            ),
            'bridgedb64' => array(
                'title' => esc_html__('New Demo 64 - Jazz Bar', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7', 'qode-instagram-widget')
            ),
            'bridgedb65' => array(
                'title' => esc_html__('New Demo 65 - Hosting', 'qode'),
                'rev-sliders' => array('home_slider.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7', 'qode-instagram-widget')
            ),
            'bridgedb66' => array(
                'title' => esc_html__('New Demo 66 - Architect Studio', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridgedb67' => array(
                'title' => esc_html__('New Demo 67 - Child Care', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridgedb68' => array(
                'title' => esc_html__('New Demo 68 - Startup', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridgedb69' => array(
                'title' => esc_html__('New Demo 69 - Resume', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridgedb70' => array(
                'title' => esc_html__('New Demo 70 - Law Firm', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridgedb71' => array(
                'title' => esc_html__('New Demo 71 - Organic Market', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridgedb72' => array(
                'title' => esc_html__('New Demo 72 - Watch Store', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7', 'woocommerce')
            ),
            'bridgedb73' => array(
                'title' => esc_html__('New Demo 73 - Travel Agency', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7', 'qode-instagram-widget')
            ),
            'bridgedb74' => array(
                'title' => esc_html__('New Demo 74 - Consulting', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridgedb75' => array(
                'title' => esc_html__('New Demo 75 - Yoga Studio', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridgedb76' => array(
                'title' => esc_html__('New Demo 76 - Spa Center', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridgedb77' => array(
                'title' => esc_html__('New Demo 77 - Modern Furniture', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7', 'woocommerce')
            ),
            'bridgedb78' => array(
                'title' => esc_html__('New Demo 78 - Church', 'qode'),
                'rev-sliders' => array('home-slider.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7', 'qode-instagram-widget', 'qode-twitter-feed', 'timetable')
            ),
            'bridgedb79' => array(
                'title' => esc_html__('New Demo 79 - Life Coach', 'qode'),
                'rev-sliders' => array('home-slider.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7' . 'revslider', 'qode-twitter-feed')
            ),
            'bridgedb80' => array(
                'title' => esc_html__('New Demo 80 - Crossfit', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7', 'qode-twitter-feed', 'timetable')
            ),
            'bridgedb81' => array(
                'title' => esc_html__('New Demo 81 - Mosque', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7', 'qode-twitter-feed', 'timetable')
            ),
            'bridgedb82' => array(
                'title' => esc_html__('New Demo 82 - Pet Sanctuary', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridgedb83' => array(
                'title' => esc_html__('New Demo 83 - Car Dealership', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridgedb84' => array(
                'title' => esc_html__('New Demo 84 - Business Consultant', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridgedb85' => array(
                'title' => esc_html__('New Demo 85 - University II', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7', 'qode-twitter-feed', 'timetable')
            ),
            'bridgedb86' => array(
                'title' => esc_html__('New Demo 86 - Dentist', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridgedb87' => array(
                'title' => esc_html__('New Demo 87 - Transport', 'qode'),
                'rev-sliders' => array('home-slider.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7')
            ),
            'bridgedb88' => array(
                'title' => esc_html__('New Demo 88 - Football', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7', 'qode-twitter-feed')
            ),
            'bridgedb89' => array(
                'title' => esc_html__('New Demo 89 - Vacation Rental', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridgedb90' => array(
                'title' => esc_html__('New Demo 90 - UI Design Company', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer')
            ),
            'bridgedb91' => array(
                'title' => esc_html__('New Demo 91 - City Listing', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7', 'qode-instagram-widget', 'qode-membership', 'qode-listing', 'woocommerce', 'wp-job-manager', 'wp-job-manager-locations')
            ),
            'bridgedb92' => array(
                'title' => esc_html__('New Demo 92 - Music Magazine', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7', 'qode-instagram-widget', 'qode-twitter-feed', 'qode-news')
            ),
            'bridgedb93' => array(
                'title' => esc_html__('New Demo 93 - Restaurant and Bar', 'qode'),
                'rev-sliders' => array('main-slider-n.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7', 'qode-restaurant')
            ),
            'bridgedb94' => array(
                'title' => esc_html__('New Demo 94 - Business Report', 'qode'),
                'rev-sliders' => array('annual-home-slider.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7')
            ),
            'bridgedb95' => array(
                'title' => esc_html__('New Demo 95 - Business Conference', 'qode'),
                'rev-sliders' => array('main-home.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7')
            ),
            'bridgedb96' => array(
                'title' => esc_html__('New Demo 96 - Global Business', 'qode'),
                'rev-sliders' => array('home-slider.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7')
            ),
            'bridgedb97' => array(
                'title' => esc_html__('New Demo 97 - Financial Business', 'qode'),
                'rev-sliders' => array('home-slider.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7')
            ),
            'bridgedb98' => array(
                'title' => esc_html__('New Demo 98 - Construction Showcase', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridgedb99' => array(
                'title' => esc_html__('New Demo 99 - Attorney', 'qode'),
                'rev-sliders' => array('mainhome.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7')
            ),
            'bridgedb100' => array(
                'title' => esc_html__('New Demo 100 - Clean Energy', 'qode'),
                'rev-sliders' => array('home-slider.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7')
            ),
            'bridgedb101' => array(
                'title' => esc_html__('New Demo 101 - Startup Summit', 'qode'),
                'rev-sliders' => array('home-slider.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7')
            ),
            'bridgedb102' => array(
                'title' => esc_html__('New Demo 102 - App Launch', 'qode'),
                'rev-sliders' => array('home.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7')
            ),
            'bridgedb103' => array(
                'title' => esc_html__('New Demo 103 - App Presentation', 'qode'),
                'rev-sliders' => array('home.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider')
            ),
            'bridgedb104' => array(
                'title' => esc_html__('New Demo 104 - Winter Sports', 'qode'),
                'rev-sliders' => array('home-slider.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7', 'qode-instagram-widget')
            ),
            'bridgedb105' => array(
                'title' => esc_html__('New Demo 105 - Smoothie Bar', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridgedb106' => array(
                'title' => esc_html__('New Demo 106 - Yoga Center', 'qode'),
                'rev-sliders' => array('home.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7', 'qode-instagram-widget', 'qode-twitter-feed', 'timetable')
            ),
            'bridgedb107' => array(
                'title' => esc_html__('New Demo 107 - Beer Showcase', 'qode'),
                'rev-sliders' => array('home-slider.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider')
            ),
            'bridgedb108' => array(
                'title' => esc_html__('New Demo 108 - Plumber', 'qode'),
                'rev-sliders' => array('home-slider.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7')
            ),
            'bridgedb109' => array(
                'title' => esc_html__('New Demo 109 - Hair Salon', 'qode'),
                'rev-sliders' => array('home.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7', 'qode-instagram-widget')
            ),
            'bridgedb110' => array(
                'title' => esc_html__('New Demo 110 - Freelancer', 'qode'),
                'rev-sliders' => array('home-slider.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7')
            ),
            'bridgedb111' => array(
                'title' => esc_html__('New Demo 111 - Bakery', 'qode'),
                'rev-sliders' => array('home.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7')
            ),
            'bridgedb112' => array(
                'title' => esc_html__('New Demo 112 - Running Club', 'qode'),
                'rev-sliders' => array('home-slider.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7')
            ),
            'bridgedb113' => array(
                'title' => esc_html__('New Demo 113 - Beauty Center', 'qode'),
                'rev-sliders' => array('home-slider.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7', 'qode-instagram-widget', 'qode-twitter-feed')
            ),
            'bridgedb114' => array(
                'title' => esc_html__('New Demo 114 - SEO Company', 'qode'),
                'rev-sliders' => array('home-slider.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7', 'qode-instagram-widget', 'qode-twitter-feed')
            ),
            'bridgedb115' => array(
                'title' => esc_html__('New Demo 115 - Babysitter', 'qode'),
                'rev-sliders' => array('home.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7')
            ),
            'bridgedb116' => array(
                'title' => esc_html__('New Demo 116 - Wedding Planner', 'qode'),
                'rev-sliders' => array('home.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7')
            ),
            'bridgedb117' => array(
                'title' => esc_html__('New Demo 117 - Florist', 'qode'),
                'rev-sliders' => array('home.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7', 'woocommerce')
            ),
            'bridgedb118' => array(
                'title' => esc_html__('New Demo 118 - Designer Expo', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridgedb119' => array(
                'title' => esc_html__('New Demo 119 - Music Festival', 'qode'),
                'rev-sliders' => array('home.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7')
            ),
            'bridgedb120' => array(
                'title' => esc_html__('New Demo 120 - Moving Company', 'qode'),
                'rev-sliders' => array('home.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7', 'qode-instagram-widget')
            ),
            'bridgedb121' => array(
                'title' => esc_html__('New Demo 121 - Burger Place', 'qode'),
                'rev-sliders' => array('home.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7')
            ),
            'bridgedb122' => array(
                'title' => esc_html__('New Demo 122 - Urban Dance', 'qode'),
                'rev-sliders' => array('home-slider.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7')
            ),
            'bridgedb123' => array(
                'title' => esc_html__('New Demo 123 - Vineyard', 'qode'),
                'rev-sliders' => array('home.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7')
            ),
            'bridgedb124' => array(
                'title' => esc_html__('New Demo 124 - Technology', 'qode'),
                'rev-sliders' => array('home.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7')
            ),
            'bridgedb125' => array(
                'title' => esc_html__('New Demo 125 - Pole Dance', 'qode'),
                'rev-sliders' => array('home-slider.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7', 'timetable')
            ),
            'bridgedb126' => array(
                'title' => esc_html__('New Demo 126 - Nightclub', 'qode'),
                'rev-sliders' => array('home-slider.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7')
            ),
            'bridgedb127' => array(
                'title' => esc_html__('New Demo 127 - Running', 'qode'),
                'rev-sliders' => array('home-slider.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7')
            ),
            'bridgedb128' => array(
                'title' => esc_html__('New Demo 128 - Orchestra', 'qode'),
                'rev-sliders' => array('home.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7')
            ),
            'bridgedb129' => array(
                'title' => esc_html__('New Demo 129 - Factory', 'qode'),
                'rev-sliders' => array('home-slider.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7')
            ),
            'bridgedb130' => array(
                'title' => esc_html__('New Demo 130 - Writer', 'qode'),
                'rev-sliders' => array('home.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7')
            ),
            'bridgedb131' => array(
                'title' => esc_html__('New Demo 131 - Museum', 'qode'),
                'rev-sliders' => array('home.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7')
            ),
            'bridgedb132' => array(
                'title' => esc_html__('New Demo 132 - Art Gallery', 'qode'),
                'rev-sliders' => array('home-slider.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7')
            ),
            'bridgedb133' => array(
                'title' => esc_html__('New Demo 133 - Medical', 'qode'),
                'rev-sliders' => array('home.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7', 'qode-instagram-widget', 'qode-twitter-feed')
            ),
            'bridgedb134' => array(
                'title' => esc_html__('New Demo 134 - Recording Studio', 'qode'),
                'rev-sliders' => array('home.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7', 'qode-instagram-widget')
            ),
            'bridgedb135' => array(
                'title' => esc_html__('New Demo 135 - Mountain Biking', 'qode'),
                'rev-sliders' => array('home-1.zip', 'home-content.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7', 'qode-instagram-widget')
            ),
            'bridgedb136' => array(
                'title' => esc_html__('New Demo 136 - Agriculture', 'qode'),
                'rev-sliders' => array('home.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7', 'qode-instagram-widget', 'qode-twitter-feed')
            ),
            'bridgedb137' => array(
                'title' => esc_html__('New Demo 137 - Coworking Space', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7')
            ),
            'bridgedb138' => array(
                'title' => esc_html__('New Demo 138 - Bar', 'qode'),
                'rev-sliders' => array('home-slider.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7')
            ),
            'bridgedb139' => array(
                'title' => esc_html__('New Demo 139 - Startup Company', 'qode'),
                'rev-sliders' => array('home.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7')
            ),
            'bridgedb140' => array(
                'title' => esc_html__('New Demo 140 - Frozen Yogurt', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridgedb141' => array(
                'title' => esc_html__('New Demo 141 - Video Production', 'qode'),
                'rev-sliders' => array('home-slider.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7')
            ),
            'bridgedb142' => array(
                'title' => esc_html__('New Demo 142 - Soap', 'qode'),
                'rev-sliders' => array('home.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7', 'woocommerce')
            ),
            'bridgedb143' => array(
                'title' => esc_html__('New Demo 143 - Movie', 'qode'),
                'rev-sliders' => array('home.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7')
            ),
            'bridgedb144' => array(
                'title' => esc_html__('New Demo 144 - Optician', 'qode'),
                'rev-sliders' => array('home-slider.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7', 'woocommerce')
            ),
            'bridgedb145' => array(
                'title' => esc_html__('New Demo 145 - Italian Restaurant', 'qode'),
                'rev-sliders' => array('home.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7', 'qode-restaurant')
            ),
            'bridgedb146' => array(
                'title' => esc_html__('New Demo 146 - Temple', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7')
            ),
            'bridgedb147' => array(
                'title' => esc_html__('New Demo 147 - Wedding Invitation', 'qode'),
                'rev-sliders' => array('home.zip', 'home-bottom.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7')
            ),
            'bridgedb148' => array(
                'title' => esc_html__('New Demo 148 - Hi-Fi', 'qode'),
                'rev-sliders' => array('home.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7')
            ),
            'bridgedb149' => array(
                'title' => esc_html__('New Demo 149 - Tea', 'qode'),
                'rev-sliders' => array('home.zip', 'home-content.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7', 'woocommerce')
            ),
            'bridgedb150' => array(
                'title' => esc_html__('New Demo 150 - Renewable Energy', 'qode'),
                'rev-sliders' => array('home.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7')
            ),
            'bridgedb151' => array(
                'title' => esc_html__('New Demo 151 - Laboratory', 'qode'),
                'rev-sliders' => array('home-slider.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7')
            ),
            'bridgedb152' => array(
                'title' => esc_html__('New Demo 152 - Business Consulting', 'qode'),
                'rev-sliders' => array('home.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7', 'qode-instagram-widget')
            ),
            'bridgedb153' => array(
                'title' => esc_html__('New Demo 153 - Fitness', 'qode'),
                'rev-sliders' => array('home.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7', 'timetable', 'qode-instagram-widget')
            ),
            'bridgedb154' => array(
                'title' => esc_html__('New Demo 154 - Interior Decor', 'qode'),
                'rev-sliders' => array('home.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7')
            ),
            'bridgedb155' => array(
                'title' => esc_html__('New Demo 155 - Pottery', 'qode'),
                'rev-sliders' => array('home-slider.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7', 'woocommerce')
            ),
            'bridgedb156' => array(
                'title' => esc_html__('New Demo 156 - Gardening', 'qode'),
                'rev-sliders' => array('home.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7')
            ),
            'bridgedb157' => array(
                'title' => esc_html__('New Demo 157 - Human Resources', 'qode'),
                'rev-sliders' => array('home.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7')
            ),
            'bridgedb158' => array(
                'title' => esc_html__('New Demo 158 - Wedding Invitation Card', 'qode'),
                'rev-sliders' => array('invitation.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider')
            ),
            'bridgedb159' => array(
                'title' => esc_html__('New Demo 159 - Candidate', 'qode'),
                'rev-sliders' => array('home-slider.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7', 'qode-instagram-widget')
            ),
            'bridgedb160' => array(
                'title' => esc_html__('New Demo 160 - Wildlife', 'qode'),
                'rev-sliders' => array('home.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7', 'qode-instagram-widget', 'qode-twitter-feed')
            ),
            'bridgedb161' => array(
                'title' => esc_html__('New Demo 161 - NGO', 'qode'),
                'rev-sliders' => array('home.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7')
            ),
            'bridgedb162' => array(
                'title' => esc_html__('New Demo 162 - Explorer', 'qode'),
                'rev-sliders' => array('home-slider.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7', 'qode-instagram-widget', 'qode-twitter-feed')
            ),
            'bridgedb163' => array(
                'title' => esc_html__('New Demo 163 - Psychotherapy', 'qode'),
                'rev-sliders' => array('home.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7')
            ),
            'bridgedb164' => array(
                'title' => esc_html__('New Demo 164 - Recipes', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7', 'qode-instagram-widget')
            ),
            'bridgedb165' => array(
                'title' => esc_html__('New Demo 165 - Nutritionist', 'qode'),
                'rev-sliders' => array('home.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7', 'qode-instagram-widget', 'qode-twitter-feed')
            ),
            'bridgedb166' => array(
                'title' => esc_html__('New Demo 166 - Bike Rental', 'qode'),
                'rev-sliders' => array('home-slider.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7')
            ),
            'bridgedb167' => array(
                'title' => esc_html__('New Demo 167 - Dental Clinic', 'qode'),
                'rev-sliders' => array('home.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7')
            ),
            'bridgedb168' => array(
                'title' => esc_html__('New Demo 168 - IT conference', 'qode'),
                'rev-sliders' => array('home.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7')
            ),
            'bridgedb169' => array(
                'title' => esc_html__('New Demo 169 - 3D Modeling', 'qode'),
                'rev-sliders' => array('home.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7')
            ),
            'bridgedb170' => array(
                'title' => esc_html__('New Demo 170 - Horse Riding', 'qode'),
                'rev-sliders' => array('home.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7', 'qode-instagram-widget')
            ),
            'bridgedb171' => array(
                'title' => esc_html__('New Demo 171 - Barbershop', 'qode'),
                'rev-sliders' => array('home.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7', 'qode-instagram-widget')
            ),
            'bridgedb172' => array(
                'title' => esc_html__('New Demo 172 - Loan Company', 'qode'),
                'rev-sliders' => array('home-slider.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7')
            ),
            'bridgedb173' => array(
                'title' => esc_html__('New Demo 173 - Architectural Firm', 'qode'),
                'rev-sliders' => array('home-slider.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7')
            ),
            'bridgedb174' => array(
                'title' => esc_html__('New Demo 174 - Web Studio', 'qode'),
                'rev-sliders' => array('home.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7', 'qode-instagram-widget', 'qode-twitter-feed')
            ),
            'bridgedb175' => array(
                'title' => esc_html__('New Demo 175 - Law Office', 'qode'),
                'rev-sliders' => array('home.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7')
            ),
            'bridgedb176' => array(
                'title' => esc_html__('New Demo 176 - Software Development', 'qode'),
                'rev-sliders' => array('home-slider.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7')
            ),
            'bridgedb177' => array(
                'title' => esc_html__('New Demo 177 - Gym', 'qode'),
                'rev-sliders' => array('home.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7', 'qode-instagram-widget', 'timetable')
            ),
            'bridgedb178' => array(
                'title' => esc_html__('New Demo 178 - Makeup Artist', 'qode'),
                'rev-sliders' => array('home1.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7', 'qode-instagram-widget', 'qode-twitter-feed')
            ),
            'bridgedb179' => array(
                'title' => esc_html__('New Demo 179 - Gaming', 'qode'),
                'rev-sliders' => array('home.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7')
            ),
            'bridgedb180' => array(
                'title' => esc_html__('New Demo 180 - Photographer Portfolio', 'qode'),
                'rev-sliders' => array('home-slider.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7')
            ),
            'bridgedb181' => array(
                'title' => esc_html__('New Demo 181 - Golf', 'qode'),
                'rev-sliders' => array('home.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7', 'qode-instagram-widget')
            ),
            'bridgedb182' => array(
                'title' => esc_html__('New Demo 182 - Laundry Service', 'qode'),
                'rev-sliders' => array('home-slider.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7')
            ),
            'bridgedb183' => array(
                'title' => esc_html__('New Demo 183 - Tiles', 'qode'),
                'rev-sliders' => array('home-slider.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7', 'woocommerce')
            ),
            'bridgedb184' => array(
                'title' => esc_html__('New Demo 184 - Handicraft', 'qode'),
                'rev-sliders' => array('home.zip', 'home-content'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7')
            ),
            'bridgedb185' => array(
                'title' => esc_html__('New Demo 185 - Casino', 'qode'),
                'rev-sliders' => array('home-slider.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7', 'qode-instagram-widget')
            ),
            'bridgedb186' => array(
                'title' => esc_html__('New Demo 186 - Airline', 'qode'),
                'rev-sliders' => array('home.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7')
            ),
            'bridgedb187' => array(
                'title' => esc_html__('New Demo 187 - Craft Beer Bar', 'qode'),
                'rev-sliders' => array('home-slider.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7', 'qode-instagram-widget', 'qode-twitter-feed')
            ),
            'bridgedb188' => array(
                'title' => esc_html__('New Demo 188 - Film Director', 'qode'),
                'rev-sliders' => array('home-slider.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7')
            ),
            'bridgedb189' => array(
                'title' => esc_html__('New Demo 189 - Tech Support', 'qode'),
                'rev-sliders' => array('home1.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7')
            ),
            'bridgedb190' => array(
                'title' => esc_html__('New Demo 190 - Kindergarten', 'qode'),
                'rev-sliders' => array('home.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7', 'qode-instagram-widget')
            ),
            'bridgedb191' => array(
                'title' => esc_html__('New Demo 191 - Tailor', 'qode'),
                'rev-sliders' => array('home.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7', 'qode-instagram-widget', 'qode-twitter-feed')
            ),
            'bridgedb192' => array(
                'title' => esc_html__('New Demo 192 - Sushi Bar', 'qode'),
                'rev-sliders' => array('home.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7', 'qode-restaurant')
            ),
            'bridgedb193' => array(
                'title' => esc_html__('New Demo 193 - Jewelry Store', 'qode'),
                'rev-sliders' => array(),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'contact-form-7', 'qode-instagram-widget', 'woocommerce')
            ),
            'bridgedb194' => array(
                'title' => esc_html__('New Demo 194 - Web Hosting', 'qode'),
                'rev-sliders' => array('home.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7')
            ),
            'bridgedb195' => array(
                'title' => esc_html__('New Demo 195 - University III', 'qode'),
                'rev-sliders' => array('home.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7', 'qode-instagram-widget')
            ),
            'bridgedb196' => array(
                'title' => esc_html__('New Demo 196 - Tattoo Studio', 'qode'),
                'rev-sliders' => array('home.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7', 'qode-instagram-widget')
            ),
            'bridgedb197' => array(
                'title' => esc_html__('New Demo 197 - vCard', 'qode'),
                'rev-sliders' => array('resume.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7')
            ),
            'bridgedb198' => array(
                'title' => esc_html__('New Demo 198 - Wristwatch Shop', 'qode'),
                'rev-sliders' => array('home-slider.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7', 'woocommerce')
            ),
            'bridgedb199' => array(
                'title' => esc_html__('New Demo 199 - Gift Shop', 'qode'),
                'rev-sliders' => array('home-slider.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7', 'woocommerce')
            ),
            'bridgedb200' => array(
                'title' => esc_html__('New Demo 200 - Language School', 'qode'),
                'rev-sliders' => array('home.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7')
            ),
            'bridgedb201' => array(
                'title' => esc_html__('New Demo 201 - Floristry', 'qode'),
                'rev-sliders' => array('home.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7', 'qode-instagram-widget')
            ),
            'bridgedb202' => array(
                'title' => esc_html__('New Demo 202 - Bicycle Shop', 'qode'),
                'rev-sliders' => array('home.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7', 'woocommerce', 'qode-instagram-widget')
            ),
            'bridgedb203' => array(
                'title' => esc_html__('New Demo 203 - Asian Cuisine', 'qode'),
                'rev-sliders' => array('home.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7', 'qode-instagram-widget')
            ),
            'bridgedb204' => array(
                'title' => esc_html__('New Demo 204 - Jazz Club', 'qode'),
                'rev-sliders' => array('home-slider.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7')
            ),
            'bridgedb205' => array(
                'title' => esc_html__('New Demo 205 - Animal Shelter', 'qode'),
                'rev-sliders' => array('home.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7')
            ),
            'bridgedb206' => array(
                'title' => esc_html__('New Demo 206 - Musician', 'qode'),
                'rev-sliders' => array('home1.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7')
            ),
            'bridgedb207' => array(
                'title' => esc_html__('New Demo 207 - Ecology', 'qode'),
                'rev-sliders' => array('home.zip'),
                'layer-sliders' => array(),
                'required-plugins' => array('js_composer', 'revslider', 'contact-form-7')
            )
        );

        return $demos;
    }

    public function import_content($file) {
        ob_start();
        $class_wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
        require_once($class_wp_importer);
        require_once(get_template_directory() . '/includes/import/class.wordpress-importer.php');
        $qode_import = new WP_Import();
        set_time_limit(0);
        $path = get_template_directory() . '/includes/import/files/' . $file;

        $qode_import->fetch_attachments = $this->attachments;
        $returned_value = $qode_import->import($file);
        if (is_wp_error($returned_value)) {
            $this->message = __("An Error Occurred During Import", "qode");
        } else {
            $this->message = __("Content imported successfully", "qode");
        }
        ob_get_clean();
    }

    public function import_widgets($file, $file2) {
        $this->import_custom_sidebars($file2);
        $options = $this->file_options($file);
        foreach ((array)$options['widgets'] as $qode_widget_id => $qode_widget_data) {
            update_option('widget_' . $qode_widget_id, $qode_widget_data);
        }
        $this->import_sidebars_widgets($file);
        $this->message = __("Widgets imported successfully", "qode");
    }

    public function import_sidebars_widgets($file) {
        $qode_sidebars = get_option("sidebars_widgets");
        unset($qode_sidebars['array_version']);
        $data = $this->file_options($file);
        if (is_array($data['sidebars'])) {
            $qode_sidebars = array_merge((array)$qode_sidebars, (array)$data['sidebars']);
            unset($qode_sidebars['wp_inactive_widgets']);
            $qode_sidebars = array_merge(array('wp_inactive_widgets' => array()), $qode_sidebars);
            $qode_sidebars['array_version'] = 2;
            wp_set_sidebars_widgets($qode_sidebars);
        }
    }

    public function import_custom_sidebars($file) {
        $options = $this->file_options($file);
        update_option('qode_sidebars', $options);
        $this->message = __("Custom sidebars imported successfully", "qode");
    }

    public function import_options($file) {
        $options = $this->file_options($file);
        update_option('qode_options_proya', $options);
        $this->message = __("Options imported successfully", "qode");
    }

    public function import_menus($file) {
        global $wpdb;
        $qode_terms_table = $wpdb->prefix . "terms";
        $this->menus_data = $this->file_options($file);
        $menu_array = array();
        foreach ($this->menus_data as $registered_menu => $menu_slug) {
            $term_rows = $wpdb->get_results("SELECT * FROM $qode_terms_table where slug='{$menu_slug}'", ARRAY_A);
            if (isset($term_rows[0]['term_id'])) {
                $term_id_by_slug = $term_rows[0]['term_id'];
            } else {
                $term_id_by_slug = null;
            }
            $menu_array[$registered_menu] = $term_id_by_slug;
        }
        set_theme_mod('nav_menu_locations', array_map('absint', $menu_array));

    }

    public function import_settings_pages($file) {
        $pages = $this->file_options($file);

        foreach ($pages as $qode_page_option => $qode_page_id) {
            update_option($qode_page_option, $qode_page_id);
        }
    }

    public function file_options($file) {
        $file_content = "";
        $file_for_import = get_template_directory() . '/includes/import/files/' . $file;
        /*if ( file_exists($file_for_import) ) {
			$file_content = $this->qode_file_contents($file_for_import);
		} else {
			$this->message = __("File doesn't exist", "qode");
		}*/
        $file_content = $this->qode_file_contents($file);
        if ($file_content) {
            $unserialized_content = unserialize(base64_decode($file_content));
            if ($unserialized_content) {
                return $unserialized_content;
            }
        }
        return false;
    }

    function qode_file_contents($path) {
        $url = $this->importURI . $path;
        $response = wp_remote_get($url);
        $body = wp_remote_retrieve_body($response);
        return $body;
    }

    public function create_rev_slider_files($folder) {
        $demos = $this->demos_import_list();
        $demo_folder = str_replace('/', '', $folder);
        $rev_list = $demos[$demo_folder]['rev-sliders'];
        $dir_name = $this->revSliderFolder;

        if(is_array($rev_list) && count($rev_list) > 0) {
            $upload = wp_upload_dir();
            $upload_dir = $upload['basedir'];
            $upload_dir = $upload_dir . '/' . $dir_name;
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0700);
                mkdir($upload_dir . '/' . $folder, 0700);
            }

            foreach ($rev_list as $rev_slider) {
                file_put_contents(WP_CONTENT_DIR . '/uploads/' . $dir_name . '/' . $folder . '/' . $rev_slider, file_get_contents($this->importURI . '/' . $folder . '/revslider/' . $rev_slider));
            }
        }
    }

    public function rev_slider_import($folder) {
        $this->create_rev_slider_files($folder);

        $demos = $this->demos_import_list();
        $demo_folder = str_replace('/', '', $folder);
        $rev_sliders = $demos[$demo_folder]['rev-sliders'];

        if(is_array($rev_sliders) && count($rev_sliders) > 0) {

            $dir_name = $this->revSliderFolder;
            $absolute_path = __FILE__;
            $path_to_file = explode('wp-content', $absolute_path);
            $path_to_wp = $path_to_file[0];

            require_once($path_to_wp . '/wp-load.php');
            require_once($path_to_wp . '/wp-includes/functions.php');
            require_once($path_to_wp . '/wp-admin/includes/file.php');

            $rev_slider_instance = new RevSlider();

            foreach ($rev_sliders as $rev_slider) {
                $nf = WP_CONTENT_DIR . '/uploads/' . $dir_name . '/' . $folder . '/' . $rev_slider;
                $rev_slider_instance->importSliderFromPost(true, true, $nf);
            }
        }
    }

    public function create_layer_slider_files($folder) {
        $demos = $this->demos_import_list();
        $demo_folder = str_replace('/', '', $folder);
        $layer_list = $demos[$demo_folder]['layer-sliders']['sliders'];
        $dir_name = $this->layerSliderFolder;

        $upload = wp_upload_dir();
        $upload_dir = $upload['basedir'];
        $upload_dir = $upload_dir . '/' . $dir_name;
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0700);
            mkdir($upload_dir . '/' . $folder, 0700);
        }

        foreach ($layer_list as $layer_slider) {
            file_put_contents(WP_CONTENT_DIR . '/uploads/' . $dir_name . '/' . $folder . '/' . $layer_slider, file_get_contents($this->importURI . '/' . $folder . '/layerslider/' . $layer_slider));
        }
    }

    public function layer_slider_import($folder) {
        $this->create_layer_slider_files($folder);

        $demos = $this->demos_import_list();
        $demo_folder = str_replace('/', '', $folder);
        $layer_sliders = $demos[$demo_folder]['layer-sliders']['sliders'];

        if(is_array($layer_sliders) && count($layer_sliders) > 0){

            $dir_name = $this->layerSliderFolder;

            include LS_ROOT_PATH . '/classes/class.ls.importutil.php';

            foreach ($layer_sliders as $layer_slider) {
                $nf = WP_CONTENT_DIR . '/uploads/' . $dir_name . '/' . $folder . '/' . $layer_slider;
                $import = new LS_ImportUtil($nf);
            }
        }
    }
}