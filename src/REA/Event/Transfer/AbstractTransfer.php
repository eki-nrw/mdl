<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\REA\Exchange\Event\Transfer;

use Eki\NRW\Mdl\REA\Event\EventInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
abstract class AbstractTransfer implements TransferInterface
{
	protected $transferName;
	protected $provideEvent;
	protected $receiveEvent;
	protected $reciprocal;
	
	/**
	* @inheritdoc
	*/
	public function getTransferName()
	{
		return $this->transferName;
	}

	/**
	* @inheritdoc
	*/
	public function setTransferName($transferName)
	{
		$this->transferName = $transferName;
	}
	
	/**
	* @inheritdoc
	*/
	public function getProvideEvent()
	{
		return $this->provideEvent;
	}
	
	/**
	* @inheritdoc
	*/
	public function setProvideEvent(EventInterface $event)
	{
		if (null === ($eventType = $event->getEventType()))
			throw new \InvalidArgumentException("Event has no type.");
		if ($eventType->isProvide() !== true)
			throw new \InvalidArgumentException("Event is not provide type.");
		if ($this->provideEvent !== null)
			throw new \InvalidArgumentException('Cannot add provide event twice.');
		
		$this->provideEvent = $event;
	}
	
	/**
	* @inheritdoc
	*/
	public function getReceiveEvent()
	{
		return $this->receiveEvent;
	}
	
	/**
	* @inheritdoc
	*/
	public function setReceiveEvent(EventInterface $event)
	{
		if (null === ($eventType = $event->getEventType()))
			throw new \InvalidArgumentException("Event has no type.");
		if ($eventType->isProvide() !== false)
			throw new \InvalidArgumentException("Event is not receive type.");
		if ($this->receiveEvent !== null)
			throw new \InvalidArgumentException('Cannot add receive event twice.');

		$this->receiveEvent = $event;
	}
	
	/**
	* @inheritdoc
	*/
	public function setReciprocal($reciprocal = true)
	{
		$this->reciprocal = $reciprocal;
	}
	
	/**
	* @inheritdoc
	*/
	public function isReciprocal()
	{
		return $this->reciprocal;
	}
}

