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

use Eki\NRW\Mdl\Working\HasPlanTrait;
use Eki\NRW\Mdl\Working\PlanInterface;

use PHPUnit\Framework\TestCase;

class HasPlanTraitTest extends TestCase
{
	public function testHasPlan()
	{
		$trait = $this->getMockBuilder(HasPlanTrait::class)->getMockForTrait();
		$plan = $this->getMockBuilder(PlanInterface::class)
			->disableAutoload()
			->getMock()
		;
		
		$trait->setPlan($plan);
		$this->assertEquals($plan, $trait->getPlan());
	}
}
