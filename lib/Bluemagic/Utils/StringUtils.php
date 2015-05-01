<?php

namespace Bluemagic\Utils;

class StringUtils
{
	const EMPTY_STRING = "";
//	const QUOTES = array( "�","�","'",'"' );
//	const ACCENTS_REP = array('A','A','A','A','A','A','C','E','E','E','E','I','I','I','I','O','O','O','O','O','U','U','U','U','Y','a','a','a','a','a','a','c','e','e','e','e','i','i','i','i','o','o','o','o','o','o','u','u','u','u','y','y');
//	const ACCENTS = array( '�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�' );
	/**
	 * Retourne en UTF8 avec Euros.
	 * @param $pString
	 */
	static public function utf8_latin( $pString )
	{
		$pString = htmlentities( $pString, ENT_COMPAT, 'UTF-8' );
		return html_entity_decode( $pString, ENT_COMPAT, 'ISO-8859-1' );
	}
	
	/**
	 * Verifie s'il s'agit d'un nom de classe backslashed
	 * @param string $string
	 * @return boolean
	 */
	static public function isClassName( $string )
	{
	    if( !is_string( $string ) ) return false;
	    return ( strpos( $string, "\\" ) !== false );
	}
	
	/**
	 * Determine si une chaine de caracteres est un boolean
	 * 
	 * @param string $string
	 * @return boolean
	 */
	static public function isBoolean( $string )
	{
		$string = strtolower( $string );
		if( is_array( $string ) ) return false;
		if( is_string( $string ) )
		{
			if( strlen( $string ) > 1 ) return ( in_array( $string, array( "true", "false", "yes", "no" ) ) );
			else return ( in_array( $string, array( "1", "0" ) ) );
		}
		return false;
	}
	
	static public function toBoolean( $string )
	{
		$string = strtolower( $string );
		return ( ( $string == "true" ) || ( $string == "1" ) || ( $string == "yes" ) );
	}
	
	/**
	 * Determine si la chaine de caracteres contient des espaces
	 * 
	 * @param string $string
	 * @return boolean
	 */
	static public function hasWhiteSpace( $string )
	{
		$regex = "/^$|\s+/";
		$string = stripslashes( $string );
		preg_match( $regex, $string, $matches );
		return ( count( $matches ) > 0 );
	}
	
	/**
	 * Teste si la chaine de caracteres est un email
	 * Utilise le test natif FILTER_VALIDATE_EMAIL
	 * Une regex de verification est utilisee selon la norme RCF2822
	 * 
	 * @link http://en.wikipedia.org/wiki/Email_address
	 * @link http://www.ietf.org/rfc/rfc2822.txt
	 * @link http://www.regular-expressions.info/email.html
	 * 
	 * @param string $string
	 * @return boolean
	 */
	static public function isEmail( $string )
	{
		$result = filter_var( $string, FILTER_VALIDATE_EMAIL );
		if( $result )
		{
			$regex = "/[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+(?:[A-Z]{2}|com|org|net|edu|gov|mil|biz|info|mobi|name|aero|asia|jobs|museum)\b/";
			return ( preg_match( $regex, $string ) !== false );
		}
		return false;
	}
	
	/**
	 * Determine si la premiere lettre est en majuscule
	 * 
	 * @param string $string
	 * @return boolean
	 */
	static public function isUCFirst( $string )
	{
		$first_letter = substr( $string, 0, 1 );
		preg_match( "/[A-Z]/", $first_letter, $matches );
		return ( !empty( $matches ) );
	}
	
	/**
	 * Retourne en UTF8 avec Euros.
	 * @param $pString
	 */
	static public function cleanHTML( $pString )
	{
		$string = html_entity_decode( $pString, ENT_COMPAT, 'ISO-8859-1' );
		$string = self::stripEmptyTags( $string );
		$regex = "/<\/?\w+((\s+(\w|\w[\w-]*\w)(\s*=\s*(?:\".*?\"|'.*?'|[^'\">\s]+))?)+\s*|\s*)\/?>/i";
		$string = preg_replace( $regex, "", $string );
		return trim( $string );
	}
	/**
	 * Remplace les accentes par leurs valeurs alphabetique
	 * 
	 * @param		$pValue [string]
	 * @return		string
	 */
	static public function stripAccents( $pValue )
	{
		return str_replace( StringUtils::ACCENTS, StringUtils::ACCENTS_REP, utf8_decode( $pValue ) );
	}
	/**
	 * Normalize une chaine de caractere
	 * En nom de fichier
	 * 
	 * @param		$pValue [string]
	 * @return		string
	 */
	static public function sanitize(  $pString, $pReplacer="-" )
	{
		$str = strtolower( $pString );
		$str = html_entity_decode( $str, ENT_QUOTES, "UTF-8" );
		$accents =array
		(
			"o"=>array("Ò","Ó","Ô","Õ","Ö","Ø","ò","ó","ô","õ","ö","ø"),
			"a"=>array("À","Á","Â","Ã","Ä","Å","à","á","â","ã","ä","å"),
			"u"=>array("Ù","Ú","Û","Ü","ù","ú","û","ü"),
			"e"=>array("È","É","Ê","Ë","è","é","ê","ë"),
			"i"=>array("Ì","Í","Î","Ï","ì","í","î","ï"),
			"n"=>array("Ñ","ñ"),
			"y"=>array("ÿ","Ÿ"),
			"c"=>array("Ç","ç")
		);
		
		foreach( $accents as $lettre => $search ){
			foreach ( $search as $value ){	
				$str = str_replace( $value, $lettre, $str );			
			}			
		}
		
		$str = str_replace( " ", $pReplacer, $str ); // Supression des espaces
		$str = preg_replace( "#([^a-z0-9-_])#", $pReplacer, $str ); //Remplace dans une cha�ne tous les caract�res non-alphanum�riques par pReplacer
		$str = preg_replace( "#(\\".$pReplacer.")+#" ,$pReplacer , $str ); //Remplace dans une cha�ne les replacers multiples.
		
		return trim( $str );
	}
	
	/**
	 * Supprime les espaces blancs d'une chaine de carateres
	 * 
	 * @param string $value
	 * @return string
	 */
	static public function removeWhiteSpace( $value )
	{
		$value = str_replace( " ", "", $value );
		$value = str_replace( "\t", "", $value );
		$value = str_replace( "\r", "", $value );
		$value = str_replace( "\n", "", $value );
		$value = str_replace( ">\s*<", "", $value );
		return $value;
	}
	
	/**
	 * Coupe une chaine de caracteres
	 * 
	 * @param string $string
	 * @param int $count
	 * @return string
	 */
	static public function cut( $string, $count=50, $end="..." )
	{
		$string = str_replace( "\n", "", $string );
		$string = str_replace( "\r", "", $string );
		$string = strip_tags( $string );
		if( strlen( $string ) >= $count )
		{
			$string = substr( $string, 0, $count );
			/*
			 * @TODO Echec lors des tests unitaires
			$white_space = strrpos( $string, " " );
			if( $white_space !== false ) $string = substr( $string, 0, $white_space );
			*/
			$string .= $end;
		}
		return $string;
	}
    
	/**
	 * Supprime les tags HTML vide d'une chaine de caracteres
	 * @TODO Rajouter tous les tags HTML
	 * 
	 * @param string $string
	 * @param string $replacer
	 * @return string
	 */
	static public function stripEmptyHTMLTags( $string, $replacer="" )
	{
		$tags = array( "p", "div", "span", "li", "ul", "ol", "dd", "dt", "dl" );
		foreach( $tags as $tag )
		{
			$regex = '#<'.$tag.'[^>]*>(?:\s+|(?:&nbsp;)+|(?:<br\s*/?>)+)*</'.$tag.'>#';
			$string = preg_replace( $regex, $replacer, $string );
		}
		return $string;
	}
}
