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
class PackStage implements StageInterface
{
	public function __invoke($payload)
	{
		$contexts = $payload['contexts'];

		$outputs = $payload['outputs'];
		$product = $payload['product'];
		$packer = $payload['productPacker'];
		
		$check = null;
		if (isset($payload['outputSubjectChecker']))
			$checker = $payload['outputSubjectChecker'];
		if ($checker === null)
		{
			$checker = function ($subject, array $contexts) {
				// Everything is OK
				return true;
			};
		}
		
		$outs = [];
		foreach($outputs as $key => $output)
		{
			$subject = $output->getSubject();
			if (!$checker($subject, $contexts))
				throw new \InvalidArgumentException("Output subject with key '$key' invalid.");

			if (null === $packer($product, $subject, $contexts))
				throw new \RuntimeException("Packing error.");
			
			$outs[$key] = $output;
		}	
		
		$payload['outputs'] = $outs;
		
		return $payload;
	}
}
