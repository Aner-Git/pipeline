<?php namespace Fust\Pipeline;

abstract class AbstractHandler implements HandlerInterface{

	/**
	  *The next handler.
	  */
	private $successor = null;

	/**
	 * Sets the successor handler
	 */
	public function setNext(Handler $h){
	
		$this->successor = $h;
	}

	/**
	 * Gets the successor handler
	 */
	public function getNext(){
		
		return $this->successor; 	
	}


}
