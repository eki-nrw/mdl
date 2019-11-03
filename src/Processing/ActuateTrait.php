<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Processing;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
trait ActuateTrait
{
	/**
	* @var bool
	*/
	protected $actuated = false;
	
	/**
	* @inheritdoc
	* 
	*/
	public function isActuated()
	{
		return ($this->actuated === true);
	}
	
	/**
	* @inheritdoc
	* 
	*/
	public function actuate(array $contexts = [])
	{
		if ($this->isActuated() === true)
			throw new \LogicException("Cannot actuate frame twice.");

		if (false === $this->onBeforeActuate($contexts))
		{
			$this->onBeforeActuateFailed($contexts);
			
			return false;
		}

		$this->actuating($contexts);
		
		$this->actuated = true;

		$this->onAfterActuate($contexts);
		
		return true;
	}

	/**
	* 
	* @param undefined $contexts
	* 
	* @return bool
	*/	
	protected function onBeforeActuate($contexts)
	{
		return true;
	}
	
	/**
	* 
	* @param array $contexts
	* 
	* @return void
	*/
	protected function onBeforeActuateFailed(array $contexts)
	{
		//...
	}
	
	/**
	* 
	* @param array $contexts
	* 
	* @return void
	*/
	protected function onAfterActuate(array $contexts)
	{
		//...
	}
}
