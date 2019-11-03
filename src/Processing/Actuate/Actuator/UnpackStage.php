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

use Eki\NRW\Mdl\Processing\ElementInterface;
use League\Pipeline\StageInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class UnpackStage implements StageInterface
{
	public function __invoke($payload)
	{
		$contexts = $payload['contexts'];
		
		$inputs = $payload['inputs'];
		
		$checker = null;
		if (isset($payload['inputSubjectChecker']))
			$checker = $payload['inputSubjectChecker'];
		if ($checker === null)
		{
			$checker = function ($subject, array $contexts) { 
				// everything is OK
				return true; 
			};
		}
		
		$unpacker = $payload['materialUnpacker'];
		$unpacked = [];
		foreach($inputs as $key => $input)
		{
			if (!$input instanceof ElementInterface)
				throw new \InvalidArgumentException(sprintf(
					"Input with key '$key' is not instance of %s. Given %s.",
					ElementInterface::class,
					get_class($input)
				));
				
			$subject = $input->getSubject();
			if (!$checker($subject, $contexts))
				throw new \InvalidArgumentException("Input subject with key '$key' invalid.");
				
			$material = $unpacker($subject, $contexts);
			
			$k = $input->getKey();
			if (!$k)
				$k = $key;
			$unpacked[$k] = $material;
		}

		$payload['unpacked'] = $unpacked;

		return $payload;		
	}
}
