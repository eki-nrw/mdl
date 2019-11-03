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

use Eki\NRW\Mdl\Processing\ActuateResultByStorageTrait;
use Eki\NRW\Mdl\Processing\Storage\StorageInterface;

use PHPUnit\Framework\TestCase;

use ReflectionClass;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class ActuateResultByStorageTraitTest extends TestCase
{
	/**
	* @param mixed $produced
	* 
	* @testWith ["100"]
	*           ["99 kg"]
	*           ["abca,mdkjaskd"]
	*/
	public function testSetActuatedResult($produced)
	{
		$actuate = $this->getActuate();

		$this->setActuatedResult($actuate, $produced);
		$this->assertSame($produced, $actuate->getActuatedResult());
	}
	
	private function setActuatedResult($actuate, $produced)
	{
		$r = new ReflectionClass($actuate);
		$m = $r->getMethod("setActuatedResult");
		$m->setAccessible(true);
		$m->invokeArgs($actuate, array($produced));
	}

	private function getActuate()
	{
		$actuate = $this->getMockBuilder(ActuateResultByStorageTrait::class)
			->setMethods(['getStorage', 'setActuatedResultEx'])
			->getMockForTrait()
		;
		
		$actuate
			->expects($this->any())
			->method('setActuatedResultEx')
			->will($this->returnCallback(function ($produced) use ($actuate) {
				$actuate->getStorage()->setActuatedResult($produced);
			}))
		;
		
		$testCase = $this;
		$storage = null;
		$actuatedResult = null;
		
		$actuate
			->expects($this->any())
			->method('getStorage')
			->will($this->returnCallback(function () use (&$storage, $testCase, &$actuatedResult) {
				if ($storage === null)
				{
					$storage = $testCase->getMockBuilder(StorageInterface::class)
						->setMethods(['setActuatedResult', 'getActuatedResult'])
						->getMockForAbstractClass()
					;
					
					$storage
						->expects($testCase->any())
						->method('setActuatedResult')
						->will($testCase->returnCallback(function ($produced) use (&$actuatedResult) {
							$actuatedResult = $produced;
						}))
					;

					$storage
						->expects($testCase->any())
						->method('getActuatedResult')
						->will($testCase->returnCallback(function () use (&$actuatedResult) {
							return $actuatedResult;
						}))
					;
				}
				
				return $storage;
			}))
		;

		return $actuate;		
	}
}
