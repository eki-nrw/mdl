<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Working\PlanItem;

use Eki\NRW\Mdl\Working\AbstractPlanItem;
use Eki\NRW\Mdl\Working\PlanItemTypeInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class PlanItem extends AbstractPlanItem
{
	/**
	* @inheritdoc
	*/
	protected function matchPlanItemType(PlanItemTypeInterface $planItemType)
	{
		parent::matchPlanItemType($planItemType);
	}
}
