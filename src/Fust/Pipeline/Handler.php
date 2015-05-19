<?php namespace Fust\Pipeline;

abstract class Handler implements
	HandlerInterface,
	   	HandlerExceptionInterface 
{

	use ListTrait;

	private $exception = null;

	/**
	 * Execute the task for this handler
	 *
	 * @param array $input the input param for this task
	 * @return boolean success status
	 */
	function handle(array& $input){

		try{

				$status = $this->process($input);	

			}catch(\Exception $e){

				$status = false;

				$this->setException($e);
			}

		return $status;	
	}

	/**
	 * Execute the task for this handler
	 *
	 * @param array $input the input param for this task
	 * @return boolean success status
	 */
	abstract protected function process(array& $input);

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
