<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Working\Execution\Type;

use Eki\NRW\Mdl\Working\ExecutionTypeInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
abstract class AbstractExecutionType implements ExecutionTypeInterface
{
	/**
	* @inheritdoc
	*/
	public function is($thing)
	{
		if ($thing === 'execute')
			return true;
			
		return false;
	}

	/**
	* @inheritdoc
	*/
	public function accept($thing, $content)
	{
		return false;
	}

	/**
	* @inheritdoc
	*/
	public function initExecution(ExecutionInterface $execution)
	{
		//...	
	}
}
