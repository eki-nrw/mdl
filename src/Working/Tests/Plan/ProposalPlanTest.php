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

use Eki\NRW\Mdl\Working\Plan\ProposalPlan;

use PHPUnit\Framework\TestCase;

class ProposalPlanTest extends BasedPlanTest
{
	public function testNewInstance()
	{
		$plan = new ProposalPlan($this->createPlanType('proposal'));
		
		$this->assertTrue($plan->getPlanType()->is('proposal'));
		$this->assertFalse($plan->getPlanType()->is('proposalasdjasjdkjask'));
	}	

    /**
     * @expectedException \InvalidArgumentException
     */
	public function testNewInstance_Wrong()
	{
		$plan = new ProposalPlan($this->createPlanType('proposaljjhjhjhj'));
	}	
}
