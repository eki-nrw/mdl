<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\REA\Tests\Agent;

use Eki\NRW\Mdl\REA\Agent\AgentInterface;
use Eki\NRW\Mdl\REA\Agent\AbstractAgent;
use Eki\NRW\Mdl\REA\Agent\AgentTypeInterface;

use PHPUnit\Framework\TestCase;

class AbstractAgentTest extends TestCase
{
	private $agent;
	
	public function setUp()
	{
    	$this->agent = $this->getMockBuilder(AbstractAgent::class)->getMockForAbstractClass();
	}
	
	public function tearDown()
	{
		$this->agent = null;
	}
	
	public function testInterfaces()
	{
    	$agent = $this->getMockBuilder(AbstractAgent::class)->getMockForAbstractClass();
    	
    	$this->assertInstanceOf(AgentInterface::class, $agent);
	}
	
    public function testAgentType()
    {
    	$agent = $this->agent;
    	
    	$agentType = $this->getMockBuilder(AgentTypeInterface::class)->getMock();
    	$agent->setAgentType($agentType);
    	
    	$this->assertNotNull($agent->getAgentType());
    }

    public function testName()
    {
    	$agent = $this->agent;

		// Default agent name is empty()
		$this->assertEmpty($agent->getName());
		
		$agent->setName('agent name');
		
		$this->assertSame($agent->getName(), 'agent name');
    }
}
