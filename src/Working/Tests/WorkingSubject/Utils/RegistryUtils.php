<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Working\Tests\WorkingSubject\Utils;

use Eki\NRW\Mdl\Working\WorkingSubjectInterface;
use Eki\NRW\Mdl\Working\WorkingSubject\Registry;
use Eki\NRW\Mdl\Working\WorkingSubject\ActionHandlerInterface;

use PHPUnit\Framework\TestCase;

class RegistryUtils
{
	public static function createActionHandler(TestCase $testCase)
	{
		$handler = $testCase->getMockBuilder(ActionHandlerInterface::class)
			->setMethods(["support", "handle", "getWorkingType", "setWorkingType"])
			->getMock()
		;
		
		$handler
			->expects($testCase->any())
			->method("support")
			->will($testCase->returnCallback(function($subject, $actionName) {
				return true;
			}))
		;

		$handler
			->expects($testCase->any())
			->method("handle")
			->will($testCase->returnCallback(function($subject, $actionName, array $contexts = []) {
				//... do nothing
			}))
		;

		$storeWorkingType = null;

		$handler
			->expects($testCase->any())
			->method("getWorkingType")
			->will($testCase->returnCallback(function() use ($storeWorkingType) {
				return $storeWorkingType;
			}))
		;

		$handler
			->expects($testCase->any())
			->method("setWorkingType")
			->will($testCase->returnCallback(function($workingType) use (&$storeWorkingType) {
				$storeWorkingType = $workingType;
			}))
		;
		
		return $handler;
	}
	
	public static function createRegistry(TestCase $testCase, $workingType, $workflow = null, $action = null, $workingSubjectClass = null)
	{
		return new Registry(
			$workingType,
			null === $action ? self::createActionHandler($testCase) : $action,
			$workingSubjectClass
		);
	}
}
