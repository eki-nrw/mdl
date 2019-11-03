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

use Eki\NRW\Mdl\Working\PlanTypeInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class ProposalPlanType extends PlanType
{
	/**
	* @inheritdoc
	*/
	public function getPlanType()
	{
		return "plan.proposal";
	}
	
	/**
	* @inheritdoc
	*/
	public function is($thing)
	{
		if ($thing === 'proposal')
			return true;
			
		return parent::is($thing);
	}
	
	/**
	* @inheritdoc
	*/
	public function accept($thing, $content)
	{
		if ($thing === 'add_plan_item' and $content instanceof PlanItemTypeInterface)
		{
			return $content->is('proposal');
		}
		
		return parent::accept($thing, $content);
	}
}
