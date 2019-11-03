<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Working\Tests\Subject\Utils;

use Eki\NRW\Mdl\Working\ObjectBuilderInterface;
use Eki\NRW\Mdl\Working\Subject\CallbackInterface;
use Eki\NRW\Mdl\Working\Subject\ImportorInterface;
use Eki\NRW\Mdl\Working\Subject\ValidatorInterface;
use Eki\NRW\Mdl\Working\Subject\Registry;

use PHPUnit\Framework\TestCase;

use stdClass;

class RegistryUtils
{
	public static function createCallback(TestCase $testCase, $callbackType)
	{
		$callback = $testCase->getMockBuilder(CallbackInterface::class)
			->setMethods(['getCallbackType', 'getBuilder', 'setBuilder'])
			->getMockForAbstractClass()
		;
		
		$callback->expects($testCase->any())
			->method('getCallbackType')
			->will($testCase->returnCallback(function () use ($callbackType) {
				return $callbackType;
			}))
		;

		$callback->expects($testCase->any())
			->method('getBuilder')
			->will($testCase->returnCallback(function () use ($testCase) {
				return $testCase->getMockBuilder(ObjectBuilderInterface::class)
					->getMockForAbstractClass()
				;
			}))
		;

		$callback->expects($testCase->any())
			->method('setBuilder')
			->will($testCase->returnCallback(function (ObjectBuilderInterface $builder) {
				//
			}))
		;
		
		return $callback;
	}
	
	public static function createRegistry(TestCase $testCase, 
		$registryType, 
		$callback = null, $importor = null, $validator = null
	)
	{
		return new Registry(
			$registryType,
			stdClass::class,
			null === $callback ? self::createCallback($testCase, $registryType) : $callback,
			null === $importor ? $testCase->getMockBuilder(ImportorInterface::class)->getMockForAbstractClass() : $importor,
			null === $importor ? $testCase->getMockBuilder(ValidatorInterface::class)->getMockForAbstractClass() : $validator
		);
	}

	public static function createWrongRegistry(TestCase $testCase, $registryType, $callback = null, $importor = null, $validator = null)
	{
		return new Registry(
			$registryType,
			stdClass::class,
			null === $callback ? self::createCallback($testCase, $registryType . str_shuffle("abcdefgh")) : $callback,
			null === $importor ? $testCase->getMockBuilder(ImportorInterface::class)->getMockForAbstractClass() : $importor,
			null === $importor ? $testCase->getMockBuilder(ValidatorInterface::class)->getMockForAbstractClass() : $validator
		);
	}
}
