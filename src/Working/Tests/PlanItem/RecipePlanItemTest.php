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

use Eki\NRW\Mdl\Working\PlanItem\RecipePlanItem;

use PHPUnit\Framework\TestCase;

class RecipePlanItemTest extends BasedPlanItemTest
{
	public function testNewInstance()
	{
		$planItem = new RecipePlanItem($this->createPlanItemType('recipe'));
		
		$this->assertTrue($planItem->getPlanItemType()->is('recipe'));
		$this->assertFalse($planItem->getPlanItemType()->is('recipeasdjasjdkjask'));
	}	
}
