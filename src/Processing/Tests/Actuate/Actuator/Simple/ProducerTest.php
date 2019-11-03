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

use Eki\NRW\Mdl\Processing\Actuate\Actuator\Simple\Producer;

use PHPUnit\Framework\TestCase;

use stdClass;
use ReflectionClass;
use ReflectionProperty;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class ProducerTest extends TestCase
{
	public function testProduceAndGetProduct()
	{
		$producer = $this->createProducer();
		
		$total = 0;
		$materials = [];
		$max = rand(3, 20);
		for($i=1;$i<=$max;$i++)
		{
			$material = new stdClass();
			$material->number = rand(0, 100);
			
			$total += $material->number;
			echo $i.": number=".$material->number."\n";
			
			$materials[] = $material;
		}

		$producer->produce($materials);
		
		$product = $producer->getProduct();
		$this->assertSame($total, $product->total);
		echo "Total: ".$total."\n";
	}
	
	private function createProducer()
	{
		$producer = new Producer(
			Helper::produceFunc(),
			Helper::acceptMaterialFunc()
		);
		
		return $producer;
	}
}
