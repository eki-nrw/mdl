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
trait ActivityTypeAwareTrait
{
	protected $activityType;
	
	/**
	* Sets activity type
	* 
	* @param ActivityTypeInterface|null $activityType
	*/
	public function setActivityType(ActivityTypeInterface $activityType = null)
	{
		$this->activityType = $activityType;
	}
}
