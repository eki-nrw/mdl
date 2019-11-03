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

use Eki\NRW\Mdl\Working\Plan\RecipePlan;

use PHPUnit\Framework\TestCase;

class RecipePlanTest extends BasedPlanTest
{
	public function testNewInstance()
	{
		$plan = new RecipePlan($this->createPlanType('recipe'));
		
		$this->assertTrue($plan->getPlanType()->is('recipe'));
		$this->assertFalse($plan->getPlanType()->is('recipeasdjasjdkjask'));
	}	

    /**
     * @expectedException \InvalidArgumentException
     */
	public function testNewInstance_Wrong()
	{
		$plan = new RecipePlan($this->createPlanType('recipejjhjhjhj'));
	}	
}
