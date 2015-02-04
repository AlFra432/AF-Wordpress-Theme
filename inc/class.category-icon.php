<?php
/*
 * Works with Font Awesome
*/
class CategoryIcon
{
	//Add categories and icons here
	public static $icons = array(
		  "general" => "fa fa-lg fa-bullseye"
		, "github" => "fa fa-lg fa-github"
		, "wordpress" => "fa fa-lg fa-wordpress"
		, "website" => "fa fa-lg fa-globe"
		, "javascript" => "fa fa-lg fa-code"
		, "php" => "fa fa-lg fa-code"
		, "joomla" => "fa fa-lg fa-joomla"
	);

	public static function getIconClass( $category_slug = "general" )
	{
		return 
			static::$icons[ $category_slug ]
			? static::$icons[ $category_slug ]
			: static::$icons[ "general" ]
			;
	}
}

?>