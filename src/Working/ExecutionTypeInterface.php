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
interface ExecutionTypeInterface extends
	TypeCheckingInterface
{
	/**
	* Returns execution type
	* 
	* @return string
	*/
	public function getExecutionType();
	
	/**
	* Initialize an execution of the execution type
	* 
	* @param ExecutionInterace $execution
	* 
	* @return void
	*/
	public function initExecution(ExecutionInterface $execution);
}
