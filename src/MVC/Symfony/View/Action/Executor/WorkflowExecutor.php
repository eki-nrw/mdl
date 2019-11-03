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
use Eki\NRW\Mdl\MVC\Symfony\View\SubjectAware;

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Workflow\Workflow;

/**
 */
class WorkflowExecutor extends ContainerAware implements Executor
{
	private $container;
	
	public function setContainer(ContainerInterface $container = null)
	{
		$this->container = $container;
	}

    /**
	* @inheritdoc
	*/
    public function support(View $view)
    {
    	if (!$view instanceof ActionAware)
    		return false;
    		
    	$action = $view->getAction();

    	if (!isset($action['type']) or $action['type'] !== ActionAware::ACTION_TYPE_WORKFLOW)
    		return false;
    		
    	if (!isset($action['workflow_name']))
    		return false;

    	if (!isset($action['name']))
    		return false;

	    if (!$this->container->has('workflow.'.$action['workflow_name']))
	    	return false;
    	
    	return true;
	}
	
    /**
	* @inheritdoc
	*/
    public function execute(View $view)
    {
    	if ($this->support($view) === false)
    		return;
    		
    	$action = $view->getAction();
    	
    	try 
    	{
	    	$this->container
	    		->get('workflow.'.$action['workflow_name'])
	    			->apply($view->getSubject(), $action['name'])
	    	;    	
		}
		catch(\Exception $e)
		{
			
		}
	}
}
