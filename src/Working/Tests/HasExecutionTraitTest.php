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

use Eki\NRW\Mdl\Working\HasExecutionTrait;
use Eki\NRW\Mdl\Working\ExecutionInterface;

use PHPUnit\Framework\TestCase;

class HasExecutionTraitTest extends TestCase
{
	public function testHasExecution()
	{
		$trait = $this->getMockBuilder(HasExecutionTrait::class)
			->setMethods(["matchExecutionType"])
			->getMockForTrait()
		;
		$trait->expects($this->once())
			->method("matchExecutionType")
			->will($this->returnValue(true))
		;

		$execution = $this->getMockBuilder(ExecutionInterface::class)
			->disableAutoload()
			->getMock()
		;
		
		$trait->setExecution($execution);
		$this->assertEquals($execution, $trait->getExecution());
	}
}
