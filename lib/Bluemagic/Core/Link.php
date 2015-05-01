<?php
namespace Bluemagic\Core;

use Exception;

/**
 * http://www.webrankinfo.com/dossiers/strategies-de-liens/tutoriel-redirections
 */
class Link
{
	
	private $_url;
	private $_action;
	private $_layout;
	private $_use_ajax;
	private $_params; // Tableau d'arguments
	private $_outputType; // Type d'ouput du lien

	const URL_TYPE = "url";
	const RAW_TYPE = "raw";
	const HTML_TYPE = "html";
	
	/**
	 * @praam string $pLink - Vue_Layout/Controller_Action
	 */
	public function __construct( $view=false, $layout=false, $action=false )
	{
		$this->_view = $view;
		$this->_params = false;
		$this->_layout = $layout;
		$this->_action = $action;
		$this->_use_ajax = false;
	}
	
	/**
	 * 
	 * @param boolean $bool
	 * @return \Bluemagic\Core\Link
	 */
	public function useAjax( $bool=true )
	{
		$this->_use_ajax = $bool;
		return $this;
	}
	
	/**
	 * 
	 * @return boolean
	 */
	public function isAjax()
	{
		return $this->_use_ajax;
	}
	
	/**
	 * 
	 * @param string $value
	 * @return \Bluemagic\Core\Link
	 */
	public function setView( $value )
	{
		$this->_view = $value;
		return $this;
	}
	
	/**
	 * 
	 * @return string
	 */
	public function getView()
	{
		return $this->_view;
	}

	/**
	 * 
	 * @return string
	 */
	public function getLayout()
	{
		return $this->_layout;
	}
	
	/**
	 * 
	 * @param string $pValue
	 * @return \Bluemagic\Core\Link
	 */
	public function setLayout( $value )
	{
		$this->_layout = $value;
		return $this;
	}
	
	/**
	 * 
	 * @return string
	 */
	public function getAction()
	{
		return $this->_action;
	}
	
	/**
	 * 
	 * @param string $pValue
	 * @return \Bluemagic\Core\Link
	 */
	public function setAction( $value )
	{
		$this->_action = $value;
		return $this;
	}
	
	/**
	 * 
	 * @return \Bluemagic\Core\Link
	 */
	public function removeAction()
	{
		$this->_action = false;
		return $this;
	}
	
	/**
	 * 
	 * @param array $params
	 * @return \Bluemagic\Core\Link
	 */
	public function addParams( $params )
	{
		if( !$this->_params ) $this->_params = array();
		$this->_params = array_merge( $params, $this->_params );
		return $this; 
	}
	
	/**
	 * 
	 * @return array
	 */
	public function getParams()
	{
		return $this->_params;
	}
	
	/**
	 * Retourne le lien
	 * Sous forme de chaine de caractere
	 * Encode pour la sortie voulue
	 * 
	 * @param string $output_type
	 * @return string
	 */
	public function get( $ouput_type="raw" )
	{
		if( !$this->_view ) return "#";
		$ouput = "";
		switch( $ouput_type )
		{
			case self::HTML_TYPE:
				$ouput = $this->getEntitized();
				break;
			case self::URL_TYPE:
				$ouput = $this->getEncoded();
				break;
			case self::RAW_TYPE:
				$ouput = $this->_build();
				break;
		}
		return $ouput;
	}
	
	/**
	 * 
	 * @return string
	 */
	public function getEncoded()
	{
		if( !$this->_view ) return "#";
		return urlencode( $this->_build() );
	}
	
	/**
	 * 
	 * @return string
	 */
	public function getEntitized()
	{
		if( !$this->_view ) return "#";
		return htmlentities( $this->_build() );
	}
	
	/**
	 * 
	 * @return \Bluemagic\Core\Link
	 */
	public function getClone()
	{
	    $link = new Link();
	    $link->setView( $this->getView() );
	    $link->setAction( $this->getAction() );
	    $link->setLayout( $this->getLayout() );
	    return $link;
	}
	
	/**
	 * Retourne le lien sous forme de chaine
	 * 
	 * @link http://php.net/manual/en/function.http-build-query.php
	 * @return string
	 */
	private function _build()
	{
		$url = "?view=".$this->getView();
		if( $this->_use_ajax ) $url .= "&async=1";
		if( $this->_layout ) $url .= "&layout=".$this->getLayout();
		if( $this->_action ) $url .= "&action=".$this->getAction();
		if( $this->_params && !empty( $this->_params ) )
		{
			foreach( $this->_params as $key=>$value )
			{
				$val = trim( $value );
				if( !empty( $val ) ) $url .= "&".$key."=".$value;
			} 
		}
		return $url; 
	}
	
	/**
	 * 
	 * @return string
	 */
	public function __toString()
	{
		return $this->get();
	}
	
}