<?php
namespace Pure\Entities;

use Bluemagic\Core\Notification;

use Bluemagic\Components\DataGrid;

use Pure\Entities\Form\EntityForm;

use Pure\Core\AuthController;
use Pure\Interfaces\IProvider;
use Pure\Interfaces\IController;
use Pure\Abstracts\AbstractController;

class BackendController extends AuthController implements IController, IProvider
{
	private $_datagrid;
	
	public function initializeActions()
	{
        $this->registerAction( "add", "Pure\Entities\Actions\AddAction" );
	}
	
	public function __setUp( $is_ajax, $request )
	{
	    $name = "Pure\Entity\Entity";
	    $this->setEntityName( $name );
		$this->_datagrid = new DataGrid();
	    parent::__setUp( $is_ajax, $request );
	}
	
	public function datagridAction( $request )
	{
	}
	
	/**
	 * 
	 * @param \Bluemagic\Core\Request $request
	 * @return \Pure\Entities\BackendController
	 */
	/*
	public function addAction( $request )
	{
	    $form = new EntityForm();
	    
		$this->setForm( new EntityForm() );
		$this->getForm()->setId( "entity_form" )->build();
		$form = $this->getForm();
	    
	    if( $request->isSubmitted() )
	    {
	        $params = $request->post()->toArray();
	        $validated = $form->validate( $params );
	        
	        $note = "is validated";
	        $this->addNotification( $note, Notification::WARNING );
	        
	    }
	    
	    $left_form = $form->getFormByName( "left" );
	    $block = $this->getView()->getBlockbyId( "menubar" );
// 	    var_dump( $block );
	    
	    $right_form = $form->getFormByName( "right" );
	    
		return $this;
	}
	*/
	
	public function editAction( $request )
	{
		
	}
	
	private function _initDatagrid()
	{
	    /*
		$entities = $this->findAll();
		$this->_datagrid->setEditable( true )
			->setRecords( $entities )
			->addColumn( new Column( "user_id", "Id", Column::IDENTIFIER_TYPE )  )
			->addColumn( new Column( "username", "Username" ) )
			->addColumn( new Column( "role:label", "Role" ) )
			->addColumn( new Column( "email", "eMail", Column::EMAIL_TYPE ) );
			*/
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