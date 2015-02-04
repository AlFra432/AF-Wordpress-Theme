<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js pedr">
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<!--<meta content="IE=edge" http-equiv="X-UA-Compatible">-->
		<meta name="viewport" content="initial-scale=1.0 maximum-scale=1.0 user-scalable=no">
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<link rel="apple-touch-icon" sizes="57x57" href="/apple-touch-icon-114.png">
    	<link rel="apple-touch-icon" sizes="114x114" href="/apple-touch-icon-114.png">
    	<link rel="apple-touch-icon" sizes="72x72" href="/apple-touch-icon-144.png">
    	<link rel="apple-touch-icon" sizes="144x144" href="/apple-touch-icon-144.png">
		<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32.png"> 
		<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">
		<?php wp_head(); ?>
		<style id="af-style"><?php
			do_action( 'af_style' );
		?>
		</style>
		<script>
		var htmlElement = document.getElementsByTagName( "html" )[ 0 ];
		htmlElement.className = htmlElement.className.replace( "no-js", "js" );
		var shivElem = [ "section", "header", "footer", "aside", "article" ], i;
		for( i in shivElem ){
			document.createElement( shivElem[i] );
		}

		</script>
	</head>
	<body <?php body_class(); ?>>
		<?php 
		global $SHEADER;
		$SHEADER::getHeader( 1 );
		?>
		<section class="container">