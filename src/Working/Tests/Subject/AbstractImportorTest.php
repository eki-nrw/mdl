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

use Eki\NRW\Mdl\Working\Subject\AbstractImportor;
use Eki\NRW\Mdl\Working\Subject\DirectorInterface;

use PHPUnit\Framework\TestCase;

use stdClass;

class AbstractImportorTest extends TestCase
{
	public function testCreateImportorWithConstructorNoDirector()
	{
		$importor = $this->getMockBuilder(AbstractImportor::class)
			->getMockForAbstractClass()
		;
	}

	public function testCreateImportorWithConstructorHasDirector()
	{
		$importor = $this->getMockBuilder(AbstractImportor::class)
			->setConstructorArgs(array(
				$this->getMockBuilder(DirectorInterface::class)->getMockForAbstractClass()
			))
			->getMockForAbstractClass()
		;
	}

	public function testCreateImportorThenSetDirector()
	{
		$importor = $this->getMockBuilder(AbstractImportor::class)
			->getMockForAbstractClass()
		;
		
		$importor->setDirector(
			$this->getMockBuilder(DirectorInterface::class)->getMockForAbstractClass()
		);
	}
	
	public function testWithStdClassObjectAndArrayData()
	{
		$importor = $this->getMockBuilder(AbstractImportor::class)
			->setMethods(['supportSubject', 'supportData', '_import'])
			->getMockForAbstractClass()
		;
		
		$importor->expects($this->once())
			->method('supportSubject')
			->will($this->returnCallback(function ($object) { return $object instanceof stdClass; }))
		;
		
		$importor->expects($this->once())
			->method('supportData')
			->will($this->returnCallback(function ($data) { return is_array($data); }))
		;
		
		$importor->expects($this->once())
			->method('_import')
			->will($this->returnCallback(
				function ($data, $object, array $contexts = []) {
					foreach($data as $key => $value)
					{
						$object->$key = $value;	
					}
				}
			))
		;
		
		$object = new stdClass();
		$importor->import(
			array(
				'one' => 1, 
				'two' => 2, 
				'three' => 3
			), 
			$object
		);
		
		$this->assertSame(1, $object->one);
		$this->assertSame(2, $object->two);
		$this->assertSame(3, $object->three);
	}

	/**
	* @dataProvider getPropList
	*/
	public function testWithStdClassObjectAndStdData(array $props)
	{
		$importor = $this->getMockBuilder(AbstractImportor::class)
			->setMethods(['supportSubject', 'supportData', '_import'])
			->getMockForAbstractClass()
		;
		
		$importor->expects($this->once())
			->method('supportSubject')
			->will($this->returnCallback(function ($object) { return $object instanceof stdClass; }))
		;
		
		$importor->expects($this->once())
			->method('supportData')
			->will($this->returnCallback(function ($data) { return $data instanceof stdClass; }))
		;
		
		$importor->expects($this->once())
			->method('_import')
			->will($this->returnCallback(
				function ($data, $object, array $contexts = []) use ($props) 
				{
					foreach(array_keys($props) as $propName)
					{
						$object->$propName = $data->$propName;
					}
				}
			))
		;
		
		$data = new stdClass();
		foreach($props as $propName => $propValue)
		{
			$data->$propName = $propValue;
		}
		
		$object = new stdClass();
		$importor->import($data, $object);

		foreach ($props as $propName => $propValue)
		{
			$this->assertEquals($propValue, $object->$propName);
		}		
	}
	
	public function getPropList()
	{
		return array(
			array(
				array(
					'prop_1' => 1,
					'prop_2' => 2,
					'prop_a' => 'a'
				)
			),
			array(
				array(
					'prop_x' => 'xxx',
					'prop_y' => 'yyy',
					'prop_88' => 88
				)
			),
			array(
				array(
					'car' => 'Toyota',
					'animal' => 'Canary',
					'number' => 100
				)
			),
		);
	}
}
