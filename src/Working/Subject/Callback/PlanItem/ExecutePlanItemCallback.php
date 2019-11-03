<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Working\Subject\Callback\PlanItem;

use Eki\NRW\Mdl\Working\PlanItemInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class ExecutePlanItemCallback extends PlanItemCallback
{
	/**
	* @inheritdoc
	*/
	public function getCallbackType()
	{
		return 'planitem.execute';
	}
}
