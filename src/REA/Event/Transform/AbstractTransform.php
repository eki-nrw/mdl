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
abstract class AbstractTransform implements TransformInterface
{
	private $transformName;
	private $inputs = [];
	private $output;
	
	/**
	* Returns the name of transform
	* 
	* @return string
	*/
	public function getTransformName()
	{
		return $this->transformName;
	}
	
	/**
	* Sets the name of transform
	* 
	* @param string $transformName
	* 
	* @return void
	*/
	public function setTransformName($transformName)
	{
		$this->transformName = $transformName;
	}
	
	/**
	* Get all input events
	* 
	* @return InputEventInterface[]
	*/
	public function getInputEvents()
	{
		return $this->inputs;
	}
	
	/**
	* @inheritdoc
	*/
	public function addInputEvent(EventInterface $event, $key)
	{
		if (null === ($eventType = $event->getEventType()))
			throw new \InvalidArgumentException("Event has no type.");
		if ($eventType->isInput() !== true)
			throw new \InvalidArgumentException("Event is not input type.");
		if (isset($this->inputs[$key]))
			throw new \InvalidArgumentException(sprintf('Input event with key %s already exists.', $key));
			
		$this->inputs[$key] = $event;
	}
	
	/**
	* @inheritdoc
	*/
	public function getInputEvent($key)
	{
		if (!$this->hasInputEvent($key))
			throw new \InvalidArgumentException("No input event with key $key.");
			
		return $this->inputs[$key];
	}
	
	/**
	* @inheritdoc
	*/
	public function hasInputEvent($key)
	{
		return isset($this->inputs[$key]);
	}
	
	/**
	* @inheritdoc
	*/
	public function getOutputEvent()
	{
		return $this->output;
	}
	
	/**
	* @inheritdoc
	*/
	public function setOutputEvent(EventInterface $event = null)
	{
		if (null !== $event)
		{
			if (null === ($eventType = $event->getEventType()))
				throw new \InvalidArgumentException("Event has no type.");
			if ($eventType->isInput() !== false)
				throw new \InvalidArgumentException("Event is not output type.");
			if ($this->output !== null)
				throw new \InvalidArgumentException('Cannot add output event twice.');
		}

		$this->output = $event;
	}
}
