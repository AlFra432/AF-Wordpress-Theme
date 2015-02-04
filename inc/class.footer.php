<?php

class Footer
{
	public static function getBlankIconColumn( )
	{
		$out .= "<div class=\"article-col-icon\">";
		$out .= "</div>";
		return $out;
	}

	public static function getSocialIcon( $icon, $link, $title )
	{
		$out .= "<div class=\"footer-col-icon\">";
			$out .= "<a chosensocial-status-text=\"" . esc_attr( $title ) . "\" target=\"_blank\" title=\"" . esc_attr( $title ) . "\" href=\"" . esc_url( $link ) . "\" class=\"icon icon-social\">";
				$out .= "<i class=\"fa fa-lg fa-{$icon}\"></i>";
			$out .= "</a>";
		$out .= "</div>";
		return $out;
	}

	public static function getFooter( $echo = 0 )
	{
		$out  = "<footer class=\"footer footer-socials\">";
			$out .= "<div class=\"footer-table\">";
				//left - Nothing
				$out .= "<div chosensocial-status-text-container=\"true\" class=\"footer-col-middle\">";
				$out .= "</div>";
				$out .= static::getSocialIcon( "github", "//github.com/alfra432", "Visit my Github profile!");
				$out .= static::getSocialIcon( "twitter", "//twitter.com/alfra432", "Follow me on Twitter!");
				$out .= static::getSocialIcon( "info", "//about.aleksanderfras.com", "Something more about me!");
			$out .= "</div>";
		$out .= "</footer>";

		if( $echo ) {
			echo $out;
		}
		return $out;
	}
}

?>