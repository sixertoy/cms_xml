<?php
namespace Pure\Home;

use Pure\Interfaces\IController;
use Pure\Abstracts\AbstractController;

class HomeController extends AbstractController implements IController
{

    public function initializeActions(){}
    
	public function indexAction( $request )
	{
		var_dump( $request );
	}
}