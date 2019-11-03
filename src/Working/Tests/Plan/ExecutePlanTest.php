<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Working\Tests\Plan;

use Eki\NRW\Mdl\Working\Plan\ExecutePlan;

use PHPUnit\Framework\TestCase;

class ExecutePlanTest extends BasedPlanTest
{
	public function testNewInstance()
	{
		$plan = new ExecutePlan($this->createPlanType('execute'));
		
		$this->assertTrue($plan->getPlanType()->is('execute'));
		$this->assertFalse($plan->getPlanType()->is('executeasdjasjdkjask'));
	}	

    /**
     * @expectedException \InvalidArgumentException
     */
	public function testNewInstance_Wrong()
	{
		$plan = new ExecutePlan($this->createPlanType('executejjhjhjhj'));
	}	
}
