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

use Eki\NRW\Mdl\Working\PlanCoreTrait;

use PHPUnit\Framework\TestCase;

use stdClass;

class PlanCoreTraitTest extends TestCase
{
	private $plan;
	
	public function setUp()
	{
		$this->plan = $this->createPlan();
	}
	
	public function tearDown()
	{
		$this->plan = null;
	}
	
	public function testFirstNew()
	{
		$plan = $this->plan;
		
		$this->assertEmpty($plan->getPlanName());
		$this->assertEmpty($plan->getObjectives());
		$this->assertNull($plan->getSolution());
	}
	
    public function testName()
    {
    	$plan = $this->plan;

		$plan->setPlanName('plan name');
		$this->assertSame('plan name', $plan->getPlanName());
    }

    private function createPlan()
    {
		$plan = $this->getMockBuilder(PlanCoreTrait::class)
			->getMockForTrait()
		;
		
		return $plan;
	}
}
