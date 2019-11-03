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
class Responsibility implements ResponsibilityInterface
{
	private $role;
	private $actor;
	
	public function __construct($role, $actor)
	{
		$this->setRole($role);
		$this->setActor($actor);
	}
	
	/**
	* @inheritdoc
	*/
	public function getRole()
	{
		return $this->role;
	}
	
	/**
	* @inheritdoc
	*/
	public function setRole($role)
	{
		$this->role = $role;
	}
	
	/**
	* @inheritdoc
	*/
	public function getActor()
	{
		return $this->actor;
	}
	
	/**
	* @inheritdoc
	*/
	public function setActor($actor)
	{
		$this->actor = $actor;
	}
}
