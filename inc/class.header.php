<?php

class Header {
	public static function getHeaderImage( $enable_link = 1, $width = 250 ) 
	{

		if( $enable_link ) {
			$a_before = "<a href=\"" . home_url() . "\">";
			$a_after  = "</a>";
		}

		if( !( $img_src = get_header_image() ) ){
			$img_src = AFLOGO;
		}
		
		$out = $a_before . "<img src=\"{$img_src}\" id=\"logo\" width=\"{$width}\" alt=\"Logo\">" . $a_after;

		return $out;

	}

	public static function getLeftHeaderColumn( $header_col_left = "" ) 
	{
		$out .= "<div class=\"hidden-cell-sm header-col-icon\">";
			$out .= $header_col_left;
		$out .= "</div>";
		return $out;
	}

	public static function getMiddleHeaderColumn( $header_col_middle = "" )
	{
		$out .= "<div class=\"header-col-middle\">";
			$out .= $header_col_middle ? $header_col_middle : static::getHeaderImage( 1, 250, 0 );
		$out .= "</div>";
		return $out;
	}

	public static function getRightHeaderColumn( $header_col_right = "" )
	{
		$out .= "<div class=\"hidden-cell-sm header-col-icon\">";
			$out .= $header_col_right ? $header_col_right : ( new MainMenu() )->getListMenu();
		$out .= "</div>";
		return $out;
	}

	public static function getDropdownMenuHeader()
	{
		$out .= "<header class=\"visible-sm header header-menu\">";
			$out .= ( new MainMenu() )->getDropdownMenu();
		$out .= "</header>";
		return $out;
	}

	public static function getFeaturedImageRow( $enable_featured_image = false )
	{
		if( $enable_featured_image && has_post_thumbnail() )
		{
			$out .= "<header class=\"header header-featured-image\">";
					$out .= get_the_post_thumbnail( 
						  get_the_ID()
						, 'full'
					);
			$out .= "</header>";
		}
		return $out;
	}

	public static function getHeader( $echo = 0 )
	{
		//Header Logo
		$out  = "<header class=\"header header-logo\">";
			$out .= "<div class=\"header-table\">";
				//left - Nothing
				$out .= static::getLeftHeaderColumn();
				//middle - header image
				$out .= static::getMiddleHeaderColumn();
				//right - menu
				$out .= static::getRightHeaderColumn();
			$out .= "</div>";
		$out .= "</header>";
		//Header Menu
		//visible on small devices
		$out .= static::getDropdownMenuHeader();
		$out .= static::getFeaturedImageRow();
		if( $echo ) {
			echo $out;
		}
		return $out;
	}
}

?>