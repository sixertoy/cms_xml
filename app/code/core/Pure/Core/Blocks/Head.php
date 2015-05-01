<?php
namespace Pure\Core\Blocks;

use Bluemagic\Core\Debug;
use Bluemagic\Utils\Normalizer;
use Bluemagic\Core\CoreConstants;

use Pure\Abstracts\AbstractBlock;

/**
 * Retourne les elements a inserer dans le head de la page
 * Utilisation de Smarty pour les templates
 *
 * @TODO minify CSS:
 * 					http://www.nickyeoman.com/blog/css/57-css-php
 * 					http://www.sonassi.com/knowledge-base/combine-and-compile-css-and-js-into-gzipped-files/
 * 					http://www.ejeliot.com/blog/72
 * 					http://www.catswhocode.com/blog/3-ways-to-compress-css-files-using-php
 * 					http://www.dustindiaz.com/combining-php-and-css
 * 					http://code.google.com/p/minify/wiki/UserGuide
 *
 * @param string $pType
 * @param string $pTemplate
 */
class Head extends AbstractBlock
{
	
	private $_title;
	private $_scripts;
	private $_stylesheets;
	
	function __construct( $parent )
	{
		parent::__construct( $parent );
		$this->_is_debuggable = false;
		$this->_stylesheets = array();
		$this->_scripts = array();
	}

	public function getTitle()
	{
		return $this->_title;
	}
	
	public function title( $value )
	{
		$this->_title = $value;
		return $this;
	}
	
	/**
	 * 
	 */
	public function getStylesheets()
	{
		$result = "";
		$template = "stylesheets.tpl";
		$smarty = $this->getSmarty();
		foreach( $this->_stylesheets as $file )
		{
			$smarty->assign( "file", $this->getBaseURL().$file );
			$smarty->assign( "rel", "stylesheet" );
			$result .= $smarty->fetch( $template );
		}
		print $result;
	}
	
    /**
     * 
     * @return string
     */
	public function getScripts()
	{
		$result = "";
		$template = "scripts.tpl";
		$smarty = $this->getSmarty();
		foreach( $this->_scripts as $file )
		{
			$smarty->assign( "file", $file );
			$result .= $smarty->fetch( $template );
		}
		print $result;
	}
		
    /**
     * Add Stylehsheet file
     * @TODO Chemin du skin dynamique base sur la reecriture d'URL
     *
     * @param string|array $file
     * @param string $rel_value | stylesheet
     * 
     * @return Pure\Page\Block\Html\Head
     */
    public function addStylesheet( $file, $rel_value="stylesheet" )
    {
    	$options = array( "rel"=>$rel_value );
    	$type = CoreConstants::STYLESHEET_TYPE;
    	if( is_array( $file ) )
    	{
    		foreach( $file as $value ) $this->_addDataItemByType( $type, $value, $options );
    	}
    	else $this->_addDataItemByType( $type, $file, $options );
        return $this;
    }

    /**
     * 
     * @param unknown $file
     * @return \Pure\Common\Blocks\Head
     */
	public function removeStylesheet( $file )
	{
        $type = CoreConstants::STYLESHEET_TYPE;
		$this->_removeDataItemByType( $type, $pFile );
        return $this;
	}

    /**
     * Add JavaScript
     * @TODO chemin du skin dynamique
     *
     * @param string $pFile
     * @return Pure\Page\Block\Html\Head
     */
    public function addScript( $file )
    {
    	$type = CoreConstants::SCRIPT_TYPE;
    	if( is_array( $file ) )
    	{
    		foreach( $file as $value ) $this->_addDataItemByType( $type, $value );
    	}
    	else $this->_addDataItemByType( $type, $file );
        return $this;
    }
	
    /**
     * 
     * @param unknown $file
     * @return \Pure\Common\Blocks\Head
     */
	public function removeScript( $file )
	{
        $type = CoreConstants::SCRIPT_TYPE;
		$this->_removeDataItemByType( $type, $file );
        return $this;
	}
    
    /**
     * Ajoute un element a la liste des items a charger en entete de page
     * @param string $pType
     * @param string $pName
     * @return boolean
     */
    private function _addDataItemByType( $type, $name, $options=null )
    {
    	$file_path = true;
    	$id = Normalizer::__pointify( $name, "/" );
    	switch( $type )
    	{
    		case CoreConstants::STYLESHEET_TYPE:
        		$file_path = $this->getStylesheetFile( $name );
        		if( $file_path ) $this->_stylesheets[ $id ] = $file_path;
        		break;
    		case CoreConstants::SCRIPT_TYPE:
        		$file_path = $this->getScriptFile( $name );
        		if( $file_path ) $this->_scripts[ $id ] = $file_path;
        		break;
    	}
    	if( empty( $file_path ) )
    	{
    		$message = "Impossible d'ajouter le fichier '$name' a la liste des elements d'entete";
    	    $message = Debug::trace( $message, Debug::ERROR );
            return false;
    	}
		return true;    	
    }
    
    /**
     * Supprime un element de la liste des items en entete de page
     * 
     * @TODO [malas] a verifier
     * 
     * @param string $type
     * @param string $pName
     */
    private function _removeDataItemByType( $type, $name )
    {
    	$id = Normalizer::__pointify( $name, "/" );
    	switch( $type )
    	{
    		case CoreConstants::STYLESHEET_TYPE:
    			$this->_stylesheets[ $id ] = $file_path;
				unset( $this->_stylesheets[ $id ] );
    			break;
    		case CoreConstants::SCRIPT_TYPE:
    			$this->_scripts[ $id ] = $file_path;
				unset( $this->_scripts[ $id ] );
    			break;
    	}
		return true;
    }
}