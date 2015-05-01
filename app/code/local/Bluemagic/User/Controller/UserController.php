<?php
namespace Bluemagic\User\Controller;

use DateTime;

use Doctrine\Entities\User;

use Bluemagic\User\Form\UserForm;
use Bluemagic\Core\Objects\ColumnItem;
use Bluemagic\Core\Models\TableProvider;
use Bluemagic\Core\Abstracts\AbstractController;

class UserController extends AbstractController
{
	protected $_form;
	protected $_entityName = "Doctrine\Entities\User";
	
	protected $_className = "User";
	protected $_packageName = "Bluemagic\User\Controller";
	
	protected function _build()
	{
		$this->_form = $this->_getControllerForm();
	}
		
	public function getProvider(){ return $this->_provider; }
	
	public function indexAction()
	{
		$this->_provider = new TableProvider();
		$this->_provider->setColumns( array
		(
			
			new ColumnItem( "firstname", "Pr&eacute;nom" ),
			new ColumnItem( "lastname", "Nom" ),
			new ColumnItem( "login", "Login" ),
			new ColumnItem( "email", "eMail" ),
			new ColumnItem( "privilege_id", "Privil&eacute;ge" )
		) );
//		$this->addMessage( "Aucune entr&eacute;e" ); // @TODO ajout des messages
	}
	
	public function insertAction()
	{
		$action = $this->getLinkByType( "insert" );
		$this->_form->setAction( $action );
	}
	
	/**
	 * Mise a jour des informations proprietaire
	 * @TODO Verifier les donnees du formulaire
	 * @TODO ajouter l'ajax
	 * 
	 * @param Bluemagic\Core\Object $pObject
	 */
	public function updateAction( $pObject )
	{
		/*
		if( $pObject->getSubmited() == "issubmited" )
		{
			$date = new DateTime( "NOW" );
			$this->_entity->setLogo( "" );
			$this->_entity->setModified( $date );
			$this->_entity->setTitle( $pObject->getTitle() );
			$this->_entity->setName( $pObject->getName() );
			$this->_entity->setAdress( $pObject->getAdress() );
			$this->_entity->setContact( $pObject->getContact() );
			$this->_entity->setKeywords( $pObject->getKeywords() );
			$this->_entity->setDescription( $pObject->getDescription() );
			$this->getManager()->persist( $this->_entity );
			$this->getManager()->flush();
			$this->_form->hydrateWithObject( $pObject );
		}
		else
		{
			$action = $this->getLinkByType( "update" );
			$this->_form->setAction( $action );
			if( !is_null( $this->_entity->getId() ) ) $this->_form->hydrateWithEntity( $this->_entity );
		}
		*/
	}
	
	/**
	 * Retourne le formulaire d'ajout/modification d'une page
	 * @return unknown_type
	 */
	private function _getControllerForm()
	{
		$form = new UserForm();
		$form->build()->setId( "user-form" );
		return $form;		
	}
	public function getForm(){ return $this->_form; }	
	
}
