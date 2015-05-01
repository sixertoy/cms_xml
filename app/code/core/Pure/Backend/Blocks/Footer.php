<?php
namespace Pure\Backend\Blocks;

use Smarty;
use Doctrine\Common\Version;

use Pure\Abstracts\AbstractBlock;

class Footer extends AbstractBlock
{
	/**
	 * 
	 * @return string
	 */
	public function getSmartyVersion()
	{
		$version = Smarty::SMARTY_VERSION;
		$exploded = explode( "-", $version );
		return $exploded[ 1 ];
	}
	public function smartyVersion(){ print $this->getSmartyVersion(); }
	
	public function getDoctrineVersion()
	{
		return Version::VERSION;
	}
	public function doctrineVersion(){ print $this->getDoctrineVersion(); }
	
	public function getPureVersion()
	{
		return "0";
	}
	
}