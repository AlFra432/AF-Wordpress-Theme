<?php
namespace Themeby;

class Gravatar
{
	protected $user;
	protected $options;

	public static function getDefaults( )
	{ 
		return 
			array(
				'size' => 0,
				'secure' => 0,
				'forcedefault' => 0,
				'rating' => 0,
				'default' => 0
			);
	}

	public static function defaultImageOptions( )
	{ 
		return 
			array(
				'404',
				'mm',
				'identicon',
				'monsterid',
				'wavatar',
				'retro',
				'blank'
			);
	}

	public static function ratingOptions( )
	{
		return 
			array(
				'g',
				'pg',
				'r',
				'x'
			);
	}

	public function __construct(  $value = 0, $getby = "id", $options = array( ) )
	{
		if( empty( $getby ) ) {
			$getby = "id";
		}
		$this->options = wp_parse_args( $options, static::getDefaults() );
		$this->user = get_user_by( $getby, $value );
	}

	private function generateHash( )
	{
		return md5( strtolower( trim( $this->user->user_email ) ) );
	}

	public function getUrl( )
	{
		
		if( empty( $this->user ) ) {
			return;
		}

		$query = array( );

		if( in_array( 
				$rating = strtolower( trim( $this->options[ 'rating' ] ) ),
				static::ratingOptions( )
			)
		) {
			array_push( $query, "r={$rating}" );
		}

		if( $this->options[ 'forcedefault' ] ) {
			array_push( $query, "f=y" );
		}

		$size = (int)$this->options[ 'size' ];

		if( $size < 2048 
			&& $size > 1 ) {
			array_push( $query, "s={$size}" );
		}

		if( in_array(
				$default = strtolower( trim( $this->options[ 'default' ] ) ),
				static::defaultImageOptions()
			)
		) {
			array_push( $query, "d={$default}" );
		}

		$secure = 
			$this->options[ 'secure' ] 
			? 'secure.' 
			: '';

		$query_string =
			$query
			? "?" . implode( "&", $query )
			: '';

		return "//{$secure}gravatar.com/avatar/{$this->generateHash()}{$query_string}";
	}

}



?>