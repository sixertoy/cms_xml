<?php
namespace Pure\Core\Blocks\Components;

use Bluemagic\Utils\ArrayUtils;

use Bluemagic\Core\Debug;

use Bluemagic\Utils\StringUtils;

use \ReflectionClass;

use Bluemagic\Core\Object;

use Pure\Interfaces\IProvider;
use Pure\Abstracts\AbstractBlock;

class Datagrid extends AbstractBlock
{
	
	const RELATION_SPLITTER = ":";
	
	protected function __setUp()
	{
		$helper = $this->getHelper();
		if( !( $helper instanceof IProvider ) )
		{
			// @TODO throw warning
		    $message = "Le controller doit etre une instance de l'interface IProvider";
			Debug::trace( $message, Debug::WARN );
		}
		parent::__setUp();
	}
	
	public function is_editable()
	{
		return $this->getDatagrid()->isEditable();
	}
	
	public function getColumns()
	{
		$columns = $this->getDatagrid()->getColumns();
		return $columns;
	}
	
	public function getRecordIdentifier( $record )
	{
		$key = $this->getDatagrid()->getPrimaryKey();
		return $record[ $key ];
	}
	
	public function getRecords()
	{
		$records = array();
		$columns = $this->getDatagrid()->getColumns();
		$entries = $this->getDatagrid()->getRecords();
		if( count( $entries )  )
		{
			foreach( $entries as $entry )
			{
				$item = Array();
				foreach( $columns as $column )
				{
					$key = $column->getKey();
					if( $this->_is_relation( $key ) )
					{
						$obj = $entry;
						$keys = explode( Datagrid::RELATION_SPLITTER, $column->getKey() );
						foreach( $keys as $k )
						{
							$func = "get".$this->_propertyToFunction( $k );
							$value = call_user_func( array( $obj, $func ) );
							if( !ArrayUtils::isLast( $k, $keys ) ) $obj = $value;
						}
						$item[ $column->getKey() ] = $value;
					}
					else
					{
						$func = "get".$this->_propertyToFunction( $column->getKey() );
						$value = call_user_func( array( $entry, $func ) );
						// Si la valeur n'est pas un type objet
						if( !is_object( $value ) )
						{
							$item[ $column->getKey() ] = $value;
						}
						// Sinon on affecte une valeur vide
						// On envoi un warning de debug
						else
						{
							$item[ $column->getKey() ] = StringUtils::EMPTY_STRING;
							$message = "La valeur de l'entite issue de la methode ".$func." est de type object";
							Debug::trace( $message, Debug::WARN );
						}
					}
				}
				$records[] = $item;
			}
		}
		return $records;
	}
	
	/**
	 * Retourne si la cle est de type relationnelle
	 * 
	 * @param string $key
	 * @return boolean
	 */
	private function _is_relation( $key )
	{
		return ( strpos( $key, Datagrid::RELATION_SPLITTER ) !== false );
	}
	
	/**
	 * Prepare un appel de fonction via call_user_func
	 * 
	 * @param string $string
	 * @return string
	 */
	private function _propertyToFunction( $string )
	{
		$strings = explode( "_", $string );
		$strings = array_map( "ucFirst", $strings );
		return implode( "", $strings );
	}
	
	/**
	 * Retourne l'instance du datagrid pour la vue
	 * 
	 * @return \Pure\Core\Components\Datagrid
	 */
	public function getDatagrid()
	{
		return $this->getHelper()->getDatagrid();
	}
}