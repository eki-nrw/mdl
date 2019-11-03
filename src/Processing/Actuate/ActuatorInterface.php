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
//use Eki\NRW\Mdl\Processing\HasFrameInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
interface ActuatorInterface
{
	/**
	* Checks if the actuator accepts input
	* 
	* @param mixed $inputSubject
	* @param array $contexts
	* 
	* @return bool
	*/
	public function acceptInput($inputSubject, array $contexts = []);

	/**
	* Core function of the actuation
	* 
	* @param array $frameInputs
	* @param array $contexts
	* 
	* @return void
	* 
	* @throws
	*/
	public function actuating(array $inputs, array $contexts);

	/**
	* Pack produced result to format of output
	* 
	* @param ElementInterface[] $output
	* @param mixed $actuatedResult
	* @param array $contexts
	* 
	* @return ElementInterface[] Output that is packed
	* 
	* @throws \InvalidArgumentException 
	* @throws \RuntimeException 
	* 
	*/
	public function pack(array $outputs, $actuatedResult, array $contexts);
	
	/**
	* Checks if the actuator accepts output
	* 
	* @param mixed $outputSubject
	* @param array $contexts
	* 
	* @return bool
	*/
	public function acceptOutput($outputSubject, array $contexts = []);
}
