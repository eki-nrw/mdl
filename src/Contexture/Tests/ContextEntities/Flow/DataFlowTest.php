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

use Eki\NRW\Mdl\Contexture\ContextEntities\Flow\DataFlowInterface;
use Eki\NRW\Mdl\Contexture\ContextEntities\Flow\DataFlow;

use PHPUnit\Framework\TestCase;
use stdClass;

class __Wrong_Class__67678687
{
	
}

class __Right_Class__34365688
{
	
}

class DataFlowTest extends TestCase
{
	public function testConstructor()
	{
		$dataFlow = new DataFlow("dataflow_name");
		
		$this->assertSame("dataflow_name", $dataFlow->getName());
	}

	public function testSetData()
	{
		$dataFlow = new DataFlow(
			"dataflow_name",
			function ($data) {
				return $data instanceof stdClass;
			}			
		);

		$this->assertEquals($dataFlow, $dataFlow->setData());
		$this->assertEquals($dataFlow, $dataFlow->setData(new stdClass));
	}

	/**
	* @expectedException \InvalidArgumentException
	*/
	public function testSetData_Wrong()
	{
		$dataFlow = new DataFlow(
			"dataflow_name",
			function ($data) {
				return $data instanceof stdClass;
			}			
		);
		
		$dataFlow->setData(new __Wrong_Class__67678687);
	}
	
	public function testCan()
	{
		$dataFlow = new DataFlow("dataflow_name");
		$this->assertFalse($dataFlow->can(new stdClass, new stdClass));
		
		$dataFlow = new DataFlow(
			"dataflow_name",
			null,
			function ($fromEntity, $toEntity) {
				return 
					$fromEntity instanceof stdClass 
					and
					$toEntity instanceof stdClass 
				;
			}			
		);
		
		$this->assertTrue($dataFlow->can(new stdClass, new stdClass));
		$this->assertFalse($dataFlow->can(new stdClass, new __Wrong_Class__67678687));
		$this->assertFalse($dataFlow->can(new __Wrong_Class__67678687, new stdClass));
	}
	
	/**
	* @expectedException \InvalidArgumentException
	*/
	public function testFlow_NoData()
	{
		$dataFlow = new DataFlow(
			"dataflow_name",
			null,
			function ($fromEntity, $toEntity) {
				return 
					$fromEntity instanceof stdClass 
					and
					$toEntity instanceof stdClass 
				;
			}			
		);
		
		$dataFlow->flow(new stdClass, new stdClass);		
	}

	public function testFlow_RightData()
	{
		$dataFlow = new DataFlow(
			"dataflow_name",
			null,
			function ($fromEntity, $toEntity) {
				return 
					$fromEntity instanceof stdClass 
					and
					$toEntity instanceof stdClass 
				;
			}			
		);
		
		$dataFlow
			->setData(new stdClass)
			->flow(new stdClass, new stdClass);		
	}
}
