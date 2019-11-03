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

use Eki\NRW\Mdl\Working\AbstractExecution;
use Eki\NRW\Mdl\Working\ExecutionInterface;
use Eki\NRW\Mdl\Working\ExecutionTypeInterface;

use PHPUnit\Framework\TestCase;

use stdClass;

class AbstractExecutionTest extends TestCase
{
	public function testDefaults()
	{
		$exc = $this->getMockBuilder(AbstractExecution::class)
			->getMockForAbstractClass()
		;
		
		$this->assertNull($exc->getName());
		$this->assertNull($exc->getExecutionType());
		$this->assertEmpty($exc->getStartDate());
		$this->assertEmpty($exc->getEndDate());
	}
	
	public function testName()
	{
		$execution = $this->createExecution();
		
		$this->assertEmpty($execution->getName());
		$execution->setName('execution name');
		$this->assertSame('execution name', $execution->getName());
	}

	public function testSubject()
	{
		$execution = $this->createExecution();
		
		$this->assertNull($execution->getSubject());
		
		$subject = new stdClass();
		$execution->setSubject($subject);
		
		$this->assertEquals($subject, $execution->getSubject());
	}

	public function testEngine()
	{
		$execution = $this->createExecution();
		
		$this->assertNull($execution->getEngine());
		
		$engine = new stdClass();
		$execution->setEngine($engine);
		
		$this->assertEquals($engine, $execution->getEngine());
	}

	private function createExecutionType()
	{
		$executionType = $this->getMockBuilder(ExecutionTypeInterface::class)
			->getMockForAbstractClass()
		;
		
		return $executionType;
	}
	
	private function createExecution()
	{
		$execution = $this->getMockBuilder(AbstractExecution::class)
			->setConstructorArgs(array($this->createExecutionType()))
			->getMockForAbstractClass()
		;
		
		return $execution;
	}
}
