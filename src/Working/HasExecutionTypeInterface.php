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
interface HasExecutionTypeInterface
{
	/**
	* Returns execution type
	* 
	* @return ExecutionTypeInterface
	*/
	public function getExecutionType();
	
	/**
	* Sets execution type
	* 
	* @param ExecutionTypeInterface|null $executionType
	*/
	public function setExecutionType(ExecutionTypeInterface $executionType = null);
}
