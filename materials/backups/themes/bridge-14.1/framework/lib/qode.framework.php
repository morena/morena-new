<?php
/*
   Class: QodeFramework
   A class that initializes Qode Framework
*/
class QodeFramework {

    private static $instance;
    public $qodeOptions;
    public $qodeMetaBoxes;
    public $qodeTaxonomyOptions;

    private function __construct() {
        $this->qodeOptions = QodeOptions::get_instance();
        $this->qodeMetaBoxes = QodeMetaBoxes::get_instance();
        $this->qodeTaxonomyOptions = QodeTaxonomyOptions::get_instance();
    }
    
		public static function get_instance() {
		
			if ( null == self::$instance ) {
				self::$instance = new self;
			}
		
			return self::$instance;
		
		}
}

/*
   Class: QodeOptions
   A class that initializes Qode Options
*/
class QodeOptions {

    private static $instance;
    public $adminPages;
    public $options;
    public $optionsByType;

    private function __construct() {
        $this->adminPages = array();
        $this->options = array();
    }
    
		public static function get_instance() {
		
			if ( null == self::$instance ) {
				self::$instance = new self;
			}
		
			return self::$instance;
		
		}

    public function addAdminPage($key, $page) {
        $this->adminPages[$key] = $page;
    }

    public function getAdminPage($key) {
        return $this->adminPages[$key];
    }

    public function adminPageExists($key) {
        return array_key_exists($key, $this->adminPages);
    }

    public function getAdminPageFromSlug($slug) {
        foreach ($this->adminPages as $key=>$page ) {
            if ($page->slug == $slug)
                return $page;
        }
        return;
    }

    public function addOption($key, $value, $type = '') {
        $this->options[$key] = $value;

        $this->addOptionByType($type, $key);
    }

    public function getOption($key) {
        if(isset($this->options[$key])) {
            return $this->options[$key];
        }
        return;
    }

    public function addOptionByType($type, $key) {
        $this->optionsByType[$type][] = $key;
    }

    public function getOptionsByType($type) {
        if(array_key_exists($type, $this->optionsByType)) {
            return $this->optionsByType[$type];
        }
        return array();
    }

    public function getOptionValue($key) {
        global $qode_options_proya;

        if(is_array($qode_options_proya) && array_key_exists($key, $qode_options_proya)) {
            return $qode_options_proya[$key];
        } elseif(array_key_exists($key, $this->options)) {
            return $this->getOption($key);
        }

        return false;
    }
}

/*
   Class: QodeAdminPage
   A class that initializes Qode Admin Page
*/
class QodeAdminPage implements iLayoutNode {

    public $layout;
		private $factory;
		public $slug;
		public $title;

    function __construct($slug = "", $title = "", $icon = "") {
        $this->layout = array();
        $this->factory = new QodeFieldFactory();
        $this->slug = $slug;
        $this->title = $title;
        $this->icon = $icon;
    }

    public function hasChidren() {
        return (count($this->layout) > 0)?true:false;
    }

    public function getChild($key) {
        return $this->layout[$key];
    }

    public function addChild($key, $value) {
        $this->layout[$key] = $value;
    }

    function render() {
        foreach ($this->layout as $child) {
            $this->renderChild($child);
        }
    }

    public function renderChild(iRender $child) {
        $child->render($this->factory);
    }
}

/*
   Class: QodeMetaBoxes
   A class that initializes Qode Meta Boxes
*/
class QodeMetaBoxes {

    private static $instance;
    public $metaBoxes;
    public $options;
	public $optionsByType;

    private function __construct() {
        $this->metaBoxes = array();
        $this->options = array();
		$this->optionsByType = array();
    }
    
		public static function get_instance() {
		
			if ( null == self::$instance ) {
				self::$instance = new self;
			}
		
			return self::$instance;
		
		}

    public function addMetaBox($key, $box) {
        $this->metaBoxes[$key] = $box;
    }

    public function getMetaBox($key) {
        return $this->metaBoxes[$key];
    }

    public function addOption($key, $value, $type = '') {
        $this->options[$key] = $value;
		$this->addOptionByType($type, $key);
    }

    public function getOption($key) {
			if(isset($this->options[$key]))
        return $this->options[$key];
      return;
    }

	public function addOptionByType($type, $key) {
		$this->optionsByType[$type][] = $key;
	}

	public function getOptionsByType($type) {

		if(array_key_exists($type, $this->optionsByType)) {
			return $this->optionsByType[$type];
		}

		return array();
	}

	public function getMetaBoxesByScope( $scope ) {
		$boxes = array();

		if ( is_array( $this->metaBoxes ) && count( $this->metaBoxes ) ) {
			foreach ( $this->metaBoxes as $metabox ) {
				if ( is_array( $metabox->scope ) && in_array( $scope, $metabox->scope ) ) {
					$boxes[] = $metabox;
				} elseif ( $metabox->scope !== '' && $metabox->scope === $scope ) {
					$boxes[] = $metabox;
				}
			}
		}

		return $boxes;
	}

}

/*
   Class: QodeMetaBox
   A class that initializes Qode Meta Box
*/
class QodeMetaBox implements iLayoutNode {

    public $layout;
	private $factory;
	public $scope;
	public $title;
	public $hidden_property;
	public $hidden_values = array();
	public $name;

    function __construct($scope="", $title="",$hidden_property="", $hidden_values = array(), $name = '') {
        $this->layout = array();
		$this->factory = new QodeFieldFactory();
		$this->scope = $scope;
		$this->title = $title;
		$this->hidden_property = $hidden_property;
		$this->hidden_values = $hidden_values;
		$this->name            = $name;
    }

    public function hasChidren() {
        return (count($this->layout) > 0)?true:false;
    }

    public function getChild($key) {
        return $this->layout[$key];
    }

    public function addChild($key, $value) {
        $this->layout[$key] = $value;
    }

    function render() {
        foreach ($this->layout as $child) {
            $this->renderChild($child);
        }
    }

    public function renderChild(iRender $child) {
        $child->render($this->factory);
    }
}

/*
   Class: QodeTaxonomyOptions
   A class that initializes Qode Taxonomy Options
*/
class QodeTaxonomyOptions {

	private static $instance;
	public $taxonomyOptions;

	private function __construct() {
		$this->taxonomyOptions = array();
	}

	public static function get_instance() {

		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;

	}

	public function addTaxonomyOptions($key, $options) {
		$this->taxonomyOptions[$key] = $options;
	}

	public function getTaxonomyOptions($key) {
		return $this->taxonomyOptions[$key];
	}
}


/*
   Class: QodeTaxonomyOption
   A class that initializes Qode Taxonomy Option
*/
class QodeTaxonomyOption implements iLayoutNode{
	public $layout;
	private $factory;
	public $scope;

	function __construct($scope="") {
		$this->layout = array();
		$this->factory = new QodeTaxonomyFieldFactory();
		$this->scope = $scope;
	}

	public function hasChidren() {
		return (count($this->layout) > 0)?true:false;
	}

	public function getChild($key) {
		return $this->layout[$key];
	}

	public function addChild($key, $value) {
		$this->layout[$key] = $value;
	}

	function render() {
		foreach ($this->layout as $child) {
			$this->renderChild($child);
		}
	}

	public function renderChild(iRender $child) {
		$child->render($this->factory);
	}
}

global $qodeFramework;
$qodeFramework = QodeFramework::get_instance();