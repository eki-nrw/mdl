<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Processing\Actuate\Actuator;

use League\Pipeline\StageInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class ProduceStage implements StageInterface
{
	public function __invoke($payload)
	{
		$contexts = $payload['contexts'];
		
		$materials = $payload['unpacked'];
		$producer = $payload['producer'];
		
		$checker = null;
		if (isset($payload['materialChecker']))
			$checker = $payload['materialChecker'];
		if ($checker === null)
		{
			$checker = function ($material) { 
				// Everythiing is OK
				return true; 
			};
		}
		
		foreach($materials as $keyM => $material)
		{
			if ($checker($material) !== true)
				throw new \InvalidArgumentException("Invalid material with key '$keyM'.");
		}
		
		$product = $producer($materials, $contexts);
		$payload['product'] = $product;
		
		return $payload;
	}
}
