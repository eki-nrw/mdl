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
interface PlanTypeInterface extends
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
	public function getPlanType();

	/**
	* Initialize a plan of the plan type
	* 
	* @param PlanInterface $plan
	* 
	* @return void
	*/	
	public function initPlan(PlanInterface $plan);
}
