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

use Eki\NRW\Mdl\Contexture\ContextEntities\Definition\Definition;
use Eki\NRW\Mdl\Contexture\ContextEntities\Definition\DefinitionInterface;
use Eki\NRW\Mdl\Contexture\ContextEntities\Definition\ValidatorInterface;

use PHPUnit\Framework\TestCase;

class DefinitionTest extends TestCase
{
	public function testConstructor_Empty()
	{
		$definition = new Definition();
		
		$this->assertInstanceOf(DefinitionInterface::class, $definition);
		$this->assertEmpty($definition->getConfiguration());
	}
	
	public function testConstructor_Any_Configuration_No_Validator()
	{
		$definition = new Definition(array(
			'config_1' => 100,
			'config_2' => "kasdkjsakkdjsak",
		));
		
		$this->assertInstanceOf(DefinitionInterface::class, $definition);
		$this->assertNotEmpty($definition->getConfiguration());
	}
	
	public function testConstructor_Configuration_Validator_Good()
	{
		$definition = new Definition(
			array(
				'config_1' => 100,
				'config_2' => "kasdkjsakkdjsak",
			),
			$this->getValidator(true)
		);
		
		$this->assertNotEmpty($definition->getConfiguration());
	}

	/**
	* 
	* @expectedException \InvalidArgumentException
	*/
	public function testConstructor_Configuration_Validator_Fail()
	{
		$definition = new Definition(
			array(
				'config_1' => 100,
				'config_2' => "kasdkjsakkdjsak",
			),
			$this->getValidator(false)
		);
		
		$this->assertNotEmpty($definition->getConfiguration());
	}
	
	private function getValidator($expected)
	{
		$validator = $this->getMockBuilder(ValidatorInterface::class)
			->setMethods(['validate'])
			->getMock()
		;
		
		$validator->expects($this->any())
			->method('validate')
			->will($this->returnValue($expected))
		;
		
		return $validator;
	}
}
