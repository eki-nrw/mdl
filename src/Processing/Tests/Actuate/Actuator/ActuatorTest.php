<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Processing\Tests\Actuate\Actuator;

use Eki\NRW\Mdl\Processing\Actuate\Actuator\Actuator;
use Eki\NRW\Mdl\Processing\Element;

use PHPUnit\Framework\TestCase;

use stdClass;
use Closure;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class ActuatorTest extends TestCase
{
	public function testActuating()
	{
		$actuator = $this->createActuator();
		
		$base = 100;
		$inputs = $this->prepareInputs($base);
		
		$product = $actuator->actuating($inputs, []);
	}

	public function testPack()
	{
		$actuator = $this->createActuator();
		
		$base = 100;
		$inputs = $this->prepareInputs($base);

		$product = $actuator->actuating($inputs, []);
		
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

		$product = $actuator->actuating($inputs, []);
		
		$outputs = $this->prepareWrongOutputs();
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
		$materialUnpacker = function ($subject, array $contexts) {
			return $subject->material;
		};

		$materialChecker = function ($material) {
			return true;	
		};

		$product = null;
		$producer = function ($materials, Closure $checker, array $contexts) use (&$product) {
			foreach($materials as $mat)
			{
				if ($checker($mat) !== true)
					throw new \Exception("Material invalid.");
			}
			
			$produced = new stdClass;
			$produced->count = count($materials);
			$produced->desc = str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz");
			
			echo "Simple Producer runs produce function...."."\n";
			echo "  imagines product..."."\n";
			echo "    count: ".$produced->count."\n";
			echo "    description: ".$produced->desc."\n";
			
			$product = $produced;
		};
		
		$productPacker = function ($product, $subject, array $contexts) {
			$subject->result = $product;
			
			return $subject;
		};
		
		$inputSubjectChecker = function ($subject) {
			return $subject instanceof stdClass;
		};

		$outputSubjectChecker = function ($subject) {
			return $subject instanceof stdClass;
		};
		
		$actuator = new Actuator(
			$materialUnpacker,
			$producer,
			$productPacker,
			$inputSubjectChecker,
			$materialChecker,
			$outputSubjectChecker
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