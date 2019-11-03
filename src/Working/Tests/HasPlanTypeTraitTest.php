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

use Eki\NRW\Mdl\Working\HasPlanTypeTrait;
use Eki\NRW\Mdl\Working\PlanTypeInterface;

use PHPUnit\Framework\TestCase;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class HasPlanTypeTraitTest extends TestCase
{
	public function testHasPlanType()
	{
		$trait = $this->getMockBuilder(HasPlanTypeTrait::class)
			->getMockForTrait()
		;
		
		$planType = $this->getMockBuilder(PlanTypeInterface::class)
			->disableAutoload()
			->getMock()
		;
		
		$trait->setPlanType($planType);
		$this->assertEquals($planType, $trait->getPlanType());
	}

	public function testAsResetPlanType()
	{
		$trait = $this->getMockBuilder(HasPlanTypeTrait::class)
			->getMockForTrait();
		
		$planType = $this->getMockBuilder(PlanTypeInterface::class)
			->disableAutoload()
			->getMock()
		;
		
		$trait->setPlanType($planType);
		$this->assertEquals($planType, $trait->getPlanType());
		$trait->setPlanType();
		$this->assertNull($trait->getPlanType());
	}
}

