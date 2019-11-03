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
interface ResponsibilityInterface
{
	/**
	* Returns role of actor 
	* 
	* @return string
	*/
	public function getRole();
	
	/**
	* Sets role of actor
	* 
	* @param string $role
	* 
	* @return void
	*/
	public function setRole($role);
	
	/**
	* Gets actor
	* 
	* @return mixed
	*/
	public function getActor();
	
	/**
	* Sets actor
	* 
	* @param mixed $actor
	* 
	* @return void
	*/
	public function setActor($actor);
}
