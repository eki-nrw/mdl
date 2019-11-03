<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Working\Plan;

use Eki\NRW\Mdl\Working\AbstractPlan;
use Eki\NRW\Mdl\Working\PlanTypeInterface;
use Eki\NRW\Mdl\Working\PlanItemInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class RecipePlan extends AbstractPlan implements RecipePlanInterface
{
	/**
	* @inheritdoc
	*/
	protected function matchPlanType(PlanTypeInterface $planType)
	{
		parent::matchPlanType($planType);
		
		if (!$planType->is('recipe'))
			throw new \InvalidArgumentException("Recipe Plan must be recipe plan type.");
	}

	/**
	* Validate Plan Item
	* 
	* @param PlanItemInterface $planItem
	* 
	* @return void
	* @throws
	*/
	protected function validatePlanItem(PlanItemInterface $planItem)
	{
		parent::validatePlanItem($planItem);	

		if (!$planItem->getPlanItemType()->is('recipe'))
			throw new \InvalidArgumentException("Recipe Plan don't accept not-recipe plan item.");
	}
}
