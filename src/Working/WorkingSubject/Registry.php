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

use Eki\NRW\Mdl\Working\WorkingSubject\ActionHandlerInterface;

use ReflectionClass;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class Registry
{
	/**
	* Type name of working type
	* 
	* @var string
	*/
	private $workingType;

	/**
	* Full qualified class name of callback or callback object
	* 
	* @var string|ActionHandlerInterface
	* 
	*/
	private $actionHandler;

	/**
	* Full qualified class name of working subject
	* 
	* @var string
	* 
	*/	
	private $workingSubjectClassname;
	
	/**
	* Constructor
	* 
	* @param string $workingType
	* @param string|ActionHandlerInterface $actionHanler
	* @param string|null $workingSubjectClassname
	* 
	* @throws \InvalidArgumentException
	*/	
	public function __construct(
		$workingType, 
		$actionHandler,
		$workingSubjectClassname = null
	)
	{
		$this->invalidateClassNotFoundException('action', $actionHandler);

		if (null === $workingSubjectClassname)
			$workingSubjectClassname = WorkingSubject::class;
		$this->invalidateClassNotFoundException('working_subject', $workingSubjectClassname);

		$this->workingType = $workingType;
		$this->actionHandler = $actionHandler;
		$this->workingSubjectClassname = $workingSubjectClassname;
	}
	
	private function invalidateClassNotFoundException($kind, $classname)
	{
		if (is_string($classname) and !class_exists($classname))
			throw new \InvalidArgumentException(sprintf("No %s class '%s' found.", $kind, $classname));

		if ($kind === 'working_subject')
		{
			if (!class_exists($classname))
				throw new \InvalidArgumentException("Working subject class %classname not found.");
		}
			
		if ($kind === 'action')
		{
			if (!(new ReflectionClass($classname))->implementsInterface(ActionHandlerInterface::class))
				throw new \InvalidArgumentException(sprintf(
					"Action Handler Class must implement interface '%s'",
					ActionHandlerInterface::class
				));
		}
	}
	
	public function getWorkingType()
	{
		return $this->workingType;
	}

	public function getWorkingSubjectClassname()
	{
		return $this->workingSubjectClassname;
	}
	
	public function getActionHandler()
	{
		return $this->actionHandler;
	}
}
