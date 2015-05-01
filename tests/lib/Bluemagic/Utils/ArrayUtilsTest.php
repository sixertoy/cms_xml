<?php
namespace Bluemagic\Utils; 

use StdClass;
use Bluemagic\Utils\ArrayUtils;

use PHPUnit_Framework_TestCase;

class ArrayUtilsTest extends PHPUnit_Framework_TestCase
{
	// contains the object handle of the string class
	private $_num;
	private $_assoc;

	// called before the test functions will be executed
	// this function is defined in PHPUnit_TestCase and overwritten
	// here
	function setUp()
	{
		$this->_num = array( 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 );
		$this->_assoc = array( "one"=>"1", "two"=>"2", "three"=>"3", "four"=>"4" );
	}
	
//{region Tests

    public function testInsertAt()
	{
	    $arr = array( 1, 2, 3, "inserted", 4, 5, 6, 7, 8, 9, 10 );
	    $result = ArrayUtils::insertAt( $this->_num, 3, "inserted" );
		$this->assertEquals( $arr, $result );
	}
	
	public function testToObject()
	{
	    $obj = new StdClass();
	    $obj->one = "1";
	    $obj->two = "2";
	    $obj->three = "3";
	    $obj->four = "4";
	    $result = ArrayUtils::toObject( $this->_assoc );
		$this->assertEquals( $obj, $result );
	    $obj = new StdClass();
	    $obj->one = "1";
	    $obj->two = "2";
	    $obj->three = "3";
		$this->assertNotEquals( $obj, $result );
	}
	
	public function testRemoveEmptyEntries()
	{
	    $result = ArrayUtils::removeEmptyEntries( "", "toto", "titi", "", "tata" );
	    $mock = array( "toto", "titi", "tata" );
		$this->assertEquals( $mock, $result );
		
	    $result = ArrayUtils::removeEmptyEntries( array( "one"=>"", "two"=>"toto", "three"=>"", "four"=>"tata" ) );
	    $mock = array( "two"=>"toto", "four"=>"tata" );
		$this->assertEquals( $mock, $result );
		
	    $result = ArrayUtils::removeEmptyEntries( array( "one"=>"", "two"=>"toto", "three"=>"", "four"=>array( "", "tata", "" ) ) );
	    $mock = array( "two"=>"toto", "four"=>array( "tata" ) );
		$this->assertEquals( $mock, $result );
	}
	
	/*
	public function testIsLast()
	{
		$last = end( $this->_num );
		$result = ArrayUtils::isLast( 10, $this->_num );
		$this->assertEquals( $last, $result );
	}
	*/
	
	/*
	function testLastKey()
	{
	    $last = end( $this->_num );
	    $result = ArrayUtils::lastKey( $last, $this->_num );
		$this->assertAssertTrue( $result );
	    $result = ArrayUtils::lastKey( 11, $this->_num );
		$this->assertAssertFalse( $result );
	}
	*/
	
	/*
	public function testLast()
	{
	    $result = ArrayUtils::last( $this->_num );
	    $last = $this->_num[ count( $this->_num ) - 1 ];
		$this->assertEquals( $last, $result );
		$this->assertNotEquals( 11, $result );
	}
	*/
	
//}region Tests

	// called after the test functions are executed
	// this function is defined in PHPUnit_TestCase and overwritten
	// here
	function tearDown()
	{
		unset( $this->_num );
		unset( $this->_inputs_array );
	}
	
}