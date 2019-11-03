<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Processing\Tests\Actuate;

use Eki\NRW\Mdl\Processing\Actuate\ActuateByActuatorTrait;
use Eki\NRW\Mdl\Processing\Actuate\ActuatorInterface;
use Eki\NRW\Mdl\Processing\ElementInterface;
use Eki\NRW\Mdl\Processing\Element;

use Eki\NRW\Mdl\Processing\Tests\Utils\Actuator;

use PHPUnit\Framework\TestCase;

use stdClass;
use ReflectionClass;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class ActuateByActuatorTraitTest extends TestCase
{
	public function testSetActuator()
	{
		$actuate = $this->createActuate();
		
		$actuator = $this->createActuator();
		$actuate->setActuator($actuator);
		
		$this->assertSame($actuator, $this->getActuator($actuate));
	}

	public function testResetActuator()
	{
		$actuate = $this->createActuate();
		
		$actuator = $this->createActuator();
		$actuate->setActuator($actuator);
		
		$this->assertSame($actuator, $this->getActuator($actuate));
		
		$actuate->setActuator();
		$this->assertNull($this->getActuator($actuate));
	}

	public function testGetActuatorThruContexts()
	{
		$actuate = $this->createActuate();
		
		$actuator = $this->createActuator();

		$contexts = [];	
		$contexts['processing_actuator'] = $actuator;
		$this->assertSame($actuator, $this->getActuator($actuate, $contexts));
	}

	public function testActuating()
	{
		$actuate = $this->createActuate(true);

		$actuate->setFrameInput($this->prepareFrameInput());
		
		$actuate->actuating([]);		
	}

	public function testPack()
	{
		$actuate = $this->createActuate(true);

		$actuate->setFrameInput($this->prepareFrameInput());
		
		$actuate->actuating([]);		
		$outputs = $actuate->pack($this->prepareFrameOutput(), []);
		
		$output = reset($outputs);
		$subject = $output->getSubject();
		$result = $subject->result;
		echo "Output..."."\n";
		echo "  count: ".$result->count."\n";
		echo "  desc: ".$result->desc."\n";
	}
	
	private function prepareFrameInput()
	{
		$frameInput = [];
		$num = rand(3, 10);
		for($i=0;$i<$num;$i++)
		{
			$subject = new stdClass();
			$material = new stdClass;
			$material->number = $i;
			$subject->material = $material;
			$e = new Element(str_shuffle("abcdefghijk"), $subject);
			
			$frameInput[] = $e;
		}
		
		return $frameInput;
	}

	private function prepareFrameOutput()
	{
		$subject = new stdClass();
		$e = new Element(null, $subject);
		
		$frameOutputs = [];
		$frameOutputs[] = $e;
		
		return $frameOutputs;
	}
	
	private function getActuator($actuate, array $contexts = [])
	{
		$r = new ReflectionClass($actuate);
		$m = $r->getMethod('getActuator');
		$m->setAccessible(true);
		
		return $m->invokeArgs($actuate, array($contexts));
	}

	private function createActuator()
	{
		return Actuator::createActuator($this);
	}
	
	private function createActuate($autoCreateActuator = false)
	{
		$actuate = $this->getMockBuilder(ActuateByActuatorTrait::class)
			->setMethods(['actuating', 'setFrameInput', 'getFrameInput', 'setActuatedResult', 'getActuatedResult'])
			->getMockForTrait()
		;

		$actuate
			->expects($this->any())
			->method('actuating')
			->will($this->returnCallback(function (array $contexts) use ($actuate) {
				$r = new ReflectionClass($actuate);
				
				// By pass protected method: unpack
				//     $unpacked = $actuate->unpack($contexts);
				$m = $r->getMethod('unpack');
				$m->setAccessible(true);
				$unpacked = $m->invokeArgs($actuate, array($contexts));
				
				// By pass protected method: produce
				//     $produced = $actuate->produce($unpacked, $contexts);
				$m = $r->getMethod('produce');
				$m->setAccessible(true);
				$produced = $m->invokeArgs($actuate, array($unpacked, $contexts));
				
				$actuate->setActuatedResult($produced, $contexts);
			}))
		;

		/**
		* Frame input
		* 
		* @var ElementInterface[]
		*/
		$storeFrameInput = null;

		$actuate
			->expects($this->any())
			->method('setFrameInput')
			->will($this->returnCallback(function (array $frameInput) use (&$storeFrameInput) {
				foreach($frameInput as $e)
				{
					if (!$e instanceof ElementInterface)
						throw new \InvalidArgumentException(sprintf(
							"Frame input must be array of %s.", ElementInterface::class
						));
				}
				
				$storeFrameInput = $frameInput;
			}))
		;

		$actuate
			->expects($this->any())
			->method('getFrameInput')
			->will($this->returnCallback(function () use (&$storeFrameInput) {
				return $storeFrameInput;
			}))
		;

		/**
		* Actuated result
		* 
		* @var mixed
		*/
		$result = null;

		$actuate
			->expects($this->any())
			->method('setActuatedResult')
			->will($this->returnCallback(function ($produced, array $contexts = []) use (&$result) {
				$result = $produced;
			}))
		;

		$actuate
			->expects($this->any())
			->method('getActuatedResult')
			->will($this->returnCallback(function (array $contexts = []) use (&$result) {
				return $result;
			}))
		;

		if ($autoCreateActuator)
			$actuate->setActuator($this->createActuator());
		
		return $actuate;
	}
}
