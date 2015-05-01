<?php
namespace Pure\Core;

use HttpResponse;

use Pure\Interfaces\IController;
use Pure\Abstracts\AbstractController;

class ErrorController extends AbstractController implements IController
{	
	public function initializeActions(){}
	
	public function error404Action(){}
	public function error500Action(){}
	
	/**
	 * Renvoi un code 404 pour les requetes AJAX
	 * 
	 * @link http://www.jonasjohn.de/snippets/php/headers.htm
	 */
    public function errorAsyncAction()
    {
        $headers_sended = headers_sent();
        // @TODO si les headers ont deja ete envoyes
        if( $headers_sended ){}
        else header( "HTTP/1.0 404 Not Found" );
        exit();
    }
    
}