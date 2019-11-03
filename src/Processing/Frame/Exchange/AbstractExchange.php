<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Processing\Frame\Exchange;

use Eki\NRW\Mdl\Processing\Frame\AbstractFrame;
use Eki\NRW\Mdl\Processing\Frame\FrameInterface;
use Eki\NRW\Mdl\Processing\ElementInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
abstract class AbstractExchange extends AbstractFrame implements ExchangeInterface
{
	const FRAME_TYPE = FrameInterface::FRAME_TYPE_EXCHANGE;

	/**
	* @inheritdoc
	* 
	*/
	public function receive(ElementInterface $frameReceive, array $contexts = [])
	{
		if ($this->getReceive() !== null)
			throw new \LogicException("Cannot receive for exchange twice.");

		if (false === $this->onBeforeReceive($frameReceive, $contexts))
		{
			$this->onBeforeReceiveFailed($frameReceive, $contexts);
			
			return false;
		}

		$this->setReceive($frameReceive);				

		$this->onAfterReceive($frameReceive, $contexts);
	}

	/**
	* @inheritdoc
	* 
	*/
	public function provide(ElementInterface $frameProvide, array $contexts = [])
	{
		if (!$this->isActuated())
			throw new \LogicException("Actuating before outputing.");
		if ($this->getProvide() !== null)
			throw new \LogicException("Cannot call 'provide' twice.");
		
		if (false === $this->onBeforeProvide($frameProvide, $contexts))
		{
			$this->onBeforeProvideFailed($frameProvide, $contexts);
			
			return false;
		}

		$packed = $this->pack(array('default'=>$frameProvide), $contexts);
		$this->setProvide(reset($packed));
	
		$frameProvide = $this->getProvide();
		$this->onAfterProvide($frameProvide, $contexts);

		return $frameProvide;
	}

	/**
	* @inheritdoc
	* 
	*/
	public function getReceive()
	{
		return $this->getStorage()->getInput();
	}

	/**
	* Sets receive data
	* 
	* @param ElementInterface $receive
	* 
	* @return void
	*/
	protected function setReceive(ElementInterface $receive)
	{
		$receive->setFrame($this);
		$this->getStorage()->setInput($receive);
	}

	/**
	* @inheritdoc
	* 
	*/
	public function getProvide()
	{
		return $this->getStorage()->getOutput();
	}

	/**
	* Sets provide data
	* 
	* @param ElementInterface $provide
	* 
	* @return void
	*/
	protected function setProvide(ElementInterface $provide)
	{
		$provide->setFrame($this);
		$this->getStorage()->setOutput($provide);
	}

	/**
	*  
	* @param ElementInterface $frameReceive
	* @param array $contexts
	* 
	* @return bool
	*/
	protected function onBeforeReceive(ElementInterface $frameReceive, array $contexts)
	{
		return true;
	}
	
	/**
	*  
	* @param ElementInterface $frameReceive
	* @param array $contexts
	* 
	* @return void
	*/
	protected function onBeforeReceiveFailed(ElementInterface $frameReceive, array $contexts)
	{
		//...
	}
	
	/**
	*  
	* @param ElementInterface $frameReceive
	* @param array $contexts
	* 
	* @return void
	*/
	protected function onAfterReceive(ElementInterface $frameReceive, array $contexts)
	{
		//...
	}

	/**
	*  
	* @param ElementInterface $frameProvide
	* @param array $contexts
	* 
	* @return bool
	*/
	protected function onBeforeProvide(ElementInterface $frameProvide, array $contexts)
	{
		return true;
	}

	/**
	*  
	* @param ElementInterface $frameProvide
	* @param array $contexts
	* 
	*/
	protected function onBeforeProvideFailed(ElementInterface $frameProvide, array $contexts)
	{
		//...
	}

	/**
	*  
	* @param ElementInterface $frameProvide
	* @param array $contexts
	* 
	*/
	protected function onAfterProvide(ElementInterface $frameProvide, array $contexts)
	{
		//...
	}

	/////////////////////////////////
	// PipableInterface implemtation
	//
	/////////////////////////////////

	/**
	* @inheritdoc
	* 
	*/
	public function canPipe()
	{
		if ($this->getProvide() === null)
			return false;
		
		return true;
	}
	
	/**
	* @inheritdoc
	* 
	*/
	public function canPipeIn($key, ElementInterface $element, array $contexts)
	{
		if ($this->isActuated())
			return false;
			
		return true;
	}
	
	/**
	* @inheritdoc
	* 
	*/
	public function pipeIn($key, ElementInterface $element, array $contexts)
	{
		$this->receive($element, $contexts);	
	}
}
