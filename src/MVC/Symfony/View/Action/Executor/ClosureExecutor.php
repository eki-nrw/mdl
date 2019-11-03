<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\MVC\Symfony\View\Action\Executor;

use Eki\NRW\Mdl\MVC\Symfony\View\View;
use Eki\NRW\Mdl\MVC\Symfony\View\Action\ActionAware;

use Closure;

/**
 */
class ClosureExecutor implements Executor
{
    /**
	* @inheritdoc
	*/
    public function execute(View $view)
    {
		if ($this->support($view) === false)
			return;

    	$action = $view->getAction();
    	if (!isset($action['arguments']))
	       	$action['executable']();
		else
	       	$action['executable']($action['arguments']);
	}
	
    /**
	* @inheritdoc
	*/
	public function support(View $view)
	{
    	if (!$view instanceof ActionAware)
    		return false;
    		
    	$action = $view->getAction();
    	
    	if (!is_array($action))
    		return false;
    	if (!isset($action['type']) or $action['type'] !== ActionAware::ACTION_TYPE_ARGUMENT)
    		return false;
    	if (!isset($action['executable']))
    		return false;	
    		
       	return true;
	}
}
