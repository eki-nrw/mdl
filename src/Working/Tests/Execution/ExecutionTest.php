<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Working\Tests\Execution;

use Eki\NRW\Mdl\Working\Execution\Execution;
use Eki\NRW\Mdl\Working\ExecutionTypeInterface;

use PHPUnit\Framework\TestCase;

class ExecutionTest extends TestCase
{
	public function testNewInstance()
	{
		$execution = new Execution($this->createExecutionType('execute'));
		
		$this->assertTrue($execution->getExecutionType()->is('execute'));
		$this->assertFalse($execution->getExecutionType()->is('executeasdjasjdkjask'));
	}	

	private function createExecutionType($matchThing)
	{
		$executionType = $this->getMockBuilder(ExecutionTypeInterface::class)
			->setMethods(['is'])
			->getMockForAbstractClass()
		;
		
		$executionType->expects($this->any())
			->method('is')
			->will($this->returnCallback(function ($thing) use ($matchThing) {
				if ($thing === $matchThing)
					return true;
				return false;
			}))
		;
		
		return $executionType;
	}
}
