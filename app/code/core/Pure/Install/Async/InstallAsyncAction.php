<?php
namespace Pure\Install\Async;

use DateTime;

use Bluemagic\Core\Debug;
use Bluemagic\Core\Crypter;
use Bluemagic\Utils\StringUtils;
use Bluemagic\Core\Notification;
use Bluemagic\Helpers\DomHelper;

use Pure\Core\DoctrineRun;

use Pure\Interfaces\IAction;
use Pure\Abstracts\AbstractAction;
use Pure\Abstracts\AbstractAsynchronous;
use Pure\Patterns\Proxies\ConnecterProxy;
use Pure\Patterns\Proxies\ApplicationProxy;

use Pure\Models\Post;
use Pure\Models\User;
use Pure\Models\Type;
use Pure\Models\Role;
use Pure\Models\Page;
use Pure\Models\Option;
use Pure\Models\Article;
use Pure\Core\PureConstants;
use Pure\Patterns\Proxies\ConfigProxy;

class InstallAsyncAction extends AbstractAction implements IAction
{
	
	private function _doPersist( $em, $results )
	{
		foreach( $results as $entity ) $em->persist( $entity );
		$em->flush();
	}
	
	private function _installTypes()
	{
		$results = array();
		$datetime = new DateTime( "NOW" );
		
		$name = "Page";
		$ent = new Type();
		$ent->setLabel( $name );
		$ent->setName( StringUtils::sanitize( $name ) );
		$results[] = $ent;
		
		$name = "Article";
		$ent = new Type();
		$ent->setLabel( $name );
		$ent->setName( StringUtils::sanitize( $name ) );
		$results[] = $ent;

		$name = "Media";
		$ent = new Type();
		$ent->setLabel( $name );
		$ent->setName( StringUtils::sanitize( $name ) );
		$results[] = $ent;
		
		return $results;
	}

	private function _installBackendPages( $em, $parent )
	{
		$results = array();
		
		// Dashboard
		$name = "Dashboard";
		$page = $this->_createPage( $em, $name );
		$results[] = $page;
				
		// Options
		$name = "Options";
		$page = $this->_createPage( $em, $name );
		$results[] = $page;
		
		// Design
		$name = "Design";
		$page = $this->_createPage( $em, $name );
		$results[] = $page;
		
		// Users
		$name = "Users";
		$page = $this->_createPage( $em, $name );
		$results[] = $page;
		
// 		foreach( $results as $page ) $page->setParent( $parent );
		
		return $results;
	}
	
	private function _installOptions( $infos )
	{
		$result = array();
		$datetime = new DateTime( "NOW" );
		
		// Domaine
		$option = new Option();
		$option->setName( "domain" );
		$option->setValue( $infos[ "domain" ] );
		$option->setModified( $datetime );
		$option->setCreated( $datetime );
// 		$option->setAutoload( true );
		$result[] = $option;
		
		// Contact
		$option = new Option();
		$option->setName( "contact_email" );
		$option->setValue( $infos[ "email" ] );
		$option->setModified( $datetime );
		$option->setCreated( $datetime );
// 		$option->setAutoload( true );
		$result[] = $option;
		
		// Title
		$option = new Option();
		$option->setName( "title" );
		$option->setValue( $infos[ "title" ] );
		$option->setModified( $datetime );
		$option->setCreated( $datetime );
// 		$option->setAutoload( true );
		$result[] = $option;
		
		return $result;
		
	}
	
	private function _installRoles()
	{
		$results = array();
		
		$roles = array( "Super Admin", "Admin", "Author", "User", "Visitor" );
		
		foreach( $roles as $role )
		{		
			$entity = new Role();
			$entity->setLabel( $role );
			$entity->setName( StringUtils::sanitize( $role ) );
			$results[] = $entity;
			
		}
		
		return $results;
		
	}
	
	private function _installUsers( $em, $api_key, $infos )
	{
		$results = array();
		$datetime = new DateTime( "NOW" );
		
		$email = $infos[ "email" ];
		$lastname = $infos[ "lastname" ];
		$firstname = $infos[ "firstname" ];
		$username = $infos[ "username" ];
		$password = md5( $infos[ "password" ] );
		 
		$super_admin_role = $em->find( "Pure\Models\Role", 1 );
		$admin_role = $em->find( "Pure\Models\Role", 2 );
		
		// SuperAdmin
		$user = new User();
		$user->setFirstname( $firstname );
		$user->setLastname( $lastname );
		$user->setEmail( $email );
		$user->setBirthday(  "" );
		$user->setUsername( Stringutils::sanitize( $firstname ) );
		$user->setPassword( $api_key );
		$user->setRole( $super_admin_role );
		$user->setModified( $datetime );
		$user->setCreated( $datetime );
		$results[] = $user;

		// Admin
		$user = new User();
		$user->setFirstname( $firstname );
		$user->setLastname( $lastname );
		$user->setEmail( $email );
		$user->setBirthday(  "" );
		$user->setUsername( Stringutils::sanitize( $firstname ) );
		$user->setPassword( $password );
		$user->setRole( $admin_role );
		$user->setModified( $datetime );
		$user->setCreated( $datetime );
		$results[] = $user;
		
		return $results;
	}
	
	public function execute( $request )
	{
		
		var_dump( "execute" );
		
		try
		{
		
			$note = "Une erreur est survenue durant le processus d'installation. ";
			$note .= "Reporter vous aux fichiers de logs pour en savoir plus.";
			
			// $app_proxy = $this->getController()->getProxy()->getFacade()->retrieveProxy( ApplicationProxy::NAME );
			$config_proxy = $this->getController()->retrieveProxy( ConfigProxy::NAME );
			$connecter_proxy = $this->getController()->retrieveProxy( ConnecterProxy::NAME );
			
			// Recuperation des infos du site
			$dom = DomHelper::loadXML( PureConstants::SITE_TEMP_FILE );
			$site_infos = DomHelper::toArray( $dom );
	
			$dom = DomHelper::loadXML( PureConstants::DATABASE_TEMP_FILE );
			$databaseInfos = DomHelper::toArray( $dom );
			$secured_value = json_encode( $databaseInfos );
			
			$dom = DomHelper::loadXML( PureConstants::SUPERADMIN_TEMP_FILE );
			$superadminInfos = DomHelper::toArray( $dom );
			
			$config = $config_proxy->getApplicationConfig();
			$api_key = $config->apikey;
			$is_production = $config->is_production;
					
			$crypter = new Crypter();
			$crypter->save( PureConstants::DATABASE_SECURED_FILE, $secured_value, $api_key );
			
			// @TODO chercher et effacer le var_dump lors du debug de l'objet de config 
			$connecter_proxy->prepareConnecter( $is_production, $api_key );

			var_dump( $connecter_proxy );
			
			$doctrine = $connecter_proxy->getDoctrineRunner();
			$driver = $doctrine->getEntityManager()->getConfiguration()->getMetadataDriverImpl();
			
			var_dump( $driver );
						
			$validated = $doctrine->validateSchemas();
			
			var_dump( "validated => ".$validated );
			
			$this->sendFalseResult( "yo" );
			return false;

			
			
			
			if( !$validated ) $this->sendFalseResult( $note );
			else
			{
				
				$generated = $doctrine->generateTables( !$is_production );
				
				if( !$generated ) $this->sendFalseResult( $note );
				else
				{
					
					if( !$is_production) $doctrine->generateProxies();
					$em = $doctrine->getEntityManager();
					
					$results = $this->_installOptions( $site_infos );
					$this->_doPersist( $em, $results );
	
					$results = $this->_installTypes();
					$this->_doPersist( $em, $results );
					
					$results = $this->_installRoles();
					$this->_doPersist( $em, $results );
					
					$results = $this->_installUsers( $em, $api_key, $superadminInfos );
					$this->_doPersist( $em, $results );
					
					$results = $this->_installBackendPages( $em, null );
					$this->_doPersist( $em, $results );
					
					$results = $this->_installFirstArticle( $em );
					$this->_doPersist( $em, $results );
							
					$this->sendTrueResult();
					return true;
					
				}
			}
		}
		catch( Exception $e )
		{
			$this->sendFalseResult( $e->getMessage() );
			return true;
		}
	}
	
	private function _createPage( $em, $name )
	{
		$now = new DateTime( "NOW" );

		$super_admin = $em->find( "Pure\Models\User", 1 );
		$type = $em->find( "Pure\Models\Type", 1 );
		
		$post = new Post();
		$post->setTitle( $name );
		$post->setDescription( "" );
		$post->setName( StringUtils::sanitize( $name ) );
		$post->setRoute( "backend/".StringUtils::sanitize( $name ) );
		$post->setStatus( "published" );
		$post->setUser( $super_admin );
		$post->setType( $type );
		$post->setCreated( $now );
		$post->setModified( $now );
		
		$ent = new Page();
		$ent->setPost( $post );
		$ent->setPublic( false );
		$ent->setPosition( 0 );
		
		return $ent;
	}
	
	private function _installFirstArticle( $em )
	{

		$results = array();
		
		$title = "Welcome";
		$now = new DateTime( "NOW" );
		$content = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent commodo, mauris et fermentum consectetur, dolor massa volutpat justo, sagittis aliquet nisi nunc at diam. Donec a felis ut nibh consequat semper. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Maecenas pulvinar eleifend eros, a fermentum tellus consectetur id. Vestibulum congue egestas ligula, id ultricies augue lobortis quis. Aliquam posuere convallis rhoncus. Maecenas viverra lacus eu mauris eleifend vestibulum. Sed eleifend, ligula eget laoreet placerat, dolor sapien lobortis nisi, sed tristique velit lorem sagittis erat. Quisque tellus libero, dapibus sed vestibulum a, consequat sed sapien. Cras mollis, metus eu lobortis hendrerit, sapien libero porta mi, bibendum sodales tortor felis non felis. Nam adipiscing lacus ac risus pharetra vitae posuere mauris mollis. Mauris tempor rhoncus ante vitae consectetur. Donec congue lectus blandit enim fermentum placerat. Nullam ipsum nulla, blandit eu consectetur mattis, fringilla in purus. Nam a lacus non sem tempus molestie eget non ipsum. Nullam lobortis nisi in nibh facilisis ullamcorper. In porta libero sit amet neque gravida pellentesque. Ut tortor velit, adipiscing egestas imperdiet vitae, sollicitudin id mi. Maecenas ac mollis odio. Suspendisse in nunc in justo commodo ultricies. Donec luctus porttitor nibh sit amet tempor. Integer leo neque, ornare semper venenatis vitae, vestibulum vitae ipsum. Nunc dictum fermentum pharetra. Fusce commodo condimentum ante, sagittis cursus tortor facilisis vel. Nunc purus urna, egestas a aliquam ut, vestibulum sed nibh. Ut laoreet massa id dui vestibulum in varius purus sagittis. Nunc mollis ipsum at libero lobortis posuere. Nunc placerat volutpat enim, nec dictum neque consequat at. Donec et mi sit amet eros lacinia rhoncus. Nulla mattis, nibh ac aliquam interdum, velit elit pharetra velit, sed hendrerit mauris enim quis erat.";

		$super_admin = $em->find( "Pure\Models\User", 1 );
		$type = $em->find( "Pure\Models\Type", 2 );
		
		$post = new Post();
		$post->setTitle( $title );
		$post->setDescription( StringUtils::cut( $content ) );
		$post->setName( StringUtils::sanitize( $title ) );
		$post->setRoute( "backend/".StringUtils::sanitize( $title ) );
		$post->setStatus( "published" );
		$post->setUser( $super_admin );
		$post->setType( $type );
		$post->setCreated( $now );
		$post->setModified( $now );

		$ent = new Article();
		$ent->setPost( $post );
		$ent->setContent( $content );
		$results[] = $ent; 
		
		return $results;
		
	}
	
}