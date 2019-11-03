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
class ExecutePlan extends AbstractPlan
{
	/**
	* @inheritdoc
	*/
	protected function matchPlanType(PlanTypeInterface $planType)
	{
		parent::matchPlanType($planType);
		
		if (!$planType->is('execute'))
			throw new \InvalidArgumentException("Execute Plan must be execute plan type.");
	}

	/**
	* @inheritdoc
	*/
	protected function validatePlanItem(PlanItemInterface $planItem)
	{
		parent::validatePlanItem($planItem);	
			
		if (!$planItem->getPlanItemType()->is('execute'))
			throw new \InvalidArgumentException("Execute Plan don't accept not-execute plan item.");
	}
}
