<?php
namespace Bluemagic\Loaders;

use PHPUnit_Framework_TestCase;
use Bluemagic\Loaders\ConfigLoader;

class ConfigLoaderTest extends PHPUnit_Framework_TestCase
{
	function setUp()
	{
	}

	/**
	 * Charge les fichiers de configuration
	 * Le chemin du fichier doit etre absolu
	 * @TODO verifier l'include_path sur le fopen
	 *  
	 * @param array $files
	 * @return \Bluemagic\Core\Object
	 */
	public function testLoad()
	{
		$this->markTestIncomplete();
	}

	function tearDown()
	{
	}

}
