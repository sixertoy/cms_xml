<?php
namespace Bluemagic\Core;

use Bluemagic\Core\Debug;

class Collection
{
	
	protected $_data;
	protected $_index;
	protected $_length;
	protected $_isReadOnly;
	
	public function __construct()
	{
		$this->_index = 0;
		$this->_length = 0;
		$this->_fixedSize = 0;
		$this->_data = array();		
		$this->_isFixedSize = false;
		$this->_isReadOnly = false;
	}
	
	public function toArray(){ return $this->_data; }
	public function items(){ return $this->toArray(); }
	
	public function isFirst( $pItem ){ return ( $this->get( 0 ) == $pItem ); }
	public function isLast( $pItem ){ return ( $this->get( $this->_index - 1 ) == $pItem ); }
	
	public function length(){ return count( $this->_data ); }
	public function hasItems(){ return ( $this->length() > 0 ); }
	public function sort(){ sort( $this->_data, SORT_STRING ); }
	
	public function setIsReadOnly( $pValue ){ $this->_isReadOnly = $pValue; }
	public function setIsFixedSize( $pValue ){ $this->_isFixedSize = $pValue; }
	public function setFixedSize( $pValue ){ $this->_fixedSize = $pValue; $this->_isFixedSize = ( $pValue > 0 ); }
	
	/**
	 * Ajoute des elements a la collection
	 * @param object $pItem
	 */
	public function add( $pItem )
	{
		if( $this->_isFixedSize )
		{
			if( $this->_length < $this->_fixedSize )
			{
					$this->_data[] = $pItem;
					$this->_length = count( $this->_data );
					return true;
			}else return $this->__maxSize();
		}else if( $this->_isReadOnly ) return $this->__readOnly();
		else
		{
			$this->_data[] = $pItem;
			$this->_length = count( $this->_data );
			return true;
		}
	}
	public function addRange( $pItems )
	{
		foreach( $pItems as $item) $this->add( $item );
	}
	
	/**
	 * Supprime des elements de la collection
	 * @param int $pIndex
	 * @return boolean
	 */
	public function removeAt( $pIndex )
	{
		if( !$this->IsReadOnly )
		{
			if( key_exists( $pIndex, $this->_data ) )
			{ 
				unset( $this->_data[ $pIndex ] );
				$this->_length = count( $this->_data );
				return true;
			}else return $this->__outOfRange();
		}else return $this->__readOnly();
	}
	
	public function remove( $pItem )
	{
		$index = $this->indexOf( $pItem );
		$this->removeAt( $index );
	}
	public function removeRange( $pStart, $pEnd ){ for( $i = $pStart; $i < $pEnd; $i++) $this->removeAt( $i ); }
	
	public function indexOf( $pItem, $pStartIndex=0 )
	{
		for( $i = $pStartIndex; $i < ( $this->_length - $pStartIndex ); $i++ )
		{
			if( $this->_data[ $i ] == $pItem ) return $i;
			return -1;
		}
	}
	
	public function getItemIndex( $pItem )
	{
		$index = 0;
		foreach( $this->_data as $item )
		{
			if( $item === $pItem ) return $index;
			$index++;
		}
	}
	
	public function lastIndexOf( $pItem )
	{
		$lastIndex = -1; 
		for( $i = 0; $i < $this->_length; $i++ )
		{
			if( $this->_data[ $i ] == $pItem ) $lastIndex = $i;
		}
		return $lastIndex;
	}
	
	
	/**
	 * Recupere l'item a l'index en parametre
	 * Sinon avance l'iterateur
	 * @param int $pIndex
	 * @return object/boolean
	 */
	public function get( $pIndex=null )
	{
		$index = ( is_null( $pIndex ) ) ? $this->_index : $pIndex;
		if( isset( $this->_data[ $index ] ) )
		{
        	if( is_null( $pIndex ) ) $this->_index++;
			return$this->_data[ $index ];
		}else return false;
	}
	
	public function contains( $pItem )
	{
		foreach( $this->_data as $item ) if( $item == $pItem ) return true;
		return false;
	}
	
	public function insert( $pIndex, $pItem )
	{		
		if( $this->_isFixedSize )
		{
			if( $pIndex < $this->_fixedSize )
			{
				$this->_data[ $pIndex ] = new CollectionItem( $pItem, $this );
				$this->_length = count( $this->_data );
				return true;
			}else return $this->__maxSize();
		}else if( $this->_isReadOnly ) return $this->__readOnly();
		else
		{
			$this->items[ $pIndex ] = new CollectionItem( $pItem, $this );
			$this->_length = count( $this->_data );
		}
	}
	
	protected function __readOnly()
	{
		Debug::trace( "Collection :: is read only", Debug::WARN );
		return false;		
	}
	protected function __maxSize()
	{
		Debug::trace( "Collection :: max size has been reached", Debug::WARN );
		return false;		
	}
	protected function __outOfRange()
	{
		Debug::trace( "Collection :: index is out of range", Debug::WARN );
		return false;		
	}
	
}
