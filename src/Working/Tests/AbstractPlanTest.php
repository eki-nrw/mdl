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

use Eki\NRW\Mdl\Working\AbstractPlan;
use Eki\NRW\Mdl\Working\PlanInterface;
use Eki\NRW\Mdl\Working\PlanTypeInterface;

use PHPUnit\Framework\TestCase;

class AbstractPlanTest extends TestCase
{
	public function testInterfaces()
	{
		$plan = $this->createPlan();
		
		$this->assertInstanceOf(PlanInterface::class, $plan);
	}

	private function createPlanType()
	{
		$planType = $this->getMockBuilder(PlanTypeInterface::class)
			->getMockForAbstractClass()
		;
		
		return $planType;
	}
	
	private function createPlan()
	{
		$plan = $this->getMockBuilder(AbstractPlan::class)
			->setConstructorArgs(array($this->createPlanType()))
			->getMockForAbstractClass()
		;
		
		return $plan;
	}
}
