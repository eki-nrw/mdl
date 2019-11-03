<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Working;

use Eki\NRW\Common\Compose\ObjectItem\HasObjectItemInterface;
use Eki\NRW\Common\Timing\StartEndTimeInterface;
use Eki\NRW\Common\Compose\ObjectStates\ObjectStatesInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
interface ExecutionInterface extends
	HasExecutionTypeInterface,
	StartEndTimeInterface,
	ObjectStatesInterface
{
	/**
	* Returns the name of execution
	* 
	* @return string
	*/
	public function getName();
	
	/**
	* Ses the name of execution
	* 
	* @param string $name
	* 
	* @return void
	*/
	public function setName($name);
	
	/**
	* Returns subject to execute
	* 
	* @return mixed
	*/
	public function getSubject();
	
	/**
	* Sets subject to execute
	* 
	* @param mixed $subject
	* 
	* @return void
	* @throws
	*/
	public function setSubject($subject);
	
	/**
	* Returns engine info.
	* 
	* @return mixed
	*/
	public function getEngine();
	
	/**
	* Sets engine info
	* 
	* @param mixed $engine
	* 
	* @return void
	* @throws
	*/
	public function setEngine($engine);
}
