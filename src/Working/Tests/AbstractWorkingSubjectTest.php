<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Working\Tests;

use Eki\NRW\Mdl\Working\AbstractWorkingSubject;
use Eki\NRW\Mdl\Working\WorkingSubjectInterface;

use PHPUnit\Framework\TestCase;

class AbstractWorkingSubjectTest extends TestCase
{
	public function testInterfaces()
	{
		$workingSubject = $this->createWorkingSubject('an.working.type');
		
		$this->assertInstanceOf(WorkingSubjectInterface::class, $workingSubject);
	}
	
	private function createWorkingSubject($workingType)
	{
		$workingSubject = $this->getMockBuilder(AbstractWorkingSubject::class)
			->setConstructorArgs(array($workingType))
			->getMockForAbstractClass()
		;
		
		return $workingSubject;
	}
}
