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
trait HasPlanItemTypeTrait
{
	/**
	* @var PlanItemTypeInterface
	*/
	private $planItemType;
	
	/**
	* @inheritdoc
	*/
	public function getPlanItemType()
	{
		return $this->planItemType;
	}
	
	/**
	* @inheritdoc
	*/
	public function setPlanItemType(PlanItemTypeInterface $planItemType = null)
	{
		$this->planItemType = $planItemType;
	}
}
