<?php

$home_scripts = array(
	"paths" => array(
		"jquery" => str_replace( array( "\\", "/"), "/", MODULESDIR . "jquery/jquery-1.11.1.min" ),
		"velocity" => str_replace( array( "\\", "/"), "/", MODULESDIR . "velocity/velocity.min" ),
		"velocity-ui" => str_replace( array( "\\", "/"), "/", MODULESDIR . "velocity/velocity.ui.min" )
	),
	"shim" => array(
		"velocity" => array(
			"deps" => array(
				"jquery"
			)
		),
		"velocity-ui" => array(
			"deps" => array(
				"velocity"
			)
		)
	)
);


add_action( 'wp_enqueue_scripts', function( ) {
	
	wp_enqueue_script( 'jquery' );
	wp_register_script( 'af-theme-script', JSDIR . 'af-theme.js', array( 'jquery' ), null, true );
	wp_enqueue_script( 'af-theme-script' );
	wp_register_style( 'font-awesome', FADIR . 'font-awesome.min.css', array(), null );
	wp_enqueue_style( 'font-awesome' );
	//wp_register_script('requirejs', MODULESDIR . 'require/require.min.js', false, null, true );
	//wp_enqueue_script( 'requirejs' );
}, 1 );



add_action( 'af_style', function( ) {
	//echo LESSDIR . "style.min.css";
	//echo file_exists(LESSDIR . "style.min.css") ? "1" : "0";
	readfile(LESSDIR . "style.min.css");
} );

add_action( 'af_footer_script', function( ){
	/*readfile( JSDIR . "loadcss.js" );
	if( is_home( ) ) {
		global $home_scripts;
		echo "loadCss('" . LESSDIR . "home.css');";
		echo "require.config(" . json_encode($home_scripts) . ");";
		readfile( JSDIR . "main.js" );
	}*/	
} );


function getScripts(){
	global $wp_scripts;
	//unset( $wp_scripts->queue );
	//var_dump($wp_scripts);
}

add_action("wp_head", function(){
	//getScripts();
})


?>