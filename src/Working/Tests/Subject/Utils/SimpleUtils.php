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

use PHPUnit\Framework\TestCase;

use stdClass;

class SimpleUtils
{
	public static function createSimpleCallback(TestCase $testCase, $callbackType)
	{
		$callback = $testCase->getMockBuilder(CallbackInterface::class)
			->setMethods(['getCallbackType'])
			->getMockForAbstractClass()
		;
		
		$callback->expects($testCase->any())
			->method('getCallbackType')
			->will($testCase->returnCallback(function () use ($callbackType) {
				return $callbackType;
			}))
		;

		return $callback;
	}

	public static function createSimpleImportor(TestCase $testCase)
	{
		$importor = $testCase->getMockBuilder(ImportorInterface::class)
			->setMethods(['support', 'import'])
			->getMockForAbstractClass()
		;

		$importor->expects($testCase->any())
			->method('support')
			->will($testCase->returnCallback(function ($data, $object) { return true; }))
		;
		
		$importor->expects($testCase->any())
			->method('import')
			->will($testCase->returnCallback(function ($data, &$object, array $contexts = []) {}))
		;
		
		return $importor;
	}

	public static function createSimpleValidator(TestCase $testCase)
	{
		$validator = $testCase->getMockBuilder(ValidatorInterface::class)
			->setMethods(['support', 'validate'])
			->getMockForAbstractClass()
		;

		$validator->expects($testCase->any())
			->method('support')
			->will($testCase->returnCallback(function ($object) { return true; }))
		;
		
		$validator->expects($testCase->any())
			->method('validate')
			->will($testCase->returnCallback(function ($object, array $options = []) {}))
		;
		
		return $validator;
	}
}
