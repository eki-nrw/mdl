<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Working\Subject\Importor\Plan;

use Eki\NRW\Mdl\Working\Subject\AbstractImportor;
use Eki\NRW\Mdl\Working\PlanInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
abstract class ToPlanImportor extends AbstractImportor
{
	/**
	* @inheritdoc
	*/
	protected function supportSubject($object)
	{
		if ($object instanceof PlanInterface)
		{
			$plan = $object;
			
			if (null === ($planType = $plan->getPlanType()))
				return false;
				
			return true;
		}
		
		return false;
	}
}
