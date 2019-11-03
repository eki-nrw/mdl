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

use Eki\NRW\Mdl\Working\Subject\Director;
use Eki\NRW\Mdl\Working\Subject\Registry;
use Eki\NRW\Mdl\Working\Subject\CallbackInterface;
use Eki\NRW\Mdl\Working\Subject\ImportorInterface;
use Eki\NRW\Mdl\Working\Subject\ValidatorInterface;
use Eki\NRW\Mdl\Working\Subject\BaseObjectBuilder;
use Eki\NRW\Mdl\Working\ObjectBuilderInterface;

use Eki\NRW\Mdl\Working\Tests\Subject\Utils\RegistryUtils;
use Eki\NRW\Mdl\Working\Tests\Subject\Fixtures\ACallback;
use Eki\NRW\Mdl\Working\Tests\Subject\Fixtures\BCallback;
use Eki\NRW\Mdl\Working\Tests\Subject\Fixtures\CCallback;
use Eki\NRW\Mdl\Working\Tests\Subject\Fixtures\TestImportor;
use Eki\NRW\Mdl\Working\Tests\Subject\Fixtures\TestValidator;

use PHPUnit\Framework\TestCase;
use stdClass;

class DirectorTest extends TestCase
{
	/**
	* 
	* @expectedException \InvalidArgumentException
	*/	
	public function testDirector_RegistryWrong()
	{
		$director = new Director(array(
			RegistryUtils::createWrongRegistry($this, 'a_type')
		));
	}

	public function testDirectorAllRegistriesAreObject()
	{
		$director = new Director(array(
			RegistryUtils::createRegistry($this, 'type.1'),
			RegistryUtils::createRegistry($this, 'type.2'),
			RegistryUtils::createRegistry($this, 'type.3'),
			RegistryUtils::createRegistry($this, 'type.4'),
			RegistryUtils::createRegistry($this, 'type.5'),
		));
	}

	public function testDirectorAllRegistriesAreArrays()
	{
		$director = new Director(array(
			array(
				'type' => 'aaa', 
				'subject' => stdClass::class, 
				'callback' => ACallback::class, 
				'importor' => TestImportor::class, 
				'validator' => TestValidator::class
			),
			array(
				'type' => 'bbb', 
				'subject' => stdClass::class, 
				'callback' => BCallback::class, 
				'importor' => TestImportor::class, 
				'validator' => TestValidator::class
			),
			array(
				'type' => 'ccc', 
				'subject' => stdClass::class, 
				'callback' => CCallback::class, 
				'importor' => TestImportor::class, 
				'validator' => TestValidator::class
			),
			RegistryUtils::createRegistry($this, 'type.1'),
			RegistryUtils::createRegistry($this, 'type.2'),
			RegistryUtils::createRegistry($this, 'type.3'),
			RegistryUtils::createRegistry($this, 'type.4'),
			RegistryUtils::createRegistry($this, 'type.5'),
		));
	}

	public function testDirectorEventRegistriesAreArraysAndOrObjects()
	{
		$director = new Director(array(
			array(
				'type' => 'aaa', 
				'subject' => stdClass::class, 
				'callback' => ACallback::class, 
				'importor' => TestImportor::class, 
				'validator' => TestValidator::class
			),
			array(
				'type' => 'bbb', 
				'subject' => stdClass::class, 
				'callback' => BCallback::class, 
				'importor' => TestImportor::class, 
				'validator' => TestValidator::class
			),
			array(
				'type' => 'ccc', 
				'subject' => stdClass::class, 
				'callback' => CCallback::class, 
				'importor' => TestImportor::class, 
				'validator' => TestValidator::class
			),
		));
	}
	
	public function testGetBuilder()
	{
		$director = new Director(array(
			RegistryUtils::createRegistry($this, 'type.1'),
			RegistryUtils::createRegistry($this, 'type.2'),
			RegistryUtils::createRegistry($this, 'type.3'),
		));
		
		$builder = $director->getBuilder('type.1');

		$this->assertInstanceOf(ObjectBuilderInterface::class, $builder);
		$this->assertInstanceOf(BaseObjectBuilder::class, $builder);
	} 

	/**
	* 
	* @expectedException \UnexpectedValueException
	*/	
	public function testGetBuilderWrong()
	{
		$director = new Director(array(
			RegistryUtils::createRegistry($this, 'type.1'),
			RegistryUtils::createRegistry($this, 'type.2'),
			RegistryUtils::createRegistry($this, 'type.3'),
		));
		
		$builder = $director->getBuilder('type.4');
	} 

	public function testSupport()
	{
		$director = new Director(array(
			RegistryUtils::createRegistry($this, 'type.1'),
			RegistryUtils::createRegistry($this, 'type.2'),
			RegistryUtils::createRegistry($this, 'type.3'),
		));
		
		$this->assertTrue($director->support('type.1'));
		$this->assertTrue($director->support('type.2'));
		$this->assertTrue($director->support('type.3'));

		$this->assertFalse($director->support('type.anywrong'));
	} 
}
