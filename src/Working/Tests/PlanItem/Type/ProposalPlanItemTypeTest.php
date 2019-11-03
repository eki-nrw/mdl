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

use Eki\NRW\Mdl\Working\PlanItem\Type\ProposalPlanItemType;

use PHPUnit\Framework\TestCase;

class ProposalPlanItemTypeTest extends TestCase
{
	public function testNewInstance()
	{
		$planItemType = new ProposalPlanItemType();
		
		$this->assertSame('planitem.proposal', $planItemType->getPlanItemType());
		$this->assertTrue($planItemType->is('proposal'));
		$this->assertFalse($planItemType->is('proposalsakjdkasjd'));
	}	
}
