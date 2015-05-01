<?php
namespace Pure\Page;
/*
use DateTime;

use Pure;

use Doctrine\Entities\YacmsCategory;

use Bluemagic\Utils\StringUtils;

use Bluemagic\Core\Collection;
use Bluemagic\Core\Objects\ColumnItem;
use Bluemagic\Core\Form\FormDescription;
use Bluemagic\Core\Abstracts\AbstractForm;
use Bluemagic\Core\Abstracts\AbstractController;
use Bluemagic\Core\Components\DataGrid\DataGrid;

use Bluemagic\Category\Form\CategoryForm;
*/

class PageController extends AbstractController
{
//{region Variables
//}region Variables
//{region Public Methods
	public function getProvider()
	{
		/*
		if( is_null( $this->_provider ) )
		{
			$this->_provider = new DataGrid();
			$this->_provider->setColumns(
				array(
					new ColumnItem( "name", "Nom de la page" ),
					new ColumnItem( "page_title", "Titre de la page" )
				)
			);
			$this->_provider->setRecords( $this->getRecords() );
		}
		return $this->_provider;
		*/
	}
//}region Public Methods
//{region Action Methods
	
	public function indexAction( $pRequestObject )
	{
		$this->_provider = $this->getProvider();
	}
	/*
	public function insertAction( $pRequestObject )
	{
		$this->_form = $this->_getControllerForm();
		$link = $this->getLinkByType( "insert" );
		$this->_form->setAction( $link );
			
		$postObject = $pRequestObject->getPost();
		if( $this->_form->isSubmitted() )
		{
			$date = new DateTime( "NOW" );
			$entity = $this->_hydrateEntity( $postObject );
			$entity->setCreated( $date );
			$entity->setModified( $date );
			$this->getManager()->persist( $entity );
			$result = $this->getManager()->flush();
			$link = $this->getLinkByType( "index" );
			Pure::redirectTo( $link );
		}else{}
	}
	*/
	/*
	public function updateAction( $pRequestObject )
	{
			
		$getObject = $pRequestObject->getGet();
		$postObject = $pRequestObject->getPost();
		
		$this->_form = $this->_getControllerForm();
		$link = $this->getLinkByType( "update" );
		$this->_form->setAction( $link );
		
		if( $this->_form->isSubmitted() )
		{
			$id = $postObject->getId();
			$entity = $this->find( $id );
			$date = new DateTime( "NOW" );
			$this->_hydrateEntity( $postObject, $entity );
			$entity->setModified( $date );
			$this->getManager()->persist( $entity );
			$this->getManager()->flush();
			$this->_form->hydrateWithEntity( $entity );
		}
		else
		{
			$id = $getObject->getId();
			if( !is_null( $id ) )
			{
				$entity = $this->find( $id );
				$this->_form->hydrateWithEntity( $entity );				
			}	
			else
			{
				$link = $this->getLinkByType( "index" ); // Ajout de parametre a l'url/lien
				Pure::redirectTo( $link );
			}
		}
	}
	*/
//}region Action Methods
//{region Private Methods
	/*
	private function _hydrateEntity( $pObject, $pEntity=null )
	{	
		$entity = $pEntity;
		if( is_null( $entity )  ) $entity = new YacmsCategory();
		
		$entity->setName( $pObject->getName() );
		$entity->setPageTitle( $pObject->getPageTitle() );
		
		$isActive = $pObject->getIsActive();
		if( is_null( $isActive ) ) $isActive = false;
		else $isActive = true;
		$entity->setIsActive( $isActive );
		
		$isNavigable = $pObject->getIsNavigable();
		if( is_null( $isNavigable ) ) $isNavigable = false;
		else $isNavigable = true;
		$entity->setIsNavigable( $isNavigable );
		
		$description = $pObject->getPageDescription();
		$short_description = StringUtils::cut( $description, 75 ); 
		$entity->setPageDescription( $description );
		$entity->setPageShortdescription( $short_description );
		
		$entity->setMetaKeywords( $pObject->getMetaKeywords() );
		$entity->setMetaDescription( $pObject->getMetaDescription() );
		
		return $entity;
	}
	
	private function _getControllerForm()
	{
		$form = new CategoryForm();
		$form->setId( "category-form" );
		$form->build();
		return $form;
	}
	*/
//}region Private Methods 	

}