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
use Eki\NRW\Mdl\Working\Subject\Callback\Plan\ProposalPlanCallback;
use Eki\NRW\Mdl\Working\Plan\ProposalPlan;
use Eki\NRW\Mdl\Working\Plan\Type\ProposalPlanType;
use Eki\NRW\Mdl\Working\PlanItem\ProposalPlanItem;
use Eki\NRW\Mdl\Working\PlanItem\Type\ProposalPlanItemType;

use PHPUnit\Framework\TestCase;

use stdClass;

class ProposalPlanCallbackTest extends TestCase
{
    public function testNew()
    {
    	$callback = new ProposalPlanCallback();
    	
    	$this->assertSame('plan.proposal', $callback->getCallbackType());
    	$this->assertNull($callback->get('plan'));
    }

    public function testProposalPlanCallbackIsInstanceOfPlanCallback()
    {
    	$callback = new ProposalPlanCallback();
    	
    	$this->assertInstanceOf(PlanCallback::class, $callback);
    }

    public function testWithSubject()
    {
    	$callback = new ProposalPlanCallback();
    	$subject = new ProposalPlan(new ProposalPlanType());
    	$callback->assignSubject($subject);
    	
    	$this->assertNotNull($callback->get('plan'));
    	$this->assertEquals($subject, $callback->get('plan'));
    }

	/**
	* @expectedException \InvalidArgumentException
	*/
    public function testWithInvalidSubject()
    {
    	$callback = new ProposalPlanCallback();
    	$subject = new stdClass();
    	$callback->assignSubject($subject);
    }

    public function testAddPlanItem()
    {
    	$callback = $this->createProposalPlanCallback();
    	$planItem = new ProposalPlanItem(new ProposalPlanItemType());

		$callback->add('plan_item', 'any_key', $planItem);    	
    }

	/**
	* @expectedException \InvalidArgumentException
	*/
    public function testAddNotPlanItem()
    {
    	$callback = $this->createProposalPlanCallback();
    	$notPlanItem = new stdClass();

		$callback->add('plan_item', 'any_key', $notPlanItem);    	
    }
    
    private function createProposalPlanCallback()
    {
    	$callback = new ProposalPlanCallback();
    	$subject = new ProposalPlan(new ProposalPlanType());
    	$callback->assignSubject($subject);
    	
    	return $callback;
	}
}
