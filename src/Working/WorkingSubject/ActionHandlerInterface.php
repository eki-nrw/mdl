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
interface ActionHandlerInterface
{
	/**
	* Checks if handler supports to handle action for subject
	* 
	* @param object $subject
	* @param string $actionName
	* 
	* @return bool
	*/
	public function support($subject, $actionName);
	
	/**
	* Handle an action for subject
	* 
	* @param object $subject
	* @param string $actionName
	* @param array $contexts
	* 
	* @return void
	* 
	* @throws \DomainException Exception throwed when no supporting
	*/
	public function handle($subject, $actionName, array $contexts = []);

	/**
	* Return working type
	* 
	* @return string
	*/
	public function getWorkingType();
	
	/**
	* Sets working type
	* 
	* @param string $workingType
	* 
	* @return void
	*/
	public function setWorkingType($workingType);
}
