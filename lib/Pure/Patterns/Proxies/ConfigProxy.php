<?php
namespace Pure\Patterns\Proxies;

use Bluemagic\Core\Debug;

use stdClass;

use Bluemagic\Utils\ArrayUtils;

use PureMVC\Patterns\Proxy\Proxy;

class ConfigProxy extends Proxy
{
    const NAME = "ConfigProxy";
    const FULL_NAME = "Pure\Proxies\ConfigProxy";

    /**
     * Retourne les vues definies dans le .ini
     *
     * @return Bluemagic\Core\Object
     */
    public function getViews()
    {
        $result = $this->getData()->getConfigByName( "views" );
        return $result;
    }

    /**
     * Retourne les vues definies dans le .ini
     * Seules les vues qui ont besoin d'un authentification
     * Sont retournees dans un array pour base sur le params 'name' du .ini
     * @return array
     */
    public function getRestrictedViews()
    {
        $result = array();
        $views = $this->getViews();
        foreach( $views as $id=>$props ) if( $props->secured )  $result[] = $id;
        return $result;
    }
    
    /**
     * Retourne la cle d'API du fichier ini
     * @return boolean|string
     */
    public function getAPIKey()
    {
        $apikey = $this->getData()->getConfigByName( "secured" )->apikey;
        $apikey = trim( $apikey );
        if( !( (bool) $apikey ) || empty( $apikey ) || ( strlen( $apikey ) != 32 ) )
        {
            $message = "La cl&eacute; d'API n'est pas correcte";
            Debug::trace( $message, Debug::DEBUG );
        	return false;
        }else return $apikey;
    }
    
    /**
     * Retourne la configuration du moteur de template Smarty
     * @return unknown
     */
    public function getSmartyConfig()
    {
        $result = $this->getData()->getConfigByName( "smarty" );
        return $result;
    }

    /**
     * Retourne l'objet de configuration pour la gestion des fichiers de cache
     * @return stdClass
     */
    public function getCacheConfig()
    {
        $result = $this->getData()->getConfigByName( "cache" );
        return $result;
    }

    /**
     * Retourne l'objet de configuration pour la gestion du connecter
     * @return stdClass
     */
    public function getApplicationConfig()
    {
        $object = new stdClass();
        $object->apikey = $this->getAPIKey();
        $object->smarty = $this->getSmartyConfig(); 
        $object->is_production = ( ( bool ) $this->getData()->getConfigByName( "environnement" )->production === true );
        return $object;
    }

    /**
     * Retourne l'objet de configuration
     * Issu du Bluemagic\Object\ConfigObject
     * Pour la configuration du RequestProxy
     * @return stdClass
     */
    public function getRequestConfig()
    {
//         $object->url_reserved_keys = $this->getRequestReservedKeys();
        $object = new stdClass();
        $object->restricted_views = $this->getRestrictedViews();
        $object->cms_view = $this->getData()->getConfigByName( "vars" )->cms_view;
        $object->home_view = $this->getData()->getConfigByName( "vars" )->home_view;
        $object->install_view = $this->getData()->getConfigByName( "vars" )->install_view;
        $object->error_layout = $this->getData()->getConfigByName( "vars" )->error_layout;
//         $object->default_layout = $this->getData()->getConfigByName( "vars" )->default_layout;
        $object->base_url = $this->getData()->getConfigByName( "environnement" )->base_url;
        return $object;
    }
}