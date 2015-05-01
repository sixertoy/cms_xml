<?php
namespace Pure\Abstracts;

use Pure\Abstracts\AbstractBlock;
use Bluemagic\Core\Debug;

/**
 * Classe abstraite pour les blocks de type AJAX
 * 
 * @author malas
 *
 */
class AbstractAsynchronous extends AbstractBlock
{
    
    protected $_ajax_link;
    
    const ASYNC_SUFFIX = "Async";
    const ASYNC_REQUEST_RESPONSE = "async_response";
    
    public function __construct( $parent )
    {
        parent::__construct( $parent );
        $this->_ajax_link = $this->_parseAsyncLink();
    }
    
    public function getAsyncURL()
    {
        return $this->_ajax_link->get();
    }
    
    private function _parseAsyncLink()
    {
        // $link = $this->getHelper()->getLink()->getClone();
        $link = $this->getHelper()->getView()->getCurrentLink()->getClone();
        $link->setAction( $link->getAction().self::ASYNC_SUFFIX );
        $link->useAjax();
        return $link;
    }
    
    public function getSuccessResponse()
    {
	    $link = $this->getHelper()->getView()->getCurrentLink();
        $link->addParams( array( "async_response"=>"1" ) );
	    return $link->get();   
    }
    
    public function getFaultResponse()
    {
	    $link = $this->getHelper()->getView()->getCurrentLink();
        $link->addParams( array( "async_response"=>"0" ) );
	    return $link->get();
    }
    
}