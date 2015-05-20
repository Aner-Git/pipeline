<?php namespace Fust\Pipeline;

abstract class AbstractHandler implements HandlerInterface, ListInterface{

	/**
	  *The next handler.
	  */
	private $successor = null;

	/**
	 * Sets the successor handler
	 */
	public function setNext(HandlerInterface $h){
	
		$this->successor = $h;
	}

	/**
	 * Gets the successor handler
	 */
	public function getNext(){
		
		return $this->successor; 	
	}


}
