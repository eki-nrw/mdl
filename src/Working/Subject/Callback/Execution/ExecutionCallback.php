<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Working\Subject\Callback\Execution;

use Eki\NRW\Mdl\Working\Subject\AbstractCallback;
use Eki\NRW\Mdl\Working\ExecutionInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class ExecutionCallback extends AbstractCallback
{
	/**
	* @inheritdoc
	*/
	public function getCallbackType()
	{
		return 'execution';
	}
	
	/**
	* Get execution
	* 
	* @return ExecutionInterface
	*/
	protected function getExecution()
	{
		return $this->getSubject();
	}
}
