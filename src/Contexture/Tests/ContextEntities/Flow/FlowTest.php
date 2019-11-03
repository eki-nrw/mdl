<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Contexture\Tests\ContextEntities\Flow;

use Eki\NRW\Mdl\Contexture\ContextEntities\Flow\FlowInterface;
use Eki\NRW\Mdl\Contexture\ContextEntities\Flow\Flow;
use Eki\NRW\Mdl\Contexture\ContextEntities\Flow\DataFlowInterface;
use Eki\NRW\Mdl\Contexture\ContextEntities\Matcher\MatcherInterface;

use PHPUnit\Framework\TestCase;
use stdClass;

class __Wrong_Class__4346465456
{
	
}

class __Right_Class__4353686897
{
	
}

class FlowTest extends TestCase
{
	public function testConstructor_Empty()
	{
		$flow = new Flow(
			"flow_name",
			$this->getMockBuilder(MatcherInterface::class)->getMock(),
			$this->getMockBuilder(DataFlowInterface::class)->getMock()
		);
		
		$this->assertInstanceOf(FlowInterface::class, $flow);
		$this->assertSame("flow_name", $flow->getName());
	}
	
	public function testAcceptData()
	{
		$flow = $this->getFlow(stdClass::class, null, null);
		
		$this->assertTrue($flow->acceptData(new stdClass));
		$this->assertFalse($flow->acceptData(new __Wrong_Class__4346465456));
	}

	public function testCanFlow()
	{
		$flow = $this->getFlow(null, stdClass::class, null);
		$this->assertTrue($flow->canFlow(new stdClass, new __Right_Class__4353686897));

		$flow = $this->getFlow(null, null, stdClass::class);
		$this->assertTrue($flow->canFlow(new __Right_Class__4353686897, new stdClass));

		$flow = $this->getFlow(null, stdClass::class, stdClass::class);
		$this->assertTrue($flow->canFlow(new stdClass, new stdClass));

		$flow = $this->getFlow(null, null, null);
		$this->assertTrue($flow->canFlow(new stdClass, new __Right_Class__4353686897));
		$this->assertTrue($flow->canFlow(new __Right_Class__4353686897, new stdClass));
	}
	
	public function testFlow()
	{
		$flow = $this->getFlow(null, null, null);
		
		$flow->flow(new stdClass, new __Right_Class__4353686897, new __Right_Class__4353686897, []);
	}
	
	private function getFlow($dataClass, $fromEntityClass, $toEntityClass)
	{
		$dataMatcher = $this->getMockBuilder(MatcherInterface::class)
			->setMethods(['match'])
			->getMockForAbstractClass()
		;
		
		$dataMatcher->expects($this->any())
			->method('match')
			->will($this->returnCallback(function ($data) use ($dataClass) {
				if ($dataClass === null)
					return true;
				else
					return $data instanceof $dataClass;
			}))
		;
		
		$flow = new Flow(
			"flow_name",
			$dataMatcher,
			$this->getDataFlow($fromEntityClass, $toEntityClass)
		);
		
		return $flow;
	}

	private function getDataFlow($fromEntityClass, $toEntityClass)
	{
		$dataFlow = $this->getMockBuilder(DataFlowInterface::class)
			->setMethods(['can', 'flow', 'setData'])
			->getMockForAbstractClass()
		;
		
		$dataFlow->expects($this->any())
			->method('can')
			->will($this->returnCallback(function ($fromEntity, $toEntity) use ($fromEntityClass, $toEntityClass) {
				if ($fromEntityClass !== null and !$fromEntity instanceof $fromEntityClass)
					return false;
				if ($toEntityClass !== null and !$toEntity instanceof $toEntityClass)
					return false;
				return true;
			}))
		;
		
		$dataFlow->expects($this->any())
			->method('flow')
			->will($this->returnCallback(function ($fromEntity, $toEntity, array $options = []) use ($dataFlow) {
				return $dataFlow;
			}))
		;
		
		$dataFlow->expects($this->any())
			->method('setData')
			->will($this->returnCallback(function ($data) use ($dataFlow) {
				return $dataFlow;
			}))
		;
		
		return $dataFlow;
	}
}
