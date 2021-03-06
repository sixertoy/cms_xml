<?php 
namespace Bluemagic\Iterators;

use Iterator;

/** 
  * The TokenIterator class allows you to iterate through string tokens using 
  * the familiar foreach control structure. 
  * 
  * Example: 
  * <code> 
  * <?php 
  * $string = 'This is a test.'; 
  * $delimiters = ' '; 
  * $ti = new TokenIterator($string, $delimiters); 
  * 
  * foreach ($ti as $count => $token) { 
  *     echo sprintf("%d, %s\n", $count, $token); 
  * } 
  * 
  * // Prints the following output: 
  * // 0. This 
  * // 1. is 
  * // 2. a 
  * // 3. test. 
  * </code> 
  */ 
class TokenIterator implements Iterator 
{ 
     /** 
      * The string to tokenize. 
      * @var string 
      */ 
     protected $_string; 
     
     /** 
      * The token delimiters. 
      * @var string 
      */ 
     protected $_delims; 
     
     /** 
      * Stores the current token. 
      * @var mixed 
      */ 
     protected $_token; 
     
     /** 
      * Internal token counter. 
      * @var int 
      */ 
     protected $_counter = 0; 
     
     /** 
      * Constructor. 
      * 
      * @param string $string The string to tokenize. 
      * @param string $delims The token delimiters. 
      */ 
     public function __construct($string, $delims) 
     { 
         $this->_string = $string; 
         $this->_delims = $delims; 
         $this->_token = strtok($string, $delims); 
     } 
     
     /** 
      * @see Iterator::current() 
      */ 
     public function current() 
     { 
         return $this->_token; 
     } 

     /** 
      * @see Iterator::key() 
      */ 
     public function key() 
     { 
         return $this->_counter; 
     } 

     /** 
      * @see Iterator::next() 
      */ 
     public function next() 
     { 
         $this->_token = strtok($this->_delims); 
         
         if ($this->valid()) { 
             ++$this->_counter; 
         } 
     } 

     /** 
      * @see Iterator::rewind() 
      */ 
     public function rewind() 
     { 
         $this->_counter = 0; 
         $this->_token   = strtok($this->_string, $this->_delims); 
     } 

     /** 
      * @see Iterator::valid() 
      */ 
     public function valid() 
     { 
         return $this->_token !== FALSE; 
     } 
 } 
?>