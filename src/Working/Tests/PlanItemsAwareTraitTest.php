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

use Eki\NRW\Mdl\Working\PlanItemsAwareTrait;
use Eki\NRW\Mdl\Working\PlanItemInterface;

use PHPUnit\Framework\TestCase;

use stdClass;

class PlanItemsAwareTraitTest extends TestCase
{
	public function testInternal()
	{
		$planItem_a = $this->createPlanItem();
		$planItem_b = $this->createPlanItem();
		
		$this->assertNotSame($planItem_a, $planItem_b);
	}
	
	public function testAddPlanItem()
	{
		$planItems = $this->createPlanItemsAwareTrait();

		$planItem_a = $this->createPlanItem();
		$planItems->addPlanItem($planItem_a, 'key_a');

		$planItem_b = $this->createPlanItem();
		$planItems->addPlanItem($planItem_b, 'key_b');
		
		$this->assertTrue($planItems->hasPlanItem('key_a'));
		$this->assertTrue($planItems->hasPlanItem('key_b'));
		
		$this->assertSame($planItem_a, $planItems->getPlanItem('key_a'));
		$this->assertSame($planItem_b, $planItems->getPlanItem('key_b'));
	}

    /**
     * @expectedException \InvalidArgumentException
     */
	public function testAddPlanItem_Twice()
	{
		$planItems = $this->createPlanItemsAwareTrait();

		$planItem = $this->createPlanItem();
		$planItems->addPlanItem($planItem, 'key_a');
		$planItems->addPlanItem($planItem, 'key_b');
	}

    /**
     * @expectedException \LogicException
     */
	public function testAddPlanItem_SameKey()
	{
		$planItems = $this->createPlanItemsAwareTrait();

		$planItem_1 = $this->createPlanItem();
		$planItems->addPlanItem($planItem_1, 'key_same');

		$planItem_2 = $this->createPlanItem();
		$planItems->addPlanItem($planItem_1, 'key_same');
	}

	public function testRemovePlanItem()
	{
		$planItems = $this->createPlanItemsAwareTrait();

		$planItem_a = $this->createPlanItem();
		$planItems->addPlanItem($planItem_a, 'key_a');

		$planItem_b = $this->createPlanItem();
		$planItems->addPlanItem($planItem_b, 'key_b');

		$planItem_c = $this->createPlanItem();
		$planItems->addPlanItem($planItem_c, 'key_c');
		
		$this->assertEquals(3, sizeof($planItems->getPlanItems()));
		
		$planItems->removePlanItem($planItem_a);

		$this->assertEquals(2, sizeof($planItems->getPlanItems()));
		
		$planItems->removePlanItemByKey('key_c');

		$this->assertEquals(1, sizeof($planItems->getPlanItems()));
	}

    /**
     * @expectedException \LogicException
     */
	public function testRemovePlanItem_NoPlanItem()
	{
		$planItems = $this->createPlanItemsAwareTrait();

		$planItem_a = $this->createPlanItem();
		$planItems->addPlanItem($planItem_a, 'key_a');

		$planItem_b = $this->createPlanItem();
		$planItems->addPlanItem($planItem_b, 'key_b');

		$planItem_c = $this->createPlanItem();
		// No adding
		
		$planItems->removePlanItem($planItem_c);
	}

    /**
     * @expectedException InvalidArgumentException
     */
	public function testRemovePlanItem_NoKey()
	{
		$planItems = $this->createPlanItemsAwareTrait();

		$planItem_a = $this->createPlanItem();
		$planItems->addPlanItem($planItem_a, 'key_a');

		$planItem_b = $this->createPlanItem();
		$planItems->addPlanItem($planItem_b, 'key_b');

		$planItems->removePlanItemByKey('key_c');
	}

	public function testPlanItems()
	{
		$planItems = $this->createPlanItemsAwareTrait();

		$this->assertEmpty($planItems->getPlanItems());
		
		$planItems->setPlanItems(array(
			'key_x' => $this->createPlanItem(),
			'key_y' => $this->createPlanItem(),
		));
		
		$this->assertEquals(2, sizeof($planItems->getPlanItems()));
	}

    /**
     * @expectedException InvalidArgumentException
     */
	public function testPlanItems_SetNotPlanItem()
	{
		$planItems = $this->createPlanItemsAwareTrait();

		$this->assertEmpty($planItems->getPlanItems());
		
		$planItems->setPlanItems(array(
			'key_good' => $this->createPlanItem(),
			'key_wrong' => new stdClass,
		));
	}


	private function createPlanItemsAwareTrait()
	{
		return $this->getMockBuilder(PlanItemsAwareTrait::class)
			->getMockForTrait()
		;
	}
	
	private function createPlanItem()
	{
		return $this->getMockBuilder(PlanItemInterface::class)->getMock();
	}
}
