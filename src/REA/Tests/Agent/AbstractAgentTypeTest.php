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

use Eki\NRW\Mdl\REA\Agent\AbstractAgentType;
use Eki\NRW\Mdl\REA\Agent\AgentTypeInterface;

use PHPUnit\Framework\TestCase;

class AbstractAgentTypeTest extends TestCase
{
	private $agentType;
	
	public function setUp()
	{
    	$this->agentType = $this->getMockBuilder(AbstractAgentType::class)->getMockForAbstractClass();
	}
	
	public function tearDown()
	{
		$this->agentType = null;
	}
	
	public function testInterfaces()
	{
    	$agentType = $this->agentType;

		$this->assertInstanceOf(AgentTypeInterface::class, $agentType);
	}
	
    public function testName()
    {
    	$agentType = $this->agentType;
    	
    	$this->assertEmpty($agentType->getName());
    	
    	$agentType->setName('agent type name');
    	
    	$this->assertSame($agentType->getName(), 'agent type name');
    }
}
