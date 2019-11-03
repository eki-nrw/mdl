<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Claiming\Claimable\Simple\Set;

use Eki\NRW\Mdl\Claiming\Claimable\Simple\Delivery as BaseDelivery;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class Delivery extends BaseDelivery
{
	private $deliveries = [];
	
	public function __construct(array $deliveries)
	{
		$this->setValue(0);
			
		foreach($deliveries as $delivery)
		{
			if (!$delivery instanceof BaseDelivery)
				throw new \InvalidArgumentException("???");
		
			$value = $this->getValue();		
			$value += $delivery->getValue();
			$this->setValue($value);
		}
	}
}
