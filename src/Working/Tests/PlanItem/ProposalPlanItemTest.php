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

use Eki\NRW\Mdl\Working\PlanItem\ProposalPlanItem;

use PHPUnit\Framework\TestCase;

class ProposalPlanItemTest extends BasedPlanItemTest
{
	public function testNewInstance()
	{
		$planItem = new ProposalPlanItem($this->createPlanItemType('proposal'));
		
		$this->assertTrue($planItem->getPlanItemType()->is('proposal'));
		$this->assertFalse($planItem->getPlanItemType()->is('proposalasdjasjdkjask'));
	}	
}
