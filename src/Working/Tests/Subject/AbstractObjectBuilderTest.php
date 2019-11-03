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
use Eki\NRW\Mdl\Working\Subject\AbstractCallback;
use Eki\NRW\Mdl\Working\Subject\AbstractObjectBuilder;
use Eki\NRW\Mdl\Working\Subject\AbstractImportor;
use Eki\NRW\Mdl\Working\Subject\ImportorInterface;
use Eki\NRW\Mdl\Working\Subject\ValidatorInterface;

use PHPUnit\Framework\TestCase;
use stdClass;

class NotSupportedClass_91309328302038
{
	
}

class AbstractObjectBuilderTest extends TestCase
{
	private $builder;
	
	public function setUp()
	{
		$this->objectBuilder = $this->createObjectBuilder(
			array(stdClass::class),
			array('type_a', 'type_b', 'type_c')
		);
	}
	
	public function tearDownn()
	{
		$this->objectBuilder = null;
	}

    public function testReset()
    {
    	$builder = $this->objectBuilder;

		$builder->setObject(new stdClass());
		$builder->reset();
		$builder->setObject(new stdClass());
		$builder->reset();
		$builder->setObjectType('type_a');
		$builder->reset();
	}
	
    public function testSetObjectType()
    {
    	$builder = $this->objectBuilder;

		$builder->setObjectType('type_a');
		$builder->reset();
    }

    public function testCanSetObjectTypeNullToReset()
    {
    	$builder = $this->objectBuilder;

		$builder->setObjectType('type_b');
		$builder->setObjectType(null);
		$builder->reset();
    }

    public function testSetObject()
    {
    	$builder = $this->objectBuilder;

		$builder->setObject(new stdClass());
		$builder->reset();
    }

	/**
	* 
	* @expectedException \RuntimeException
	*/	
    public function testSetObject_Twice()
    {
    	$builder = $this->objectBuilder;

		$builder->setObject(new stdClass());
		$builder->setObject(new stdClass());
    }

	/**
	* 
	* @expectedException \RuntimeException
	*/	
    public function testSetObjectType_Twice()
    {
    	$builder = $this->objectBuilder;

		$builder->setObjectType('type_a');
		$builder->setObjectType('type_b');
    }

	/**
	* 
	* @expectedException \InvalidArgumentException
	*/	
    public function testSetObject_NotObject()
    {
    	$builder = $this->objectBuilder;

		$builder->setObject('adfasdsajldj');
    }

	/**
	* 
	* @expectedException \InvalidArgumentException
	*/	
    public function testSetObject_NotSupport()
    {
    	$builder = $this->objectBuilder;

		$builder->setObject(new NotSupportedClass_91309328302038());
    }
    
	/**
	* 
	* @expectedException \RuntimeException
	*/	
    public function testSetObjectAndObjectType()
    {
    	$builder = $this->objectBuilder;

		$builder->setObject(new stdClass());
		$builder->setObjectType('type_a');
    }
    
	/**
	* Cannot build object if nothing to build 
	* 
	* @expectedException \RuntimeException
	*/	
    public function testCannotBuildIfNothingToBuild()
    {
    	$builder = $this->objectBuilder;

		$builder->build();
    }
    
    public function testAdd()
    {
		$builder = $this->createObjectBuilder(
			array(stdClass::class),
			array('type_a', 'type_b', 'type_c'),
			array('family_name', 'middle_name', 'last_name')
		);
		
		$obj = new stdClass();
		$builder->setObject($obj);
		$builder->add('family_name', null, 'Nguyen');
		$builder->add('middle_name', null, 'Tien');
		$builder->add('last_name', null, 'Hy');
		$this->assertSame('Nguyen', $obj->family_name);
	}

    private function createCallback(array $supportedClasses, array $propNames)
    {
		$callback = $this->getMockBuilder(AbstractCallback::class)
            ->getMockForAbstractClass()
		;
		
		return $callback;
	}
		
    private function createImportor(array $supportedClasses)
    {
		$importor = $this->getMockBuilder(AbstractImportor::class)
			->getMockForAbstractClass()
		;

		return $importor;
	}
		
    private function createValidator()
    {
		$validator = $this->getMockBuilder(ValidatorInterface::class)
			->getMockForAbstractClass()
		;
		
		return $validator;
	}

    private function createObjectBuilder(
    	array $supportedClasses, 
    	array $supportedTypes, 
    	array $propNames = []
    )
    {
		$builder = $this->getMockBuilder(AbstractObjectBuilder::class)
			->setMethods(["supportObjectType", "supportObject"])
			->setConstructorArgs(array(
				$this->createCallback($supportedClasses, $propNames),
				$this->createImportor($supportedClasses),
				$this->createValidator(),
			))
            ->getMockForAbstractClass()
		;
		
		$builder
			->expects($this->any())
			->method("supportObject")
			->will($this->returnCallback(function($object) use ($supportedClasses) {
				return 
					$object !== null 
					and
					in_array(get_class($object), $supportedClasses)
				;
			}))
		;

		$builder
			->expects($this->any())
			->method("supportObjectType")
			->will($this->returnCallback(function($objectType) use ($supportedTypes) {
				return in_array($objectType, $supportedTypes);
			}))
		;
		
		return $builder;
	}
}
