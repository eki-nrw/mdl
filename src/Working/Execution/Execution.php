<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Working\Execution;

use Eki\NRW\Mdl\Working\AbstractExecution;
use Eki\NRW\Mdl\Working\ExecutionTypeInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class Execution extends AbstractExecution
{
	/**
	* @inheritdoc
	*/
	protected function matchExecutionType(ExecutionTypeInterface $executionType)
	{
		parent::matchExecutionType($executionType);
	}
}
