<?php
namespace Pure\User;

use Pure\User\Form\UserAdminForm;

use Bluemagic\Objects\Column;
use Bluemagic\Components\DataGrid;

use Pure\Core\AuthController;
use Pure\Interfaces\IProvider;
use Pure\Interfaces\IController;
use Pure\Abstracts\AbstractController;

class BackendController extends AuthController implements IController, IProvider
{
	
	private $_datagrid;
	
	public function initializeActions(){}

	/**
	 * 
	 * @see \Pure\Core\AuthController::__setUp()
	 */
	public function __setUp( $is_ajax, $request )
	{
		parent::__setUp( $is_ajax, $request );
		$this->setEntityName( "Pure\Models\User" );
		$this->_datagrid = new DataGrid();
	}
	
	/**
	 * 
	 * @param Bluemagic\Core\Request $request
	 */
	public function addAction( $request )
	{
		$this->setForm( new UserAdminForm() );
		
		if( $request->isSubmitted() )
		{
			
		}

		$this->_initDatagrid();
// 		$this->getForm()->setId( "user_admin_form" )->build();
		
	}
	
	public function editAction( $request ) 
	{
		$this->setForm( new UserAdminForm() );
		
		if( $request->isSubmitted() )
		{
			
		}

		$this->_initDatagrid();
// 		$this->getForm()->setId( "user_admin_form" )->build();
	}
	
	/**
	 * 
	 * @param \Bluemagic\Core\Request $request
	 */
	public function datagridAction( \Bluemagic\Core\Request $request )
	{
		$this->_initDatagrid();
	}
	
	private function _initDatagrid()
	{
		$entities = $this->findAll();
		$this->_datagrid->setEditable( true )
			->setRecords( $entities )
			->addColumn( new Column( "user_id", "Id", Column::IDENTIFIER_TYPE )  )
			->addColumn( new Column( "username", "Username" ) )
			->addColumn( new Column( "role:label", "Role" ) )
			->addColumn( new Column( "email", "eMail", Column::EMAIL_TYPE ) );
	}
	
	/**
	 * 
	 * @see \Pure\Interfaces\IProvider::getDatagrid()
	 */
	public function getDatagrid()
	{
		return $this->_datagrid;		
	}
	
}