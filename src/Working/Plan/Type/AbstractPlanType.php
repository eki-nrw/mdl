<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Working\Plan\Type;

use Eki\NRW\Mdl\Working\PlanInterface;
use Eki\NRW\Mdl\Working\PlanTypeInterface;
use Eki\NRW\Mdl\Working\PlanItemTypeInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
abstract class AbstractPlanType implements PlanTypeInterface
{
	/**
	* @inheritdoc
	*/
	public function initPlan(PlanInterface $plan)
	{
		//...
	}
	
	/**
	* @inheritdoc
	*/
	public function is($thing)
	{
		return false;
	}

	/**
	* @inheritdoc
	*/
	public function accept($thing, $content)
	{
		if ($thing === 'add_plan_item' and $content instanceof PlanItemTypeInterface)
		{
			return true;
		}

		return false;
	}
}
