<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Contexture\Tests\ContextEntities\Definition;

use Eki\NRW\Mdl\Contexture\ContextEntities\Definition\ValidatorInterface;
use Eki\NRW\Mdl\Contexture\ContextEntities\Definition\Validator;

use PHPUnit\Framework\TestCase;

class ValidatorTest extends TestCase
{
	public function testConstructor_Validator_True()
	{
		$validator = new Validator($this->getChecker(true));
		
		$this->assertInstanceOf(ValidatorInterface::class, $validator);
		$this->assertTrue($validator->validate([]));
	}

	public function testConstructor_Validator_False()
	{
		$validator = new Validator($this->getChecker(false));
		
		$this->assertInstanceOf(ValidatorInterface::class, $validator);
		$this->assertFalse($validator->validate([]));
	}
	
	private function getChecker($expected)
	{
		return
			function ($configuration) use ($expected) {
				return $expected;
			}
		;
	}
}
