<?php
namespace Pure\Core;


use Doctrine\ORM\Mapping\Driver\DriverChain;

use Doctrine\Common\Annotations\CachedReader;

use Doctrine\Common\Annotations\AnnotationReader;

use Bluemagic\Core\Debug;

use Doctrine\ORM\Proxy\ProxyFactory;

use Pure\Loggers\DoctrineLogger;

use Doctrine\ORM\Tools\SchemaTool;
use Doctrine\ORM\Tools\EntityGenerator;
use Doctrine\ORM\Tools\SchemaValidator;
use Doctrine\ORM\Tools\DisconnectedClassMetadataFactory;

use Doctrine\ORM\Entity;
use Doctrine\DBAL\Connection;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\Common\EventManager;
use Doctrine\Common\Cache\ApcCache;
use Doctrine\Common\Cache\ArrayCache;
use Doctrine\ORM\Mapping\Driver\XmlDriver;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;

class DoctrineRun
{
	
	private $_conn_params;
	private $_is_prod_mode;
	private $_entity_manager;
	
	const PROXIES_NS = "";
	const PROXIES_PATH = ""; 
	
	/**
	 * 
	 * @param unknown $conn_params
	 * @param unknown $is_dev_mode
	 * 
	 * @link http://docs.doctrine-project.org/en/2.0.x/reference/configuration.html
	 */
	public function __construct( $conn_params, $is_prod_mode )
	{
		$this->_conn_params = $conn_params;
		$this->_is_prod_mode = $is_prod_mode;
		$models_paths = Array( APPLICATION_PATH."/repository/core/Pure/Models/" );

		$cache = ( $this->_is_prod_mode ) ? new ApcCache() : new ArrayCache();
		
		$doctrine_cfg = new Configuration();

		$doctrine_cfg->setQueryCacheImpl( $cache );
		$doctrine_cfg->setMetadataCacheImpl( $cache );
		
		$doctrine_cfg->setProxyNamespace( "Pure\Proxies" );
		$doctrine_cfg->setSQLLogger( new DoctrineLogger() );
		$doctrine_cfg->setProxyDir( APPLICATION_PATH."/repository/core/Pure/Proxies" );
		$doctrine_cfg->setAutoGenerateProxyClasses( !$this->_is_prod_mode );
		
		$driver = $doctrine_cfg->newDefaultAnnotationDriver( $models_paths, false );
		$doctrine_cfg->setMetadataDriverImpl( $driver );
		
		$evm = new EventManager();
		$this->_entity_manager = EntityManager::create( $this->_conn_params, $doctrine_cfg, $evm );
		
	}
	
	/**
	 * 
	 * @return \Doctrine\ORM\EntityManager
	 */
	public function getEntityManager()
	{
		return $this->_entity_manager;
	}
	
	/**
	 * Genere les tables en BDD
	 * 
	 * @param string $drop_existing_tables
	 * @return boolean
	 */
	public function generateTables( $drop_existing_tables=false )
	{
		$classes = $this->getEntityManager()->getMetadataFactory()->getAllMetadata();
		
		if( empty( $classes ) ) return false;
			
		$tool = new SchemaTool( $this->getEntityManager() );
		if( $drop_existing_tables ) $tool->dropSchema( $classes );
		$tool->createSchema( $classes );
		
		return true;
		
	}
	
	/**
	 * 
	 * @param unknown $path
	 */
	public function generateEntities( $path )
	{
		$classes = $this->getEntityManager()->getMetadataFactory()->getAllMetadata();
		
		if( empty( $classes ) ) return false;
		
		$entityGenerator = new EntityGenerator();
		$entityGenerator->setGenerateAnnotations( true );
		$entityGenerator->setGenerateStubMethods( true );
		$entityGenerator->setRegenerateEntityIfExists( false );
		$entityGenerator->setUpdateEntityIfExists( true );
		$entityGenerator->generate( $classes, $path );
		
		return true;
	}
	
	/**
	 * 
	 * http://www.doctrine-project.org/jira/browse/DDC-1698
	 * https://github.com/doctrine/DoctrineBundle/blob/master/DoctrineBundle.php#L57
	 * 
	 * @param string $path - if null generate proxies to default path
	 */
	public function generateProxies()
	{
		$classes = $this->getEntityManager()->getMetadataFactory()->getAllMetadata();
		$tool = $this->getEntityManager()->getProxyFactory();
    	$tool->generateProxyClasses( $classes );
    	
	}
	
	/**
	 * 
	 * @return boolean
	 */
	public function validateSchemas()
	{
		$validator = new SchemaValidator( $this->getEntityManager() );
		$errors = $validator->validateMapping();
		if( count( $errors ) > 0 )
		{
			$this->_logErrors( $errors );
			return false;
		}
		return true;
	}
	
	public function _logErrors( $errors )
	{
		foreach( $errors as $key=>$errs )
		{
			if( is_array( $errs ) )
			{
				$message = implode(  " ", $errs );
				$message = $key." :: ".$message;
				Debug::trace( $message, Debug::ERROR );
			}
			else Debug::trace( $errs, Debug::ERROR );
		}
	}
	
}