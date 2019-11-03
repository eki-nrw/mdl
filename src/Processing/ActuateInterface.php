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
interface ActuateInterface
{
	/**
	* Run to prepare out result
	* 
	* @param array $contexts 
	* 
	* @return void
	* 
	* @throw \LogicException
	*/
	public function actuate(array $contexts = []);
	
	/**
	* Checks if the process is actuated
	* 
	* @return bool
	*/
	public function isActuated();
	
	/**
	* Returns actuated result after actuator ran
	* 
	* @return ElementInterface
	*/
	public function getActuatedResult(array $contexts = []);
	
	/**
	* Pack actuated result to frame output
	* 
	* @param ElementInterface|ElementInterface[] $frameOutput
	* @param array $contexts 
	*
	* @return ElementInterface|ElementInterface[]
	*/
	public function pack(array $frameOutputs, array $contexts = []);
}
