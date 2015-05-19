<?php namespace Fust\Pipeline;

class Pipeline{

	protected $firstHandler = null;

	/**
	  * The last handler in the pipeline.
	  */
	protected $lastHandler = null;

	/**
	  * The last handler that was executed.
	  */ 
	protected $current = null;
	/**
	  * Did all the handlers run and succeded
	  */
	protected $ended = false;

	/**
	  * Add a handler to the pipeline (and set it as the successor of the current last handler)
	  * @param Handler the next handler 
	  */
	public function add(Handler $handler){

		if(is_null($this->firstHandler)){

			$this->firstHandler = $this->lastHandler = $handler;	

		}else{
		
			$this->lastHandler->setNext($handler);	

			$this->lastHandler = $handler;	
		}

		return $this;
	}

	/**
	  * Start the execution of the handler in the pipeline
	  * Continues execution as long as a handler return true from the handle.
	  * Exception thrown by the handler will be caught and will stop the execution. 
	  * @param array input array
	  */
	public function start(array $input = array()){

		$current = 	$this->current = $this->firstHandler; 

		$status = true;	

		while(! is_null($current) && $status){

			$this->current = $current; 

			$status = $current->handle($input);	

			$current = $current->getNext();

		}

		$this->ended = $status;

		return $this->ended;

	}
	
	/**
	 * Indicates that all handlers executed in the pipeline
	 * @return bool true all handler executed, false some error.  
	 */
	public function ended(){

		return $this->ended;	
	}

	/**
	 * Get the last handler executed in the pipeline
	 * @return mixed null|Handler 
	 */
	public function getLastHandler(){

		return $this->current;	
	}
}
