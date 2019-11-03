<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Working\Activity\Type;

use Eki\NRW\Mdl\Working\ActivityTypeInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class ActivityType extends AbstractActivityType
{
	/**
	* @inheritdoc
	*/
	public function getActivityType()
	{
		return "activity";
	}

	/**
	* @inheritdoc
	*/
	public function is($thing)
	{
		if ($thing === 'execute')
			return true;
			
		return parent::is($thing);
	}
}
