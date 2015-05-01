<?php
namespace Pure\Backend\Blocks;

use Pure\Core\Blocks\Menu;
use Pure\Objects\MenuObject;
use Bluemagic\Core\Collection;

class Menubar extends Menu
{
	
	protected function __setUp()
	{		
		$view = $this->getCurrentView();
		$this->_items = new Collection();
		// Dashboard
		$item = $this->_getItem( $view, "Dashboard", "dashboard" )->setIcon( "home" );
		$this->_items->add( $item );
		// Medias
		$item = $this->_getItem( $view, "Bibliotheque", "medias" )->setIcon( "picture" );
		$this->_items->add( $item );
		// Classes
		$item = $this->_getItem( $view, "Classes", "entities" )->setIcon( "leaf" )
			->addChild( $this->_getItem( $view, "Ajouter", "entities", "add" )->setIcon( "pencil" ) )
			->addChild( $this->_getItem( $view, "Toutes les classes", "entities" )->setIcon( "th" ) );
		$this->_items->add( $item );
		// Utilisateurs
		$item = $this->_getItem( $view, "Utilisateurs", "users" )->setIcon( "user" )
			->addChild( $this->_getItem( $view, "Ajouter", "users", "add" )->setIcon( "pencil" ) )
			->addChild( $this->_getItem( $view, "Toutes les utilisateurs", "users" )->setIcon( "th" ) )
			->addChild( $this->_getItem( $view, "Mon profil", "users", "myprofile" )->setIcon( "user" ) );
		$this->_items->add( $item );
		parent::__setUp();
	}
	
	/**
	 * 
	 * @param string $view
	 * @param string $label
	 * @param string $layout
	 * @param string $action
	 * @return \Pure\Objects\MenuObject
	 */
	private function _getItem( $view, $label, $layout, $action=false )
	{
		$item = new MenuObject( $label, $layout, $action );
		$item->setView( $view );
		return $item;
	}
	
}