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

use Eki\NRW\Mdl\Processing\Storage\StorageInterface;
use Eki\NRW\Mdl\Processing\ElementInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class Storage implements StorageInterface
{
	protected $inputs = [];
	protected $outputs = [];
	protected $actuatedResult;
	
	/**
	* @inheritdoc
	* 
	*/
	public function getInput($key = null)
	{
		if ($key === null)
			$key = 'default';
			
		if (isset($this->inputs[$key]))
			return $this->inputs[$key];
	}

	/**
	* @inheritdoc
	* 
	*/
	public function setInput(ElementInterface $input, $key = null)
	{
		if ($key === null)
			$key = 'default';
			
		$this->inputs[$key] = $input;
	}
	
	/**
	* @inheritdoc
	* 
	*/
	public function getInputs()
	{
		return $this->inputs;
	}

	/**
	* @inheritdoc
	* 
	*/
	public function getOutput($key = null)
	{
		if ($key === null)
			$key = 'default';

		if (isset($this->outputs[$key]))
			return $this->outputs[$key];
	}

	/**
	* @inheritdoc
	* 
	*/
	public function getOutputs()
	{
		return $this->outputs;
	}

	/**
	* @inheritdoc
	* 
	*/
	public function setOutput(ElementInterface $output, $key = null)
	{
		if ($key === null)
			$key = 'default';

		$this->outputs[$key] = $output;
	}
	
	/**
	* @inheritdoc
	* 
	*/
	public function getActuatedResult()
	{
		return $this->actuatedResult;
	}
	
	/**
	* @inheritdoc
	* 
	*/
	public function setActuatedResult($result)
	{
		$this->actuatedResult = $result;
	}
}
