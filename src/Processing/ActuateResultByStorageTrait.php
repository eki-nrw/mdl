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
trait ActuateResultByStorageTrait
{
	/**
	* Store produced result to get later
	* 
	* @param mixed $produced
	* @param array $contexts
	* 
	* @return void
	*/
	protected function setActuatedResult($produced, array $contexts = [])
	{
		$this->getStorage()->setActuatedResult($produced);	
	}

	/**
	* @inheritdoc
	* 
	*/
	public function getActuatedResult(array $contexts = [])
	{
		return $this->getStorage()->getActuatedResult();	
	}
}
