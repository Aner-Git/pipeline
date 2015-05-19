<?php namespace Fust\Pipeline;

abstract class Task extends 
	AbstractHandler implements HandlerExceptionInterface 
{

	use ExceptionTrait;


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


}
