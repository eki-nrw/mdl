<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Working;

use Eki\NRW\Common\Common\Variables\Variables;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
abstract class AbstractWorkingSubject extends AbstractBuildingSubject implements WorkingSubjectInterface
{
	/**
	* @var string
	*/
	private $workingType;

	public function __construct($workingType)
	{
		$this->setWorkingType($workingType);
		
		$this->setVariables(new Variables());
	}

	/**
	* @inheritdoc
	*/
	public function setWorkingType($workingType)
	{
		$this->workingType = $workingType;
	}
	
	/**
	* @inheritdoc
	*/
	public function getWorkingType()
	{
		return $this->workingType;
	}
	
	/**
	* @inheritdoc
	*/
	public function action($actionName, array $contexts = [])
	{
		if (!$this->can($actionName, $contexts))
			throw new \Exception("Cannot do action $actionName.");
			
		$this->onAction($actionName, $this->getSubject(), $contexts);
	}
	
	/**
	* Do an action
	* 
	* @param string $actionName
	* @param mixed $subject
	* @param array $contexts
	* 
	* @return void
	*/
	abstract protected function onAction($actionName, $subject, array $contexts);
}
