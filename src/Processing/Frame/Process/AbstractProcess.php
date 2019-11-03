<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Processing\Frame\Process;

use Eki\NRW\Mdl\Processing\Frame\AbstractFrame;
use Eki\NRW\Mdl\Processing\Frame\FrameInterface;
use Eki\NRW\Mdl\Processing\ElementInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
abstract class AbstractProcess extends AbstractFrame implements ProcessInterface
{
	const FRAME_TYPE = FrameInterface::FRAME_TYPE_PROCESS;

	/**
	* @inheritdoc
	* 
	*/
	public function in(ElementInterface $frameInput, array $contexts = [])
	{
		$key = $frameInput->getKey();

		if (empty($key))
			throw new \InvalidArgumentException("Parameter 'frameInput' must have key not empty.");
		if ($this->getInput($key) !== null)
			throw new \InvalidArgumentException("Input of key '$key' already exists.");
	
		if (false === $this->onBeforeIn($frameInput, $contexts))
		{
			$this->onBeforeInFailed($frameInput, $contexts);
			
			return false;
		}
				
		$this->setInput($frameInput, $key);

		// Opportunity to extend
		$this->onAfterIn($frameInput, $contexts);
		
		return true;
	}

	/**
	* @inheritdoc
	* 
	*/
	public function out(ElementInterface $frameOutput, array $contexts = [])
	{
		if (!$this->isActuated())
			throw new \LogicException("Call 'actuate' before outputing.");
		if ($this->getOutput() !== null)
			throw new \LogicException("Cannot call 'out' twice.");
		
		if (false === $this->onBeforeOut($frameOutput, $contexts))
		{
			$this->onBeforeOutFailed($frameOutput, $contexts);
			
			return false;
		}
		
		// Attention: A process has only one putput
		$packed = $this->pack(array('default'=>$frameOutput), $contexts);
		$this->setOutput(reset($packed));
		
		$frameOutput = $this->getOutput();
		$this->onAfterOut($frameOutput, $contexts);

		return $frameOutput;
	}

	/**
	* Function called before input
	* 
	* @param ElementInterface $frameInput
	* @param mixed array $contexts
	* 
	* @return bool
	*/
	protected function onBeforeIn(ElementInterface $frameInput, array $contexts)
	{
		return true;
	}
	
	/**
	* Function called when onBeforeIn function returns false. This is the opportunity to notify
	* 
	* @param ElementInterface $frameInput
	* @param mixed array $contexts
	* 
	* @return void
	*/
	protected function onBeforeInFailed(ElementInterface $frameInput, array $contexts)
	{
		//...
	}
	
	/**
	* Function called after input successfully
	* 
	* @param ElementInterface $frameInput
	* @param mixed array $contexts
	* 
	* @return void
	*/
	protected function onAfterIn(ElementInterface $frameInput, array $contexts)
	{
		//...
	}
	
	/**
	* Function called before output
	* 
	* @param ElementInterface $frameOutput
	* @param array $contexts
	* 
	* @return bool
	*/
	protected function onBeforeOut(ElementInterface $frameOutput, array $contexts)
	{
		return true;
	}

	/**
	* Function called when onBeforeOut function returns false. This is the opportunity to notify
	* 
	* @param ElementInterface $frameOutput
	* @param array $contexts
	* 
	* @return bool
	*/
	protected function onBeforeOutFailed(ElementInterface $frameOutput, array $contexts)
	{
		//...	
	}
	
	/**
	* Function called after output successfully
	* 
	* @param ElementInterface $frameOutput
	* @param array $contexts
	* 
	* @return void
	*/
	function onAfterOut(ElementInterface $frameOutput, array $contexts)
	{
		//....
	}

	/**
	* @inheritdoc
	* 
	*/
	public function getInput($key)
	{
		return $this->getStorage()->getInput($key);
	}

	/**
	* Sets input 
	* 
	* @param ElementInterface $frameInput
	* #param string $key
	* 
	* @return void
	*/
	protected function setInput(ElementInterface $frameInput, $key)
	{
		$frameInput->setFrame($this);
		$this->getStorage()->setInput($frameInput, $key);	
	}
	
	/**
	* @inheritdoc
	* 
	*/
	public function getInputs()
	{
		return $this->getStorage()->getInputs();
	}
	
	/**
	* @inheritdoc
	* 
	*/
	public function getOutput()
	{
		return $this->getStorage()->getOutput();
	}

	/**
	* Sets output
	* 
	* @param ElementInterface $frameOutput
	* 
	* @return void
	*/
	protected function setOutput(ElementInterface $frameOutput)
	{
		$frameOutput->setFrame($this);
		$this->getStorage()->setOutput($frameOutput);	
	}
	
	/////////////////////
	// PipableInterface
	/////////////////////
	
	/**
	* @inheritdoc
	* 
	*/
	public function canPipe()
	{
		if ($this->getOutput() === null)
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
		return $this->in($element, $contexts);	
	}
}
