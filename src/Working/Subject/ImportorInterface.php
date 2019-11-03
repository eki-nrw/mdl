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
interface ImportorInterface
{
	/**
	* Checks if it can be imported
	* 
	* @param mixed $data Data imports to object
	* @param object $object Object is imported from data
	* 
	* @return bool
	*/
	public function support($data, $object);
	
	/**
	* Import data to object
	* 
	* @param mixed $data
	* @param object &$object
	* @param array $contexts
	* 
	* @return void
	* @throws
	*/
	public function import($data, &$object, array $contexts = []);
}
