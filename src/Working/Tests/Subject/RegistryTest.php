<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Working\Tests\Subject;

use Eki\NRW\Mdl\Working\Subject\CallbackInterface;
use Eki\NRW\Mdl\Working\Subject\ImportorInterface;
use Eki\NRW\Mdl\Working\Subject\ValidatorInterface;
use Eki\NRW\Mdl\Working\Subject\Registry;
use Eki\NRW\Mdl\Working\Tests\Subject\Utils\SimpleUtils;

use PHPUnit\Framework\TestCase;

use stdClass;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class RegistryTest extends TestCase
{
	public function testRegistryAllElementsAreClasses()
	{
		$registry = $this->createRegistry('same_as_callback_type', 
			CallbackInterface::class, 
			ImportorInterface::class, 
			ValidatorInterface::class
		);
	}

	public function testRegistryAllElementsAreObject()
	{
		$registry = $this->createRegistry('same_as_callback_type');

		$this->assertSame($registry->getType(), 'same_as_callback_type');
		$this->assertTrue(is_object($registry->getCallbackInfo()));
		$this->assertEquals('same_as_callback_type', $registry->getCallbackInfo()->getCallbackType());
	}
	
	/**
	* 
	* @expectedException \InvalidArgumentException
	*/	
	public function testRegistryCallbackWrong()
	{
		$registry = $this->createRegistry('a_type', 
			stdClass::class, ImportorInterface::class, ValidatorInterface::class);
	}

	/**
	* 
	* @expectedException \InvalidArgumentException
	*/	
	public function testRegistryImportorkWrong()
	{
		$registry = $this->createRegistry('a_type', 
			CallbackInterface::class, stdClass::class, ValidatorInterface::class);
	}

	/**
	* 
	* @expectedException \InvalidArgumentException
	*/	
	public function testRegistryValidatorkWrong()
	{
		$registry = $this->createRegistry('a_type', 
			CallbackInterface::class, ImportorInterface::class, stdClass::class);
	}
		
	private function createRegistry($registryType, $callback = null, $importor = null, $validator = null, $factory = null)
	{
		return new Registry(
			$registryType,
			stdClass::class,
			null === $callback ? SimpleUtils::createSimpleCallback($this, $registryType) : $callback,
			null === $importor ? SimpleUtils::createSimpleImportor($this) : $importor,
			null === $importor ? SimpleUtils::createSimpleValidator($this) : $validator,
			$factory
		);

	}
}
