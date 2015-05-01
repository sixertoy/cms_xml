<?php
namespace Bluemagic\Components;

use Bluemagic\Core\Debug;

use Bluemagic\Core\Collection;

class DataGrid
{
	
	private $_records;
	private $_columns;
	private $_is_editable;
	private $_primary_key;
	
	public function __construct()
	{
		$this->_is_editable = false;
		$this->_records = new Collection();
		$this->_columns = new Collection();
	}
	
	public function setEditable( $value )
	{
		$this->_is_editable = $value;
		return $this;
	}
	
	public function isEditable()
	{
		return $this->_is_editable;
	}

	public function addColumn( $column )
	{
		$this->_columns->add( $column );
		if( $column->isIdentifier() )
		{
			if( is_null( $this->_primary_key ) ) $this->_primary_key = $column->getKey();
			else
			{
				$message = "Un identifier est deja attribue pour cette datagrid";
				Debug::trace( $message, Debug::DEBUG );
			}
		}
		return $this;
	}
	
	public function getPrimaryKey()
	{
		return $this->_primary_key;
	}
	
	public function getColumns()
	{
		return $this->_columns->items();
	}
	
	public function getColumnsLength()
	{
		return $this->_columns->length();
	}
	
	public function setColumns( $column )
	{
		$this->_columns->addRange( $column );
		return $this;
	}

	public function addRecord( $label )
	{
		$this->_records->add( $label );
		return $this;
	}
	
	public function getRecords()
	{
		return $this->_records->items();
	}
	
	public function getRecordsLength()
	{
		return $this->_records->length();
	}
	
	public function setRecords( $records )
	{
		$this->_records->addRange( $records );
		return $this;
	}
	
}
