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

use Eki\NRW\Mdl\Working\HasExecutionTypeTrait;
use Eki\NRW\Mdl\Working\ExecutionTypeInterface;

use PHPUnit\Framework\TestCase;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class HasExecutionTypeTraitTest extends TestCase
{
	public function testHasExecutionType()
	{
		$trait = $this->getMockBuilder(HasExecutionTypeTrait::class)
			->getMockForTrait()
		;

		$executionType = $this->getMockBuilder(ExecutionTypeInterface::class)
			->disableAutoload()
			->getMock()
		;
		
		$trait->setExecutionType($executionType);
		$this->assertEquals($executionType, $trait->getExecutionType());
	}

	public function testAsResetExecutionType()
	{
		$trait = $this->getMockBuilder(HasExecutionTypeTrait::class)
			->getMockForTrait();
		
		$executionType = $this->getMockBuilder(ExecutionTypeInterface::class)
			->disableAutoload()
			->getMock()
		;
		
		$trait->setExecutionType($executionType);
		$this->assertEquals($executionType, $trait->getExecutionType());
		$trait->setExecutionType();
		$this->assertNull($trait->getExecutionType());
	}
}
