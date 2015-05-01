<?php
namespace Pure\User\Blocks;

use Pure\Abstracts\AbstractBlock;

class Admin extends AbstractBlock
{
	public function getUsername()
	{
		return "Matthieu";
	}
	
	public function getRole()
	{
		return "Admin";
	}
}