<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Working\Subject\Callback\Plan;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class ProposalPlanCallback extends PlanCallback
{
	/**
	* @inheritdoc
	*/
	public function getCallbackType()
	{
		return 'plan.proposal';
	}

	protected function addPlanItemSupport($type, $data)
	{
		if (false === parent::addPlanItemSupport($type, $data))
			return false;

		$planItem = $data;
		if (null === ($planItemType = $planItem->getPlanItemType()))
			return false;
		if ($planItemType->is('proposal') === false)
			return false;
			
		return true;
	}
}
