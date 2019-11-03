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
trait HasEventTypeTrait
{
	/**
	* @var EventTypeInterface
	*/
	private $eventType;
	
	/**
	* @inheritdoc
	*/	
	public function getEventType()
	{
		return $this->eventType;
	}

	/**
	* @inheritdoc
	*/	
	public function setEventType(EventTypeInterface $eventType = null)
	{
		$this->eventType = $eventType;
	}
}
