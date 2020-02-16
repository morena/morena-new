<?php

include "qode.iconcollection.interface.php";
include "qode.fontawesome.php";
include "qode.fontelegant.php";
include "qode.lineaicons.php";
include "qode.dripicons.php";
/*
  Class: QodeIconCollections
  A class that initializes Qode Icon Collections
 */

class QodeIconCollections {

    private static $instance;
    public $iconCollections;
    public $VCParamsArray;
    public $iconPackParamName;

    private function __construct() {
        $this->iconPackParamName = 'icon_pack';
        $this->initIconCollections();
    }

    public static function getInstance() {

        if (null == self::$instance) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * Method that adds individual collections to set of collections
     */
    private function initIconCollections() {
        //name for Font Awesome needs to be icon because that was name for icon fields before we have added icon collections
        $this->addIconCollection('font_awesome', new QodeIconsFontAwesome("Font Awesome", "icon"));
        $this->addIconCollection('font_elegant', new QodeIconsFontElegant("Font Elegant", "fe_icon"));
        $this->addIconCollection('linea_icons', new QodeIconsFontLinea("Linea Icons", "linea_icon"));
        $this->addIconCollection('dripicons', new QodeIconsFontDripicons("Dripicons", "dripicon"));
    }

	public function getIconsMetaBoxOrOption($attributes) {
		$scope = '';
		$label = '';
		$parent = '';
		$name = '';
		$default_icon_pack = '';
		$default_icon = '';
		$type = '';
		$field_type = '';

		extract($attributes);

		$icon_hide_array = array();
		$icon_show_array = array();

		$icon_collections = $this->getCollectionsWithSocialIcons();
		$icon_collection_params = $this->getSocialIconCollectionsParams();
		if ($scope == 'regular') {
			$icon_collections = $this->getCollectionsWithIcons();
			$icon_collection_params = $this->getIconCollectionsParams();
		}else if ($scope == 'back-to-top') {
			$icon_collections = $this->getCollectionsWithBackToTopIcons();
			$icon_collection_params = $this->getBackToTopIconCollectionsParams();
		}
		foreach ($icon_collections as $dep_collection_key => $dep_collection_object) {
			$icon_hide_array[$dep_collection_key] = '';
			$icon_show_array[$dep_collection_key] = '#qodef_' . $name . '_' . $dep_collection_object->param . '_container';

			foreach ($icon_collection_params as $icon_collection_param) {
				if ($icon_collection_param !== $dep_collection_object->param) {
					$icon_hide_array[$dep_collection_key] .= '#qodef_' . $name . '_' . $icon_collection_param . '_container,';
				}
			}

			$icon_hide_array[$dep_collection_key] = rtrim($icon_hide_array[$dep_collection_key], ',');
		}

		$options = array(
			'font_awesome'      => esc_html__('Font Awesome', 'qode'),
			'font_elegant'      => esc_html__('Font Elegant', 'qode')
		);
		if ($scope == 'regular' || $scope == 'back-to-top') {
			$options = array(
				'font_awesome'      => esc_html__('Font Awesome', 'qode'),
				'font_elegant'      => esc_html__('Font Elegant', 'qode'),
				'linea_icons'       => esc_html__('Linea Icons', 'qode'),
				'dripicons'         => esc_html__('Dripicons', 'qode')
			);
		}

		if ($type == 'meta-box') {
			qode_add_meta_box_field(
				array(
					'parent'        => $parent,
					'type'          => 'select' . $field_type,
					'name'          => $name,
					'default_value' => $default_icon_pack,
					'label'         => $label,
					'options'       => $options,
					'args'          => array(
						'dependence' => true,
						'hide'       => $icon_hide_array,
						'show'       => $icon_show_array
					)
				)
			);
		} else if ($type == 'option') {
			qode_add_admin_field(
				array(
					'parent'        => $parent,
					'type'          => 'select' . $field_type,
					'name'          => $name,
					'default_value' => $default_icon_pack,
					'label'         => $label,
					'options'       => $options,
					'args'          => array(
						'dependence' => true,
						'hide'       => $icon_hide_array,
						'show'       => $icon_show_array
					)
				)
			);
		}

		foreach ($icon_collections as $collection_key => $collection_object) {
			if ($scope == 'regular') {
				$icons_array = $collection_object->getIconsArray();
			} else if ($scope == 'back-to-top') {
				$icons_array = $collection_object->getBackToTopIconsArray();
			} else {
				$icons_array = $collection_object->getSocialIconsArray();
			}

			$icon_collections_keys = array_keys($icon_collections);

			unset($icon_collections_keys[array_search($collection_key, $icon_collections_keys)]);

			$qode_icon_hide_values = $icon_collections_keys;

			$qode_icon_pack_container = qode_add_admin_container(
				array(
					'parent'          => $parent,
					'name'            => $name . '_' . $collection_object->param . '_container',
					'hidden_property' => $name,
					'hidden_value'    => '',
					'hidden_values'   => $qode_icon_hide_values,
					'simple'          => $field_type == 'simple' ? true : false
				)
			);

			if ($type == 'meta-box') {
				qode_add_meta_box_field(
					array(
						'parent'        => $qode_icon_pack_container,
						'type'          => 'select' . $field_type,
						'name'          => $name . '_' . $collection_object->param,
						'default_value' => $default_icon,
						'label'         => $collection_object->title,
						'options'       => $icons_array
					)
				);
			} else if ($type == 'option') {
				qode_add_admin_field(
					array(
						'parent'        => $qode_icon_pack_container,
						'type'          => 'select' . $field_type,
						'name'          => $name . '_' . $collection_object->param,
						'default_value' => $default_icon,
						'label'         => $collection_object->title,
						'options'       => $icons_array
					)
				);
			}
		}
	}

    public function getVCParamsArray($iconPackDependency = array(), $iconCollectionPrefix = "", $emptyIconPack = false) {
        if ($emptyIconPack) {
            $iconCollectionsVC = $this->getIconCollectionsVCEmpty();
        } else {
            $iconCollectionsVC = $this->getIconCollectionsVC();
        }

        $iconPackParams = array(
            "type" => "dropdown",
            "class" => "",
            "heading" => "Icon pack",
            "param_name" => $this->iconPackParamName,
            "value" => $iconCollectionsVC,
            "description" => ""
        );

        if ($iconPackDependency !== "") {
            $iconPackParams["dependency"] = $iconPackDependency;
        }

        $iconPackParams = array($iconPackParams);

        $iconSetParams = array();
        if (is_array($this->iconCollections) && count($this->iconCollections)) {
            foreach ($this->iconCollections as $key => $collection) {
                $iconSetParams[] = array(
                    "type" => "dropdown",
                    "class" => "",
                    "heading" => "Icon",
                    "param_name" => $iconCollectionPrefix . $collection->param,
                    "value" => $collection->getIconsArray(),
                    "description" => "",
                    "dependency" => array('element' => $this->iconPackParamName, 'value' => array($key))
                );
            }
        }

        return array_merge($iconPackParams, $iconSetParams);
    }

    public function getSocialVCParamsArray($iconPackDependency = array(), $iconCollectionPrefix = "", $emptyIconPack = false, $exclude = '') {
        if ($emptyIconPack) {
            $iconCollectionsVC = $this->getIconCollectionsVCEmptyExclude($exclude);
        } else {
            $iconCollectionsVC = $this->getIconCollectionsVCExclude($exclude);
        }


        $iconPackParams = array(
            "type" => "dropdown",
            "class" => "",
            "heading" => "Icon pack",
            "param_name" => $this->iconPackParamName,
            "value" => $iconCollectionsVC,
            "description" => ""
        );

        if ($iconPackDependency !== "") {
            $iconPackParams["dependency"] = $iconPackDependency;
        }

        $iconPackParams = array($iconPackParams);

        $iconCollections = $this->iconCollections;
        if(is_array($exclude) && count($exclude)) {
            foreach ($exclude as $exclude_key) {
                if  (array_key_exists($exclude_key, $this->iconCollections)) {

                    unset($iconCollections[$exclude_key]);
                }
            }

        } else {
            if  (array_key_exists($exclude, $this->iconCollections)) {
                unset($iconCollections[$exclude]);
            }
        }

        $iconSetParams = array();
        if (is_array($iconCollections) && count($iconCollections)) {
            foreach ($iconCollections as $key => $collection) {
                $iconSetParams[] = array(
                    "type" => "dropdown",
                    "class" => "",
                    "heading" => "Icon",
                    "param_name" => $iconCollectionPrefix . $collection->param,
                    "value" => $collection->getSocialIconsArrayVC(),
                    "description" => "",
                    "dependency" => array('element' => $this->iconPackParamName, 'value' => array($key))
                );
            }
        }

        return array_merge($iconPackParams, $iconSetParams);
    }


	public function getCollectionsWithIcons() {
		$collectionsWithIcons = array();

		foreach ($this->iconCollections as $key => $collection) {
			$collectionsWithIcons[$key] = $collection;
		}

		return $collectionsWithIcons;
	}

	public function getCollectionsWithSocialIcons() {
		$collectionsWithSocial = array();

		foreach ($this->iconCollections as $key => $collection) {
			if ($collection->hasSocialIcons()) {
				$collectionsWithSocial[$key] = $collection;
			}
		}

		return $collectionsWithSocial;
	}

	public function getCollectionsWithBackToTopIcons() {
		$collectionsWithBackToTop = array();

		foreach ($this->iconCollections as $key => $collection) {
			if ($collection->hasBackToTopIcons()) {
				$collectionsWithBackToTop[$key] = $collection;
			}
		}

		return $collectionsWithBackToTop;
	}

    public function getIconSizesArray() {
        return array(
            "Tiny" => "fa-lg",
            "Small" => "fa-2x",
            "Medium" => "fa-3x",
            "Large" => "fa-4x",
            "Very Large" => "fa-5x"
        );
    }

    public function getIconSizeClass($iconSize) {
        switch ($iconSize) {
            case "fa-lg":
                $iconSize = "qode_tiny_icon";
                break;
            case "fa-2x":
                $iconSize = "qode_small_icon";
                break;
            case "fa-3x":
                $iconSize = "qode_medium_icon";
                break;
            case "fa-4x":
                $iconSize = "qode_large_icon";
                break;
            case "fa-5x":
                $iconSize = "qode_huge_icon";
                break;
            default:
                $iconSize = "qode_small_icon";
        }

        return $iconSize;
    }

	public function getIconCollectionParamNameByKey($key) {
		$collection = $this->getIconCollection($key);

		if($collection) {
			return $collection->param;
		}

		return false;
	}

    public function getShortcodeParams($iconCollectionPrefix = "") {
        $iconCollectionsParam = array();
        foreach ($this->iconCollections as $key => $collection) {
            $iconCollectionsParam[$iconCollectionPrefix . $collection->param] = '';
        }

        return array_merge(array($this->iconPackParamName => '',), $iconCollectionsParam);
    }

    public function addIconCollection($key, $value) {
        $this->iconCollections[$key] = $value;
    }

    public function getIconCollection($key) {
        if (array_key_exists($key, $this->iconCollections)) {
            return $this->iconCollections[$key];   
        }
        return false;
            
    }

    public function getIconCollectionIcons(iIconCollection $collection) {
        return $collection->getIconsArray();
    }

    public function getIconCollectionsVC() {
        $vc_array = array();
        foreach ($this->iconCollections as $key => $collection) {
            $vc_array[$collection->title] = $key;
        }
        return $vc_array;
    }

    public function getIconCollectionsVCExclude($exclude) {
        $array = $this->getIconCollectionsVC();

        if(is_array($exclude) && count($exclude)) {
            foreach ($exclude as $key) {
                if(($x = array_search($key, $array)) !== false) {
                    unset($array[$x]);
                }
            }

        } else {
            if(($x = array_search($exclude, $array)) !== false) {
                unset($array[$x]);
            }
        }


        return $array;
    }

    public function getIconCollectionsKeys() {
        return array_keys($this->iconCollections);
    }

    /**
     * Method that returns an array of 'param' attribute of each icon collection
     * @return array array of param attributes
     */
    public function getIconCollectionsParams() {
        $paramArray = array();
        if(is_array($this->iconCollections) && count($this->iconCollections)) {
            foreach ($this->iconCollections as $key => $obj) {
                $paramArray[] = $obj->param;
            }
        }

        return $paramArray;
    }
	/**
	 * Method that returns an array of 'param' attribute of each icon collection with social icons
	 * @return array array of param attributes
	 */
	public function getSocialIconCollectionsParams() {
		$paramArray = array();
		if (is_array($this->getCollectionsWithSocialIcons()) && count($this->getCollectionsWithSocialIcons())) {
			foreach ($this->getCollectionsWithSocialIcons() as $key => $obj) {
				$paramArray[] = $obj->param;
			}
		}
		return $paramArray;
	}

	public function getBackToTopIconCollectionsParams() {
		$paramArray = array();
		if (is_array($this->getCollectionsWithBackToTopIcons()) && count($this->getCollectionsWithBackToTopIcons())) {
			foreach ($this->getCollectionsWithBackToTopIcons() as $key => $obj) {
				$paramArray[] = $obj->param;
			}
		}
		return $paramArray;
	}
    public function getIconCollections() {
        $array = array();
        foreach ($this->iconCollections as $key => $collection) {
            $array[$key] = $collection->title;
        }
        return $array;
    }

    public function getIconCollectionsEmpty($no_empty_key = "") {
        $array = array();
        $array[$no_empty_key] = "No Icon";
        foreach ($this->iconCollections as $key => $collection) {
            $array[$key] = $collection->title;
        }

        return $array;
    }

    public function getIconCollectionsVCEmpty() {
        $vc_array = array();
        $vc_array["No Icon"] = "";
        foreach ($this->iconCollections as $key => $collection) {
            $vc_array[$collection->title] = $key;
        }
        return $vc_array;
    }

    public function getIconCollectionsVCEmptyExclude($key) {
        $array = $this->getIconCollectionsVCEmpty();
        if  (($x = array_search($key, $array)) !== false) {
            unset($array[$x]);
        }
        return $array;
    }

    public function getIconCollectionsExclude($exclude) {
        $array = $this->getIconCollections();

        if(is_array($exclude) && count($exclude)) {
            foreach ($exclude as $exclude_key) {
                if(array_key_exists($exclude_key, $array)) {
                    unset($array[$exclude_key]);
                }
            }

        } else {
            if  (array_key_exists($exclude, $array)) {
                unset($array[$exclude]);
            }
        }

        return $array;
    }

    public function hasIconCollection($key) {

        return array_key_exists($key, $this->iconCollections);

    }

    public function enqueueStyles() {
        if(is_array($this->iconCollections) && count($this->iconCollections)) {
            foreach($this->iconCollections as $collection_key => $collection_obj) {
                wp_enqueue_style('qode_'.$collection_key, $collection_obj->styleUrl);
            }
        }
    }


    # HEADER AND SIDE MENU ICONS
    public function getSearchIcon($iconPack, $params = array()) {

        if ($this->hasIconCollection($iconPack)) {
            $iconsObject = $this->getIconCollection($iconPack);
            print $iconsObject->getSearchIcon($params);
        }

    }

    public function getSearchClose($iconPack, $params = array()) {
        if ($this->hasIconCollection($iconPack)) {
            $iconsObject = $this->getIconCollection($iconPack);
            print $iconsObject->getSearchClose($params);
        }
    }

    public function getSearchIconValue($iconPack) {

        if ($this->hasIconCollection($iconPack)) {

            $iconsObject = $this->getIconCollection($iconPack);
            print $iconsObject->getSearchIconValue();

        }

    }

    public function getMenuSideIcon($iconPack) {

        if ($this->hasIconCollection($iconPack)) {

            $iconsObject = $this->getIconCollection($iconPack);
            print $iconsObject->getMenuSideIcon();

        }

    }

    public function getBackToTopIcon($iconPack) {

        if ($this->hasIconCollection($iconPack)){

            $iconsObject = $this->getIconCollection($iconPack);
            print $iconsObject->getBackToTopIcon();

        }


    }

    public function getMobileMenuIcon($iconPack) {

        if($this->hasIconCollection($iconPack)) {

            $iconsObject = $this->getIconCollection($iconPack);
            print $iconsObject->getMobileMenuIcon();

        }

    }

    public function getQuoteIcon($iconPack, $return = false) {

        if($this->hasIconCollection($iconPack)) {

            $iconsObject = $this->getIconCollection($iconPack);
            if($return == true){
                return $iconsObject->getQuoteIcon();
            }
            else{
                print $iconsObject->getQuoteIcon();
            }

        }

    }


    # SOCIAL SIDEBAR ICONS
    public function getFacebookIcon($iconPack) {

        if ($this->hasIconCollection($iconPack)) {

            $iconsObject = $this->getIconCollection($iconPack);
            return $iconsObject->getFacebookIcon();

        }

    }

    public function getTwitterIcon($iconPack) {

        if ($this->hasIconCollection($iconPack)) {

            $iconsObject = $this->getIconCollection($iconPack);
            return $iconsObject->getTwitterIcon();

        }

    }

    public function getGooglePlusIcon($iconPack) {

        if ($this->hasIconCollection($iconPack)) {

            $iconsObject = $this->getIconCollection($iconPack);
            return $iconsObject->getGooglePlusIcon();

        }

    }

    public function getLinkedInIcon($iconPack) {

        if ($this->hasIconCollection($iconPack)) {

            $iconsObject = $this->getIconCollection($iconPack);
            return $iconsObject->getLinkedInIcon();

        }

    }

    public function getTumblrIcon($iconPack) {

        if ($this->hasIconCollection($iconPack)) {

            $iconsObject = $this->getIconCollection($iconPack);
            return $iconsObject->getTumblrIcon();

        }

    }

    public function getPinterestIcon($iconPack) {

        if ($this->hasIconCollection($iconPack)) {

            $iconsObject = $this->getIconCollection($iconPack);
            return $iconsObject->getPinterestIcon();

        }

    }

    public function getVKIcon($iconPack) {

        if ($this->hasIconCollection($iconPack)) {

            $iconsObject = $this->getIconCollection($iconPack);
            return $iconsObject->getVKIcon();

        }

    }

	public function getSocialShareIcon($iconPack) {
		if ($this->hasIconCollection($iconPack)) {
			$iconsObject = $this->getIconCollection($iconPack);
			return $iconsObject->getSocialShareIcon();
		}
	}

    public function getIconHTML($icon, $iconPack, $iconParams = array()) {
        if($this->hasIconCollection($iconPack)) {
            $iconCollection = $this->getIconCollection($iconPack);
            if($iconCollection) {
                return $iconCollection->render($icon, $iconParams);
            }
        }

        return false;
    }

    public function renderIconHTML($icon, $iconPack, $iconParams = array()) {
        echo $this->getIconHTML($icon, $iconPack, $iconParams);
    }
}

global $qodeIconCollections;
$qodeIconCollections = QodeIconCollections::getInstance();
