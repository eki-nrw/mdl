<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Working\Tests\PlanItem\Type;

use Eki\NRW\Mdl\Working\PlanItem\Type\ExecutePlanItemType;

use PHPUnit\Framework\TestCase;

class ExecutePlanItemTypeTest extends TestCase
{
	public function testNewInstance()
	{
		$planItemType = new ExecutePlanItemType();
		
		$this->assertSame('planitem.execute', $planItemType->getPlanItemType());
		$this->assertTrue($planItemType->is('execute'));
		$this->assertFalse($planItemType->is('executesakjdkasjd'));
	}	
}
