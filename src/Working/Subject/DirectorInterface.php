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

use Eki\NRW\Mdl\Working\ObjectBuilderInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
interface DirectorInterface
{
	/**
	* Get an appropriate builder for type
	* 
	* @param mixed $type
	* 
	* @return ObjectBuilderInterface
	* @throws \UnexpectedValueException
	*/
	public function getBuilder($type);
	
	/**
	* Checks if director supports a type
	* 
	* @param string $type
	* 
	* @return bool
	*/
	public function support($type);
}
