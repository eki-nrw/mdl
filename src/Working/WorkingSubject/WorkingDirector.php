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

use Eki\NRW\Mdl\Working\WorkingSubjectInterface;
use Eki\NRW\Mdl\Working\WorkingSubject\WorkingDirectorInterface;
use Eki\NRW\Common\Res\Factory\FactoryInterface;
use Eki\NRW\Common\Res\Factory\Factory;
use Eki\NRW\Common\Res\Factory\Registry as FactoryRegistry;

use ReflectionClass;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class WorkingDirector implements WorkingDirectorInterface
{
	/**
	* @var ActionHandlerInterface[]
	*/
	protected $actionHandlers = [];
	
	/**
	* @var Factory
	*/
	protected $factory;
	
	/**
	* Constructor
	* 
	* @param array|Registry[] $registries
	* 
	* @return
	*/
	public function __construct(array $registries)
	{
		$replaceRegistries = [];
		foreach($registries as $registry)
		{
		    if (is_array($registry))
		    {
		    	if (!isset($registry['type']) or !isset($registry['action']))
		    		throw new \InvalidArgumentException("Registry of working director is array that must have index 'type', 'action'.");
				$replaceRegistries[] = new Registry(
					$registry['type'],
					$registry['action'],
					isset($registry['working_subject']) ? $registry['working_subject'] : null
				);
			}
			else if (is_object($registry))
				$replaceRegistries[] = $registry;	
			else
				throw new \InvalidArgumentException("Registry of Working Director must be array or object.");
		}
		$registries = $replaceRegistries;
			
		$factoryRegistries = [];
		foreach($registries as $registry)
		{
			$factoryRegistries[] = new FactoryRegistry(
				$registry->getWorkingType(), $registry->getWorkingSubjectClassname());
				
			$actionHandler = $registry->getActionHandler();
			if (is_string($actionHandler))
			{
				if (!class_exists($actionHandler))
					throw new \InvalidArgumentException("No class $actionHandler found.");
				$actionHandler = new $actionHandler();	
			}
			
			if (is_object($actionHandler))
			{
				if (!$actionHandler instanceof ActionHandlerInterface)
					throw new \InvalidArgumentException(sprintf(
						"Action handler must be instance of %s. Given %s.",
						ActionHandlerInterface::class, get_class($actionHandler)
					));
				$this->actionHandlers[$registry->getWorkingType()] = $actionHandler;
			}
		}

		$this->factory = new Factory($factoryRegistries);
	}
		
	/**
	* @inheritdoc
	*/
	public function getWorkingSubject($workingType)
	{
		if (!$this->support($workingType))
			throw new \UnexpectedValueException("Working type $workingType.");
			
		$workingSubject = $this->factory->createNew($workingType);
		$workingSubject->setActionHandler($this->actionHandlers[$registry->getWorkingType()]);

		return $workingSubject;
	}

	/**
	* @inheritdoc
	*/
	public function support($workingType)
	{
		return $this->factory->support($workingType);
	}	
}
