<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Working\Tests\Plan\Type;

use Eki\NRW\Mdl\Working\Plan\Type\ProposalPlanType;

use PHPUnit\Framework\TestCase;

class ProposalPlanTypeTest extends TestCase
{
	public function testNewInstance()
	{
		$planType = new ProposalPlanType();
		
		$this->assertSame('plan.proposal', $planType->getPlanType());
		$this->assertTrue($planType->is('proposal'));
		$this->assertFalse($planType->is('proposalsakjdkasjd'));
	}	
}
