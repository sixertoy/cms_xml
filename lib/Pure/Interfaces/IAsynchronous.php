<?php
namespace Pure\Interfaces;

/**
 * Interface pour le type de Block AJAX

 * @author malas
 */
Interface IAsynchronous
{
	public function ajax();
	
	public function getAsyncURL();
	
}