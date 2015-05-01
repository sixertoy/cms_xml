<?php
namespace Bluemagic\Objects;

use Bluemagic\Core\Debug;
use Bluemagic\Utils\ArrayUtils;

class ConfigObject
{
	
	private $_entries;
	
	const NAME = "ConfigObject";
	const FULL_NAME = "Bluemagic\Objects\ConfigObject";
	
	public function __construct( $entries )
	{
		$this->_entries = $this->_parseEntries( $entries );
	}

	/**
     * @TODO|PURE http://www.76oner.com/flyspray/index.php?do=details&task_id=13&project=1
     *
     * Retourne une propriete de configuration par sa cle
     * 
	 * @param string $name
	 * @return boolean|Ambigous <\Bluemagic\Utils\unknown, stdClass, boolean, array, \stdClass>
	 */
	public function getConfigByName( $name )
	{
		if( !isset( $this->_entries[ $name ] ) )
		{
			$message = "La configuration $name n'existe pas.";
			Debug::trace( $message, Debug::ERROR );
			return false;
		}
		return ArrayUtils::toObject( $this->_entries[ $name ], false );
		return $this->_entries[ $name ];
	}
	
	/**
	 * Evaluation des valeurs d'un objet d'ini
	 * Les 'false' sont des chaine vides 
	 * 
	 * @param mixed $value
	 * @return mixed
	 */
	private function _evalProperty( $value )
	{
		$result = $value;
		if( empty( $value ) ) $result = (int) 0;
		if( is_numeric( $value ) ) $result = (int) $value;
		return $result;
	}
	
	/**
	 * Parse le fichier de configuration
	 * Evalue les boolean
	 * 
	 * @param array $entries
	 * @return array
	 */
	private function _parseEntries( $entries )
	{
		$config = array();
		foreach( $entries as $file_id=>$file_values )
		{
			foreach( $file_values as $config_id=>$config_values )
			{
				if( !isset( $config[ $config_id ] ) ) $config[ $config_id ] = array();
				if( is_array( $config_values ) )
				{
					$typed_values = array();
					foreach( $config_values as $property=>$property_value )
					{
						if( is_array( $property_value ) )
						{
							foreach( $property_value as $key=>$val )
							{
								if( is_string( $key ) )
								{
									$typed_values[ $property ][ $key ] = $this->_evalProperty( $val );
								}
								else $typed_values[ $property ][] = $val;
							}
						}
						else $typed_values[ $property ] = $this->_evalProperty( $property_value );
					}
					$config[ $config_id ] = array_merge( $config[ $config_id ], $typed_values );
				}
			}
		}
		return $config;
	}	
}