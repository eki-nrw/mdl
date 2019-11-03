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
interface ValidatorInterface
{
	/**
	* Validate object
	* 
	* @param object $object
	* @param array $options
	* 
	* @return void
	* @throws
	*/
	public function validate($object, array $options = []);
	
	/**
	* Checks if validator supports an object
	* 
	* @param object $object
	* 
	* @return bool
	*/
	public function support($object);
}
