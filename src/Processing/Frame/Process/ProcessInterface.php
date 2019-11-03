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

use Eki\NRW\Mdl\Processing\Frame\FrameInterface;
use Eki\NRW\Mdl\Processing\ElementInterface;
use Eki\NRW\Mdl\Processing\ActuateInterface;
use Eki\NRW\Mdl\Processing\PipableInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
interface ProcessInterface extends 
	FrameInterface,
	ActuateInterface,
	PipableInterface
{
	/**
	* Add input, one or many times
	* 
	* @param ElementInterface $frameInput
	* @param array $contexts
	* 
	* @return void
	* @throws
	*/
	public function in(ElementInterface $frameInput, array $contexts = []);

	/**
	* Out from the process, only one time
	* 
	* @param ElementInterface $frameOutput
	* @param mixed $contexts
	* 
	* @return void  //???ElementInterface
	* 
	* @throws
	*/
	public function out(ElementInterface $frameOutput, array $contexts = []);
	
	/**
	* Get input by key
	* 
	* @param string $key
	* 
	* @return ElementInterface
	*/
	public function getInput($key);
	
	/**
	* Get all inputs
	* 
	* @return mixed[]
	*/
	public function getInputs();
	
	/**
	* Get output
	* 
	* @return ElementInterface
	*/
	public function getOutput();
}
