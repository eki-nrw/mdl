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
trait HasPlanTrait
{
	/**
	* @var PlanInterface
	*/
	private $plan;
	
	/**
	* @inheritdoc
	*/
	public function getPlan()
	{
		return $this->plan;
	}
	
	/**
	* @inheritdoc
	*/
	public function setPlan(PlanInterface $plan = null)
	{
		$this->plan = $plan;
	}
}
