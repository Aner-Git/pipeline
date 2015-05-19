<?php namespace Fust\Pipeline;

trait ListTrait{

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
