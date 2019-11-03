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

use Eki\NRW\Mdl\Working\PlanItem\ExecutePlanItem;

use PHPUnit\Framework\TestCase;

class ExecutePlanItemTest extends BasedPlanItemTest
{
	public function testNewInstance()
	{
		$planItem = new ExecutePlanItem($this->createPlanItemType('execute'));
		
		$this->assertTrue($planItem->getPlanItemType()->is('execute'));
		$this->assertFalse($planItem->getPlanItemType()->is('executeasdjasjdkjask'));
	}	
}
