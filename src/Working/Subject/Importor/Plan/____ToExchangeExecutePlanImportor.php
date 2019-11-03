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

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
abstract class ToExchangeExecutePlanImportor extends ToExecutePlanImportor
{
	/**
	* @inheritdoc
	*/
	protected function supportSubject($object)
	{
		if (!parent::supportSubject($object))
			return false;
		
		if (!$object->getPlanType()->is('exchange'))
			return false;
				
		return true;
	}
}
