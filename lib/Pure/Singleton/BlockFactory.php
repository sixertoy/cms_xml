<?php
namespace Pure\Singleton;

use Bluemagic\Utils\StringUtils;

use Bluemagic\Core\CoreConstants;

use Exception;

use Pure\Core\ApplicationConstants;

use Bluemagic\Core\Debug;
use Bluemagic\Utils\ArrayUtils;
use Bluemagic\Utils\Normalizer;
use Bluemagic\Core\ClassLoader;
use Bluemagic\Helpers\DomHelper;
use Bluemagic\Singleton\ClassFactory;

class BlockFactory extends ClassFactory
{

	const ARRAY_TYPE = "array";
    const BLOCKS_SUBPACKAGE_NAME = "Blocks";
    
	const ABSTRACT_TYPE_NAME = "pure_abstracts";
	const ABSTRACT_CLASS_NAME = "Pure\Abstracts\AbstractBlock";
	
	/**
	 * Parse les noeuds enfants d'un block
	 * Cree les instances des blocks
	 * 
	 * @param Bluemagic\Abstracts\Blocks\AbstractBlock $pParent
	 */
	static public function parseBlockChilds( $block_parent )
	{
		$blocks = array();
		$methods = array();
		foreach( $block_parent->getChildNodes() as $child )
		{
			$type = $child->nodeType;
			if( $type == XML_TEXT_NODE ) continue;
			if( $type == XML_COMMENT_NODE ) continue;
			switch( $child->nodeName )
			{
				case "block":
// 					$id = $block_parent->getId().".".DomHelper::getNodeAttr( $child, "id" );
					$id = DomHelper::getNodeAttr( $child, "id" );
					$result = self::_createChild( $child, $id, $block_parent );
					if( $result )
					{
						$blocks[ $id ] = $result;
					}
					else
					{
						$message = "Le block '$id' n'a pas ete ajoute";
						Debug::trace( $message, Debug::WARN );
					}
					break;
				case "call":
					$method = self::_callXMLMethod( $child, $block_parent );
					if( $method ) $methods[] = $method;
					break;
			}
		}
		if( !empty( $methods ) ) $block_parent->addCallMethods( $methods );
		return $blocks;
	}
	
	/**
	 * @TODO chemin des templates dynamique + fallback
	 * @TODO fallback sur le core\block si pas de type de definit puis sur l'abstractblock
	 * 
	 * @param nodeslist $pChild
	 */
	static private function _createChild( $child, $id, $parent )
	{	
		$type = DomHelper::getNodeAttr( $child, "type" );
		$template = DomHelper::getNodeAttr( $child, "template" );
		$debuggable = DomHelper::getNodeAttr( $child, "debuggable" );
		// Si le type n'est pas definit
		// On utilise type par defaut 'AbstractBlock'
		if( !$type )
		{
			$message = "Aucune definition de type pour le block '$id'. Le type ".self::ABSTRACT_CLASS_NAME." est utilise";
			Debug::trace( $message, Debug::DEBUG );
			$type = self::ABSTRACT_TYPE_NAME;
			$class_name = self::ABSTRACT_CLASS_NAME;
		}
		else $class_name = self::_getClassName( $type );
		// Si la classe de block n'est pas valide
		// On ajoute pas le block a la vue
		if( !$class_name )
		{
			$message = "La definition de type pour le block '$id' n'est pas valide";
			Debug::trace( $message, Debug::ERROR );
			return false;
		}
		$block = self::newInstance( $class_name, array( $parent ) );
		$block->setType( $type );
		$block->setId( $parent->getId().".".$id );
		if( $template ) $block->setTemplate( $template );
		if( $debuggable ) $block->setDebuggable( $debuggable );
		if( $child->hasChildNodes() )
		{
			$block->parseChilds( $child->childNodes );
		}
		return $block;
	}
	
	/**
	 * Retourne la classe du block a charge
	 * Le parametre class_underscored/slashed doit compose xxx_xxx
	 * Le block a charger doit se situer dans un dossier nomme block
	 * 
	 * @param string $class_underscored
	 * @return boolean
	 */
	static private function _getClassName( $type_underscored_slashed )
	{
		if( !strpos( $type_underscored_slashed, ClassLoader::SLASH_SPLITTER ) ) return false;
	    $slashed = explode( ClassLoader::SLASH_SPLITTER, $type_underscored_slashed );
	    $class_underscored = implode( "_".self::BLOCKS_SUBPACKAGE_NAME."_", $slashed );
		$underscored = explode( CoreConstants::UNDERSCORE, $class_underscored );
		$class_name = array_map( "ucfirst", $underscored );
		$class_name = implode( ClassLoader::SLASH_SPLITTER, $class_name );
		return $class_name;
	}
	
	/**
	 * Appelle une methode sur le block
	 * <call method="addCss"><file>css/bootstrap.min.css</file></call>
	 * 
	 * @TODO verifier l'ecriture du fichier XML
	 * 
	 * @param Pure\Abstracts\AbstractBlock
	 */
	static private function _callXMLMethod( $call_node, $block )
	{
		if( !$call_node->hasChildNodes() ) return false;
		$args = array();
		// Recupere la fonction a appelle sur le block
		$method = DomHelper::getNodeAttr( $call_node, "method" );
		if( !$method )
		{
			$message = "La methode d'appel n'est pas definie sur '".$block->getId()."'";
			Debug::trace( $message, Debug::ERROR );
			return false;
		}
		// Recupere les enfants
		$provider = $call_node->getElementsByTagName( "provider" );
		$is_provider = ( $provider->length > 0 );
		// Si c'est un noeud a 'value' multiple
		if( $is_provider )
		{
			$provider = $provider->item( 0 );
			$type = DomHelper::getNodeAttr( $provider, "type" );
			switch( $type )
			{
				case self::ARRAY_TYPE:
					$values_nodes = $provider->getElementsByTagName( "value" );
					foreach( $values_nodes as $node )
					{
						$value = self::_getValueNodeString( $node );
						if( is_array( $value ) ) $args[ $value[ 0 ] ] = $value[ 1 ];
						elseif( $value ) $args[] = $value;
					}
					$args = array( $args );
					break;
			}
		}
		// Si c'est un simple noeud a valeur unique
		else
		{
			$node = $call_node->getElementsByTagName( "value" )->item( 0 );
			$value = self::_getValueNodeString( $node );
			if( $value ) $args[] = $value;
		}
		// Execute la methode sur le block
		$message = "Method Call '".$method."' sur '".$block->getId()."'";
		Debug::trace( $message, Debug::DEBUG );
		return array( $method, $args );
	}
	
	/**
	 * 
	 * @param unknown $provider
	 * @return Ambigous <array, boolean, string>
	 */
	static private function _getValueNodeString( $node )
	{
		$key = false;
		// Si le noeud a un attribut, on retourne un array
		$node_attr = $node->attributes;
		if( $node_attr->length > 0 ) $key = trim( $node_attr->item( 0 )->nodeValue );
		$node_value = trim( $node->firstChild->nodeValue );
		if( $key ) return array( $key, $node_value );
		else return ( !empty( $node_value ) ) ? $node_value : false;
	}
	
}