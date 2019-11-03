<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\REA\Event;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
interface EventTypeInterface
{
	const TRANSFORMATION_INPUT = "event.input";
	const TRANSFORMATION_OUTPUT = "event.output";
	
	const TRANSFERATION_PROVIDE = "event.provide";
	const TRANSFERATION_RECEIVE = "event.receive";
	
	/**
	* Returns event type name
	* 
	* @return string
	*/
	public function getEventType();
	
	/**
	* Checks if event type that is for input or output
	* Applied for transformation event
	* 
	* @return bool|null Null is undefined/not-use
	*/
	public function isInput();
	
	/**
	* Checks if event type is provide or receive
	* Applied for transferation event
	* 
	* @return bool|null Null is undefined/not-use
	*/
	public function isProvide();
	
	/**
	* Returns processing method
	* 
	* @return array
	*/
	// public function getSupportedMethods();
}
