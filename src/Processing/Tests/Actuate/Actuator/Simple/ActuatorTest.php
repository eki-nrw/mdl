<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Processing\Tests\Actuate\Actuator\Simple;

use Eki\NRW\Mdl\Processing\Actuate\Actuator\Simple\Actuator;
use Eki\NRW\Mdl\Processing\Element;

use PHPUnit\Framework\TestCase;

use stdClass;
use ReflectionClass;
use ReflectionProperty;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class ActuatorTest extends TestCase
{
	public function testUnpack()
	{
		$actuator = $this->createActuator();
		
		$base = 100;
		$inputs = $this->prepareInputs($base);
		$unpacked = $actuator->unpack($inputs, []);
		
		$j = 1;
		foreach($unpacked as $key => $mat)
		{
			echo "key=".$key."  number=".$mat->number."\n";
			$this->assertSame($base + $j, $mat->number);
			$j++;
		}
	}

	/**
	* @expectedException \InvalidArgumentException
	* 
	*/
	public function testUnpackWrong()
	{
		$actuator = $this->createActuator();
		
		$base = 100;
		$inputs = $this->prepareWrongInputs($base);
		$unpacked = $actuator->unpack($inputs, []);
	}

	public function testProduce()
	{
		$actuator = $this->createActuator();
		
		$base = 100;
		$inputs = $this->prepareInputs($base);
		$unpacked = $actuator->unpack($inputs, []);
		
		$product = $actuator->produce($unpacked, []);
		
		$total = 0;
		foreach($unpacked as $mat)
		{
			$total += $mat->number;
		}
		$this->assertSame($product->total, $total);
	}

	public function testPack()
	{
		$actuator = $this->createActuator();
		
		$base = 100;
		$inputs = $this->prepareInputs($base);
		$unpacked = $actuator->unpack($inputs, []);
		
		$product = $actuator->produce($unpacked, []);
		
		$outputs = $this->prepareOutputs();
		$result = new stdClass();
		$result->number = 99;
		$outs = $actuator->pack($outputs, $result, []);
		
		foreach($outs as $out)
		{
			$sub = $out->getSubject();
			$res = $sub->result;
			$this->assertSame(99, $res->number);
		}
	}

	/**
	* @expectedException \InvalidArgumentException
	* 
	*/
	public function testPackWrongOutputs()
	{
		$actuator = $this->createActuator();
		
		$base = 100;
		$inputs = $this->prepareInputs($base);
		$unpacked = $actuator->unpack($inputs, []);
		
		$product = $actuator->produce($unpacked, []);
		
		$outputs = $this->prepareWrongOutputs();
		$result = new stdClass();
		$result->number = 99;
		$outs = $actuator->pack($outputs, $result, []);
	}

	/**
	* @expectedException \RuntimeException
	* 
	*/
	public function testPackWrongGiver()
	{
		$actuator = $this->createWrongActuator();
		
		$base = 100;
		$inputs = $this->prepareInputs($base);
		$unpacked = $actuator->unpack($inputs, []);
		
		$product = $actuator->produce($unpacked, []);
		
		$outputs = $this->prepareOutputs();
		$result = new stdClass();
		$result->number = 99;
		$outs = $actuator->pack($outputs, $result, []);
	}
	
	private function prepareInputs($base)
	{
		$inputs = [];
		$max = rand(3, 10);
		for($i=1;$i<$max;$i++)
		{
			$material = new stdClass();
			$material->number = $base + $i;
			$subject = new stdClass();
			$subject->material = $material;
			
			$k = "no-".(string)$i;
			$inputs[$k] = new Element($k, $subject);
		}
		
		return $inputs;
	}
	
	private function prepareOutputs()
	{
		$output = new Element(null, new stdClass());
		return array('default' => $output);
	}

	private function prepareWrongInputs($base)
	{
		$inputs = [];
		$max = rand(3, 10);
		for($i=1;$i<$max;$i++)
		{
			$material = new stdClass();
			$material->number = $base + $i;
			$subject = new WrongInputSubject();
			$subject->material = $material;
			
			$k = "no-".(string)$i;
			$inputs[$k] = new Element($k, $subject);
		}
		
		return $inputs;
	}

	private function prepareWrongOutputs()
	{
		$output = new Element(null, new WrongOutputSubject());
		return array('default' => $output);
	}
	
	private function createActuator()
	{
		$actuator = new Actuator(
			Helper::materialGetterFunc(),
			Helper::acceptInputSubjectFunc(),
			Helper::resultGiverFunc(),
			Helper::acceptOutputSubjectFunc(),
			Helper::produceFunc(),
			Helper::acceptMaterialFunc()
		);
		
		return $actuator;
	}

	private function createWrongActuator()
	{
		$actuator = new Actuator(
			Helper::materialGetterFunc(),
			Helper::acceptInputSubjectFunc(),
			function ($result, $subject) { return null;	},
			Helper::acceptOutputSubjectFunc(),
			Helper::produceFunc(),
			Helper::acceptMaterialFunc()
		);
		
		return $actuator;
	}
}

class WrongInputSubject
{
	public $material;	
}

class WrongOutputSubject
{
	
}