<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\REA\Process\Event\Transform;

use Eki\NRW\Mdl\REA\Event\EventInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
interface TransformInterface
{
	/**
	* Returns the name of transform
	* 
	* @return string
	*/
	public function getTransformName();
	
	/**
	* Sets the name of transform
	* 
	* @param string $transformName
	* 
	* @return void
	*/
	public function setTransformName($transformName);
	
	/**
	* Get all input events
	* 
	* @return array
	*/
	public function getInputEvents();
	
	/**
	* Add input event
	* 
	* @param EventInterface $event
	* @param string|key $key
	* 
	* @return void
	*/
	public function addInputEvent(EventInterface $event, $key);

	/**
	* Get input event
	* 	 
	* @param string $key
	* 
	* @return EventInterface
	*/
	public function getInputEvent($key);
	
	/**
	* Checks if there is an input event of key
	* 
	* @param string $key
	* 
	* @return bool
	*/
	public function hasInputEvent($key);
	
	/**
	* Get output event
	* 	 
	* @return EventInterface
	*/
	public function getOutputEvent();
	
	/**
	* Set output event 
	* 
	* @param EventInterface $event
	* 
	* @return void
	*/
	public function setOutputEvent(EventInterface $event = null);
}
