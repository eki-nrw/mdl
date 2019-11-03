<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Processing\Tests;

use Eki\NRW\Mdl\Processing\ActuateTrait;

use PHPUnit\Framework\TestCase;

use stdClass;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class ActuateTraitTest extends TestCase
{
	public function testNoActuating()
	{
		$actuate = $this->getMockBuilder(ActuateTrait::class)
			->setMethods(['actuating'])
			->getMockForTrait()
		;
		
		$actuate
			->expects($this->once())
			->method('actuating')
			->will($this->returnCallback(function (array $contexts) {}))
		;
		
		$this->assertFalse($actuate->isActuated());		
		$actuate->actuate([]);
		$this->assertTrue($actuate->isActuated());		
	}

	public function testDefaultActuating()
	{
		$actuate = $this->getMockBuilder(ActuateTrait::class)
			->setMethods(['unpack', 'produce', 'setActuatedResult', 'getActuatedResult', 'setVariationProduced', 'actuating'])
			->getMockForTrait()
		;
		
		$actuate
			->expects($this->once())
			->method('unpack')
			->will($this->returnCallback(function (array $contexts) {
				echo "unpack...UNPACKED" . "\n";
				return "UNPACKED";
			}))
		;

		$variationProduced = new stdClass();

		$actuate
			->expects($this->once())
			->method('setVariationProduced')
			->will($this->returnCallback(function ($variation) use (&$variationProduced) {
				$variationProduced->name = $variation;
			}))
		;

		$actuate
			->expects($this->once())
			->method('produce')
			->will($this->returnCallback(function ($unpacked, array $contexts) use (&$variationProduced) {
				echo "produce...PRODUCTION" . "\n";
				return $variationProduced;
			}))
		;

		$actuatedResult = null;

		$actuate
			->expects($this->once())
			->method('setActuatedResult')
			->will($this->returnCallback(function ($produced) use (&$actuatedResult) {
				echo "setActuatedResult..." . "\n";
				$actuatedResult = $produced;
			}))
		;

		$actuate
			->expects($this->exactly(2))
			->method('getActuatedResult')
			->will($this->returnCallback(function () use (&$actuatedResult) {
				echo "getActuatedResult..." . "\n";
				return $actuatedResult;
			}))
		;

		$actuate
			->expects($this->once())
			->method('actuating')
			->will($this->returnCallback(function (array $contexts) {}))
		;

		$randomStr = str_shuffle("ashdhsahdhj217389jkashkfhdjashd skjdhkhsakjhdksa78973");
		echo "random string=".$randomStr."\n";
		$actuate->setVariationProduced($randomStr);
		
		$this->assertFalse($actuate->isActuated());	
		$actuate->actuate([]);
		$this->assertTrue($actuate->isActuated());

		$result = $actuate->getActuatedResult();
		echo "Actuated Result=".$result->name."\n";
		$this->assertSame($randomStr, $actuate->getActuatedResult()->name);
	}

	/**
	* @expectedException \LogicException
	* 
	*/
	public function testReActuate()
	{
		$actuate = $this->getMockBuilder(ActuateTrait::class)
			->setMethods(['actuating'])
			->getMockForTrait()
		;
		
		$actuate
			->expects($this->once())
			->method('actuating')
			->will($this->returnCallback(function (array $contexts) {}))
		;
		 
		$actuate->actuate([]);
		echo "Cannot re-actuate..."."\n";
		$actuate->actuate([]);
	}
}
