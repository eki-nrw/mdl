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
interface HasEventTypeInterface
{
	/**
	* Gets event type
	* 
	* @return EventtypeInterface
	*/
	public function getEventType();
	
	/**
	* Sets event type
	* 
	* @param EventTypeInteface $eventType
	* 
	* @return void
	*/
	public function setEventType(EventTypeInterface $eventType = null);
}
