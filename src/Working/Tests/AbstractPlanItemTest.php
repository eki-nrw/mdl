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

use Eki\NRW\Mdl\Working\AbstractPlanItem;
use Eki\NRW\Mdl\Working\PlanItemInterface;
use Eki\NRW\Mdl\Working\PlanItemTypeInterface;

use PHPUnit\Framework\TestCase;

class AbstractPlanItemTest extends TestCase
{
	public function testInterfaces()
	{
		$planItemItemItem = $this->createPlanItem();
		
		$this->assertInstanceOf(PlanItemInterface::class, $planItemItemItem);
	}

	private function createPlanItemType()
	{
		$planItemItemItemType = $this->getMockBuilder(PlanItemTypeInterface::class)
			->getMockForAbstractClass()
		;
		
		return $planItemItemItemType;
	}
	
	private function createPlanItem()
	{
		$planItemItemItem = $this->getMockBuilder(AbstractPlanItem::class)
			->setConstructorArgs(array($this->createPlanItemType()))
			->getMockForAbstractClass()
		;
		
		return $planItemItemItem;
	}
}
