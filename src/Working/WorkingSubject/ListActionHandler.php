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

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
abstract class ListActionHandler extends AbstractActionHandler
{
	/**
	* @var ActionHandlerInterface[]
	*/
	protected $actionHandlers = [];
	
	/**
	* Constructor
	* 
	* @param array $actionHandlers
	* 
	* @throws \InvalidArgumentException
	*/
	public function __construct(array $actionHandlers)
	{
		foreach($actionHandlers as $actionHandler)
		{
			if (!$actionHandler instanceof ActionHandlerInterface)
				throw new \InvalidArgumentException(sprintf(
					"Action handler must be instance of %s.",
					ActionHandlerInterface::class
				));
				
			$this->actionHandlers[] = $actionHandler;
		}
	}
	
	/**
	* @inheritdoc
	* 
	* One of handlers supports that is supported
	*/
	public function support($subject, $actionName)
	{
		foreach($this->actionHandlers as $actionHandler)
		{
			if ($actionHandler->support($subject, $actionName))
				return true;
		}
		
		return false;
	}
}
