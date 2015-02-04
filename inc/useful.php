<?php 


	public function img_to_base64( $path, $echo = false ) {
		$type = pathinfo( $path, PATHINFO_EXTENSION );
		$data = file_get_contents( $path );
		$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
		if( $echo ){
			echo $base64;
		}else{
			return $base64;
		}
	}
	

	function get_sticky_ids( ) {
		$tmp = get_option( 'sticky_posts' );
		rsort( $tmp );
		return $tmp;
	}
















?>