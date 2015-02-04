( function( w, d, $ ) {
	var   preventedAnchors = $( 'a[prevent-default="true"]' )
		, extendableArticles = $( 'article[is-extendable]' )
		, menuMainActivator = $( '#menu-main-activator' )
		, menuMainContainer = $( '#menu-main-container' )
		, html = $( 'html' )
		, closeMenus
		, prevNextStatusText = $( '[prevnext-status-text]' )
		, prevNextStatusTextContainer = $( '[prevnext-status-text-container]' )
		, chosensocialStatusTextContainer = $( '[chosensocial-status-text-container]' )
		, chosensocialStatusText = $( '[chosensocial-status-text]' )
	;

	prevNextStatusText
		.on( 'mouseenter', function( e ) {
			var me = $( this );
			prevNextStatusTextContainer.html( me.attr( 'prevnext-status-text' ) );
		} )
		.on( 'mouseleave', function( e ) {
			var me = $( this );
			prevNextStatusTextContainer.html( "" );
		} )
	;

	chosensocialStatusText
		.on( 'mouseenter', function( e ) {
			var me = $( this );
			chosensocialStatusTextContainer.html( me.attr( 'chosensocial-status-text' ) );
		} )
		.on( 'mouseleave', function( e ) {
			var me = $( this );
			chosensocialStatusTextContainer.html( "" );
		} )
	;

	preventedAnchors
		.on( 'click', function( e ) {
				e.preventDefault( );
		} )
	;


	extendableArticles
		.find( '.icon-plus' )
		.on( 'click', function( ) {
			var   me = $( this )
				, parent = me.parents( 'article' )
				, tableExcerpt = parent.find( '.table-excerpt' )
			;
			//alert(tableExcerpt.height());
			var isHidden
					= tableExcerpt.attr( 'is-hidden' ) == "true"
					? tableExcerpt.attr( 'is-hidden', "false" ) 
					  && me.html("-")
					  && me.attr( "title", "Show less" )

					: tableExcerpt.attr( 'is-hidden', "true" ) 
					  && me.html( "+" )
					  && me.attr( "title", "Show more" )
					  
			;
			//tableExcerpt.hide();
		} )
	;

	 menuMainActivator
	 		.on( 'click', function( e ){
	 			e.stopPropagation();
	 			var me = $( this );
	 			if( me.attr('is-active') == 'true' ) {
	 				me.attr( 'is-active', 'false' );
	 				menuMainContainer.attr( 'is-active', 'false' );
	 			} else {
	 				me.attr( 'is-active', 'true' );
	 				menuMainContainer.attr( 'is-active', 'true' );
	 			}
	 		} )
	 ;

	 menuMainContainer
	 		.on( 'click', function( e ) {
	 			e.stopPropagation();
	 		} )
	 ;

	 html
		 .on( 'click', function() {
		 		closeMainMenu();
		 } )
	 ;

	 closeMainMenu = function() {
	 	if( menuMainActivator.attr('is-active') == 'true' ) {
	 		menuMainActivator.attr( 'is-active', 'false' );
	 		menuMainContainer.attr( 'is-active', 'false' );
	 	}
	 }


} )( window, window.document, window.jQuery );


/*
$jscript  = "<script>";
			$jscript .= "var menuActivator = document.getElementById(\"menu-{$this->menuObject->slug}-activator\")";
			$jscript .= ",menuContainer = document.getElementById(\"menu-{$this->menuObject->slug}-container\")";
			$jscript .= ";";
			$jscript .= "menuActivator.onclick = function(){";
				$jscript .= "var attr1 = menuContainer.attributes['is-active']";
				$jscript .= ",attr2 = menuActivator.attributes['is-active'];";
				$jscript .= "if( attr1.value == \"true\" ){";
					$jscript .= "attr1.value = \"false\";";
					$jscript .= "attr2.value = \"false\";";
				$jscript .= "}else{";
					$jscript .= "attr1.value = \"true\";";
					$jscript .= "attr2.value = \"true\";";
				$jscript .= "}";
			$jscript .= "}"; 
			$jscript .= "</script>";
*/