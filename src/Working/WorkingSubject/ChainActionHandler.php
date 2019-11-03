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
class ChainActionHandler extends ListActionHandler
{
	/**
	* @inheritdoc
	*/
	public function handle($subject, $actionName, array $contexts = [])
	{
		$acted = false;
		foreach($this->actionHandlers as $actionHandler)
		{
			if ($actionHandler->support($subject, $actionName))
			{
				$handled = true;
				$actionHandler->handle($subject, $actionName, $contexts);
			}
		}
		
		if (!$handled)
			throw new \DomainException(sprintf("Action is not supported."));
	}
}
