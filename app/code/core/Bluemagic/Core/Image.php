<?php
namespace Bluemagic\Core;

use PureMVC\ApplicationConstants;
use Bluemagic\Singleton\URIFactory;

class Image
{
	
	private $_alt;
	private $_title;
	private $_width;
	private $_height;
	private $_source;
	private $_filename;
	private $_dimensions;
	
	public function __construct( $pName )
	{
		$this->_alt = "";
		$this->_title = "";
		$this->_filename = $pName;
		$this->_source = URIFactory::getFilePathByType( ApplicationConstants::IMG_TYPE, $this->_filename, false );
		$this->_dimensions =  getimagesize( $this->_source );
		$this->_width = $this->_dimensions[ 0 ]; 
		$this->_height = $this->_dimensions[ 1 ];
	}

	public function getAlt(){ return $this->_alt; }
	public function setAlt( $pValue ){ $this->_alt = $pValue; return $this; }
	
	public function getTitle(){ return $this->_title; }
	public function setTitle( $pValue ){ $this->_title = $pValue; return $this; }
	
	public function getWidth(){ return $this->_width; }
	public function setWidth( $pValue ){ $this->_width = $pValue; return $this; }
	
	public function getHeight(){ return $this->_height; }
	public function setHeight( $pValue ){ $this->_height = $pValue; return $this; }
	
	public function getSource(){ return $this->_source; }	
	public function getDimensions(){ return $this->_size; }
	
}