<?php
namespace Bluemagic\Core;

class Crypter
{
	
	// http://www.petefreitag.com/cheatsheets/ascii-codes/
	static private $_expected = "#$%&@=+%*";
	
	public function save( $file, $value, $api_Key )
	{
//		$value = "//".$this->encode( $value, $APIKey );
		$value = $this->encode( $value, $api_Key );
//		$handle = fopen( $file.".php", "w+" );
		$handle = fopen( $file, "w+" );
		fwrite( $handle, $value );
		fclose( $handle );
		return $value;
	}
	
	public function load( $filename, $api_Key )
	{
//	    $filename = $filename.".php";
		if( file_exists( $filename ) )
		{
			$content = file_get_contents( $filename );
			$content = $this->decode( $content, $api_Key );
			return $content;
		}
		else return false;
	}
	/**
	 * Decodage
	 * @param string $pContent
	 * @param string $pKey
	 */
	public function decode( $content, $key )
	{
		$index = 0;
		$result = array();
		// Supprime le "=" de debut et le "$" de fin
		$content = substr( $content, 1 );
		$content = substr( $content, 0, -1 );
		$key = self::_getRealDecryptKey( $key );
		$circles = $this->_getCircles( $key );
		$content = chunk_split( $content, 4, "." );
		$codes = explode( ".", $content );
		foreach( $codes as $code )
		{

			if( empty( $code ) ) continue;
			$ascii_code = $this->_reverseASCII( $code ); 
			$letter = chr( $ascii_code ); // Code ASCII Correspondant
			$result[] = $letter; 
		}
		$result = implode( "", $result );

		/*
		for( $i = 0; $i < $length; $i++ )
		{
			$current_char = substr( $content, $i, 1 );
			$pos = strpos( self::$_expected, $current_char );
			// Si la suite de 4 est un float
			if( $pos !== false )
			{
// 				$content = substr_replace( $content, " ", ( $i - 1 ), 1 );
// 				$content = substr_replace( $content, " ", $i, 1 );
// 				$content = substr_replace( $content, ",", ( $i +4 ), 1 );
			}
		}
		*/
		/*
		$content = str_replace( " ", "", $content );
		$content = chunk_split( $content, 4, "." );
		$content = substr( $content, 0, -1 );
		$codes = explode( ".", $content );
		$index = 0;
		for( $j = 0; $j < count( $codes ); $j++ )
		{
			$code = $codes[ $j ];
			$current_circle = $circles[ $index ];
		}
		*/
		return $result;
	}
	
	/**
	 * Encodage
	 * @param string $pContent
	 * @param string $pKey
	 */
	public function encode( $content, $key  )
	{
		$result = "";
		$circles = $this->_getCircles( $key );
		$length = strlen( $content );
		for( $i = 0; $i < $length; $i++ )
		{
			$letter = substr( $content, $i, 1 );
			$ascii_code = "".ord( $letter ); // Code ASCII Correspondant
			// Rajoute une virgule sur les valeurs dont la taille est inferieure a 4
			// Pour les valeurs de 3 de long rajoute un chiffre random au debut
			$ascii_crypted = $this->_getASCII( $ascii_code );
			$result .= $ascii_crypted;
			// Si une virgule, on rajoute une suite de 4
			// Pour indiquer que la suite de 4 suivante comporte une virgule
			/*
			$float_position = strpos( $ascii_crypted, "," );
			if( $float_position !== false )
			{
				$couple = rand( 0, 9 ).substr( self::$_expected, rand( 0, strlen( self::$_expected ) ), 1 );
				$result .=  $couple;
			}
			
			$index = 0;
			for( $j = 0; $j < strlen( $ascii_crypted ); $j++ )
			{
				// Recupere la valeur en cours sur la valeur encrypte
			    $indexed = substr( $ascii_crypted, 0, $j );
				// Recupere le circle sur lequel recuperer la valeur
				$current_circle = $circles[ $index ];
			    $lgth = strlen( $current_circle );
			    // Recuepere le numero de cle a indexer pour la valeur du circle
			    if( $indexed == "," ) $indexed = rand( 0, 9 );
			    else $indexed = floatval( $indexed );
			    // Recupere la position du caractere dans le cercle
			    $modulo = ( $indexed % $lgth );
			    $couple = $modulo.substr( $current_circle, $modulo, 1 );
			    $result .= $couple; 
			    $index++;
			    if( $index > 2 ) $index = 0;
			}
			*/
		}
		return "=".$result."$";
	}
	
	static private function _getRealDecryptKey( $key )
	{
		$salt = "Tatooïneestlaplanèteoùl'ontrouvedeslecteursd'hologrammesdelaprincesseLeïa!";
		$salt = md5( $salt );
		$unallowed = md5( $key.$salt );
		return $unallowed;
	}
	
	/**
	 * Retourne les "cercles" sur lesquels encodes les valeurs
	 * 
	 * @param string $key
	 * @return array
	 */
	private function _getCircles( $key )
	{
		$key = self::_getRealDecryptKey( $key );
		// Determine le sens de rotation du coffre fort d'apres la cle
		$sensRotation = !( ord( substr( $key, 0, 1 ) ) > ord( substr( $key, 1, 1 ) ) );
		$circles = array();
		$firstCircle = $this->_parse24( $key );
		if( !$sensRotation ) $firstCircle = strrev( $firstCircle );
		$circles[] = $firstCircle;
		$secondCircle = $this->_parse16( $key );
		if( $sensRotation ) $secondCircle = strrev( $secondCircle );
		$circles[] = $secondCircle;
		$thirdCircle = $this->_parse8( $key );
		if( !$sensRotation ) $thirdCircle = strrev( $thirdCircle );
		$circles[] = $thirdCircle;
		return $circles;
	}
	
	/**
	 * Sale la valeur
	 * Pour retourne un code a 4 valeur
	 * 
	 * @param string $code
	 * @return string
	 */
	private function _getASCII( $code )
	{
	    if( strlen( $code ) == 3 ) $code = rand( 0, 9 ).$code;
	    if( strlen( $code ) == 2 ) $code = rand( 0, 9 ).",".$code;
		return $code;	
	}
	
	/**
	 * Desale la valeur
	 * Pour retourne un code a 4 valeur
	 * 
	 * @param string $code
	 * @return string
	 */
	private function _reverseASCII( $code )
	{
	    if( strpos( $code, "," ) !== false ) $code = substr( $code, 2 );
	   else $code = substr( $code, 1 );
		return $code;	
	}
			
	private function _parse8($k){$n=0;$r="";for($i=0;$i<strlen($k);$i++){if($n==3){$r.=substr($k,$i,1);$n=-1;}$n++;}return$r;}
	private function _parse16($k){$n=0;$r="";for($i=0;$i<strlen($k);$i++){if($n<1)$r.=substr($k,$i,1);else$n=-1;$n++;}return$r;}
	private function _parse24($k){$n=0;$r = "";for($i=0;$i<strlen($k);$i++){if($n<3)$r.=substr($k,$i,1);else$n=-1;$n++;}return $r;}
	
}