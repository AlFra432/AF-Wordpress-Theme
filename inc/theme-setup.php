<?php

function af_custom_background() 
{
	        
	$background = set_url_scheme( get_background_image() );
	$color = get_theme_mod( 'background_color' );
	if ( ! $background && ! $color ) {
		return;
	}
	$style = $color ? "background-color: #{$color};" : '';
	if ( $background ) {
		

		$repeat = get_theme_mod( 'background_repeat', 'repeat' );
		if ( ! in_array( $repeat, array( 'no-repeat', 'repeat-x', 'repeat-y', 'repeat' ) ) ) {
			$repeat = 'repeat';
		}
		

		$position = get_theme_mod( 'background_position_x', 'left' );
		if ( ! in_array( $position, array( 'center', 'right', 'left' ) ) ) {
			$position = 'left';
		}
		

		$attachment = get_theme_mod( 'background_attachment', 'scroll' );
		if ( ! in_array( $attachment, array( 'fixed', 'scroll' ) ) ) {
			$attachment = 'scroll';
		}

		$image = " background-image: url('{$background}');";
		$repeat = " background-repeat: {$repeat};";
		$position = " background-position: top {$position};";
		$attachment = " background-attachment: {$attachment};";

		$style .= $image . $repeat . $position . $attachment;
	}

	echo 'body.custom-background {' . trim( $style ) . '}';

}

//add_action('af_style', 'af_custom_background');

function af_show_admin_bar( ) 
{
	return ( current_user_can( 'administrator' ) ) ? true : false;
}



function af_contactmethods( $contactinfo ) 
{
	unset( $contactinfo[ 'aim' ] );
	unset( $contactinfo[ 'jabber' ] );
	unset( $contactinfo[ 'yim' ] );
	$contactinfo[ 'facebook' ] = 'Facebook';
	$contactinfo[ 'googleplus' ] = 'Google+';
	$contactinfo[ 'twitter' ] = 'Twitter';
	$contactinfo[ 'tumblr'  ] = 'Tumblr';
	$contactinfo[ 'instagram' ] = 'Instagram';
	return $contactinfo;
}

function af_setup( ) 
{
	if ( function_exists( 'add_theme_support' ) ) {
		/*add_theme_support( 'custom-background', array( 
				'wp-head-callback' => function(){}, 
		) );*/
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'custom-header' );
		set_post_thumbnail_size( 300, 169, 1 );
		add_image_size( 'blog-cropped', 800, 450, 1 );
		add_image_size( 'blog', 800, 800 );
		//load_theme_textdomain('af', get_template_directory() . '/lang');
		add_filter( 'show_admin_bar' , 'af_show_admin_bar');
		add_filter( 'user_contactmethods' , 'af_contactmethods');
	}
}

add_action( 'after_setup_theme', 'af_setup' );

function af_widgets_init( ) 
{

	if ( function_exists ('register_sidebar') ) {
	
		register_sidebar( array(
			'name' => __( 'Main', 'af' ),
			'id' => 'main',
			'description' => __( 'Appears on right side of page', 'af' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );
		
	}
}

add_action( 'widgets_init', 'af_widgets_init' );

function af_remove_recent_comments_style( ) 
{  
        global $wp_widget_factory;  
        remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );  
}  

add_action( 'widgets_init', 'af_remove_recent_comments_style' );

function remove_head_links() 
{   
        remove_action( 'wp_head', 'feed_links', 2 );
        remove_action( 'wp_head', 'feed_links_extra', 3 );
        remove_action( 'wp_head', 'rsd_link' );
        remove_action( 'wp_head', 'wlwmanifest_link' );
        remove_action( 'wp_head', 'wp_generator' );  
        remove_action( 'wp_head', 'rel_canonical' );
        remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
}
   
add_action( 'init', 'remove_head_links' );


/*
** Checks if page is home, single, page... and sets global strings SARTICLE, SHEADER AND SFOOTER for later class usage
** Article, Header and Footer classes and its derivates
*/
$SARTICLE = "Article";
$SHEADER  = "Header";
$SFOOTER  = "Footer";

function set_ahf( )
{
	 
	global $SHEADER
		, $SARTICLE
		, $SFOOTER;

	$checkFor = array(
		    "Single"
		  , "Page"
	);

	foreach( $checkFor as $value ) {
		$is_what = "is_" . $value;
		if( $is_what( ) ){
			$SARTICLE .= $value;
			$SHEADER  .= $value;
			$SFOOTER  .= $value;
		}
	}

}

add_action( 'wp_head', 'set_ahf' );

?>