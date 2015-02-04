<?php
class Article
{

	public static function getTitle( $heading = "h2", $enable_link = 0 )
	{
		if( $enable_link ) {
			$a_before = "<a class=\"link-title\" href=\"" . get_permalink() . "\">";
			$a_after = "</a>";
		}
		
		$out = "<{$heading} class=\"article-title\">" . $a_before . get_the_title( ) . $a_after . "</{$heading}>";
		if( $echo ) {
			echo $out;
		}

		return $out;
	} 

	public static function getCategory( $enable_link = 0 ) 
	{
		$categories = get_the_category( );
		$cat_out = array( );
		//var_dump(get_the_category( ));
		if( $enable_link ) {
			foreach( $categories as $category ) {
				array_push( $cat_out,
					  "<a class=\"link-category\" href=\"" . get_category_link( $category->cat_ID ) . "\">"
					. $category->cat_name
					. "</a>"
				);
			}
		} else {
			foreach( $categories as $category ) {
				array_push( $cat_out, $category->cat_name );
			}
		}

		$out = "<div class=\"article-category\">" . join( "<span> </span><span class=\"fa fa-angle-right\"></span><span> </span>", $cat_out ) . "</div>";

		return $out;
	}

	private function getContent( ) 
	{
		$out =  "<div class=\"article-content\"><p class=\"content-paragraph\">" . get_the_content( ) . "</p></div>";

		return $out;
	}

	public static function getExcerpt( )
	{
		$out = "<div class=\"article-excerpt\"><p class=\"content-paragraph\">" . get_the_excerpt() . "</p></div>";
		
		return $out;
	}

	public static function getTags( $enable_links = 0 )
	{
		if( !( $tagList = get_the_tags() ) ) {
			return "";
		}
		$tags = array();
		$out = "<div class=\"article-tags\"><ul class=\"tag-list\">";
		foreach( $tagList as $tag ) {
			if( $enable_links ) {
				//term_taxonomy_id
				$a_front = "<a href=\"" . get_tag_link( $tag->term_id ) . "\" class=\"link-tag\">";
				$a_back = "</a>";
			}
			array_push( $tags, "<li class=\"tag\">" . $a_front . $tag->name . $a_back . "<li>" );
		}
		$out .= join( "<li>,</li>", $tags) . "</ul></div>";

		return $out;
	}

	public static function getFeaturedImage( $size = "thumbnail", $enable_link = 0 )
	{

		if( !has_post_thumbnail() ) {
			return "";
		}

		if( $enable_link ) {
			$a_front = "<a class=\"link-featured-image\" href=\"" . get_permalink() . "\">";
			$a_back = "</a>";
		}
		$out  = "<div class=\"article-featured-image\">";
		$out .= $a_front;
		$out .= get_the_post_thumbnail( 
					get_the_id(), 
					$size, 
					array(
						"alt" => trim( strip_tags( get_the_title( ) ) )
					) 
				);
		$out .= $a_back;
		$out .= "</div>";

		return $out;
	}

	public static function getDate( $include_time = 1, $pretext = "", $delimiter = " " )
	{
		$date_time 
			= $include_time 
			? $pretext . get_the_date() . $delimiter . get_the_time()
			: $pretext . get_the_date()
			;

		$out = "<div class=\"article-date\">" . $date_time . "</div>";

		return $out;
	}

	public static function getAuthor( $enable_link = 1 )
	{
		if( $enable_link ) {
			$a_front = "<a class=\"link-author\" href=\"" . get_the_author_link() . "\">";
			$a_back = "</a>";
		}

		$out = "<div class=\"article-author\">" . $a_front . get_the_author() . $a_back . "</div>";

		return $out;
	}

	public static function getExtendIconColumn( $excerpt = null ) 
	{
		$out .= "<div class=\"article-col-icon\">";
		if( $excerpt ) {
			$out .= "<a is-active=\"false\" prevent-default=\"true\" title=\"show excerpt\" href=\"#\" class=\"icon icon-plus\">";
			$out .= "+";
			$out .= "</a>";
		}
		$out .= "</div>";
		return $out;
	}

	public static function getTitleAndCategoryColumn( $is_title = true, $is_category = true )
	{
		$out .= "<div class=\"article-col-middle\">";
			$out .= $is_title ? static::getTitle( "h2", 1 ) : "";
			$out .= $is_category ? static::getCategory( 1, 0 ) : "";
		$out .= "</div>";
		return $out;
	}

	public static function getCategoryIconColumn( $category )
	{
		if( !$category ) {
			return "";
		}
		$out .= "<div class=\"article-col-icon\">";
			$out .= "<a href=\"" . get_category_link( $category->cat_ID ) . "\" class=\"icon icon-category icon-category-{$category->slug}\">";
				$out .= "<i class=\"" . CategoryIcon::getIconClass( $category->slug ) . "\"></i>";
			$out .= "</a>";
		$out .= "</div>";
		return $out;
	}

	public static function getTagsAndDateRow()
	{
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
		return $out;
	}

	public static function getReadMoreIconColumn( )
	{
		$out .= "<div class=\"article-col-icon valign-top\">";
			$out .= "<a title=\"Read More\" href=\"" . get_permalink() . "\" class=\"icon icon-read-more\">";
				$out .= "<i class=\"fa fa-lg fa-angle-double-right\"></i>";
			$out .= "</a>";
		$out .= "</div>";
		return $out;
	}

	public static function getBlankIconColumn( )
	{
		$out .= "<div class=\"article-col-icon\">";
		$out .= "</div>";
		return $out;
	}

	public static function getExcerptOrContentColumn()
	{
		$out .= "<div class=\"article-col-middle\">";
			$out .= static::getExcerpt();
		$out .= "</div>";
		return $out;
	}

	public static function getContentColumn()
	{
		$out .= "<div class=\"article-col-middle\">";
			$out .= static::getContent();
		$out .= "</div>";
		return $out;
	}

	public static function getExcerptOrContentRow( $excerpt, $is_hidden = "false" )
	{
		if( $excerpt ) {

			//Excerpt or content
			$out .= "<div is-hidden=\"{$is_hidden}\" class=\"article-table table-excerpt\">";
				//Blank column
				$out .= static::getBlankIconColumn();
				//Excerpt
				$out .= static::getExcerptOrContentColumn();
				//read more (with link to article)
				$out .= static::getReadMoreIconColumn();
			//
			$out .= "</div>";
		}
		return $out;
	}

	public static function getContentRow()
	{
		$out .= "<div class=\"article-table table-content\">";
			$out .= static::getContentColumn();
		$out .= "</div>";
		return $out;
	}

	public static function getCategoryRow( $excerpt, $category )
	{
		
		$out .= "<div class=\"article-table table-category\">";	
			//Extend icon
			$out .= static::getExtendIconColumn( $excerpt );
			//Title and category (with links to article and category)
			$out .= static::getTitleAndCategoryColumn();
			//category icon (with link to category)
			$out .= static::getCategoryIconColumn( $category );
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
			$out .= static::getCategoryRow( $excerpt, $category );
			$out .= static::getExcerptOrContentRow( $excerpt, "true" );
			$out .= static::getTagsAndDateRow();			
		$out .= "</article>";

		if( $echo ) {
			echo $out;
		}
		
		return $out;

	}
}

?>