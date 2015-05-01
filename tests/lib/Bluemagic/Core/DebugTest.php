<?php
namespace Bluemagic\Core;

use PHPUnit_Framework_TestCase;
use Bluemagic\Core\Debug;

class DebugTest extends PHPUnit_Framework_TestCase
{
	function setUp()
	{
	}

	public function testUseAjax()
	{
		$this->markTestIncomplete();
	}

	public function testGetTypes()
	{
		$this->markTestIncomplete();
	}

	public function testGetMessages()
	{
		$this->markTestIncomplete();
	}

	public function testSetExceptionFile()
	{
		$this->markTestIncomplete();
	}

	public function testSetDebugFile()
	{
		$this->markTestIncomplete();
	}

	public function testSetSQLFile()
	{
		$this->markTestIncomplete();
	}

	public function testSetErrorFile()
	{
		$this->markTestIncomplete();
	}

	public function testSetFatal()
	{
		$this->markTestIncomplete();
	}

	/**
	 * Defini si les erreurs sont tracees a l'ecran
	 * 
	 * @param unknown $value
	 */
	public function testSetDisplaysErrors()
	{
		$this->markTestIncomplete();
	}

	/**
	 * Definie si les erreurs sont tracees dans un fichier de log
	 *
	 * @param unknown $value
	 */
	public function testSetLogErrors()
	{
		$this->markTestIncomplete();
	}

	/**
	 * Si l'application ne tourne pas sur l'environnement de production
	 * On efface les fichiers de logs a chaque chargement
	 * 
	 * Le fichier de debug est efface a chaque chargement
	 * 
	 */
	public function testSetEnvironnement()
	{
		$this->markTestIncomplete();
	}

	/**
	 * Affecte un niveau de debug pour le fichier de log
	 * Verifie si l'erreur est permise pour le debug
	 * Si l'erreur le niveau est trouve dans le tableau on l'ajoute au autorisation de debugs
	 * Si le niveau est atteint on sort de la boucle
	 * 
	 * @param string $level
	 * @return boolean
	 */
	public function testSetTraceLevel()
	{
		$this->markTestIncomplete();
	}

	/**
	 * Supprime les fichiers de log sur le serveur
	 * 
	 * @param boolean $clear_exceptions
	 */
	public function testClearLogsFiles()
	{
		$this->markTestIncomplete();
	}

	/**
	 * Cree un debug message
	 * 
	 * Si le code d'erreur du debug message et de type Debug::FATAL
	 * Une exception est levee et l'application est stoppee
	 * 
	 * @param string $message
	 * @param object $caller
	 * @param string $errorCode
	 * 
	 * @return Bluemagic\Objects\DebugMessage
	 */
	public function testTrace()
	{
		$this->markTestIncomplete();
	}

	/**
	 * Définit une fonction utilisateur de gestion d'exceptions
	 * 
	 * @link http://php.net/manual/fr/function.set-exception-handler.php
	 * 
	 * @param Exception $exception
	 * @return boolean
	 */
	public function testException_handler()
	{
		$this->markTestIncomplete();
	}

	function tearDown()
	{
	}

}
