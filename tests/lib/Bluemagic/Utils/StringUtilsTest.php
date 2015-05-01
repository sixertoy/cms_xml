<?php
namespace Bluemagic\Utils;

use PHPUnit_Framework_TestCase;
use Bluemagic\Utils\StringUtils;

class StringUtilsTest extends PHPUnit_Framework_TestCase
{
	function setUp()
	{
	}

	/**
	 * Retourne en UTF8 avec Euros.
	 * @param $pString
	 */
	public function testUtf8_latin()
	{
		$this->markTestIncomplete();
	}

	public function testHasWhiteSpace()
	{
		$value = "l'arbre a des feuilles vertes";
		$result = StringUtils::hasWhiteSpace( $value );
		$this->assertTrue( $result );
		
		$value = "l'arbreadesfeuillesvertes";
		$result = StringUtils::hasWhiteSpace( $value );
		$this->assertFalse( $result );
		
		/*
		$value = "l'arbre\sadesfeuillesvertes";
		$result = StringUtils::hasWhiteSpace( $value );
		$this->assertTrue( $result );
		
		$value = addslashes( $value );
		$result = StringUtils::hasWhiteSpace( $value );
		$this->assertTrue( $result );
		*/
		$this->markTestIncomplete();
	}
	
	public function testIsBoolean()
	{

		$value = "00";
		$result = StringUtils::isBoolean( $value );
		$this->assertFalse( $result );
		
		$value = "01";
		$result = StringUtils::isBoolean( $value );
		$this->assertFalse( $result );
		
		$value = "11";
		$result = StringUtils::isBoolean( $value );
		$this->assertFalse( $result );
		
		$value = "1";
		$result = StringUtils::isBoolean( $value );
		$this->assertTrue( $result );
		
		$value = "0";
		$result = StringUtils::isBoolean( $value );
		$this->assertTrue( $result );
		
		$value = "yes";
		$result = StringUtils::isBoolean( $value );
		$this->assertTrue( $result );
			
		$value = strtoupper( $value );
		$result = StringUtils::isBoolean( $value );
		$this->assertTrue( $result );
		
		$value = "no";
		$result = StringUtils::isBoolean( $value );
		$this->assertTrue( $result );
			
		$value = strtoupper( $value );
		$result = StringUtils::isBoolean( $value );
		$this->assertTrue( $result );
		
		$value = "true";
		$result = StringUtils::isBoolean( $value );
		$this->assertTrue( $result );
			
		$value = strtoupper( $value );
		$result = StringUtils::isBoolean( $value );
		$this->assertTrue( $result );
		
		$value = "false";
		$result = StringUtils::isBoolean( $value );
		$this->assertTrue( $result );
			
		$value = strtoupper( $value );
		$result = StringUtils::isBoolean( $value );
		$this->assertTrue( $result );
	}

	public function testIsEmail()
	{
		// True
		$value = "niceandsimple@example.com";
		$result = StringUtils::isEmail( $value );
		$this->assertTrue( $result );
		
		$value = "very.common@example.fr";
		$result = StringUtils::isEmail( $value );
		$this->assertTrue( $result );
		
		$value = "a.little.lengthy.but.fine@dept.example.com";
		$result = StringUtils::isEmail( $value );
		$this->assertTrue( $result );
		
		$value = "disposable.style.email.with+symbol@example.com";
		$result = StringUtils::isEmail( $value );
		$this->assertTrue( $result );
		
		$value = "user@[IPv6:2001:db8:1ff::a0b:dbd0]";
		$result = StringUtils::isEmail( $value );
		$this->assertTrue( $result );
		
		$value = 'much.more unusual"@example.com';
		$result = StringUtils::isEmail( $value );
		$this->assertTrue( $result );
		
		$value = '"very.unusual.@.unusual.com"@example.com';
		$result = StringUtils::isEmail( $value );
		$this->assertTrue( $result );
		
		$value = '"very.(),:;<>[]\".VERY.\"very@\\ \"very\".unusual"@strange.example.com';
		$result = StringUtils::isEmail( $value );
		$this->assertTrue( $result );
		
		$value = "postbox@com";
		$result = StringUtils::isEmail( $value );
		$this->assertTrue( $result );
		
		$value = "admin@mailserver1";
		$result = StringUtils::isEmail( $value );
		$this->assertTrue( $result );
		
		$value = "!#$%&'*+-/=?^_`{}|~@example.org";
		$result = StringUtils::isEmail( $value );
		$this->assertTrue( $result );
		
		$value = '" "@example.org';
		$result = StringUtils::isEmail( $value );
		$this->assertTrue( $result );
		
		// False
		$value = 'Abc.example.com';
		$result = StringUtils::isEmail( $value );
		$this->assertFalse( $result );
		
		$value = 'A@b@c@example.com';
		$result = StringUtils::isEmail( $value );
		$this->assertFalse( $result );
		
		$value = 'a"b(c)d,e:f;g<h>i[j\k]l@example.com';
		$result = StringUtils::isEmail( $value );
		$this->assertFalse( $result );
		
		$value = 'just"not"right@example.com';
		$result = StringUtils::isEmail( $value );
		$this->assertFalse( $result );
		
		$value = 'this is"not\allowed@example.com';
		$result = StringUtils::isEmail( $value );
		$this->assertFalse( $result );
		
		$value = 'this\ still\"not\\allowed@example.com';
		$result = StringUtils::isEmail( $value );
		$this->assertFalse( $result );
		
	}

	public function testIsUCFirst()
	{	
		$value = "Le bonheur est dans le pré";
		$result = StringUtils::isUCFirst( $value );
		$this->assertTrue( $result );
		
		$value = "le bonheur est dans le pré";
		$result = StringUtils::isUCFirst( $value );
		$this->assertFalse( $result );
	}

	/**
	 * Retourne en UTF8 avec Euros.
	 * @param $pString
	 */
	public function testCleanHTML()
	{
		$this->markTestIncomplete();
	}

	/**
	 * Remplace les accentes par leurs valeurs alphabetique
	 * 
	 * @param		$pValue [string]
	 * @return		string
	 */
	public function testStripAccents()
	{
		$this->markTestIncomplete();
	}

	/**
	 * Normalize une chaine de caractere
	 * En nom de fichier
	 * 
	 * @param		$pValue [string]
	 * @return		string
	 */
	public function testSanitize()
	{
		$this->markTestIncomplete();
	}

	public function testRemoveWhiteSpace()
	{
		$expected = "lehibouestperchédansl'arbre";
		
		$value = " le hibou est perché d a  n  s l' arbre ";
		$actual = StringUtils::removeWhiteSpace( $value );
		$this->assertEquals( $expected, $actual );
		
		$value = "lehibouestperchédansl'arbre";
		$actual = StringUtils::removeWhiteSpace( $value );
		$this->assertEquals( $expected, $actual );
		
		$value = "le\thi\t\tbouestperchéda\rn\nsl'a\r\nrbre";
		$actual = StringUtils::removeWhiteSpace( $value );
		$this->assertEquals( $expected, $actual );
	}

	/**
	 * 
	 * @param $pString
	 * @param $pCount
	 * @return unknown_type
	 */
	public function testCut()
	{
		$end = "...";
		$value = "123456789012345678901234567890";
		$expected = "12345678901234567890".$end;
		$actual = StringUtils::cut( $value, 20, $end );
		$this->assertEquals( $expected, $actual );
		//
		$value = "123456789 123456789 123456789 ";
		$expected = "123456789 123456789 ".$end;
		$actual = StringUtils::cut( $value, 20, $end );
		$this->assertEquals( $expected, $actual );
	}

	/**
	 * @param $pString
	 * @return unknown_type
	 */
	public function testStripEmptyHTMLTags()
	{
		$value = "<p><p></p><b>Yo</b><span><br /></span><div></div><br /><i>Yo</i></p><ul><li></li></ul><dl><dt></dt><dd>toto</dd></dl>";
		$expected = "<p><b>Yo</b><br /><i>Yo</i></p><dl><dd>toto</dd></dl>";
		$actual = StringUtils::stripEmptyHTMLTags( $value );
		$this->assertEquals( $expected, $actual );
	}

	function tearDown()
	{
	}

}
