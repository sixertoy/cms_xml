<?php
namespace Bluemagic\Utils;

class SQLUtils
{
	/**
	 * @param unknown_type $pSql
	 * @return unknown
	 */
	static public function escapeSQL( $pSql )
	{
		$args = func_get_args();
		foreach( $args as $key => $val )
		$args[ $key ] = mysql_real_escape_string( $val );
		$args[ 0 ] = $pSql;
		return call_user_func_array( 'sprintf', $args );
	}
	/**
	 * @param unknown_type $pWord
	 * @return unknown
	 */
	static public function createMD5( $pWord ){ return MD5( $pWord ); }
}
?>