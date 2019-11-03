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
use Eki\NRW\Mdl\Working\Subject\Callback\Plan\RecipePlanCallback;
use Eki\NRW\Mdl\Working\Plan\RecipePlan;
use Eki\NRW\Mdl\Working\Plan\Type\RecipePlanType;
use Eki\NRW\Mdl\Working\PlanItem\RecipePlanItem;
use Eki\NRW\Mdl\Working\PlanItem\Type\RecipePlanItemType;

use PHPUnit\Framework\TestCase;

use stdClass;

class RecipePlanCallbackTest extends TestCase
{
    public function testNew()
    {
    	$callback = new RecipePlanCallback();
    	
    	$this->assertSame('plan.recipe', $callback->getCallbackType());
    	$this->assertNull($callback->get('plan'));
    }

    public function testRecipePlanCallbackIsInstanceOfPlanCallback()
    {
    	$callback = new RecipePlanCallback();
    	
    	$this->assertInstanceOf(PlanCallback::class, $callback);
    }

    public function testWithSubject()
    {
    	$callback = new RecipePlanCallback();
    	$subject = new RecipePlan(new RecipePlanType());
    	$callback->assignSubject($subject);
    	
    	$this->assertNotNull($callback->get('plan'));
    	$this->assertEquals($subject, $callback->get('plan'));
    }

	/**
	* @expectedException \InvalidArgumentException
	*/
    public function testWithInvalidSubject()
    {
    	$callback = new RecipePlanCallback();
    	$subject = new stdClass();
    	$callback->assignSubject($subject);
    }

    public function testAddPlanItem()
    {
    	$callback = $this->createRecipePlanCallback();
    	$planItem = new RecipePlanItem(new RecipePlanItemType());

		$callback->add('plan_item', 'any_key', $planItem);    	
    }

	/**
	* @expectedException \InvalidArgumentException
	*/
    public function testAddNotPlanItem()
    {
    	$callback = $this->createRecipePlanCallback();
    	$notPlanItem = new stdClass();

		$callback->add('plan_item', 'any_key', $notPlanItem);    	
    }
    
    private function createRecipePlanCallback()
    {
    	$callback = new RecipePlanCallback();
    	$subject = new RecipePlan(new RecipePlanType());
    	$callback->assignSubject($subject);
    	
    	return $callback;
	}
}
