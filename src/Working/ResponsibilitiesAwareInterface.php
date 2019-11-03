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
interface ResponsibilitiesAwareInterface
{
	/**
	* Get responsibility of role
	* 
	* @param string $role
	* 
	* @return ResponsibilityInterface
	*/
	public function getResponsibility($role);
	
	/**
	* Set responsibility
	* 
	* @param ResponsibilityInterface|null $responsibility
	* 
	* @return void
	* @throws \InvalideArgumentException
	*/
	public function setResponsibility(ResponsibilityInterface $responsibility = null, $role = null);
	
	/**
	* Checks if a responsibility of given role exists
	* 
	* @param string $role
	* 
	* @return bool
	*/
	public function hasResponsibility($role);
	
	/**
	* Get all responsibilities
	* 
	* @return ResponsibilityInterface[]
	*/
	public function getResponsibilities();
	
	/**
	* Set all responsibilities
	* 
	* @param array $responsibilities
	* 
	* @return void
	* @throws \InvalideArgumentException
	*/
	public function setResponsibilities(array $responsibilities);
}
