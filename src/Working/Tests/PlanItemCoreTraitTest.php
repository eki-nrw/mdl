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

use Eki\NRW\Mdl\Working\PlanItemCoreTrait;

use PHPUnit\Framework\TestCase;

use stdClass;

class PlanItemCoreTraitTest extends TestCase
{
	private $planItemItem;
	
	public function setUp()
	{
		$this->planItemItem = $this->createPlanItem();
	}
	
	public function tearDown()
	{
		$this->planItemItem = null;
	}
	
    public function testPriority()
    {
    	$planItemItem = $this->planItemItem;

    	$planItemItem->setPriority(99);
    	$this->assertEquals(99, $planItemItem->getPriority(), 99);
    }

    public function testName()
    {
    	$planItemItem = $this->planItemItem;

    	$planItemItem->setName("Plan Item Name");
    	$this->assertSame("Plan Item Name", $planItemItem->getName());
    }

    private function createPlanItem()
    {
		$planItemItem = $this->getMockBuilder(PlanItemCoreTrait::class)
			->getMockForTrait()
		;
		
		return $planItemItem;
	}
}
