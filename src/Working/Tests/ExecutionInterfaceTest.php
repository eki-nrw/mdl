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

use Eki\NRW\Mdl\Working\ExecutionInterface;
use Eki\NRW\Mdl\Working\HasExecutionTypeInterface;
use Eki\NRW\Common\Compose\ObjectItem\HasObjectItemInterface;
use Eki\NRW\Common\Timing\StartEndTimeInterface;
use Eki\NRW\Common\Compose\ObjectStates\ObjectStatesInterface;

use PHPUnit\Framework\TestCase;
use ReflectionClass;

class ExecutionInterfaceTest extends TestCase
{
	public function testInterfaces()
	{
		$r = new ReflectionClass(ExecutionInterface::class);
		$interfaces = $r->getInterfaceNames();
		
		// Execution has type
		$this->assertTrue(in_array(HasExecutionTypeInterface::class, $interfaces));
		// Execution has times
		$this->assertTrue(in_array(StartEndTimeInterface::class, $interfaces));
		// Execution has object states
		$this->assertTrue(in_array(ObjectStatesInterface::class, $interfaces));
	}
}
