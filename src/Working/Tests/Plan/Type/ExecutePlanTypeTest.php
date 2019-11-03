<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Working\Tests\Plan\Type;

use Eki\NRW\Mdl\Working\Plan\Type\ExecutePlanType;

use PHPUnit\Framework\TestCase;

class ExecutePlanTypeTest extends TestCase
{
	public function testNewInstance()
	{
		$planType = new ExecutePlanType();
		
		$this->assertSame('plan.execute', $planType->getPlanType());
		$this->assertTrue($planType->is('execute'));
		$this->assertFalse($planType->is('executesakjdkasjd'));
	}	
}
