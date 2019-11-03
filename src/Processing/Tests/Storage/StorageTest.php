<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Processing\Tests\Storage;

use Eki\NRW\Mdl\Processing\Storage\Storage;
use Eki\NRW\Mdl\Processing\Storage\StorageInterface;
use Eki\NRW\Mdl\Processing\ElementInterface;

use PHPUnit\Framework\TestCase;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class StorageTest extends TestCase
{
	public function testConstructor()
	{
		$storage = new Storage();
		
		$this->assertInstanceOf(StorageInterface::class, $storage);
	}

	public function testGetInput()
	{
		$storage = new Storage();
		
		$this->assertNull($storage->getInput());
	}

	public function testSetThenGetInput()
	{
		$storage = new Storage();
		
		$element = $this->getMockBuilder(ElementInterface::class)->getMock();
		$storage->setInput($element);
		
		$this->assertNotNull($storage->getInput());
		$this->assertSame($element, $storage->getInput());
	}

	public function testSetThenGetInput_with_Keys()
	{
		$storage = new Storage();
		
		$elements = array();
		for($i=0;$i<10;$i++)
		{
			$e = $this->getMockBuilder(ElementInterface::class)->getMock();
			$key = "key_".$i;
			$elements[$key] = $e;
			$storage->setInput($e, $key);
		}

		for($i=0;$i<10;$i++)
		{
			$key = "key_".$i;
			$this->assertSame($elements[$key], $storage->getInput($key));
		}
	}

	public function testSetThenGetInputs()
	{
		$storage = new Storage();
		
		$elements = array();
		for($i=0;$i<10;$i++)
		{
			$e = $this->getMockBuilder(ElementInterface::class)->getMock();
			$key = "key_".$i;
			$elements[$key] = $e;
			$storage->setInput($e, $key);
		}

		foreach($storage->getInputs() as $key => $elem)
		{
			$this->assertSame($elem, $storage->getInput($key));
		}
	}

	public function testGetOutput()
	{
		$storage = new Storage();
		
		$this->assertNull($storage->getOutput());
	}

	public function testSetThenGetOutput()
	{
		$storage = new Storage();
		
		$element = $this->getMockBuilder(ElementInterface::class)->getMock();
		$storage->setOutput($element);
		
		$this->assertNotNull($storage->getOutput());
		$this->assertSame($element, $storage->getOutput());
	}

	public function testSetThenGetOutput_with_Keys()
	{
		$storage = new Storage();
		
		$elements = array();
		for($i=0;$i<10;$i++)
		{
			$e = $this->getMockBuilder(ElementInterface::class)->getMock();
			$key = "key_".$i;
			$elements[$key] = $e;
			$storage->setOutput($e, $key);
		}

		for($i=0;$i<10;$i++)
		{
			$key = "key_".$i;
			$this->assertSame($elements[$key], $storage->getOutput($key));
		}
	}
}
