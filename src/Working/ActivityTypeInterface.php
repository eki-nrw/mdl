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
interface ActivityTypeInterface extends
	TypeCheckingInterface
{
	/**
	* Returns activity type
	* 
	* @return string
	*/
	public function getActivityType();
	
	/**
	* Initialize activity of the activity type
	* 
	* @param ActivityInterface $activity
	* 
	* @return void
	*/
	public function initActivity(ActivityInterface $activity);
}
