<?php namespace Fust\Pipeline;

/*
 * The handler interface. Implementation will do the work
 */

interface HandlerInterface{
	
	/**
	 * Execute the task for this handler
	 *
	 * @param array $input the input param for this task
	 * @return boolean success status
	 */
	function handle(array& $input);


	/**
	 * Sets the successor handler
	 */
	function setNext(HandlerInterface $h);	

	/**
	 * Gets the successor handler
	 */
	function getNext();	

}


