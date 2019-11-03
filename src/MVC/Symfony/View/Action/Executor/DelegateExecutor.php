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

/**
 * Implementation of Executor as Delegation 
 */
class DelegateExecutor implements Executor
{
	private $executors = [];
	
	public function __construc(array $executors)
	{
		foreach($executors as $executor)
		{
			if (!$executor instanceof Executor)
				throw new \InvalidArgumentException(sprintf(
					"Executor element must be instance of %s. Given %s.",
					Executor::class,
					get_class($executor)
				));
				
			$this->executors[] = $executor;
		}
	}
	
    /**
	* @inheritdoc
	*/
    public function execute(View $view)
    {
		foreach($executors as $executor)
		{
			if ($executor->support($view))
			{
				$executor->execute($view);
				return;
			}
		}
	}
	
    /**
	* @inheritdoc
	*/
	public function support(View $view)
	{
		foreach($executors as $executor)
		{
			if ($executor->support($view))
			{
				return true;
			}
		}
		
		return false;
	}
}
