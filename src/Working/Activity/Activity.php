<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Working\Activity;

use Eki\NRW\Mdl\Working\AbstractActivity;
use Eki\NRW\Mdl\Working\ActivityTypeInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class Activity extends AbstractActivity
{
	/**
	* @inheritdoc
	*/
	protected function matchActivityType(ActivityTypeInterface $activityType)
	{
		parent::matchActivityType($activityType);
		
		if (!$activityType->is('execute'))
			throw new \InvalidArgumentException("Activity must be execute type.");
	}
}
