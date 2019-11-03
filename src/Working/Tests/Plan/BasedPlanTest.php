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

use Eki\NRW\Mdl\Working\PlanTypeInterface;

use PHPUnit\Framework\TestCase;

class BasedPlanTest extends TestCase
{
	public function testDummy()
	{
	}
	
	protected function createPlanType($matchThing)
	{
		$planItemType = $this->getMockBuilder(PlanTypeInterface::class)
			->setMethods(['is'])
			->getMockForAbstractClass()
		;
		
		$planItemType->expects($this->any())
			->method('is')
			->will($this->returnCallback(function ($thing) use ($matchThing) {
				if ($thing === $matchThing)
					return true;
				return false;
			}))
		;
		
		return $planItemType;
	}
}
