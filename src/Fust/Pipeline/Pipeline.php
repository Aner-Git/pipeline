<?php namespace Fust\Pipeline;

class Pipeline{

	protected $firstTask = null;

	/**
	  * The last Task in the pipeline.
	  */
	protected $lastTask = null;

	/**
	  * The last Task that was executed.
	  */ 
	protected $current = null;
	/**
	  * Did all the Tasks run and succeded
	  */
	protected $ended = false;

	/**
	  * Add a Task to the pipeline (and set it as the successor of the current last Task)
	  * @param Task the next task 
	  */
	public function add(Task $handler){

		if(is_null($this->firstTask)){

			$this->firstTask = $this->lastTask = $handler;	

		}else{
		
			$this->lastTask->setNext($handler);	

			$this->lastTask = $handler;	
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

		$current = 	$this->current = $this->firstTask; 

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
	 * @return mixed null|Task 
	 */
	public function getLastTask(){

		return $this->current;	
	}
}
