<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Working\WorkingSubject;

use Eki\NRW\Mdl\Working\AbstractWorkingSubject;
use Eki\NRW\Mdl\Working\WorkingSubject\ActionHandlerInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class WorkingSubject extends AbstractWorkingSubject
{
	/**
	* @var ActionHandlerInterface
	*/	
	protected $actionHandler;
	
	public function setActionHandler(ActionHandlerInterface $actionHandler = null)
	{
		if ($actionHandler === null)
		{
			if ($this->actionHandler !== null)
				$this->actionHandler->setWorkingSubject();
		}
		else
		{
			$actionHandler->setWorkingSubject($this);
			$this->actionHandler = $actionHandler;
		}
	}
	
	/**
	* @inheritdoc
	*/
	protected function onAction($actionName, $subject, array $contexts)
	{
		$this->actionHandler->handle($subject, $actionName, $contexts);
	}

	/**
	* @inheritdoc
	*/
	public function can($actionName, array $contexts = [])
	{
		if (null === ($subject = $this->getSubject()))
			return false;
		
		return $this->actionHandler->support($subject, $actionName);
	}
}
