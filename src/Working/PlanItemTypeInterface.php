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
interface PlanItemTypeInterface extends
	TypeCheckingInterface
{
	/**
	* Plan type
	* 
	* Ex.: 
	* 	+ Plan to produce
	*   + Plan to sale
	* 
	* @return string
	*/
	public function getPlanItemType();

	/**
	* Gets all roles
	* 
	* @return string[]
	*/	
	public function getRoles();
	
	/**
	* Initialize a plan item of the plan item type
	* 
	* @param PlanItemInterface $planItem
	* 
	* @return void
	*/
	public function initPlanItem(PlanItemInterface $planItem);
}
