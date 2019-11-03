<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Working\Subject\Importor\ExecutePlanItem;

use Eki\NRW\Mdl\Working\Subject\AbstractImportor;
use Eki\NRW\Mdl\Working\PlanItemInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
abstract class ToExecutePlanItemImportor extends AbstractImportor
{
	/**
	* @inheritdoc
	*/
	protected function supportSubject($object)
	{
		if ($object instanceof PlanItemInterface)
		{
			$executePlanItem = $object;
			
			if (null === ($executePlanItemType = $executePlanItem->getPlanItemType()))
				return false;
				
			if (!$executePlanItemType->is('execute'))
				return false;
				
			return true;
		}
		
		return false;
	}
}
