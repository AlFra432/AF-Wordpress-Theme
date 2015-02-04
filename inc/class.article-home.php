<?php

class ArticleHome extends Article
{
	public static function compose( $echo = 1 )
	{
		$categories = get_the_category( );
		$category = $categories[ count($categories) - 1 ];
		$excerpt = get_the_excerpt();
		$out  = "<article is-extendable id=\"article-" . ( $article_id = get_the_id() ) . "\" class=\"article article-" . $article_id . "\">";
			
			//Extend icon, title, category, and category icon
			$out .= "<div class=\"article-table\">";	
				//Extend icon
				$out .= "<div class=\"article-col-icon\">";
					if( $excerpt ) {
						$out .= "<a is-active=\"false\" prevent-default=\"true\" title=\"show excerpt\" href=\"#\" class=\"icon icon-plus\">";
							$out .= "+";
						$out .= "</a>";
					}
				$out .= "</div>";
				//Title and category (with links to article and category)
				$out .= "<div class=\"article-col-middle\">";
					$out .= static::getTitle( "h2", 1 );
					$out .= static::getCategory( 1, 0 );
				$out .= "</div>";
				//category icon (with link to category)
				$out .= "<div class=\"article-col-icon\">";
					$out .= "<a href=\"" . get_category_link( $category->cat_ID ) . "\" class=\"icon icon-category icon-category-{$category->slug}\">";
						$out .= "<i class=\"" . CategoryIcon::getIconClass( $category->slug ) . "\"></i>";
					$out .= "</a>";
				$out .= "</div>";
				//
			$out .= "</div>";

			if( $excerpt ) {
			//Excerpt or content
				$out .= "<div is-hidden=\"true\" class=\"article-table table-excerpt\">";
				//Blank column
					$out .= "<div class=\"article-col-icon\">";
					$out .= "</div>";
					//Excerpt
					$out .= "<div class=\"article-col-middle\">";
						$out .= static::getExcerpt();
					$out .= "</div>";
					//read more (with link to article)
					$out .= "<div class=\"article-col-icon valign-top\">";
						$out .= "<a title=\"Read More\" href=\"" . get_permalink() . "\" class=\"icon icon-read-more\">";
							$out .= "<i class=\"fa fa-lg fa-angle-double-right\"></i>";
						$out .= "</a>";
					$out .= "</div>";
					//
				$out .= "</div>";
			}

			//Tags and date - all hidden (even in no-js mode)
			$out .= "<div class=\"article-table table-tags\">";
				//tags (with links)
				$out .= "<div class=\"article-col-middle article-col-50 text-left\">";
					$out .= static::getTags( 1 );
				$out .= "</div>";
				//date with time
				$out .= "<div class=\"article-col-middle article-col-50 text-right\">";
					$out .= static::getDate( 1 );
				$out .= "</div>";
				//
			$out .= "</div>";
								

		$out .= "</article>";
		//


		if( $echo ) {
			echo $out;
		}
		
		return $out;

	}
}

?>