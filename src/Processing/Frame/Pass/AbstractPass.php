<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Processing\Frame\Pass;

use Eki\NRW\Mdl\Processing\Frame\FrameInterface;
use Eki\NRW\Mdl\Processing\Frame\AbstractFrame;
use Eki\NRW\Mdl\Processing\ElementInterface;
use Eki\NRW\Common\Timing\TimingTrait;

use DateTime;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
abstract class AbstractPass extends AbstractFrame implements PassInterface
{
	const FRAME_TYPE = FrameInterface::FRAME_TYPE_PASS;

	use	
		TimingTrait
	;
	
	/**
	* @inheritdoc
	* 
	*/
	public function arrive(array $contexts = [])
	{
		if (false === $this->onBeforeArrive($contexts))
		{
			$this->onBeforeArriveFailed($contexts);
			
			return false;
		}
				
		$this->setTime("arrive", $this->getTimeArrive($contexts));

		$this->onAfterArrive($contexts);
		
		return true;
	}

	private function getTimeArrive(array $contexts)
	{
		if (isset($contexts['time_arrive']))
		{
			$time = $contexts['time_arrive'];
			if (is_string($time))
				return new DateTime($time);
			else if ($time instanceof DateTime)
				return $time;
			else
				throw new \InvalidArgumentException("Arrive time determined in contexts must be string or DateTime.");
		}
		else
			return new DateTime("now");
	}

	private function getTimeLeave(array $contexts)
	{
		if (isset($contexts['time_leave']))
		{
			$time = $contexts['time_leave'];
			if (is_string($time))
				return new DateTime($time);
			else if ($time instanceof DateTime)
				return $time;
			else
				throw new \InvalidArgumentException("Leave time determined in contexts must be string or DateTime.");
		}
		else
			return new DateTime("now");
	}

	/**
	* @inheritdoc
	* 
	*/
	public function leave(ElementInterface $frameLeave, array $contexts = [])
	{
		if (!$this->isActuated())
			throw new \LogicException("Call 'actuate' before leaving.");
		if ($this->getLeave() !== null)
			throw new \LogicException("Cannot call 'leave' twice.");
		
		if (false === $this->onBeforeLeave($frameLeave, $contexts))
		{
			$this->onBeforeLeaveFailed($frameLeave, $contexts);
			
			return false;
		}
		
		$packed = $this->pack(array('default'=>$frameLeave), $contexts);
		$this->setOutput(reset($packed));
		
		$this->setTime("leave", $this->getTimeLeave($contexts));
		
		$frameLeave = $this->getOutput();
		$this->onAfterLeave($frameLeave, $contexts);

		return true;
	}

	/**
	* Function called before input
	* 
	* @param mixed array $contexts
	* 
	* @return bool
	*/
	protected function onBeforeArrive(array $contexts)
	{
		return true;
	}
	
	/**
	* Function called when onBeforeArrive function returns false. This is the opportunity to notify
	* 
	* @param mixed array $contexts
	* 
	* @return void
	*/
	protected function onBeforeArriveFailed(array $contexts)
	{
		//...
	}
	
	/**
	* Function called after input successfully
	* 
	* @param mixed array $contexts
	* 
	* @return void
	*/
	protected function onAfterArrive($frameArrive, array $contexts)
	{
		//...
	}
	
	/**
	* Function called before leaving
	* 
	* @param ElementInterface $frameLeave
	* @param array $contexts
	* 
	* @return bool
	*/
	protected function onBeforeLeave(ElementInterface $frameLeave, array $contexts)
	{
		return true;
	}

	/**
	* Function called when onBeforeLeave function returns false. This is the opportunity to notify
	* 
	* @param ElementInterface $frameLeave
	* @param array $contexts
	* 
	* @return bool
	*/
	protected function onBeforeLeaveFailed(ElementInterface $frameLeave, array $contexts)
	{
		//...	
	}
	
	/**
	* Function called after leaveput successfully
	* 
	* @param ElementInterface $frameLeave
	* @param array $contexts
	* 
	* @return void
	*/
	function onAfterLeave(ElementInterface $frameLeave, array $contexts)
	{
		//....
	}

	/**
	* @inheritdoc
	* 
	*/
	public function getLeave()
	{
		return $this->getStorage()->getOutput();
	}

	/**
	* Sets leaveput
	* 
	* @param ElementInterface $frameLeave
	* 
	* @return void
	*/
	protected function setLeave(ElementInterface $frameLeave)
	{
		$frameLeave->setFrame($this);
		$this->getStorage()->setOutput($frameLeave);	
	}
	
	/////////////////////
	// PipableArriveInterface
	/////////////////////
	
	/**
	* @inheritdoc
	* 
	*/
	public function canPipe()
	{
		if ($this->getLeave() === null)
			return false;
		
		return true;
	}
	
	/**
	* @inheritdoc
	* 
	*/
	public function canPipeIn($key, ElementInterface $element, array $contexts)
	{
		return false;
	}
	
	/**
	* @inheritdoc
	* 
	*/
	public function pipeIn($key, ElementInterface $element, array $contexts)
	{
		throw new \LogicException("No support for this method");
	}
}
