<?php namespace Fust\Pipeline;

/*
 * The link list interface. 
 */

interface ListInterface{
	
	/**
	 * Sets the successor handler
	 */
	function setNext(HandlerInterface $h);	

	/**
	 * Gets the successor handler
	 */
	function getNext();	

}


