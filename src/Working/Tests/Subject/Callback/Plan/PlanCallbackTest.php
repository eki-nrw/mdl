<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Working\Tests\Subject\Callback\Plan;

use Eki\NRW\Mdl\Working\Subject\Callback\Plan\PlanCallback;
use Eki\NRW\Mdl\Working\Plan\Plan;
use Eki\NRW\Mdl\Working\Plan\Type\PlanType;
use Eki\NRW\Mdl\Working\PlanItem\PlanItem;
use Eki\NRW\Mdl\Working\PlanItem\Type\PlanItemType;

use PHPUnit\Framework\TestCase;

use stdClass;

class PlanCallbackTest extends TestCase
{
    public function testNewNoConstructor()
    {
    	$callback = new PlanCallback();
    	
    	$this->assertSame('plan', $callback->getCallbackType());
    	$this->assertNull($callback->get('plan'));
    }

    public function testWithSubject()
    {
    	$callback = new PlanCallback();
    	$subject = new Plan(new PlanType());
    	$callback->assignSubject($subject);
    	
    	$this->assertNotNull($callback->get('plan'));
    	$this->assertEquals($subject, $callback->get('plan'));
    }

	/**
	* @expectedException \InvalidArgumentException
	*/
    public function testWithInvalidSubject()
    {
    	$callback = new PlanCallback();
    	$subject = new stdClass();
    	$callback->assignSubject($subject);
    }

    public function testAddPlanItem()
    {
    	$callback = $this->createPlanCallback();
    	$planItem = new PlanItem(new PlanItemType());

		$callback->add('plan_item', 'any_key', $planItem);    	
    }

	/**
	* @expectedException \InvalidArgumentException
	*/
    public function testAddNotPlanItem()
    {
    	$callback = $this->createPlanCallback();
    	$notPlanItem = new stdClass();

		$callback->add('plan_item', 'any_key', $notPlanItem);    	
    }
    
    private function createPlanCallback()
    {
    	$callback = new PlanCallback();
    	$subject = new Plan(new PlanType());
    	$callback->assignSubject($subject);
    	
    	return $callback;
	}
}
