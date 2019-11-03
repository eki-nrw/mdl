<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Processing\Actuate;

use Eki\NRW\Mdl\Processing\ElementInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
trait ActuateByActuatorTrait
{
	/**
	* @var ActuatorInterface
	*/
	protected $actuator;

	/**
	* Sets actuator
	* 
	* @param ActuatorInterface|null $actuator
	* 
	* @return void
	*/
	public function setActuator(ActuatorInterface $actuator = null)
	{
		$this->actuator = $actuator;
	}

	/**
	* Returns actuator
	* 
	* @param array $contexts
	* 
	* @return ActuatorInterface
	*/
	protected function getActuator(array $contexts = [])
	{
		$actuator = null;
		
		if (isset($contexts['processing_actuator']))
			$actuator = $contexts['processing_actuator'];

		if ($this->actuator !== null)
			$actuator = $this->actuator;
			
		if ($actuator !== null)
			$actuator->setFrame = $this;
			
		return $actuator;
	}
	
	/**
	* @inheritdoc
	* 
	*/
	protected function actuating(array $contexts)
	{
		$actuatedResult = $this->getActuator($contexts)->actuating($this->getFrameInput(), $contexts);
		$this->setActuatedResult($actuatedResult, $contexts);
	}
	
	/**
	* @inheritdoc
	* 
	*/
	public function pack(array $frameOutputs, array $contexts = [])
	{
		$actuator = $this->getActuator($contexts);
		return $actuator->pack($frameOutputs, $this->getActuatedResult(), $contexts);
	}
}
