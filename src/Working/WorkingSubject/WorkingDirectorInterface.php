<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Working\WorkingSubject;

use Eki\NRW\Mdl\Working\WorkingSubjectInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
interface WorkingDirectorInterface
{
	/**
	* Get/Build a working subject
	* 
	* @param string $workingType
	* 
	* @return WorkingSubjectInterface
	* @throws \UnexpectedValueException
	*/
	public function getWorkingSubject($workingType);
	
	/**
	* Checks if the director supports working subject
	* 
	* @param string $workingType
	* 
	* @return bool
	*/
	public function support($workingType);
}
