<?php namespace Fust\Pipeline;

interface HandlerExceptionInterface{

	/**
	  * Set Exception
	  * @param object Exception. An exception that halted this Hanlder
	  */
	public function setException(\Exception $e);

	/**
	  * Get Exception
	  * @return object Exception. An exception that halted this Hanlder
	  */
	public function getException();
	
	/**
	  * Was the handler haulted by a thrown Exception
	  * @return bool .  
	  */
	public function isException();

}
