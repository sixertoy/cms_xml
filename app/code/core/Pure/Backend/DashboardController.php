<?php
namespace Pure\Backend;

use Pure\Interfaces\IController;
use Pure\Core\AuthController;
use Pure\Abstracts\AbstractController;

class DashboardController extends AuthController implements IController
{
	
	public function initializeActions(){}
	
	public function indexAction( $request )
	{
	
	}
}