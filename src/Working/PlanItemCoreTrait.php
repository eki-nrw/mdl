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
trait PlanItemCoreTrait
{
	/**
	* @var int
	*/
	protected $priority = 0;
	
	/**
	* @var string
	*/
	protected $name;
	
	/**
	* Returns order number in item list
	* 
	* @return int
	*/
	public function getPriority()
	{
		return $this->priority;
	}
	
	/**
	* @inheritdoc
	*/
	public function setPriority($priority)
	{
		$this->priority = $priority;
		
		return $this;
	}
	
	/**
	* @inheritdoc
	*/
	public function getName()
	{
		return $this->name;
	}
	
	/**
	* @inheritdoc
	*/
	public function setName($name)
	{
		$this->name = $name;
		
		return $this;
	}
}
