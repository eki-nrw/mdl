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
interface WorkingSubjectInterface extends BuildingSubjectInterface
{
	/**
	* Returns working type
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
	
	/**
	* Do an action 
	* 
	* @param string $actionName
	* @param array $contexts
	* 
	* @return void
	* @throws
	*/
	public function action($actionName, array $contexts = []);
	
	/**
	* Checks if can do action
	* 
	* @param string $actionName
	* @param array $contets
	* 
	* @return bool
	*/
	public function can($actionName, array $contexts = []);
}
