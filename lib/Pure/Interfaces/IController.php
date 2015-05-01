<?php
namespace Pure\Interfaces;

Interface IController
{
	public function initializeActions();
	
	public function getEntityName();
	public function setEntityName( $value );
}