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

use Eki\NRW\Mdl\Working\HasPlanItemTypeTrait;
use Eki\NRW\Mdl\Working\PlanItemTypeInterface;

use PHPUnit\Framework\TestCase;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class HasPlanItemTypeTraitTest extends TestCase
{
	public function testHasPlanItemType()
	{
		$trait = $this->getMockBuilder(HasPlanItemTypeTrait::class)
			->getMockForTrait()
		;
		
		$planItemType = $this->getMockBuilder(PlanItemTypeInterface::class)
			->disableAutoload()
			->getMock()
		;
		
		$trait->setPlanItemType($planItemType);
		$this->assertEquals($planItemType, $trait->getPlanItemType());
	}

	public function testAsResetPlanItemType()
	{
		$trait = $this->getMockBuilder(HasPlanItemTypeTrait::class)
			->getMockForTrait();
		
		$planItemType = $this->getMockBuilder(PlanItemTypeInterface::class)
			->disableAutoload()
			->getMock()
		;
		
		$trait->setPlanItemType($planItemType);
		$this->assertEquals($planItemType, $trait->getPlanItemType());
		$trait->setPlanItemType();
		$this->assertNull($trait->getPlanItemType());
	}
}
