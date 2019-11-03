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
interface SubjectCreatorInterface
{
	/**
	* Checks if creator supports subject
	* 
	* @param string $subjectType
	* 
	* @return bool
	*/
	public function support($subjectType);
	
	/**
	* Returns a new subject of the given type
	* 
	* @param string $subjectType
	* 
	* @return string|null
	*/
	public function create($subjectType);
}
