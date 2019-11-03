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

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
trait HasExecutionTrait
{
	/**
	* @var ExecutionInterface
	*/
	private $execution;
	
	/**
	* @inheritdoc
	*/
	public function getExecution()
	{
		return $this->execution;
	}
	
	/**
	* @inheritdoc
	*/
	public function setExecution(ExecutionInterface $execution = null)
	{
		$this->execution = $execution;
	}
}
