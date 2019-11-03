<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Processing\Tests\Utils;

use Eki\NRW\Mdl\Processing\Actuate\ActuatorInterface;
use Eki\NRW\Mdl\Processing\Actuate\MaterialGetterInterface;
use Eki\NRW\Mdl\Processing\Actuate\ResultGiverInterface;
use Eki\NRW\Mdl\Processing\Actuate\ProducerInterface;
use Eki\NRW\Mdl\Processing\ElementInterface;
use Eki\NRW\Mdl\Processing\Element;

use PHPUnit\Framework\TestCase;

use stdClass;
use ReflectionClass;

final class Actuator
{
	static public function createSimpleInputSubject($number = null)
	{
		if ($number === null)
			$number = rand(0, 1000);
		$subject = new stdClass;
		$material = new stdClass;
		$material->number = $number;
		$subject->material = $material;
		
		return $subject;		
	}

	static public function createSimpleOutputSubject()
	{
		$subject = new stdClass;
		$subject->result = null;
		
		return $subject;		
	}
	
	static public function createSimpleMaterialGetter(TestCase $testCase)
	{
		$materialGetter = $testCase->getMockBuilder(MaterialGetterInterface::class)
			->setMethods(['get', 'belongSubject', 'getSubject'])
			->getMockForAbstractClass()
		;

		$storeSubject = null;

		$materialGetter
			->expects($testCase->any())
			->method('belongSubject')
			->will($testCase->returnCallback(function ($subject = null) use (&$storeSubject) {
				$storeSubject = $subject;
			}))
		;

		$materialGetter
			->expects($testCase->any())
			->method('getSubject')
			->will($testCase->returnCallback(function ($subject = null) use (&$storeSubject) {
				return $storeSubject;
			}))
		;
		
		$materialGetter
			->expects($testCase->any())
			->method('get')
			->will($testCase->returnCallback(function ($subject = null, array $contexts = []) use ($materialGetter) {
				if ($subject === null)
					$subject = $materialGetter->getSubject();
				return $subject->material;
			}))
		;

		return $materialGetter;
	}

	static public function createSimpleResultGiver(TestCase $testCase)
	{
		$resultGiver = $testCase->getMockBuilder(ResultGiverInterface::class)
			->setMethods(['give', 'belongSubject', 'getSubject'])
			->getMockForAbstractClass()
		;

		$storeSubject = null;

		$resultGiver
			->expects($testCase->any())
			->method('belongSubject')
			->will($testCase->returnCallback(function ($subject = null) use (&$storeSubject) {
				$storeSubject = $subject;
			}))
		;

		$resultGiver
			->expects($testCase->any())
			->method('getSubject')
			->will($testCase->returnCallback(function ($subject = null) use (&$storeSubject) {
				return $storeSubject;
			}))
		;
		
		$resultGiver
			->expects($testCase->any())
			->method('give')
			->will($testCase->returnCallback(function ($result, $subject = null, array $contexts = []) 
				use ($resultGiver) 
			{
				if ($subject === null)
					$subject = $resultGiver->getSubject();
				$subject->result = $result;
			}))
		;

		return $resultGiver;
	}

	static public function createSimpleProducer(TestCase $testCase)
	{
		$producer = $testCase->getMockBuilder(ProducerInterface::class)
			->setMethods(['produce', 'getProduct', 'acceptMaterial'])
			->getMockForAbstractClass()
		;

		$product = null;

		$producer
			->expects($testCase->any())
			->method('produce')
			->will($testCase->returnCallback(function (array $materials, array $contexts) use (&$product, $producer) {
				foreach($materials as $mat)
				{
					if ($producer->acceptMaterial($mat) !== true)
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
			}))
		;

		$producer
			->expects($testCase->any())
			->method('getProduct')
			->will($testCase->returnCallback(function (array $contexts = []) use (&$product) {
				return $product;
			}))
		;

		$producer
			->expects($testCase->any())
			->method('acceptMaterial')
			->will($testCase->returnCallback(function ($material) use (&$product) {
				return true;
			}))
		;

		return $producer;
	}
	
	static public function createActuator(TestCase $testCase, 
		array $info = [
			'inputClass' => stdClass::class,
			'outputClass' => stdClass::class,
			'materialGetter' => null,
			'resultGiver' => null,
			'producer' => null
		]
	)
	{
		//// Material Getter
		$materialGetter = $info['materialGetter'];
		if ($materialGetter === null)
		{
			$materialGetter = self::createSimpleMaterialGetter($testCase);
		}
		
		//// Result Giver
		$resultGiver = $info['resultGiver'];
		if ($resultGiver === null)
		{
			$resultGiver = self::createSimpleResultGiver($testCase);
		}

		//// Producer
		$producer = $info['producer'];
		if ($producer === null)
		{
			$producer = self::createSimpleProducer($testCase);
		}
		
		//// Actuator
		$actuator = $testCase->getMockBuilder(ActuatorInterface::class)
			->setMethods(['unpack', 'produce', 'pack', 'acceptInput', 'acceptOutput'])
			->getMockForAbstractClass()
		;
		
		$actuator
			->expects($testCase->any())
			->method('unpack')
			->will($testCase->returnCallback(function (array $inputs, array $contexts) use ($materialGetter) {
				echo "Unkacking begins..."."\n";
				$unpacked = [];
				foreach($inputs as $e)
				{
					$unpacked[$e->getKey()] = $materialGetter->get($e->getSubject(), $contexts);
					echo "  unpacking with key ".$e->getKey()."\n";
				}
				echo "Unkacking ends..."."\n";
				return $unpacked;
			}))
		;

		$actuator
			->expects($testCase->any())
			->method('produce')
			->will($testCase->returnCallback(function ($unpacked, array $contexts) use ($producer) {
				$producer->produce($unpacked, $contexts);
				return $producer->getProduct();
			}))
		;

		$actuator
			->expects($testCase->any())
			->method('pack')
			->will($testCase->returnCallback(function (array $outputs, $actuatedResult, array $contexts) 
				use ($resultGiver) 
			{
				$outs = [];
				foreach($outputs as $key => $output)
				{
					$subject = $output->getSubject();
					$subject->result = $actuatedResult;
					$output->setSubject($subject);
					$outs[$key] = $output;
				}

				return $outs;
			}))
		;

		$actuator
			->expects($testCase->any())
			->method('acceptInput')
			->will($testCase->returnCallback(function ($inputSubject) use ($info) {
				return $inputSubject instanceof $info['inputClass'];
			}))
		;

		$actuator
			->expects($testCase->any())
			->method('acceptOutput')
			->will($testCase->returnCallback(function ($outputSubject) use ($info) {
				return $outputSubject instanceof $info['outputClss'];
			}))
		;
		
		return $actuator;
	}
}