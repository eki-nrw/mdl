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
interface SubjectTypeGetterInterface
{
	/**
	* Checks if getter supports subject
	* 
	* @param object $subject
	* 
	* @return bool
	*/
	public function support($subject);
	
	/**
	* Returns subject type of a subject
	* 
	* @param object $subject
	* 
	* @return string|null
	*/
	public function getSubjectType($subject);
}
