<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Processing\Pipeline;

use Eki\NRW\Mdl\Processing\FrameInterface;
use League\Pipeline\StageInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class FromFrameStage implements StageInterface
{
	const NAME = 'from_frame';
	
	public function __invoke($payload)
	{
		$payload['stage_name'] = static::NAME;
		
		$frame = $payload['frame'];
		if (!$frame instanceof FrameInterface)
			throw new \InvalidArgumentException(sprintf(
				"Index 'frame' of 'payload' parameter must be instance of %s. Given %s.",
				FrameInterface::class,
				get_class($frame)
			));
			
		$contexts = $payload['contexts'];
		$payload['inputToPipeline'] = reset($frame->getFrameOutput());

		return $payload;
	}
}
