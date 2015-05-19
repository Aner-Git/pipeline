<?php namespace Fust\Pipeline;

trait ExceptionTrait{
	/**
	  * The exception that was thrown while processing a handler
	  */

	private $exception = null;

	/**
	  * Set Exception
	  * @param object Exception. An exception that halted this Hanlder
	  */
	public function setException(\Exception $e){
		
		$this->exception = $e;	
	}

	/**
	  * Get Exception
	  * @return object Exception. An exception that halted this Hanlder
	  */
	public function getException(){
	
		return $this->exception;
	}
	
	/**
	  * Was the handler haulted by a thrown Exception
	  * @return bool .  
	  */
	public function isException(){
		
		return ! is_null($this->exception);	
	
	}

}
