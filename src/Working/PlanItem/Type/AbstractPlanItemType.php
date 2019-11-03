<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Working\PlanItem\Type;

use Eki\NRW\Mdl\Working\PlanItemTypeInterface;
use Eki\NRW\Mdl\Working\PlanItemInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
abstract class AbstractPlanItemType implements PlanItemTypeInterface
{
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
		return false;
	}

	/**
	* @inheritdoc
	*/
	public function getRoles()
	{
		return array();
	}

	/**
	* @inheritdoc
	*/
	public function initPlanItem(PlanItemInterface $planItem)
	{
		//...
	}	
}
