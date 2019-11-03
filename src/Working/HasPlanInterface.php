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
interface HasPlanInterface
{
	/**
	* Gets plan
	* 
	* @return PlanIterface
	*/
	public function getPlan();
	
	/**
	* Sets plan
	* 
	* @param PlanIterface $plan
	* 
	* @return void
	*/
	public function setPlan(PlanInterface $plan = null);
}
