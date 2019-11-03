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
interface HasExecutionInterface
{
	/**
	* Gets execution
	* 
	* @return ExecutionIterface
	*/
	public function getExecution();
	
	/**
	* Sets execution
	* 
	* @param ExecutionIterface $execution
	* 
	* @return void
	*/
	public function setExecution(ExecutionInterface $execution = null);
}
