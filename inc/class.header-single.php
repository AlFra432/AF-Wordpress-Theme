<?php

class HeaderSingle extends Header
{
	public static function getLeftHeaderColumn( ) 
	{
		return parent::getLeftHeaderColumn( static::getHeaderImage( 1, 40, 0 ) );
	}

	public static function getMiddleHeaderColumn( )
	{
		$header_col_middle = "<h1>" . get_the_title() . "</h1>";
		return parent::getMiddleHeaderColumn( $header_col_middle );
	}

	public static function getFeaturedImageRow( )
	{
		return parent::getFeaturedImageRow( true );
	}

}

class HeaderPage extends HeaderSingle
{
	
}

?>