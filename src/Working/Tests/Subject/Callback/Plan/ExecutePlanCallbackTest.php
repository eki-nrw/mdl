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
use Eki\NRW\Mdl\Working\Subject\Callback\Plan\ExecutePlanCallback;
use Eki\NRW\Mdl\Working\Plan\ExecutePlan;
use Eki\NRW\Mdl\Working\Plan\Type\ExecutePlanType;
use Eki\NRW\Mdl\Working\PlanItem\ExecutePlanItem;
use Eki\NRW\Mdl\Working\PlanItem\Type\ExecutePlanItemType;

use PHPUnit\Framework\TestCase;

use stdClass;

class ExecutePlanCallbackTest extends TestCase
{
    public function testNew()
    {
    	$callback = new ExecutePlanCallback();
    	
    	$this->assertSame('plan.execute', $callback->getCallbackType());
    	$this->assertNull($callback->get('plan'));
    }

    public function testExecutePlanCallbackIsInstanceOfPlanCallback()
    {
    	$callback = new ExecutePlanCallback();
    	
    	$this->assertInstanceOf(PlanCallback::class, $callback);
    }

    public function testWithSubject()
    {
    	$callback = new ExecutePlanCallback();
    	$subject = new ExecutePlan(new ExecutePlanType());
    	$callback->assignSubject($subject);
    	
    	$this->assertNotNull($callback->get('plan'));
    	$this->assertEquals($subject, $callback->get('plan'));
    }

	/**
	* @expectedException \InvalidArgumentException
	*/
    public function testWithInvalidSubject()
    {
    	$callback = new ExecutePlanCallback();
    	$subject = new stdClass();
    	$callback->assignSubject($subject);
    }

    public function testAddPlanItem()
    {
    	$callback = $this->createExecutePlanCallback();
    	$planItem = new ExecutePlanItem(new ExecutePlanItemType());

		$callback->add('plan_item', 'any_key', $planItem);    	
    }

	/**
	* @expectedException \InvalidArgumentException
	*/
    public function testAddNotPlanItem()
    {
    	$callback = $this->createExecutePlanCallback();
    	$notPlanItem = new stdClass();

		$callback->add('plan_item', 'any_key', $notPlanItem);    	
    }
    
    private function createExecutePlanCallback()
    {
    	$callback = new ExecutePlanCallback();
    	$subject = new ExecutePlan(new ExecutePlanType());
    	$callback->assignSubject($subject);
    	
    	return $callback;
	}
}
