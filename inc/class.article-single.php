<?php
class ArticleSingle extends Article
{
	public static function getCategoryRow( $excerpt, $category )
	{
		$out .= "<div class=\"article-table table-category\">";	
			//Title and category (with links to article and category)
			$out .= static::getTitleAndCategoryColumn( false );
			//category icon (with link to category)
			$out .= static::getCategoryIconColumn( $category );
			//
		$out .= "</div>";
		return $out;
	}

	public static function getNextPreviousPostRow()
	{
		$out .= "<div class=\"article-table table-nextprevpost\">";	
			//prev
			if( $prev_post = get_previous_post() ) {
				$out .= "<div class=\"article-col-icon\">";
				$out .= "<a prevnext-status-text=\"" . esc_attr( $prev_post->post_title ) . "\" title=\"Previous post\" href=\"" . get_permalink( $prev_post->ID ) . "\" class=\"icon icon-prev-post\">";
					$out .= "<i class=\"fa fa-lg fa-arrow-left\"></i>";
				$out .= "</a>";
				$out .= "</div>";
			} else {
				$out .= static::getBlankIconColumn();
			}
			
			//middle
			$out .= "<div prevnext-status-text-container=\"true\" class=\"article-col-middle\">";
			$out .= "</div>";
			//next
			if( $next_post = get_next_post() ) {
				$out .= "<div class=\"article-col-icon\">";
				$out .= "<a prevnext-status-text=\"" . esc_attr( $next_post->post_title ) . "\"  title=\"Next post\" href=\"" . get_permalink( $next_post->ID ) . "\" class=\"icon icon-next-post\">";
					$out .= "<i class=\"fa fa-lg fa-arrow-right\"></i>";
				$out .= "</a>";
				$out .= "</div>";
			} else {
				$out .= static::getBlankIconColumn();
			}
			//
		$out .= "</div>";
		return $out;
	}

	public static function compose( $echo = 1 )
	{
		$categories = get_the_category( );
		$category = $categories[ count($categories) - 1 ];
		$excerpt = get_the_excerpt();
		$out  = "<article is-extendable id=\"article-" . ( $article_id = get_the_id() ) . "\" class=\"article article-" . $article_id . "\">";
			$out .= static::getContentRow();
			$out .= static::getNextPreviousPostRow();
			$out .= static::getCategoryRow( $excerpt, $category );
			$out .= static::getTagsAndDateRow();
		$out .= "</article>";

		if( $echo ) {
			echo $out;
		}
		
		return $out;

	}
}

class ArticlePage extends ArticleSingle
{

}

?>