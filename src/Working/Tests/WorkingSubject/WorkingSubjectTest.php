<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Working\Tests\WorkingSubject;

use Eki\NRW\Mdl\Working\WorkingSubject\WorkingSubject;

use Eki\NRW\Mdl\Working\Tests\WorkingSubject\Utils\ActionHandlerUtils;
use Eki\NRW\Mdl\Working\Tests\WorkingSubject\Utils\WorkflowHandlerUtils;

use PHPUnit\Framework\TestCase;
use stdClass;

class WorkingSubjectTest extends TestCase
{
	public function testNew()
	{
		$workingSubject = new WorkingSubject('an.working.type');
	}
	
	public function testAction()
	{
		$workingSubject = $this->createWorkingSubject('the.working.type', array(stdClass::class), array('def', 'prepare', 'go'));
		$subject = new stdClass();
		$workingSubject->setSubject($subject);
		
		$workingSubject->action('def');
	}

	/**
	* @expectedException \UnexpectedValueException
	*/
	public function testActionNotSuppored()
	{
		$workingSubject = $this->createWorkingSubject('a.working.type', array(stdClass::class), array('def', 'prepare', 'go'));
		$subject = new ____Subject____Dont_Support____();
		$workingSubject->setSubject($subject);
		
		$workingSubject->action('def');
	}

	/**
	* @expectedException \UnexpectedValueException
	*/
	public function testActionNoSubject()
	{
		$workingSubject = $this->createWorkingSubject('a.working.type', array(stdClass::class), array('def', 'prepare', 'go'));
		
		$workingSubject->action('def');
	}
	
	private function createWorkingSubject($workingType, array $supportedClassnames, array $supportedActionNames)
	{
		$actionHandler = ActionHandlerUtils::createActionHandler($this, $supportedClassnames, $supportedActionNames);
		
		$workingSubject = new WorkingSubject($workingType);
		$workingSubject->setActionHandler($actionHandler);
		
		return $workingSubject;
	}
}
class ____Subject____Dont_Support____
{
	
}