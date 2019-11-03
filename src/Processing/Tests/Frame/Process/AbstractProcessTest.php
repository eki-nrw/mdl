<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Processing\Tests\Process;

use Eki\NRW\Mdl\Processing\Frame\Process\AbstractProcess;
use Eki\NRW\Mdl\Processing\Frame\Process\ProcessInterface;
use Eki\NRW\Mdl\Processing\ElementInterface;
use Eki\NRW\Mdl\Processing\Element;

use PHPUnit\Framework\TestCase;

use stdClass;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class AbstractProcessTest extends TestCase
{
	public function testDefaults()
	{
		$process = $this->createProcess();

		$this->assertInstanceOf(ProcessInterface::class, $process);
		$this->assertSame("process", $process->getFrameType());
		$process->setType("Process type");
		$this->assertSame("Process type", $process->getType());		
	}
	
	public function testIn()
	{
		$process = $this->createProcess();

		$obj_1 = $this->createInputSubject();
		$input_1 = new Element("input_1", $obj_1);
		$process->in($input_1, []);
	}

	/**
	* @expectedException \InvalidArgumentException
	* 
	*/
	public function testInNoKey()
	{
		$process = $this->createProcess();

		$obj = $this->createInputSubject();
		$input = new Element(null, $obj);
		$process->in($input, []);
	}

	/**
	* @expectedException \InvalidArgumentException
	* 
	*/
	public function testInTwiceWithTheSameKey()
	{
		$process = $this->createProcess();

		$obj_1 = $this->createInputSubject();
		$input_1 = new Element("input", $obj_1);
		$process->in($input_1, []);

		$obj_2 = $this->createInputSubject();
		$input_2 = new Element("input", $obj_2);
		$process->in($input_2, []);
	}

	/**
	* @dataProvider GetDataForInput
	* 
	*/
	public function testGetInput($key, $name)
	{
		$process = $this->createProcess();

		$obj = $this->createInputSubject();
		$obj->name = $name;
		$input = new Element($key, $obj);
		$process->in($input, []);
		
		$__input = $process->getInput($key);
		$this->assertSame($input, $__input);
		$this->assertSame($name, $__input->getSubject()->name);
	}
	
	public function GetDataForInput()
	{
		static $str = "lsadlaslkdlsaldksladlsad askhdak";
		
		return [
			[ 'input_1',  str_shuffle($str) ],
			[ 'input_2',  str_shuffle($str) ],
			[ 'input_3',  str_shuffle($str) ],
			[ 'abc',  str_shuffle($str) ],
			[ 'nguyen van a',  str_shuffle($str) ],
			[ 'xyz',  str_shuffle($str) ],
		];
	}

	public function testGetInputs()
	{
		$process = $this->createProcess();

		$obj_1 = $this->createInputSubject();
		$input_1 = new Element("input_1", $obj_1);
		$process->in($input_1, []);

		$obj_2 = $this->createInputSubject();
		$input_2 = new Element("input_2", $obj_2);
		$process->in($input_2, []);

		$obj_3 = $this->createInputSubject();
		$input_3 = new Element("input_3", $obj_3);
		$process->in($input_3, []);
		
		$this->assertSame(3, count($process->getInputs()));
	}

	/**
	* @expectedException \LogicException
	* 
	*/
	public function testOutWithoutPrepare()
	{
		$process = $this->createProcess();

		$obj = $this->createInputSubject();
		$output = new Element(null, $obj);
		$process->out($output, []);
	}

	/**
	* @dataProvider getDataOutNormal
	* 
	*/
	public function testOutNormal(array $inputs)
	{
		$process = $this->createProcess();

		foreach($inputs as $key => $name)
		{
			$obj = $this->createInputSubject();
			$obj->name = $name;
			$inputElem = new Element($key, $obj);
			$process->in($inputElem, []);
		}

		$process->actuate();

		$obj = $this->createOutputSubject();
		$output = new Element(null, $obj);
		$process->out($output, []);
		
		$__output = $process->getOutput();
		$this->assertSame($__output, $output);
	}
	
	public function getDataOutNormal()
	{
		static $outName = "dflalkfsa jhJKHKHJkhkjh 11134324"; 
		return [
			[ 
				array(
					'input_1' => str_shuffle($outName),
					'input_2' => str_shuffle($outName),
					'input_3' => str_shuffle($outName),
				)
			],
			[
				array(
					'i' => str_shuffle($outName),
					'abc' => str_shuffle($outName),
					'xyz' => "NAME",
				)
			],
			[
				array(
					'nguyen' => str_shuffle($outName),
					'tran' => str_shuffle($outName),
					'trinh' => "Trinh",
				)
			]
		];
	}

	public function testCanPipeFromFirst()
	{
		$process = $this->createProcess();

		$this->assertFalse($process->canPipe());
	}

	public function testCanPipeFromWhenActuated()
	{
		$process = $this->createProcess();

		$process->actuate();
		$this->assertFalse($process->canPipe());
	}

	public function testCanPipeToFirst()
	{
		$process = $this->createProcess();

		$this->assertTrue($process->canPipeIn("a_key", $this->getMockBuilder(ElementInterface::class)->getMock(), []));
	}

	public function testCanPipeToWhenActuated()
	{
		$process = $this->createProcess();

		$process->actuate();
		$this->assertFalse($process->canPipeIn("a_key", $this->getMockBuilder(ElementInterface::class)->getMock(), []));
	}
	
	public function testPipeIn()
	{
		
	}

	protected function createInputSubject()
	{
		$subject = new stdClass;
		
		return $subject;
	}

	protected function createOutputSubject()
	{
		$subject = new stdClass;
		
		return $subject;
	}

	protected function createProcess()
	{
		$process = $this->getMockBuilder(AbstractProcess::class)
			->setMethods(['actuating', 'pack'])
			->getMockForAbstractClass()
		;
		
		$process
			->expects($this->any())
			->method('actuating')
			->will($this->returnCallback(function () {
				
			}))
		;
				
		$process
			->expects($this->any())
			->method('pack')
			->will($this->returnCallback(function (array $frameOutputs, array $contexts) {
				$frameOutput = reset($frameOutputs);
				$subject = $frameOutput->getSubject();
				$subject->packedString = str_shuffle("Data packing. Data packed. Data packs.");
				$frameOutput->setSubject($subject);
				return array($frameOutput);
			}))
		;

		return $process;
	}
}
