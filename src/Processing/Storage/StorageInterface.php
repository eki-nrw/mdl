<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Processing\Storage;

use Eki\NRW\Mdl\Processing\ElementInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
interface StorageInterface
{
	/**
	* Get input by key
	* 
	* @param string $key
	* 
	* @return ElementInterface
	*/
	public function getInput($key);
	
	/**
	* Sets input
	* 
	* @param ElementInterface $input
	* @param string|null $key
	* 
	* @return void
	* @throws
	*/
	public function setInput(ElementInterface $input, $key = null);
	
	/**
	* Get all inputs
	* 
	* @return ElementInterface[]
	*/
	public function getInputs();

	/**
	* Get output
	* 
	* @param string|null $key
	* 
	* @return ElementInterface
	*/
	public function getOutput($key = null);
	
	/**
	* Get all outputs
	* 
	* @return ElementInterface[]
	*/
	public function getOutputs();

	/**
	* Sets output
	* 
	* @param ElementInterface $output
	* @param string|null $key
	* 
	* @return void
	* @throws
	*/
	public function setOutput(ElementInterface $output, $key = null);
	
	/**
	* Return actuated result
	* 
	* @return mixed
	*/
	public function getActuatedResult();
	
	/**
	* Sets actuated result
	* 
	* @param mixed $result
	* 
	* @return void
	*/
	public function setActuatedResult($result);
}
