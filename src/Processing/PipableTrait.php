<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Processing;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
trait PipableTrait
{
	/**
	* @inheritdoc
	* 
	*/	
	public function pipe(PipableInterface $toPipe, $toKey = null, array $contexts = [])
	{
		if (!$this->canPipe())
			return false;
			
		if (!$toPipe->canPipeIn($toKey, reset($this->getFrameOutput()), $contexts))
			return false;	
			
		return $toPipe->pipeIn($toKey, reset($this->getFrameOutput()), $contexts);
	}
}
