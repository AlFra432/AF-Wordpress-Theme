<?php 

class MainMenu
{
	public $menuName = "";
	public $menuObject = null;
	public $menuItemsAssociativeArray = null;
	public $menuItems = null;

	private function getMainMenu( $menu_name = "" )
	{
		$this->menuName 
			= $menu_name 
			? $menu_name
			: "main"
		;

		if( $this->menuObject = wp_get_nav_menu_object( $this->menuName ) ) {
			$this->menuItems = wp_get_nav_menu_items( $this->menuObject->slug );
		} else if( $menu_objects = wp_get_nav_menus() ) {
			$this->menuObject = $menu_objects[ count( $menu_objects ) - 1 ];
			$this->menuItems = wp_get_nav_menu_items( $this->menuObject->slug );
		} else {
			return;
		}

		foreach ( $this->menuItems as $item ) {
			$this->menuItemsAssociativeArray[ $item->ID ] = $item;
		}
		
	}

	public function __construct( $menu_name = "" )
	{
		$this->getMainMenu( $menu_name );
	}

	private function getDepth( $menu_item, $depth )
	{
		if( !$menu_item->menu_item_parent ) {
			return $depth;
		}

		return $this->getDepth( $this->menuItemsAssociativeArray[ $menu_item->menu_item_parent ], $depth + 1 );
		
	}

	public function getDropdownMenu()
	{
		if( !$this->menuItems ) {
			return;
		}

		$depth = 0;

		$out = "<select name=\"bla\" id=\"dropdown-menu-{$this->menuObject->term_id}\" class=\"dropdown-menu dropdown-menu-{$this->menuObject->term_id}\">";
		$out .= "<option disabled selected style=\"display:none;\">Menu</option>";
		
		foreach( $this->menuItems as $item ) {
			$depth = $this->getDepth( $item, 0 );
			$out .= "<option value=\"" . esc_url( $item->url ) . "\">" . str_repeat( "--", $depth ) . " " . $item->title  . "</option>";
		}

		$out .= "</select>";
		$out .= "<script>";
			$out .= "var dropdownmenu = document.getElementById(\"dropdown-menu-{$this->menuObject->term_id}\");";
			$out .= "dropdownmenu.onchange = function(val){window.location = dropdownmenu.value;}";
		$out .= "</script>";
		return $out;
	}

	public function getListMenu( $icon_name = "" )
	{
		
		if( !$this->menuItems ) {
			return;
		}
		$icon = "fa fa-lg fa-" . ( $icon_name ? $icon_name : "bars" );
		//var_dump($this->menuItems[0]);
		$list  = "<div is-active=\"false\" id=\"menu-main-container\" class=\"menu-container list-menu-container menu-{$this->menuObject->slug}-container\">";
		$list .= "<ul>";
		foreach ( $this->menuItems as $item ) {
			$depth = $this->getDepth( $item, 0 );
			$list .= "<li><a href=\"" . esc_url( $item->url ) . "\">";
				if( $item->object == "category" ) {
					$category = get_category( $item->object_id );
					//var_dump($category);
					$list .= str_repeat( "<span class=\"menu-item-icon menu-item-icon-empty\"></span>", $depth ) . "<span class=\"menu-item-icon icon-{$category->slug} ". CategoryIcon::getIconClass( $category->slug ) . "\"></span>";
				} else{
					$list .= str_repeat( "<span class=\"menu-item-icon menu-item-icon-empty\"></span>", $depth + 1 );
				}
				//$list .= "<span>" . $item->object_id . "</span>";
				$list .= "<span class=\"menu-item-text\">{$item->title}</span>";
			$list .= "</a></li>";
		}
		$list .= "</ul>";
		$list .= "</div>";

		$out
			= "<a is-active=\"false\" id=\"menu-main-activator\" prevent-default=\"true\" href=\"#\" class=\"icon icon-menu icon-menu-{$this->menuObject->slug}\">"
			. "<i class=\"{$icon}\"></i>"
			. "</a>"
			//. wp_nav_menu( array("echo" => false) )
			. $list
		;

		return $out;

	}
}

?>