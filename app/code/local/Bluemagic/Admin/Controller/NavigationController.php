<?php
namespace Bluemagic\Admin\Controller;

use Doctrine\Entities\Category;

use Bluemagic\Core\Collection;
use Bluemagic\Admin\Objects\NavigationItem;
use Bluemagic\Core\Abstracts\AbstractController;

class NavigationController extends AbstractController
{	
	private $_collection;	
	protected $_className = "Navigation";
	protected $_packageName = "Bluemagic\Admin\Controller";		
	/**
	 * @TODO Charger les categories du backend par le fichier de configuration
	 */
	protected function _build()
	{		
		$this->_collection = new Collection();
		$items = array
		(
			array( "Accueil", "dashboard" ),
			array( "Cat&eacute;gories", "category" ),
			array( "Articles", "article" ),
			array( "Medias", "media" ),
			// array( "Banni&eacute;res", "banner" ),
			array( "Configuration", "owner" )
		);
		$this->_collection->add( $items );
		
		$items = array
		(
			array( "Utilisateurs", "user" ),
			array( "Cache", "cache" )
		);
		$this->_collection->add( $items );				
	}
	
	/**
	 * 
	 * @param unknown_type $pIndex
	 */
	private function _getItemsCollection( $pIndex )
	{
		$collection = new Collection();
		$items = $this->_collection->get( $pIndex );		
		foreach( $items as $item ):
			$name = $item[ 0 ];
			$entity = $item[ 1 ];
			$item = new NavigationItem( $name, $entity );
			$collection->add( $item );
		endforeach;
		return $collection;	
	}
	public function getCategories(){ return $this->_getItemsCollection( 0 ); }
	public function getAdminItems(){ return $this->_getItemsCollection( 1 ); } 
	
}
