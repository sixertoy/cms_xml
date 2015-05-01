<?php
namespace Bluemagic\Owner\Controller;

use DateTime;

use Doctrine\Entities\YacmsOwner;

use Bluemagic\Owner\Form\OwnerForm;
use Bluemagic\Core\Abstracts\AbstractController;

class OwnerController extends AbstractController
{
	protected $_form;
	protected $_entityName = "Doctrine\Entities\YacmsOwner";
	
	protected $_className = "Owner";
	protected $_packageName = "Bluemagic\Owner\Controller";
	
	protected function _build()
	{
		$this->_form = $this->_getControllerForm();
		$this->_entity = $this->getManager()->find( $this->_entityName, 1 );
		if( is_null( $this->_entity ) )
		{
			$date = new DateTime( "NOW" );
			$this->_entity = new YacmsOwner();
			$this->_entity->setCreated( $date );
		}
	}
	
	public function indexAction()
	{
		$action = $this->getLinkByType( "update" );
		$this->_form->setAction( $action );
		if( !is_null( $this->_entity->getOwnerId() ) ) $this->_form->hydrateWithEntity( $this->_entity );
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
	}
	
	/**
	 * Retourne le formulaire d'ajout/modification d'une page
	 * @return unknown_type
	 */
	private function _getControllerForm()
	{
		$form = new OwnerForm();
		$form->build()->setId( "owner-form" );
		return $form;		
	}
	public function getForm(){ return $this->_form; }	
	
}
