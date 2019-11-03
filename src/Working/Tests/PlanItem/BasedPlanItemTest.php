<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Working\Tests\PlanItem;

use Eki\NRW\Mdl\Working\PlanItemTypeInterface;

use PHPUnit\Framework\TestCase;

class BasedPlanItemTest extends TestCase
{
	public function testDummy()
	{
	}
	
	protected function createPlanItemType($matchThing)
	{
		$planItemType = $this->getMockBuilder(PlanItemTypeInterface::class)
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
