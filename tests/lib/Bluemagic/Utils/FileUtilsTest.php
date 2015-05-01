<?php
namespace Bluemagic\Utils;

use PHPUnit_Framework_TestCase;
use Bluemagic\Utils\FileUtils;

class FileUtilsTest extends PHPUnit_Framework_TestCase
{
	function setUp()
	{
	}

	/**
	 * Retourne les infos sur chemin
	 * 
	 * http://techtavern.wordpress.com/2009/04/06/regex-that-matches-path-filename-and-extension/
	 * @TODO Savoir si le fichier est lu par le serveur
	 * @param string $file_full_path 
	 * @return	 string 
	 */
	public function testGetFileBase()
	{
		$this->markTestIncomplete();
	}

	/**
	 * Retourne le nom du fichier sans l'extension
	 */
	public function testGetFileName()
	{
		$this->markTestIncomplete();
	}

	/**
	 * Retourne l'extension du fichier 
	 */
	public function testGetFileExtension()
	{
		$this->markTestIncomplete();
	}

	public function testGetFilePathInfo()
	{
		$this->markTestIncomplete();
	}

	/**
	 * Cree un nouveau dossier
	 * 
	 * @param unknown $foldername
	 * @param number $chmod
	 * @param string $recursive
	 * @return boolean
	 */
	public function testCreateFolder()
	{
		$this->markTestIncomplete();
	}

	public function testCreateFile()
	{
		$this->markTestIncomplete();
	}

	function tearDown()
	{
	}

}
