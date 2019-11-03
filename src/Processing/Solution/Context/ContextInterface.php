<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Processing\Solution\Context;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
interface ContextInterface
{
	/**
	* Sets parameter of context
	* 
	* @param string $param
	* @param mixed $value
	* 
	* @return this
	* 
	* @throw \InvalidArgumentException if $param invalid
	* @throw \UnexpectedValueException if $value unexpected
	*/
	public function set($param, $value);

	/**
	* Returns the context parameter
	* 
	* @param string $param
	* 
	* @return mixed|null
	*/
	public function get($param);
	
	/**
	* Return context data of solution
	* 
	* @return array
	*/
	public function getContext();
}
