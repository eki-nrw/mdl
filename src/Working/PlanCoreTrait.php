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
trait PlanCoreTrait
{
	protected $planName;
	protected $objective;
	protected $timing = [];
	protected $solution;
	
	/**
	* @inheritdoc
	*/
	public function getPlanName()
	{
		return $this->planName;
	}
	
	/**
	* @inheritdoc
	*/
	public function setPlanName($planName)
	{
		$this->planName = $planName;
	}
	
	/**
	* @inheritdoc
	*/
	public function getObjective()
	{
		return $this->objective;
	}
	
	/**
	* @inheritdoc
	*/
	public function setObjective($objective)
	{
		$this->objective = $objective;
	}

	/**
	* @inheritdoc
	*/
	public function getSolution()
	{
		return $this->solution;
	}
	
	/**
	* @inheritdoc
	*/
	public function setSolution($solution)
	{
		$this->solution = $solution;
	}
}
