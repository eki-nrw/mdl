<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Working\Subject;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
interface MapperInterface
{
	/**
	* Map an element
	* 
	* @param string $name
	* @param mixed $type
	* @param mixed $data
	* 
	* @return void
	*/
	public function map($name, $type, $data);
	
	/**
	* Checks if support map method
	* 
	* @param string $name
	* @param mixed $type
	* @param mixed $data
	* 
	* @return bool
	*/
	public function support($name, $type, $data);
	
}
