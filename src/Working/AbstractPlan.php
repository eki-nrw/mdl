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

use Eki\NRW\Common\Timing\TimingTrait;
use Eki\NRW\Common\Compose\ObjectStates\ObjectStatesTrait;
use Eki\NRW\Common\Common\DocumentationTrait;
use Eki\NRW\Common\Common\InfoTrait;
use Eki\NRW\Mdl\Working\PlanTypeInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
abstract class AbstractPlan implements PlanInterface
{
	use
		PlanCoreTrait,
		PlanItemsAwareTrait,
		HasPlanTypeTrait,
		TimingTrait,
		ResponsibilitiesAwareTrait,
		ObjectStatesTrait,
		DocumentationTrait,
		InfoTrait
	;

	/**
	* Constructor
	* 
	* @param PlanTypeInterface $planType
	* 
	*/
	public function __construct(PlanTypeInterface $planType = null)
	{
		$this->setPlanType($planType);
	}

	/**
	* @inheritdoc
	*/
	protected function matchPlanType(PlanTypeInterface $planType)
	{
	}

	/**
	* Validate Plan Item
	* 
	* {@internal Called by public function addPlanItem(PlanItemInterface $planItem, $key)}
	* 
	* @param PlanItemInterface $planItem
	* 
	* @return void
	* 
	* @throws \UnexpectedValueException
	*/
	protected function validatePlanItem(PlanItemInterface $planItem)
	{
		if (null === ($planItemType = $planItem->getPlanItemType()))
			throw new \UnexpectedValueException("Plan Item has no type.");
			
		if (false === $this->getPlanType()->accept('add_plan_item', $planItemType))
		{
			throw new \UnexpectedValueException(sprintf(
				"Cannot add a plan item with type '%s'.", 
				$planItemType->getPlanItemType()
			));
		}
	}
}
