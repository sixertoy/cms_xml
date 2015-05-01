<?php
namespace Bluemagic\Utils;

use DateTime;

class DateUtils
{
	const SHORT_FRENCH = "DmYY";
	const MID_FRENCH = "DDmYY";
	const LONG_FRENCH = "DDmmYY";
	const FULL_LONG_FRENCH = "ddDDmmYY";
	//
	//const SHORTMONTH_FRENCH = "DDMM";
	static public $WEEK_DAYS = array( "lundi", "mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche" );
	static public $FRENCH_WEEK_DAYS = array( "Monday"=>"Lundi", "Tuesday"=>"Mardi", "Wednesday"=>"Mercredi", "Thursday"=>"Jeudi", "Friday"=>"Vendredi", "Saturday"=>"Samedi", "Sunday"=>"Dimanche" );
	static public $SHORT_MONTHS = array( "Janv.", "F&eacute;vr.", "Mars", "Avr.", "Mai", "Juin", "Juil.", "Aout", "Sept.", "Oct.", "Nov.", "D&eacute;c." );
	static public $LONG_MONTHS = array( "Janvier", "F&eacute;vrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "D&eacute;cembre" );
	static public $FRENCH_MONTHS = array( "January"=>"Janvier", "February"=>"F&eacute;vrier", "March"=>"Mars", "April"=>"Avril", "May"=>"Mai", "June"=>"Juin", "July"=>"Juillet", "August"=>"Aout", "September"=>"Septembre", "October"=>"Octobre", "November"=>"Novembre", "December"=>"D&eacute;cembre" );
	/**
	 * @param $pDate [string] - jour, mois, annee
	 * @param $pFormat [string]
	 * @return string
	 */
	static public function convertToDate( $pDate, $pFormat="DDmmYY", $pSplitter="/" )
	{
		switch( $pFormat )
		{				
			case self::SHORT_FRENCH:
				$date = substr( $pDate, 6, 2 ).$pSplitter;
				$date .= substr( $pDate, 4, 2 ).$pSplitter;  
				$date .= substr( $pDate, 0, 4 );  
				return $date;
			case self::MID_FRENCH:
				$date = substr( $pDate, 6, 2 )." "; 
				$index = floatval( substr( $pDate, 4, 2 ) );
				$date .= self::$SHORT_MONTHS[ $index - 1 ]." ";  
				$date .= substr( $pDate, 0, 4 );  
				return $date;
			case self::LONG_FRENCH:
				$date = substr( $pDate, 6, 2 )." ";
				$index = floatval( substr( $pDate, 4, 2 ) );
				$date .= self::$LONG_MONTHS[ $index - 1 ]." ";  
				$date .= substr( $pDate, 0, 4 );  
				return $date;
			case self::FULL_LONG_FRENCH:
				$d = substr( $pDate, 6, 2 );
				$m = substr( $pDate, 4, 2 );
				$y = substr( $pDate, 0, 4 ); 
				$timestamp = mktime( 0, 0, 0, $m, $d, $y );
				$weekday = date( "w", $timestamp );
				$date = self::$WEEK_DAYS[ $weekday - 1 ]." ";
				$date .= substr( $pDate, 6, 2 )." ";
				$index = floatval( substr( $pDate, 4, 2 ) );
				$date .= self::$LONG_MONTHS[ $index - 1 ]." ";  
				$date .= substr( $pDate, 0, 4 );
				return $date;
			/*
			case "YYYYMMDD":
				return substr( $pDate, 6, 2 ).$pSplitter.substr( $pDate, 4, 2 ).$pSplitter.substr( $pDate, 0, 4 );
			case "DDMMYY":
				return substr( $pDate, 6, 2 ).$pSplitter.substr( $pDate, 4, 2 ).$pSplitter.substr( $pDate, 2, 2 );
			case "DDMM":
				return substr( $pDate, 6, 2 ).$pSplitter.substr( $pDate, 4, 2 );
			case "DDMMYYYY":
				return substr( $pDate, 6, 2 ).$pSplitter.substr( $pDate, 4, 2 ).$pSplitter.substr( $pDate, 0, 4 );
			case "DDmmYYYY":
			case "DDmYYYY":
				*/
				
		}
	}
	/* Retourne le jour */
	static public function getWeekDay(){ return date( "l" ); }
	/* Retourne le jour */
	static public function getDay( $pDate ){ return substr( $pDate, 6, 2 ); }
	static public function getCurrentDay(){ return date( "d" ); }
	/* Retourne le mois */
	static public function getMonth( $pDate ){ return substr( $pDate, 4, 2 ); }
	static public function getCurrentMonth(){ return date( "m" ); }
	/* Retourne l'annee sur deux chiffres */
	static public function getYear( $pDate ){ return substr( $pDate, 2, 2 ); }
	static public function getCurrentYear(){ return  date( "y" ); }
	/* Retourne l'annee sur quatre chiffres */
	static public function getFullYear( $pDate ){ return substr( $pDate, 0, 4 ); }
	static public function getCurrentFullYear(){ return date( "Y" ); }
	/**
 	 * Retourne la date du jour
	 */
	static public function getToday( $pFormat="DD/MM/YYYY" )
	{
		$result = $month = $jour = $year = "";		
		switch( $pFormat )
		{
			case "DD/MM/YYYY":
				$jour = date( "d" );
				$year = date( "Y" );
				$month = date( "F" );
				$month = self::$FRENCH_MONTHS[ $month ];
				$result = ( $jour." ".$month." ".$year );
				break;
			case self::FULL_LONG_FRENCH:
				$jjour = date( "l" );
				$jjour = self::$FRENCH_WEEK_DAYS[ $jjour ];
				$jour = date( "d" );
				$year = date( "Y" );
				$month = date( "F" );
				$month = self::$FRENCH_MONTHS[ $month ];
				$result = ( $jjour." ".$jour." ".$month." ".$year );
				break;
		}
		return $result;
	}
	
	static public function getDateTimeSQL( $date="NOW" )
	{
		$date = new DateTime( $date );
		return $date->format( "Y-m-d H:i" );
	}
	
}
?>