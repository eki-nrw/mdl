<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Working\Tests\Execution\Type;

use Eki\NRW\Mdl\Working\Execution\Type\ExecutionType;

use PHPUnit\Framework\TestCase;

class ExecutionTypeTest extends TestCase
{
	public function testNewInstance()
	{
		$executionType = new ExecutionType();
		
		$this->assertSame('execution', $executionType->getExecutionType());
		$this->assertTrue($executionType->is('execute'));
		$this->assertFalse($executionType->is('executesakjdkasjd'));
	}	
}
